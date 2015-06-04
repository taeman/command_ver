<?php
/**
* @comment class ตรวจสอบคำสั่ง
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Jullachai
* @access private
* @created 29/09/2014
*/

class law50 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>มาตรา 50 ในกรณีที่มีความจําเป็นหรือมีเหตุพิเศษที่ อ.ก.ค.ศ. เขตพื้นที่การศึกษาไม่สามารถดําเนินการสอบแข่งขันได้หรือการสอบแข่งขันอาจทําให้ไม่ได้บุคคลต้องตามประสงค์ของทางราชการ อ.ก.ค.ศ. เขตพื้นที่การศึกษาอาจคัดเลือกบุคคลเพื่อบรรจุและแต่งตั้งเป็นข้าราชการครูและบุคลากรทางการศึกษาโดยวิธีอื่น ทั้งนี้ตามหลักเกณฑ์และวิธีการที่ก.ค.ศ. กําหนด</font>";
		echo '</div>';
			
	}
	
}

?>