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

$siteid=$_GET[siteid];
$attach_id=$_GET[attach_id];
$session_siteid=$siteid;
if(trim($_GET['service']) == ''){ # ตรวจว่าเรียกจากโปรแกรมไหน
	$_GET['service'] = 'c1';
}

$toFolder = "../../../repo_cmss/logic_result/";
# ตรวจว่าเรียกจากโปรแกรมไหน

include "../../config/conndb_nonsession.inc.php";
include "table_define.php";
include "app_function.php";
include "app_config.php";
include "logic_simulation/class/class.utility.php";
include "logic_simulation/class/class.education.php";
include "logic_simulation/class/class.position.php";
include "cmd_logic_process.php";
$sqlInclude = "SELECT * FROM cmd_variable WHERE var_type in ('3','4')";
$queryInclude = mysql_db_query($db_app,$sqlInclude)or die(mysql_error());
while($rowsInclude = mysql_fetch_array($queryInclude)){
  require_once "logic_simulation/variable/".$rowsInclude['var_eval'].".php";;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" href="style_blue.css" type="text/css" media="screen" />

<style>
.style1 {color: #346f9c}

@font-face {
    font-family: 'Thai Sans Neue Regular';
	src: url('../../common/font/ThaiSansNeue-Regular.otf');
	src: url('../../common/font/ThaiSansNeue-Regular.ttf') format('truetype');
    font-weight: normal;
    font-style: normal;
}

body,iframe,table,select,strong,input,div,textarea,a:link,ol,Ul {
		font-family:Thai Sans Neue Regular !important;
		font-size:16px !important;
}
</style>
</head>
<body>
<?php
$arr_person = array();
$arr_attach_id = array();
$arr_name = array();
$arr_pos_old = array();
$arr_pos_new = array();


if($_GET['by_person'] == ''){
	$sql_person = "SELECT * FROM ".ATTACH_TABLE." WHERE letter_id = '".$_GET['letter_id']."' ORDER BY order_by ASC,attach_id ASC ";
}else{
	$sql_person = "SELECT * FROM ".ATTACH_TABLE." WHERE letter_id = '".$_GET['letter_id']."' AND pin = '".$_GET['idcard']."' ORDER BY order_by ASC,attach_id ASC ";
} 

$query_person = mysql_db_query($db_app_site,$sql_person)or die(mysql_error());
while($rows_person = mysql_fetch_array($query_person)){
	$idcard = $rows_person['pin'];
	$arr_attach_id[] = $rows_person['attach_id'];
	$arr_name[] = $rows_person['prename'].$rows_person['firstname']."  ".$rows_person['surname'];
	$arr_pos_old[] = $rows_person['position_id_old'];
	$arr_pos_new[] = $rows_person['position_id_new'];
}

$all_pos = count($arr_person);
$_GET['pos'] = $_GET['pos']+$_GET['par'];
$attach_id = $arr_attach_id[$_GET['pos']-1];

$sql_command = "SELECT ".LETTER_TABLE.".* ,command_letter_type.letter_type_name,command_letter_type.letter_type_group
FROM ".LETTER_TABLE."
JOIN $db_app.command_letter_type ON ".LETTER_TABLE.".letter_type =  command_letter_type.letter_type
WHERE ".LETTER_TABLE.".letter_id = '".$_GET['letter_id']."' ";
$query_command = mysql_db_query($db_app_site,$sql_command)or die(mysql_error());
$rows_command = mysql_fetch_array($query_command);

$sql_detail = "SELECT ".ATTACH_TABLE.".*,".COMMAND_TABLE.".template_id
FROM ".ATTACH_TABLE."
LEFT JOIN ".COMMAND_TABLE." ON ".ATTACH_TABLE.".letter_id=".COMMAND_TABLE.".letter_id
WHERE ".ATTACH_TABLE.".letter_id = '".$_GET['letter_id']."' AND attach_id = '".$_GET[attach_id]."'";
$query_detail = mysql_db_query($db_app_site,$sql_detail)or die(mysql_error());
$rows_detail = mysql_fetch_array($query_detail);
?>
<div style="width:980px;margin:auto">
<?php
$site = get_site_now($idcard);
$dbname = "cmss_".$site;
if($_GET['service']=="c2"){
	$dbsite_name = "cmss_".$siteid;
}

if($site != ""){
	$sql_pic = "SELECT * FROM general_pic WHERE id = '$idcard' ORDER BY no DESC LIMIT 0,1 ";
	$query_pic = mysql_db_query($dbname,$sql_pic)or die(mysql_error());
	$rows_pic = mysql_fetch_array($query_pic);
	if($rows_pic['imgname'] != ""){
		$img_name = "../../../image_file/".$site."/".$rows_pic['imgname'];
	}else{
		$img_name = "images/nopicture.gif";
	} 
 	$in_system = 1;
}else{
	$img_name = "images/nopicture.gif";
	$in_system = 1;
}

if($_GET['validate'] == '1'){
	$img_name = "images/nopicture.gif";
} 
?>
<table width="980" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="189">
	<center><img src="images/logo_kks.png" width="64" /></center>	
    <table width="189" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="25"><img src="img/box_01.png" width="25" /></td>
        <td width="150" background="img/box_02.png">&nbsp;</td>
        <td width="23"><img src="img/box_04.png" width="23" /></td>
      </tr>
      <tr>
        <td background="img/box_05.png">&nbsp;</td>
        <td align="center" bgcolor="#FFFFFF"><img src="<?=$img_name?>" height="150"></td>
        <td background="img/box_07.png">&nbsp;</td>
      </tr>
      <tr>
        <td><img src="img/box_10.png" width="25" /></td>
        <td background="img/box_11.png">&nbsp;</td>
        <td><img  src="img/box_13.png" width="23" /></td>
      </tr>
    </table>
    </td>
    <td width="761" valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="3" align="center">
        <tr>
        <td align="left"><strong>
        <?php if($_GET['service'] == 'c1'){ ?>
        <font color="#000000">คำสั่ง </font> 
        <?php } ?>
        <span class="style1"><?=get_secname($rows_command['secid'],$rows_command['profile_id'])?></span>
        <span style="float:right; width:120px;">
        <?php
        $file = urlencode("http://".APPHOST."/competency_master/application/command_verification/cmd_position_verification_tool_preview.php?letter_id=".$_GET['letter_id']."&pos=0&par=1&now=&xsiteid=".$_SESSION['siteid']."&master_id=20&service=".$_GET['service']);
        ?>
        <?php
        $file_cmd = array();
        $file_cmd[0]['url'] = rawurlencode($file);
        $file_cmd[0]['type'] = 'P';
        $send_to_pdf = "../command_order/order_no/report_order_printout.php?obj_file=".rawurlencode(json_encode($file_cmd)); ?>
        </span>
        </strong>
        </td>
        </tr>
        
        <tr>
    	<td align="left">
		<?php
        $sql_letter = "SELECT * FROM ".LETTER_TABLE." WHERE letter_id = '".$_GET['letter_id']."' ";
        $query_letter = mysql_db_query($db_app_site,$sql_letter)or die(mysql_error());
        $rows_letter = mysql_fetch_array($query_letter);
        
        if($_GET['validate'] == ''){	
			?>
			<strong>
			<font color="#000000">
			เลขที่คำสั่ง  <span class="style1"><?=$rows_letter['letter_code']?>/<?=$rows_letter['letter_code2']?> 
			สั่ง ณ วันที่ <?=dateFormat($rows_letter['letter_date'],'thaidot')?></span>
			</font>
			</strong> 
			<? 
		} ?>
        </td>
        </tr>
	</table>
	</td>
  	</tr>
</table>

</div>
</body>
</html>