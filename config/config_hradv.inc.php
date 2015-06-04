<?
session_start();
require_once("conndb_nonsession.inc.php");
$secid=$_GET['siteid'];
$_SESSION[secid] = $secid;
if($secid != ""){
	$_SESSION[secid] = $secid ;
	$dbname = "cmss_".$secid;
	$siteid = $_SESSION[secid];
}

if($sentsecid != ""){
	$_SESSION[secid] = $sentsecid ;
	$dbname = "cmss_".$sentsecid;
	$siteid = $_SESSION[secid];
}

if($_SESSION[secid]=="cmss_master"){
	$dbname = "cmss_master";
	$siteid = 0;
}else if($_SESSION[secid]==""){
	/*echo " <script language=\"JavaScript\">  alert(\" กรุณา loginเข้าสู่ระบบอีกครั้ง \") ; </script>  " ;   
	echo " <script language=\"JavaScript\"> top.location.replace('http://www.cmss-otcsc.com') </script>  " ;  
	die;*/
}else{
	$dbname = "cmss_".$_SESSION[secid];
	$siteid = $_SESSION[secid];
}



//echo " Connect:::::   $dbname";
//data database
$hr_dbname = $dbname;
$aplicationpath="competency_master";
$dbnamemaster ="cmss_master"  ;
$dbsystem = "competency_system";

//system data base
$gov_name = ""    ;
$ministry_name = "";
$gov_name_en = ""    ;
$connect_status =   ""   ;
$mainwebsite = "http://www.cmss-otcsc.com";
$admin_email    = "";  
$servergraph = "202.129.35.106";
$masterserverip = "";
$policyFile="";
$array_full_siteid = array('5001','5002','5003','5004','5005','5006','4001','6002','6601','4005','6302','4101','7102','3405');
$array_notfull_siteid = array('3303','6502','6702','6301','8602','5101','7002','7103','7302','4802','5701','7203');

@mysql_select_db($dbname) or die( "<center>ไม่สามารถติดต่อฐานข้อมูลที่ท่านเรียกได้ <br> อาจเกิดจากท่านใส่รหัสพื้นที่(Siteid, $dbname )ผิด <br> กรุณาตรวจสอบอีกครั้ง</center>");


$iresult = mysql_query("SET character_set_results=tis-620");
$iresult = mysql_query("SET NAMES TIS620");

include("authen_user.inc.php");

?>