<?php
/**
* @comment ตรวจสอบอัตรากำลังว่าตำแหน่งครูว่าง
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Supachai
* @access private
* @created 20/1/2558
*/

class checkEmptyTeacherPosition extends utility{
	public $position_id;
	public $salary_increases;
	public $salary_income;
	public $secid;
	public $allschool_new;
	
	public $result;
	public $caption = 'ตรวจสอบอัตรากำลังว่าตำแหน่งครูว่างสามารถกำหนดตำแหน่งเป็นตำแหน่งครูผู้ช่วย โดยคงเงินเดือน หรือ ขั้นตามตำแหน่งเดิม';
	
	public function __construct($position_id="", $salary_increases="", $salary_income="", $secid="", $allschool_new=""){
		$this->debug = "off";	
		$this->position_id = $position_id;	
		$this->salary_increases = $salary_increases;
		$this->salary_income = $salary_income;
		$this->secid = $secid;	
		$this->allschool_new = $allschool_new;
	}
	
	public function checkExp(){	
		$sql = "SELECT COUNT(*) AS empty_position
				FROM j18_position_temp 
				WHERE post_code = '425471000' 
				AND (CZ_ID IS NULL OR CZ_ID = '')
				AND position_id = '{$this->position_id}'";
		$result = mysql_db_query('cmss_'.$this->secid, $sql);
		$row = mysql_fetch_assoc($result);

		if($row['empty_position']>0 && $this->salary_increases == $this->salary_income){
			$this->result= 'ตำแหน่งครูว่างสามารถกำหนดตำแหน่งเป็นตำแหน่งครูผู้ช่วยได้';
			return true;
		}
		$this->result= 'ตำแหน่งครูว่างไม่สามารถกำหนดตำแหน่งเป็นตำแหน่งครูผู้ช่วยได้';
		return false;
	}
	
	public function showExp(){
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
			echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b> {$this->caption}</font><br>";
			echo "<font color=\"#6A3500\"><b>ผลการตรวจสอบ  : </b> ".$this->result;
			echo '</div>';
	}
	
}

?>