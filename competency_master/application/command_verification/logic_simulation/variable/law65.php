<?php
/**
* @comment ��Ǩ�ͺ�������ҵ�� 65
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Supachai
* @access private
* @created 13/1/2558
*/

class law65 extends utility{
	public $idcard;
	public $effective_date;
	public $date_out;
	public $date_diff;
	
	public function __construct($idcard="", $effective_date="", $date_out=""){
		$this->debug = "off";
		$this->idcard = $idcard;
		$this->effective_date = $effective_date;
		$this->date_out = $date_out;
	}
	
	public function checkExp(){
		$date1=date_create($this->effective_date);
		$date2=date_create($this->date_out);
		$diff=date_diff($date1,$date2);
		$this->date_diff = abs($diff->y);
		return $this->date_diff < 4 ? true : false;
	}
	
	public function showExp(){
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
			echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>��Ǩ�ͺ�������ҡ���͡�ҡ�Ҫ��õ�ͧ����Թ 4 �� �¹Ѻ�ѹ����ռŶ֧�ѹ����͡����觺�è�����觵��
					<br/>** �Ӣ������ѹ����͡任�Ժѵԧҹ������ ���. ���º��º�Ѻ������ ������ѹ��� �¨е�ͧ�������������ҧ���� 4 ��</font><br>";
			echo "<font color=\"#6A3500\"><b>�����Ũҡ�к� : </b>�鹨ҡ��Ժѵԧҹ�����Ԥ���Ѱ����������� {$this->date_diff} ��</font>";
			echo '</div>';
	}
	
}

?>