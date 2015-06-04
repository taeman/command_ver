<?php
/**
* @comment ตรวจสอบการพิจารณาการอนุมัติจาก ก.ค.ศ.
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Supachai
* @access private
* @created 13/1/2558
*/

class paReturn extends utility{
	public $pid_old;
	
	public function __construct($pid_old=""){
		$this->debug = "off";
		$this->pid_old = $pid_old;
	}
	
	public function checkExp(){
		//$this->pid_old == '125471008' || $this->pid_old == '125471009' ? 
		return true;
	}
	
	public function showExp(){
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
			echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ : </b>ผู้สมัครขอกลับเข้ารับราชการ เคยดำรงตำแหน่งผู้อำนวยการหรือรองผู้อำนวยการสำนักงานเขตพื้นที่การศึกษาให้ดำเนินการเสนอ ก.ค.ศ. พิจารณาอนุมัติ</font><br>";
			echo '</div>';
	}
	
}

?>