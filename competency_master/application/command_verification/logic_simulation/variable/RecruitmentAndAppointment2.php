<?php
/**
* @comment class ข้อเสนอแนะการขออนุมัติ ก.ค.ศ.
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Pinya
* @access private
* @created 29/09/2014
*/

class RecruitmentAndAppointment2 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>การขออนุมัติ ก.ค.ศ. ต้องผ่านการเห็นชอบของ อ.ก.ค.ศ.เขตพื้นที่การศึกษา หรือ อ.ก.ค.ศ. ที่ ก.ค.ศ. ตั้ง ก่อน
 เสนอขออนุมัติ ก.ค.ศ.  </font>";
		echo '</div>';
			
	}
	
}

?>