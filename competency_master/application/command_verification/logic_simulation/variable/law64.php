<?php
/**
* @comment class �ҵ�� 64
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Eakkasit Kamwong
* @access private
* @created 28/03/2015
*/

class law64 extends utility{
	
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
             	echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>��Ǩ�ͺ��Ң���Ҫ��ä����к��ҡ÷ҧ����֡�ҷ���͡�ҡ�Ҫ�������� �����繡���͡�ҡ�Ҫ���������ҧ���ͧ��Ժѵ�˹�ҷ���Ҫ��� �������Ѥ�����Ѻ�Ҫ����繢���Ҫ��ä����кؤ�ҡ÷ҧ����֡�� �ҧ�Ҫ��û��ʧ����Ѻ���������Ѻ�Ҫ��� �����ѡࡳ������Ըա�÷��.�.�. ���˹�
				</font>";
          	 	echo '</div>';
		}
	
}

?>