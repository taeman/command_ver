<?php
/**
* @comment ��Ǩ�ͺ�����������Ѻ����¹��ͧ�繼�����������Ҫ�������������¡��� 12 ��͹ �Ѻ�֧�ѹ��� 30 �ѹ��¹ �ͧ�շ��ú���³�����Ҫ���
* @projectCode 57CMSS12
* @tor  -
* @package core
* @author Wised Wisesvatcharajaren
* @access private
* @created 03/04/2015
*/
class checkreqdate extends utility{
	public function __construct($pin){
		$this->pin = $pin;
		$this->debug = "off";
		$this->dbNow = "cmss_".$this->getSiteNow($this->pin);
	}
	
	public function checkExp(){
		$sql = "SELECT
						startdate,
						CONCAT((SUBSTR(retire_label,LENGTH(retire_label)-4,LENGTH(retire_label)))-543,'-09-30') AS retireDate,
						DATE(NOW()) AS dateNow
					FROM
						general
					WHERE
					idcard = '".$this->pin."' ";
		$result = mysql_db_query($this->dbNow,$sql);
		$row = mysql_fetch_array($result);
		$arrDateDiff = $this->getPeriodReal($row['dateNow'],$row['retireDate']);
		if( (($arrDateDiff[0]*12)+$arrDateDiff[1]) >= 12 ){
			return true;
		}else{
			return false;
		}
	}
	
	 public function showExp(){
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>��Ǩ�ͺ��ѹ�����蹤Ӣ�������Ѻ�Թ��͹��� /���ͻ�ѧ��ا��á�˹����˹� ����͹����觵������ç���˹� �óշ�����Ѻ�س�ز�������� ���� 60 �ѹ �Ѻ�ѹ���ʶҹ�֡���Ѻ�ͧ�������稡���֡��</font>";
		echo '</div>';
  	}
	
}

?>