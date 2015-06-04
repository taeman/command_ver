<?php
/**
* @comment ��Ǩ�ͺ�������ҵ�� 66
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Supachai
* @access private
* @created 13/1/2558
*/

class checkConscriptDate extends utility{
	public $idcard;
	public $effective_date;
	public $date_return;
	public $date_diff;
	
	public function __construct($effective_date="", $idcard="", $date_return=""){
		$this->debug = "off";
		$this->idcard = $idcard;
		$this->effective_date = $effective_date;
		$this->date_return = $date_return;
	}
	
	public function checkExp(){
		$date1=date_create($this->effective_date);
		$date2=date_create($this->date_return);
		$diff=date_diff($date1,$date2);
		$this->date_diff = abs($diff->format("%R%a days"));
		return $this->date_diff <= 180 ? true : false;
	}
	
	public function showExp(){
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
			echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>�Ӣ������ѹ���鹨ҡ�Ҫ��÷��� ���º��º�Ѻ������ѹ��� ������������������¡���������ҡѺ 180 �ѹ </font><br>";
			echo "<font color=\"#6A3500\"><b>�����Ũҡ�к� : </b>�鹨ҡ�Ҫ��÷��������� {$this->date_diff} �ѹ</font>";
			echo '</div>';
	}
	
}

?>