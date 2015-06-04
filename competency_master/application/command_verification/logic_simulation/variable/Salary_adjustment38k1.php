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

class Salary_adjustment38k1 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ก.ค.ศ. มีมติให้นําหนังสือสํานักงาน ก.พ. ตามข้อ 2.6, 2.7, 2.8 มาใช้กับบุคลากรทางการศึกษาอื่นตามมาตรา38ค. (2) แล้วแต่ยังไม่ได้แจ้งให้หน่วยงานที่เกี่ยวข้องหรือปฏิบัติ  </font>";
		echo '</div>';
			
	}
	
}

?>