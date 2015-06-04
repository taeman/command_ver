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

class daySalarySuggestion38k extends utility{
		
		public function checkExp(){
			return true;
		}
		public function showExp(){
				
			echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
             	echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b> การเลื่อนบุคลากรทางการศึกษาอื่นตามมาตรา ๓๘ ค.(๒) ขึ้นแต่งตั้งให้ดำรงตำแหน่งในระดับที่สูงขึ้นใน วันที่ 1 เมษายน หรือวันที่ 1 ตุลาคม ซึ่งเป็นวันเดียวกันกับวันเลื่อนเงินเดือนให้ดำเนินการตามที่ ก.ค.ศ.กำหนด</font>";
          	 	echo '</div>';
		}
	
}

?>