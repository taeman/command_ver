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

class checkResultUpSalaryDie extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ตรวจสอบการพิจารณาเลื่อนขั้นเงินเดือน กรณีเสียชีวิตหรือออกจากราชการไม่ว่าด้วยสาเหตุใด หลังวันที่ 1 เม.ย. หรือหลัง 1 ต.ค. ก่อนที่จะมีคำสั่งเลื่อนขั้นเงินเดือนในแต่ละครั้ง ให้เลื่อนขั้นเงินเดือนย้อนหลังไปถึงวันที่ 1 เม.ย. หรือวันที่ 1 ต.ค. ของครึ่งปีที่จะได้เลื่อน
</font>";
		echo '</div>';
	}
	
}

?>