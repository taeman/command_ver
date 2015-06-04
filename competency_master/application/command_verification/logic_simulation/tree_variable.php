<?php
session_start();
header("Content-Type: text/html; charset=tis-620");
include("app_config.php");
/*
function variableGroup(){
	global $db_app;
	$sql_qroup = "SELECT * FROM `cmd_variable_group` ";
	$query_qroup = mysql_db_query($db_app, $sql_qroup) or die(mysql_error());
	$num_qroup = mysql_num_rows($query_qroup);
	$intG = 0;
	while($group = mysql_fetch_assoc($query_qroup)){
		$intG++;
		$imgG = ($intG!=$num_qroup)?"minus.gif":"minusbottom.gif";
		echo  '<DIV><img src="dtree/img/'.$imgG.'" id="im_g'.$group['group_id'].'" boder="0" align="absmiddle" style="cursor:pointer;" onclick="hideOrg(\'g'.$group['group_id'].'\')" />';
		echo '<img src="dtree/img/folderopen.gif" id="folder_g'.$group['group_id'].'" boder="0" align="absmiddle"  />';
		echo '<span style="cursor:pointer;" onClick="linkPage(\'variable.php?group_id='.$group['group_id'].'\', \'body-detail-container\');">';
		echo $group['group_name'];
		echo '</span>';
		echo '</DIV>';
		echo '<DIV id="g'.$group['group_id'].'">';
		$sql_variable = "SELECT cmd_variable.var_id,
									cmd_variable.var_name, 
									cmd_variable.var_detail, 
									cmd_var_group.group_id
									FROM cmd_variable 
									INNER JOIN cmd_var_group 
									ON cmd_variable.var_id = cmd_var_group.var_id
									WHERE cmd_var_group.group_id='".$group['group_id']."' ";
		$query_variable = mysql_db_query($db_app, $sql_variable) or die(mysql_error());
		$num_var = mysql_num_rows($query_variable);
		$intV = 0;
		while($variable = mysql_fetch_assoc($query_variable)){
			$intV++;
			$img = ($intV!=$num_var)?"join.gif":"joinbottom.gif";
			echo  '<DIV >';
				echo  ($intG!=$num_qroup)?'<img src="dtree/img/line.gif" boder="0" align="absmiddle"  />':'<img src="dtree/img/empty.gif" boder="0" align="absmiddle"  />';
				echo '<img src="dtree/img/'.$img.'" boder="0" align="absmiddle"  />';
				echo '<span style="cursor:pointer;" title="'.$variable['var_detail'].'" onClick="linkPage(\'create_variable.php?var_id='.$variable['var_id'].'\', \'body-detail-container\');">';
				echo '<img src="dtree/img/page.gif" boder="0" align="absmiddle"  />';
				echo $variable['var_name'];
				echo '</span>';
			echo '</DIV>';
		}
		echo '</DIV>';
		echo "\n";
	}
}
*/

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

function genTagAll($level=0 ){
	$str_tag = "";
	for($i=0;$i<$level;$i++){
		$str_tag .= '<img src="dtree/img/empty.gif"  boder="0" style="border:0px solid;" align="absmiddle" />';
	} 
	return $str_tag;
} 

