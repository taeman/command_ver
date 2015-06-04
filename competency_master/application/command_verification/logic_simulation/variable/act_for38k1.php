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

class act_for38k1 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>การแต่งตั้งให้รักษาการในตําแหน่งบุคลากรทางการศึกษาอื่น ตามมาตรา 38 ค. (2) อาจแต่งตั้งไว้ก่อนล่วงหน้าได้ </font>";
		echo '</div>';
			
	}
	
}

?>