<?php
/**
* @comment class ��Ǩ�ͺ�������͹����Թ��͹ �ó����Ѻ�Թ��͹���ͤ�Ҩ�ҧ�֧����٧ �������֧����٧�ͧ�ѹ�Ѻ���͵��˹�
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Eakkasit Kamwong
* @access private
* @created 02/04/2014
*/

class checkUpSalaryHightLevel extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>��Ǩ�ͺ�š������͹����Թ��͹ �ó����Ѻ�Թ��͹���ͤ�Ҩ�ҧ�֧����٧ �������֧����٧�ͧ�ѹ�Ѻ���͵��˹� ��仵������º��з�ǧ��ä�ѧ��Ҵ��¡���ԡ���¤�ҵͺ᷹����ɢͧ����Ҫ��ä������١��ҧ��ШӼ�����Ѻ�Թ��͹���ͤ�Ҩ�ҧ�֧����٧�������֧����٧�ͧ�ѹ�Ѻ���͵��˹� �.�.2550 ��з������������</font>";
		echo '</div>';
			
	}
	
}

?>