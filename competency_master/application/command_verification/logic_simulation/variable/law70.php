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

class law70 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>��Ǩ�ͺ��ҡ�ô��Թ��áóշ�����˵ؼŤ������� ���˹����ǹ�Ҫ������ͼ���ӹ�¡���ӹѡ�ҹࢵ��鹷�����֡�� ���������Ҫ��ä����кؤ�ҡ÷ҧ��á�֡�һ�Ш���ǹ�Ҫ��� �����ӹѡ�ҹࢵ��鹷�����֡�� ������ó� �繡�ê��Ǥ��� ���鹨ҡ���˹�˹�ҷ����� ��仵����ѡࡳ������Ըա�÷���˹�㹡� �.�.�. ���������Ѻ�Թ��͹ ����觵�� �������͹����Թ��͹ ��ô��Թ��÷ҧ�Թ����С���͡�ҡ�Ҫ��âͧ����Ҫ��ä����кؤ�ҡ÷ҧ����֡�ҵ����ä˹�������仵����ѡࡳ������Ըա�÷���˹�㹡� �.�.�.</font>";
		echo '</div>';
			
	}
}

?>