<?php
/**
* @comment class ��Ǩ�ͺ�����
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Jullachai
* @access private
* @created 29/09/2014
*/

class suggestion3 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>��Ǩ�ͺ��õ�ŧ�Թ����ͧ������ӹҨ��觺�è�����觵�� (˹��§ҹ�������͹)  </font>";
		echo '</div>';
			
	}
	
}

?>