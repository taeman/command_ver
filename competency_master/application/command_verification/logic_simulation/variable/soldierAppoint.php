<?php
/**
* @comment class � 9/25 �á�Ҥ� 2551 (��ú�èؼ��١�������͡�ҡ�Ҫ���������Ѻ�Ҫ��÷��� ��Ѻ����Ѻ�Ҫ���)
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Supachai
* @access private
* @created 29/09/2014
*/

class soldierAppoint extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>��Ǩ�ͺ������ҧ��Ѻ�Ҫ��÷�������ӡ��� � �ѹ����������Ҫ������ҧ�����ç ��������������繼���оĵԪ������ҧ�����ç�����ҧ�Ѻ�Ҫ��÷��� ��� ��Ǩ�ͺ����繼��١�������¹�ŧ����觵���ҵ�� 114 ��ä�ͧ ������͡�ҡ�Ҫ��õ�ҵ����� </font>";
		echo '</div>';
			
	}
	
}

?>