<?php
/**
* @comment class ��Ǩ�ͺ�����
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Maiphrom
* @access private
* @created 02/04/2015
*/

class SalaryAdj extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>�óշ���ջ�Ѻ�ѵ���Թ��͹�ç�Ѻ�ͺ�������͹����Թ��͹ ���ӡ�þԨ�ó�����͹����Թ��͹��͹ ���Ǩ֧�ӡ�û�Ѻ�ѵ���Թ��͹������Ѻ㹻Ѩ�غѹ�������ѵ���Թ��͹����ѭ��Ṻ���¾���Ҫ��ɮաҡ�û�Ѻ�ѵ���Թ��͹ �óշ�������������ͺ�������͹����Թ��͹ ���ӡ�û�Ѻ�ѵ���Թ��͹������Ѻ㹻Ѩ�غѹ ��Ѻ�Ѻ����͢��㴨����Ѻ��û�Ѻ�ѵ���Թ��͹���ѵ��������仵���ѭ��Ṻ���¾���Ҫ��ɮաҡ�û�Ѻ�ѵ���Թ��͹</font>";
		echo '</div>';
			
	}
	
}

?>