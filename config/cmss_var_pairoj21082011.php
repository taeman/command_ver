<?  

	/*$local_ip = substr($_SERVER['REMOTE_ADDR'],0,7);

	if($local_ip == "192.168"){
		define("HOST", "192.168.2.121");
	}
	else*/

	#define("HOST", "202.129.35.121");

		define("HOST", "61.19.255.74");
		define("HOST_TEMP", "61.19.255.74");
	
	define("USERNAME_HOST","cmss");
	define("PASSWORD_HOST","2010cmss");
	define("HOST_INTRA","61.19.255.75");
	define("USERNAME_HOST_INTRA","sapphire");
	define("PASSWORD_HOST_INTRA","sprd!@#$%");
	define("APPHOST","61.19.255.75");
	define("APPHOST_INTRA","61.19.255.75");
	define("AHTTP","https://");
	define("APHTTP","http://");
	define("APPHOST_TEST","61.19.255.75");
	define("HOST_FILE","61.19.255.75");
	define("HOST_DB_INTRA","61.19.255.74");   	
	#### USER sapphire   
	define("USER_SAPPHIRE","sapphire");   
	define("PASS_SAPPHIRE","sprd!@#$%");   
	define("APPURL","https://master.cmss-otcsc.com");
	define("MAIN_URL","https://www.cmss-otcsc.com");
	
	$cms_db = "competency_cms";
	$db_competency="competency_system";
	$cmss_master="cmss_master";
	$hostgraph = "202.129.35.106";
	$servergraph = "202.129.35.106";
	$dbtemp_pobec = "temp_pobec_import";
	$now_dbname = "cmss_master";
	$dbnamemaster = "cmss_master"; 	
	$dbname_sapp = "sapphire_app";
	
	## เครื่อง face
	$host_face = "202.129.35.101";
	$user_face = "sapphire";
	$pass_face = "sprd!@#$%";
	$dbface = "faceaccess";
	$dbnameuse = "callcenter_entry";
	$dbname_temp = "temp_check_data";
	
	##  เครื่อง epm
	     $host_epm = "202.129.35.99";
	     $user_epm = "webmaster";
		 $pass_epm = "office!sprd";
		 $dbepm = "epm";
		 
		 
		$DateNData = " 1 เมษายน 2554 "; // ข้อมูล ณ.วันที่	
		$DateNData1 = " 1 เมษายน 2554";


	
	$graph_path = APHTTP."$hostgraph/graphservice/graphservice.php";  //Sapphire Graph
	
	function ConHost($host,$user,$pass){
		
				$myconnect = @mysql_connect($host,$user,$pass) OR DIE("Unable to connect to database :: $host ");
				$iresult = @mysql_query("SET character_set_results=tis-620");
				$iresult = @mysql_query("SET NAMES TIS620");
			return $myconnect;
	}
	########
	
	function conn($host=""){
				$myconnect = mysql_connect(HOST,USERNAME_HOST,PASSWORD_HOST) OR DIE("Unable to connect to database :: $host ");
				$iresult = mysql_query("SET character_set_results=tis-620");
				$iresult = mysql_query("SET NAMES TIS620");
	}
	class DBConnection{
		function getConnection(){
		 	 //change to your database server/user name/password
			mysql_connect(HOST,USERNAME_HOST,PASSWORD_HOST) or die("Could not connect: " . mysql_error());
			//change to your database name
			mysql_select_db("jqcalendar") or die("Could not select database: " . mysql_error());
		}
	}  
	
	function connectdb($server_name,$db_name,$username, $password) {       
	$server_name = HOST;
	$username = USERNAME_HOST;
	$password = PASSWORD_HOST;
	
      $link= mysql_connect($server_name, $username, $password) or die($server_name ." Unable to connect to database  ");
      mysql_select_db($db_name,$link) or die($db_name. " Unable to select database");
      mysql_query('SET CHARACTER SET tis620');
      return  $link ;
    }//end function connectdb($server_name,$db_name,$username, $password) {   
	
	function  conn_db($rshost , $actDB) {
	$rshost = HOST;
	$myconnect = mysql_connect($rshost , USERNAME_HOST, PASSWORD_HOST) OR DIE("Unable to connect to database  ");
	mysql_select_db($actDB) or die( "Unable to select database");
	$iresult = mysql_query("SET character_set_results=tis-620");
	$iresult = mysql_query("SET NAMES TIS620");
} ################################################# END function  conn_db($rshost , $actDB) { 

