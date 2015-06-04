<?php
/**
* @comment class ตรวจสอบการสไลต์ข้ามแท่งไม่ถูกต้อง
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Kiatisak  Chansawnag
* @access private
* @created 21/01/2015
*/

class checkPersonDupplicate extends utility{
		public $idcard;
		public $letter_code2;
	
		public function __construct($idcard="",$letter_code2=""){
			$this->debug = "off";
			$this->idcard = $idcard;
			$this->letter_code2 = $letter_code2;
			$this->dbNow = "cmss_".$this->siteNow;
		}
		
		public function checkExp(){
			$check=true;
			$sql="SELECT
			Count(t1.pin) AS numPerson,
			t2.letter_type
			FROM
			cmd_command_letter_attach AS t1
			INNER JOIN cmd_command_letter AS t2 ON t1.letter_id = t2.letter_id
			WHERE
			t1.pin = '".$this->idcard."' AND
			t2.letter_type IN(10,135) AND
			t2.letter_code2 = '".$this->letter_code2."' ";
			$result=mysql_db_query(DB_VERIFICATION,$sql)or die(mysql_error().__LINE__);
			$row=mysql_fetch_assoc($result);
			if($row['numPerson'] > 1){
				$check=false;
			}
			return $check;
		}
		public function showExp(){
				echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
             	echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ให้ตรวจสอบอัตราเงินเดือน ตรงตามผังเงินเดือนหรือไม่</font>";
          	 	echo '</div>';
				

		}
	
}

?>