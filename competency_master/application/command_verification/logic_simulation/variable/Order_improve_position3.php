<?php
/**
* @comment class ���йӢͧ��û�Ѻ��ا��á��˹�����˹觤�ټ����¼���觼�ҹ�������������������оѲ�����ҧ���
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Pinya
* @access private
* @created 29/09/2014
*/

class Order_improve_position3 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>�繡�û�Ѻ��ا��á��˹�����˹觤�ټ����¼���觼�ҹ�������������������оѲ�����ҧ��� �����ѡࡳ������Ըա�÷��.�.�. ���˹� �繵���˹觤�� </font>";
		echo '</div>';
			
	}
	
}

?>