function variableTree($qroup_id, $level=0){
		global $db_app;
		//echo '<DIV id="g'.$group['group_id'].'">';
		echo '<DIV id="v'.$group['group_id'].'">';
		$sql_variable = "SELECT cmd_variable.var_id,
									cmd_variable.var_name, 
									cmd_variable.var_detail, 
									cmd_variable.var_type,
									cmd_var_group.group_id
									FROM cmd_variable 
									INNER JOIN cmd_var_group 
									ON cmd_variable.var_id = cmd_var_group.var_id
									WHERE cmd_var_group.group_id='".$qroup_id."' ";
		$query_variable = mysql_db_query($db_app, $sql_variable) or die(mysql_error());
		$num_var = mysql_num_rows($query_variable);
		$intV = 0;
		while($variable = mysql_fetch_assoc($query_variable)){
			$intV++;
			$img = ($intV!=$num_var)?"join.gif":"joinbottom.gif";
			if($level>0){
				$number_level = $level.".".$intV;
				$arr_number = explode(".",$number_level);
				$count_number = count($arr_number)-1;
			}else{
				$count_number = 0;
			}
			
			//$num_end = ($level == $num_var)?1:0;
			if($variable['var_type']==1){
				$images_var = "cons.png";
			}else if($variable['var_type']==2){
				$images_var = "sql.png";
			}else if($variable['var_type']==3){
				$images_var = "phpfuction.png";
			}else if($variable['var_type']==4){
				$images_var = "suggestion.png";
			}
			echo  '<DIV >';
				echo genTag($count_number, $num_end);
				echo ($intV!=$num_var || $num_end==0)?'<img src="dtree/img/line.gif" boder="0" align="absmiddle"  />':'<img src="dtree/img/empty.gif" boder="0" align="absmiddle"  />';
				echo '<img src="dtree/img/'.$img.'" boder="0" align="absmiddle"  />';
				echo '<span style="cursor:pointer;" title="'.$variable['var_detail'].'" onClick="linkPage(\'create_variable.php?var_id='.$variable['var_id'].'\', \'body-detail-container\');">';
				echo '<img src="images/'.$images_var.'" boder="0" align="absmiddle" width="18"  />';
				echo $variable['var_name'];
				echo '</span>';
			echo '</DIV>';
		}
		echo '</DIV>';
		echo "\n";
}

