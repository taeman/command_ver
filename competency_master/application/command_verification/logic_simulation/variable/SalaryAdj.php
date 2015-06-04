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

class SalaryAdj extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>กรณีที่มีปรับอัตราเงินเดือนตรงกับรอบการเลื่อนขั้นเงินเดือน ให้ทำการพิจารณาเลื่อนขั้นเงินเดือนก่อน แล้วจึงทำการปรับอัตราเงินเดือนที่ได้รับในปัจจุบันเข้าสู่อัตราเงินเดือนตามบัญชีแนบท้ายพระราชกฤษฎีกาการปรับอัตราเงินเดือน กรณีที่ไม่ได้อยู่ในรอบการเลื่อนขั้นเงินเดือน ให้ทำการปรับอัตราเงินเดือนที่ได้รับในปัจจุบัน ในอับดับใดหรือขั้นใดจะได้รับการปรับอัตราเงินเดือนเป็นอัตราใดให้เป็นไปตามบัญชีแนบท้ายพระราชกฤษฎีกาการปรับอัตราเงินเดือน</font>";
		echo '</div>';
			
	}
	
}

?>