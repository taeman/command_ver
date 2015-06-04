<?php
session_start();
header("Content-Type: text/html; charset=windows-874");
include("app_config.php");

function genTag($level=0){
	$str_tag = "";
	for($i=0;$i<=$level;$i++){
		$str_tag .= "&nbsp;&nbsp;";
	}
	return $str_tag;
} 

function variableGroup($qroup_id, $level=0){
	global $db_app;
	$sql_qroup = "SELECT * FROM `cmd_variable_group` WHERE parent_id='".$qroup_id."' ORDER BY order_by  ASC ";
	$query_qroup = mysql_db_query($db_app, $sql_qroup) or die(mysql_error());
	$num_qroup = mysql_num_rows($query_qroup);
	$intG = 0;
	while($group = mysql_fetch_assoc($query_qroup)){
		$intG++;
		$number_level = $level.".".$intG;
		$arr_number = explode(".",$number_level);
		//$img = ($intG!=$num_qroup)?"join.gif":"joinbottom.gif";
		echo '	<tr class="body_data" align="center">
						<td>'.$number_level.'</td>
						<td align="left">'.genTag(count($arr_number)).$group['group_name'].'</td>
						<td  align="center">
						<img src="images/pencil.png" border="0" title="แก้ไขกลุ่มตัวแปร" align="absmiddle"  style="cursor:pointer;" onclick="linkPage(\'create_variable_group.php?group_id='.$group['group_id'].'\', \'body-detail-container\');" />&nbsp;
						<img src="images/cross_disable.png" border="0" title="ไม่สามารถลบกลุ่มตัวแปร เนื่องจากมีตัวแปรอยู่" align="absmiddle"  style="cursor:pointer;" />
						</td>
  					</tr>';
		echo "\n";
		variableGroup($group['group_id'], $intG);
	}
}
?>
<script>
function hideOrg( my_id ){
  	if( document.getElementById( my_id ).style.display == "none" ){
		document.getElementById( my_id ).style.display = "";
		document.getElementById( 'im_'+my_id ).src = "dtree/img/minus.gif";
		document.getElementById( 'folder_'+my_id ).src = "dtree/img/folderopen.gif";
	}else{
		document.getElementById( my_id ).style.display = "none";
		document.getElementById( 'im_'+my_id ).src = "dtree/img/plus.gif";
		document.getElementById( 'folder_'+my_id ).src = "dtree/img/folder.gif";
	}
 }
</script>
<p/>&nbsp;
<table width="98%" border="0" align="center">
  <tr>
    <td align="left"  width="200">&nbsp;
    
    </td>
    <td align="left" width="200">&nbsp;
    
   </td>
    <td align="right">
     <span onClick="linkPage('create_variable_group.php', 'body-detail-container');" style="cursor:pointer;">
    <img src="images/add.png" border="0" title="เพิ่มกลุ่มตัวแปรหลัก" align="absmiddle"  />เพิ่มกลุ่มตัวแปรหลัก
    </span>
    &nbsp;
    </td>
  </tr>
</table>
<p/>&nbsp;
<?php

        $sql_variable_group = "SELECT * FROM cmd_variable_group WHERE parent_id='0' ORDER BY order_by  ASC ";
		$query_variable_group = mysql_db_query($db_app, $sql_variable_group);
?>
<table width="98%" border="1" cellpadding="2" cellspacing="1" class="table_data" align="center" >
  <tr  class="header_data" align="center">
    <td width="50">ลำดับ</td>
    <td >กลุ่มตัวแปร</td>
    <td width="80">จัดการ</td>
  </tr>
  <?php
  $intR=0;
  	while($group = mysql_fetch_assoc($query_variable_group)){
		$intR++;
  ?>
  <tr class="body_data" align="center">
    <td><?=$intR?></td>
    <td align="left"><?php echo $group['group_name']?></td>
    <td  align="center">
    <img src="images/pencil.png" border="0" title="แก้ไขกลุ่มตัวแปร" align="absmiddle"  style="cursor:pointer;" onclick="linkPage('create_variable_group.php?group_id=<?php echo $group['group_id']?>', 'body-detail-container');" />&nbsp;
    <img src="images/cross_disable.png" border="0" title="ไม่สามารถลบกลุ่มตัวแปร เนื่องจากมีตัวแปรอยู่" align="absmiddle"  style="cursor:pointer;" />
    </td>
  </tr>
  <?php 
  		variableGroup($group['group_id'], $intR);
  	} 
  ?>
</table>