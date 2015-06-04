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

class check_up_qualification extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ตรวจสอบว่ามีการยื่นเรื่องขอเพิ่มวุฒิในทะเบียนประวัติ(ก.พ.7) หรือขอใช้วุฒิภายในระยะเวลาที่กำหนด แต่ไม่ได้ยื่นคำขอให้ได้รับเงินเดือน และ/หรือปรับปรุงการกำหนดตำแหน่งตามวุฒิ ให้ถือว่าการขอเพิ่มวุฒิ และ/หรือขอใช้วุฒิดังกล่าวเป็นการขอให้ได้รับเงินเดือนและ/หรือปรับปรุงการกำหนดตำแหน่ง เลื่อนและแต่งตั้งให้ดำรงตำแหน่งตามวุฒิที่ยื่นขอเพิ่ม</font>";
		echo '</div>';
			
	}
	
}

?>