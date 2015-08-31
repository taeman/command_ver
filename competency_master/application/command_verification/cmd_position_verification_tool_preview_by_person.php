<?php
/**
* @comment �����١���ҧ����������Ѻ��õ�Ǩ�س���ѵ���ºؤ��
* @projectCode 56CMSS09
* @tor
* @package core
* @author Supachai
* @access public
* @created 03/07/2014
*/
//@modify Supachai 03/07/2014 �����١���ҧ����������Ѻ��õ�Ǩ�س���ѵ���ºؤ��

session_start();
$session_siteid = ($_SESSION['secid'] != '') ? $_SESSION['secid'] : $_SESSION['siteid'];
if(trim($_GET['service']) == ''){ # ��Ǩ������¡�ҡ��������˹
	$_GET['service'] = 'c1';
}elseif($session_siteid == ''){
	$session_siteid = '5001';
}

$toFolder = "../../../repo_cmss/logic_result/";
include_once "../../config/conndb_nonsession.inc.php";
include "table_define.php";
include_once "app_function.php";
include_once "app_config.php";
include_once "logic_simulation/class/class.utility.php";
include_once "logic_simulation/class/class.education.php";
include_once "logic_simulation/class/class.position.php";
include_once "cmd_logic_process.php";
$sqlInclude = "SELECT * FROM cmd_variable WHERE var_type in ('3','4')";
$queryInclude = mysql_db_query($db_app,$sqlInclude)or die(mysql_error());
while($rowsInclude = mysql_fetch_array($queryInclude)){
  require_once "logic_simulation/variable/".$rowsInclude['var_eval'].".php";;
}
?>
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
<?php
if($_GET['service'] == 'c1'){
	$db_site=$db_app;
}else{
	$db_site="cmss_".$_GET["xsiteid"];
}

$sqlInclude = "SELECT * FROM cmd_variable WHERE var_type = '3'";
$queryInclude = mysql_db_query($db_app,$sqlInclude)or die(mysql_error());
while($rowsInclude = mysql_fetch_array($queryInclude)){
  require_once "logic_simulation/variable/".$rowsInclude['var_eval'].".php";

}

if($_POST['bt_save_result'] != ""){
  $sql = "INSERT INTO ".VERI_TABLE."(result_id,attach_id,status_sys,status_per,staff_id,staff_label,comment,date_result)
          VALUES(NULL,'".$_POST['attach_id']."','".$_POST['check_by_system']."','".$_POST['check_by_person']."','".$_SESSION['session_staffid']."',
		         '".$_POST['name']."','".$_POST['comment']."',NOW())";
  mysql_db_query($db_site,$sql)or die(mysql_error());
  $sql_update = "UPDATE ".ATTACH_TABLE." SET person_check = '".$_POST['check_by_person']."',person_staff_check = '".$_POST['check_by_person']."',system_check = '".$_POST['check_by_system']."'
                 WHERE attach_id = '".$_POST['attach_id']."' ";
  mysql_db_query($db_site,$sql_update)or die(mysql_error());

  if($_POST[preview]=='true')
  	echo '<script>alert("�к�����ӡ�úѹ�֡�š�õ�Ǩ�ͺ����"); window.opener.updateRow("'.$_POST['attach_id'].'","'. $_POST['pin'].'"); window.close(); </script>';
  else
  	echo "<script>alert('�к�����ӡ�úѹ�֡�š�õ�Ǩ�ͺ����');</script>";
  /*echo "<script>top.location='?letter_id=".$_GET['letter_id']."&idcard=".$_GET['idcard']."&by_person=".$_GET['by_person']."&pos=".($_GET['pos']-1)."&now=".$_GET['now']."&par=".$_GET['par']."';</script>";*/

}


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

 $query_person = mysql_db_query($db_site,$sql_person)or die(mysql_error());
 while($rows_person = mysql_fetch_array($query_person)){
  $arr_person[] = $rows_person['pin'];
  $arr_attach_id[] = $rows_person['attach_id'];
  $arr_name[] = $rows_person['prename'].$rows_person['firstname']."  ".$rows_person['surname'];
  $arr_pos_old[] = $rows_person['position_id_old'];
  $arr_pos_new[] = $rows_person['position_id_new'];
 }


