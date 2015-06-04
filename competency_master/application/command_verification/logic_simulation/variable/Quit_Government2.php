<?php
/**
* @comment class คำแนะนำของการออกจากราชการโดยไม่ผ่านการทดลองปฏิบัติหน้าที่ราชการหรือไม่ผ่านการเตรียมความพร้อมและพัฒนาอย่างเข้ม
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Pinya
* @access private
* @created 29/09/2014
*/

class Quit_Government2 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>การออกจากราชการโดยไม่ผ่านการทดลองปฏิบัติหน้าที่ราชการหรือไม่ผ่านการเตรียมความพร้อมและพัฒนาอย่างเข้ม สาระสําคัญคือ ผู้มีอํานาจตามมาตรา 53 ไม่รับรองความประพฤติความรู้ความสามารถและความเหมาะสมกับตําแหน่งหน้าที่ หรือไม่ผ่านเกณฑ์การประเมิน </font>";
		echo '</div>';
			
	}
	
}

?>