<?php
/**
 * @comment สำหรับ connect database cmss
 * @projectCode 56CMSS09
 * @tor 
 * @package core
 * @author Sathianphong Sukin
 * @access private
 * @created 08/07/2014
 */
session_start();
include("cmss_define.php");
$dbname = 'cmss_'.$_GET[site_id];
$siteid = $_GET[site_id];

$mode_connect = "intra";
## กรณีต้องการ connect ip ใน
if($mode_connect == "intra"){
	include("cmss_var_intra.php");
}else{
	include("cmss_var.php");	
}

include("cmss_var_config_linepagekp7.php");
include("define_config_db.php");
$host = $_SERVER[SERVER_ADDR];//รับค่า ip

//echo " Connect:::::   $dbname";

$hr_dbname = $dbname;
$aplicationpath="competency_master";
$dbnamemaster ="cmss_master"  ;
$dbsystem = "competency_system";

//Evidance Files Upload ----------------------------------
define("DB_REFDOC","cmss_refdoc");
$db_refdoc="cmss_refdoc";
$k7_store = "kp7_refdoc";
//$server_refdoc = "localhost";
$server_refdoc = "$_SERVER[SERVER_ADDR]";
$upload_limit = 999;
$upload_size = '10MB'; //limit size file uploads 214MB
//------------------------------------------------------------------------

//system data base
$gov_name = ""    ;
$ministry_name = "";
$gov_name_en = ""    ;
$connect_status =   ""   ;
$mainwebsite = "http://$_SERVER[SERVER_ADDR]/competency_cms";
$admin_email    = "";  
$servergraph = "202.129.35.106";
$masterserverip = "";
$policyFile="";
$array_full_siteid = array('5001','5002','5003','5004','5005','5006','4001','6002','6601','4005','6302','4101','7102','3405');
$array_notfull_siteid = array('3303','6502','6702','6301','8602','5101','7002','7103','7302','4802','5701','7203');


//echo HOST." ". USERNAME_HOST ." ".PASSWORD_HOST;
$myconnect = mysql_connect('61.19.255.74', 'cmss', '2010cmss') OR DIE("Unable to connect to database  ");
@mysql_select_db($dbname) or die( "<center>ไม่สามารถติดต่อฐานข้อมูลที่ท่านเรียกได้ <br> อาจเกิดจากท่านใส่รหัสพื้นที่(Siteid, $dbname )ผิด <br> กรุณาตรวจสอบอีกครั้งนะxxxx! </center>");


$iresult = mysql_query("SET character_set_results=tis-620");
$iresult = mysql_query("SET NAMES TIS620");

//include("authen_user.inc.php");

?>