<?php
/**
* @comment ��Ǩ�ͺ��â��¡���֡��
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Supachai
* @access private
* @created 16/3/2558
*/

class checkQualEffectiveDate extends utility{
	public $effective_date;
	public $idcard;
	public $date_period;
	public $result;
	public $comeday;
	public $caption;
	
	public function __construct($idcard="", $effective_date=""){
		$this->debug = "off";
		$this->effective_date = $effective_date;
		$this->idcard = $idcard;

		$this->caption = "�س�زԷ��������� ����ö��Ǩ�ͺ���� ������ѹ�����ѧ�ѹ����ç���˹觻Ѩ�غѹ";
	}
	
	public function checkExp(){
		$general = $this->getViewGeneralDetail($this->idcard);
		$this->comeday = $general[comeday_c];
		$this->date_period = $this->getPeriodReal($this->comeday, $this->effective_date);
		
		if($this->date_period[2] > 1 || $this->date_period[1] > 1 || $this->date_period[0] > 1){
			$this->result= '����ö���¡���֡�ҵ����';
			return true;
		}
		$this->result= '�������ö���¡���֡�ҵ����';
		return false;	
	}
	
	public function showExp(){
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
			echo "<font color=\"#6A3500\"><b>����ʹ��� :</b> {$this->caption}</font><br>";
			echo "<font color=\"#6A3500\"><b>�����Ũҡ�к� : </b>�͢��¡���֡�ҵ�͵�����ѹ��� ";
			echo $this->dateConvert($this->comeday, 'en-th-ddmmyy');
			echo " �֧�ѹ��� ";
			echo $this->dateConvert($this->effective_date, 'en-th-ddmmyy');
			echo " ���������� : {$this->date_period[0]} �� ";
			echo $this->date_period[1]>0? $this->date_period[1].' ��͹ ':'';
			echo $this->date_period[2]>0? $this->date_period[2].' �ѹ':'';
			echo ' '.$this->result;
			echo '</div>';
	}
	
}

?>