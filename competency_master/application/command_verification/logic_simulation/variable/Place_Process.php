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

class Place_Process extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>��Ǩ�ͺ��ҡ�ô��Թ����ͺ�觢ѹ ����Ըա�ô��Թ����ͺ�觢ѹ ࡳ���õѴ�Թ ��â�鹺ѭ�ռ���ͺ�觢ѹ�� ��ù���ª��ͼ���ͺ�觢ѹ��㹺ѭ��˹��仢�鹺ѭ���繼���ͺ�觢ѹ��㹺ѭ�� ��С��¡��ԡ�ѭ�ռ���ͺ�觢ѹ�� ��仵����ѡࡳ���Ըա�÷�� �.�.�. ��˹�</font>";
		echo '</div>';
			
	}
	
}

?>