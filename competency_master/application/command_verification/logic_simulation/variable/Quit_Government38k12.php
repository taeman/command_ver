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

class Quit_Government38k12 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>การให้ออกจากราชการกรณีเจ็บป่วย ต้องเป็นการเจ็บป่วยที่ไม่อาจปฏิบัติหน้าที่ราชการ โดยสม่ำเสมอ ที่มีหลักฐานรับรอง เช่น ใบรับรองแพทย์ที่หน่วยงานราชการออกให้ ใบลาป่วย เป็นต้น </font>";
		echo '</div>';
			
	}
	
}

?>