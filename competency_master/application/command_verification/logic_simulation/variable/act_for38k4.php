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

class act_for38k4 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>กรณีตําแหน่งข้าราชการครูและบุคลากรทางการศึกษาตําแหน่งบุคลากรทางการศึกษาอื่นตามมาตรา 38 ค.(2) (ว่างลงหรือผู้ดํารงตําแหน่งไม่สามารถปฏิบัติหน้าที่ราชการได้) ให้แต่งตั้งรักษาการในตําแหน่ง ตามมาตรา 68 แห่งพระราชบัญญัติระเบียบข้าราชการครูและบุคลากรทางการศึกษา พ.ศ. 2547 และที่แก้ไขเพิ่มเติม </font>";
		echo '</div>';
			
	}
	
}

?>