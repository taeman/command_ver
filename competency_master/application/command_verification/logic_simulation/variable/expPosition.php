<?php
/**
 * ประสบการณ์ในตำแหน่ง
 *
 * @author  -
 * @copyright 2011 Sapphire
 * @description ประสบการณ์ในตำแหน่ง
 * @param string $idcard, เลขบัตรประจำตัวประชาชน, 3180500030751 
 * @param integer $positionId, รหัสตำแหน่งที่เลื่อน, 525471147
 * @param integer $levelId, รหัสระดับที่เลื่อน, 92255106
 * @param date $startDate, วันที่มีผล, 2010-04-21
 * @param integer $periodExp, ประสบการณ์ในตำแหน่ง(ปี), 1
 * @return boolean
 "
 */
class expPosition extends utility{
  public $idcard;
  public $positionId;
  public $levelId;
  public $startDate;
  public $startDateTh;
  public $siteNow;
  public $dbNow;
  public $positionLineAfter;
  public $orderLevel;
  public $periodExp;
  public $arrDataExp = array();
  protected $sql;
  
/**
 * @param string $idcard
 * @param string $positionId
 * @param string $levelId
 * @param string $startDate
 
 */
  public function __construct($idcard="",$positionId="",$levelId="",$startDate="",$periodExp=""){
    $this->idcard = $idcard;
	$this->positionId = $positionId;
	$this->levelId = $levelId;
	$this->startDate = $startDate;
	$this->periodExp = $periodExp;
	$this->siteNow = $this->getSiteNow($this->idcard);
	$this->dbNow = "cmss_".$this->siteNow;
	$this->startDateTh = $this->dateConvert($this->startDate,'en-th-ymd');
	
	
	#get Position Line
	$this->positionLineAfter = $this->getPositionLine();
	
	#get Position Lind Before
	/*$sqlLine = "SELECT match_pos.*,pos.position_line 
		        FROM ".$this->dbApp.".position_match_new AS match_pos
		        JOIN ".$this->dbMaster.".hr_addposition_now AS pos ON pos.pid = match_pos.pid_old
		        WHERE match_pos.pid_new = '".$this->positionId."' AND 
					        match_pos.level_id_new = '".$this->levelId."' AND
							match_pos.line_group = '".$this->positionLineAfter."' 
				GROUP BY pos.position_line ";*/
	$sqlLine = "SELECT position_line 
		        FROM hr_addposition_line
		        WHERE line_group = '".$this->positionLineAfter."' ";			
	if($_GET['debug'] == 'on'){
		echo "<pre>";
		echo $sqlLine;
		echo "</pre>";
		echo $this->positionLineAfter;
	}
	
	if($this->positionLineAfter == '1'){
		$this->positionLineName = 'สายวิชาการ';
	}elseif($this->positionLineAfter == '2'){
		$this->positionLineName = 'สายทั่วไป';
	}			
				
	$queryLine = mysql_db_query($this->dbMaster,$sqlLine)or die(mysql_error());
	while($rowsLine = mysql_fetch_array($queryLine)){
	   $this->arrPositionLine[] = $rowsLine['position_line'];
	}
	$this->strPositionLineBefore = implode(",",$this->arrPositionLine);			
	
	 
	#get Order Level
	$this->orderLevel = $this->getOrderLevel();
	##get List of Position 
	$this->sql = "SELECT salary.*,hr_addradub.orderby,hr_addposition_now.position_line_after 
	        FROM ".$this->dbNow.".salary AS salary 
			LEFT JOIN ".$this->dbMaster.".hr_addradub AS hr_addradub ON hr_addradub.level_id = salary.level_id
			LEFT JOIN ".$this->dbMaster.".hr_addposition_now AS hr_addposition_now ON hr_addposition_now.pid = salary.position_id
			WHERE salary.id = '".$this->idcard."' AND
			      salary.date <= '".$this->startDateTh."' AND
				  salary.date != '' AND
				  hr_addradub.orderby < '".$this->orderLevel."' AND
				  (hr_addposition_now.position_line_after = '".$this->positionLineAfter."' OR hr_addposition_now.position_line IN(".$this->strPositionLineBefore."))
		    GROUP BY salary.position_id
		    ORDER BY salary.date,hr_addradub.orderby ";	
	
	if($_GET['debug'] == 'on'){
		echo "<pre>";
		echo $this->sql;
		echo "</pre>";
	}			
	
	   
  }
  
  
  public function getPositionLine(){
  
    $sqlLine = "SELECT position_line_after FROM hr_addposition_now WHERE pid = '".$this->positionId."' ";
	$queryLine = mysql_db_query($this->dbMaster,$sqlLine)or die(mysql_error());
	$rowsLine = mysql_fetch_array($queryLine);
	
	return $rowsLine['position_line_after'];
	
  }
  
  
  public function getOrderLevel(){
  
    $sqlOrder = "SELECT orderby FROM hr_addradub WHERE level_id = '".$this->levelId."'  ";
	$queryOrder = mysql_db_query($this->dbMaster,$sqlOrder)or die(mysql_error());
	$rowsOrder = mysql_fetch_array($queryOrder);
	
	return $rowsOrder['orderby'];
	
  }
  
 /**
 * ตรวจสอบประสบการณ์ในตำแหน่ง
 *
 * @return boolean
 */ 
  public function checkExp(){
  
    $arrPosition = array();
	$arrPositionName = array();
	$arrDateStart = array();
	$arrPositionId = array();
	$arrLevelId = array();
	$arrLevelName = array();
	$arrRunId = array();
	
    
	  	    
	$query = mysql_db_query($this->dbNow,$this->sql)or die(mysql_error());
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
	   
	}
	
    $lenPos = (count($arrPositionId)-1);
    for($i=$lenPos;$i>=0;$i--){
	  $arrPositionRe[$arrPositionId[$i]] = $arrDateStart[$i];
	  $arrDateStartRe[] = $arrDateStart[$i];
    }
	if($_GET['debug'] == 'on'){
		echo "<pre>";
		print_r($arrPositionRe);
		echo "</pre>";
	}
	
	#Array Sort
	@arsort($arrPositionRe);
    @rsort($arrDateStartRe);
	
	##start loop to check experience
	$arrDateEnd = explode("-",$this->startDate);
	$mkDateEnd = (@mktime(0,0,0,$arrDateEnd[1],$arrDateEnd[2],$arrDateEnd[0]) - 86400);
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
	    $mkDateEnd = (@mktime(0,0,0,$arrDateEnd[1],$arrDateEnd[2],($arrDateEnd[0]-543))) - 86400;
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
	  
	  if($arrPeriodPositionAll[0] >= $this->periodExp){
	    break;
	  }
	  
	  $i++;
	 }## end loop
	} 
	if($arrPeriodPositionAll[0] >= $this->periodExp){
	   return true;
	}else{
	   return false;
	}	
				  			
  }
  
  /**
 * @return array
 */
  public function getExp(){
    return $this->arrDataExp;
  }
  
  /**
  * แสดงประสบการณ์ในตำแหน่ง
 *
 * @return string
 */
  public function showExp(){
   echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;"><font color="#000000">';
   echo "<font color=\"#6A3500\"><b>เงื่อนไข :</b> ประสบการณ์ในการดำรงตำแหน่งไม่น้อยกว่า <font color=\"#000000\"><b>".$this->periodExp."</b></font> ปี</font>";
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
    echo "<p>ไม่พบข้อมูลประสบการณ์การดำรงตำแหน่ง</p>";
   }	 	
  }
  
  
} 
?>