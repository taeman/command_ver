<?php
/**
* @comment class ��Ǩ�ͺ�����
* @projectCode 58CMSS12
* @tor  -
* @package core
* @author Panupong
* @access private
* @created 02/04/2558
*/

class checkRuleTypePosition extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>��Ǩ�ͺ��ô��Թ�����仵�� �� �.�.� ��èѴ���������˹� �дѺ���˹� ���������Ѻ�Թ��͹ ����Թ��Шӵ��˹觢ͧ���˹觺ؤ�ҡ÷ҧ����֡�� �.�. 2547 ��з������������</font>";
		echo '</div>';
	}
	
}

?>