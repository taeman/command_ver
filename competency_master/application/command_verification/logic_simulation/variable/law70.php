<?php
/**
* @comment class ตรวจสอบคำสั่ง
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Maiphrom
* @access private
* @created 02/04/2015
*/

class law70 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ตรวจสอบว่าการดำเนินการกรณีที่มีเหตุผลความจำเป็น หัวหน้าส่วนราชการหรือผู้อำนวยการสำนักงานเขตพื้นที่การศึกษา สั่งให้ข้าราชการครูและบุคลากรทางการกศึกษาประจำส่วนราชการ หรือสำนักงานเขตพื้นที่การศึกษา แล้วแต่กรณี เป็นการชั่วคราว ให้พ้นจากตำแหน่งหน้าที่เดิม เป็นไปตามหลักเกณฑ์และวิธีการที่กำหนดในกฎ ก.ค.ศ. การให้ได้รับเงินเดือน การแต่งตั้ง การเลื่อนขั้นเงินเดือน การดำเนินการทางวินัยและการออกจากราชการของข้าราชการครูและบุคลากรทางการศึกษาตามวรรคหนึ่งให้เป็นไปตามหลักเกณฑ์และวิธีการที่กำหนดในกฎ ก.ค.ศ.</font>";
		echo '</div>';
			
	}
}

?>