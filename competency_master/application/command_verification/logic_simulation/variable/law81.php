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

class law81 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>��Ǩ�ͺ��ҡ�ô��Թ���������͹حҵ�������֡�� �֡ͺ�� �٧ҹ ���ͻ�Ժѵԧҹ�Ԩ����оѲ�ҵ������º��� �.�.�. ��˹� 㹡óշ���դ������������繤�����ͧ��âͧ˹��§ҹ���ͻ���ª���͡�þѲ�Ҥس�Ҿ����֡�������ԪҪվ ���ͤس�زԢҴ�Ź ��͹��ѵ� �.�.�. ���� �.�.�.�. ࢵ��鹷�����֡�ҷ�����Ѻ�ͺ���� ��������繡�û�Ժѵ�˹�ҷ���Ҫ��� ������Է��������͹����Թ��͹������ҧ����֡�� �֡ͺ�� �����Ԩ�� ������ó� ��駹�� �����ѧ�Ѻ�ҵ�� �� ��ä��� �����仵����ѡࡳ������Ըա�÷�� �.�.�. ��˹�</font>";
		echo '</div>';
			
	}
}

?>