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

class CheckPos3 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ตรวจสอบกรณีการเปลี่ยนตำแหน่ง มี 3 กรณี ดังนี้
		<br>1. กรณีเปลี่ยนตามความสมัครใจ
		<br>2. กรณีเปลี่ยนเพื่อประโยชน์ทางราชการ
		<br>3. กรณีเปลี่ยนเพราะถูกพักใช้ใบอนุญาตประกอบวิชาชีพ
		</font>";
		echo '</div>';
			
	}
}

?>