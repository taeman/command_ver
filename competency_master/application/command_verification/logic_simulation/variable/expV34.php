<?php
//include "../../../../config/conndb_nonsession.inc.php";
//include "../class/class.utility.php";

/**
 *เช็คคุณสมบัติตาม ว 34
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
class expV34 extends utility{
    
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
		$this->period = $this->getPeriod();
		$this->strPosV14 = $this->getPosV14Group();
		$this->orderLevel = $this->getOrderLevel();
	}
	
	public function checkExp(){
			
		
		$sql = "SELECT salary.*,hr_addradub.orderby
	                  FROM ".$this->dbNow.".salary AS salary 
			          LEFT JOIN ".$this->dbMaster.".hr_addradub AS hr_addradub ON hr_addradub.level_id = salary.level_id
			          WHERE salary.id = '".$this->idcard."' AND
			                salary.date <= '".$this->startDateTh."' AND
				            salary.date != '' AND
				            hr_addradub.orderby < '".$this->orderLevel."' AND
				            salary.position_id IN(".$this->strPosV14.")
		              GROUP BY salary.position_id
		              ORDER BY salary.date,hr_addradub.orderby ";
	    $query = mysql_db_query($this->dbNow,$sql)or die(mysql_error());
		while($rows = mysql_fetch_array($query)){
	       ##find start date
	       $sqlStart = "SELECT runno,date 
	                    FROM salary 
					    WHERE id = '".$this->idcard."' AND 
					          position_id = '".$rows['position_id']."' AND 
						      date != '' 
				        ORDER BY date ASC 
				        LIMIT 0,1 ";
	       $queryStart = mysql_db_query($this->dbNow,$sqlStart)or die(mysql_error());
	       $rowsStart = mysql_fetch_array($queryStart);
	   
	       $arrPosition[$rows['position_id']] = $rowsStart['date'];
	       $arrPositionName[$rows['position_id']] = $rows['position'];
	       $arrLevelId[$rows['position_id']] = $rows['level_id'];
	       $arrLevelName[$rows['position_id']] = $rows['radub'];
	       $arrRunId[$rows['position_id']] = $rows['runid'];
	       $arrDateStart[] = $rowsStart['date'];
	       $arrPositionId[] = $rows['position_id'];
	   
	    }##end while
		$lenPos = (count($arrPositionId)-1);
        for($i=$lenPos;$i>=0;$i--){
	        $arrPositionRe[$arrPositionId[$i]] = $arrDateStart[$i];
	        $arrDateStartRe[] = $arrDateStart[$i];
        }
	   
	    #Array Sort
	    @arsort($arrPositionRe);
        @rsort($arrDateStartRe);
		
		
	    ##start loop to check experience
	    $arrDateEnd = explode("-",$this->startDate);
	    $mkDateEnd = (mktime(0,0,0,$arrDateEnd[1],$arrDateEnd[2],$arrDateEnd[0]) - 86400);
	    $dateEndAll = date('Y-m-d',$mkDateEnd);
	    $i = 0;
	    if(count($arrPositionRe) > 0){
           foreach($arrPositionRe as $positionId=>$dateStart){
	  
	              ##convert date format
	              $dateStartPosition = $this->dateConvert($dateStart,'th-en-ymd');

	              $this->arrDataExp[$i]['runId'] = $arrRunId[$positionId];
	              $this->arrDataExp[$i]['positionId'] = $positionId;
	              $this->arrDataExp[$i]['positionName'] = $arrPositionName[$positionId];
	              $this->arrDataExp[$i]['levelId'] = $arrLevelId[$positionId];
	              $this->arrDataExp[$i]['levelName'] = $arrLevelName[$positionId];
	              $this->arrDataExp[$i]['dateStartPosition'] = $this->dateConvert($dateStartPosition,'en-th-ddmmyy');
	  
	              if($i==0){
	                   $dateEndPosition = $dateEndAll;
	              }else{
	                   $arrDateEnd = explode("-",$arrDateStartRe[$i-1]);
	                   $mkDateEnd = (mktime(0,0,0,$arrDateEnd[1],$arrDateEnd[2],($arrDateEnd[0]-543))) - 86400;
	                   $dateEnd = date('Y-m-d',$mkDateEnd);
		               $dateEndPosition = $dateEnd;
	              }
	  
	              $this->arrDataExp[$i]['dateEndPosition'] = $this->dateConvert($dateEndPosition,'en-th-ddmmyy');
	  
	              $arrPeriodPosition = $this->getPeriodReal($dateStartPosition,$dateEndPosition);
	              $strPeriodPosition = $this->splitDate($arrPeriodPosition);
	              $arrPeriodPositionAll = $this->getPeriodReal($dateStartPosition,$dateEndAll);
	              $strPeriodPositionAll = $this->splitDate($arrPeriodPositionAll);
	              $this->arrDataExp[$i]['strPeriodPosition'] = $strPeriodPosition;
	              $this->arrDataExp[$i]['strPeriodPositionAll'] = $strPeriodPositionAll;
	  
	              if($arrPeriodPositionAll[0] >= $this->period){
	                 break;
	              }
	  
	             $i++;
	      }## end loop
	    }else{
		  return false;
		}
		
		 
	    if($arrPeriodPositionAll[0] >= $this->period){
	       return true;
	    }else{
	       return false;
	    }
		
						  
	 
	  
	}
	
	public function getPosV14Group(){
	    
		$sqlGroup = "SELECT v14group FROM hr_addposition_now WHERE pid = '".$this->positionId."' ";
		$queryGroup = mysql_db_query($this->dbMaster,$sqlGroup)or die(mysql_error());
		$rowsGroup = mysql_fetch_array($queryGroup);
		
		$sqlPos = "SELECT pid FROM hr_addposition_now WHERE v14group = '".$rowsGroup['v14group']."'  ";
		$queryPos = mysql_db_query($this->dbMaster,$sqlPos)or die(mysql_error());
		while($rowsPos = mysql_fetch_array($queryPos)){
			$arrPos[] = $rowsPos['pid'];
		}
		if(count($arrPos) > 0){
			$strPosV14 = implode(',',$arrPos);
		}else{
			$strPosV14 = '999';
		}
		
		return $strPosV14;
		 
	}
	
	
	 public function getOrderLevel(){
  
         $sqlOrder = "SELECT orderby FROM hr_addradub WHERE level_id = '".$this->levelId."'  ";
	     $queryOrder = mysql_db_query($this->dbMaster,$sqlOrder)or die(mysql_error());
	     $rowsOrder = mysql_fetch_array($queryOrder);
	
	     return $rowsOrder['orderby'];
	
    }
	
	  public function showExp(){
           echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;"><font color="#000000">';
           echo "<font color=\"#6A3500\"><b>เงื่อนไข :</b>ระยะเวลาขั้นต่ำในการดำรงตำแหน่งหรือเคยดำรงตำแหน่งในสายงานเมื่อเทียบกับวุฒิการศึกษา <font color=\"#000000\"><b>".$this->period."</b></font> ปี</font>";
           echo '</div>';
           if(count($this->arrDataExp) > 0){
              echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\">";
	          foreach($this->arrDataExp as $key=>$value){
                  echo "<tr>";
                  echo "<td width=\"25%\">".$value['positionName']."</td>";
		          echo "<td width=\"15%\">ระดับ ".$value['levelName']."</td>";
                  echo "<td width=\"20%\">".$value['dateStartPosition']."</td>";
                  echo "<td width=\"20%\">".$value['dateEndPosition']."</td>";
                  echo "<td width=\"20%\">".$value['strPeriodPosition']."</td>";
                  echo "</tr>";
	              $strPeriodPositionAll = $value['strPeriodPositionAll'];
	          }
              echo "<tr>";
              echo "<td colspan=\"5\"><b>ประสบการณ์ดำรงตำแหน่ง เท่ากับ </b>".$strPeriodPositionAll."</td>";
              echo "</tr>";
              echo "</table>";
          }else{
              echo "<br><div style='border:1px solid #6A3500;color:#FFFF00; padding:3px;'><img src='images/exclamation.png' align='absmiddle' />&nbsp;ไม่พบข้อมูลตำแหน่ง</div>";
          }	 	
     }
	
}

//$objExp = new expV34('3100905096120','525471018','92255111','2011-04-01','30');
//$objExp->checkExp();
//$objExp->showExp();
?>