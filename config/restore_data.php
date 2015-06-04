<?php
session_start();
set_time_limit(60000); 
$nonsec="1";
$dirpath="../../";
include($dirpath."config/conndb_nonsession.inc.php");


$source_ip = "61.19.255.194";
$source_user = "sapphire";
$source_pwd = "sprd!@#$%";

define('HOST','61.19.255.74');

	
function sql_restore($table){
	global $db;
	$sql_col = "SHOW COLUMNS FROM $table";
	$resultc = mysql_db_query($db,$sql_col) or die(mysql_error()."".__LINE__);
	while($rsc = mysql_fetch_assoc($resultc)){
			if($confield > "") $confield .= ",";
			$confield .= "$rsc[Field]";
			if($conval > "") $conval .= ",";
			$conval .= "XRSS1[".$rsc['Field']."]";	
			
			#$arrval[$rsc['Field']] = $rsc['Field'];
	}
	$arr['k'] = $confield;
	$arr['v'] = $conval;
	return $arr;
}# sql_restore


function sql_restoreval($table){
	global $db;
	$sql_col = "SHOW COLUMNS FROM $table";
	$resultc = mysql_db_query($db,$sql_col) or die(mysql_error()."".__LINE__);
	while($rsc = mysql_fetch_assoc($resultc)){
			$arrval[$rsc['Field']] = $rsc['Field'];
	}

	return $arrval;
}# sql_restore




if($action == "restore"){
	$arr_table  = array('up_confirm_master'=>'con_id_master','up_confirm_detail'=>'con_id_master');
	$arr_table2 =array();
	
#	$arr_table = array('up_confirm_master'=>'con_id_master','up_confirm_detail'=>'con_id_master','up_approve_school'=>'con_id_master','up_confirm_school'=>'con_id_master'); # คีย์คือ con_id_master
	#$arr_table2 = array('up_temp_general'=>'con_general','up_temp_general_master'=>'con_general');
		
## เครื่องต้นทาง
$db = STR_PREFIX_DB.$xsiteid;

ConHost($source_ip,$source_user,$source_pwd);




$sql_source = "SELECT
		t1.con_year,
		Max(t1.con_budget) AS budget,
		t1.con_general,
		t1.con_id_master
		FROM
		$prefix.up_confirm_master AS t1
		WHERE
		t1.con_year ='".$_GET['yy']."' ";
$result_source = mysql_db_query($db,$sql_source) or die(mysql_error()."$sql_source<br>LINE__".__LINE__);	
$rs = mysql_fetch_assoc($result_source);
$con_id_master = $rs[con_id_master];
$con_general = $rs[con_general];


/*ConHost(HOST,USERNAME_HOST,PASSWORD_HOST);
$sql_insert = "INSERT INTO up_confirm_master SET con_general='$rs[con_general]',con_id_master='$rs[$con_id_master]',con_date='$rs[con_date]',con_dateconfirm='$rs[con_dateconfirm]',con_caption='$rs[con_caption]',con_year='$rs[con_year]',con_budget='$rs[con_budget]',con_status='$rs[con_status]',con_templateid='$rs[con_templateid]',con_step='$rs[con_step]',ref_confirm='$rs[ref_confirm]',show_status='$rs[show_status]',profile_type='$rs[profile_type]',cmdorder='$rs[cmdorder]',profile_group='$rs[profile_group]' ";
mysql_db_query($db,$sql_insert) or die(mysql_error()."".__LINE__);*/



foreach($arr_table as $key => $val){
	ConHost($source_ip,$source_user,$source_pwd);
	
	$arrkeyfield = sql_restoreval($key); ## 

	
	$sqls = "SELECT * FROM $key WHERE $val = '$con_id_master'";
	echo $sqls."<hr>";
	
	echo "<pre>";
	print_r($arrkeyfield);
	
	$results = mysql_db_query($db,$sqls) or die(mysql_error()."".__LINE__);
	
	while($rss = mysql_fetch_assoc($results)){
		foreach($arrkeyfield as $k => $v){
				if($strval > "") $strval .=",";
				$strval .= "'".$rss[$k]."'";
				
				if($strkey > "") $strkey .=",";
				$strkey .= "$k";
		}# end 
		
	echo  "host ::  ".HOST .",user :: ". USERNAME_HOST  .",pwd :: ". PASSWORD_HOST ."<br>";
		
		#ConHost(HOST,USERNAME_HOST,PASSWORD_HOST);
			$sqlinsert = "INSERT INTO $key (".$strkey.") VALUES(".$strval.")";
			echo " sql ::: $sqlinsert<hr>";
			
			$strval = "";
			$strkey = "";
			
	}
		
		
		#ConHost($source_ip,$source_user,$source_pwd);
}



/*foreach($arr_table2 as $key => $val){
	ConHost($source_ip,$source_user,$source_pwd);
	$arr_restoresql = sql_restore($key);
	
	$sqls = "SELECT * FROM $key WHERE $val = '$con_id_master'";
	$results = mysql_db_query($db,$sqls) or die(mysql_error()."".__LINE__);
	while($rss = mysql_fetch_assoc($results)){
		$val1 = str_replace('XRSS1','$$rss',$arr_restoresql['v']);
		
		ConHost(HOST,USERNAME_HOST,PASSWORD_HOST);
			$sqlinsert = "INSERT INTO $key (".$arr_restoresql['k'].") VALUES($val1)";
			echo "$sqlinsert<hr>";
	}
	ConHost($source_ip,$source_user,$source_pwd);
		
}*/



}#if($action == "restore")





?>