function connx($xx_ip){ 
	$myconnect = mysql_connect(HOST, USERNAME_HOST, PASSWORD_HOST) OR DIE("Unable to connect to database  ");
	$iresult = mysql_query("SET character_set_results=tis-620");
	$iresult = mysql_query("SET NAMES TIS620");	
}//end function connx($xx_ip){ 


	function conn_local(){
				$myconnect = @mysql_connect(HOST,USERNAME_HOST,PASSWORD_HOST) ; //OR DIE("Unable to connect to database :: $host ");
				$iresult = mysql_query("SET character_set_results=tis-620");
				$iresult = mysql_query("SET NAMES TIS620");
	}
	
function connserver($hr_host=""){ 
global 	$now_dbname;
	$myconnect = mysql_connect(HOST, USERNAME_HOST, PASSWORD_HOST)   ;  
	//@mysql_select_db($now_dbname) or die("Cannot connect to Database. ::$now_dbname  ");
	$iresult = mysql_query("SET character_set_results=tis-620");
	$iresult = mysql_query("SET NAMES TIS620");
}  ### END function connserver($hr_host){ 


function con_db($siteid){

global $dbnamemaster,$s_db;

$sql_sel = "SELECT area_info.intra_ip, eduarea.secid, eduarea.area_id FROM eduarea Inner Join area_info ON eduarea.area_id = area_info.area_id
WHERE eduarea.secid =  '$siteid' ";
//echo $sql_sel."<br>";
$result_sel = mysql_db_query($dbnamemaster,$sql_sel);
$rs_sel = mysql_fetch_assoc($result_sel);
$xdbname = "$s_db".$siteid;

//echo "$rs_sel[intra_ip], ".USERNAME_HOST.", ".PASSWORD_HOST." ".$xdbname;
if($siteid == ""){
 $myconnect = mysql_connect(HOST_TEMP, USERNAME_HOST, PASSWORD_HOST)or die("Unable to connect to database");
 @mysql_select_db('temp_check_data') or die( "<center>ไม่สามารถติดต่อฐานข้อมูลที่ท่านเรียกได้</center>");
}else{
 
 $myconnect = mysql_connect($rs_sel[intra_ip], USERNAME_HOST, PASSWORD_HOST)or die("Unable to connect to database");
 @mysql_select_db($xdbname) or die( "<center>ไม่สามารถติดต่อฐานข้อมูลที่ท่านเรียกได้</center>");
 
}


$iresult = mysql_query("SET character_set_results=tis-620");
$iresult = mysql_query("SET NAMES TIS620");

} // end function con_db($siteid){


function conn2DB()
{ 


    $conn = mysql_connect( HOST,USERNAME_HOST,PASSWORD_HOST );
    if (!$conn)
	die ("ไม่สามารถติดต่อกับ MySql ได้ ");
  mysql_select_db($db_name,$conn) 
	   or die ("ไม่สามารถเลือกใช้ฐานข้อมูลได้ ");

  $iresult = mysql_query("SET character_set_results=tis-620");
$iresult = mysql_query("SET NAMES TIS620");

}


function connect_db(){
 $link1 =MYSQL_CONNECT(HOST, USERNAME_HOST, PASSWORD_HOST) ;
if (!$link1) {
   return false;
}else{
	mysql_query("SET character_set_results=tis-620");
mysql_query("SET NAMES TIS620");

   return true;
} 
}

function conDB($host="",$username="", $password=""){
		$host = ($host!="")?$host:HOST;
		$username = ($username!="")?$username:USERNAME_HOST;
		$password = ($password!="")?$password:PASSWORD_HOST;
		$myconnect = mysql_connect($host, $username, $password ) or die("Unable to connect to database :: $host ");
		$iresult = mysql_query("SET character_set_results=tis-620");
		$iresult = mysql_query("SET NAMES TIS620");
		if(!$myconnect){
			return false;
		}else{
			return true;
		}
}
?>