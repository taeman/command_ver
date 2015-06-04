<?php
session_start();
include("app_config.php");

mysql_query("SET NAMES 'tis620'");
header("Content-Type: text/html; charset=windows-874");
if($_POST){
	#Begin Add data
	if($_POST['match_id']==""){
		
		$sql_position_radub = " 	
						INSERT INTO cmd_position_radub 
						SET profile_id='".$_POST['profile_id']."', 
						pid='".$_POST['pid']."', 
						level_id='".$_POST['level_id']."',
						letter_type='".$_POST['letter_type']."',
						match_status='1',
						match_update=NOW()
					";
					
		mysql_db_query($db_app, iconv("utf-8","tis-620",$sql_position_radub)) or die(mysql_error());
		$match_id = mysql_insert_id(); 
		if($_POST['parameter']){
			$arr_parameter_all = explode("&",$_POST['parameter']);
			$arr_parameter = explode("|",$arr_parameter_all[0]);
			$arr_period = explode("|",$arr_parameter_all[1]);
			$order_by=0;
			foreach($arr_parameter as $k=>$param){
				if($param!=""){
					$order_by++;
					$sql_param = "
								INSERT INTO cmd_position_match_condition 
								SET match_id='".$match_id."',
								cond_id='".$param."',
								period='".$arr_period[$k]."',
								order_by='".$order_by."'
							";
					
					mysql_db_query($db_app, iconv("utf-8","tis-620",$sql_param));		
				}		
			}
		}
		
		if($match_id!=""){
			echo "true";
		}else{
			echo "false";
		}
	}
	#End Add data
		
	#Begin Update data
	if($_POST['match_id']!=""){
		$match_id = $_POST['match_id'];
		$sql_variable = " 	
						UPDATE  cmd_position_radub 
						SET profile_id='".$_POST['profile_id']."', 
						pid='".$_POST['pid']."', 
						level_id='".$_POST['level_id']."',
						letter_type='".$_POST['letter_type']."',
						match_status='1',
						match_update=NOW()
						WHERE match_id='".$match_id."'
					";
					
		mysql_db_query($db_app, iconv("utf-8","tis-620",$sql_variable)) or die(mysql_error());			
		
		if($_POST['parameter']){
			$sql_param_del = "DELETE FROM cmd_position_match_condition WHERE match_id='".$match_id."' ";
			mysql_db_query($db_app, iconv("utf-8","tis-620",$sql_param_del));	
			$arr_parameter_all = explode("&",$_POST['parameter']);
			$arr_parameter = explode("|",$arr_parameter_all[0]);
			$arr_period = explode("|",$arr_parameter_all[1]);
			$order_by=0;
			foreach($arr_parameter as $k=>$param){
				if($param!=""){
					$order_by++;
					$sql_param = "
								INSERT INTO cmd_position_match_condition 
								SET match_id='".$match_id."',
								cond_id='".$param."',
								period='".$arr_period[$k]."',
								order_by='".$order_by."'
							";
					
					mysql_db_query($db_app, iconv("utf-8","tis-620",$sql_param));		
				}
			}
		}
		
		if($match_id!=""){
			echo "true";
		}else{
			echo "false";
		}
	}
	#End Update data
}