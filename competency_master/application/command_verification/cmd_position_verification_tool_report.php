<?php
/**
* @comment ���١���ҧ���������Ѻ��õ�Ǩ�س���ѵ���ºؤ��
* @projectCode 56CMSS09
* @tor
* @package core
* @author Supachai
* @access public
* @created 03/07/2014
*/
//@modify Supachai 03/07/2014 ���١���ҧ���������Ѻ��õ�Ǩ�س���ѵ���ºؤ��
session_start();
//$session_siteid = ($_SESSION['secid'] != '') ? $_SESSION['secid'] : $_SESSION['siteid'];

$siteid=$_GET[siteid];
$attach_id=$_GET[attach_id];
$session_siteid=$siteid;
//echo $session_siteid."<hr>";
//echo $db_app."<hr>";
if(trim($_GET['service']) == ''){ # ��Ǩ������¡�ҡ������˹
	$_GET['service'] = 'c1';
}

$toFolder = "../../../repo_cmss/logic_result/";
# ��Ǩ������¡�ҡ������˹

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

// �ѹ�֡�����š���Ѻ�ͧ������
if($_POST['bt_save_result'] != ""){

	$sql = "INSERT INTO ".VERI_TABLE."(result_id,attach_id,status_sys,status_per,staff_id,staff_label,comment,date_result)
	VALUES(NULL,'".$_POST['attach_id']."','".$_POST['check_by_system']."','".$_POST['check_by_person']."','".$_SESSION['session_staffid']."',
	'".$_POST['name']."','".$_POST['comment']."',NOW())";
  	mysql_db_query($db_app_site,$sql)or die(mysql_error());		

	$sql_update = "UPDATE ".ATTACH_TABLE." SET person_check = '".$_POST['check_by_person']."',person_staff_check = '".$_POST['check_by_person']."',system_check = '".$_POST['check_by_system']."'
	WHERE attach_id = '".$_POST['attach_id']."' ";	
 	mysql_db_query($db_app_site,$sql_update)or die(mysql_error());
  	
  if($_POST[preview]=='true')
  	echo '<script>alert("�к���ӡ�úѹ�֡�š�õ�Ǩ�ͺ����"); window.opener.updateRow("'.$_POST['attach_id'].'","'. $_POST['pin'].'"); window.close(); </script>';
  else
  	echo "<script>alert('�к���ӡ�úѹ�֡�š�õ�Ǩ�ͺ����');</script>";			 			 
}
// �ѹ�֡�����š���Ѻ�ͧ������


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
	//@modify Supachai 30/3/2558 �����դ��������� ����ͧ �oop ����
	$idcard = $rows_person['pin'];
	//@end
	$arr_attach_id[] = $rows_person['attach_id'];
	$arr_name[] = $rows_person['prename'].$rows_person['firstname']."  ".$rows_person['surname'];
	$arr_pos_old[] = $rows_person['position_id_old'];
	$arr_pos_new[] = $rows_person['position_id_new'];
}

	
$all_pos = count($arr_person);
$_GET['pos'] = $_GET['pos']+$_GET['par'];
//@modify Supachai 30/3/2558 �����դ��������� ����ͧ �oop ����
//$idcard = $arr_person[$_GET['pos']-1];
//@end
$attach_id = $arr_attach_id[$_GET['pos']-1];


##echo "<pre>";
##print_r($arr_person);
##echo "</pre>";
##echo "Now Pos : ".$_GET['pos']."<br>";
##echo  $arr_person[$_GET['pos']-1];

$sql_command = "SELECT ".LETTER_TABLE.".* ,command_letter_type.letter_type_name,command_letter_type.letter_type_group
FROM ".LETTER_TABLE."
JOIN $db_app.command_letter_type ON ".LETTER_TABLE.".letter_type =  command_letter_type.letter_type
WHERE ".LETTER_TABLE.".letter_id = '".$_GET['letter_id']."' ";
$query_command = mysql_db_query($db_app_site,$sql_command)or die(mysql_error());
$rows_command = mysql_fetch_array($query_command);
if($_GET['debug']=='on'){
	echo "HERE>>".$sql_command.'<hr>';
	echo '<pre>';
	print_r($_SESSION);
	echo '</pre><hr>';
}
$sql_detail = "SELECT
					".ATTACH_TABLE.".*,".COMMAND_TABLE.".template_id
				FROM
					".ATTACH_TABLE."
				LEFT JOIN ".COMMAND_TABLE." ON ".ATTACH_TABLE.".letter_id=".COMMAND_TABLE.".letter_id
				WHERE
					".ATTACH_TABLE.".letter_id = '".$_GET['letter_id']."'
				
				AND attach_id = '".$_GET[attach_id]."'";

$query_detail = mysql_db_query($db_app_site,$sql_detail)or die(mysql_error());
$rows_detail = mysql_fetch_array($query_detail);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title><?=$rows_command['letter_type_name']?> �Ţ������� <?=$rows_command['letter_code']?>-<?=$rows_command['letter_code2']?> <?=$rows_detail['prename'].$rows_detail['firstname']."  ".$rows_detail['surname']?></title>
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

