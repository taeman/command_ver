<?php
/**
 * ตรวจสอบวิทยฐานะ การับโอนพนักงานส่วนท้องถิ่น
 *
 * @author  -
 * @copyright 2011 Sapphire
 * @description ตรวจสอบวิทยฐานะ การับโอนพนักงานส่วนท้องถิ่น
 * @return boolean
 "
 */
class checkVitaya extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
	
	public function checkExp(){
		return true;
	}
	
	public function showExp(){
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
			echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ตรวจสอบวิทยฐานะ กรณีที่วิทยฐานะเป้นชำนาญการ ชำนาญการพิเศษ ถ้ากรณีที่เป็นเชี่ยวชาญ และเชี่ยวชาญพิเศษให้แสดงข้อความแจ้งเตือนให้ทำการขออนุมัติ ก.ค.ศ.เป็นกรณีเฉพาะราย</font>";
			echo '</div>';
	}
	
}

?>