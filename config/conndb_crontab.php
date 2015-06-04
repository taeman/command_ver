<? 
session_start();
include("cmss_var_intra.php");
include("cmss_var_config_linepagekp7.php");


$myconnect = mysql_connect(HOST, USER_CRONTAB, PASS_CRONTAB) or die("Unable to connect to database ".mysql_error());

mysql_select_db($dbnamemaster) or die( "<center>ไม่สามารถติดต่อฐานข้อมูลที่ท่านเรียกได้ <br> อาจเกิดจากท่านใส่รหัสพื้นที่(Siteid, $dbname )ผิด <br> กรุณาตรวจสอบอีกครั้ง</center>");
$iresult = mysql_query("SET character_set_results=tis-620");
$iresult = mysql_query("SET NAMES TIS620");


?>