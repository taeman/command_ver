<?php
/**
* @comment class ตรวจสอบการปรับพอกขั้นตาม ว.4/2554 ไม่ถูกต้อง
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Wised Wisesvatcharajaren
* @access private
* @created 21/01/2015
*/

class checkPok extends utility{
	
		public function __construct($radub_id='',$money_befor='',$money_after=''){
			$this->debug = "off";
			$this->radub_id = $radub_id;
			$this->money_befor = $money_befor;
			$this->money_after = $money_after;
			$this->dbNow = "cmss_".$this->siteNow;
		}
		
		public function checkExp(){
			 # ตรวจสอบสไลค์ข้ามแท่ง
			$check=true;
			$sql="SELECT
			t1.radub AS radub,
			t1.level_id AS radub_id,
			t3.`level` AS `level`,
			t3.money
			FROM
			hr_addradub AS t1
			INNER JOIN tbl_salary_math_radub AS t2 ON t1.runid = t2.radub_id
			INNER JOIN tbl_salary_level AS t3 ON t2.salary_radub_id = t3.salary_radub_id
			INNER JOIN tbl_salary_radub AS t4 ON t3.salary_radub_id = t4.salary_radub_id
			WHERE
			t4.profile_id IN ((
					SELECT `tbl_salary_profile`.`profile_id` FROM `tbl_salary_profile`
					WHERE `tbl_salary_profile`.`active_status` = '1' AND (
					YEAR (now()) BETWEEN YEAR (tbl_salary_profile.date_start) AND IF (isnull(tbl_salary_profile.date_stop),YEAR(now()),YEAR (`tbl_salary_profile`.`date_stop`)))
			)) AND
			t3.`level` = '1' AND t1.level_id='".$this->radub_id."'
			GROUP BY
			t2.salary_radub_id
			ORDER BY
			t3.money ASC ";
			$result=mysql_db_query(DB_MASTER,$sql)or die(mysql_error().__LINE__);
			$row=mysql_fetch_assoc($result);
			if($this->money_befor<=$row[money] && $this->money_after>$row[money]){
				$check=false;
			}
			return $check;
		}
		public function showExp(){
				
			echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
             	echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ให้ตรวจสอบกรณีการปรับพอกขั้นตาม ว.4/2554</font>";
          	 	echo '</div>';
		}
	
}

?>