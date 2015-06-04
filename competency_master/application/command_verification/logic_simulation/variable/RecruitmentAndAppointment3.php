<?php
/**
* @comment class ข้อเสนอแนะของสถานะผู้ที่เคยเป็นข้าราชการ กลับเข้ามารับราชการ
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Pinya
* @access private
* @created 29/09/2014
*/

class RecruitmentAndAppointment3 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ต้องไม่มีบัญชีผู้สอบแข่งขันได้ สอบคัดเลือกได้ หรือผู้ที่ได้รับคัดเลือกในตำแหน่งนั้น ขึ้นบัญชีรอการบรรจุและแต่งตั้ง เว้นแต่กรณีบรรจุและแต่งตั้งผู้ออกจากราชการไปดำรงตำแหน่งทางการเมือง หรือสมัครรับการเลือกตั้ง
 เป็นสมาชิกสภาผู้แทนราษฎร สมาชิกวุฒิสภาหรือสมาชิกสภาท้องถิ่นหรือลาออกเพื่อติดตามคู่สมรส ซึ่งไปรับราชการ ณ ต่างประเทศ หรือผู้ที่ออกจากราชการไปเพราะถูกยุบเลิกตำแหน่ง  </font>";
		echo '</div>';
			
	}
	
}

?>