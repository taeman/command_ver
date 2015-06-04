<?php
/**
* @comment ��Ǩ�ͺ����֡�ҵ�ͧ͢������֡�� (�Ҥ�͡����)
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author
* @access private
* @created 19/1/2558
*/

class checkFurtherEduOutTime extends utility{
	public $idcard;
	public $date_out;
	public $date_period;
	public $result;
	public $view_general;
	public $birth_day;
	public $caption;
	
	public function __construct($idcard="", $date_out=""){
		$this->debug = "off";
		$this->idcard = $idcard;
		$this->date_out = $date_out;
		$this->view_general = $this->getViewGeneralDetail($idcard);
		$this->caption = "������֡�Ҩе�ͧ�����ع��¡���������ҡѺ 55 �� �Ѻ�֧�ѹ��� 15 �Զع�¹ �ͧ�շ����ҡ���֡��";
	}
	
	public function checkExp(){
		
		$this->birth_day = $this->view_general['birthday'];
		
		$this->date_period = $this->getPeriodReal($this->birth_day, '2558-06-15');
		
		if($this->date_period[0] >= 55){
			$this->result= '�������ö���֡�ҵ����';
			return false;
		}
		$this->result= '����ö���֡�ҵ����';
		return true;
	}
	
	public function showExp(){
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
			echo "<font color=\"#6A3500\"><b>����ʹ��� :</b> {$this->caption}</font><br>";
			echo "<font color=\"#6A3500\"><b>�����Ũҡ�к� : </b>�Դ�ѹ��� ";
			echo $this->dateConvert($this->birth_day, 'th-th-ddmmyy');
			echo " �Ѻ�֧�ѹ��� 15 �Զع�¹ �ͧ�շ����ҡ���֡��   : {$this->date_period[0]} �� ";
			echo $this->date_period[1]>0? $this->date_period[1].' ��͹ ':'';
			echo $this->date_period[2]>0? $this->date_period[2].' �ѹ':'';
			echo ' '.$this->result;
			echo '</div>';
	}
	
}

?>