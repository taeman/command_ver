<?php
/**
* @comment class ����ʹ��Тͧʶҹм�������繢���Ҫ��� ��Ѻ������Ѻ�Ҫ���
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Pinya
* @access private
* @created 29/09/2014
*/

class RecruitmentAndAppointment3 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>��ͧ����պѭ�ռ���ͺ�觢ѹ�� �ͺ�Ѵ���͡�� ���ͼ�������Ѻ�Ѵ���͡㹵��˹觹�� ��鹺ѭ���͡�ú�è�����觵�� �����óպ�è�����觵�駼���͡�ҡ�Ҫ���仴�ç���˹觷ҧ������ͧ ������Ѥ��Ѻ������͡���
 ����Ҫԡ��Ҽ��᷹��ɮ� ��Ҫԡ�ز����������Ҫԡ��ҷ�ͧ����������͡���͵Դ���������� �����Ѻ�Ҫ��� � ��ҧ����� ���ͼ�����͡�ҡ�Ҫ�������ж١�غ��ԡ���˹�  </font>";
		echo '</div>';
			
	}
	
}

?>