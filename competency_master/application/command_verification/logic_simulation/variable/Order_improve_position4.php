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

class Order_improve_position4 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>�繡�û�Ѻ��ا��á��˹�����˹觢���Ҫ��ä����кؤ�ҡ÷ҧ����֡�ҵ���˹��ͧ�����ҹ�¡��ʶҹ�֡�ҷ����ҧ �����������ࡳ����С��˹�����յ���˹��ͧ�����ҹ�¡��ʶҹ�֡�����繵���˹觤���ʶҹ�֡����� �������͹��������ͻ�Ѻ��ا���˹�����˹����Ǩ�ҹǹ��ٵ�ͧ����Թࡳ���� �.�.�. ���˹� ��Ш�ҹǹ����˹觢���Ҫ��ä����кؤ�ҡ÷ҧ����֡�ҵ�ͧ����Թࡳ���ѵ�ҡ���ѧ���.�.�. ���˹� </font>";
		echo '</div>';
			
	}
	
}

?>