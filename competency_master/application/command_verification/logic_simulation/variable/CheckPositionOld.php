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

class CheckPositionOld extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>��Ǩ�ͺ���˹觷���è�����觵�� ��ͧ����§ҹ���������§ҹ��蹷������٧������� �Է°ҹ���ҷ�������Ѻ��� ����Ѻ�Թ��͹�ѹ�Ѻ��Т�鹷������٧���ҷ�������Ѻ������� ��͹�͡�ҡ�Ҫ���</font>";
		echo '</div>';
	}
	
}

?>