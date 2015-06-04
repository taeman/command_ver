<?php
/**
* @comment class ตรวจสอบคำสั่ง
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Pinya
* @access private
* @created 16/03/2015
*/

class Quit_Government38k10 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>กรณีให้ออกจากราชการ ให้ระบุสิทธิในการอุทธรณ์ ร้องทุกข์ ตามพระราชบัญญัติวิธีปฏิบัติราชการทางปกครอง พ.ศ. 2539 ไว้ท้ายคำสั่งด้วย </font>";
		echo '</div>';
			
	}
	
}

?>