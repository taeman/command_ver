<? 
session_start();
include("cmss_var_intra.php");
include("cmss_var_config_linepagekp7.php");


$myconnect = mysql_connect(HOST, USER_CRONTAB, PASS_CRONTAB) or die("Unable to connect to database ".mysql_error());

mysql_select_db($dbnamemaster) or die( "<center>�������ö�Դ��Ͱҹ�����ŷ���ҹ���¡�� <br> �Ҩ�Դ�ҡ��ҹ������ʾ�鹷��(Siteid, $dbname )�Դ <br> ��سҵ�Ǩ�ͺ�ա����</center>");
$iresult = mysql_query("SET character_set_results=tis-620");
$iresult = mysql_query("SET NAMES TIS620");


?>