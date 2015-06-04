<?php
session_start();
include("app_config.php");
require_once("read_function.php");
require_once("class/class.utility.php");

mysql_query("SET NAMES 'tis620'");
header("Content-Type: text/html; charset=windows-874");
if($_POST['var_name']!=""){
	#Begin Add data
	if($_POST['var_id']==""){
		$var_eval = $_POST['var_eval'];
		$sql_variable = " 	
						INSERT INTO cmd_variable 
						SET var_name='".$_POST['var_name']."', 
						var_detail='".$_POST['var_detail']."',
						var_eval='".addslashes($var_eval)."',
						var_type='".$_POST['var_type']."',
						var_status='".$_POST['var_status']."',
						var_update=NOW()
					";
					
		mysql_db_query($db_app, iconv("utf-8","tis-620",$sql_variable)) or die(mysql_error());
		$var_id = mysql_insert_id(); 			
		$sql_var_group = "
						INSERT INTO cmd_var_group
						SET group_id='".$_POST['group_id']."',
						var_id='".$var_id."'
					";		
		mysql_db_query($db_app, iconv("utf-8","tis-620",$sql_var_group));
			
		if($_POST['var_type']==2 && $var_id!=""){
			$arr_parameter = explode("|",$_POST['parameter']);
			$arr_defual_value = explode("|",$_POST['defual_value']);
			foreach($arr_parameter as $k=>$parameter){
				if($parameter!=""){
					$sql_param = "
								INSERT INTO cmd_param 
								SET var_id='".$var_id."',
								param_name='".$parameter."',
								param_values='".$arr_defual_value[$k]."'
							";
					
					mysql_db_query($db_app, iconv("utf-8","tis-620",$sql_param));	
				}
			}
		}
		
		if($var_id!=""){
			echo "true";
		}else{
			echo "false";
		}
	}
	#End Add data
	
	
	#Begin Update data
	if($_POST['var_id']!=""){
		$var_id = $_POST['var_id'];
		$var_eval = $_POST['var_eval'];
		$sql_variable = " 	
						UPDATE cmd_variable 
						SET var_name='".$_POST['var_name']."', 
						var_detail='".$_POST['var_detail']."',
						var_eval='".addslashes($var_eval)."',
						var_type='".$_POST['var_type']."',
						var_status='".$_POST['var_status']."',
						var_update=NOW()
						WHERE var_id='".$var_id."'
					";
					
		mysql_db_query($db_app, iconv("utf-8","tis-620",$sql_variable)) or die(mysql_error());			
		$sql_var_group = "
						UPDATE cmd_var_group
						SET group_id='".$_POST['group_id']."'
						WHERE var_id='".$var_id."'
					";		
		mysql_db_query($db_app, iconv("utf-8","tis-620",$sql_var_group));
			
		if($_POST['var_type']==2 && $var_id!=""){
			$sql_param_del = "DELETE FROM cmd_param WHERE var_id='".$var_id."' ";
			mysql_db_query($db_app, iconv("utf-8","tis-620",$sql_param_del));
				
			$arr_parameter = explode("|",$_POST['parameter']);
			$arr_defual_value = explode("|",$_POST['defual_value']);
			foreach($arr_parameter as $k=>$parameter){
				if($parameter!=""){
					$sql_param = "
								INSERT INTO cmd_param 
								SET var_id='".$var_id."',
								param_name='".$parameter."',
								param_values='".$arr_defual_value[$k]."'
							";
					
					mysql_db_query($db_app, iconv("utf-8","tis-620",$sql_param));	
				}
			}
		}
		
		if($var_id!=""){
			echo "true";
		}else{
			echo "false";
		}
	}
	#End Update data
	
}

#Begin Delete data
	if($_GET['var_id'] != ""){
		if($_GET['action'] == "delete"){
			$sql_var_del = "DELETE FROM cmd_variable WHERE var_id='".$var_id."' ";
			$query_var = mysql_db_query($db_app, iconv("utf-8","tis-620",$sql_var_del));
			
			$sql_param_del = "DELETE FROM cmd_param WHERE var_id='".$var_id."' ";
			mysql_db_query($db_app, iconv("utf-8","tis-620",$sql_param_del));
			
			if($query_var){
				echo "ลบข้อมูลเรียบร้อยแล้ว";
			}else{
				echo "ไม่สามารถลบข้อมูลได้";
			}
		}else{
			echo "No Action";
		}
	}
#Delete Delete data