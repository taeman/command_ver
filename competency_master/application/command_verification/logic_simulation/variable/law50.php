<?php
/**
* @comment class ��Ǩ�ͺ�����
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Jullachai
* @access private
* @created 29/09/2014
*/

class law50 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>�ҵ�� 50 㹡óշ���դ���������������˵ؾ���ɷ�� �.�.�.�. ࢵ��鹷�����֡���������ö����Թ����ͺ�觢ѹ�����͡���ͺ�觢ѹ�Ҩ�����������ؤ�ŵ�ͧ������ʧ��ͧ�ҧ�Ҫ��� �.�.�.�. ࢵ��鹷�����֡���Ҩ�Ѵ���͡�ؤ�����ͺ�è�����觵���繢���Ҫ��ä����кؤ�ҡ÷ҧ����֡�����Ը���� ��駹������ѡࡳ������Ըա�÷��.�.�. ���˹�</font>";
		echo '</div>';
			
	}
	
}

?>