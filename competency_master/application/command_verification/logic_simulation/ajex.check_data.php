<?php
session_start();
header("Content-Type: text/html; charset=windows-874");
include("app_config.php");

function countVariable( $var_name="" ){
	global $db_app;
	$sql = "SELECT COUNT(var_id) AS count_data FROM `cmd_variable` WHERE var_name='".$var_name."' ";
	$query = mysql_db_query( $db_app, $sql ) or die(mysql_error());
	$row = mysql_fetch_assoc($query);
	return $row['count_data'];
}

function countFunction( $func_name="" ){
	global $db_app;
	$sql = "SELECT COUNT(id_func) AS count_data FROM `cmd_function` WHERE func_name='".$func_name."' ";
	$query = mysql_db_query( $db_app, $sql ) or die(mysql_error());
	$row = mysql_fetch_assoc($query);
	return $row['count_data'];
}

function countPeriodRadub( $gcond_id="", $level_id="" ){
	global $db_app;
	$sql = "SELECT COUNT(level_id) AS count_data FROM `cmd_period_radub` WHERE gcond_id='".$gcond_id."' AND level_id='".$level_id."' ";
	$query = mysql_db_query( $db_app, $sql ) or die(mysql_error());
	$row = mysql_fetch_assoc($query);
	return $row['count_data'];
}

function countPositionRadub($profile_id="", $letter_type="", $pid="", $level_id=""){
	global $db_app;
	$sql = "SELECT COUNT(match_id) AS count_data 
				FROM `cmd_position_radub` 
				WHERE profile_id='".$profile_id."' 
				AND letter_type='".$letter_type."' 
				AND pid='".$pid."'
				AND level_id='".$level_id."' 
				";
	$query = mysql_db_query( $db_app, $sql ) or die(mysql_error());
	$row = mysql_fetch_assoc($query);
	return $row['count_data'];
}

############

$get_data = $_GET['get_data'];
$get_val = $_GET['get_val'];
$get_val1 = $_GET['get_val1'];
$get_val2 = $_GET['get_val2'];
$get_val3 = $_GET['get_val3'];
$get_val4 = $_GET['get_val4'];

if($get_data == "variable"){
	if(countVariable($get_val)>0){
		echo "true";
	}else{
		echo "false";
	}
}

if($get_data == "period_radub"){
	if(countPeriodRadub( $get_val, $get_val1 )>0){
		echo "true";
	}else{
		echo "false";
	}
}

if($get_data == "position_radub"){
	if($get_val==""){
		if(countPositionRadub($get_val1, $get_val2, $get_val3, $get_val4)>0){
			echo "true";
		}else{
			echo "false";
		}
	}else{
		echo "false";
	}
}