$all_pos = count($arr_person);
$_GET['pos'] = $_GET['pos']+$_GET['par'];
$idcard = $arr_person[$_GET['pos']-1];
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
$query_command = mysql_db_query($db_site,$sql_command)or die(mysql_error());
$rows_command = mysql_fetch_array($query_command);

if($_GET['debug']=='ON'){
	echo "HERE>>".$sql_command.'<hr>';
}

$sql_detail = "SELECT * FROM ".ATTACH_TABLE." WHERE letter_id = '".$_GET['letter_id']."' AND pin = '$idcard' AND attach_id = '$attach_id' ";
$query_detail = mysql_db_query($db_site,$sql_detail)or die(mysql_error());
$rows_detail = mysql_fetch_array($query_detail);
?>

<?php //@modify Piyachon 10/07/2557 ����� div ��ͺ�����觡�ҧ˹�� ?>
<div style="width:980px;margin:auto">
<?php
$site = get_site_now($idcard);
$dbname = "cmss_".$site;

if($site != ""){
 $sql_pic = "SELECT * FROM general_pic WHERE id = '$idcard' ORDER BY no DESC LIMIT 0,1 ";
 $query_pic = mysql_db_query($dbname,$sql_pic)or die(mysql_error());
 $rows_pic = mysql_fetch_array($query_pic);
 if($rows_pic['imgname'] != ""){
  $img_name = "http://61.19.255.75/image_file/".$site."/".$rows_pic['imgname'];
 }else{
  $img_name = "http://61.19.255.75/competency_master/application/command_verification/images/nopicture.gif";
 }
 $in_system = 1;
}else{
 $img_name = "http://61.19.255.75/competency_master/application/command_verification/images/nopicture.gif";
 $in_system = 0;
?>
<table width="980" border="1" cellspacing="0" cellpadding="3" bgcolor="#275980" style="border-collapse:collapse; border-style:dashed;">
  <tr>
    <td bgcolor="#FFB9B9" align="center"><font color="#CC0000"><b>��辺�����źؤ�ҡôѧ��������к� �������ö��Ǩ�ͺ�س���ѵ����</b></font></td>
  </tr>
</table>
<?php
}

 if($_GET['validate'] == '1'){
  $img_name = "http://61.19.255.75/competency_master/application/command_verification/images/nopicture.gif";
 }
?>
<table width="980" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="189">
<center><img src="http://61.19.255.75/competency_master/application/command_verification/images/logo_kks.png" width="64" /></center>

<table width="189" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="25"><img src="http://61.19.255.75/competency_master/application/command_verification/img/box_01.png" width="25" /></td>
    <td width="150" background="img/box_02.png">&nbsp;</td>
    <td width="23"><img src="http://61.19.255.75/competency_master/application/command_verification/img/box_04.png" width="23" /></td>
  </tr>
  <tr>
    <td background="http://61.19.255.75/competency_master/application/command_verification/img/box_05.png">&nbsp;</td>
    <td align="center" bgcolor="#FFFFFF"><img src="<?=$img_name?>" height="150"></td>
    <td background="http://61.19.255.75/competency_master/application/command_verification/img/box_07.png">&nbsp;</td>
  </tr>
  <tr>
    <td><img src="http://61.19.255.75/competency_master/application/command_verification/img/box_10.png" width="25" /></td>
    <td background="http://61.19.255.75/competency_master/application/command_verification/img/box_11.png">&nbsp;</td>
    <td><img  src="http://61.19.255.75/competency_master/application/command_verification/img/box_13.png" width="23" /></td>
  </tr>
