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

class waitForUpsalarySuggestion38k extends utility{
		
		public function checkExp(){
			return true;
		}
		public function showExp(){
				
			echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
             	echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b> กรณีได้รับอนุญาตให้ไปศึกษา ฝึกอบรบ หรือวิจัย โดยมีสิทธิได้รับการพิจารณาเลื่อนเงินเดือนระหว่าง
การศึกษา ฝึกอบรม หรือวิจัย ให้รอการเลื่อนเงินเดือนไว้ก่อน และสำรองเงินสำหรับเลื่อนเงินเดือนไว้ เมื่อ
กลับมาปฏิบัติหน้าที่และผู้บังคับบัญชาพิจารณาเห็นว่ามีผลงานดีเด่นสมควรได้รับการเลื่อนเงินเดือนให้สั่ง
เลื่อนเงินเดือนย้อนหลังไปในแต่ละครั้งที่รอการเลื่อนเงินเดือนไว้ โดยเลื่อนเงินเดือนวันที่ 1 เมษายน และ
1 ตุลาคม แล้วแต่กรณีการสั่งเลื่อนเงินเดือน ให้สั่งเมื่อผู้นั้นสำเร็จการศึกษา ฝึกอบรบ หรือวิจัยและกลับ
เข้ามาปฏิบัติหน้าที่ราชการแล้ว</font>";
          	 	echo '</div>';
		}
	
}

?>