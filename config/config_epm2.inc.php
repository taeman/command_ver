<?
include_once("../../config/config_hr.inc.php");

$logintable = "login";
$officetable = "office_detail";
$ministytable = "ministry_lbl";
$departtable = "department_lbl" ;
$maintbl = "epm_main_menu";
$epm_staff = "epm_staff";
$epm_staffgroup = "epm_staffgroup";
$epm_groupmember = "epm_groupmember";



// $dbname = "epm";
mysql_select_db($dbname) or die("cannot select database $dbname");;

//check admin
# if ($_SESSION[session_depusername] == "infoadmin") $isAdmin = true; else $isAdmin = false;
# if ($_SESSION[session_depusername] == "infoadmin") $isFinance = true; else $isFinance = false;

?>