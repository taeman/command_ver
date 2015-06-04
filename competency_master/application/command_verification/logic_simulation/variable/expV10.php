<?php
//include "../../../../config/conndb_nonsession.inc.php";
//include "../class/class.utility.php";


/**
 *เช็คคุณสมบัติตาม ว 10
 *
 * @author  -
 * @copyright 2011 Sapphire
 * @description ตรวจสอบระยะเวลาการทดลองปฏิบัติราชการ
 * @param string $idcard, เลขบัตรประจำตัวประชาชน
 * @param integer $positionId, รหัสตำแหน่งที่เลื่อน
 * @param integer $levelId, รหัสระดับที่เลื่อน
 * @param date $startDate, วันที่มีผล
 * @param integer $periodExp, ระยะเวลาการทดลองงาน
 * @param integer $eduId, ระดับการศึกษา
 * @return boolean
 "
 */
class expV10 extends utility{
	
	public $result1 = 0;
	public $result2 = 0;
	public $helpStatus = '';
	
	public function __construct($idcard="",$positionId="",$levelId="",$startDate="",$eduId=""){
		
		$this->debug = "off";
		$this->idcard = $idcard;
		$this->positionId = $positionId;
		$this->levelId = $levelId;
		$this->startDate = $startDate;
		$this->startDateTh = $this->dateConvert($this->startDate,'en-th-ymd');
		$this->eduId = $eduId;
		$this->siteNow = $this->getSiteNow($this->idcard);
	    $this->dbNow = "cmss_".$this->siteNow;
		$this->arrPosition = array();
		$this->arrLevelId = array();
		$this->arrData = array();
		$this->periodCond1 = 1;
		$this->periodCond2 = $this->getPeriod();
		$this->arrDataExp = array();
		$this->arrTypeTitle = array('1'=>'บุคคลดังกล่าวจะต้องได้ดำรงตำแหน่งในสายงาน หรือได้ปฏิบัติหน้าที่ในสายงาน มาแล้วไม่น้อยกว่า <font color="#000000">'.$this->periodCond1.'</font> ปี รายละเอียดดังนี้','2'=>'มีระยะเวลาขั้นตํ่าในการดำรงตำแหน่งหรือเคยดำรงตำแหน่งในสายงาน ตามคุณวุฒิ ไม่น้อยกว่า <font color="#000000">'.$this->periodCond2.'</font> ปี รายละเอียดดังนี้');
		$this->arrSubTypeTitle = array('normal'=>'','3-5'=>'ระยะเวลาไม่ครบ นับเกื้อกูลการดำรงตำแหน่งที่เริ่มต้นจากระดับ 3 หรือ ระดับ 4','1-2'=>'ระยะเวลาไม่ครบ นับเกื้อกูลการดำรงตำแหน่งที่เริ่มต้นจากระดับ 1 หรือ ระดับ 2');
		
		
		#get Order Level
	    $this->orderLevel = $this->getOrderLevel();
		
		#find Position Line
		$sqlPosProfile = "SELECT pid AS count_rec 
		                  FROM hr_addposition_now
						  WHERE pid = '".$this->positionId."' AND
						        position_line_after IS NULL ";
		$queryPosProfile = mysql_db_query($this->dbMaster,$sqlPosProfile)or die(mysql_error());
		$numProfile = mysql_num_rows($queryPosProfile);						
								
		#if  multiple classification scheme position
		if($numProfile == 0){
		  $sqlLine = "SELECT match_pos.*,pos.position_line 
		              FROM ".$this->dbApp.".position_match_new AS match_pos
		              JOIN ".$this->dbMaster.".hr_addposition_now AS pos ON pos.pid = match_pos.pid_old
		              WHERE match_pos.pid_new = '".$this->positionId."' AND 
					        match_pos.level_id_new = '".$this->levelId."' AND
							match_pos.line_group = '1' 
					  GROUP BY pos.position_line ";
					  
		  $sqlGetLevel = "SELECT level_id FROM hr_addradub 
		                  WHERE active_now = '1' AND 
						        type_id = '3' AND 
							    orderby < '".$this->orderLevel."' ";			  
		  
		}else{
		  $sqlLine = "SELECT position_line
		              FROM hr_addposition_now 
					  WHERE pid = '".$this->positionId."' ";
					  
		  $sqlGetLevel = "SELECT level_id FROM hr_addradub 
		                  WHERE orderby < '".$this->orderLevel."' AND
						        radub LIKE 'ท.%' ";			  
		}
		
		if($this->debug == 'on'){
		     echo $sqlLine."<br>";
		}					
		$queryLine = mysql_db_query($this->dbMaster,$sqlLine)or die(mysql_error());
		while($rowsLine = mysql_fetch_array($queryLine)){
		   $this->arrPositionLine[] = $rowsLine['position_line'];
		}
		
		#find Position
		if(count($this->arrPositionLine > 0)){
		   $strPositionLine = implode(",",$this->arrPositionLine);
		   $sqlOldPos = "SELECT pid FROM hr_addposition_now 
		                 WHERE position_line IN($strPositionLine) ";
		   $queryOldPos = mysql_db_query($this->dbMaster,$sqlOldPos)or die(mysql_error());
		   while($rowsOldPos = mysql_fetch_array($queryOldPos)){
			   $this->arrPosition[] = $rowsOldPos['pid']; 
		   }
		}
		
	    #find Level ID
		$queryGetLevel = mysql_db_query($this->dbMaster,$sqlGetLevel)or die(mysql_error());
		while($rowsGetLevel = mysql_fetch_array($queryGetLevel)){
		   $this->arrLevelId[] = $rowsGetLevel['level_id'];
		}
		
		#find Bachelor Degree's finish date
		$this->finishDateEdu = $this->checkDateEdu();
		
		
		#find position in 3-5 type
        $sqlLine35 = "SELECT hr_addposition_now.pid,hr_addposition_now.position,hr_addposition_now.position_line , hr_addposition_line.line_name
                      FROM hr_addposition_now
                      JOIN hr_addposition_line ON hr_addposition_line.position_line = hr_addposition_now.position_line
                      WHERE hr_addposition_line.line_group = '1' AND hr_addposition_line.position_line NOT IN($strPositionLine) ";
	    $queryLine35 = mysql_db_query($this->dbMaster,$sqlLine35)or die(mysql_error());
		while($rowsLine35 = mysql_fetch_array($queryLine35)){
			$this->arrPos35[] = $rowsLine35['pid']; 
		}
		
		#find position in 1-2 type
		$sqlLine12 = "SELECT hr_addposition_now.pid,hr_addposition_now.position,hr_addposition_now.position_line , hr_addposition_line.line_name
                      FROM hr_addposition_now
                      JOIN hr_addposition_line ON hr_addposition_line.position_line = hr_addposition_now.position_line
                      WHERE hr_addposition_line.line_group = '2' ";
	    $queryLine12 = mysql_db_query($this->dbMaster,$sqlLine12)or die(mysql_error());
		while($rowsLine12 = mysql_fetch_array($queryLine12)){
			$this->arrPos12[] = $rowsLine12['pid'];
		}
		
		
    }
   
