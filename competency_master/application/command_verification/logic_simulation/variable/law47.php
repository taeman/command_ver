<?php
/**
* @comment class ตรวจสอบกฎหมายมาตรา 47
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Eakkasit Kamwong
* @access private
* @created 02/04/2014
*/

class law47 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ตรวจสอบการดำเนินการที่ข้าราชการครูได้รับการปรับปรุงการกำหนดตำแหน่ง เลื่อนและแต่งตั้งให้ดำรงตำแหน่ง กรณีที่ได้รับคุณวุฒิเพิ่มขึ้น ให้เป็นการเลื่อนและแต่งตั้งให้ดำรงตำแหน่งซึ่งได้รับเงินเดือนในระดับที่สูงขึ้น โดยวิธีการคัดเลือก และ/หรือปรับปรุงตามมาตรา 47 </font>";
		echo '</div>';
			
	}
	
}

?>