<?php
/**
* @comment class ��Ǩ�ͺ�����
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Jullachai
* @access private
* @created 29/09/2014
*/

class suggestion4 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>��Ǩ�ͺ�óա���͹����ͺ�觢ѹ�����ͼ�����Ѻ�Ѵ���͡��ͧ��Ǩ�ͺ����繼�����Է�ڷ������Ѻ��ú�è�����觵���������  </font>";
		echo '</div>';
			
	}
	
}

?>