<?php
//include "../../../../config/conndb_nonsession.inc.php";
//include "../class/class.utility.php";

/**
 *เช็คประวัติการทดลองปฏบัติราชการ
 *
 * @author  -
 * @copyright 2011 Sapphire
 * @description ตรวจสอบระยะเวลาการทดลองปฏิบัติราชการ
 * @param string $idcard, เลขบัตรประจำตัวประชาชน
 * @param integer $positionId, รหัสตำแหน่งที่เลื่อน
 * @param integer $levelId, รหัสระดับที่เลื่อน
 * @param date $startDate, วันที่มีผล
 * @param integer $periodExp, ระยะเวลาการทดลองงาน
 * @return boolean
 "
 */
class expProbation extends utility{
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
  public $errMsg;
  
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
	$this->probationDate = $this->getProbationDate();
	$this->probationPassDate = $this->getProbationPassDate();
	$this->periodExp = 6;
	   
  }

  public function checkExp(){
	if($this->probationPassDate != ''){ 
	  $arrPeriodProbation = $this->getPeriodReal($this->probationDate,$this->probationPassDate);
	  $this->strPeriodProbation = $this->splitDate($arrPeriodProbation);
	  if((int)$arrPeriodProbation[0] > 0){
		  return true;
	  }else{
	     if((int)$arrPeriodProbation[1] >= $this->periodExp){
		     return true;
	     }else{
			 $this->errMsg = "ระยะเวลาทดลองปฏิบัติหน้าที่ราชการไม่ถึง ".$this->periodExp." เดือน";
	         return false;
	     }
	  }
	}else{
	  $this->errMsg = "ระบบไม่พบคำสั่งพ้นจากการทดลองปฏิบัติหน้าที่ราชการ <br><b><em><u>ข้อแนะนำ</u></em></b> กรุณาตรวจสอบข้อมูลในทะเบียนประวัติ กพ.7 โดยละเอียดอีกครั้ง";	
	  return false;	
	}
  }
  
  public function getProbationDate(){
        $sql = "SELECT position,date FROM salary 
		        WHERE id = '".$this->idcard."' AND 
				      date != '' AND
					  date NOT LIKE '%--%' AND
					  date NOT LIKE '-%' AND
					  date NOT LIKE '%-'
				ORDER BY date
				LIMIT 0,1 ";
		$query = mysql_db_query($this->dbNow,$sql)or die(mysql_error());
		$rows = mysql_fetch_array($query);
		$this->positionStart = $rows['position'];
		return $this->dateConvert($rows['date'],'th-en-ymd');		
  }
  
  public function getProbationPassDate(){
	    $sql = "SELECT runno,position,date FROM salary 
		        WHERE id = '".$this->idcard."' AND 
				      date != '' AND
					  date NOT LIKE '%--%' AND
					  date NOT LIKE '-%' AND
					  date NOT LIKE '%-' AND
					  (order_type = '9' OR
					   noorder LIKE '%พ้น%ทดลอง%' OR 
	                   pls LIKE '%พ้น%ทดลอง%' OR 
		               label_salary LIKE '%พ้น%ทดลอง%' OR 
		               label_dateorder LIKE '%พ้น%ทดลอง%' OR 
		               label_noposition LIKE '%พ้น%ทดลอง%' OR 
					   noorder LIKE '%ครบ%ทดลอง%' OR 
	                   pls LIKE '%ครบ%ทดลอง%' OR 
		               label_salary LIKE '%ครบ%ทดลอง%' OR 
		               label_dateorder LIKE '%ครบ%ทดลอง%' OR 
		               label_noposition LIKE '%ครบ%ทดลอง%' OR
					   noorder LIKE '%ทดลอง%ครบ%' OR 
	                   pls LIKE '%ทดลอง%ครบ%' OR 
		               label_salary LIKE '%ทดลอง%ครบ%' OR 
		               label_dateorder LIKE '%ทดลอง%ครบ%' OR 
		               label_noposition LIKE '%ทดลอง%ครบ%')
				ORDER BY date
				LIMIT 0,1 ";	
		$query = mysql_db_query($this->dbNow,$sql)or die(mysql_error());
		$rows = mysql_fetch_array($query);
		if($rows['date'] != ''){
		 return $this->dateConvert($rows['date'],'th-en-ymd');
		}
  }
  
  public function getExp(){
    return $this->arrDataExp;
  }
  
  public function showExp(){
	echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;"><font color="#000000">';
    echo "<font color=\"#6A3500\"><b>เงื่อนไข :</b> ไม่อยู่ระหว่างทดลองปฏิบัติหน้าที่ราชการหรือการเตรียมความพร้อมและพัฒนาอย่างเข้ม และ เมื่อบรรจุแต่งตั้งต้องทดลองปฏิบัติหน้าที่ราชการไม่น้อยกว่า <font color=\"#000000\"><b>".$this->periodExp."</b></font> เดือน</font>";
    echo '</div>';

    echo '<table width="100%" border="0" cellspacing="0" cellpadding="3">';
    echo '<tr>';
    echo '<td width="38%" align="right"><strong>บรรจุเมื่อ : </strong></td>';
    echo '<td width="19%">'.$this->dateConvert($this->probationDate,'en-th-ddmmyy').'</td>';
    echo '<td width="13%" align="right"><strong>ในตำแหน่ง :</strong></td>';
    echo '<td width="30%">'.$this->positionStart.'</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td align="right"><strong>ผ่านการทดลองปฏบัติราชการเมื่อ : </strong></td>';
    echo '<td>'; 
	  if($this->probationPassDate != ''){ echo $this->dateConvert($this->probationPassDate,'en-th-ddmmyy');} 
	echo '</td>';
    echo '<td align="right">&nbsp;</td>';
    echo '<td>&nbsp;</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td align="right"><strong>รวมระยะเวลาการทดลองปฏิบัติราชการทั้งหมด : </strong></td>';
    echo '<td>'.$this->strPeriodProbation.'</td>';
    echo '<td align="right">&nbsp;</td>';
    echo '<td>&nbsp;</td>';
    echo '</tr>';
    echo '</table>';
	if($this->errMsg != ''){
      echo '<div style="border:1px solid #800000; color:#FF0000; padding:3px;"><img src="images/error.png" align="absmiddle" />&nbsp;'.$this->errMsg.'</div><br>';
	}
  }
  
  
}

//$objExp = new expProbation('3110102422358','525471007','92255111','2009-12-11','6');
//$objExp->checkExp();
//$objExp->showExp(); 
?>