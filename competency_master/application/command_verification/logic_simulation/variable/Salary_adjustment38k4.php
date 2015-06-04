<?php
/**
* @comment class ตรวจสอบคำสั่ง
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Pinya
* @access private
* @created 16/03/2015
*/

class Salary_adjustment38k4 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>กรณีลาศึกษาจะได้รับการปรับเงินเดือนตามคุณวุฒิที่ได้รับเพิ่มขึ้นหรือสูงขึ้นต้องไม่ก่อนวันที่กลับเข้าปฏิบัติราชการ และต้องไม่ก่อนวันที่ได้รับคุณวุฒิเพิ่มขึ้นหรือสูงขึ้นด้วย </font>";
		echo '</div>';
			
	}
	
}

?>