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

class checkDateRequest extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ตรวจสอบกรณีที่ข้าราชการครูฯไม่ยื่นคำขอภายในกำหนดเวลาตามหลักเกณฑ์ที่กำหนด ให้สั่งให้ข้าราชการครูฯได้รับเงินเดือน และ/หรือปรับปรุงการกำหนดตำแหน่ง เลื่อนและแต่งตังให้ดำรงตำแหน่ง กรณีทีไ่ด้รับวุฒิเพิ่มไม่น้อยกว่าวันที่ข้าราชการครูฯ ผู้นั้นยื่นคำขอ</font>";
		echo '</div>';
			
	}
	
}

?>