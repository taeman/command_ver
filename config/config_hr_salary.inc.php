<?php
/**
* @comment ไฟล์ถูกสร้างขึ้นมาสำหรับconnect ฐานข้อมูล
* @projectCode 56CMSS09
* @tor 
* @package core
* @author Pairoj Panturat
* @access private
* @created 24/05/2014
*/

#@modify 28/06/2014 ประกาศปิดระบบเพื่อปรับปรุงข้อมูล
$dd = date('d');
$mm = date('m');
$yy = date('Y');
$hh = date('H');

if(($yy == '2014') and ($mm == "08") and ($dd == "26") and ($hh < '24')){
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-874\">";
	echo "<table width=\"640\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\" style=\"background:#FC0; font-style:italic; border-bottom-color:#F00; color:#F00; font-size:24px\">
  <tr>
    <td align=\"center\">!ประกาศปิดระบบฐานข้อมูลทะเบียนประวัติเพื่อปรับปรุงและสำรองข้อมูลของระบบฯ<br />
 ในวันที่ 25 สิงหาคม 2557 เวลา 20:00 น.  <br />
โดยจะเปิดให้บริการอีกทีในวันที่ 31 สิงหาคม  2557  เวลา 24:00 น.<br />
ขออภัยในความไม่สะดวก</td>
  </tr>
</table>";	
die;
}
session_start();
#include("function_pingip.php");
$check_intra_ip = "192.168.5.5";

$mode_connect = "intra"; 
## กรณีต้องการ connect ip ใน
#if(pingAddress($check_intra_ip) == 1){
#	include("cmss_var_intra.php");
#}else{
//include("cmss_var.php");	
#}


#@modify Suwat.k ให้เรียก connect db เป็น ip ใน
include("cmss_var_intra.php");
#@end
include("cmss_var_config_linepagekp7.php");
include("cmss_define.php");
include("define_config_db.php");
include("config_define_tables.php");


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
	echo " <script language=\"JavaScript\">  alert(\" กรุณา loginเข้าสู่ระบบอีกครั้ง \") ; </script>  " ;   
	echo " <script language=\"JavaScript\"> top.location.replace('".MAIN_URL."') </script>  " ;  
	die;
}else{
	$dbname = "cmss_".$_SESSION[secid];
	$siteid = $_SESSION[secid];
}



//echo " Connect:::::   $dbname";

$hr_dbname = $dbname;
$aplicationpath="competency_master";
$dbnamemaster ="cmss_master"  ;
$dbsystem = "competency_system";

//system data base
$gov_name = ""    ;
$ministry_name = "";
$gov_name_en = ""    ;
$connect_status =   ""   ;
$mainwebsite = MAIN_URL;
$admin_email    = "";  
$servergraph = "202.129.35.106";
$masterserverip = "";
$policyFile="";
$array_full_siteid = array('5001','5002','5003','5004','5005','5006','4001','6002','6601','4005','6302','4101','7102','3405');
$array_notfull_siteid = array('3303','6502','6702','6301','8602','5101','7002','7103','7302','4802','5701','7203');
#@modify eakkasit.k config การแสดงผลโปรไฟล์การประมวลผลอัตรากำลังย้อนหลัง
$round_back = 1;
#@end
//echo HOST." ". USERNAME_HOST ." ".PASSWORD_HOST;
$myconnect = mysql_connect(HOST, USERNAME_HOST_SALARY, PASSWORD_HOST_SALARY) OR DIE("Unable to connect to database  ");
@mysql_select_db($dbname) or die( "<center>ไม่สามารถติดต่อฐานข้อมูลที่ท่านเรียกได้ <br> อาจเกิดจากท่านใส่รหัสพื้นที่(Siteid, $dbname )ผิด <br> กรุณาตรวจสอบอีกครั้งนะxxxx! </center>");


$iresult = mysql_query("SET character_set_results=tis-620");
$iresult = mysql_query("SET NAMES TIS620");


include("authen_user.inc.php");

?>