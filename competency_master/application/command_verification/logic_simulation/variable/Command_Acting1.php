<?php
/**
* @comment class ���йӵ���������ҵ�� 53
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Pinya
* @access private
* @created 29/09/2014
*/

class Command_Acting1 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>�ҵ�� �� 㹡óշ������ռ���ç���˹觼���ӹ�¡���ӹѡ�ҹࢵ��鹷�����֡�� ������������Ҩ��Ժѵ��Ҫ����� ����ͧ����ӹ�¡���ӹѡ�ҹࢵ��鹷�����֡���ѡ���Ҫ���᷹ ������ͧ����ӹ�¡���ӹѡ�ҹࢵ��鹷�����֡�����¤� ����ŢҸԡ�ä�С�����á���֡�Ң�鹾�鹰ҹ�觵���ͧ����ӹ�¡���ӹѡ�ҹࢵ��鹷�����֡�Ҥ�㴤�˹���ѡ���Ҫ���᷹ �������ռ���ç���˹��ͧ����ӹ�¡���ӹѡ�ҹࢵ��鹷�����֡�� ������������Ҩ��Ժѵ��Ҫ����� ����ŢҸԡ�ä�С�����á���֡�Ң�鹾�鹰ҹ�觵�駢���Ҫ����ࢵ��鹷�����֡�ҫ�觴�ç���˹���º����ͧ����ӹ�¡���ӹѡ�ҹࢵ��鹷�����֡�����ʹ�ç���˹�����ӡ��Ҽ���ӹ�¡��ʶҹ�֡�����͵��˹���º��Ң��令�㴤�˹���繼���ѡ���Ҫ���᷹���� </font>";
		echo '</div>';
			
	}
	
}

?>