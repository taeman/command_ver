<?php
/**
* @comment class ���йӢͧ��û�Ѻ��ا��á��˹�����˹觢���Ҫ��ä����кؤ�ҡ÷ҧ����֡�ҵ���˹��ͧ�����ҹ�¡��ʶҹ�֡�ҷ����ҧ
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Pinya
* @access private
* @created 29/09/2014
*/

class compareOldPosition extends utility{
	
	private $salary_income;
	private $salary_increases;
	
	public function __construct($salary_income="", $salary_increases=""){
		$this->debug = "off";
		$this->salary_income = $salary_income;
		$this->salary_increases = $salary_increases;
	}
		
	public function checkExp(){
		return ($this->salary_income <= $this->salary_increases)? false:true;
	}
	public function showExp(){
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>���͹� :</b>��Ǩ�ͺ���˹觷���è�����觵�� ��ͧ����§ҹ���������§ҹ��蹷������٧������� �Է°ҹ���ҷ�������Ѻ��� ����Ѻ�Թ��͹�ѹ�Ѻ��Т�鹷������٧���ҷ�������Ѻ������� ��͹�͡�ҡ�Ҫ��� </font>";
		echo '</div>';
	}
	
}

?>