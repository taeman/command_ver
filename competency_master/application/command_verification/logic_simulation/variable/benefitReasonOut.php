<?php
/**
* @comment class ���йӢͧ��û�Ѻ��ا��á��˹�����˹觢���Ҫ��ä����кؤ�ҡ÷ҧ����֡�ҵ���˹��ͧ�����ҹ�¡��ʶҹ�֡�ҷ����ҧ
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Pinya
* @access private
* @created 29/09/2014
*/

class benefitReasonOut extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>��ú�è�����觵�駢���Ҫ��ä����кؤ�ҡ÷ҧ����֡�Ҽ���͡�ҡ�Ҫ����������Ѥâ͡�Ѻ����Ѻ�Ҫ��ä����кؤ�ҡ÷ҧ����֡�� ��ͧ�繡óշ�����˵ؤ�����������繻���ª���ͷҧ�Ҫ������ҧ�ҡ </font>";
		echo '</div>';
			
	}
	
}

?>