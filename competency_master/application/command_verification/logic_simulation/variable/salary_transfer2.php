<?php
/**
* @comment class ตรวจสอบคำสั่ง
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Supachai
* @access private
* @created 16/03/2015
*/

class salary_transfer2 extends utility{

		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ตรวจสอบการตัดโอนตำแหน่งและอัตราเงินเดือนจากส่วนราชการหนึ่งไปยังอีกส่วนราชการหนึ่ง เป็นการตัดตำแหน่งพร้อมทั้งโอนอัตราเงินเดือนจากส่วนราชการเดิมไปเพิ่มยังส่วนราชการหนึ่ง</font>";
		echo '</div>';
			
	}
	
}

?>