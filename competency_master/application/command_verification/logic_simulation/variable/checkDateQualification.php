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

class checkDateQualification extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ตรวจสอบการได้รับคุณวุฒิเพิ่มขึ้นในระหว่างทดลองปฎิบัติราชการ และเป็นกรณีที่สั่งให้ได้รับเงินเดือนตามคุณวุฒิที่เพ่ิมขึ้นอย่างเดียว ให้พิจารณาสั่งให้ได้รับเงินเดือนตามคุณวุฒิที่ได้รับเพิ่มขึ้นในระหว่างทดลองปฎิบัติราชการ</font>";
		echo '</div>';
			
	}
	
}

?>