<?php
/**
* @comment class ตรวจสอบการเลื่อนขั้นเงินเดือน กรณีเกษียณอายุราชการ
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Eakkasit Kamwong
* @access private
* @created 02/04/2014
*/

class checkUpSalaryRetire extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ตรวจสอบการพิจารณาเลื่อนขั้นเงินเดือน กรณีเกษียณอายุราชการตามกฎหมายว่าด้วยบำเหน็จบำนาญข้าราชการ ให้เลื่อนขั้นเงินเดือนในวันที่  30 กันยายนของครึ่งปีสุดท้ายก่อนที่จะพ้นจากราชการ</font>";
		echo '</div>';
			
	}
	
}

?>