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

class CheckPropertyPos extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>��Ǩ�ͺ���˹�੾�Тͧ��������Ѻ����觵�����ӵç���˹�� ��ͧ�繼���դس���ѵ���������Ѻ����ç���˹觵���ҵðҹ���˹觹��</font>";
		echo '</div>';
			
	}
}

?>