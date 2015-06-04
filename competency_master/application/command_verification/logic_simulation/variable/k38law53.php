<?php
/**
* @comment ตรวจสอบตำแหน่งการเปลี่ยนตำแหน่ง
* @projectCode 57CMSS12
* @tor  -
* @package core
* @author Kiatisak Chansawang
* @access private
* @created 02/04/2015
*/
class k38law53 extends utility{
	public function __construct(){
		$this->debug = "off";
	}
	
	public function checkExp(){
		return true;
	}
	
	 public function showExp(){
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ตรวจสอบเมื่อใช้ในระบบสร้างคำสั่งหรือตรวจสอบคำสั่งไม่สามารถประมวลกรณีใช้ในระบบเลขาฯ โดยให้ตรวจสอบผู้มีอำนาจลงนาม กรณีหน่วยงานต้นสังกัดเป็นสถานศึกษา ให้ผู้อำนวยการสถานศึกษาเป็นผู้มีอำนาจลงนาม กรณีหน่วยงานต้นสังกัดเป็นสำหนักงานเขตพื้นที่การศึกษา ให้ผู้อำนวยการสำนักงานเขตพื้นที่การศึกษาเป็นผู้มีอำนาจลงนาม</font>";
		echo '</div>';
  	}
	
}
?>