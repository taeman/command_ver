<?php
/**
* @comment ตรวจสอบอัตรากำลังว่าตำแหน่งครูว่าง และไม่เกินเกณฑ์อัตรากำลังที่ ก.ค.ศ. กำหนด
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Supachai
* @access private
* @created 21/1/2558
*/

class checkEmptyTeacherPositionM extends checkEmptySchoolDeputyDirectorPosition{
	
 	public function checkExp(){	

		$std_comp=$this->getWorkforce();
		//echo '<pre>', print_r($std_comp); die; 			
		//บริหารM1M2	ครูผู้สอนE	ฝ่ายสนับสนุนS		std real
		
		$this->caption = 'ตรวจสอบอัตรากำลังว่าตำแหน่งครูว่าง และไม่เกินเกณฑ์อัตรากำลังที่ ก.ค.ศ. กำหนด สามารถกำหนดตำแหน่งเป็นตำแหน่งรองผู้อำนวยการสถานศึกษา โดยคงเงินเดือน หรือ ขั้นตามตำแหน่งเดิม เมื่อปรับปรุงกำหนดตำแหน่งแล้ว จำนวนครูและรองผู้อำนวยการสถานศึกษาต้องไม่เกินเกณฑ์ตามที่ ก.ค.ศ. กำหนด';
		
		$sql = "SELECT COUNT(*) AS empty_position
				FROM j18_position_temp 
				WHERE post_code = '425471000' 
				AND (CZ_ID IS NULL OR CZ_ID = '')
				AND position_id = '{$this->position_id}'";
		$result = mysql_db_query('cmss_'.$this->secid, $sql);
		$row = mysql_fetch_assoc($result);
		
		if($row['empty_position']>0 && $this->salary_increases == $this->salary_income && $std_comp['E']['std'] > $std_comp['E']['real'] && $std_comp['M2']['std'] > $std_comp['M2']['real']){
			$this->result= 'อัตรากำลังว่าตำแหน่งครูว่างสามารถกำหนดตำแหน่งเป็นตำแหน่งรองผู้อำนวยการสถานศึกษาได้';
			return true;
		}
		$this->result= 'อัตรากำลังว่าตำแหน่งครูว่างไม่สามารถกำหนดตำแหน่งเป็นตำแหน่งรองผู้อำนวยการสถานศึกษาได้';
		return false;
	}
}

?>