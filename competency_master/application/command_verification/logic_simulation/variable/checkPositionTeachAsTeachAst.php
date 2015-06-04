<?php
/**
* @comment class ตรวจสอบการกำหนดตำแหน่งครูที่ว่างอยู่ เป็นตำแหน่งครูผู้ช่วย
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Eakkasit Kamwong
* @access private
* @created 02/04/2014
*/

class checkPositionTeachAsTeachAst extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ตรวจสอบการปรับปรุงการกำหนดตำแหน่งครู ที่ว่างอยู่ เป็นตำแหน่งครูผู้ช่วย เพื่อใช้บรรจุบุคลากรเข้ารับราชการเป็นข้าราชการครูและบุคลากรทางการศึกษา </font>";
		echo '</div>';
			
	}
	
}

?>