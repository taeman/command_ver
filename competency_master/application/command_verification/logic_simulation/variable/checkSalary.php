<?php
/**
 * ��Ǩ�ͺ����Թ��͹�ͧ����Ҫ��÷���Ѻ�͹
 *
 * @author  -
 * @copyright 2011 Sapphire
 * @description ��Ǩ�ͺ����Թ��͹�ͧ����Ҫ��÷���Ѻ�͹
 * @param string $salary_increases, �Թ��͹�������͹, 27450
 * @param string $salary_income, �Թ��͹������Ѻ, 27450
 * @return boolean
 "
 */
class checkSalary extends utility{
	public $salary_increases;
	public $salary_income;
	
	public function __construct($salary_increases="", $salary_income=""){
		$this->debug = "off";
		$this->salary_increases = $salary_increases;
		$this->salary_income = $salary_income;
	}
	
	public function checkExp(){
		//return $this->salary_increases.'-'.$this->salary_income;
		if($this->salary_income<=$this->salary_increases)return true;
		return false;
	}
	
	public function showExp(){
			
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
			echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>˹��§ҹ����֡��������ǹ�Ҫ��÷���Ѻ�͹ ��ͧ��������Ѻ�Թ��͹㹢����� 㹡ó��ѵ���Թ��͹㹢���������˹�������Ѵ�Ѻ��� ��ͧ���������Ѻ�Թ��͹㹢�鹷����¡���������ҡѺ�Թ��͹������ ��е�ͧ���¡���������ҡѺ�ѵ���Թ��͹ ��ͧ���˹觹�鹴��� �óչ�ͧ�˹�ͨҡ�������͹��ѵ� �.�.�. �繡ó�੾�����</font>";
			echo '</div>';
	}
	
}

?>