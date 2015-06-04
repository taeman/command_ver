<?php
#START user_information Class
###### This Program is copyright Sapphire Research and Development co.,ltd ########

###################################################################
## Version :		20100624.001 (Created/Modified; Date.RunNumber)
## Created Date :		2010-06-24 13:05
## Created By :		MR.PANITHAN FAKSEEMUANG (POP)
## E-mail :		panithan@sapphire.com	
## Tel. :			
## Company :		Sappire Research and Development Co.,Ltd. (C)All Right Reserved
###################################################################

include_once("conndb_nonsession.inc.php");

class user_information{

	private $_dbs;
	private $_table;
	private $_field_username;
	private $_field_password;
	private $_field_user_description;
	private $_field_last_login;
	private $_field_last_action;
	private $_field_last_pass_change;
	
	
	# Class Constructer define default variable
	public function user_information(){
		
		$this->_dbs = "cmss_master";
		$this->_table = "login";
		$this->_field_username = "username";
		$this->_field_pasword = "pwd";
		$this->_field_user_description = "office";
		$this->_field_last_login = "";
		$this->_field_last_action = "";
		$this->_field_last_pass_change = "";
		
	}
	
	
	#Class Constructer input value to variable from outside
	public function user_information_conf($dbs,$table){
		
		$this->_dbs = $dbs;
		$this->_table = $table;
		
	}
	
	public function setDBS($dbs){
		$this->_dbs = $dbs;
	}
	
