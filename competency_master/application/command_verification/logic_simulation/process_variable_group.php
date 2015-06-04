<?php
session_start();
header("Content-Type: text/html; charset=windows-874");
include("app_config.php");
mysql_query("SET NAMES 'tis620'");
if($_POST['group_name']!=""){
	if($_POST['group_id']!=""){
		$sql_variable_group = " 	
					UPDATE cmd_variable_group 
					SET group_name='".$_POST['group_name']."'
					WHERE group_id='".$_POST['group_id']."';
				";
	}else{
		$sql_variable_group = " 	
					INSERT INTO cmd_variable_group 
					SET group_name='".$_POST['group_name']."'
				";
	}
	
	if(mysql_db_query($db_app, iconv("utf-8","tis-620",$sql_variable_group))){
		echo "true";
	}else{
		echo "false";
	}
	
}