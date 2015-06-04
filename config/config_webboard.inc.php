<?
require_once("conndb_nonsession.inc.phjp");

	$dbwebboard = "webboard";
# echo "==================================="; 
	$set_bgcolor1 = "#FEFEFE"; 
	$set_bgcolor2 = "#E3E3E3"; 


@mysql_select_db($dbname) or die( " X Unable to select database");


$iresult = mysql_query("SET character_set_results=tis-620");
$iresult = mysql_query("SET NAMES TIS620");
?>