<?php
/**
* @comment class ��Ǩ�ͺ�����
* @projectCode 58CMSS12
* @tor  -
* @package core
* @author Panupong
* @access private
* @created 02/04/2558
*/

class checkUpSalaryWait extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>��Ǩ�ͺ��ҡ�ô��Թ��áóռ�������������͹����Թ��͹ ��١�͡������͹����Թ��͹��С�ѹ�Թ����Ѻ����͹����Թ��͹ ���ͧ�ҡ�ӼԴ�Թ�������ç�����͹�� �.�.�. �ѧ�Ѻ��  ����͡� �.�.�.���ѧ�Ѻ�� ���Ԩ�ó�����͹����Թ��͹�������� �����������͹����Թ��͹�Թ˹�觤���  �������͹����Թ��͹��͹��ѧ�����Ф��駷�����͡������͹����Թ��͹��� ������ͧ��������ͺ�ǹ��оԨ�ó���������
</font>";
		echo '</div>';
	}
	
}

?>