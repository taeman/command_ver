<?php
/**
* @comment ��Ǩ�ͺ��â��¡���֡��
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Supachai
* @access private
* @created 22/1/2558
*/

class checkExpanded extends utility{
	public $to_date;
	public $date_out;
	public $date_period;
	public $result;
	public $birth_day;
	public $caption;
	
	public function __construct($to_date="", $date_out=""){
		$this->debug = "off";
		$this->to_date = $to_date;
		$this->date_out = $date_out;
		$this->caption = "��Ǩ�ͺ��������㹡�â��¡���֡�ҵ�� ������֡�Ҩ�����ö�������ҡ���֡��������Թ 2 �Ҥ���¹";
	}
	
	public function checkExp(){
		
		$this->date_period = $this->getPeriodReal($this->date_out, $this->to_date);
		
		if($this->date_period[0] > 1 || $this->date_period[1] > 9){
			$this->result= '�������ö���¡���֡�ҵ����';
			return false;
		}
		$this->result= '����ö���¡���֡�ҵ����';
		return true;
	}
	
	public function showExp(){
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
			echo "<font color=\"#6A3500\"><b>����ʹ��� :</b> {$this->caption}</font><br>";
			echo "<font color=\"#6A3500\"><b>�����Ũҡ�к� : </b>�͢��¡���֡�ҵ�͵�����ѹ��� ";
			echo $this->dateConvert($this->date_out, 'th-th-ddmmyy');
			echo "�֧�ѹ��� ";
			echo $this->dateConvert($this->to_date, 'th-th-ddmmyy');
			echo " ���������� : {$this->date_period[0]} �� ";
			echo $this->date_period[1]>0? $this->date_period[1].' ��͹ ':'';
			echo $this->date_period[2]>0? $this->date_period[2].' �ѹ':'';
			echo ' '.$this->result;
			echo '</div>';
	}
	
}

?>