<?php
/**
* @comment class ��Ǩ�ͺ�����
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Pinya
* @access private
* @created 16/03/2015
*/

class Salary_adjustment38k1 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>�.�.�. ����������˹ѧ�����ҹѡ�ҹ �.�. ������ 2.6, 2.7, 2.8 ����Ѻ�ؤ�ҡ÷ҧ����֡����蹵���ҵ��38�. (2) �������ѧ����������˹��§ҹ�������Ǣ�ͧ���ͻ�Ժѵ�  </font>";
		echo '</div>';
			
	}
	
}

?>