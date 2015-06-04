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

class Quit_Government38k9 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ให้ตรวจสอบสิทธิการรับบำเหน็จบำนาญข้าราชการตามพระราชบัญญัติบำเหน็จบำนาญข้าราชการ พ.ศ. 2494 และที่แก้ไขเพิ่มเติม หรือพระราชบัญญัติกองทุนบำเหน็จบำนาญข้าราชการพ.ศ. 2539 และที่แก้ไขเพิ่มเติม </font>";
		echo '</div>';
			
	}
	
}

?>