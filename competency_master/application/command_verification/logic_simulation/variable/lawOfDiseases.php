<?php
/**
* @comment class�� �.�.�. ��Ҵ����ä
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Eakkasit Kamwong
* @access private
* @created 30/09/2014
*/

class lawOfDiseases extends utility{
	
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
             	echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>����Ǩ�ͺ�����ŵ���� �.�.�.��Ҵ����ä�����ҹ��ҧ��� <br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�������ӹҨ���������ҵ�� �� (�) ����ҵ�� �� (�) ��觾���Ҫ�ѭ�ѵ�����º����ҡ�ä����кؤ�ҡ÷ҧ����֡�� �.�. ���� �.�.�. �����Ѻ͹��ѵԨҡ����Ѱ�����͡��� �.�.�. ���ѧ���仹��<br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�ä����ҵ�� �� (�) ���<br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(�) �ä����͹����еԴ�����������з���ҡ��ҡ���繷���ѧ��¨���ѧ��<br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(�) �ѳ�ä����еԴ���<br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(�) �ä��Ҫ�ҧ����з���ҡ��ҡ���繷���ѧ��¨���ѧ��<br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(�) �ä�Դ���ʾ�Դ�����<br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(�) �ä�������������ѧ<br>
				</font>";
          	 	echo '</div>';
		}
	
}

?>