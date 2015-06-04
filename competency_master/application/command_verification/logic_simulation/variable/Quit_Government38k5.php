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

class Quit_Government38k5 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>เมื่อข้าราชการครูและบุคลากรทางการศึกษาผู้ใดไปรับราชการทหารตามกฎหมายว่าด้วยการรับราชการทหาร ให้ผู้มีอำนาจตามมาตรา ๕๓ สั่งให้ผู้นั้นออกจากราชการผู้ใดถูกสั่งให้ออกจากราชการตามวรรคหนึ่ง และต่อมาปรากฏว่าผู้นั้นมีกรณีที่จะต้องถูกสั่งให้ออกจากราชการตามมาตราอื่นอยู่ก่อนไปรับราชการทหาร ก็ให้ผู้มีอำนาจตามมาตรา ๕๓ มีอำนาจเปลี่ยนแปลงคำสั่งให้ออกจากราชการตามวรรคหนึ่ง เป็นให้ออกจากราชการตามมาตราอื่นนั้นได้</font>";
		echo '</div>';
			
	}
	
}

?>