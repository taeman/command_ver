<?php
/**
* @comment class ���йӵ���������ҵ�� 54
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Pinya
* @access private
* @created 29/09/2014
*/

class Command_Acting2 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>����Ǩ�ͺ��ͧ��仵���ҵðҹ�Է°ҹе���ҵ�� 42 ��觼�ҹ��û����Թ </font>";
		echo '</div>';
			
	}
	
}

?>