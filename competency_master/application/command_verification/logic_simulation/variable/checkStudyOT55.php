<?php
/**
* @comment class ตรวจสอบการสไลต์ข้ามแท่งไม่ถูกต้อง
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Kiatisak  Chansawnag
* @access private
* @created 22/01/2015
*/
class checkStudyOT55 extends utility{
	
		public function __construct($idcard,$letter_code2){
			$this->debug = "off";
			$this->idcard = $idcard;
			$this->letter_code2 = $letter_code2;
			$this->dbNow = "cmss_".$this->siteNow;
		}
		
		public function checkExp(){
			$this->letter_code2 = (strlen($this->letter_code2) == 2) ? '25'.$this->letter_code2 : $this->letter_code2;
			$year = ($this->letter_code2 > 2500) ? $this->letter_code2 - 543 : $this->letter_code2;
			$date = $year.'-06-01';
			$sql = "SELECT
			(DATEDIFF('".$date."',CONCAT(SUBSTRING(t1.birthday,1,4)-543,SUBSTRING(t1.birthday,5)))/365) AS year
			FROM
			view_general AS t1
			WHERE t1.CZ_ID = '".$this->idcard."' ";
			$result=mysql_db_query(DB_MASTER,$sql)or die(mysql_error().__LINE__);
			$row=mysql_fetch_assoc($result);
			if($row['year'] > 56 ){
				return false;
			}else{
				return true;
			}
		}
		
		public function showExp(){
				
			echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
             	echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ : </b>ตรวจสอบการศึกษา ผู้ลาศึกษาจะต้องมีอายุน้อยกว่าหรือเท่ากับ 55 ปี นับถึงวันที่ 15 มิถุนายน ของปีที่เข้าการศึกษา</font>";
          	 	echo '</div>';
		}
	
}

?>