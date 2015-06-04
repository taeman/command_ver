<?php
/**
* @comment class ข้อเสนอแนะ ว 14/29 กันยายน 2548 (การกำหนดหลักเกณฑ์และวิธีการคัดเลือก)
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Eakkasit Kamwong
* @access private
* @created 02/04/2014
*/

class W14SetGain extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ตรวจสอบว่าการดำเนินการคัดเลือกบุคคลเพื่อบรรจุและแต่งตั้งเข้ารับราชการเป็นข้าราชการครูและบุคลากรทางการศึกษา กรณีที่มีความจำเป็นหรือมีเหตุพิเศษ ให้เป็นไปตามหลักเกณฑ์วิธีการที่ ก.ค.ศ. กำหนด</font>";
		echo '</div>';
			
	}
	
}

?>