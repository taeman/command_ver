<?
require_once("conndb_nonsession.inc.phjp");
// SERVER ID 
$SERVER_ID=1; //man server www.pdc-obec.com
if ($ob_bypass ==""){  ob_start(); } 
if ($secid_bypass != ""){ $_SESSION[secid]= $secid_bypass ; }
//data database

$dbname ="cmss_master"  ;
$dbnamemaster="cmss_master";
$db_callcentry = "callcenter_entry";

$aplicationpath="competency_master";
//gov data
$gov_name = ""    ;
$ministry_name = "";
$gov_name_en = ""    ;
$connect_status =   ""   ;
$admin_email    = "";  
$servergraph = "202.129.35.106";
$masterserverip = "";
$policyFile="";

mysql_select_db($db_name) or die( "Unable to select database");


$iresult = mysql_query("SET character_set_results=tis-620");
$iresult = mysql_query("SET NAMES TIS620");

?>