<?php
/**
* @comment class คำแนะนำการตัดโอนตำแหน่งและอัตราเงินเดือนข้าราชการครูและบุคลากรทางการศึกษา
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Pinya
* @access private
* @created 29/09/2014
*/

class cut_transfer_position2 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ตำแหน่งรองผู้อำนวยการสถานศึกษาที่ว่างอยู่ในสถานศึกษาที่เกินเกณฑ์ไปกำหนดเป็นตำแหน่งครูในสถานศึกษาที่มีตำแหน่งครูต่ำกว่าเกณฑ์ </font>";
		echo '</div>';
			
	}
	
}

?>