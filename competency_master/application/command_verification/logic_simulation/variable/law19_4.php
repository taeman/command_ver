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

class law19_4 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ตรวจสอบว่าการดำเนินการออกกฎ ก.ค.ศ. ระเบียบ ข้อบังคับ หลักเกณฑ์ วิธีการ และเงื่อนไขการบริหารงานบุคคล ของข้าราชการครูและบุคลากรทางการศึกษา กฎ ก.ค.ศ. เมื่อได้รับอนุมัติจากคณะรัฐมนตรีและประกาศในราชกิจจานุเบกษาแล้ว ให้ใช้บังคับได้</font>";
		echo '</div>';
			
	}
}

?>