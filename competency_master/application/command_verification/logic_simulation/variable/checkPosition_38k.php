<?php
/**
* @comment class ตรวจสอบคำสั่ง
* @projectCode 58CMSS12
* @tor  -
* @package core
* @author Panupong
* @access private
* @created 02/04/2558
*/

class checkPosition_38k extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ตรวจสอบตำแหน่่งต้องเป็นไปตามมาตรฐานตำแหน่งของข้าราชการครูและบุคลากรทางการศึกษา ตามมาตรา 38ค.(2)</font>";
		echo '</div>';
			
	}
	
}

?>