<?php
/**
* @comment class ��Ǩ�ͺ�ѵ���Թ��͹
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Eakkasit Kamwong
* @access private
* @created 02/04/2014
*/

class checkRateSalary extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>��Ǩ�ͺ�ѵ���Թ��͹�������ѹ�Ѻ�Թ��͹ �Թ�Է°ҹ� ����Թ��Шӵ��˹觵������Ҫ�ѭ�ѵ��Թ��͹ �Թ�Է°ҹ�����Թ��Шӵ��˹觢���Ҫ��ä����кؤ�ҡ÷ҧ����֡�� ���������仵�� �.�.�. ��˹� </font>";
		echo '</div>';
			
	}
	
}

?>