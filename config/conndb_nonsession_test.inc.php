<? 

include("function_pingip.php");
$check_intra_ip = "192.168.5.5";
echo $check_intra_ip."<br>";
if(pingAddress($check_intra_ip) == 1){
	echo "intra";
}else{
	echo "public";
}
$mode_connect = "intra";
## �óյ�ͧ��� connect ip �
if($mode_connect == "intra"){
	include("cmss_var_intra.php");
}else{
	include("cmss_var.php");	
}
include("cmss_var_config_linepagekp7.php");
//require_once("../common/Script_CheckIdCard.php");
$SERVER_ID=1; //man server www.pdc-obec.com
if ($ob_bypass ==""){  ob_start(); } 
if ($secid_bypass != ""){ $_SESSION[secid]= $secid_bypass ; }
$db_name ="cmss_master"  ;
$dbnamemaster="cmss_master";
$dbname = "cmss_master";
$dbsystem = "competency_system";
 $dbcallcenter = "callcenter_entry";    
//system data base
$sysdbname =""  ;
$aplicationpath="competency_master";
//gov data
$gov_name = ""    ;
$ministry_name = "";
$gov_name_en = ""    ;
$connect_status =   ""   ;
$mainwebsite = "http://www.cmss-otcsc.com"  ;
$admin_email    = "";  
$servergraph = "202.129.35.106";
$masterserverip = "";
$policyFile="";
$array_full_siteid = array('5001','5002','5003','5004','5005','5006','4001','6002','6601','4005','6302','4101','7102','3405');
$array_notfull_siteid = array('3303','6502','6702','6301','8602','5101','7002','7103','7302','4802','5701','7203');
//echo "host = ".HOST ." user = ". USERNAME_HOST." pass = ". PASSWORD_HOST;
$myconnect = mysql_connect(HOST, USERNAME_HOST, PASSWORD_HOST) OR DIE("Unable to connect to database");
@mysql_select_db($dbname) or die( "<center>�������ö�Դ��Ͱҹ�����ŷ���ҹ���¡�� <br> �Ҩ�Դ�ҡ��ҹ������ʾ�鹷��(Siteid, $dbname )�Դ <br> ��سҵ�Ǩ�ͺ�ա����</center>");
$iresult = mysql_query("SET character_set_results=tis-620");
$iresult = mysql_query("SET NAMES TIS620");
$xarrmonth = array("","���Ҥ�","����Ҿѹ��","�չҤ�","����¹","����Ҥ�","�Զع�¹","�á�Ҥ�","�ԧ�Ҥ�","�ѹ��¹","���Ҥ�","��Ȩԡ�¹","�ѹ�Ҥ�");
$dbname = $db_name;

?>