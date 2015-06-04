<?php
/**
* @comment class ตรวจสอบคำสั่ง
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Pinya
* @access private
* @created 29/03/2015
*/

class law51 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ตรวจสอบว่าให้หน่วยงานการศึกษาดําเนินการขอความเห็นชอบ จาก อ.ก.ค.ศ. เขตพื้นที่การศึกษาก่อน แล้วให้ขออนุมัติจาก ก.ค.ศ. เมื่อ ก.ค.ศ. ได้พิจารณาอนุมัติให้สั่งบรรจุและแต่งตั้งในตําแหน่งใด วิทยฐานะใดและกําหนดเงินเดือนที่จะให้ได้รับแล้ว ตามหลักเกณฑ์และวิธีการที่ก.ค.ศ. กําหนด</font>";
		echo '</div>';
			
	}
	
}

?>