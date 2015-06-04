<?php
/**
* @comment class คำแนะนำของครูผู้ช่วยที่จะได้รับแต่งตั้งให้ดำรงตำแหน่งครู
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Pinya
* @access private
* @created 29/09/2014
*/

class assistant_to_teacher1 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ครูผู้ช่วยที่จะได้รับแต่งตั้งให้ดำรงตำแหน่งครู จะต้องเป็นผู้ผ่านเกณฑ์การประเมินการเตรียมความพร้อมและพัฒนาอย่างเข้ม ตามหลักเกณฑ์ที่ ก.ค.ศ. กำหนด </font>";
		echo '</div>';
			
	}
	
}

?>