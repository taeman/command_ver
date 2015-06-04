<?php
/**
* @comment class คำแนะนำ ว 20/12 พฤศจิกายน 2552 (การโอนพนักงานส่วนท้องถิ่นและข้าราชการอื่นมาบรรจุและแต่งตั้งเป็นข้าราชการครูและบุคลากรทางการศึกษา)
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Eakkasit Kamwong
* @access private
* @created 02/04/2014
*/

class W20Transfer extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ตรวจสอบว่าการดำเนินการเตรียมความพร้อมและวิธีการโอนพนักงานส่วนท้องถิ่นและข้าราชการอื่นมาบรรจุและแต่งตั้งเป็นข้าราชการและบุคลากรทางการศึกษาให้เป็นไปตามหลักเกณฑ์ที่ ก.ค.ศ. กำหนด</font>";
		echo '</div>';
			
	}
	
}

?>