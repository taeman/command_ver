<?php
/**
* @comment class คำแนะนำของการปรับปรุงการกําหนดตําแหน่งข้าราชการครูและบุคลากรทางการศึกษาตําแหน่งรองผู้อํานวยการสถานศึกษาที่ว่าง
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Pinya
* @access private
* @created 29/09/2014
*/

class benefitReasonOut extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>การบรรจุและแต่งตั้งข้าราชการครูและบุคลากรทางการศึกษาผู้ออกจากราชการไปแล้วสมัครขอกลับเข้ารับราชการครูและบุคลากรทางการศึกษา ต้องเป็นกรณีที่มีเหตุความจำเป็นและเป็นประโยชน์ต่อทางราชการอย่างมาก </font>";
		echo '</div>';
			
	}
	
}

?>