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

class law51 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>��Ǩ�ͺ������˹��§ҹ����֡�Ҵ���Թ��âͤ�����繪ͺ �ҡ �.�.�.�. ࢵ��鹷�����֡�ҡ�͹ ��������͹��ѵԨҡ �.�.�. ����� �.�.�. ��Ԩ�ó�͹��ѵ������觺�è�����觵��㹵���˹�� �Է°ҹ����С��˹��Թ��͹����������Ѻ���� �����ѡࡳ������Ըա�÷��.�.�. ���˹�</font>";
		echo '</div>';
			
	}
	
}

?>