<?php
/**
* @comment class ���йӢͧ����͡�ҡ�Ҫ��áó����͹��������ö
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Pinya
* @access private
* @created 29/09/2014
*/

class Quit_Government5 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>����͡�ҡ�Ҫ��áó����͹��������ö��ѹ���л�Ժѵ�˹�ҷ���Ҫ��õ�ͧ��駤�С�������ͺ�ǹ�駢�͡������ ��ػ��ҹ��ѡ�ҹ ��͹�������͡�ҡ�Ҫ���3.6 ����͡�ҡ�Ҫ��áóն١ŧ���Թ�������ç ��ͧ��駤�С�������ͺ�ǹ������Ѻ͹��ѵԨҡ �.�.�. ���� �.�.�.�.  </font>";
		echo '</div>';
			
	}
	
}

?>