<?php
/**
* @comment class ��Ǩ�ͺ�����
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Eakkasit Kamwong
* @access private
* @created 29/09/2014
*/

class checkPropertyCommand6 extends utility{
	
		public function __construct($idcard=""){
		$this->debug = "off";
		$this->idcard = $idcard;
		$this->siteNow = $this->getSiteNow($this->idcard);
	    $this->dbNow = "cmss_".$this->siteNow;
	}
		
		public function checkExp(){
			return true;
		}
		public function showExp(){
				
			echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
             	echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>����Ǩ�ͺ���������Ѻ�Թ��͹ ���任�Ժѵԧҹ�����Ԥ���Ѱ����� ������Ѻ�Թ��͹��ͺ��û����Թ�š�û�Ժѵ��Ҫ��� ����Թ������ 3 �ͧ�ҹ�Թ��͹��������Ѻ�����͹�͡�ҡ�Ҫ��÷�駹���ͧ��� �٧�����Թ��͹����٧�ش�ͧ���˹� ��������§ҹ����ѹ�Ѻ����èء�Ѻ㹡óշ���ա�û�Ѻ�ѭ���Թ��͹��鹵�� ����٧ ������Ѻ�Թ��͹������Ѻ��������������ѵ��㹺ѭ�շ���Ѻ�������</font>";
          	 	echo '</div>';
		}
	
}

?>