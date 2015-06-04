<?php
/**
* @comment class ตรวจสอบการกำหนดตำแหน่งครูผู้ช่วยที่ผ่านการเตรียมความพร้อมและพัฒนาอย่างเข้ม เป็นตำแหน่งครู
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Eakkasit Kamwong
* @access private
* @created 02/04/2014
*/

class checkPositionTeachAstReadyAsTeach extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ตรวจสอบการปรับปรุงการกำหนดตำแหน่งครูผู้ช่วย ที่่ได้รับการบรรจุเข้ารับราชการให้ดำรงตำแหน่งอยู่และผ่านการเตรียมความพร้อมและพัฒนาอย่างเข้มแล้ว เป็นตำแหน่งครู </font>";
		echo '</div>';
			
	}
	
}

?>