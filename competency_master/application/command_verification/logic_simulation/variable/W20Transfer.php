<?php
/**
* @comment class ���й� � 20/12 ��Ȩԡ�¹ 2552 (����͹��ѡ�ҹ��ǹ��ͧ�����Т���Ҫ�������Һ�è�����觵���繢���Ҫ��ä����кؤ�ҡ÷ҧ����֡��)
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Eakkasit Kamwong
* @access private
* @created 02/04/2014
*/

class W20Transfer extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>��Ǩ�ͺ��ҡ�ô��Թ���������������������Ըա���͹��ѡ�ҹ��ǹ��ͧ�����Т���Ҫ�������Һ�è�����觵���繢���Ҫ�����кؤ�ҡ÷ҧ����֡�������仵����ѡࡳ���� �.�.�. ��˹�</font>";
		echo '</div>';
			
	}
	
}

?>