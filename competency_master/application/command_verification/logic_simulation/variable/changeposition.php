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
class changeposition extends utility{
	public $pid_old;
	public $pid_exam;
	
	public function __construct($pid_old,$pid_exam){
		$this->pid_old = $pid_old;
		$this->pid_exam = $pid_exam;
		$this->debug = "off";
	}
	
	public function checkExp(){
		if($this->pid_old !=$this->pid_exam && $this->pid_exam !="225471000" && $this->pid_exam !="425471006") {
			return true;
		}else{
			return false;
		}
		
	}
	
	 public function showExp(){
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>เงื่อนไข :</b>ตรวจสอบตำแหน่งที่เปลี่ยน ต้องเป็นการแต่งตั้งข้าราชการครูและบุคลากรทางการศึกษาให้ดำรงตำแหน่งตามมาตรา 38ก.(2) มาตรา 38 ข.(1)-(4),(7) หรือมาตรา 38ค. ซึ่งมิใช่ตำแหน่งที่ดำรงอยู่เดิม ในหน่วยงานการศึกษาเดิม หรือหน่วยงานการศึกษาอื่น</font>";
		echo '</div>';
  	}
	
}
?>