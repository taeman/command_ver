<?php
/**
* @comment class ���йӡ�õѴ�͹���˹������ҧࢵ��鹷�����֡��
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Pinya
* @access private
* @created 29/09/2014
*/

class cut_transfer_position1 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>�óյѴ�͹���˹������ҧ�ӹѡ�ҹࢵ��鹷�����֡�� ��ͧ���Ѻ���͹��ѵԨҡ �.�.�. ��͹ �е�ͧ�ӡ�õ�Ǩ�ͺ \"˹��§ҹ����֡��\" �� 
\"˹��§ҹ����֡�Ңͧ�ѧ�Ѵ���\" �е�ͧ��ҡѺ \"˹��§ҹ����֡�Ңͧ�ѧ�Ѵ����\" </font>";
		echo '</div>';
			
	}
	
}

?>