   public function checkExp(){
	    //echo "<br><b>เงื่อนไขที่ 1 </b><br>"; 
		$result1 = $this->calExp('1');
		if($result1){
			$this->result1 = 1;
		}
		//echo "<br><br><br><b>เงื่อนไขที่ 2 </b><br>";
		$result2 = $this->calExp('2');
		if($result2){
			$this->result2 = 1;
		}
		
		if($result1 and $result2){
			return true;
		}else{
		    return false;
		}
   }
   
   public function calExp($type){
		
		#Define period time condition
		if($type == '1'){
		  $period = $this->periodCond1; 
	    }elseif($type == '2'){
		  $period = $this->periodCond2; 
	    }
		
		if(count($this->arrPosition > 0)){
		   $strPosition = implode(",",$this->arrPosition);
		   $whereCond1 = " position_id IN($strPosition) ";	
		}else{
		   $whereCond1 = " position_id = '999' ";
		}
		
		if(count($this->arrLevelId > 0)){
		   $strLevelId = implode(",",$this->arrLevelId);
		   $whereCond2 = " OR (position_id = '".$this->positionId."' AND level_id IN(".$strLevelId.") ) ";
		}
		
		$sqlSalary = "SELECT * FROM salary 
		              WHERE id = '".$this->idcard."' AND 
					        date < '".$this->startDateTh."' AND
							(".$whereCond1.$whereCond2.") 
					  GROUP BY position_id 
				      ORDER BY date ASC,level_id ASC,runno DESC";
		$querySalary = mysql_db_query($this->dbNow,$sqlSalary);
		$numSalary = mysql_num_rows($querySalary);
		if($numSalary > 0){
			while($rowsSalary = mysql_fetch_array($querySalary)){
				#find start date
	            $sqlStart = "SELECT runno,date 
				             FROM salary 
							 WHERE id = '".$this->idcard."' AND 
							       position_id = '".$rowsSalary['position_id']."' AND 
								   date != '' 
							 ORDER BY date ASC 
							 LIMIT 0,1 ";
	            $queryStart = mysql_db_query($this->dbNow,$sqlStart)or die(mysql_error());
	            $rowsStart = mysql_fetch_array($queryStart);
	
	            #hiligh pdf
	            $sqlHiligh = "UPDATE salary SET system_type = 'command' 
			                  WHERE id = '".$this->idcard."' AND 
							        runno = '".$rowsStart['runno']."' ";
                ##mysql_db_query($this->dbNow,$sqlHiligh)or die(mysql_error());
  
                $arrPosition[$rowsSalary['position_id']] = $rowsStart['date'];
	            $arrPositionName[$rowsSalary['position_id']] = $rowsSalary['position'];
	            $arrDateStart[] = $rowsStart['date'];
	            $arrPositionId[] = $rowsSalary['position_id'];
				$arrLevelId[$rowsSalary['position_id']] = $rowsSalary['level_id'];
	            $arrLevelName[$rowsSalary['position_id']] = $rowsSalary['radub'];
	            $arrRunId[$rowsSalary['position_id']] = $rowsSalary['runid'];
				
		   }#end while
		  
		  #Array Reverse 
		  $lenPosition = (count($arrPositionId)-1);
          for($i=$lenPosition;$i>=0;$i--){
	          $arrPositionRe[$arrPositionId[$i]] = $arrDateStart[$i];
	          $arrDateStartRe[] = $arrDateStart[$i];
          }
		  
		  #Array Sort
		  arsort($arrPositionRe);
          rsort($arrDateStartRe);
		  
		  
		  $i = 0;
          $arrDate = explode("-",$this->startDate);
          $mkDate = (@mktime(0,0,0,$arrDate[1],$arrDate[2],$arrDate[0])) - 86400;
          $dateEndAll = date('Y-m-d',$mkDate);
          $endPosition = count($arrPosition)-1;
		  #Start Loops
		  foreach($arrPositionRe as $positionId=>$dateStart){
			  //echo "<hr>";
			  //echo $arrPositionName[$positionId];
			  $dateStartPosition = $this->dateConvert($dateStart,'th-en-ymd');
	          $dateStartPositionAll = $dateStartPosition;
			  //echo "<br>"; 
	          //echo $this->dateConvert($dateStartPosition,'en-th-ddmmyy');
			  $this->arrDataExp[$type]['normal'][$i]['positionId'] = $positionId;
			  $this->arrDataExp[$type]['normal'][$i]['positionName'] = $arrPositionName[$positionId];
			  $this->arrDataExp[$type]['normal'][$i]['levelName'] = $arrLevelName[$positionId];
			  $this->arrDataExp[$type]['normal'][$i]['dateStartPosition'] = $this->dateConvert($dateStartPosition,'en-th-ddmmyy');
	
			  
			  
			  if($i==0){
	            $dateEndPosition = $dateEndAll;
	          }else{
	            $arrDateEnd = explode("-",$arrDateStartRe[$i-1]);
	            $mkDateEnd = (@mktime(0,0,0,$arrDateEnd[1],$arrDateEnd[2],($arrDateEnd[0]-543))) - 86400;
	            $dateEnd = date('Y-m-d',$mkDateEnd);
		        $dateEndPosition = $dateEnd;
	          }
			  //echo "<br>";
			  //echo $this->dateConvert($dateEndPosition,'en-th-ddmmyy');
			  $this->arrDataExp[$type]['normal'][$i]['dateEndPosition'] = $this->dateConvert($dateEndPosition,'en-th-ddmmyy');
			  
			  
			  $arrPeriodPosition = $this->getPeriodReal($dateStartPosition,$dateEndPosition);
	          $strPeriodPosition = $this->splitDate($arrPeriodPosition);
	          $arrPeriodPositionAll = $this->getPeriodReal($dateStartPosition,$dateEndAll);
	          $strPeriodPositionAll = $this->splitDate($arrPeriodPositionAll);
			  $this->arrDataExp[$type]['normal'][$i]['strPeriodPosition'] = $strPeriodPosition;
	          $this->arrDataExp[$type]['normal'][$i]['strPeriodPositionAll'] = $strPeriodPositionAll;
			 
			  
			  //echo "<br>";
			  //echo $strPeriodPosition;
			  //echo "<br>";
	          //echo $strPeriodPositionAll;
			  
			  if($arrPeriodPositionAll[0] >= $period){
	             break;
	          }

			  //echo "<hr>";
			  $i++;
		  }#end foreach
		  if($arrPeriodPositionAll[0] < $period){
			  //echo "<br>นับเกื้อกูล 3-5";
			  $strPosLine35 = implode(",",$this->arrPos35);
			  $sqlSalary = "SELECT * FROM salary 
                            WHERE id = '".$this->idcard."' AND 
							      date < '".$this->startDateTh."' AND 
								  date >= '".$this->finishDateEdu."' AND 
								  position_id IN(".$strPosLine35.") 
				            GROUP BY position_id 
				            ORDER BY date ASC,level_id ASC,runno DESC";
			  //echo "<br>";
			  //echo $sqlSalary; 
			  $querySalary = mysql_db_query($this->dbNow,$sqlSalary)or die(mysql_error());
			  $numSalary = mysql_num_rows($querySalary);
			  if($numSalary > 0){
				$this->helpStatus = 1;  
				#clear array
	            $arrPosition = array();
		        $arrPositionName = array();
		        $arrDateStart = array();
		        $arrPositionId = array();
		        $arrPositionRe = array();
		        $arrDateStartRe = array();
				$arrLevelId = array();
	            $arrLevelName = array();
	            $arrRunId = array();  
			    while($rowsSalary = mysql_fetch_array($querySalary)){
					#find start date
	                $sqlStart = "SELECT runno,date FROM salary 
					             WHERE id = '".$this->idcard."' AND 
								       position_id = '".$rowsSalary['position_id']."' AND 
									   date != '' 
									   ORDER BY date ASC LIMIT 0,1 ";
	                $queryStart = mysql_db_query($this->dbNow,$sqlStart)or die(mysql_error());
	                $rowsStart = mysql_fetch_array($queryStart);
					
					if($rowsStart['date'] < $this->finishDateEdu){
			            $arrPosition[$rowsSalary['position_id']] = $this->finishDateEdu;
			            $arrDateStart[] = $this->finishDateEdu;
	 	            }else{
			            $arrPosition[$rowsSalary['position_id']] = $rowsStart['date'];
			            $arrDateStart[] = $rowsStart['date'];
		            }
					
					$arrPositionName[$rowsSalary['position_id']] = $rowsSalary['position'];
	                $arrPositionId[] = $rowsSalary['position_id'];
					$arrLevelId[$rowsSalary['position_id']] = $rowsSalary['level_id'];
	                $arrLevelName[$rowsSalary['position_id']] = $rowsSalary['radub'];
	                $arrRunId[$rowsSalary['position_id']] = $rowsSalary['runid'];
					
					#hiligh pdf
	                $sqlHiligh = "UPDATE salary SET system_type = 'command' 
			                      WHERE id = '".$this->idcard."' AND 
							            runno = '".$rowsStart['runno']."' ";
                    ##mysql_db_query($this->dbNow,$sqlHiligh)or die(mysql_error());
					
						
			    }#end while
				
				#Array Reverse 
		        $lenPosition = (count($arrPositionId)-1);
                for($i=$lenPosition;$i>=0;$i--){
	               $arrPositionRe[$arrPositionId[$i]] = $arrDateStart[$i];
	               $arrDateStartRe[] = $arrDateStart[$i];
                }
		  
		        #Array Sort
		        arsort($arrPositionRe);
                rsort($arrDateStartRe);
				
				$i = 0;
                $dateEndFor35 =  $dateStartPositionAll;
                $arrDateEndFor35 = explode("-",$dateEndFor35);
                $mkDateEndFor35 = (@mktime(0,0,0,$arrDateEndFor35[1],$arrDateEndFor35[2],$arrDateEndFor35[0])) - 86400;
                $dateEndFor35All = date('Y-m-d',$mkDateEndFor35);
                $endPosition = count($arrPositionRe)-1;
				#start loops
				foreach($arrPositionRe as $positionId=>$dateStart){
				   //echo "<hr>";
			       //echo $arrPositionName[$positionId];
			       $dateStartPosition = $this->dateConvert($dateStart,'th-en-ymd');
	               $dateStartPositionAll = $dateStartPosition;
			       //echo "<br>"; 
	               //echo $this->dateConvert($dateStartPosition,'en-th-ddmmyy');
				   $this->arrDataExp[$type]['3-5'][$i]['positionId'] = $positionId;
			       $this->arrDataExp[$type]['3-5'][$i]['positionName'] = $arrPositionName[$positionId];
			       $this->arrDataExp[$type]['3-5'][$i]['levelName'] = $arrLevelName[$positionId];
			       $this->arrDataExp[$type]['3-5'][$i]['dateStartPosition'] = $this->dateConvert($dateStartPosition,'en-th-ddmmyy');
				   
				   if($i == 0){
	                  $dateEndPosition = $dateEndFor35All;
	               }else{
	                  $arrDateEnd = explode("-",$arrDateStartRe[$i-1]);
	                  $mkDateEnd = (@mktime(0,0,0,$arrDateEnd[1],$arrDateEnd[2],($arrDateEnd[0]-543))) - 86400;
	                  $dateEnd = date('Y-m-d',$mkDateEnd);
	                  $dateEndPosition = $dateEnd;
	               }

				   //echo "<br>";
			       //echo $this->dateConvert($dateEndPosition,'en-th-ddmmyy');
				   $this->arrDataExp[$type]['3-5'][$i]['dateEndPosition'] = $this->dateConvert($dateEndPosition,'en-th-ddmmyy');
				   
				   
				   $arrPeriodPosition = $this->getPeriodReal($dateStartPosition,$dateEndPosition);
	               $strPeriodPosition = $this->splitDate($arrPeriodPosition);
	               $arrPeriodPositionAll = $this->getPeriodReal($dateStartPosition,$dateEndAll);
	               $strPeriodPositionAll = $this->splitDate($arrPeriodPositionAll);
				   $this->arrDataExp[$type]['3-5'][$i]['strPeriodPosition'] = $strPeriodPosition;
	               $this->arrDataExp[$type]['3-5'][$i]['strPeriodPositionAll'] = $strPeriodPositionAll;
			  
			       //echo "<br>";
			       //echo "รวมเวลาในตำแหน่ง  ".$strPeriodPosition;
			       //echo "<br>";
	               //echo "รวมเวลาทั้งหมด ($dateStartPosition - $dateEndAll)".$strPeriodPositionAll;
			  
			       if($arrPeriodPositionAll[0] >= $period){
	                  break;
	               }
				   //echo "<hr>";
				   
				   
				   $i++;
				}#end foreach
				if($arrPeriodPositionAll[0] < $period){
				  	//echo "<br>นับเกื้อกูล 1-2";
				    $strPosLine12 = implode(",",$this->arrPos12);
			        $sqlSalary = "SELECT * FROM salary 
                                  WHERE id = '".$this->idcard."' AND 
							            date < '".$this->startDateTh."' AND 
								        date >= '".$this->finishDateEdu."' AND 
								        position_id IN(".$strPosLine12.") 
				                  GROUP BY position_id 
				                  ORDER BY date ASC,level_id ASC,runno DESC";
			        //echo "<br>";
			        //echo $sqlSalary;
				    $querySalary = mysql_db_query($this->dbNow,$sqlSalary)or die(mysql_error());
			        $numSalary = mysql_num_rows($querySalary);
			        if($numSalary > 0){
					    $this->helpStatus = 1;
					    #clear array
	                    $arrPosition = array();
		                $arrPositionName = array();
		                $arrDateStart = array();
		                $arrPositionId = array();
		                $arrPositionRe = array();
		                $arrDateStartRe = array();
						$arrLevelId = array();
	                    $arrLevelName = array();
	                    $arrRunId = array();  
			            while($rowsSalary = mysql_fetch_array($querySalary)){
						  
						    #find start date
	                	    $sqlStart = "SELECT runno,date FROM salary 
					             	     WHERE id = '".$this->idcard."' AND 
								       	       position_id = '".$rowsSalary['position_id']."' AND 
									   	       date != '' 
									  	 ORDER BY date ASC LIMIT 0,1 ";
	                	    $queryStart = mysql_db_query($this->dbNow,$sqlStart)or die(mysql_error());
	                	    $rowsStart = mysql_fetch_array($queryStart);
					
						    if($rowsStart['date'] < $this->finishDateEdu){
			            	    $arrPosition[$rowsSalary['position_id']] = $this->finishDateEdu;
			            	    $arrDateStart[] = $this->finishDateEdu;
	 	            	    }else{
			            	    $arrPosition[$rowsSalary['position_id']] = $rowsStart['date'];
			            	    $arrDateStart[] = $rowsStart['date'];
		            	    }
					
						    $arrPositionName[$rowsSalary['position_id']] = $rowsSalary['position'];
	                	    $arrPositionId[] = $rowsSalary['position_id'];
							$arrLevelId[$rowsSalary['position_id']] = $rowsSalary['level_id'];
	                        $arrLevelName[$rowsSalary['position_id']] = $rowsSalary['radub'];
	                        $arrRunId[$rowsSalary['position_id']] = $rowsSalary['runid'];
					
						    #hiligh pdf
	                	    $sqlHiligh = "UPDATE salary SET system_type = 'command' 
			                      	      WHERE id = '".$this->idcard."' AND 
							                    runno = '".$rowsStart['runno']."' ";
                    	    ##mysql_db_query($this->dbNow,$sqlHiligh)or die(mysql_error());
						
					    }##end while
					
					    #Array Reverse 
		                $lenPosition = (count($arrPositionId)-1);
                        for($i=$lenPosition;$i>=0;$i--){
	                       $arrPositionRe[$arrPositionId[$i]] = $arrDateStart[$i];
	                       $arrDateStartRe[] = $arrDateStart[$i];
                        }
		  
		                #Array Sort
		                arsort($arrPositionRe);
                        rsort($arrDateStartRe);
					
					    $i = 0;
                        $dateEndFor12 =  $dateStartPositionAll;
                        $arrDateEndFor12 = explode("-",$dateEndFor12);
                        $mkDateEndFor12 = (@mktime(0,0,0,$arrDateEndFor12[1],$arrDateEndFor12[2],$arrDateEndFor12[0])) - 86400;
                        $dateEndFor12All = date('Y-m-d',$mkDateEndFor12);
                        $endPosition = count($arrPositionRe)-1;
				        #start loops
				        foreach($arrPositionRe as $positionId=>$dateStart){
				           //echo "<hr>";
			               //echo $arrPositionName[$positionId];
			               $dateStartPosition = $this->dateConvert($dateStart,'th-en-ymd');
	                       $dateStartPositionAll = $dateStartPosition;
			               //echo "<br>"; 
	                       //echo $this->dateConvert($dateStartPosition,'en-th-ddmmyy');
						   $this->arrDataExp[$type]['1-2'][$i]['positionId'] = $positionId;
			               $this->arrDataExp[$type]['1-2'][$i]['positionName'] = $arrPositionName[$positionId];
			               $this->arrDataExp[$type]['1-2'][$i]['levelName'] = $arrLevelName[$positionId];
			               
				   
				           if($i == 0){
	                          $dateEndPosition = $dateEndFor12All;
	                       }else{
	                          $arrDateEnd = explode("-",$arrDateStartRe[$i-1]);
	                          $mkDateEnd = (@mktime(0,0,0,$arrDateEnd[1],$arrDateEnd[2],($arrDateEnd[0]-543))) - 86400;
	                          $dateEnd = date('Y-m-d',$mkDateEnd);
	                          $dateEndPosition = $dateEnd;
	                       }

				           //echo "<br>";
			               //echo $this->dateConvert($dateEndPosition,'en-th-ddmmyy');
						   $this->arrDataExp[$type]['1-2'][$i]['dateEndPosition'] = $this->dateConvert($dateEndPosition,'en-th-ddmmyy');
						   $dateEndHalf = $this->getPeriodRealHalf($dateStartPosition,$dateEndPosition);
						   $this->arrDataExp[$type]['1-2'][$i]['dateStartPosition'] = $this->dateConvert($dateStartPosition,'en-th-ddmmyy')." (".$this->dateConvert($dateEndHalf,'en-th-ddmmyy').")";
				       
					       $arrPeriodPosition = $this->getPeriodReal($dateEndHalf,$dateEndPosition);
	                       $strPeriodPosition = $this->splitDate($arrPeriodPosition);
						   $dateEndHalfAll = $this->getPeriodRealHalf($dateStartPosition,$dateEndFor12All);
						   //echo $dateEndHalfAll."  ".$dateEndAll;
	                       $arrPeriodPositionAll = $this->getPeriodReal($dateEndHalfAll,$dateEndAll);
	                       $strPeriodPositionAll = $this->splitDate($arrPeriodPositionAll);
						   $this->arrDataExp[$type]['1-2'][$i]['strPeriodPosition'] = $strPeriodPosition;
	                       $this->arrDataExp[$type]['1-2'][$i]['strPeriodPositionAll'] = $strPeriodPositionAll;
			  
			               //echo "<br>";
			               //echo "รวมเวลาในตำแหน่ง  ".$strPeriodPosition;
			               //echo "<br>";
	                       //echo "รวมเวลาทั้งหมด ($dateStartPosition - $dateEndAll)".$strPeriodPositionAll;
			  
			               if($arrPeriodPositionAll[0] >= $period){
	                          break;
	                       }
				           //echo "<hr>";
				           $i++;
				        }#end foreach
					    if($arrPeriodPositionAll[0] >= $period){
					       //echo "<font color='#CC0000'>ผ่าน</font>";
						   return true; 
					    }else{
					       //echo "<font color='#CC0000'>ไม่ผ่าน</font>"; 
						   return false;	
					    }
					}else{
						//echo "ไม่พบข้อมูลกลุ่มตำแหน่ง 1-2";
						//echo "<font color='#CC0000'>ไม่ผ่าน</font>";
						return false;
					}
						
				}else{
				  //echo "<font color='#CC0000'>ผ่าน</font>";
				  return true; 
				}
				
				
			  }else{
			    //echo "ไม่พบข้อมูลกลุ่มตำแหน่ง 3-5";
				//echo "<br>นับเกื้อกูล 1-2";
				$strPosLine12 = implode(",",$this->arrPos12);
			    $sqlSalary = "SELECT * FROM salary 
                              WHERE id = '".$this->idcard."' AND 
							        date < '".$this->startDateTh."' AND 
								    date >= '".$this->finishDateEdu."' AND 
								    position_id IN(".$strPosLine12.") 
				              GROUP BY position_id 
				              ORDER BY date ASC,level_id ASC,runno DESC";
			    //echo "<br>";
			    //echo $sqlSalary;
				$querySalary = mysql_db_query($this->dbNow,$sqlSalary)or die(mysql_error());
			    $numSalary = mysql_num_rows($querySalary);
			    if($numSalary > 0){
					$this->helpStatus = 1;
					#clear array
	                $arrPosition = array();
		            $arrPositionName = array();
		            $arrDateStart = array();
		            $arrPositionId = array();
		            $arrPositionRe = array();
		            $arrDateStartRe = array();
					$arrLevelId = array();
	                $arrLevelName = array();
	                $arrRunId = array();
			        while($rowsSalary = mysql_fetch_array($querySalary)){
						  
						#find start date
	                	$sqlStart = "SELECT runno,date FROM salary 
					             	 WHERE id = '".$this->idcard."' AND 
								       	 position_id = '".$rowsSalary['position_id']."' AND 
									   	 date != '' 
									  	 ORDER BY date ASC LIMIT 0,1 ";
	                	$queryStart = mysql_db_query($this->dbNow,$sqlStart)or die(mysql_error());
	                	$rowsStart = mysql_fetch_array($queryStart);
					
						if($rowsStart['date'] < $this->finishDateEdu){
			            	$arrPosition[$rowsSalary['position_id']] = $this->finishDateEdu;
			            	$arrDateStart[] = $this->finishDateEdu;
	 	            	}else{
			            	$arrPosition[$rowsSalary['position_id']] = $rowsStart['date'];
			            	$arrDateStart[] = $rowsStart['date'];
		            	}
					
						$arrPositionName[$rowsSalary['position_id']] = $rowsSalary['position'];
	                	$arrPositionId[] = $rowsSalary['position_id'];
						$arrLevelId[$rowsSalary['position_id']] = $rowsSalary['level_id'];
	                    $arrLevelName[$rowsSalary['position_id']] = $rowsSalary['radub'];
	                    $arrRunId[$rowsSalary['position_id']] = $rowsSalary['runid'];
					
						#hiligh pdf
	                	$sqlHiligh = "UPDATE salary SET system_type = 'command' 
			                      	  WHERE id = '".$this->idcard."' AND 
							                runno = '".$rowsStart['runno']."' ";
                    	##mysql_db_query($this->dbNow,$sqlHiligh)or die(mysql_error());
						
					}##end while
					
					#Array Reverse 
		            $lenPosition = (count($arrPositionId)-1);
                    for($i=$lenPosition;$i>=0;$i--){
	                  $arrPositionRe[$arrPositionId[$i]] = $arrDateStart[$i];
	                  $arrDateStartRe[] = $arrDateStart[$i];
                    }
		  
		            #Array Sort
		            arsort($arrPositionRe);
                    rsort($arrDateStartRe);
					
					$i = 0;
                    $dateEndFor12 =  $dateStartPositionAll;
                    $arrDateEndFor12 = explode("-",$dateEndFor12);
                    $mkDateEndFor12 = (@mktime(0,0,0,$arrDateEndFor12[1],$arrDateEndFor12[2],$arrDateEndFor12[0])) - 86400;
                    $dateEndFor12All = date('Y-m-d',$mkDateEndFor12);
                    $endPosition = count($arrPositionRe)-1;
				    #start loops
				    foreach($arrPositionRe as $positionId=>$dateStart){
				       //echo "<hr>";
			           //echo $arrPositionName[$positionId];
			           $dateStartPosition = $this->dateConvert($dateStart,'th-en-ymd');
	                   $dateStartPositionAll = $dateStartPosition;
					   $this->arrDataExp[$type]['1-2'][$i]['positionId'] = $positionId;
			           $this->arrDataExp[$type]['1-2'][$i]['positionName'] = $arrPositionName[$positionId];
			           $this->arrDataExp[$type]['1-2'][$i]['levelName'] = $arrLevelName[$positionId];
			           //echo "<br>"; 
	                   //echo $this->dateConvert($dateStartPosition,'en-th-ddmmyy');
				   
				       if($i == 0){
	                      $dateEndPosition = $dateEndFor12All;
	                   }else{
	                      $arrDateEnd = explode("-",$arrDateStartRe[$i-1]);
	                      $mkDateEnd = (@mktime(0,0,0,$arrDateEnd[1],$arrDateEnd[2],($arrDateEnd[0]-543))) - 86400;
	                      $dateEnd = date('Y-m-d',$mkDateEnd);
	                      $dateEndPosition = $dateEnd;
	                   }

				       //echo "<br>";
			           //echo $this->dateConvert($dateEndPosition,'en-th-ddmmyy');
				       $this->arrDataExp[$type]['1-2'][$i]['dateEndPosition'] = $this->dateConvert($dateEndPosition,'en-th-ddmmyy');
				       $dateEndHalf = $this->getPeriodRealHalf($dateStartPosition,$dateEndPosition);
					   $this->arrDataExp[$type]['1-2'][$i]['dateStartPosition'] = $this->dateConvert($dateStartPosition,'en-th-ddmmyy')." (".$this->dateConvert($dateEndHalf,'en-th-ddmmyy').")";
				       
					   $arrPeriodPosition = $this->getPeriodReal($dateEndHalf,$dateEndPosition);
	                   $strPeriodPosition = $this->splitDate($arrPeriodPosition);
					   $dateEndHalfAll = $this->getPeriodRealHalf($dateStartPosition,$dateEndFor12All);
					   //echo $dateEndHalfAll."  ".$dateEndAll;
	                   $arrPeriodPositionAll = $this->getPeriodReal($dateEndHalfAll,$dateEndAll);
	                   $strPeriodPositionAll = $this->splitDate($arrPeriodPositionAll);
					   $this->arrDataExp[$type]['1-2'][$i]['strPeriodPosition'] = $strPeriodPosition;
	                   $this->arrDataExp[$type]['1-2'][$i]['strPeriodPositionAll'] = $strPeriodPositionAll;
			  
			           //echo "<br>";
			           //echo "รวมเวลาในตำแหน่ง  ".$strPeriodPosition;
			           //echo "<br>";
	                   //echo "รวมเวลาทั้งหมด ($dateStartPosition - $dateEndAll)".$strPeriodPositionAll;
			  
			           if($arrPeriodPositionAll[0] >= $period){
	                      break;
	                   }
				      //echo "<hr>";
				      $i++;
				    }#end foreach
					if($arrPeriodPositionAll[0] >= $period){
					   //echo "<font color='#CC0000'>ผ่าน1</font>";
					   return true; 
					}else{
					   //echo "<font color='#CC0000'>ไม่ผ่าน</font>";
					   return false; 	
					}
					
			    }else{
				    //echo "ไม่พบข้อมูลกลุ่มตำแหน่ง 1-2";
					//echo "<font color='#CC0000'>ไม่ผ่าน</font>";
					return false;
				}
				
				
			  }
		  }else{
			 //echo "<font color='#CC0000'>ผ่าน2</font>"; 
			 return true;   
		  }
		  
		}else{
		  //echo "<font color='#CC0000'>ไม่ผ่าน</font>";	
		  return false;
		}			  
		
		if($this->debug == 'on'){
		  echo "<pre>";
		  print_r($arrPositionRe);
		  print_r($arrDateStartRe);
		  echo "</pre>";	
		  echo $this->finishDateEdu;
		  echo "<br>";	
		  echo $this->dbNow;
		  echo "<br>";
		  echo $sqlSalary;
		  echo "<br>";
		  echo $this->periodCond2;
		  echo "<pre>";
		  print_r($this->arrPositionLine);
		  print_r($this->arrPosition);
		  print_r($this->arrLevelId);
		  echo "</pre>";
		} 
   }
   
   
   public function getOrderLevel(){
  
        $sqlOrder = "SELECT orderby FROM hr_addradub WHERE level_id = '".$this->levelId."'  ";
	    $queryOrder = mysql_db_query($this->dbMaster,$sqlOrder)or die(mysql_error());
	    $rowsOrder = mysql_fetch_array($queryOrder);
	
	    return $rowsOrder['orderby'];
  }
  
