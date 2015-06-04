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

class order_to_other_government38k2 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>การสั่งให้ประจำส่วนราชการหรือสำนักงานเขตพื้นที่การศึกษา กรณีที่ผู้ดำรงตำแหน่งที่มีวิทยฐานะ หากไปประจำส่วนราชการหรือสำนักงานเขตพื้นที่การศึกษา หากให้ปฏิบัติหน้าที่ที่ไม่มีวิทยฐานะให้งดเบิกจ่ายเงินวิทยฐานะ </font>";
		echo '</div>';
			
	}
	
}

?>