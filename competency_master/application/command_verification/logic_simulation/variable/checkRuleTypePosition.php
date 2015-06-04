<?php
/**
* @comment class ตรวจสอบคำสั่ง
* @projectCode 58CMSS12
* @tor  -
* @package core
* @author Panupong
* @access private
* @created 02/04/2558
*/

class checkRuleTypePosition extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ตรวจสอบการดำเนินการเป็นไปตาม กฏ ก.ค.ศ การจัดประเภทตำแหน่ง ระดับตำแหน่ง การให้ได้รับเงินเดือน และเงินประจำตำแหน่งของตำแหน่งบุคลากรทางการศึกษา พ.ศ. 2547 และที่แก้ไขเพิ่มเติม</font>";
		echo '</div>';
	}
	
}

?>