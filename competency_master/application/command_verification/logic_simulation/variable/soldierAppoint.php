<?php
/**
* @comment class ว 9/25 กรกฏาคม 2551 (การบรรจุผู้ถูกสั่งให้ออกจากราชการเพื่อไปรับราชการทหาร กลับเข้ารับราชการ)
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Supachai
* @access private
* @created 29/09/2014
*/

class soldierAppoint extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ตรวจสอบในระหว่างไปรับราชการทหารมิได้ทำการใด ๆ อันเสียหายแก่ราชการอย่างร้ายแรง หรือได้เชื่อว่าเป็นผู้ประพฤติชั่วอย่างร้ายแรงระหว่างรับราชการทหาร และ ตรวจสอบไม่เป็นผู้ถูกสั่งเปลี่ยนแปลงคำสั่งตามมาตรา 114 วรรคสอง เป็นให้ออกจากราชการตมาตราอื่น </font>";
		echo '</div>';
			
	}
	
}

?>