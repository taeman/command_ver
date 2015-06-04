<?php
/**
* @comment class ��Ǩ�ͺ�������ҡ���͡�ҡ�Ҫ��õ�ͧ����Թ 3 �� �¹Ѻ�ѹ����ռŶ֧�ѹ����͡����觺�è�����觵��
* @projectCode 28CMSS12
* @tor 8.8
* @package core
* @author Supachai
* @access private
* @created 2/4/2558
*/

class checkTimeOut3Year extends utility{
	private $date_out;
	private $effective_date;
	private $date_period;
	
	
	public function __construct($date_out="", $effective_date=""){
		$this->debug = "off";
		$this->date_out = $date_out;
		$this->effective_date = $effective_date;
	}
		
	public function checkExp(){
		$this->date_period = $this->getPeriodReal($this->date_out, $this->effective_date);
		if($this->date_period[0] > 3){
			return false;
		}else if($this->date_period[0]==3){
			if($this->date_period[1] > 0|| $this->date_period[2] > 0)
				return false;
			else
				return true;
		}else{
			return true;
		} 
	}
	public function showExp(){
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>���͹� :</b>��Ǩ�ͺ�������ҡ���͡�ҡ�Ҫ��õ�ͧ����Թ 3 �� �¹Ѻ�ѹ����ռŶ֧�ѹ����͡����觺�è�����觵�� </font>";
		echo "<font color=\"#6A3500\"><b>�š�õ�Ǩ�ͺ :</b>�������ҡ���͡�ҡ�Ҫ����¹Ѻ�ѹ����ռŶ֧�ѹ����͡����觺�è�����觵�� ��� <br>".$this->date_period[0]." �� ".$this->date_period[1]." ��͹ ".$this->date_period[2]." �ѹ</font>";
		echo '</div>';
			
	}
	
}

?>