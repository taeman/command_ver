<?php
/**
 * ��Ǩ�ͺ�͹حҵ��Сͺ�ԪҪվ���
 *
 * @author  -
 * @copyright 2011 Sapphire
 * @description ��Ǩ�ͺ�͹حҵ��Сͺ�ԪҪվ���
 * @param string $idcard, �Ţ�ѵû�Шӵ�ǻ�ЪҪ�, 3659900233211 
 * @return boolean
 "
 */
class checkCertificate extends utility{
	public $idcard;
	
	public function __construct($idcard=""){
		$this->debug = "off";
		$this->idcard = $idcard;
	}
	
	public function checkExp(){
		if($_GET[service] == 'c2') return true;
		$sql = "SELECT graduate_level FROM view_general WHERE CZ_ID = '".$this->idcard."'";
		$query = mysql_db_query($this->dbMaster,$sql) or die (mysql_error());
		$row = mysql_fetch_assoc($query);
		if($row['graduate_level'] >= 40)return true;
		return false;
	}
	
	public function showExp(){
			
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
			echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>�óշ���è�����觵��㹵��˹觷���ҵðҹ���˹觡�˹�������͹حҵ��Сͺ�ԪҪվ����Ǩ�ͺ�͹حҵ��Сͺ�ԪҪվ ������˹���л������������͹حҵ��Сͺ�ԪҪվ �е�ͧ�����ء��������</font>";
			echo '</div>';
	}
	
}

?>