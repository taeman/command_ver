<?php
/**
* @comment ตรวจสอบตำแหน่งว่าง
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Supachai
* @access private
* @created 14/1/2558
*/

class checkEmptyPosition extends utility{
	public $position2_id;
	public $pid_new;
	public $status;
	public $idcard;
	public $letter_id;
	
	public function __construct($position2_id="", $pid_new="", $idcard="", $letter_id=""){
		$this->debug = "off";
		$this->position2_id = $position2_id;
		$this->pid_new = $pid_new;
		$this->idcard = $idcard;
		$this->letter_id = $letter_id;
	}
	
	public function checkEmpty(){
		$instruction = $this->getInstructionDetail($this->letter_id);
		$siteid = $this->getSiteNow($this->idcard);
		if(empty($siteid)){
			$siteid = $instruction['siteid'];
		}
		
		$dbSite = "cmss_".$siteid;
		$sql = "SELECT
					COUNT(*) AS num_empty
				FROM
					j18_position_temp
				WHERE position_id = '{$this->position2_id}'
				AND post_code = '{$this->pid_new}'
				AND(CZ_ID='' OR CZ_ID IS NULL )";
		$result = mysql_db_query($dbSite, $sql);
		$row = @mysql_fetch_assoc($result);
		return $row['num_empty'];
	}
	
	public function checkExp(){
		$this->status = $this->checkEmpty();
		if($this->status >= 1){
			return true;
		}
		return false;
	}
	
	public function showExp(){
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
			echo "<font color=\"#6A3500\"><b>เงื่อนไข :</b> สำนักงานเขตพื้นที่การศึกษา หรือส่วนราชการที่จะบรรจุบุคคลเข้ารับราชการต้องมีตำแหน่งข้าราชการครูและบุคลากรทางการศึกษาว่าง และมีอัตรากำลังไม่เกินเกณฑ์ที่ ก.ค.ศ. กำหนด</font><br>";
			if($this->status >= 1){
				echo "<font color=\"#6A3500\"><b>ข้อมูลจากระบบ : </b>เลขที่ตำแหน่งที่ {$this->position2_id} สามารถใช้ได้</font>";
			}else{
				echo "<font color=\"#6A3500\"><b>ข้อมูลจากระบบ : </b>เลขที่ตำแหน่งที่ {$this->position2_id} ไม่สามารถใช้ได้</font>";
			}
			echo '</div>';
	}
	
}

?>