</table>

	</td>
    <td width="761" valign="top">

<table width="100%" border="0" cellspacing="0" cellpadding="3" align="center">

  <tr>
    <td><strong><font color="#000000">������ </font> <span class="style1"><?=get_secname($rows_command['secid'],$rows_command['profile_id'])?></span></strong></td>
  </tr>
  <tr>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="2" class="detailContent1">
  <tr>
    <td><div align="right"><strong style="font-family: Thai Sans Neue Regular;">�Ţ�ѵû�ЪҪ�</strong></div></td>
    <td>: <?=($_GET['validate'] == '')?$idcard:"<font color='#cc0000'>�ش�����ŷ��ͺ</font>";?></td>
  </tr>
  <tr>
    <td width="30%"><div align="right"><strong>���� - ���ʡ��</strong></div></td>
    <td width="70%">: <font color="#000000">

	<?=($_GET['validate'] == '')?$rows_detail['prename'].$rows_detail['firstname']."  ".$rows_detail['surname']:"<font color='#cc0000'>�ش�����ŷ��ͺ</font>";?></font></td>
  </tr>
  <tr>
    <td><div align="right"><strong>���˹觻Ѩ�غѹ</strong></div></td>
    <td>: <?=$rows_detail['position_id_old']?></td>
  </tr>
  <tr>
    <td><div align="right"><strong>�дѺ�Ѩ�غѹ</strong></div></td>
    <td>: <?=$rows_detail['radub_old']?></td>
  </tr>
  <tr>
    <td><div align="right"><strong>�Ţ������˹觻Ѩ�غѹ</strong></div></td>
    <td>: <?=$rows_detail['position_id']?></td>
  </tr>

  <tr>
    <td><div align="right"><strong>��������ѹ���</strong></div></td>
    <td>: <?php echo ($rows_detail['effective_date'] == '0000-00-00')?'-':dateFormat($rows_detail['effective_date'],'thaidot')?></td>
  </tr>
  <tr>
    <td><div align="right"><strong>˹��§ҹ����ѧ�Ѵ</strong></div></td>
    <td>:
	<?php
    $siteName = get_secname($rows_command['secid'],$rows_command['profile_id']);
	?>
	<?=($_GET['validate'] == '')?get_secname($rows_command['secid'],$rows_command['profile_id']):"<font color='#cc0000'>�ش�����ŷ��ͺ</font>";?></td>
  </tr>
</table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>


	</td>
  </tr>
</table>




