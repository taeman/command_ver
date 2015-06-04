<?php
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
				  hr_addposition_now.position_line_after = '".$this->positionLineAfter."'
		    GROUP BY salary.position_id
		    ORDER BY salary.date,hr_addradub.orderby ";
	
	   
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
  
  
  public function getExp(){
    return $this->arrDataExp;
  }
  
  
  public function showExp(){
   
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