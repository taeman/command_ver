<?php
/**
* @comment class ตรวจสอบกฎหมายมาตรา 43
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Eakkasit Kamwong
* @access private
* @created 02/04/2014
*/

class law43 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ตรวจสอบการดำเนินการกรณีที่ข้าราชการครูฯได้รับคุณวุฒิเพิ่มขึ้นในระหว่างทดลองปฎิบัติราชการ และเป็นกรณีที่ต้องดำเนินการปรับปรุงการกำหนดตำแหน่ง เลื่อนและแต่งตั้งให้ดำรงตำแหน่ง ให้พิจารณาดำเนินการในระหว่างทดลองปฎิบัติราชการได้ โดยจะเริ่มทดลองปฎิบัติหน้าที่ราชการในตำแหน่งที่ได้รับแต่งตั้งใหม่ ตามมาตรา 43 หรือเป็นไปตามหลักเกณฑ์และวิธีการที่ ก.ค.ศ.กำหนด</font>";
		echo '</div>';
			
	}
	
}

?>