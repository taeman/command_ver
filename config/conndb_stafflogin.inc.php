<?
$epmdb = "emp" ; 
function  epm_dailyreport(){
	//$host = "192.168.2.11"  ;
	$host = "202.129.35.99"  ;
	#$host = "localhost"  ;

	$username = "sapphire"  ;
	$password = "sprd!@#$%"  ;
	$dbname ="epm"  ;

	$link1 =MYSQL_CONNECT($host, $username, $password) ;
	if (!$link1) {    DIE(mysql_error() ."Unable to connect to HOST  $host");  }
	$con1 =  mysql_select_db($dbname , $link1)  ;
	if (!($con1)) {     die( mysql_error() . "Unable to select database $dbname   ");  }

	$iresult = mysql_query("SET character_set_results=tis-620");
	$iresult = mysql_query("SET NAMES TIS620");
	return($dbname) ;
}
########################################################
function get_epmusername($txtusername,$txtpassword){ 
//	$host = "192.168.2.11"  ;
	$host = "202.129.35.99"  ;
#	$host = "localhost"  ;

	$username = "sapphire"  ;
	$password = "sprd!@#$%"  ;
	$dbname ="epm"  ;

	$link1 =MYSQL_CONNECT($host, $username, $password) ;
	if (!$link1) {    DIE(mysql_error() ."Unable to connect to HOST  $host");  }
	$con1 =  mysql_select_db($dbname , $link1)  ;
	if (!($con1)) {     die( mysql_error() . "Unable to select database $dbname   ");  }

	$iresult = mysql_query("SET character_set_results=tis-620");
	$iresult = mysql_query("SET NAMES TIS620");
	##========================================================== END connect db
	$sql1 = "  SELECT * FROM `epm_staff` WHERE username = '$txtusername'  ";
	$result1 = @mysql_db_query($dbname , $sql1) ; 

	if (@mysql_num_rows($result1) > 0 ){ 
		$rs1 = @mysql_fetch_assoc($result1) ; 
		if ($txtpassword == $rs1[password]){
				$tmpname =  $rs1[prename] .$rs1[staffname] ."  ".$rs1[staffsurname]  ;
				$arr_return[0]  =  $tmpname  ; 
				$arr_return["find"]  =  "ok" ;
				$arr_return["id"]  =  $rs1[staffid] ;
				$arr_return["name"]  =  $tmpname ;
				$arr_return["email"]  =  $rs1[email] ;
				$arr_return["tel"]  =  $rs1[telno] ;
		}else{
			$arr_return["find"]  =  "" ;
		} ##############  if ($txtpassword == $rs[password]){
	} ##  if (@mysql_num_rows($result1) > 0 ){ 
			echo mysql_error() ; 
return $arr_return ; 
} #######  END function get_username($txtusername){ 
?>