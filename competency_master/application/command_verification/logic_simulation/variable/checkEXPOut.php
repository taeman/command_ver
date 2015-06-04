<?php
/**
* @comment ตรวจสอบเวลารับราชการของผู้ลาศึกษา (ภาคปกติ)
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Supachai
* @access private
* @created 19/1/2558
*/

class checkEXPOut extends checkEXPIn{

	public function checkExp(){
		$this->caption = "ผู้ลาศึกษาจะต้องมีเวลารับราชการติดต่อกัน มากกว่าหรือเท่ากับ 12 เดือนเต็ม หรือ 1 ปี นับถึงวันที่ 15 มิถุนายน ของปีที่เข้าศึกษา";
		
		$this->date_start = empty($this->view_general['startdate']) ? $this->view_general['begindate'] : $this->view_general['startdate'];
		
		$start_year = explode('-', $this->date_out);
		
		$this->date_period = $this->getPeriodReal($this->date_start, ($start_year[0]+543).'-06-15');
		
		if($this->date_period[0] < 1){
			$this->result= '<strong>ไม่สามารถลาศึกษาต่อได้</strong>';
			return false;
		}
		$this->result= '<strong>สามารถลาศึกษาต่อได้</strong>';
		return true;
	}	

}

?>