<?php
/**
* @comment class ��Ǩ�ͺ��á�˹����˹��ͧ����ӹ�¡��ʶҹ�֡�ҷ����ҧ�����������ࡳ���á�˹����˹��ͧ����ӹ�¡��ʶҹ�֡�� �繵��˹觤�� �ʶҹ�֡�����
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Eakkasit Kamwong
* @access private
* @created 02/04/2014
*/

class checkPositionDPTDirectAsDirect extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>��Ǩ�ͺ�Ըա�á�˹����˹��ͧ����ӹ�¡��ʶҹ�֡�ҷ����ҧ�����������ࡳ���á�˹����˹��ͧ����ӹ�¡��ʶҹ�֡�� �繵��˹觤�� �ʶҹ�֡����� ��仵����ѡࡳ������Ըա�÷�� �.�.�.��˹� </font>";
		echo '</div>';
			
	}
	
}

?>