<?php
/**
* @comment class ตรวจสอบคำสั่งการโอน
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Eakkasit Kamwong
* @access private
* @created 29/09/2014
*/

class outEducationSuggestion extends utility{
		
		public function checkExp(){
			return true;
		}
		public function showExp(){
				
			echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
             	echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b> การลาศึกษาโดยผู้บังคับบัญชาอนุญาตหรือตามความจำเป็นของหน่วยงานหรือตามคุณวุฒิขาดแคลน โดย
อนุมัติ ก.ค.ศ. หรือ อ.ก.ค.ศ. เขตพื้นที่การศึกษาที่ได้รับมอบหมาย มีสิทธิได้รับการพิจารณาเลื่อนเงินเดือน
ระหว่างลาไปศึกษา ฝึกอบรม หรือวิจัย แล้วแต่กรณี ตามหลักเกณฑ์ที่ ก.ค.ศ.กำหนดด</font>";
          	 	echo '</div>';
		}
	
}

?>