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

class law81 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ตรวจสอบว่าการดำเนินการส่งหรืออนุญาตให้ลาไปศึกษา ฝึกอบรม ดูงาน หรือปฏิบัติงานวิจัยและพัฒนาตามระเบียบที่ ก.ค.ศ. กำหนด ในกรณีที่มีความจำเป็นหรือเป็นความต้องการของหน่วยงานเพื่อประโยชน์ต่อการพัฒนาคุณภาพการศึกษาหรือวิชาชีพ หรือคุณวุฒิขาดแคลน โดยอนุมัติ ก.ค.ศ. หรือ อ.ก.ค.ศ. เขตพื้นที่การศึกาาที่ได้รับมอบหมาย โดยให้ถือเป็นการปฏิบัติหน้าที่ราชการ และมีสิทธิได้เลื่อนขั้นเงินเดือนในระหว่างลาไปศึกษา ฝึกอบรม หรือวิจัย แล้วแต่กรณี ทั้งนี้ ภายใต้บังคับมาตรา ๗๓ วรรคสาม และเป็นไปตามหลักเกณฑ์และวิธีการที่ ก.ค.ศ. กำหนด</font>";
		echo '</div>';
			
	}
}

?>