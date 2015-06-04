<?php
/**
* @comment class คำแนะนำของการสั่งให้ประจําส่วนราชการหรือสํานักงานเขตพื้นที่การศึกษา  กรณีที่ปฏิบัติหน้าที่ที่ไม่มีวิทยฐานะให้งดเบิกจ่ายเงินวิทยฐานะ
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Pinya
* @access private
* @created 29/09/2014
*/

class Ordered_personnel_government2 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>การสั่งให้ประจําส่วนราชการหรือสํานักงานเขตพื้นที่การศึกษา กรณีที่ผู้ดํารงตําแหน่งที่มีวิทยฐานะ หากไปประจําส่วนราชการ หน่วยงานหรือสํานักงานเขตพื้นที่การศึกษา หากให้ปฏิบัติหน้าที่ที่ไม่มีวิทยฐานะให้งดเบิกจ่ายเงินวิทยฐานะ </font>";
		echo '</div>';
			
	}
	
}

?>