<?php
session_start();
header("Content-Type: text/html; charset=windows-874");
include("app_config.php");

function getPosition($pid=""){
	global $dbname;
	$sql = "SELECT position FROM `hr_addposition_now` WHERE  pid ='".$pid."'  ";
	$query = mysql_db_query('cmss_master', $sql)or die(mysql_error());
	$row = mysql_fetch_assoc($query);
	return $row['position'];
}

function getRadub($level_id=""){
	global $dbname,$db_master;
	$sql = " 	SELECT level_id,radub
					FROM hr_addradub 
					WHERE  `level_id` = '".$level_id."' 
				";
	$query = mysql_db_query('cmss_master', $sql);
	$row = mysql_fetch_assoc($query);
	return $row['radub'];
}

function positionGroup($profile_id){
	global $db_app;
	$sql_letter_type = "
		SELECT command_letter_type.letter_type_name, 
		command_letter_type.letter_type, 
		cmd_position_radub.profile_id
		FROM command_letter_type 
		INNER JOIN cmd_position_radub ON command_letter_type.letter_type = cmd_position_radub.letter_type
		WHERE cmd_position_radub.profile_id='".$profile_id."'
		GROUP BY command_letter_type.letter_type
 		";
	$query_letter_type = mysql_db_query($db_app, $sql_letter_type) or die(mysql_error());
	$num_letter_type = mysql_num_rows($query_letter_type);
	$intP = 0;
	while($letter_type = mysql_fetch_assoc($query_letter_type)){
		$intP++;
		$imgP = ($intP!=$num_letter_type)?"minus.gif":"minusbottom.gif";
		echo  '<DIV><img src="dtree/img/'.$imgP.'" id="im_g'.$letter_type['letter_type'].'" boder="0" align="absmiddle" style="cursor:pointer;" onclick="hideOrg(\'g'.$letter_type['letter_type'].'\')" />';
		echo '<img src="dtree/img/folderopen.gif" id="folder_g'.$letter_type['letter_type'].'" boder="0" align="absmiddle"  />';
		echo '<span style="cursor:pointer;" title="'.$letter_type['letter_type_name'].'" onClick="linkPage(\'position_condition.php?profile_id='.$letter_type['profile_id'].'&letter_type='.$letter_type['letter_type'].'\', \'body-detail-container\');">';
		echo (strlen($letter_type['letter_type_name'])>35)?(substr($letter_type['letter_type_name'],0,35)."..."):$letter_type['letter_type_name'];
		echo '</span>';
		echo '</DIV>';
		echo '<DIV id="g'.$letter_type['letter_type'].'">';
		$sql_position_radub = "	SELECT *
													FROM  cmd_position_radub 
													WHERE cmd_position_radub.letter_type='".$letter_type['letter_type']."' 
													AND cmd_position_radub.profile_id='".$profile_id."'
													ORDER BY pid,level_id ASC
													";
		$query_position_radub = mysql_db_query($db_app, $sql_position_radub) or die(mysql_error());
		$num_var = mysql_num_rows($query_position_radub);
		$intV = 0;
		while($position_radub = mysql_fetch_assoc($query_position_radub)){
			$intV++;
			$img = ($intV!=$num_var)?"join.gif":"joinbottom.gif";
			$position_radub_name = getPosition($position_radub['pid'])." ????? ".getRadub($position_radub['level_id']);
			echo  '<DIV >';
				echo  ($intP!=$num_letter_type)?'<img src="dtree/img/line.gif" boder="0" align="absmiddle"  />':'<img src="dtree/img/empty.gif" boder="0" align="absmiddle"  />';
				echo '<img src="dtree/img/'.$img.'" boder="0" align="absmiddle"  />';
				echo '<span style="cursor:pointer;" title="'.$position_radub_name.'" onClick="linkPage(\'create_position_condition.php?match_id='.$position_radub['match_id'].'\', \'body-detail-container\');">';
				echo '<img src="dtree/img/page.gif" boder="0" align="absmiddle"  />';
				echo $position_radub_name;
				echo '</span>';
			echo '</DIV>';
		}
		echo '</DIV>';
		echo "\n";
	}
}
?>
<DIV style="margin:5px;">
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
 <table width="100%" border="0">
 <?php
 	$sql_profile = "SELECT cmd_profile.logic_profile_name, 
							cmd_profile.profile_id
							FROM cmd_profile
							ORDER BY cmd_profile.profile_id 
							";
	$query_profile = mysql_db_query($db_app, $sql_profile) or die(mysql_error());
	while($profile = mysql_fetch_assoc($query_profile)){
 ?>
      <tr>
        <td>
        <img src="dtree/img/folder_page.png" boder="0" align="absmiddle"  />&nbsp;
        <span style="cursor:pointer;" onClick="linkPage('position_condition.php', 'body-detail-container');">
        <strong>‚ª√‰ø≈Ï:<?=$profile['logic_profile_name']?></strong>
        </span>
      	<div class="dtree">
        <?php 
        positionGroup($profile['profile_id']);
        ?>
       	</div> 
   		</td>
      </tr>
      <?php } ?>
   </table>
  <DIV>