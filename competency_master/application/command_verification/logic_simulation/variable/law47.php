<?php
/**
* @comment class ��Ǩ�ͺ�������ҵ�� 47
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Eakkasit Kamwong
* @access private
* @created 02/04/2014
*/

class law47 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>��Ǩ�ͺ��ô��Թ��÷�����Ҫ��ä�����Ѻ��û�Ѻ��ا��á�˹����˹� ����͹����觵������ç���˹� �óշ�����Ѻ�س�ز�������� ����繡������͹����觵������ç���˹觫�����Ѻ�Թ��͹��дѺ����٧��� ���Ըա�äѴ���͡ ���/���ͻ�Ѻ��ا����ҵ�� 47 </font>";
		echo '</div>';
			
	}
	
}

?>