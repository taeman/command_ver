<?php
/**
* @comment class ���йӢͧ��û�Ѻ��ا��á��˹�����˹觢���Ҫ��ä����кؤ�ҡ÷ҧ����֡�ҵ���˹觤�ٷ����ҧ ����Թࡳ���ѵ�ҡ���ѧ��� �.�.�. ���˹�
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Pinya
* @access private
* @created 29/09/2014
*/

class Order_improve_position5 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>�繡�û�Ѻ��ا��á��˹�����˹觢���Ҫ��ä����кؤ�ҡ÷ҧ����֡�ҵ���˹觤�ٷ����ҧ ����Թࡳ���ѵ�ҡ���ѧ��� �.�.�. ���˹� �繵���˹��ͧ�����ҹ�¡��ʶҹ�֡���ʶҹ�֡����� �������͹��������ͻ�Ѻ��ا���˹�����˹����� ��ҹǹ����˹��ͧ�����ҹ�¡��ʶҹ�֡�ҵ�ͧ����Թࡳ���� �.�.�. ���˹� ����ѵ�ҡ���ѧ����Ҫ��ä����кؤ�ҡ÷ҧ����֡�Ңͧʶҹ�֡�ҵ�ͧ����Թࡳ���ѵ�ҡ���ѧ���.�.�. ���˹� </font>";
		echo '</div>';
			
	}
	
}

?>