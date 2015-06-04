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

class law68 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ตรวจสอบว่าการดำเนินการกรณีที่ตำแหน่งใดว่างลง หรือผู้ดำรงตำแหน่งไม่สามารถปฎิบัติหน้าที่ราชการได้ โดยให้ข้าราชการครูและบุคลการทางการศึกษาให้ไปรักษาราชการในตำแหน่งนั้น มีอำนาจและหน้าที่ตามตำแหน่งที่รักษาการ  หากได้รับแต่งตั้งเป็นกรรมการหรือมีอำนาจหน้าที่อย่างใด ก็ให้ผู้รักษาการในตำแหน่งทำหน้าที่กรรมการ หรือมีอำนาจและหน้าที่อย่างนั้นในระหว่างรักษาการในตำแหน่งตามกฎหมาย กฎ ระเบียบ ข้อบังคับ มติคณะรัฐมนตรี มติคณะกรรมการตามกฎหมาย หรือมีคำสั่งของผู้บังคับบัญชา</font>";
		echo '</div>';
			
	}
}

?>