	public function setTable($table){
		$this->_table = $table;
	}
	
	
	#Function getUser_info_by_field
	#Select from whatever field
	#Result : ResultSet (array)
	public function getUser_info_by_field($field_value,$field_user){
		
		$SQL = "SELECT * FROM ".$this->_table." WHERE ".$field_user." = '".$field_value."'";
		$rs = mysql_db_query($this->_dbs,$SQL);	
		
		if($rs == null)
			return false;
		
		$rows = mysql_num_rows($rs);
		if($rows == 0)
			return false;
			
		for($i=0;$i<$rows;$i++)
			$result[$i] = mysql_fetch_array($rs);
		
		mysql_free_result($rs);

	return $result[0];	
	}
	
	
	#Function getUsername_by_field
	#Select username from whatever field
	#Result : String
	public function getUsername_by_field($field_value,$field_user){
		
		$SQL = "SELECT ".$field_user." FROM ".$this->_table." WHERE ".$field_user." = '".$field_value."'";
		$rs = mysql_db_query($this->_dbs,$SQL);	
		
		if($rs == null)
			return false;
		
		$rows = mysql_num_rows($rs);
		if($rows == 0)
			return false;
			
		for($i=0;$i<$rows;$i++)
			$result[$i] = mysql_fetch_array($rs);
		
		mysql_free_result($rs);

	return $result[0][$field_user];	
	}
	
	
	#Function Check Password 
	#Check old password
	#Result : Boolean
	public function checkPassword($password,$username,$field_pass,$field_user){
		
		$SQL = "SELECT ".$field_pass." FROM ".$this->_table." WHERE ".$field_user." = '".$username."'";
		$rs = mysql_db_query($this->_dbs,$SQL);
		
		if($rs == null)
			return false;
			
		$rows = mysql_num_rows($rs);
		if($rows == 0)
			return false;
			
		for($i=0;$i<$rows;$i++)
			$result[$i] = mysql_fetch_array($rs);
		
			
		mysql_free_result($rs);
		$old_password = $result[0][$field_pass];
		
		if($old_password != $password)
			return false;
			
	return true;	
	}
	
	
	#Function get Password 
	#Check new password
	#Result : Field Password
	public function getPassword($username,$field_pass,$field_user){
		
		$SQL = "SELECT ".$field_pass." FROM ".$this->_table." WHERE ".$field_user." = '".$username."' LIMIT 0,1";
		$rs = mysql_db_query($this->_dbs,$SQL);
		
		if($rs == null)
			return false;
			
		$rows = mysql_num_rows($rs);
		if($rows == 0)
			return false;
			
		for($i=0;$i<$rows;$i++)
			$result[$i] = mysql_fetch_array($rs);
		
			
		mysql_free_result($rs);
			
	return $result[0][$field_pass];	
	}
	
	
	#Function change Password 
	#Get new password and update where username
	#Result : Field id
	public function changePassword($new_password,$old_password,$username,$field_pass,$field_user){
		$this->setTable("login");
		
		if($new_password == null)
			return false;
			
		if($old_password == null)
			return false;
		
		if(!$this->checkPassword($old_password,$username,$field_pass,$field_user)){
			return false;
		}
			
			$SQL = "UPDATE ".$this->_table." SET ".$field_pass." = '".$new_password."',updatetime = now() WHERE ".$field_user." = '".$username."'";
			$rs = mysql_db_query($this->_dbs,$SQL);

			$last_insert_id = mysql_query("SELECT last_insert_id() AS count");

	return $last_insert_id;
	}
	
	
   #Function get caption by appname
	public function getCaptionOne($appname){
		$this->setTable("app_list");
		
		$SQL = "SELECT caption FROM ".$this->_table." WHERE appname = '".$appname."'";
		$rs = mysql_db_query($this->_dbs,$SQL);	
		
		if($rs == null)
			return false;
		
		$rows = mysql_num_rows($rs);
		if($rows == 0)
			return false;
			
		for($i=0;$i<$rows;$i++)
			$result[$i] = mysql_fetch_array($rs);
		
		mysql_free_result($rs);

	return $result[0]["caption"];	
	}
	
	
	#Function get last login by user
	public function lastLogin($username){
		$this->setTable("log_update");
		
		$SQL = "SELECT updatetime FROM ".$this->_table." WHERE username = '".$username."' order by updatetime DESC";
		$rs = mysql_db_query($this->_dbs,$SQL);	

		if($rs == null)
			return false;
		
		$rows = mysql_num_rows($rs);
		if($rows == 0)
			return false;
			
		for($i=0;$i<$rows;$i++)
			$result[$i] = mysql_fetch_array($rs);
		
		mysql_free_result($rs);

	return $result[0]["updatetime"];	
	}
	
	
	#Function get Gid by user id from table epm_member
	public function getGid_by_uid($user_id){
		$field = "gid";
		$this->setTable("epm_groupmember");
		
		$SQL = "SELECT ".$field." FROM ".$this->_table." WHERE staffid = '".$user_id."' ORDER BY gid DESC";
		$rs = mysql_db_query($this->_dbs,$SQL);
		
		if($rs == null)
			return false;
		
		$rows = mysql_num_rows($rs);
		if($rows == 0)
			return false;
			
		for($i=0;$i<$rows;$i++)
			$result[$i] = mysql_fetch_array($rs);
		
		mysql_free_result($rs);
		
	# sent only one group
	return $result[0];
	}
	
	#Function get Secname by sec id from table eduarea
	public function getSecname_by_secid($sec_id){
		$this->setTable("eduarea");
		
		$SQL = "SELECT secname FROM ".$this->_table." WHERE secid like '%".$sec_id."%'";
		$rs = mysql_db_query("cmss_master",$SQL);

		if($rs == null)
			return false;
		
		$rows = mysql_num_rows($rs);
		if($rows == 0)
			return false;
			
		for($i=0;$i<$rows;$i++)
			$result[$i] = mysql_fetch_array($rs);
		
		mysql_free_result($rs);

	return $result[0]["secname"];
	}
	
	#Function get Secname by sec id
	public function getNlabel_by_secid($sec_id){
		
		$SQL = "SELECT epm_main_menu.NLABEL FROM login Inner Join epm_groupmember ON login.id = epm_groupmember.staffid Inner Join epm_main_menu ON epm_groupmember.gid = epm_main_menu.NID WHERE login.id =  '".$sec_id."'";
		$rs = mysql_db_query("cmss_master",$SQL);

		if($rs == null)
			return false;
		
		$rows = mysql_num_rows($rs);
		if($rows == 0)
			return false;
			
		for($i=0;$i<$rows;$i++)
			$result[$i] = mysql_fetch_array($rs);
		
		mysql_free_result($rs);
		
	return $result[0]["NLABEL"];
	}
	