  public function checkDateEdu(){
       
	   $sql = "SELECT * FROM graduate 
	           WHERE id = '".$this->idcard."' AND 
			         graduate_level = '40' 
			   ORDER BY finishyear ASC LIMIT 0,1 ";
       $query = mysql_db_query($this->dbNow,$sql)or die(mysql_error());
       $rows = mysql_fetch_array($query);
       $date = $rows['finishyear']."-01-01";
       return $date;
	   
  }
  
  public function showExp(){
	  /*echo "<pre>";
	  print_r($this->arrDataExp);
	  echo "</pre>";*/
   
   if(count($this->arrDataExp) > 0){
   echo '<table width="100%" border="0" cellspacing="0" cellpadding="3">';
   foreach($this->arrDataExp as $type=>$arrTbl){

     echo '<tr>';
     echo '<td>';
     echo '&nbsp;';
     echo '</td>';
     echo '</tr>';
	 echo '<tr>';
     echo '<td>';
	 echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;">';
	 echo '<font color="#6A3500"><b> เงื่อนไข : </b>';
     echo $this->arrTypeTitle[$type];
	 echo '</font>';
	 echo '</div>';
     echo '</td>';
     echo '</tr>';
     echo '<tr>';
     echo '<td>';
     foreach($arrTbl as $tblName=>$arrData){
		 if($this->arrSubTypeTitle[$tblName] != ''){  
	      echo "<div style='border:1px solid #6A3500;color:#6A3500; padding:3px;'><img src='images/exclamation.png' align='absmiddle' />&nbsp;".$this->arrSubTypeTitle[$tblName]."</div>";
		 }
     echo '<table width="100%" border="0" cellspacing="0" cellpadding="3">';
     $numRows = count($arrData);
     $i = 1;
     foreach($arrData as $key=>$arrValue){
          echo '<tr>';
          echo '<td width="20%">'.$arrValue['positionName'].'</td>';
          echo '<td width="20%">ระดับ '.$arrValue['levelName'].'</td>';
          echo '<td width="20%">'.$arrValue['dateStartPosition'].'</td>';
          echo '<td width="20%">'.$arrValue['dateEndPosition'].'</td>';
          echo '<td width="20%">'.$arrValue['strPeriodPosition'].'</td>';
          echo '</tr>';
          if($i == $numRows){
            echo '<tr>';
            echo '<td colspan="5"><b>ประสบการณ์ดำรงตำแหน่ง เท่ากับ '.$arrValue['strPeriodPositionAll'].'</b></td>';
            echo '</tr>';
          }
          $i++;
      } 
      echo '</table>';
	
	 }   
     echo '</td>';
     echo '</tr>';  

    }

    echo '</table>';
   }else{
	  echo "<div style='border:1px solid #6A3500;color:#FFFF00; padding:3px;'><img src='images/exclamation.png' align='absmiddle' />&nbsp;ไม่พบข้อมูลตำแหน่ง</div>"; 
   }
     
  }
   
}

//$objExp = new expV10('3180500030751','525471147','92255106','2010-04-21','40');
//$objExp = new expV10('3620200034234','525471206','92254708','2009-02-23','60');
//$objExp = new expV10('3501200165705','525471187','92255106','2009-03-15','40');
//$objExp = new expV10('3110200032791','525471174','92255106','2011-03-31','40');
//$objExp = new expV10('3841200324657','525471174','92255106','2010-01-15','40');

//$objExp->checkExp();
//$objExp->showExp();
?>