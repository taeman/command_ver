<?php
/**
* @comment class ตรวจสอบคำสั่ง
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Supachai
* @access private
* @created 16/03/2015
*/

class salary_transfer extends utility{

		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>กรณีตัดโอนตำแหน่งและอัตราเงินเดือนของข้าราชการครูและบุคลากรทางการศึกษา ตำแหน่งบุคลากรทางการศึกษาอื่น 38 ค.(2) จะต้องได้รับการอนุมัติจาก ก.ค.ศ. และให้ระบุหนังสือสำนักงาน ก.ค.ศ. ที่มีมติให้อนุมัติตัดโอนตำแหน่งและอัตราเงินเดือนไว้ในคำสั่งด้วย</font>";
		echo '</div>';
			
	}
	
}

?>