<?php
/**
* @comment class ตรวจสอบผังเงินเดือน ของ 38ค.(2)
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Kiatisak  Chansawnag
* @access private
* @created 26/03/2015
*/

class check38ksalaryfalse extends utility{
		public $salary_income;
	
		public function __construct($salary_income="", $effective_date = "", $level_id_new = ""){
			$this->debug = "off";
			$this->salary_income = $salary_income;
			$this->effective_date = $effective_date;
			$this->level_id_new =$level_id_new; 
			$this->dbNow = DB_MASTER;
		}
		
		public function checkExp(){
			$check=true;
			$sql = "SELECT
			tbl_salary_level_degree.min_salary,
			tbl_salary_level_degree.medium_salary,
			tbl_salary_level_degree.max_salary
			FROM
			tbl_salary_profile
			Inner Join tbl_salary_radub ON tbl_salary_profile.profile_id = tbl_salary_radub.profile_id
			Inner Join tbl_salary_math_radub ON tbl_salary_radub.salary_radub_id = tbl_salary_math_radub.salary_radub_id
			Inner Join hr_addradub ON hr_addradub.runid = tbl_salary_math_radub.radub_id
			Inner Join tbl_salary_level_degree ON tbl_salary_radub.salary_radub_id = tbl_salary_level_degree.salary_radub_id
			Inner Join hr_typeposition ON hr_addradub.type_id = hr_typeposition.type_id
			WHERE tbl_salary_profile.active_status='1'     AND tbl_salary_profile.profile_type='2'
			AND hr_addradub.level_id='".$this->level_id_new ."'
			AND (  '".$this->salary_income."' between tbl_salary_level_degree.min_salary and   tbl_salary_level_degree.max_salary)
			AND ( '".$this->effective_date."'   between   tbl_salary_profile.date_start and  
			if(tbl_salary_profile.date_stop is null ,'".$this->effective_date."' ,tbl_salary_profile.date_stop))
			ORDER BY hr_typeposition.type_id,tbl_salary_math_radub.salary_radub_id,tbl_salary_radub.radub_label ASC ";
			$result = mysql_db_query(DB_MASTER,$sql);
			list($min,$medium,$max) = mysql_fetch_row($result);
			$check = ($min == '') ? false : true;
			return $check;
		}
		public function showExp(){
				echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
             	echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ตรวจสอบผังเงินเดือน ของ 38ค.(2) ให้ถูกต้องตามผังเงินเดือน</font>";
          	 	echo '</div>';
				

		}
	
}

?>