<?php
/**
* @comment ��Ǩ�ͺ��â�����͹/���Է°ҹе��˹��֡�ҹ��ȡ�
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Supachai
* @access private
* @created 15/1/2558
*/

class checkVitayaSupervision extends checkVitayaTeacher{
	public $vitaya = array(
		'1'=>array(
				'v_name'=>'�ӹҭ���',
				'v_caption'=>'��ç���˹��֡�ҹ��ȡ� �����������¡��� 2 �� ���ʹ�ç���˹���蹷�� �.�.�. ��º��������������¡��� 2 �� �Ѻ�֧�ѹ�����蹤���ͧ'		
			),
		'2'=>array(
				'v_name'=>'�ӹҭ��þ����',
				'v_caption'=>'��ç���˹��֡�ҹ��ȡ� ������Է°ҹ��֡�ҹ��ȡ�ӹҭ��� �����������¡��� 1 �� ���ʹ�ç���˹���蹷�� �.�.�. ��º��������������¡��� 1 �� �Ѻ�֧�ѹ�����蹤���ͧ'		
			),
		'3'=>array(
				'v_name'=>'����Ǫҭ',
				'v_caption'=>'��ç���˹��֡�ҹ��ȡ� ������Է°ҹ��֡�ҹ��ȡ�ӹҭ��þ���� �����������¡��� 3 �� ���ʹ�ç���˹��֡�ҹ��ȡ� ������Է°ҹ��֡�ҹ��ȡ�ӹҭ��� �����������¡��� 5 �� ���ʹ�ç���˹���蹷�� �.�.�. ��º��������������¡��� 3 �� �Ѻ�֧�ѹ�����蹤���ͧ'		
			),
		'4'=>array(
				'v_name'=>'����Ǫҭ�����',
				'v_caption'=>'��ç���˹��֡�ҹ��ȡ� ������Է°ҹ��֡�ҹ��ȡ����Ǫҭ �����������¡��� 2 �� ���ʹ�ç���˹���蹷�� �.�.�. ��º��������������¡��� 2 �� �Ѻ�֧�ѹ�����蹤���ͧ'		
			),
		'5'=>array(
				'v_name'=>'',
				'v_caption'=>'��ç���˹觤�������������¡��� 4 �� ����Ѻ��������زԻ�ԭ�ҵ�� 2 �� ����Ѻ��������زԻ�ԭ��� �Ѻ�֧�ѹ�����蹤���ͧ'		
			)			
	);
	
	public function checkVitaya1(){	
		$this->pos_date = $this->view_general['comeday_c'];
		$this->date_period = $this->getPeriodReal($this->view_general['comeday_c'], $this->effective_date);
		return ($this->date_period[0] >= 2) ? true : false;	
	}
}
?>