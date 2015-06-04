<?php
/**
* @comment class ตรวจสอบกฎหมายมาตรา 57
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Eakkasit Kamwong
* @access private
* @created 02/04/2014
*/

class law57 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ตรวจสอบว่าการดำเนินการเปลี่ยนตำแหน่ง การย้ายและการโอนข้าราชการครูและบุคลากรทางการศึกษา ให้เป็นไปตามหลักเกณฑ์วิธีการที่ ก.ค.ศ. กำหนด</font>";
		echo '</div>';
			
	}
	
}

?>