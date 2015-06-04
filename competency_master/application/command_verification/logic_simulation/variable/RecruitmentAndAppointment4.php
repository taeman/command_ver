<?php
/**
* @comment class ตรวจสอบเหตุผลการออกจากราชการก่อนกลับมาบรรจุใหม่
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Pinya
* @access private
* @created 29/09/2014
*/

class RecruitmentAndAppointment4 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ต้องไม่เป็นผู้ที่ออกจากราชการในระหว่างทดลองปฏิบัติหน้าที่ราชการ หรือเตรียมความพร้อมและพัฒนาอย่างเข้ม  </font>";
		echo '</div>';
			
	}
	
}

?>