<?php
/**
* @comment class ตรวจสอบการกำหนดตำแหน่งรองผู้อำนวยการสถานศึกษาที่ว่างและไม่อยู่ในเกณฑ์การกำหนดตำแหน่งรองผู้อำนวยการสถานศึกษา เป็นตำแหน่งครู ในสถานศึกษาเดิม
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Eakkasit Kamwong
* @access private
* @created 02/04/2014
*/

class checkPositionDPTDirectAsDirect extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ตรวจสอบวิธีการกำหนดตำแหน่งรองผู้อำนวยการสถานศึกษาที่ว่างและไม่อยู่ในเกณฑ์การกำหนดตำแหน่งรองผู้อำนวยการสถานศึกษา เป็นตำแหน่งครู ในสถานศึกษาเดิม เป็นไปตามหลักเกณฑ์และวิธีการที่ ก.ค.ศ.กำหนด </font>";
		echo '</div>';
			
	}
	
}

?>