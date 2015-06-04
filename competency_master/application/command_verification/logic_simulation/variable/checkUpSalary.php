<?php
/**
* @comment ��Ǩ�ͺ������Ѻ�Թ��͹ �óշ�����Ѻ�س�ز��������
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Supachai
* @access private
* @created 22/1/2558
*/

class checkUpSalary extends utility{
	public $idcard;
	public $effective_date;
	public $edu_finish;
	public $date_period;
	public $result;
	public $view_general;
	public $date_start;
	public $caption;
	
	public function __construct($idcard="", $effective_date="", $edu_finish=""){
		$this->debug = "off";
		$this->idcard = $idcard;
		$this->effective_date = $effective_date;
		$this->edu_finish = $edu_finish;
		$this->view_general = $this->getViewGeneralDetail($idcard);
		$this->caption = "������������Ҫ��ä�����Ѻ�Թ��͹ 㹡óշ�����Ѻ�س�ز�������鹵�ͧ����͹�ѹ������Ҫ��ä�ټ�������Ѻ�س��ڲ�������� �¤س�زԹ�鹨е�ͧ��ҹ��þԨ�ó�͹��ѵԨҡ������ӹҨ����ó�����";
	}
	
	public function checkExp(){
		
		$this->date_start = empty($this->view_general['startdate_c']) ? $this->view_general['begindate_c'] : $this->view_general['startdate_c'];
		
		$this->date_period = $this->getPeriodReal($this->date_start, $this->edu_finish);
		$period_eff = $this->getPeriodReal($this->edu_finish, $this->effective_date);
		
		if($this->date_period[2] > 0 && $period_eff[2] > 0){
			$this->result= '<strong>����ö��Ѻ�ѵ���Թ��͹����Ҫ��ä����кؤ�ҡ÷ҧ����֡�ҵ���س�زԷ�����Ѻ�����������٧���</strong>';
			return true;
		}
		$this->result= '<strong>�������ö��Ѻ�ѵ���Թ��͹����Ҫ��ä����кؤ�ҡ÷ҧ����֡�ҵ���س�زԷ�����Ѻ�����������٧���</strong>';
		return false;
		
	}
	
	public function showExp(){
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
			echo "<font color=\"#6A3500\"><b>����ʹ��� :</b> {$this->caption}</font><br>";
			echo "<font color=\"#6A3500\"><b>�š�õ�Ǩ�ͺ :</b> {$this->result}</font><br>";
			echo '</div>';
	}
	
}

?>