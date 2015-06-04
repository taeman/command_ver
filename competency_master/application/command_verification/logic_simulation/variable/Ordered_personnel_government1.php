<?php
/**
* @comment class คำแนะนำของการสั่งให้ประจําส่วนราชการหรือสํานักงานเขตพื้นที่การศึกษา ต้องออกเป็นคําสั่ง
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Pinya
* @access private
* @created 29/09/2014
*/

class Ordered_personnel_government1 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>การสั่งให้ประจําส่วนราชการหรือสํานักงานเขตพื้นที่การศึกษา ต้องออกเป็นคําสั่ง  </font>";
		echo '</div>';
			
	}
	
}

?>