function variableGroup($qroup_id, $level=0){
	global $db_app;
	$sql_qroup_parent = "	SELECT cmd_variable.var_id
															FROM cmd_variable INNER JOIN cmd_var_group ON cmd_variable.var_id = cmd_var_group.var_id
															INNER JOIN cmd_variable_group ON cmd_var_group.group_id = cmd_variable_group.group_id
															WHERE cmd_variable_group.parent_id='".$group['group_id']."'  
															GROUP BY cmd_variable_group.group_id ";
	$query_qroup_parent = mysql_db_query($db_app, $sql_qroup_parent) or die(mysql_error());
	$num_parent = mysql_num_rows($query_qroup_parent);
	
	$sql_qroup = "SELECT  cmd_variable_group.*,COUNT(cmd_variable.var_id) AS count_data
															FROM cmd_variable INNER JOIN cmd_var_group ON cmd_variable.var_id = cmd_var_group.var_id
															INNER JOIN cmd_variable_group ON cmd_var_group.group_id = cmd_variable_group.group_id
															WHERE cmd_variable_group.parent_id='".$qroup_id."'  
															GROUP BY cmd_variable_group.group_id
															ORDER BY cmd_variable_group.order_by  ASC ";
	$query_qroup = mysql_db_query($db_app, $sql_qroup) or die(mysql_error());
	$num_qroup = mysql_num_rows($query_qroup);
	$intG = 0;
	while($group = mysql_fetch_assoc($query_qroup)){
		$intG++;
		
		$img_page = ($group['count_data']>0)?"folderopen.gif":"page.gif";
		
		$number_level = $level.".".$intG;
		$num_end = ($level == $group['count_data'])?1:0;
		$arr_number = explode(".",$number_level);
		if($group['count_data']>0){
			$imgP = ($intG!=$group['count_data'])?"minus.gif":"minusbottom.gif";
		}else{
			$imgP = ( $num_qroup != $intG)?"join.gif":"joinbottom.gif";
		}
		echo  '<DIV>'.genTag((count($arr_number)-1), $num_end);
		echo '<img src="dtree/img/'.$imgP.'" id="im_gg'.$group['group_id'].'" boder="0" align="absmiddle" style="cursor:pointer;" onclick="hideOrgVar(\'gg'.$group['group_id'].'\')" />';
		echo '<span style="cursor:pointer;" onClick="linkPage(\'variable.php?group_id='.$group['group_id'].'\', \'body-detail-container\');">';
		echo '<img src="dtree/img/'.$img_page.'" boder="0" align="absmiddle"  id="folder_gg'.$group['group_id'].'" />';
		echo $group['group_name'];
		echo '</span>';
		echo '</DIV>';
		echo "\n";
		echo '<DIV id="gg'.$group['group_id'].'">';
			variableGroup($group['group_id'], $intG);
			variableTree($group['group_id'], $intG);
		echo '</DIV>';
		echo "\n";
	}
}
function variableTreeEnd($qroup_id, $level=0){
		global $db_app;
		//echo '<DIV id="g'.$group['group_id'].'">';
		echo '<DIV id="v'.$group['group_id'].'">';
		$sql_variable = "SELECT cmd_variable.var_id,
									cmd_variable.var_name, 
									cmd_variable.var_detail,
									cmd_variable.var_type, 
									cmd_var_group.group_id
									FROM cmd_variable 
									INNER JOIN cmd_var_group 
									ON cmd_variable.var_id = cmd_var_group.var_id
									WHERE cmd_var_group.group_id='".$qroup_id."' ";
		$query_variable = mysql_db_query($db_app, $sql_variable) or die(mysql_error());
		$num_var = mysql_num_rows($query_variable);
		$intV = 0;
		while($variable = mysql_fetch_assoc($query_variable)){
			$intV++;
			$img = ($intV!=$num_var)?"join.gif":"joinbottom.gif";
			if($level>0){
				$number_level = $level.".".$intV;
				$arr_number = explode(".",$number_level);
				$count_number = count($arr_number)-1;
			}else{
				$count_number = 0;
			}
			
			if($variable['var_type']==1){
				$images_var = "cons.png";
			}else if($variable['var_type']==2){
				$images_var = "sql.png";
			}else if($variable['var_type']==3){
				$images_var = "phpfuction.png";
			}else if($variable['var_type']==4){
				$images_var = "suggestion.png";
			}
			
			echo  '<DIV >';
				echo genTagAll($count_number);
				echo '<img src="dtree/img/empty.gif" boder="0" align="absmiddle"  />';
				echo '<img src="dtree/img/'.$img.'" boder="0" align="absmiddle"  />';
				echo '<span style="cursor:pointer;" title="'.$variable['var_detail'].'" onClick="linkPage(\'create_variable.php?var_id='.$variable['var_id'].'\', \'body-detail-container\');">';
				echo '<img src="images/'.$images_var.'" boder="0" align="absmiddle" width="18"  />';
				echo $variable['var_name'];
				echo '</span>';
			echo '</DIV>';
		}
		echo '</DIV>';
		echo "\n";
}

