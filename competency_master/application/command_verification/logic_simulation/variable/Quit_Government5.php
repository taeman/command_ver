<?php
/**
* @comment class คำแนะนำของการออกจากราชการกรณีหย่อนความสามารถ
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Pinya
* @access private
* @created 29/09/2014
*/

class Quit_Government5 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>การออกจากราชการกรณีหย่อนความสามารถในอันที่จะปฏิบัติหน้าที่ราชการต้องตั้งคณะกรรมการสอบสวนแจ้งข้อกล่าวหา สรุปพยานหลักฐาน ก่อนสั่งให้ออกจากราชการ3.6 การออกจากราชการกรณีถูกลงโทษวินัยร้ายแรง ต้องตั้งคณะกรรมการสอบสวนและได้รับอนุมัติจาก ก.ค.ศ. หรือ อ.ก.ค.ศ.  </font>";
		echo '</div>';
			
	}
	
}

?>