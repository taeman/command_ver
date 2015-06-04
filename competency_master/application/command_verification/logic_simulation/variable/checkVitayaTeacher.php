<?php
/**
* @comment ��Ǩ�ͺ��â�����͹/���Է°ҹе��˹觤��
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Supachai
* @access private
* @created 15/1/2558
*/

class checkVitayaTeacher extends utility{
	public $idcard;
	public $vitaya_new;
	public $effective_date;
	public $pos_date;
	public $date_period;
	public $view_general;
	public $vitaya_stat;
	public $vitaya = array(
		'1'=>array(
				'v_name'=>'�ӹҭ���',
				'v_caption'=>'��ç���˹觤�������������¡��� 6 �� ����Ѻ��������زԻ�ԭ�ҵ�� 4 �� ����Ѻ��������زԻ�ԭ��� 2 �� ����Ѻ��������زԻ�ԭ���͡ �Ѻ�֧�ѹ�����蹤���ͧ'		
			),
		'2'=>array(
				'v_name'=>'�ӹҭ��þ����',
				'v_caption'=>'��ç���˹觤�ٷ�����Է°ҹФ�٪ӹҭ��� ���ʹ�ç���˹���蹷�� �.�.�.���º������ҧ����ҧ˹�������������¡��� 1 �� �Ѻ�֧�ѹ�����蹤���ͧ'		
			),
		'3'=>array(
				'v_name'=>'����Ǫҭ',
				'v_caption'=>'���˹觤�������Ƿ�����Է°ҹФ�٪ӹҭ��þ���������������¡��� 3 ��  ���� ��ç���˹觤�������Ƿ�����Է°ҹФ�٪ӹҭ��������������¡��� 5 �չѺ�֧�ѹ�����蹤���ͧ'		
			),
		'4'=>array(
				'v_name'=>'����Ǫҭ�����',
				'v_caption'=>'��ç���˹觤�������Ƿ�����Է°ҹФ�����Ǫҭ ���ʹ�ç���˹���蹷�� �.�.�.���º������ҧ����ҧ˹�������������¡��� 2 �� �Ѻ�֧�ѹ�����蹤���ͧ'		
			)			
	);
	
	public function __construct($idcard="", $vitaya_new="", $effective_date=""){
		$this->debug = "off";
		$this->idcard = $idcard;
		$this->vitaya_new = $vitaya_new;
		$this->effective_date = $effective_date;
		$this->view_general = $this->getViewGeneralDetail($idcard);
		$this->vitaya_stat = $this->getVitayaStatDetail($idcard, $this->view_general['siteid']);
	}
	
	public function checkVitaya1(){	
		$this->pos_date = $this->view_general['comeday_c'];
		$this->date_period = $this->getPeriodReal($this->view_general['comeday_c'], $this->effective_date);
		if($this->view_general['graduate_level'] == '40')
			return ($this->date_period[0] >= 6) ? true : false;	
		else if($this->view_general['graduate_level'] == '60')
			return ($this->date_period[0] >= 4) ? true : false;	
		else if($this->view_general['graduate_level'] == '80')
			return ($this->date_period[0] >= 2) ? true : false;	
	}

	public function checkVitaya2(){
		$this->pos_date = $this->vitaya_stat[1]['date_start_c'];
		$this->date_period = $this->getPeriodReal($this->pos_date, $this->effective_date);
		return ($this->date_period[0] >= 1) ? true : false;	
	}

	public function checkVitaya3(){
		$this->date_period = $this->getPeriodReal($this->vitaya_stat[2]['date_start_c'], $this->effective_date);
		if(!empty($this->vitaya_stat[2]['date_start_c'])){
			if($this->date_period[0] >= 3){
				$this->pos_date = $this->vitaya_stat[2]['date_start_c'];
				return true;
			}	
			$this->pos_date = $this->vitaya_stat[2]['date_start_c'];
		}

		$this->date_period = $this->getPeriodReal($this->vitaya_stat[1]['date_start_c'], $this->effective_date);
		if(!empty($this->vitaya_stat[1]['date_start_c'])){
			if($this->date_period[0] >= 5){
				$this->pos_date = $this->vitaya_stat[1]['date_start_c'];
				return true;
			}	
			if(empty($this->pos_date)) $this->pos_date = $this->vitaya_stat[1]['date_start_c'];
		}		
		
		return false;
	}

	public function checkVitaya4(){
		$this->pos_date = $this->vitaya_stat[3]['date_start_c'];
		$this->date_period = $this->getPeriodReal($this->pos_date, $this->effective_date);
		return ($this->date_period[0] >= 2) ? true : false;	
	}

	public function checkPosition(){
		$pid = $this->view_general['pid'];
		if($pid =='425471000'){
			$this->pos_date = $this->view_general['comeday_c'];
			$this->date_period = $this->getPeriodReal($this->pos_date, $this->effective_date);
			if($this->view_general['graduate_level'] == '40')
				return ($this->date_period[0] >= 4) ? true : false;	
			else if($this->view_general['graduate_level'] == '60')
				return ($this->date_period[0] >= 2) ? true : false;	
		}else{
			return false;
		}
	}
	
	public function checkExp(){
		if($this->vitaya_new == '') $this->vitaya_new = 5;
		switch($this->vitaya_new){
			case 1 : return $this->checkVitaya1();
			case 2 : return $this->checkVitaya2();	
			case 3 : return $this->checkVitaya3();
			case 4 : return $this->checkVitaya4();
			default : return $this->checkPosition();
		}
	}
	
	public function showExp(){
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>���͹� :</b> {$this->vitaya[$this->vitaya_new][v_caption]} </font><br>";
		echo "<font color=\"#6A3500\"><b>�����Ũҡ�к� : </b>�ѹ������Ѻ";
		echo $this->vitaya_new==1||$this->vitaya_new==5?'���˹�':'�Է°ҹ�';
		echo "�Ѩ�غѹ ".$this->dateConvert($this->pos_date, 'en-th-ddmmyy');
		echo " �ѹ�����蹢� ".$this->dateConvert($this->effective_date, 'en-th-ddmmyy');
		echo "<br>��ç���˹������� : {$this->date_period[0]} �� ";
		echo $this->date_period[1]>0? $this->date_period[1].' ��͹ ':'';
		echo $this->date_period[2]>0? $this->date_period[2].' �ѹ':'';
		echo "</font>";
		echo '</div>';
	}
}
?>