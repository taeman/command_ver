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

class Place_Pass extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>��Ǩ�ͺ��ҡ�ô��Թ��ù���ª��ͼ���ͺ�觢ѹ��㹺ѭ��˹��仢�鹺ѭ���繼���ͺ�觢ѹ��㹺ѭ���������Ѻ���˹觤�ټ����� ��е��˹觺ؤ�ҡ÷ҧ����֡����蹵���ҵ�� 38 �.(2) ��仵����ѡࡳ���Ըա�÷�� �.�.�. ��˹�</font>";
		echo '</div>';
			
	}
	
}

?>