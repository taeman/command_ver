<?php
session_start();
@include("../../config/conndb_nonsession.inc.php");
@include("../config/conndb_nonsession.inc.php");
@include ("../../common/common_competency.inc.php");
@include ("../common/common_competency.inc.php");
@include ("../../common/class.getdata_master.php");
@include ("../common/class.getdata_master.php");
include("../register_system/lib/createInput.php");
include("../../common/datetimefunc.php");
@include("../common/datetimefunc.php");
include("../register_system/config/config.php");
include("../register_system/common/common.php");
include("lib/selectIndex.php");
include("lib/function2.php");
include("../register_system/lib/function.php");
include("config/config.php");
@include("genlink.php");
mysql_query("SET character_set_results=UTF-8");
mysql_query("SET NAMES UTF8 ");

if($_SESSION['siteid'] == ""){
	$_SESSION['siteid']  = "5001";
	
}
$dbsite = "cmss_".$_SESSION['siteid'];
?>