function variableGroupEnd($qroup_id, $level=0){
	global $db_app;
	$sql_qroup_parent = "	SELECT cmd_variable.var_id
															FROM cmd_variable INNER JOIN cmd_var_group ON cmd_variable.var_id = cmd_var_group.var_id
															INNER JOIN cmd_variable_group ON cmd_var_group.group_id = cmd_variable_group.group_id
															WHERE cmd_variable_group.parent_id='".$group['group_id']."'  
															GROUP BY cmd_variable_group.group_id ";
	$query_qroup_parent = mysql_db_query($db_app, $sql_qroup_parent) or die(mysql_error());
	$num_parent = mysql_num_rows($query_qroup_parent);
	
	$sql_qroup = "SELECT  cmd_variable_group.*,COUNT(cmd_variable.var_id) AS count_data
															FROM cmd_variable INNER JOIN cmd_var_group ON cmd_variable.var_id = cmd_var_group.var_id
															INNER JOIN cmd_variable_group ON cmd_var_group.group_id = cmd_variable_group.group_id
															WHERE cmd_variable_group.parent_id='".$qroup_id."'  
															GROUP BY cmd_variable_group.group_id
															ORDER BY cmd_variable_group.order_by  ASC ";
	$query_qroup = mysql_db_query($db_app, $sql_qroup) or die(mysql_error());
	$num_qroup = mysql_num_rows($query_qroup);
	$intG = 0;
	while($group = mysql_fetch_assoc($query_qroup)){
		$intG++;
		
		$img_page = ($group['count_data']>0)?"folderopen.gif":"page.gif";
		
		$number_level = $level.".".$intG;
		$num_end = ($level == $group['count_data'])?1:0;
		$arr_number = explode(".",$number_level);
		if($group['count_data']>0){
			$imgP = ($intG!=$group['count_data'])?"minus.gif":"minusbottom.gif";
		}else{
			$imgP = ( $num_qroup != $intG)?"join.gif":"joinbottom.gif";
		}
		echo  '<DIV>'.genTagAll((count($arr_number)-1));
		echo '<img src="dtree/img/'.$imgP.'" id="im_gg'.$group['group_id'].'" boder="0" align="absmiddle" style="cursor:pointer;" onclick="hideOrgVar(\'gg'.$group['group_id'].'\')" />';
		echo '<span style="cursor:pointer;" onClick="linkPage(\'variable.php?group_id='.$group['group_id'].'\', \'body-detail-container\');">';
		echo '<img src="dtree/img/'.$img_page.'" boder="0" align="absmiddle"  id="folder_gg'.$group['group_id'].'" />';
		echo $group['group_name'];
		echo '</span>';
		echo '</DIV>';
		echo "\n";
		echo '<DIV id="gg'.$group['group_id'].'">';
			variableGroupEnd($group['group_id'], $intG);
			variableTreeEnd($group['group_id'], $intG);
		echo '</DIV>';
		echo "\n";
	}
}
?>
<DIV style="margin:5px;">
<script>
function hideOrgVar( my_id ){
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
 <table width="100%" border="0">
      <tr>
        <td>
        <img src="dtree/img/folder_page.png" boder="0" align="absmiddle"  />&nbsp;
        <span style="cursor:pointer;" onClick="linkPage('variable.php', 'body-detail-container');">
        <strong>รายการตัวแปร</strong>
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
		
		if($num_qroup>0){
			$imgP = ($intG!=$num_qroup)?"minus.gif":"minusbottom.gif";
		}else{
			$imgP = ( $num_qroup != $intG)?"join.gif":"joinbottom.gif";
		}
		$img_page = ($num_qroup>0)?"folderopen.gif":"page.gif";
		//$img = ($intG!=$num_qroup)?"join.gif":"joinbottom.gif";
		
		echo  '<DIV>';
		echo '<img src="dtree/img/'.$imgP.'" id="im_gg'.$group['group_id'].'" boder="0" align="absmiddle" style="cursor:pointer;" onclick="hideOrgVar(\'gg'.$group['group_id'].'\')" />';
		echo '<span style="cursor:pointer;" onClick="linkPage(\'variable.php?group_id='.$group['group_id'].'\', \'body-detail-container\');">';
		echo '<img src="dtree/img/'.$img_page.'" boder="0" align="absmiddle"   id="folder_gg'.$group['group_id'].'"  />';
		echo $group['group_name'];
		echo '</span>';
		echo '</DIV>';
		echo "\n";
		echo '<DIV id="gg'.$group['group_id'].'">';
			if($num_qroup!=$intG){
				variableGroup($group['group_id'], $intG);
				variableTree($group['group_id'],0);
			}else{
				variableGroupEnd($group['group_id'], $intG);
				variableTreeEnd($group['group_id'],0);
			}
		echo '</DIV>';
		echo "\n";
	}
	//variableGroup();
	?>
   </div>
  <DIV>