<?php
/**
* @comment class ��Ǩ�ͺ���������͵��˹�
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Eakkasit Kamwong
* @access private
* @created 30/09/2014
*/

class checkPropertyCommand12 extends utility{
	
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
             	echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>����Ǩ�ͺ�ѹ���������͹�дѺ���˹�����������Ѻ�Թ��͹��дѺ���˹觷���٧��� �����仵����ѡࡳ������Ըա�÷�� �.�.�. ��˹�  </font>";
          	 	echo '</div>';
				

		}
	
}

?>