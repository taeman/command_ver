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

class position_equivalent_vitaya extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ให้ตรวจสอบข้อมูลตามตารางเทียบตำแหน่งตาม หนังสือสำนักงาน ก.ค.ศ. ที่ ศธ 0206.3/ว1 ลงวันที่ 5 ม.ค. 2549 ตำแหน่งอื่น ที่ ก.ค.ศ. เทียบเท่าเป็นคุณสมบัติสำหรับวิทยฐานะ</font>";
		echo '</div>';
			
	}
	
}

?>