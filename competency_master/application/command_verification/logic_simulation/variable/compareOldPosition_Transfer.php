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

class compareOldPosition_Transfer extends utility{
	public function checkExp(){
		return true;
	}
	public function showExp(){
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ตรวจสอบตำแหน่งที่บรรจุและแต่งตั้ง ต้องเป็นสายงานเดิมหรือสายงานอื่นที่ไม่สูงกว่าเดิม วิทยฐานะเท่าที่เคยได้รับเดิม และรับเงินเดือนอันดับและขั้นที่ไม่สูงกว่าที่เคยได้รับอยู่เดิม ก่อนออกจากราชการ </font>";
		echo '</div>';
	}
	
}

?>