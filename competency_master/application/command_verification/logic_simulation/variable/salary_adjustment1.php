<?php
/**
* @comment class ���йӢͧ����Ҫ��ä�ٷ����蹤Ӣ�������Ѻ�Թ��͹
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Pinya
* @access private
* @created 29/09/2014
*/

class salary_adjustment1 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>����Ҫ��ä�ټ������蹤Ӣ�������Ѻ�Թ��͹ 㹡óշ�����Ѻ�س�ز������������ 60 �ѹ �Ѻ������ѹ���ʶҹ�֡�����˹ѧ����Ѻ�ͧ�ʴ��������稡���֡�� </font>";
		echo '</div>';
			
	}
	
}

?>