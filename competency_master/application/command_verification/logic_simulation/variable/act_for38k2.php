<?php
/**
* @comment class ตรวจสอบคำสั่ง
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Pinya
* @access private
* @created 16/03/2015
*/

class act_for38k2 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>การแต่งตั้งให้ดํารงตําแหน่งย้อนหลัง จะแต่งตั้งได้ไม่ก่อนวันเข้าปฏิบัติหน้าที่ในตําแหน่งนั้น และหากเป็นตําแหน่งประเภทวิชาการจะแต่งตั้งได้ไม่ก่อนวันที่ส่งผลงานครบถ้วนและผ่านการประเมินจากคณะกรรมการโดยอนุมัติอ.ก.ค.ศ. เขตพื้นที่การศึกษา หรือ อ.ก.ค.ศ. ที่ก.ค.ศ. ตั้ง </font>";
		echo '</div>';
			
	}
	
}

?>