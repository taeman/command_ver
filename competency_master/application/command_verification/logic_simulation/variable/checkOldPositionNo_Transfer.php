<?php
/**
* @comment class ตรวจสอบกรณีตำแหน่งเดิมคือ ครูผู้ช่วย
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Eakkasit  Kamwong
* @access private
* @created 04/02/2015
*/

class checkOldPositionNo_Transfer extends utility{
		public function checkExp(){
			return true;
		}
		public function showExp(){
				echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
             	echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ตรวจสอบตำแหน่งเดิมต้องไม่เป็นครูผู้ช่วย เนื่องจากตำแหน่งครูผู้ช่วย อยู่ในช่วงระหว่างทดลองปฏิบัติหน้าที่ราชการหรือเตรียมความพร้อมและพัฒนาอย่างเข้ม</font>";
          	 	echo '</div>';
				

		}
}

?>