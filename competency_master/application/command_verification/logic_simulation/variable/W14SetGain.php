<?php
/**
* @comment class ����ʹ��� � 14/29 �ѹ��¹ 2548 (��á�˹���ѡࡳ������Ըա�äѴ���͡)
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Eakkasit Kamwong
* @access private
* @created 02/04/2014
*/

class W14SetGain extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>��Ǩ�ͺ��ҡ�ô��Թ��äѴ���͡�ؤ�����ͺ�è�����觵������Ѻ�Ҫ����繢���Ҫ��ä����кؤ�ҡ÷ҧ����֡�� �óշ���դ��������������˵ؾ���� �����仵����ѡࡳ���Ըա�÷�� �.�.�. ��˹�</font>";
		echo '</div>';
			
	}
	
}

?>