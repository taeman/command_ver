<?php
/**
* @comment class �ҵ�� 133
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Eakkasit Kamwong
* @access private
* @created 30/09/2014
*/

class law133 extends utility{
	
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
             	echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>����Ǩ�ͺ���������ҧ����ѧ�����Ҿ���Ҫ��ɮա� ��� �.�.�. �ѧ�����͡�� ��ͺѧ�Ѻ ����º ���ͨѴ���ҵðҹ���˹��Է°ҹ� ���͡�˹��ó�����ͻ�ԺѵԵ������Ҫ�ѭѵԹ�� ���Ӿ���Ҫ��ɮա� �� �.�. �� �.�. ��� �.�. ��� �.�. ��� ����Ѱ����� ����º �ҵðҹ��˹����˹� ���͡óշ�� �.�. ���� �.�. ��˹�������� �����ѧ�Ѻ�����������ѧ�Ѻ��͹����<br>
				&nbsp;&nbsp;&nbsp;&nbsp;㹡óշ���ջѭ��㹴�ҹ��ô��Թ��õ����ä˹����� �.�.�. ���ӹҨ�ԹԨ��ª��Ҵ<br>
				&nbsp;&nbsp;&nbsp;&nbsp;㹡óշ����Թ��������ͧ㴵������Ҫ�ѭ�ѵԹ���˹������仵���� �.�.�. ����ѧ�����ա� �.�.�. �����ͧ����������ҹӤ������ä˹������ѧ�Ѻ�� ��� �.�.�. ���Ǥ��� ��觷�˹�ҷ�� �.�.�. ����ԡ�˹���������ͧ���������ѧ�Ѻ�繡�ê��Ǥ�����</font>";
          	 	echo '</div>';
		}
	
}

?>