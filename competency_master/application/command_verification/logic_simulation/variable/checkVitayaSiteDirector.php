<?php
/**
* @comment ��Ǩ�ͺ��â�����͹/���Է°ҹе��˹觼���ӹ�¡��ࢵ��鹷�����֡�� 
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
				'v_name'=>'����Ǫҭ',
				'v_caption'=>'��ç���˹觼���ӹ�¡���ӹѡ�ҹࢵ��鹷�����֡�������������¡��� 1 �� ���ʹ�ç���˹���蹷�� �.�.�.���º������ҧ����ҧ˹�������������¡��� 1 �� �Ѻ�֧�ѹ�����蹤���ͧ'		
			),
		'4'=>array(
				'v_name'=>'����Ǫҭ�����',
				'v_caption'=>'��ç���˹觼���ӹ�¡���ӹѡ�ҹࢵ��鹷�����֡�ҷ�����Է°ҹм���ӹ�¡���ӹѡ�ҹࢵ��鹷�����֡������Ǫҭ �����������¡��� 2 �� ���ʹ�ç���˹���蹷�� �.�.�.���º������ҧ����ҧ˹�������������¡��� 2 �� �Ѻ�֧�ѹ�����蹤���ͧ'		
			),
		'5'=>array(
				'v_name'=>'����͹���˹�',
				'v_caption'=>'��ç���˹��ͧ����ӹ�¡���ӹѡ�ҹࢵ��鹷�����֡�� �����������¡��� 1 �� ���� ��ç���˹觼���ӹ�¡��ʶҹ�֡���Է°ҹм���ӹ�¡��ʶҹ�֡������Ǫҭ���� �Ѻ�֧�ѹ�����蹤���ͧ'		
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