<?php
/**
 * @comment โปรแกรมตรวจสอบตรรกะตามมาตรา 53
 * @projectCode 57CMSS10
 * @tor 10.2.1.5
 * @package core
 * @author Jullachai
 * @access public
 * @created 01/10/2014
 */
if($_GET['action']=="chk"){
	include "../../../../config/conndb_nonsession.inc.php";
	require_once("../class/class.utility.php");
}
/**
 * ระยะการปฏิบัติงาน ณ หน่วยงานปัจจุบัน (เดือน)
 *
 * @author  -
 * @copyright 2011 Sapphire
 * @description ระยะการปฏิบัติงาน ณ หน่วยงานปัจจุบัน (เดือน)
 * @param string $idcard, เลขบัตรประจำตัวประชาชน, 3180500030751 
 * @param integer $schoolid, รหัสหน่วยงานที่สังกัด, 5001
 * @param date $startDate, วันที่มีผล, 2010-04-21
 * @return integer
 "
 */
class law53 extends utility{
  public $position_id;
  public $position_signer_id;
  public $vitaya_id;
  public $schoolid;
  public $siteid;
  public $arrDataExp = array();
  protected $comment;
  
/**
 * @param string $position_id
 * @param string $position_signer_id
 * @param string $vitaya_id
 * @param string $schoolid
 * @param string $siteid
 */
public function __construct($position_id="",$position_signer_id="",$vitaya_id="",$schoolid="",$siteid=""){
	$this->position_id = $position_id;
	$this->position_signer_id = $position_signer_id;
	$this->vitaya_id = $vitaya_id;
	$this->schoolid = $schoolid;
	$this->siteid = $siteid;
}
  
 /**
 *
 * @return boolean
 */ 
public function checkExp(){	

	if($this->position_signer_id=="")
		return false;
	
	if($this->vitaya_id == 4){ #1
		if($this->getHighestPositionInSite($this->siteid) == $this->position_signer_id)
			return true;
		$this->comment = "ให้ผู้บังคับบัญชาสูงสุดของส่วนราชการที่สั่งกัด เป็นผู้มีอำอาจสั่งบรรจุ";
	}else if($this->position_id == '125471009' || $this->position_id == '125471008'){ #2
		$this->comment = "ให้เลขาธิการคณะกรรมการการศึกษาขั้นพื้นฐานเป็นผู้มีอำนาจสั่งบรรจุ";
		return true;
	}else if( ($this->siteid != $this->schoolid) && ($this->position_id == '425471000' || $this->position_id == '425471006' || substr($this->position_id,0,1) == 5)){ #4
		if( $this->position_signer_id == '325471008')
			return true;
		$this->comment = "ให้ผู้อำนวยการสถานศึกษาเป็นผู้มีอำนาจสั่งบรรจุและแต่งตั้ง";
	}else if($this->position_id == '325471008' || $this->position_id == '325471010' || $this->position_id == '225471000' 
	|| substr($this->position_id,0,1) == 5 || substr($this->position_id,0,1) == 6 
	|| $this->vitaya_id == 1 || $this->vitaya_id == 2 || $this->vitaya_id == 3 ){ #3
		if( $this->position_signer_id == '125471008')
			return true;
		$this->comment = "ให้ผู้อำนวยการสำนักงานเขตพื้นที่การศึกษามีอำนาจสั่งบรรจุและแต่งตั้ง";
	}else{
		if($this->getHighestPositionInSite($this->siteid) == $this->position_signer_id)
			return true;
		$this->comment = "ให้ผู้บังคับบัญชาสูงสุดของส่วนราชการที่สั่งกัด เป็นผู้มีอำอาจสั่งบรรจุ";
	}
	return false;
		
}	// end public function checkExp

//private function getHighestPositionInSite
//return position_id
private function getHighestPositionInSite($siteid){
	$sql = "SELECT pid
			FROM view_general
			INNER JOIN cmss_master.hr_addposition_now USING(pid)
			WHERE status_active='yes'
			ORDER BY orderby
			LIMIT 1";
	$rs = mysql_db_query('cmss_'.$siteid,$sql);
	$row = mysql_fetch_assoc($rs);
	
	return $row['pid'];
}	// end private function getHighestPositionInSite

public function getPosition($pid){
	$sql = "SELECT position
			FROM hr_addposition_now
			WHERE pid='$pid'";
	$rs = mysql_db_query('cmss_master',$sql);
	$row = mysql_fetch_assoc($rs);
	
	return $row['position'];
}

private function getVitaya($vitaya_id){
	$sql = "SELECT vitayaname
			FROM vitaya
			WHERE runid=$vitaya_id";
	$rs = mysql_db_query('cmss_master',$sql);
	$row = @mysql_fetch_assoc($rs);
	
	return $row['vitayaname'];
}
  
  /**
  * แสดงระยะการปฏิบัติงาน ณ หน่วยงานปัจจุบัน (เดือน)
 *
 * @return string
 */
public function showExp(){
	//echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#002D00;padding:5px;"><font color="#FFFFFF">';
	//echo "<font color=\"#FFCC00\"><b>เงื่อนไข :</b> ประสบการณ์ไม่น้อยกว่า <font color=\"#ffffff\"><b>".$this->periodExp."</b></font> ปี</font>";
	//echo '</div>';
	$strTempSchool="";
	if($this->arrDataExp[SCHOOL_OLD]!=""){
			$strTempSchool="(".$this->arrDataExp[SCHOOL_OLD].")";
	}
	
	echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
	echo "<font color=\"#6A3500\"><b>เงื่อนไข :</b>ตรวจสอบเมื่อใช้ในระบบสร้างคำสั่งหรือตรวจสอบคำสั่งไม่สามารถประมวลกรณีใช้ในระบบเลขาฯ โดยให้ตรวจสอบผู้มีอำนาจลงนาม กรณีครูมีวิทยฐานะ ผอ.สพท. ลงนาม ไม่มีวิทยฐานะผอ.สถานศึกษา</font>";
	echo '</div><br/>';
	echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\">";		
	echo "<tr>";
	echo "<td colspan=\"5\"><b>ตำแหน่งที่ได้รับการบรรจุ </b>".($this->position_id==""?"ไม่พบตำแหน่งที่ได้รับการบรรจุ":$this->getPosition($this->position_id)."(".$this->getVitaya($this->vitaya_id).")")."</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td colspan=\"5\"><b>ตำแหน่งผู้ลงนาม  </b>".($this->position_signer_id==""?"ไม่พบตำแหน่งผู้ลงนาม":$this->getPosition($this->position_signer_id))."</td>";
	echo "</tr>";
	echo "<tr>";
	if($this->comment != "")
	echo "<td colspan=\"5\" style='color:red;'>".$this->comment."</td>";
	echo "</tr>";
	echo "</table>";
}	// end public function showExp

  
} 


if($_GET['action']=="chk"){
	$position_id="525471018";
	$position_signer_id="125471008";
	$vitaya_id="1";
	$schoolid="5002";
	$siteid="5002";
	$temp=new law53($position_id,$position_signer_id,$vitaya_id,$schoolid,$siteid);
	echo $temp->checkExp();
	echo "<br>";
	
	echo "<pre>";
	print_r($temp->arrDataExp);
	echo "<pre>";
	
	echo "<br>";
	echo $temp->showExp();
}
?>













