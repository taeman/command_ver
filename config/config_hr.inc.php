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

#@modify 28/06/2014 ประกาศปิดระบบเพื่อปรับปรุงข้อมูล
$dd = date('d');
$mm = date('m');
$yy = date('Y');
$hh = date('H');
$checkip = substr($_SERVER[REMOTE_ADDR],0,11);#180.183.157
#echo "yy = $yy :: mm= $mm :: dd = $dd :: hh = $hh";die();
if((($yy == "2015" and $mm == "05" and $dd >= '15' and $hh >= '16') and ($yy == "2015" and $mm == "05" and $dd < '18' )) and $checkip <> "180.183.157" ){#and $hh <= "09"
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-874\">";
	echo "<table width=\"640\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\" style=\"background:#FC0; font-style:italic; border-bottom-color:#F00; color:#F00; font-size:24px\">
	
  <tr>
    <td align=\"center\">!ประกาศปิดระบบฐานข้อมูลทะเบียนประวัติเพื่อปรับปรุงและสำรองข้อมูลของระบบฯ<br />
 ในวันที่ 15 พฤษภาคม 2558 เวลา 16:00 น.  <br />
โดยจะเปิดให้บริการอีกทีในวันที่ 18 พฤษภาคม  2558  เวลา 09:00 น.<br />
ขออภัยในความไม่สะดวก </td>
  </tr>
</table>";	
die;
}

define("PASS_PDF","oesa");
include("cmss_define.php");
if($_SESSION[secid]==DB_MASTER){
	$dbname = DB_MASTER;
	$siteid = 0;
}else if($_SESSION[secid]==""){
	echo " <script language=\"JavaScript\">  alert(\" กรุณา loginเข้าสู่ระบบอีกครั้ง \") ; </script>  " ;   
	echo " <script language=\"JavaScript\"> top.location.replace('http://$_SERVER[SERVER_ADDR]/competency_cms') </script>  " ;  
	die;
}else{
	$dbname = STR_PREFIX_DB.$_SESSION[secid];
	$siteid = $_SESSION[secid];
}

if($_SESSION['secid'] != '' && $_SESSION['lock_secid'][0] == ''){
	$_SESSION['lock_secid'][0] = $_SESSION['secid'];
}

$mode_connect = "intra";
#$mode_connect = "";
## กรณีต้องการ connect ip ใน
if($mode_connect == "intra"){
	include("cmss_var_intra.php");
}else{
	include("cmss_var.php");	
}
#include("cmss_var.php");	
include("cmss_var_config_linepagekp7.php");
include("define_config_db.php");
$host = $_SERVER[SERVER_ADDR];//รับค่า ip

if($secid != ""){
	$_SESSION[secid] = $secid ;
	$dbname = STR_PREFIX_DB.$secid;
	$siteid = $_SESSION[secid];
}

if($sentsecid != ""){
	$_SESSION[secid] = $sentsecid ;
	$dbname = STR_PREFIX_DB.$sentsecid;
	$siteid = $_SESSION[secid];
}

//echo " Connect:::::   $dbname";

$dbname = str_replace('cmss_cmss_','cmss_',$dbname);
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

$myconnect = mysql_connect('127.0.0.1', USERNAME_HOST, PASSWORD_HOST) OR DIE("Unable to connect to database  ");
@mysql_select_db($dbname) or die( "<center>ไม่สามารถติดต่อฐานข้อมูลที่ท่านเรียกได้ <br> อาจเกิดจากท่านใส่รหัสพื้นที่(Siteid, $dbname )ผิด <br> กรุณาตรวจสอบอีกครั้งนะxxxx! </center>");


$iresult = mysql_query("SET character_set_results=tis-620");
$iresult = mysql_query("SET NAMES TIS620");


if($_SESSION['secid'] != $_SESSION['lock_secid'][0]){
	/*echo " <script language=\"JavaScript\">  alert(\" กรุณา loginเข้าสู่ระบบอีกครั้ง \") ; </script>  " ;   
	echo " <script language=\"JavaScript\"> top.location.replace('http://$_SERVER[SERVER_ADDR]/competency_cms') </script>  " ;  
	die;*/
}

include("authen_user.inc.php");

?>