<?php
/**
* @comment ��Ǩ�ͺ���˹觡������¹���˹�
* @projectCode 57CMSS12
* @tor  -
* @package core
* @author Kiatisak Chansawang
* @access private
* @created 02/04/2015
*/
class checkRetiredate extends utility{
	public function __construct(){
		$this->debug = "off";
	}
	
	public function checkExp(){
		return true;
	}
	
	 public function showExp(){
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>��Ǩ�ͺ���������Ѻ����¹��ͧ�繼�����������Ҫ�������������¡��� 12 ��͹ �Ѻ�֧�ѹ��� 30 �ѹ��¹ �ͧ�շ��ú���³�����Ҫ���</font>";
		echo '</div>';
  	}
	
}
?>