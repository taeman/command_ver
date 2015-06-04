<?php
/**
* @comment class ตรวจสอบกฎหมายมาตรา 73
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Eakkasit Kamwong
* @access private
* @created 02/04/2014
*/

class law73 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ตรวจสอบว่าการดำเนินการพิจารณาเลื่อน หรือไม่พิจารณาเลื่อนขั้นเงินเดือนข้าราชการครูและบุคลากรทางการศึกษา ให้เป็นไปตามหลักเกณฑ์และวิธีการเลื่อนขั้นเงินเดือนตามที่กฎ ก.ค.ศ. กำหนด และให้ผู้มีอำนาจตามมาตรา 53 เป็นผู้สั่งเลื่อนเงินเดือน</font>";
		echo '</div>';
			
	}
	
}

?>