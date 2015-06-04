<?php
/**
* @comment ตรวจสอบการขอเลื่อน/มีวิทยฐานะตำแหน่งผู้อำนวยการเขตพื้นที่การศึกษา 
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Supachai
* @access private
* @created 15/1/2558
*/

class checkVitayaSiteDirector extends checkVitayaSupervision{
	public $vitaya = array(
		'3'=>array(
				'v_name'=>'เชี่ยวชาญ',
				'v_caption'=>'ดำรงตำแหน่งผู้อำนวยการสำนักงานเขตพื้นที่การศึกษามาแล้วไม่น้อยกว่า 1 ปี หรือดำรงตำแหน่งอื่นที่ ก.ค.ศ.เที่ยบเท่าอย่างไดอย่างหนึ่งมาแล้วไม่น้อยกว่า 1 ปี นับถึงวันที่ยื่นคำร้อง'		
			),
		'4'=>array(
				'v_name'=>'เชี่ยวชาญพิเศษ',
				'v_caption'=>'ดำรงตำแหน่งผู้อำนวยการสำนักงานเขตพื้นที่การศึกษาที่มีวิทยฐานะผู้อำนวยการสำนักงานเขตพื้นที่การศึกษาเชี่ยวชาญ มาแล้วไม่น้อยกว่า 2 ปี หรือดำรงตำแหน่งอื่นที่ ก.ค.ศ.เที่ยบเท่าอย่างไดอย่างหนึ่งมาแล้วไม่น้อยกว่า 2 ปี นับถึงวันที่ยื่นคำร้อง'		
			),
		'5'=>array(
				'v_name'=>'เลื่อนตำแหน่ง',
				'v_caption'=>'ดำรงตำแหน่งรองผู้อำนวยการสำนักงานเขตพื้นที่การศึกษา มาแล้วไม่น้อยกว่า 1 ปี หรือ ดำรงตำแหน่งผู้อำนวยการสถานศึกษาวิทยฐานะผู้อำนวยการสถานศึกษาเชี่ยวชาญขึ้นไป นับถึงวันที่ยื่นคำร้อง'		
			)
	);
	
	public function checkVitaya3(){	
		$this->pos_date = $this->view_general['comeday_c'];
		$this->date_period = $this->getPeriodReal($this->view_general['comeday_c'], $this->effective_date);
		return ($this->date_period[0] >= 1) ? true : false;	
	}

	public function checkPosition(){
		$pid = $this->view_general['pid'];
		if($pid =='125471009'){
			$this->pos_date = $this->view_general['comeday_c'];
			$this->date_period = $this->getPeriodReal($this->pos_date, $this->effective_date);
			return ($this->date_period[0] >= 1) ? true : false;	
		}else if($pid =='325471008'){
			$this->pos_date = $this->view_general['comeday_c'];
			$this->date_period = $this->getPeriodReal($this->pos_date, $this->effective_date);
			return ($this->view_general['vitaya_id'] >= 3) ? true : false;	
		}else{
			return false;
		}
	}	
}
?>