<?php
if($in_system == 1){

$arrCond = array();
$v14Group = 'null';
##�����繤���������
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

 <!-- <div class="t"><label id="success"><img src="img/loading1.gif" align="absmiddle"></label>&nbsp;<font color="#000000" style="text-shadow: #ffffff 0.1em 0.1em 0.2em;">��õ�Ǩ�ͺ��÷��ͧ��Ժѵ��Ҫ���</font></div>
  -->
  <div class="t"><label id="success"></label>&nbsp;<font color="#000000" style="text-shadow: #ffffff 0.1em 0.1em 0.2em;">��õ�Ǩ�ͺ��÷��ͧ��Ժѵ��Ҫ���</font></div>

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
        $txt = "<img src=\"images/accept.png\" align=\"absmiddle\" />&nbsp;<font color=\"#275980\"><b>��ҹ����͹��</b></font>";
		echo "<script>document.getElementById('success').innerHTML = '<img src=\"images/accept.png\" align=\"absmiddle\" />';</script>";
		$resultCond = 1;
     }else{
        $arrCond[] = "(1==0)";
        $txt = "<img src=\"images/error.png\" align=\"absmiddle\" />&nbsp;<font color=\"#FF0000\"><b>�����ҹ����͹��</b></font>";
        echo "<script>document.getElementById('success').innerHTML = '<img src=\"images/error.png\" align=\"absmiddle\" />';</script>";
		$resultCond = 0;
     }


	 ##add log
	 $sqlCheck = "SELECT * FROM ".LOG_VERI_TABLE." WHERE idcard = '".$rows_detail['pin']."' AND
	                                             attach_id = '".$rows_detail['attach_id']."' AND
												 letter_id = '".$rows_command['letter_id']."' ";
	 $queryCheck = mysql_db_query($db_site,$sqlCheck)or die(mysql_error());
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
	 mysql_db_query($db_site,$sqlLog)or die(mysql_error());
     if($rowsCond['gcond_id'] == '8'){
	     $sqlUpdateHelp = "UPDATE ".ATTACH_TABLE." SET help_status = '".$objProcess->help."' WHERE attach_id = '".$rows_detail['attach_id']."' ";
	     mysql_db_query($db_site,$sqlUpdateHelp);
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

##�����繤���������͹ ���� �ա������Ẻ�����¹�����
//if($rows_command['letter_type'] == '1' or ($rows_command['letter_type'] == '2' and $v14Group == '0')){
if($config_letter_type == 1){
 // echo "BBB<hr>";
  $letter_type = '1';
  ##�ա������Ẻ�����¹�����
  if($rows_command['letter_type'] == '2' and $v14Group == '0'){
      echo '<div style="border:1px solid #00274F; width:980px; border-style:dashed; background-color: #00172F; color:#FFFFFF; padding:3px;">';
      echo '<img src="images/exclamation.png" align="absmiddle" />&nbsp;�ա������Ẻ�����¹��������˹��( ���˹ѧ��� ȸ 0206.5/� 14) ����Թ��õ�Ǩ�ͺ�ҵðҹ���˹��';
      echo '</div><br>';
  }

##get Logic

$pid = empty($rows_detail['pid_new'])?$rows_detail['pid_old']:$rows_detail['pid_new'];
$lvid = empty($rows_detail['level_id_new'])?$rows_detail['level_id_old']:$rows_detail['level_id_new'];

//@modify Supachai 21/2/2558 �к��ҹ�Ţҹء�� �.�.�.�.ࢵ��鹷������֡�� (agenda) �Դ����͹�� ��Ǩ�ͺ������ �ҵ�� 53
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

$queryCond = mysql_db_query($db_app,$sqlCond)or die(mysql_error());
$numCond = mysql_num_rows($queryCond);
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
        <th rowspan="2" width="20%">��á�</th>
        <th rowspan="2">��͸Ժ��</th>
        <th colspan="2">��õ�Ǩ�ͺ</th>
        <th rowspan="2" width="20%">��ҧ�ԧ</th>
    </tr>
    <tr>
    	<th width="7%">����к�</th>
        <th width="7%">�������˹�ҷ��</th>
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
		//echo $idcard." 1 ".$rows_detail['attach_id']." 2 ".$rowsCond['cond_eval']." 3 ".$rowsCond['period']." 4 ".$eduId, $rows_detail['level_id_new'];
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
				if($array_result[$rowsCond['cond_id']]['ref_text'] != ''){
					$ref_text = "<b>�����˵�</b><br>".$array_result[$rowsCond['cond_id']]['ref_text'];
				}

				if($array_result[$rowsCond['cond_id']]['ref_file'] != ''){
					$ref_text .= ($array_result[$rowsCond['cond_id']]['ref_file'] != '') ? '<br><br><b>����Ṻ</b> : <a href="'.$toFolder.$rows_command['secid']."/".$array_result[$rowsCond['cond_id']]['ref_file'].'" target="_blank">��ǹ���Ŵ����Ṻ</a>' : '<br><br><b>����Ṻ</b> :';
				}

				if($array_result[$rowsCond['cond_id']]['person_result'] == '1'){
					$txt = "<font color=\"#275980\"><b>��ҹ $eduName</b></font>";
				}elseif($array_result[$rowsCond['cond_id']]['person_result']  == '0'){
					$txt = "<font color=\"#FF0000\"><b>�����ҹ</b></font>";
				}
			}
		 }else{
			if($rowsCond['gcond_id'] != '6'){ //�����繡�õ�Ǩ�ͺ ��ͺ ������ ��ԧ����
				$arrCond[] = "(1==0)";
			}else{
				$arrCond[] = "(1==1)";
			}
			$resultCond = 0;
			if($rowsCond['gcond_id'] == '2' or $rowsCond['gcond_id'] == '3' or $rowsCond['gcond_id'] == '8' or $rowsCond['gcond_id'] == '9'){
				//��Ǩ�ͺ���˹觷�������� 38�
				$objUtility = new utility;
				if($objUtility->check38kPos($idcard,$rows_detail['effective_date'])){
					$warning = '<br><br><font color="#cc0000"><img src="images/exclamation.png" align="absmiddle">&nbsp;<b>�к���Ǩ������ѵԡ���Ѻ�Ҫ��âͧ '.$rows_detail['prename'].$rows_detail['firstname'].'  '.$rows_detail['surname'].' 㹵��˹觷���������ؤ�ҡ÷ҧ����֡�ҵ���ҵ�� 38�.(2)</b></font>';
				}else{
					$warning = '';
				}
				$help_txt = "<font color='#000000'><br><u><b><em>�����й�</em></b></u> <b>��سҵ�Ǩ�ͺ�����ŵ��仹�����������</b> <br>&bull;&nbsp;��������黯Ժѵ��Ҫ���<br>&bull;&nbsp;�����¹����ѵԢͧ����Ҫ��÷�ҹ���<br>&bull;&nbsp;���ʺ��ó���ô�ç���˹���������͹�������</font>";
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

			$system_result = "<font color=\"#FF0000\"><b>�����ҹ</b></font>".$help_txt.$warning;

			if($array_result[$rowsCond['cond_id']]['ref_text'] != ''){
				$ref_text = "<b>�����˵�</b><br>".$array_result[$rowsCond['cond_id']]['ref_text'];
			}


			if($array_result[$rowsCond['cond_id']]['ref_file'] != ''){
				$ref_text .= ($array_result[$rowsCond['cond_id']]['ref_file'] != '') ? '<br><br><b>����Ṻ</b> : <a href="'.$toFolder.$rows_command['secid']."/".$array_result[$rowsCond['cond_id']]['ref_file'].'" target="_blank">��ǹ���Ŵ����Ṻ</a>' : '<br><br><b>����Ṻ</b> :';
			}

			if($array_result[$rowsCond['cond_id']]['person_result'] == '1'){
				$txt = "<font color=\"#275980\"><b>��ҹ $eduName</b></font>";
			}elseif($array_result[$rowsCond['cond_id']]['person_result']  == '0'){
				$txt = "<font color=\"#FF0000\"><b>�����ҹ</b></font>";
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
	mysql_db_query($db_app_site,$sqlUpdateHelp);
}
$i++;}
?>
</table>
<?
}else{
	//echo "CCCCC<hr>";
	if($rows_command['letter_type'] == '1' or $rows_command['letter_type'] == '2'){
		$txt_info = "��辺��áС�õ�Ǩ�ͺ���˹�� ".$rows_detail['position_id_new']." �дѺ ".$rows_detail['radub_new'];
	}else{
        $txt_info = "�к�����ͧ�Ѻ��õ�Ǩ�ͺ������ ������ ".$rows_command['letter_type_name']."<br>";
		$txt_info .= "<em>����������觷���к��ͧ�Ѻ������ �������͹�����觵���,���������觵���<em>";
	}
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

}else{

	if($rows_command['letter_type'] != '1' and $rows_command['letter_type'] != '2'){
        $txt_info = "�к�����ͧ�Ѻ��õ�Ǩ�ͺ������ ������ ".$rows_command['letter_type_name']."<br>";
		$txt_info .= "<em>����������觷���к��ͧ�Ѻ������ �������͹�����觵���,���������觵���<em>";
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
<div class="art-BlockContent">
<div class="art-BlockContent-body">
   <div>
<form action="?letter_id=<?=$_GET['letter_id']?>&idcard=<?=$idcard?>&by_person=<?=$_GET['by_person']?>&pos=<?=($_GET['pos']-1)?>&now=<?=$_GET['now']?>&par=<?=$_GET['par']?>" method="post">
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
	    $queryPerson = mysql_db_query($db_site,$sqlPerson)or die(mysql_error());
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
    <td width="30%"><div align="right"><strong>�š�õ���ͺ����к�</strong></div></td>
    <td width="70%">
	</font>
	<?php
	if($strCond){
	  echo "<img src=\"images/accept.png\" align=\"absmiddle\" /> <font color=\"#275980\"><b>[��ҹ]</b></font>";
	  echo "<script>document.getElementById('menu_tab').innerHTML = '<img src=\"images/accept.png\" align=\"absmiddle\" />';</script>";
	  $check_by_system = 1;
	}else{
	  echo "<img src=\"images/error.png\" align=\"absmiddle\" /> <font color=\"#cc0000\"><b>[�����ҹ]</b></font>";
	  echo "<script>document.getElementById('menu_tab').innerHTML = '<img src=\"images/error.png\" align=\"absmiddle\" />';</script>";
	  $check_by_system = 0;
	}


	##update result
	if($in_system == 0){
		$check_by_system = 99;
    }
	$sqlUpdateResult = "UPDATE ".ATTACH_TABLE." SET system_check = '".$check_by_system."' WHERE attach_id = '".$rows_detail['attach_id']."' ";
	mysql_db_query($db_site,$sqlUpdateResult)or die(mysql_error());
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
  <?php
	//@modify Supachai 19/07/2014 ���������֧��Ҩҡ�ҹ������
	$verify_sql='SELECT
						*
					FROM
						'.VERI_TABLE.'
					WHERE
						attach_id = "'.$rows_detail['attach_id'].'"
					ORDER BY date_result DESC
					LIMIT 1';
	$verify_query = mysql_db_query($db_site,$verify_sql);
	$verify_data = mysql_fetch_assoc($verify_query);
  if($verify_data[status_per]){
?>
  <tr>
    <td><div align="right"><strong>�š�õ�Ǩ�ͺ�������˹�ҷ��</strong></div></td>

    <td>
		<?php
			if($verify_data[status_per]=="1"){
				echo "��ҹ ���������͹��";
			}if($verify_data[status_per]=="2"){
				echo "�����ҹ";
			}
		?>
	</td>
	<? //@end ?>
  </tr>
  <tr>
    <td><div align="right"><strong>��������˹�ҷ�������Ǩ�ͺ</strong></div></td>
    <td><?php echo $verify_data[staff_label];?></td>
  </tr>
  <tr>
    <td valign="top"><div align="right"><strong>�����˵�</strong></div></td>
    <td><?php echo $verify_data[comment];?></td>
  </tr>
  <?php }?>
</table>
<?php //@end?>
</form>
   </div>
</div>
</div>
</div>
</div>
</div>
<?php



}else{
   echo '<div style="width:980px; margin-left:5px;border:1px solid #00274F; border-style:dashed; background-color: #00172F; color:#FFFFFF; padding:3px;">';
    if($strCond){
	  echo "<img src=\"images/accept.png\" align=\"absmiddle\" /> <font color=\"#FFFFFF\"><b>[��ҹ]</b></font>";
	  echo "<script>document.getElementById('menu_tab').innerHTML = '<img src=\"images/accept.png\" align=\"absmiddle\" />';</script>";
	  $check_by_system = 1;
	}else{
	  echo "<img src=\"images/error.png\" align=\"absmiddle\" /> <font color=\"#FF9900\"><b>[�����ҹ]</b></font>";
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
<pagebreak />
<?php
//@end
?>
