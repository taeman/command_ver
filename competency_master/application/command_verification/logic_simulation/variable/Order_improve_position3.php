<?php
/**
* @comment class คำแนะนำของการปรับปรุงการกําหนดตําแหน่งครูผู้ช่วยผู้ซึ่งผ่านการเตรียมความพร้อมและพัฒนาอย่างเข้ม
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Pinya
* @access private
* @created 29/09/2014
*/

class Order_improve_position3 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>เป็นการปรับปรุงการกําหนดตําแหน่งครูผู้ช่วยผู้ซึ่งผ่านการเตรียมความพร้อมและพัฒนาอย่างเข้ม ตามหลักเกณฑ์และวิธีการที่ก.ค.ศ. กําหนด เป็นตําแหน่งครู </font>";
		echo '</div>';
			
	}
	
}

?>