<body >
<?php //@modify Piyachon 10/07/2557 ���� div ��ͺ����觡�ҧ˹�� ?>
<?php if($_GET['service'] == 'c2'){ ?>
<!--<input type="button" value="<< ��͹��Ѻ" onclick="window.location='../agenda/meeting_report_manage.php?meeting_id=<?=$_GET['meeting_id']?>' " style="margin:5px 0 0 5px" />
-->
<?php } ?>
<div style="width:980px;margin:auto">						
<?php
//$site = $_GET['siteid'];
//$site = get_site_now($idcard);
$site = get_site_now($idcard);

$dbname = "cmss_".$site;
if($_GET['service']=="c2"){
	$dbsite_name = "cmss_".$siteid;
	//$dbsite_name = "cmss_".$_SESSION['siteid'];
	//$dbsite_name = "cmss_".$_GET['siteid'];
}
//echo "site=".$site."<hr>";
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
    <td align="center" bgcolor="#FFFFFF">	
<img src="<?=$img_name?>" height="150">
	</td>
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
    <td><strong>
    <?php if($_GET['service'] == 'c1'){ ?>
    <font color="#000000">����� </font> 
    <?php } ?>
    <span class="style1"><?=get_secname($rows_command['secid'],$rows_command['profile_id'])?></span><span style="float:right; width:120px;">
	<?php
		$file = urlencode("http://".APPHOST."/competency_master/application/command_verification/cmd_position_verification_tool_preview.php?letter_id=".$_GET['letter_id']."&pos=0&par=1&now=&xsiteid=".$_SESSION['siteid']."&master_id=20&service=".$_GET['service']);
	?>
	<?php
		$file_cmd = array();
		$file_cmd[0]['url'] = rawurlencode($file);
		$file_cmd[0]['type'] = 'P';
		$send_to_pdf = "../command_order/order_no/report_order_printout.php?obj_file=".rawurlencode(json_encode($file_cmd));
		//echo "<a href=\"$send_to_pdf\" title=\"�����š�õ�Ǩ�ͺ\"  target='_blank'>�����š�õ�Ǩ�ͺ</a>";
		//echo $_GET['service']."<hr>";
	?>
			
	</td>
  </tr>
  <tr>
    <td>
	<?php
	$sql_letter = "SELECT * FROM ".LETTER_TABLE." WHERE letter_id = '".$_GET['letter_id']."' ";
	$query_letter = mysql_db_query($db_app_site,$sql_letter)or die(mysql_error());
	$rows_letter = mysql_fetch_array($query_letter);
	
    if($_GET['validate'] == ''){	
	
	?>
    <? if($rows_letter['letter_code'] !='' && $rows_letter['letter_code2'] != ''){ ?>
	<strong>
    <font color="#000000">
    �Ţ�������  <span class="style1"><?=$rows_letter['letter_code']?>/<?=$rows_letter['letter_code2']?> 
    ��� � �ѹ��� <?=dateFormat($rows_letter['letter_date'],'thaidot')?></span>
    </font>
    </strong> 
	&nbsp;
	<? } ?>
	<?php 
		//@modify Maiphrom 18/02/2015 ��Ǩ�ͺ���Ṻ�ͧ�к��Ţҹء��
		if($_GET['service']=="c2"){

				$sql_runid="SELECT runid FROM agenda_meeting_subject WHERE letter_id=".$_GET['letter_id'];
				$res_runid = mysql_db_query($dbsite_name,$sql_runid);
				$row_runid  = mysql_fetch_array($res_runid);
				$sub_meet_id=$row_runid["runid"];

				$sql_subject_attach = "/**/SELECT * FROM agenda_meeting_subject_attach WHERE sub_meet_id='$sub_meet_id'";
				$res_subject_attach = mysql_db_query($dbsite_name,$sql_subject_attach);
				if($res_subject_attach){
					while($row_subject_attach = mysql_fetch_assoc($res_subject_attach)){
						echo "<a href=\"".$row_subject_attach["system_name"]."\" target=\"_blank\"><img src=\"images/attach.png\" border=\"0\" /><font color=\"#000000\">".$row_subject_attach["real_filename"]."</font></a>";
					}
				}
		} else{	
			if($rows_letter['checklist_id'] == ""){
				$strSQLdoc_file = "SELECT doc_file_name  FROM command_letter_file WHERE letter_id='".$_GET['letter_id']."'";
				$queryDoc_file = mysql_db_query($db_app,$strSQLdoc_file);
				$rowDocFile  = mysql_fetch_assoc($queryDoc_file);
				//echo $strSQLdoc_file."<br>".$db_app."<hr>";
				//echo $_GET['service'] ."<hr>";
				
				  if($rowDocFile['doc_file_name'] != ""){ ?>
				  <a href="../command_letter/files/command/<?=$rowDocFile['doc_file_name']?>" target="_blank"><img src="images/attach.png" border="0" /><font color="#000000"><?=$rowDocFile['doc_file_name']?></font></a>
				  <?php }
				
			}else{
			   $dir_command = "../../../command_file_command/".$rows_letter['secid']."/".$rows_letter['command_file'];
			   $dir_attach = "../../../command_file_attach/".$rows_letter['secid']."/".$rows_letter['attach_file'];
			   //echo $dir_command."<br>";
			   //echo $dir_attach;
			  if(file_exists($dir_command) and $rows_letter['command_file'] != ""){ 
			  ?>	
				 <img src="images/attach.png" border="0" /><a href="<?=$dir_command?>" target="_blank"><font color="#000000">�������</font></a>&nbsp;&nbsp;
			 <?php
			 }
			 if(file_exists($dir_attach) and $rows_letter['attach_file'] != ""){
			 ?> 
				 <img src="images/attach.png" border="0" /><a href="<?=$dir_attach?>" target="_blank"><font color="#000000">���ѭ��Ṻ</font> </a>
			 <?php 
			  }
			}
		}
	}  
	?>

	</td>&nbsp;
  </tr>
  <tr>
    <td>
		<?php
			if($rows_detail['position_id_old']){
		?>
			<strong><font color="#000000">��õ�Ǩ�ͺ�س���ѵ� �ҡ���˹� </font><span class="style1"><?=$rows_detail['position_id_old']?>&nbsp;&nbsp;<?=$rows_detail['radub_old']?></span><font color="#000000"> �繵��˹� </font><span class="style1"><?=$rows_detail['position_id_new']?>&nbsp;&nbsp;<?=$rows_detail['radub_new']?></span></strong>
		<?php }else{?>
			<strong><font color="#000000">��õ�Ǩ�ͺ�س���ѵ� </font></strong>
		<?php }?>
	</td>
  </tr>
  <tr>
    <td>
