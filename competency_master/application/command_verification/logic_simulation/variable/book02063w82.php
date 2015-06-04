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
class book02063w82 extends utility{
	public function __construct(){
		$this->debug = "off";
	}
	
	public function checkExp(){
		return true;
	}
	
	 public function showExp(){
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ตรวจสอบการดำเนินการเป็นไปตามหนังสือสำนักงาน ก.ค.ศ. ที่ ศธ 0206.3/ว8 ลงวันที่ 28 พ.ค. 2551 หลักเกณฑ์และวิธีการเกลี่ยอัตรากำลังข้าราชการครูและบุคลากรทางการศึกษา</font>";
		echo '</div>';
  	}
	
}
?>