<?php
/**
* @comment class ���йӢͧ����͡�ҡ�Ҫ��áóա���������͡��Ѻ�Ҫ��÷��� 
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Pinya
* @access private
* @created 29/09/2014
*/

class Quit_Government7 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>����͡�ҡ�Ҫ��áóա���������͡��Ѻ�Ҫ��÷��� �����������Ҵ�����Ѻ�Ҫ��÷������������ҹҨ����ҵ�� 53 �������͡�Ҫ�������ռŵ�����ѹ��Ѻ�Ҫ��÷���  </font>";
		echo '</div>';
			
	}
	
}

?>