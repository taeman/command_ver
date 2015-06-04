<?php
/**
* @comment class ตรวจสอบการเลื่อนขั้นเงินเดือน กรณีพ้นจากราชการเพราะเกษียณอายุก่อนจะมีคำสั่งเลื่อนขั้นเงินเดือน
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Eakkasit Kamwong
* @access private
* @created 02/04/2014
*/

class checkUpSalaryRetireBFUpsalary extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ตรวจสอบกรณีที่พ้นจากราชการเพราะเกษียณอายุตามกฎหมายว่าด้วยบำเหน็จบำนาญไปก่อนที่จะมีคำสั่งเลื่อนขั้นเงินเดือน ให้เลื่อนขั้นเงินเดือนย้อนหลังไปถึงวันที่ 30 กันยายน ของครึ่งปีสุดท้ายที่จะได้เลื่อน</font>";
		echo '</div>';
			
	}
	
}

?>