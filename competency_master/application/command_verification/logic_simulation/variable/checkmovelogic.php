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
class checkmovelogic extends utility{
	public function __construct(){
		$this->debug = "off";
	}
	
	public function checkExp(){
		return true;
	}
	
	 public function showExp(){
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>��Ǩ�ͺ��ô��Թ�����仵��˹ѧ����ӹѡ�ҹ �.�.�. ��� ȸ 0206.3/�8 
ŧ�ѹ��� 18 �.�. 2548 ��ѡࡳ������Ըա�����¢���Ҫ��ä����кؤ�ҡ÷ҧ����֡��</font>";
		echo '</div>';
  	}
	
}
?>