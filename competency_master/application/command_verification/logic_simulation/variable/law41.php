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
class law41 extends utility{
	public function __construct(){
		$this->debug = "off";
	}
	
	public function checkExp(){
		return true;
	}
	
	 public function showExp(){
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>มาตรา 41 ตำแหน่งข้าราชการครูและบุคลากรทางการศึกษา จะมีในหน่วยงานการศึกษาใดจำนวนเท่าใด และต้องใช้คุณสมบัติเฉพาะสำหรับตำแหน่งอย่างใด ให้เป็นไปตามที่ ก.ค.ศ. กำหนด</font>";
		echo '</div>';
  	}
	
}
?>