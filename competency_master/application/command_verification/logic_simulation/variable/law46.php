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

class law46 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>มาตรา 46 ผู้สมัครสอบแข่งขันเพื่อบรรจุและแต่งตั้งเป็นข้าราชการครูและบุคลากรทางการศึกษาตําแหน่งใด ต้องมีคุณสมบัติทั่วไปตามมาตรา ๓๐และต้องมีคุณสมบัติเฉพาะสําหรับตําแหน่งตามมาตรฐานตําแหน่งนั้นตามมาตรา ๔๒
สําหรับผู้ดํารงตําแหน่งตามมาตรา ๓๐ (๔) และ (๘) ให้มีสิทธิ</font>";
		echo '</div>';
			
	}
	
}

?>