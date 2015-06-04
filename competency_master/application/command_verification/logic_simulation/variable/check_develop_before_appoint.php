<?php
/**
* @comment class ตรวจสอบคำสั่ง
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Pinya
* @access private
* @created 29/03/2015
*/

class check_develop_before_appoint extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ให้ตรวจสอบข้อมูลว่าเป็นข้าราชการครูที่ได้รับการพัฒนาก่อนแต่งตั้งให้มีหรือเลื่อนเป็นวิทยฐานะชำนาญการพิเศษและวิทยฐานะเชี่ยวชาญ</font>";
		echo '</div>';
			
	}
	
}

?>