	#Function get BLOB photo from table epm_main_menu from u_id
	public function getPhoto_by_gid($gid){
		$this->setTable("epm_main_menu");
		
		$SQL = "SELECT banner,NID FROM ".$this->_table." WHERE NID = '".$gid."'";
		$rs = mysql_db_query($this->_dbs,$SQL);
		
		if($rs == null)
			return false;
		
		$result = mysql_fetch_array($rs);
		
		mysql_free_result($rs);

	return $result["banner"];
	}
	
	
	public function getAuthority($gid){
		
		$SQL = "SELECT * FROM app_list INNER JOIN app_authority ON app_list.id = app_authority.appid WHERE app_authority.gid ='".$gid."' AND app_authority.authority = 1 ORDER BY app_list.id";
		
	}
	
	

########  SAPPHIRE FUNCTION DATE #######################################################################################

	
	public function MakeDate($d){
	$month 	= array( "","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.", "ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
	$monthname = array( "","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน", "กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
	
		if (!$d) return "";
	
		$d1=explode("-",$d);
		$time = explode(" ",$d1[2]);
		
		if (($d1[0] < 1)  and ($d1[1] < 1)){ return "" ; } 
			return intval($d1[2]) . " " . $monthname[intval($d1[1])] . " " . ($d1[0]+543)." ".$time[1];
	}

	
	public function retireDate($date){

		$d			= explode("-",$date);
		$year	= $d[0];
		$month	= $d[1];
		$date	= $d[2];
		
		if($month == 1 || $month == 2 || $month == 3){		
			$retire_year	= ($year < 2484) ? $year + 61 : $year + 60 ;		
		} else if($month == 10 || $month == 11 || $month == 12){		
			$retire_year 	= ($date <= 1 && $month == 10) ? $year + 60 :  $year + 61;		
		} else {
			$retire_year 	= $year + 60;
		}		

	return "30 กันยายน พ.ศ. ".$retire_year;
	}
	
	function dateLength($thaidate){

		$dx1 = explode("-",$thaidate);
		$dx1[0] = intval($dx1[0]) - 543;
		$d1 = $dx1[0] . "-" . $dx1[1] . "-" . $dx1[2];

		$d2 = date("Y-m-d");

		$diff = $this->dateDiff($d1,$d2);
	return $diff;
	}
	
	public function dateDiff($d1,$d2) {
		$mday = array(0,31,28,31,30,31,30,31,31,30,31,30,31);

		$x1 = explode("-",$d1);
		$x2 = explode("-",$d2);

		$ny = intval($x2[0]) - intval($x1[0]);

		if(intval($x1[1]) <= intval($x2[1])){  
			$nm = intval($x2[1]) - intval($x1[1]);
		}else{
			$nm = intval($x2[1]) + 12 - intval($x1[1]);
			$ny --; 
		}

		if(intval($x1[2]) <= intval($x2[2])){ 
			$nd = intval($x2[2]) - intval($x1[2]);
		}else{
			$mday[2] = date("d",mktime (0,0,0,3,0,intval($x2[0]) ));  
			$xmonth = intval($x2[1]) - 1;  
			if($xmonth <= 0){
				$xday = 31; 
			}else{
				$xday = $mday[$xmonth];
			}

			$nd = intval($x2[2]) + $xday - intval($x1[2]);
			$nm --; 

			if($nm < 0){ 
				$nm = 11;
				$ny--;
			}
		}	

	$ret = array("day" => $nd,"month" => $nm, "year" => $ny);
	return $ret;
	} 
	
########  SAPPHIRE FUNCTION DATE #######################################################################################	
		
	
	
}

?>