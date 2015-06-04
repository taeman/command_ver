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

class checkEmptyAssistantTeacherPosition extends checkEmptyTeacherPosition{

	public function checkExp(){	
		$this->caption = 'ตรวจสอบอัตรากำลังว่าตำแหน่งครูผู้ช่วยว่างสามารถกำหนดตำแหน่งเป็นตำแหน่งครู โดยคงเงินเดือน หรือ ขั้นตามตำแหน่งเดิม';
		$sql = "SELECT COUNT(*) AS empty_position
				FROM j18_position_temp 
				WHERE post_code = '425471006' 
				AND (CZ_ID IS NULL OR CZ_ID = '')
				AND position_id = '{$this->position_id}'";
		$result = mysql_db_query('cmss_'.$this->secid, $sql);
		$row = mysql_fetch_assoc($result);

		if($row['empty_position']>0 && $this->salary_increases == $this->salary_income){
			$this->result= 'อัตรากำลังว่าตำแหน่งครูผู้ช่วยว่างสามารถกำหนดตำแหน่งเป็นตำแหน่งครูได้';
			return true;
		}
		$this->result= 'อัตรากำลังว่าตำแหน่งครูผู้ช่วยว่างไม่สามารถกำหนดตำแหน่งเป็นตำแหน่งครูได้';
		return false;
	}
}

?>