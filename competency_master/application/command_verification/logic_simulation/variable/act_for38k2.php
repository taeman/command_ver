<?php
/**
* @comment class ��Ǩ�ͺ�����
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Pinya
* @access private
* @created 16/03/2015
*/

class act_for38k2 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>����觵�������ç����˹���͹��ѧ ���觵��������͹�ѹ��һ�Ժѵ�˹�ҷ��㹵���˹觹�� ����ҡ�繵���˹觻������Ԫҡ�è��觵��������͹�ѹ����觼ŧҹ�ú��ǹ��м�ҹ��û����Թ�ҡ��С��������͹��ѵ��.�.�.�. ࢵ��鹷�����֡�� ���� �.�.�.�. ���.�.�. ��� </font>";
		echo '</div>';
			
	}
	
}

?>