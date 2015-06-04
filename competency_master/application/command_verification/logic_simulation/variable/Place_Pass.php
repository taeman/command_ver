<?php
/**
* @comment class ตรวจสอบคำสั่ง
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Maiphrom
* @access private
* @created 02/04/2015
*/

class Place_Pass extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ตรวจสอบว่าการดำเนินการนำรายชื่อผู้สอบแข่งขันได้ในบัญชีหนึ่งไปขึ้นบัญชีเป็นผู้สอบแข่งขันได้ในบัญชีอื่นสำหรับตำแหน่งครูผู้ช่วย และตำแหน่งบุคลากรทางการศึกษาอื่นตามมาตรา 38 ค.(2) เป็นไปตามหลักเกณฑ์วิธีการที่ ก.ค.ศ. กำหนด</font>";
		echo '</div>';
			
	}
	
}

?>