<?php
/**
* @comment class ��Ǩ�ͺ�����
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Maiphrom
* @access private
* @created 02/04/2015
*/

class law56 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>��Ǩ�ͺ��ҡ�ô��Թ��ú�è�����觵���������Ѻ�Ҫ����繢���Ҫ��ä����кؤ�ҡ÷ҧ����֡������觵�������ç����˹���鷴�ͧ��Ժѵ�˹�ҷ���Ҫ���㹵���˹觹�� ���Ҽ������Ѻ��ú�è�����觵��㹵���˹觤�ټ����� �����������������������оѲ�����ҧ����������ͧ�ա�͹�觵�������ç����˹觤�ٷ�駹���÷��ͧ��Ժѵ�˹�ҷ���Ҫ�����С������������������оѲ�����ҧ��� ������ �����ѡࡳ������Ըա�÷��.�.�. ���˹�</font>";
		echo '</div>';
			
	}
	
}

?>