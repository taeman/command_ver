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

class law56 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ตรวจสอบว่าการดำเนินการบรรจุและแต่งตั้งให้เข้ารับราชการเป็นข้าราชการครูและบุคลากรทางการศึกษาและแต่งตั้งให้ดํารงตําแหน่งให้ทดลองปฏิบัติหน้าที่ราชการในตําแหน่งนั้น แต่ถ้าผู้ใดได้รับการบรรจุและแต่งตั้งในตําแหน่งครูผู้ช่วย ให้ผู้นั้นเตรียมความพร้อมและพัฒนาอย่างเข้มเป็นเวลาสองปีก่อนแต่งตั้งให้ดํารงตําแหน่งครูทั้งนี้การทดลองปฏิบัติหน้าที่ราชการและการเตรียมความพร้อมและพัฒนาอย่างเข้ม ให้เป็นไป ตามหลักเกณฑ์และวิธีการที่ก.ค.ศ. กําหนด</font>";
		echo '</div>';
			
	}
	
}

?>