<?php
include "cmd_tab_report.php";
?>   </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>


	</td>
  </tr>
</table>

	


<?php

//echo $in_system."|BB<hr>";
if($in_system == 1){

$arrCond = array();
$v14Group = 'null';
##����繤��������	
if($rows_command['letter_type'] == '2'){
	require_once "logic_simulation/variable/expProbation.php";
?>
<div style="width:980px;">                        
<div class="art-Block">
<div class="art-Block-tl"></div>
<div class="art-Block-tr"></div>
<div class="art-Block-bl"></div>
<div class="art-Block-br"></div>
<div class="art-Block-tc"></div>
<div class="art-Block-bc"></div>
<div class="art-Block-cl"></div>
<div class="art-Block-cr"></div>
<div class="art-Block-cc"></div>
<div class="art-Block-body">
<div class="art-BlockHeader">
<div class="l"></div>
<div class="r"></div>

  <div class="t"><label id="success"><img src="img/loading1.gif" align="absmiddle"></label>&nbsp;<font color="#000000" style="text-shadow: #ffffff 0.1em 0.1em 0.2em;">��õ�Ǩ�ͺ��÷��ͧ��Ժѵ��Ҫ���</font></div>

</div><div class="art-BlockContent">
<div class="art-BlockContent-body">
   <div>
  <?php
     $objExp = new expProbation($idcard,$rows_detail['pid_new'],$rows_detail['level_id_new'],$rows_detail['effective_date'],'6');
     $result = $objExp->checkExp();
     $objExp->showExp();
	 
	 $resultCond = '';
	 if($result){
   		$arrCond[] = "(1==1)";
        $txt = "<img src=\"images/accept.png\" align=\"absmiddle\" />&nbsp;<font color=\"#275980\"><b>��ҹ���͹�</b></font>";
        echo "<script>document.getElementById('success').innerHTML = '<img src=\"images/accept.png\" align=\"absmiddle\" />';</script>";
		$resultCond = 1;
     }else{   
        $arrCond[] = "(1==0)";
        $txt = "<img src=\"images/error.png\" align=\"absmiddle\" />&nbsp;<font color=\"#FF0000\"><b>����ҹ���͹�</b></font>";
        echo "<script>document.getElementById('success').innerHTML = '<img src=\"images/error.png\" align=\"absmiddle\" />';</script>";
		$resultCond = 0;
     }
	 
	
	 ##add log
	 $sqlCheck = "SELECT * FROM ".LOG_VERI_TABLE." WHERE idcard = '".$rows_detail['pin']."' AND 
	                                             attach_id = '".$rows_detail['attach_id']."' AND 
												 letter_id = '".$rows_command['letter_id']."' ";
	 $queryCheck = mysql_db_query($db_app_site,$sqlCheck)or die(mysql_error());
	 $numCheck = mysql_num_rows($queryCheck);											 
	 if($numCheck > 0){
		$sqlLog = "UPDATE ".LOG_VERI_TABLE." SET verify_probation = '".$resultCond."',
		                                  time_update = NOW()
		           WHERE idcard = '".$rows_detail['pin']."' AND 
	                     attach_id = '".$rows_detail['attach_id']."' AND 
						 letter_id = '".$rows_command['letter_id']."' ";
	 }else{
		$sqlLog = "INSERT INTO ".LOG_VERI_TABLE." SET idcard = '".$rows_detail['pin']."',
		                                      attach_id = '".$rows_detail['attach_id']."',
											  letter_id = '".$rows_command['letter_id']."',
											  verify_probation = '".$resultCond."',
											  time_update = NOW() ";
	 }
	 mysql_db_query($db_app_site,$sqlLog)or die(mysql_error()); 											 
     if($rowsCond['gcond_id'] == '8'){
	     $sqlUpdateHelp = "UPDATE ".ATTACH_TABLE." SET help_status = '".$objProcess->help."' WHERE attach_id = '".$rows_detail['attach_id']."' ";
	     mysql_db_query($db_app,$sqlUpdateHelp);
     }
     ##end log
	 
	 
	 
	 
	   $v14Group = checkV14Group($rows_detail['pid_old'],$rows_detail['pid_new']);
  ?>
   <br />
   <div style="border:1px solid #00274F; border-style:dashed; background-color: #aecde4; color:#FFFFFF; padding:3px;">&nbsp;<?=$txt?></div>
   </div>
</div>
</div>
</div>
</div>
</div>

<?php
}

$sql = "SELECT
t1.`value`
FROM
command_type_math_logic AS t1
WHERE t1.letter_type = '{$rows_command[letter_type]}' ";
$result_logic = mysql_db_query($db_app,$sql);
list($config_letter_type) = mysql_fetch_row($result_logic);

##����繤��������͹ ���� �ա������Ẻ����¹�����
/*if($rows_command['letter_type'] == '1' or ($rows_command['letter_type'] == '2' and $v14Group == '0') or $rows_command['letter_type'] == '5' or $rows_command['letter_type'] == '7'){*/
if($config_letter_type == 1){
  $letter_type = '1';
  ##�ա������Ẻ����¹�����
  if($rows_command['letter_type'] == '2' and $v14Group == '0'){
      echo '<div style="border:1px solid #00274F; width:980px; border-style:dashed; background-color: #00172F; color:#FFFFFF; padding:3px;">';
      echo '<img src="images/exclamation.png" align="absmiddle" />&nbsp;�ա������Ẻ����¹��������˹�( ���˹ѧ��� ȸ 0206.5/� 14) ���Թ��õ�Ǩ�ͺ�ҵðҹ���˹�';
      echo '</div><br>';
  }
  
##get Logic

$pid = empty($rows_detail['pid_new'])?$rows_detail['pid_old']:$rows_detail['pid_new'];
$lvid = empty($rows_detail['level_id_new'])?$rows_detail['level_id_old']:$rows_detail['level_id_new'];

//@modify Supachai 21/2/2558 �к��ҹ�Ţҹء�� �.�.�.�.ࢵ��鹷�����֡�� (agenda) �Դ���͹� ��Ǩ�ͺ������ �ҵ�� 53 
$me53 = $_GET['service']=='c2'?'AND cmd_condition.cond_id <> "26"':'';
//@end

$sqlCond = "SELECT cmd_condition.*,cmd_position_match_condition.cond_id,cmd_position_match_condition.period,cmd_position_match_condition.match_id 
            FROM cmd_position_match_condition
            JOIN cmd_position_radub ON cmd_position_radub.match_id = cmd_position_match_condition.match_id
			JOIN cmd_condition ON cmd_position_match_condition.cond_id = cmd_condition.cond_id
            WHERE  cmd_position_radub.letter_type = '".$rows_command[letter_type]."' AND
					".(($_GET['validate']=="")?" cmd_position_radub.profile_id = '".($rows_command['letter_type_group']==1?3:2)."' AND":"")."
					cmd_position_radub.pid = '".$pid."' AND
					cmd_position_radub.level_id = '".$lvid."'
					$me53
			ORDER BY cmd_condition.sortable";

if($_GET['debug'] == 'on'){
	echo "<pre>";
	echo $sqlCond;
	echo "</pre>";
}

$queryCond = mysql_db_query($db_app,$sqlCond)or die(mysql_error());
$numCond = mysql_num_rows($queryCond);


$sql = "SELECT
t1.cond_id,
t1.person_result,
t1.ref_text,
t1.ref_file
FROM cmd_logicsimulation_result AS t1
WHERE t1.attach_id = '{$attach_id}' ";
$result1 = mysql_db_query(STR_PREFIX_DB.$rows_command['secid'],$sql);
while($row_data = mysql_fetch_assoc($result1)){
	$array_result[$row_data['cond_id']] = $row_data;
}

if($numCond > 0){
$i = 1;		

?>
<style>
.logic {
    border-collapse: collapse;
}

.logic th {
    border: 1px solid #A7B9C3;
	background-color:#89B3D3;
	color:#6A3500;
}

.logic td {
    border: 1px solid #A7B9C3;
	background-color:#AECDE4;
	color:#6A3500;
}
</style>
<form action="<?php echo $action;?>" method="post" onsubmit="return save_logic_result();" enctype="multipart/form-data">			
<table width="980" class="logic">
	<tr>
    	<th rowspan="2" width="5%">�ӴѺ</th>
        <th rowspan="2" width="30%">��á�</th>
        <th rowspan="2" width="30%">��͸Ժ��</th>
        <th colspan="2">��õ�Ǩ�ͺ</th>
        <th rowspan="2" width="20%">��ҧ�ԧ</th>
    </tr>
    <tr>
    	<th width="7%">���к�</th>
        <th width="7%">�����˹�ҷ��</th>
    </tr>
<?php
while($rowsCond = mysql_fetch_array($queryCond)){ 
	$var_id = str_replace("(","",$rowsCond[cond_eval]);
	$var_id = str_replace("==true)","",$var_id );
	
	$SQL_chk_type="SELECT
	t1.var_id,
	t1.var_type
	FROM
	cmd_variable AS t1
	WHERE var_id='".$var_id."'";
	$querychk_type = mysql_db_query($db_app,$SQL_chk_type)or die(mysql_error());
	$rowchk_type = mysql_fetch_array($querychk_type);
	
	if($rowsCond['gcond_id'] == '1'){
		$objEdu = new education($idcard);
		$arr_edu = $objEdu->getEducation();
		$objEdu->showEducation();
	} 

	if($rowsCond['gcond_id'] == '4'){
		$objClass = new getPosition($idcard,$rows_detail['effective_date']);
		$objClass->checkExp();
		$objClass->showExp();
	}
?>
	<tr>
    	<td align="center" valign="top"><?=$i?></td>
        <td valign="top" id="logicTD<?=$i?>"><?=$rowsCond['cond_name']?></td>
        <td valign="top" class="notag">
		<?
		$objProcess = new logicProcess($idcard, $rows_detail['attach_id'], $rowsCond['cond_eval'], $rowsCond['period'], $eduId, $rows_detail['level_id_new']);
		$result = $objProcess->process();
		
		$resultCond = '';
		$txt = '';
		$ref_text = '';
		if($result){
			$arrCond[] = "(1==1)";
			$resultCond = 1;
		   
			$eduName = '';
			if($rowsCond['gcond_id'] == '1'){
				$eduName = " <font color='#000000'>".$objProcess->eduName.'</font>';
			}
			$system_result = "<font color=\"#275980\"><b>��ҹ $eduName</b></font>";
			$txt.="<br>";
			if($rowchk_type[var_type]=="4"){
				$ref_text = "<b>�����˵�</b><br>".$array_result[$rowsCond['cond_id']]['ref_text'];
				$ref_text .= ($array_result[$rowsCond['cond_id']]['ref_file'] != '') ? '<br><br><b>���Ṻ</b> : <a href="'.$toFolder.$rows_command['secid']."/".$array_result[$rowsCond['cond_id']]['ref_file'].'" target="_blank">��ǹ���Ŵ���Ṻ</a>' : '<br><br><b>���Ṻ</b> :';
				
				if($array_result[$rowsCond['cond_id']]['person_result'] == '1'){
					$txt = "<font color=\"#275980\"><b>��ҹ $eduName</b></font>";
				}elseif($array_result[$rowsCond['cond_id']]['person_result']  == '0'){
					$txt = "<font color=\"#FF0000\"><b>����ҹ</b></font>";
				}
			}
		 }else{
			if($rowsCond['gcond_id'] != '6'){ //����繡�õ�Ǩ�ͺ ��ͺ ���� ��ԧ����	 
				$arrCond[] = "(1==0)";
			}else{
				$arrCond[] = "(1==1)";
			}
			$resultCond = 0;
			if($rowsCond['gcond_id'] == '2' or $rowsCond['gcond_id'] == '3' or $rowsCond['gcond_id'] == '8' or $rowsCond['gcond_id'] == '9'){
				//��Ǩ�ͺ���˹觷������� 38�
				$objUtility = new utility;
				if($objUtility->check38kPos($idcard,$rows_detail['effective_date'])){
					$warning = '<br><br><font color="#cc0000"><img src="images/exclamation.png" align="absmiddle">&nbsp;<b>�к���Ǩ������ѵԡ���Ѻ�Ҫ��âͧ '.$rows_detail['prename'].$rows_detail['firstname'].'  '.$rows_detail['surname'].' 㹵��˹觷�������ؤ�ҡ÷ҧ����֡�ҵ���ҵ�� 38�.(2)</b></font>';
				}else{
					$warning = '';
				}
				$help_txt = "<font color='#000000'><br><u><b><em>����й�</em></b></u> <b>��سҵ�Ǩ�ͺ�����ŵ��仹���������</b> <br>&bull;&nbsp;�������黯Ժѵ��Ҫ���<br>&bull;&nbsp;����¹����ѵԢͧ����Ҫ��÷�ҹ���<br>&bull;&nbsp;���ʺ��ó��ô�ç���˹������͹�����</font>";
			}else{
				$help_txt = "";
			}
	   
			if($array_result[$rowsCond['cond_id']]['person_result']  == '1'){
				$check1 = "checked=\"checked\"";
				$check2 = "";
			}elseif($array_result[$rowsCond['cond_id']]['person_result']  == '0'){
				$check1 = "";
				$check2 = "checked=\"checked\"";
			}
	   
			$system_result = "<font color=\"#FF0000\"><b>����ҹ</b></font>".$help_txt.$warning;
			
			$ref_text = "<b>�����˵�</b><br>".$array_result[$rowsCond['cond_id']]['ref_text'];
			$ref_text .= ($array_result[$rowsCond['cond_id']]['ref_file'] != '') ? '<br><br><b>���Ṻ</b> : <a href="'.$toFolder.$rows_command['secid']."/".$array_result[$rowsCond['cond_id']]['ref_file'].'" target="_blank">��ǹ���Ŵ���Ṻ</a>' : '<br><br><b>���Ṻ</b> :';
			
			if($array_result[$rowsCond['cond_id']]['person_result'] == '1'){
				$txt = "<font color=\"#275980\"><b>��ҹ $eduName</b></font>";
			}elseif($array_result[$rowsCond['cond_id']]['person_result']  == '0'){
				$txt = "<font color=\"#FF0000\"><b>����ҹ</b></font>";
			}
	
			 $objProcess->getReturnId();
			 if($rowsCond['gcond_id'] == '1'){
				$eduId = $objProcess->getReturnId(); 
			 }
	 	}?>
        </td>
        <td align="center"><?=$system_result?></td>
        <td align="center"><?=$txt?></td>
        <td valign="top"><?=$ref_text?></td>
    </tr>
<?php 
 ##add log
$sqlField = "SELECT * FROM config_field_result WHERE gcond_id = '".$rowsCond['gcond_id']."' ";
$queryField = mysql_db_query($db_app,$sqlField)or die(mysql_error());
$rowsField = mysql_fetch_array($queryField);

if($rowsField['field_result'] != ''){
	$sqlCheck = "SELECT * FROM ".LOG_VERI_TABLE." WHERE idcard = '".$rows_detail['pin']."' AND 
	attach_id = '".$rows_detail['attach_id']."' AND 
	letter_id = '".$rows_command['letter_id']."' ";
	$queryCheck = mysql_db_query($db_app_site,$sqlCheck)or die(mysql_error());
	$numCheck = mysql_num_rows($queryCheck);								 
	if($numCheck > 0){
		$sqlLog = "UPDATE ".LOG_VERI_TABLE." SET ".$rowsField['field_result']." = '".$resultCond."',
		time_update = NOW()
		WHERE idcard = '".$rows_detail['pin']."' AND 
		attach_id = '".$rows_detail['attach_id']."' AND 
		letter_id = '".$rows_command['letter_id']."' ";
	}else{
		$sqlLog = "INSERT INTO ".LOG_VERI_TABLE." SET idcard = '".$rows_detail['pin']."',
		attach_id = '".$rows_detail['attach_id']."',
		letter_id = '".$rows_command['letter_id']."',
		".$rowsField['field_result']." = '".$resultCond."',
		time_update = NOW() ";
	}
	mysql_db_query($db_app_site,$sqlLog)or die(mysql_error()); 											 
}

if($rowsCond['gcond_id'] == '8'){
	$sqlUpdateHelp = "UPDATE ".ATTACH_TABLE." SET help_status = '".$objProcess->help."' WHERE attach_id = '".$rows_detail['attach_id']."' ";
	mysql_db_query($db_app,$sqlUpdateHelp);
}
$i++;} 
?>
</table>
<?    
}else{
	if($rows_command['letter_type'] == '1' or $rows_command['letter_type'] == '2'){
		$txt_info = "��辺��áС�õ�Ǩ�ͺ���˹� ".$rows_detail['position_id_new']." �дѺ ".$rows_detail['radub_new'];
	}else{
        $txt_info = "�к�����ͧ�Ѻ��õ�Ǩ�ͺ����� ������ ".$rows_command['letter_type_name']."<br>";
		$txt_info .= "<em>����������觷���к��ͧ�Ѻ���� �������͹����觵��,��������觵��<em>";
	}
?>
<br />
<br />
<table width="980" border="1" cellspacing="0" cellpadding="3" bgcolor="#275980" style="border-collapse:collapse; border-style:dashed;">
  <tr>
    <td bgcolor="#FFB9B9" align="center"><font color="#CC0000"><b><?=$txt_info?></b></font>
   
    </td>
  </tr>
</table>
<br />
<br />

<?php 
}

}else{
	
	if($rows_command['letter_type'] != '1' and $rows_command['letter_type'] != '2'){
        $txt_info = "�к�����ͧ�Ѻ��õ�Ǩ�ͺ����� ������ ".$rows_command['letter_type_name']."<br>";
		$txt_info .= "<em>����������觷���к��ͧ�Ѻ���� �������͹����觵��,��������觵��<em>";
?>
<br />
<br />
<table width="980" border="1" cellspacing="0" cellpadding="3" bgcolor="#275980" style="border-collapse:collapse; border-style:dashed;">
  <tr>
    <td bgcolor="#FFB9B9" align="center"><font color="#CC0000"><b><?=$txt_info?></b></font></td>
  </tr>
</table>
<br />
<br />
<?php		
	}
	
?>

<?php
}

   $strCond = implode("&&",$arrCond);
   if($strCond != ''){
    eval("\$strCond = $strCond;");
   }

if($_GET['validate'] == ''){
?>

<div style="width:980px;">                        
<div class="art-Block">
<div class="art-Block-tl"></div>
<div class="art-Block-tr"></div>
<div class="art-Block-bl"></div>
<div class="art-Block-br"></div>
<div class="art-Block-tc"></div>
<div class="art-Block-bc"></div>
<div class="art-Block-cl"></div>
<div class="art-Block-cr"></div>
<div class="art-Block-cc"></div>
<div class="art-Block-body">
<div class="art-BlockHeader">
<div class="l"></div>
<div class="r"></div>

  <div class="t">&nbsp;����Ѻ���˹�ҷ��</div>

</div><div class="art-BlockContent">
<div class="art-BlockContent-body">
   <div>
<form action="?letter_id=<?=$_GET['letter_id']?>&idcard=<?=$idcard?>&by_person=<?=$_GET['by_person']?>&pos=<?=($_GET['pos']-1)?>&now=<?=$_GET['now']?>&par=<?=$_GET['par']?>&service=<?=$_GET['service']?>&meeting_id=<?=$_GET['meeting_id']?>" method="post">
<table width="100%" border="0" cellspacing="0" cellpadding="3">
  <!--<tr>
    <td>&nbsp;</td>
    <td align="right"><a href="#" onClick="window.open('attach_result_history.php?attach_id=<?=$attach_id?>','_blank','addres=no,toolbar=no,status=yes,scrollbars=yes,width=900,height=350');"><font color="#FF9900"><img src="img/find.png" align="absmiddle"  border="0"/><b>����ѵԡ�õ�Ǩ�ͺ</b></font></font></a>
    <br />
    <?php
    if($rows_detail['person_check'] != ''){
		$sqlDoc = "SELECT doc_id FROM result_document WHERE letter_id = '".$rows_detail['letter_id']."' AND attach_id = '".$rows_detail['attach_id']."' ";
		$queryDoc = mysql_db_query($db_app,$sqlDoc)or die(mysql_error());
		$numDoc = mysql_num_rows($queryDoc);
		if($numDoc > 0){
			$rowsDoc = mysql_fetch_array($queryDoc);
			$edit = "1";
		}else{
			$edit = "";
		}
		
		if($rows_detail['person_check'] == '2'){
		  $verifyResult = '�ѡ��ǧ';
	    }
	    if($rows_detail['person_check'] == '1'){
		  $verifyResult = '�Ѻ��Һ';
	   }
		
		$sqlPerson = "SELECT attach_id FROM ".ATTACH_TABLE." WHERE letter_id = '".$rows_detail['letter_id']."' ";
	    $queryPerson = mysql_db_query($db_app_site,$sqlPerson)or die(mysql_error());
	    $numPerson = mysql_num_rows($queryPerson);
		
		$name = $rows_detail['prename'].$rows_detail['firstname']."  ".$rows_detail['surname'];
		
		
		echo '<a href="#" onclick="window.open(\'index.php?p=result_document&letter_id='.$rows_detail['letter_id'].'&attach_id='.$rows_detail['attach_id'].'&siteName='.$siteName.'&noOrder='.$noOrder.'&dateOrder='.$dateOrder.'&numPerson='.$numPerson.'&verifyResult='.$verifyResult.'&name='.$name.'&reason='.$reason.'&doc_type=&doc_id='.$rowsDoc['doc_id'].'&page=2&edit='.$edit.'\', \'mywindow\',\'location=1,status=1,scrollbars=1, width=1327,height=1169\')"><img src="images/page_white_paintbrush.png" align="absmiddle" border="0"><font color="#000000"><b>��ҧ˹ѧ��͵ͺ�Ѻ</b></font> </a>';
		
		
		if($numDoc > 0){
			
			echo '&nbsp;&nbsp;<a href="pdf_gen.php?doc_id='.$rowsDoc['doc_id'].'" target="_blank"">[Download]<img src="images/pdf.gif" align="absmiddle" border="0"></a>';
		}
		
	}else{
	  echo '<font color="#999999">��سҺѹ�֡�š�õ�Ǩ�ͺ��͹</font>';	
	}
	?>
    
    </td>
  </tr>-->
  <tr>
    <td width="30%"><div align="right"><strong>�š�õ���ͺ���к�</strong></div></td>
    <td width="70%">
	</font>
	<?php
	if($strCond){
	  echo "<img src=\"images/accept.png\" align=\"absmiddle\" /> <font color=\"#275980\"><b>[��ҹ]</b></font>";
	  echo "<script>document.getElementById('menu_tab').innerHTML = '<img src=\"images/accept.png\" align=\"absmiddle\" />';</script>";
	  $check_by_system = 1;
	}else{
	  echo "<img src=\"images/error.png\" align=\"absmiddle\" /> <font color=\"#cc0000\"><b>[����ҹ]</b></font>";
	  echo "<script>document.getElementById('menu_tab').innerHTML = '<img src=\"images/error.png\" align=\"absmiddle\" />';</script>";
	  $check_by_system = 0;
	}
	
	
	##update result
	if($in_system == 0){
		$check_by_system = 99;
    }
	$sqlUpdateResult = "UPDATE ".ATTACH_TABLE." SET system_check = '".$check_by_system."' WHERE attach_id = '".$rows_detail['attach_id']."' ";
	mysql_db_query($db_app_site,$sqlUpdateResult)or die(mysql_error());
	$sqlUpdateLog = "UPDATE log_verify SET verify_result = '".$check_by_system."' 
	                 WHERE  idcard = '".$rows_detail['pin']."' AND 
	                        attach_id = '".$rows_detail['attach_id']."' AND 
						    letter_id = '".$rows_command['letter_id']."' ";
	mysql_db_query($db_app,$sqlUpdateLog)or die(mysql_error());
							
	
	
	?>
	<input name="check_by_system" type="hidden" value="<?=$check_by_system?>" />
	<input name="attach_id" type="hidden" value="<?=$attach_id?>" />
    <input name="pin" type="hidden" value="<?=$rows_detail['pin']?>" />
    <input name="preview" type="hidden" value="<?=$_GET[preview]?>" />
    		</td>
  </tr>
  <tr>
    <td><div align="right"><strong>�š�õ�Ǩ�ͺ�����˹�ҷ��</strong></div></td>
	<?php 
	//@modify Supachai 19/07/2014 ������֧��Ҩҡ�ҹ������
	$verify_sql='SELECT
						*
					FROM
						'.VERI_TABLE.'
					WHERE
						attach_id = "'.$rows_detail['attach_id'].'"
					ORDER BY date_result DESC
					LIMIT 1';
	$verify_query = mysql_db_query($db_app_site, $verify_sql);
	$verify_data = mysql_fetch_assoc($verify_query);	
	//echo $verify_sql."<hr>";
	//modify Piyachon 10/07/2557 �������͹䢢�ͤ���
	if($check_by_system == '0'){
		$if_condition = " �������͹�";
	}else{
		$if_condition = "";
	}
	?>
    <td>
	<?php 
			if($verify_data[status_per]=='1'){
				$status_per_Name="��ҹ".$if_condition;
			}else if($verify_data[status_per]=='2'){
				$status_per_Name="����ҹ";
			}
			echo $status_per_Name;
	?>
	</td>
	<? //@end ?>
  </tr>
  <tr>
    <td><div align="right"><strong>�������˹�ҷ�����Ǩ�ͺ</strong></div></td>
    <td><?=$verify_data['staff_label']?></td>
  </tr>
  <tr>
    <td valign="top"><div align="right"><strong>�����˵�</strong></div></td>
    <td><?php echo $verify_data[comment];?></td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
    <td></td>
  </tr>
</table>
<?php //@end?>
</form>
   </div>
</div>
</div>
</div>
</div>
</div>

<br />
&nbsp;&nbsp;
<?php
if($_GET['pos'] > 1){
 //@modify Supachai 19/07/2014 �����駤��������ö�˹�� index ��
 //@modify Piyachon 10/07/2557 ��䢵��˹觻��� �繻������ 
 ?>
<input name="bt_next" type="button" style="position:fixed;left:5px;bottom:5px;" value="&lt;&lt; ��͹˹�� " onclick="window.location='?xsiteid=<?=$_SESSION[secid]?>&master_id=<?=$_GET[master_id]?>&letter_id=<?=$_GET['letter_id']?>&pos=<?=$_GET['pos']?>&par=-1&now=<?=$now_pos?>&service=<?=$_GET['service']?>&meeting_id=<?=$_GET['meeting_id']?>'" />
&nbsp;&nbsp;
<?php
}
if($_GET['pos'] < $all_pos){
?>
<!--
<input name="bt_next" type="button" style="position:fixed;right:5px;bottom:5px;" value="�Ѵ�  (<?php echo $_GET['pos']."/".$all_pos;?>) &gt;&gt;" onclick="window.location='?xsiteid=<?=$_SESSION[secid]?>&master_id=<?=$_GET[master_id]?>&letter_id=<?=$_GET['letter_id']?>&pos=<?=$_GET['pos']?>&par=1&now=<?=$now_pos?>&service=<?=$_GET['service']?>&meeting_id=<?=$_GET['meeting_id']?>';" />
&nbsp;&nbsp;
-->
<?php
}
if($_GET['pos'] == $all_pos){
?>

<!--<input name="bt_complete" type="button" style="position:fixed;right:5px;bottom:5px;" value=" ������鹡�кǹ��õ�Ǩ�ͺ  (<?php echo $_GET['pos']."/".$all_pos;?>) " onclick="window.location='/competency_master/application/command_order/order_no/index.php?SYSTEM=ORDER_NO&xsiteid=<?php echo $_SESSION[secid]?>&master_id=<?php echo $_GET[master_id] ?>'" />-->
<?php
//@end
//@end
}

}else{
   echo '<div style="width:980px; margin-left:5px;border:1px solid #00274F; border-style:dashed; background-color: #00172F; color:#FFFFFF; padding:3px;">';
    if($strCond){
	  echo "<img src=\"images/accept.png\" align=\"absmiddle\" /> <font color=\"#FFFFFF\"><b>[��ҹ]</b></font>";
	  echo "<script>document.getElementById('menu_tab').innerHTML = '<img src=\"images/accept.png\" align=\"absmiddle\" />';</script>";
	  $check_by_system = 1;
	}else{
	  echo "<img src=\"images/error.png\" align=\"absmiddle\" /> <font color=\"#FF9900\"><b>[����ҹ]</b></font>";
	  echo "<script>document.getElementById('menu_tab').innerHTML = '<img src=\"images/error.png\" align=\"absmiddle\" />';</script>";
	  $check_by_system = 0;
	}
	echo '</div>';
	echo "<br><br>"; }

}

?>
<!-- add by Jul -->
<? if($_GET[pin] && $_GET[preview]=='true'): ?>
<script type="text/javascript">
	window.location = $("a").filter(function (){
		return $(this).text() == '<?=$_GET[pin]?>';
	}).attr('href')+'&preview=<?=$_GET[preview]?>';
</script>
<? endif; ?>
</div>
<? //@end ?>
</body>
</html>
<?php //@end ?>
