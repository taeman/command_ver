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
class checkleaveout extends utility{
	public function __construct(){
		$this->debug = "off";
	}
	
	public function checkExp(){
		return true;
	}
	
	 public function showExp(){
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>��Ǩ�ͺ�ѹ����͡�ҡ�Ҫ��âͧ����Ҫ��ä����кؤ�ҡ÷ҧ����֡�� �ó��������͡�ҡ�Ҫ��� ���ŧ�ɻŴ�͡ ��������͡�ҡ�Ҫ��� ��仵������º �.�.�. ��Ҵ����ѹ�͡�ҡ�Ҫ��âͧ����Ҫ��ä����кؤ�ҡ÷ҧ����֡�� �.�. 2548</font>";
		echo '</div>';
  	}
	
}
?>