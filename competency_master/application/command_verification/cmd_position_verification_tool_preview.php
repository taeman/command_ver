<?php
/**
* @comment ไฟล์ถูกสร้างขึ้นมาสำหรับการตรวจคุณสมบัติรายบุคคล
* @projectCode 56CMSS09
* @tor
* @package core
* @author Supachai
* @access public
* @created 03/07/2014
*/
//@modify Supachai 03/07/2014 ไฟล์ถูกสร้างขึ้นมาสำหรับการตรวจคุณสมบัติรายบุคคล

session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$rows_command['letter_type_name']?> เลขที่คำสั่ง <?=$rows_command['letter_code']?>-<?=$rows_command['letter_code2']?> <?=$rows_detail['prename'].$rows_detail['firstname']."  ".$rows_detail['surname']?></title>
<link rel="stylesheet" href="style_blue.css" type="text/css" media="screen" />
<style>


.style1 {color: #346f9c}


ul#detail_containTab{
	list-style:none;
	padding:0;
	margin:0;	
	width:100%;	
}
ul#detail_containTab li{
	float:left;
	width:100%;
	height: auto;	
}
/* class รูปแบบของแต่ละเนื้อหา */
.detailContent1{
	background-color: #aecde4;	
	display:block;
}
</style>
</head>

<body >
<?php
include "table_define.php";
include "../../config/conndb_nonsession.inc.php";
if($_GET['service'] == 'c1'){
	$db_app='command_verification';
}else{
	$db_app="cmss_".$_GET["xsiteid"];
}
 if($_GET['by_person'] == ''){
  $sql_person = "SELECT COUNT(*) as num FROM ".ATTACH_TABLE." WHERE letter_id = '".$_GET['letter_id']."' ORDER BY order_by ASC,attach_id ASC ";
 }else{
  $sql_person = "SELECT COUNT(*) as num FROM ".ATTACH_TABLE." WHERE letter_id = '".$_GET['letter_id']."' AND pin = '".$_GET['idcard']."' ORDER BY order_by ASC,attach_id ASC ";
 } 

 $query_person = mysql_db_query($db_app,$sql_person)or die(mysql_error());
 //@modify Piyachon 22/9/2557 สร้างหน้ารายงานใหม่มีข้อมูลเรียงต่อกัน
 $row=mysql_fetch_assoc($query_person);
 $num_person=$row['num'];
?><?php 
//@end
for($i=0;$i<$num_person;$i++){
	//$loop_page = file_get_contents("http://master.cmss-otcsc.com/competency_master/application/command_verification/cmd_position_verification_tool_preview_by_person.php?letter_id=".$_GET['letter_id']."&pos=".$i."&par=".$_GET['par']."&now=".$_GET['now']."&xsiteid=".$_GET['xsiteid']."&master_id=".$_GET['master_id']."&service=".$_GET['service']);
	$loop_page = file_get_contents("http://".APPHOST."/competency_master/application/command_verification/cmd_position_verification_tool_preview_by_person.php?letter_id=".$_GET['letter_id']."&pos=".$i."&par=".$_GET['par']."&now=".$_GET['now']."&xsiteid=".$_GET['xsiteid']."&master_id=".$_GET['master_id']."&service=".$_GET['service']);
	echo $loop_page;
	if($i != $num_person - 1){
		echo '<pagebreak><pagebreak/><div style="page-break-after: always;"></div>';
	}
	//echo "http://master.cmss-otcsc.com/competency_master/application/command_verification/cmd_position_verification_tool_preview_by_person.php?letter_id=".$_GET['letter_id']."&pos=".$i."&par=".$_GET['par']."&now=".$_GET['now']."&xsiteid=".$_GET['xsiteid']."&master_id=".$_GET['master_id']."<br>";
}
//@end
?>
</body>
</html>
