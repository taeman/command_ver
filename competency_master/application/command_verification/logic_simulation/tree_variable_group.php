<?php
session_start();
header("Content-Type: text/html; charset=tis-620");
include("app_config.php");

function genTag($level=0, $num_end=0){
	$str_tag = "";
	for($i=0;$i<$level;$i++){
		if($i != 0 || $num_end==1){
			$str_tag .= '<img src="dtree/img/empty.gif"  boder="0" style="border:0px solid;" align="absmiddle" />';
		}else{
			$str_tag .= '<img src="dtree/img/line.gif"  boder="0" style="border:0px solid;" align="absmiddle" />';
			
		}
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
		
		$sql_qroup_all = "	SELECT COUNT(group_id) AS count_data FROM `cmd_variable_group` 
												WHERE parent_id='0' 
												ORDER BY order_by  ASC ";
		$query_qroup_all = mysql_db_query($db_app, $sql_qroup_all) or die(mysql_error());
		$row_all = mysql_fetch_assoc($query_qroup_all);
		
		$sql_qroup_parent = "	SELECT COUNT(group_id) AS count_data FROM `cmd_variable_group` 
												WHERE parent_id='".$group['group_id']."' 
												ORDER BY order_by  ASC ";
		$query_qroup_parent = mysql_db_query($db_app, $sql_qroup_parent) or die(mysql_error());
		$row_parent = mysql_fetch_assoc($query_qroup_parent);
		$img_page = ($row_parent['count_data']>0)?"folderopen.gif":"page.gif";
		
		$number_level = $level.".".$intG;
		$num_end = ($level == $row_all['count_data'])?1:0;
		$arr_number = explode(".",$number_level);
		if($row_parent['count_data']>0){
			$imgP = ($intG!=$row_parent['count_data'])?"minus.gif":"minusbottom.gif";
		}else{
			$imgP = ( $num_qroup != $intG)?"join.gif":"joinbottom.gif";
		}
		echo  '<DIV>'.genTag((count($arr_number)-1), $num_end);
		echo '<img src="dtree/img/'.$imgP.'" id="im_g'.$group['group_id'].'" boder="0" align="absmiddle" style="cursor:pointer;" onclick="hideOrg(\'g'.$group['group_id'].'\')" />';
		echo '<span style="cursor:pointer;" onClick="linkPage(\'create_variable_group.php?group_id='.$group['group_id'].'\', \'body-detail-container\');">';
		echo '<img src="dtree/img/'.$img_page.'" boder="0" align="absmiddle"  id="folder_g'.$group['group_id'].'" />';
		echo $group['group_name'];
		echo '</span>';
		echo '</DIV>';
		echo "\n";
		echo '<DIV id="g'.$group['group_id'].'">';
			variableGroup($group['group_id'], $intG);
		echo '</DIV>';
		echo "\n";
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
<DIV style="margin:5px;">
 <table width="100%" border="0">
      <tr>
        <td>
        <img src="dtree/img/folder_page.png" boder="0" align="absmiddle"  />&nbsp;
        <span style="cursor:pointer;" onClick="linkPage('variable_group.php', 'body-detail-container');">
        <strong>รายการกลุ่มตัวแปร</strong>
        </span>
        </td>
      </tr>
   </table>
	
  <div class="dtree">
	<?php 
	$sql_qroup = "SELECT * FROM `cmd_variable_group` WHERE parent_id='0' ORDER BY order_by  ASC ";
	$query_qroup = mysql_db_query($db_app, $sql_qroup) or die(mysql_error());
	$num_qroup = mysql_num_rows($query_qroup);
	$intG = 0;
	while($group = mysql_fetch_assoc($query_qroup)){
		$intG++;
		$sql_qroup_parent = "	SELECT COUNT(group_id) AS count_data FROM `cmd_variable_group` 
												WHERE parent_id='".$group['group_id']."' 
												ORDER BY order_by  ASC ";
		$query_qroup_parent = mysql_db_query($db_app, $sql_qroup_parent) or die(mysql_error());
		$row_parent = mysql_fetch_assoc($query_qroup_parent);
		if($row_parent['count_data']>0){
			$imgP = ($intG!=$row_parent['count_data'])?"minus.gif":"minusbottom.gif";
		}else{
			$imgP = ( $num_qroup != $intG)?"join.gif":"joinbottom.gif";
		}
		$img_page = ($row_parent['count_data']>0)?"folderopen.gif":"page.gif";
		//$img = ($intG!=$num_qroup)?"join.gif":"joinbottom.gif";
		
		echo  '<DIV>';
		echo '<img src="dtree/img/'.$imgP.'" id="im_g'.$group['group_id'].'" boder="0" align="absmiddle" style="cursor:pointer;" onclick="hideOrg(\'g'.$group['group_id'].'\')" />';
		echo '<span style="cursor:pointer;" onClick="linkPage(\'create_variable_group.php?group_id='.$group['group_id'].'\', \'body-detail-container\');">';
		echo '<img src="dtree/img/'.$img_page.'" boder="0" align="absmiddle"  id="folder_g'.$group['group_id'].'" />';
		echo $group['group_name'];
		echo '</span>';
		echo '</DIV>';
		echo "\n";
		echo '<DIV id="g'.$group['group_id'].'">';
			variableGroup($group['group_id'], $intG);
		echo '</DIV>';
		echo "\n";
	}
	?>
   </div>
  <DIV>