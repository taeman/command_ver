<?
session_start();

$mode_connect = "intra";
## �óյ�ͧ��� connect ip �
if($mode_connect == "intra"){
	include("cmss_var_intra.php");
}else{
	include("cmss_var.php");	
}
include("cmss_var_config_linepagekp7.php");
if($xsecid != ""){
	$_SESSION[xsecid] = $xsecid ;
	$dbname = "cmss_".$xsecid;
	$siteid = $_SESSION[xsecid];
	$secid = $_SESSION[xsecid];
}

if($_SESSION[secid]=="cmss_master"){
	$dbname = "cmss_master";
	$siteid = 0;
}else if($_SESSION[xsecid]==""){
	/*echo " <script language=\"JavaScript\">  alert(\" ��س� login�������к��ա���� \") ; </script>  " ;   
	echo " <script language=\"JavaScript\"> top.location.replace('http://www.cmss-otcsc.com') </script>  " ;  
	die;*/
}else{
	$dbname = "cmss_".$_SESSION[xsecid];
	$siteid = $_SESSION[xsecid];
}



//echo " Connect:::::   $dbname";
//data database
$tbl_temp_j18 = "up_temp_general";
$hr_host="localhost";
$hr_dbname = $dbname;
$hr_username="sapphire";
$hr_password="sprd!@#$%";
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


$myconnect = mysql_connect($hr_host, $hr_username, $hr_password) OR DIE("Unable to connect to database  ");
@mysql_select_db($dbname) or die( "<center>�������ö�Դ��Ͱҹ�����ŷ���ҹ���¡�� <br> �Ҩ�Դ�ҡ��ҹ������ʾ�鹷��(Siteid, $dbname )�Դ <br> ��سҵ�Ǩ�ͺ�ա����</center>");


$iresult = mysql_query("SET character_set_results=tis-620");
$iresult = mysql_query("SET NAMES TIS620");

?>