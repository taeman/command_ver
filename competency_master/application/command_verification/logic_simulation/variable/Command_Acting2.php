<?php
/**
* @comment class คำแนะนำตามกฎหมายมาตรา 54
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Pinya
* @access private
* @created 29/09/2014
*/

class Command_Acting2 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ให้ตรวจสอบต้องเป็นไปตามมาตรฐานวิทยฐานะตามมาตรา 42 ซึ่งผ่านการประเมิน </font>";
		echo '</div>';
			
	}
	
}

?>