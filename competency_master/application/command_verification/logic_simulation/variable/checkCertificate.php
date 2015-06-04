<?php
/**
 * ตรวจสอบใบอนุญาตประกอบวิชาชีพครู
 *
 * @author  -
 * @copyright 2011 Sapphire
 * @description ตรวจสอบใบอนุญาตประกอบวิชาชีพครู
 * @param string $idcard, เลขบัตรประจำตัวประชาชน, 3659900233211 
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
			echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>กรณีที่บรรจุและแต่งตั้งในตำแหน่งที่มาตรฐานตำแหน่งกำหนดให้มีใบอนุญาตประกอบวิชาชีพให้ตรวจสอบใบอนุญาตประกอบวิชาชีพ ตามตำแหน่งและประเภทนั้นและใบอนุญาตประกอบวิชาชีพ จะต้องมีอายุการใช้อยู่</font>";
			echo '</div>';
	}
	
}

?>