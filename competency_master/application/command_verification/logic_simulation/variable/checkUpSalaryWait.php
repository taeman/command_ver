<?php
/**
* @comment class ตรวจสอบคำสั่ง
* @projectCode 58CMSS12
* @tor  -
* @package core
* @author Panupong
* @access private
* @created 02/04/2558
*/

class checkUpSalaryWait extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ตรวจสอบว่าการดำเนินการกรณีผู้ที่สมควรเลื่อนขั้นเงินเดือน แต่ถูกรอการเลื่อนขั้นเงินเดือนและกัันเงินสำหรับเลื่อนขั้นเงินเดือน เนื่องจากทำผิดวินัยร้ายแรงอยู่ก่อนกฎ ก.ค.ศ. บังคับใช้  เมื่อกฎ ก.ค.ศ.นี้บังคับใช้ ให้พิจารณาเลื่อนขั้นเงินเดือนที่รอไว้ ถ้าได้รอเลื่อนขั้นเงินเดือนเกินหนึ่งครั้ง  ให้เลื่อนขั้นเงินเดือนย้อนหลังไปในแต่ละครั้งทีไ่ด้รอการเลื่อนขั้นเงินเดือนไว้ โดยไม่ต้องรอให้การสอบสวนและพิจารณาแล้วเสร็จ
</font>";
		echo '</div>';
	}
	
}

?>