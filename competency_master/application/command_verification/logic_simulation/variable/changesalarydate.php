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
class changesalarydate extends utility{
	public function __construct(){
		$this->debug = "off";
	}
	
	public function checkExp(){
		return true;
	}
	
	 public function showExp(){
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>��Ǩ�ͺ�ѹ������Ѻ�Թ��͹ ���/���ͻ�Ѻ��ا��á�˹����˹� ����͹����觵������ç���˹� �óշ�����Ѻ�س�ز�������� �Ѻ�ѹ���ʶҹ�֡���Ѻ�ͧ�������稡���֡�� ���ѹ������Ѻ�Թ��͹ ���/���ͻ�Ѻ��ا��á�˹����˹� ����͹����觵������ç���˹� �е�ͧ�����¡����ѹ���ʶҹ�֡���Ѻ�ͧ�������稡���֡�� ��м�ҹ��þԨ�ó�͹��ѵԨҡ������ӹҨ���ҧ����ó�����
�ó����Ѻ͹حҵ������֡�ҵ�� ���ͽ֡ͺ���������º����Ҫ���  ����Ǩ�ͺ�ѹ������Ѻ�Թ��͹  ���/���ͻ�Ѻ��ا��á�˹����˹� ����͹����觵������ç���˹� �Ѻ�ѹ������դ��������Ѻ��һ�Ժѵ��Ҫ��� ����ѹ������Ѻ�س�ز����� �¨е�ͧ�����¡����ѹ����դ��������Ѻ��һ�Ժѵ��Ҫ�����������¡����ѹ������Ѻ�س�ز��������</font>";
		echo '</div>';
  	}
	
}
?>