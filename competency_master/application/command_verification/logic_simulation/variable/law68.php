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

class law68 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>��Ǩ�ͺ��ҡ�ô��Թ��áóշ����˹����ҧŧ ���ͼ���ç���˹��������ö��Ժѵ�˹�ҷ���Ҫ����� ��������Ҫ��ä����кؤš�÷ҧ����֡�������ѡ���Ҫ���㹵��˹觹�� ���ӹҨ���˹�ҷ�������˹觷���ѡ�ҡ��  �ҡ���Ѻ�觵���繡�������������ӹҨ˹�ҷ�����ҧ� ��������ѡ�ҡ��㹵��˹觷�˹�ҷ�������� �������ӹҨ���˹�ҷ�����ҧ���������ҧ�ѡ�ҡ��㹵��˹觵�������� �� ����º ��ͺѧ�Ѻ ��Ԥ���Ѱ����� ��Ԥ�С�����õ�������� �����դ���觢ͧ���ѧ�Ѻ�ѭ��</font>";
		echo '</div>';
			
	}
}

?>