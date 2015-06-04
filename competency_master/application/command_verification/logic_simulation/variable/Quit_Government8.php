<?php
/**
* @comment class คำแนะนำของการออกจากราชการกรณีถูกเพิกถอนใบอนุญาตประกอบวิชาชีพ
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Pinya
* @access private
* @created 29/09/2014
*/

class Quit_Government8 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>การออกจากราชการกรณีถูกเพิกถอนใบอนุญาตประกอบวิชาชีพที่ไม่สามารถเปลี่ยนตําแหน่งได้ภายใน 30 วันให้ผู้มีอํานาจตามมาตรา 53 สั่งให้ออกจากราชการ  </font>";
		echo '</div>';
			
	}
	
}

?>