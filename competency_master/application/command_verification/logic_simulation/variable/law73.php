<?php
/**
* @comment class ��Ǩ�ͺ�������ҵ�� 73
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Eakkasit Kamwong
* @access private
* @created 02/04/2014
*/

class law73 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>��Ǩ�ͺ��ҡ�ô��Թ��þԨ�ó�����͹ �������Ԩ�ó�����͹����Թ��͹����Ҫ��ä����кؤ�ҡ÷ҧ����֡�� �����仵����ѡࡳ������Ըա������͹����Թ��͹�����衮 �.�.�. ��˹� �����������ӹҨ����ҵ�� 53 �繼���������͹�Թ��͹</font>";
		echo '</div>';
			
	}
	
}

?>