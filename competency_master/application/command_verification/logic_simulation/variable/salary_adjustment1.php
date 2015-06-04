<?php
/**
* @comment class คำแนะนำของข้าราชการครูที่ยื่นคำขอให้ได้รับเงินเดือน
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Pinya
* @access private
* @created 29/09/2014
*/

class salary_adjustment1 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ข้าราชการครูผู้นั้นยื่นคำขอให้ได้รับเงินเดือน ในกรณีที่ได้รับคุณวุฒิเพิ่มขึ้นภายใน 60 วัน นับตั้งแต่วันที่สถานศึกษาให้หนังสือรับรองแสดงว่าสำเร็จการศึกษา </font>";
		echo '</div>';
			
	}
	
}

?>