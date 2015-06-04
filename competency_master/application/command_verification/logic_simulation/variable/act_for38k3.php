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

class act_for38k3 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>กรณีตําแหน่งผู้อํานวยการสํานักงานเขตพื้นที่การศึกษา หรือผู้อํานวยการสถานศึกษาว่างหรือผู้ดํารงตําแหน่งไม่สามารถดํารงตําแหน่งไม่สามารถปฏิบัติหน้าที่ราชการได้ให้แต่งตั้งผู้รักษาราชการแทนตามมาตรา 53 หรือมาตรา 54 แห่งพระราชบัญญัติระเบียบบริหารราชการกระทรวงศึกษาธิการ พ.ศ. 2546 </font>";
		echo '</div>';
			
	}
	
}

?>