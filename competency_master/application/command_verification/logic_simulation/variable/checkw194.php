<?php
/**
* @comment � 19/4 ��Ȩԡ�¹ 2548 (����͹����ͺ�觢ѹ�����ͼ�����Ѻ�Ѵ���͡)
* @projectCode 57CMSS12
* @tor  -
* @package core
* @author Kiatisak Chansawang
* @access private
* @created 02/04/2015
*/
class checkw194 extends utility{
	public function __construct(){
		$this->debug = "off";
	}
	
	public function checkExp(){
		return true;
	}
	
	 public function showExp(){
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>��Ǩ�ͺ�������Ѻ�Թ��͹������˹���Фس�زԷ���ͺ�觢ѹ���������Ѻ�Ѵ���͡ �ҡ���Ѻ�Թ��͹�٧�����ѵ���Թ��͹������˹���Фس�زԷ���ͺ�觢ѹ�� ����Ѻ�Թ��͹��ѹ�Ѻ��Т����� ���ͧ����٧�����ѹ�Ѻ��Т���٧�ش�ͧ�Թ��͹����Ѻ���˹觷���ͺ�觢ѹ���������Ѻ�Ѵ���͡</font>";
		echo '</div>';
  	}
	
}
?>