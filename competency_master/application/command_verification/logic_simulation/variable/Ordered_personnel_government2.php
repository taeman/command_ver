<?php
/**
* @comment class ���йӢͧ����������Ш����ǹ�Ҫ���������ҹѡ�ҹࢵ��鹷�����֡��  �óշ�軯Ժѵ�˹�ҷ����������Է°ҹ���駴�ԡ�����Թ�Է°ҹ�
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Pinya
* @access private
* @created 29/09/2014
*/

class Ordered_personnel_government2 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>����������Ш����ǹ�Ҫ���������ҹѡ�ҹࢵ��鹷�����֡�� �óշ������ç����˹觷�����Է°ҹ� �ҡ任�Ш����ǹ�Ҫ��� ˹��§ҹ������ҹѡ�ҹࢵ��鹷�����֡�� �ҡ��黯Ժѵ�˹�ҷ����������Է°ҹ���駴�ԡ�����Թ�Է°ҹ� </font>";
		echo '</div>';
			
	}
	
}

?>