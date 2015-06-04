<?php
/**
* @comment class คำแนะนำของการออกจากราชการที่ขาดคุณสมบัติตามมาตรา 30
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Pinya
* @access private
* @created 29/09/2014
*/

class Quit_Government1 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>การออกจากราชการกรณีขาดคุณสมบัติทั่วไปตามมาตรา 30 ขาดคุณสมบัติตามมาตรฐานตําแหน่งและขาดคุณสมบัติพิเศษ ให้ผู้มีอํานาจตามมาตรา 53 สั่งให้ผู้นั้นออกจากราชการโดยพลัน </font>";
		echo '</div>';
			
	}
	
}

?>