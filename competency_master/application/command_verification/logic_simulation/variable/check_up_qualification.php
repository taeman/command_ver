<?php
/**
* @comment class ��Ǩ�ͺ�����
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Pinya
* @access private
* @created 29/03/2015
*/

class check_up_qualification extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>��Ǩ�ͺ����ա���������ͧ�������ز�㹷���¹����ѵ�(�.�.7) ���͢����ز������������ҷ���˹� ���������蹤Ӣ�������Ѻ�Թ��͹ ���/���ͻ�Ѻ��ا��á�˹����˹觵���ز� �������ҡ�â������ز� ���/���͢����زԴѧ������繡�â�������Ѻ�Թ��͹���/���ͻ�Ѻ��ا��á�˹����˹� ����͹����觵������ç���˹觵���زԷ����蹢�����</font>";
		echo '</div>';
			
	}
	
}

?>