<?php

class checkTransferV5 extends utility{
		private $pid_old;
		private $level_id_old;
		private $radub_old;
		private $pid_new;
		private $level_exam;
		private $money_exam;
	
		public function __construct($pid_old='',$level_id_old='',$radub_old='',$pid_new='',$level_exam='',$money_exam=''){
			$this->debug = "off";
			
			$this->pid_old = $pid_old;
			$this->level_id_old = $level_id_old;
			$this->radub_old = $radub_old;
			$this->pid_new = $pid_new;
			$this->level_exam = $level_exam;
			$this->money_exam = $money_exam;
			
			$this->dbNow = "cmss_".$this->siteNow;
			$this->salary = new salary_level;
		}
		
		public function getTransferTable(){
			$sql = "SELECT 	cmd_compare_officer_teacher.to_pid,
							cmd_compare_officer_teacher.to_level_id,
							cmd_compare_officer_teacher.to_vitaya_id
				 FROM cmd_compare_officer_teacher 
				 WHERE from_pid = '{$this->pid_old}' 
				 AND from_level_id = {$this->level_id_old}";
			$rs = mysql_db_query($this->dbApp, $sql);
			$row = mysql_fetch_object($rs);
			return $row;
		}
		
		public function getRadubName($radub_id){
			$sql = "SELECT 	radub
				 FROM hr_addradub 
				 WHERE level_id = '{$radub_id}'";
			$rs = mysql_db_query('cmss_master', $sql);
			$row = mysql_fetch_object($rs);
			return $row;
		}
		
		public function checkExp(){
			$compare_table = $this->getTransferTable();
			
			// print_r($compare_table);
			// echo $this->pid_new. '<br>';
			// echo $this->level_exam . '<br>';
			// echo $this->money_exam. '<br>';
			$r = $this->getRadubName($this->level_exam);
			
			if($compare_table->to_pid == $this->pid_new 
			&& $compare_table->to_level_id == $this->level_exam
			&& ($this->salary->check($r->radub,$this->money_exam,date("Y-m-d")) == true)
			)
				return true;
			else
				return false;
		}

		public function showExp(){
			
			echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
             	echo "<font color=\"#6A3500\"><b>เงื่อนไข :</b>ให้ตรวจสอบการเทียบตำแหน่งและเงินเดือนตาม ว5/2558</font>";
          	 	echo '</div>';
		}
	
}
