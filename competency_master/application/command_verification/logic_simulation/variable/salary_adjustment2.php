<?php
/**
* @comment class คำแนะนำที่สั่งให้ข้าราชการครูได้รับเงินเดือน
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Pinya
* @access private
* @created 29/09/2014
*/

class salary_adjustment2 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>กรณีที่จะสั่งให้ข้าราชการครูได้รับเงินเดือน ในกรณีที่ได้รับคุณวุฒิเพิ่มขึ้น ในวันที่ 1 ตุลาคม ให้สั่งข้าราชการครูผู้นั้นได้รับเงินเดือน ตามคุณวุฒิที่ได้รับเพิ่มขึ้นก่อนการเลื่อนเงินเดือน </font>";
		echo '</div>';
			
	}
	
}

?>