<?php
/**
* @comment class คำแนะนำการดำรงตำแหน่งของผู้ย้าย (ครูผู้ช่วย ครู และ ศึกษานิเทศก์)
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Pinya
* @access private
* @created 29/09/2014
*/

class move_and_appointed2 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ดำรงตำแหน่งในหน่วยงานการศึกษาในปัจจุบันมากกว่าเท่ากับ 12 เดือนจนนับถึงในวันที่ยื่นคำขอ </font>";
		echo '</div>';
			
	}
	
}

?>