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
class checkleaveout extends utility{
	public function __construct(){
		$this->debug = "off";
	}
	
	public function checkExp(){
		return true;
	}
	
	 public function showExp(){
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ตรวจสอบวันที่ออกจากราชการของข้าราชการครูและบุคลากรทางการศึกษา กรณีสั่งให้ออกจากราชการ สั่งลงโทษปลดออก หรือไล่ออกจากราชการ เป็นไปตามระเบียบ ก.ค.ศ. ว่าด้วยวันออกจากราชการของข้าราชการครูและบุคลากรทางการศึกษา พ.ศ. 2548</font>";
		echo '</div>';
  	}
	
}
?>