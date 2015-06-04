<?
require_once("conndb_nonsession.inc.phjp");
$username = "sapphire"  ;
$password = "sprd!@#$%"  ;
$dbname ="$dbname"  ;
$db_mainobec = "obec"; 
//system data base
$sysdbname ="vc2_system_db"  ;
//province data
$prov_name = "สำนักงานการศึกษาขั้นพื้นฐาน"    ;
$prov_name_en = "OBEC"    ;
$connect_status =   "On line"   ;
$mainwebsite = "http://www.221.128.0.108/vc/"  ;
$admin_email    = " vcsystem@sapphire ";  
$servergraph = "61.7.155.245";

$policyFile="http://61.19.88.5:81/project/domainaccess.xml";




//$logintable = "$db_dataentry.login";
//$officetable = "$db_dataentry.office_detail";
$logintable = "main_menu";
$officetable = "main_menu";
$ministytable = "ministry_lbl";
$departtable = "department_lbl" ;
$maintbl = "main_menu";


$dbname = "epm_cm";
mysql_select_db($dbname) or die("cannot select database $dbname");;
$iresult = mysql_query("SET character_set_results=tis-620");
$iresult = mysql_query("SET NAMES TIS620");



//check admin
if ($_SESSION[session_depusername] == "infoadmin") $isAdmin = true; else $isAdmin = false;
if ($_SESSION[session_depusername] == "infoadmin") $isFinance = true; else $isFinance = false;

?>