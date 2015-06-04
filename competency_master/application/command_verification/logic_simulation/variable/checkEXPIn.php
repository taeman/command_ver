<?php
/**
* @comment ��Ǩ�ͺ�����Ѻ�Ҫ��âͧ������֡�� (�Ҥ����)
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Supachai
* @access private
* @created 22/1/2558
*/

class checkEXPIn extends utility{
	public $idcard;
	public $date_out;
	public $date_period;
	public $result;
	public $view_general;
	public $date_start;
	public $caption;
	
	public function __construct($idcard="", $date_out=""){
		$this->debug = "off";
		$this->idcard = $idcard;
		$this->date_out = $date_out;
		$this->view_general = $this->getViewGeneralDetail($idcard);
		$this->caption = "������֡�Ҩе�ͧ�������Ѻ�Ҫ��õԴ��͡ѹ �ҡ����������ҡѺ 24 ��͹��� ���� 2 �� �Ѻ�֧�ѹ��� 15 �Զع�¹ �ͧ�շ������֡��";
	}
	
	public function checkExp(){
		
		$this->date_start = empty($this->view_general['startdate']) ? $this->view_general['begindate'] : $this->view_general['startdate'];
		
		$start_year = explode('-', $this->date_out);
		
		$this->date_period = $this->getPeriodReal($this->date_start, ($start_year[0]+543).'-06-15');
		
		if($this->date_period[0] < 2){
			$this->result= '<strong>�������ö���֡�ҵ����</strong>';
			return false;
		}
		$this->result= '<strong>����ö���֡�ҵ����</strong>';
		return true;
	}
	
	public function showExp(){
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
			echo "<font color=\"#6A3500\"><b>����ʹ��� :</b> {$this->caption}</font><br>";
			echo "<font color=\"#6A3500\"><b>�����Ũҡ�к� : </b>�ѹ�������Ѻ�Ҫ��� ";
			echo $this->dateConvert($this->date_start, 'th-th-ddmmyy');
			echo " �Ѻ�֧�ѹ��� 15 �Զع�¹ �ͧ�շ����ҡ���֡��   : {$this->date_period[0]} �� ";
			echo $this->date_period[1]>0? $this->date_period[1].' ��͹ ':'';
			echo $this->date_period[2]>0? $this->date_period[2].' �ѹ':'';
			echo ' '.$this->result;
			echo '</div>';
	}
	
}

?>