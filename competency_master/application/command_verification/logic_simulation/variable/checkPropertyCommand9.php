<?php
/**
* @comment class ��Ǩ�ͺ����觡���͹
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Eakkasit Kamwong
* @access private
* @created 29/09/2014
*/

class checkPropertyCommand9 extends utility{
	
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
             	echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>����Ǩ�ͺ�óա���Ѻ�͹����ͺ�觢ѹ�� ���ͼ�����Ѻ�Ѵ���͡�͡�ҡ��ͧ��Ǩ�ͺ������ 1 - 7 ���� ����Ǩ�ͺ��������´������� �ѧ���<br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��С�ȼš���ͺ�觢ѹ ���͡�äѴ���͡<br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;˹ѧ������¡����Һ�è�����觵�駵���ӴѺ���</font>";
          	 	echo '</div>';
		}
	
}

?>