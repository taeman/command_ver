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

class checkDateQualification extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>��Ǩ�ͺ������Ѻ�س�ز��������������ҧ���ͧ��Ժѵ��Ҫ��� ����繡óշ�����������Ѻ�Թ��͹����س�زԷ������������ҧ���� ���Ԩ�ó����������Ѻ�Թ��͹����س�زԷ�����Ѻ�������������ҧ���ͧ��Ժѵ��Ҫ���</font>";
		echo '</div>';
			
	}
	
}

?>