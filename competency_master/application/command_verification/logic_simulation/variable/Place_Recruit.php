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

class Place_Recruit extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>��Ǩ�ͺ��ҡ�ô��Թ����Ѻ��Ѥ��ͺ�觢ѹ���ͺ�èغؤ������Ѻ�Ҫ����繢���Ҫ��ä����кؤ�ҡ÷ҧ����֡�� ���˹觤�ټ�������仵����ѡࡳ���Ըա�÷�� �.�.�. ��˹�</font>";
		echo '</div>';
			
	}
	
}

?>