<?php
/**
* @comment class ��Ǩ�ͺ�������͹����Թ��͹ �óվ鹨ҡ�Ҫ����������³���ء�͹���դ��������͹����Թ��͹
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Eakkasit Kamwong
* @access private
* @created 02/04/2014
*/

class checkUpSalaryRetireBFUpsalary extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>��Ǩ�ͺ�óշ��鹨ҡ�Ҫ����������³���ص����������Ҵ��º��˹稺ӹҭ仡�͹�����դ��������͹����Թ��͹ �������͹����Թ��͹��͹��ѧ件֧�ѹ��� 30 �ѹ��¹ �ͧ���觻��ش���·���������͹</font>";
		echo '</div>';
			
	}
	
}

?>