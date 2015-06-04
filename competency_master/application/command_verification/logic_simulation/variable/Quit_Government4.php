<?php
/**
* @comment class คำแนะนำของการออกจากราชการ กรณีเจ็บป่วย ต้องเป็นการเจ็บป่วยที่ไม่อาจปฏิบัติหน้าที่ราชการโดยสม่ำเสมอ
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Pinya
* @access private
* @created 29/09/2014
*/

class Quit_Government4 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>การออกจากราชการ กรณีเจ็บป่วย ต้องเป็นการเจ็บป่วยที่ไม่อาจปฏิบัติหน้าที่ราชการโดยสม่ำเสมอที่มีหลักฐานรับรอง เช่น ใบรับรองแพทย์ที่หน่วยงานราชการออกให้ใบลาป่วย เป็นต้น </font>";
		echo '</div>';
			
	}
	
}

?>