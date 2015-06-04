<?php
session_start();
header("Content-Type: text/html; charset=windows-874");
include("app_config.php");

function getPosition($pid=""){
	global $dbname,$db_master;
	$sql = "SELECT position FROM `hr_addposition_now` WHERE  pid ='".$pid."'  ";
	$query = mysql_db_query($db_master, $sql);
	$row = mysql_fetch_assoc($query);
	return $row['position'];
}
function getRadub($level_id=""){
	global $dbname,$db_master;
	$sql = " 	SELECT level_id,radub
					FROM hr_addradub 
					WHERE  `level_id` = '".$level_id."' 
				";
	$query = mysql_db_query($db_master, $sql);
	$row = mysql_fetch_assoc($query);
	return $row['radub'];
}
function getLetterType($letter_type=""){
	global $db_app;
	$sql = "SELECT letter_type_name FROM `command_letter_type`  WHERE  letter_type ='".$letter_type."'  ";
	$query = mysql_db_query($db_app, $sql);
	$row = mysql_fetch_assoc($query);
	return $row['letter_type_name'];
}

?>
<p/>&nbsp;
<table width="98%" border="0" align="center">
  <tr>
    <td align="left"  width="200">&nbsp;
    
    </td>
    <td align="left" width="200">&nbsp;
    
   </td>
    <td align="right">
    <span  onClick="linkPage('create_position_condition.php', 'body-detail-container');" style="cursor:pointer;" >
    <img src="images/add.png" border="0" title="เพ่ิมตำแหน่ง" align="absmiddle"/>เพิ่มตำแหน่ง</span>
    &nbsp;
    </td>
  </tr>
</table>
<p/>&nbsp;
  <?php
  $where_p = ($_GET['profile_id']!="")?" WHERE profile_id='".$_GET['profile_id']."'  ":""; 
  $sql_profile = "SELECT * FROM cmd_profile ".$where_p." GROUP BY profile_id ASC
												";
  $query_profile = mysql_db_query($db_app, $sql_profile);
  while($profile = mysql_fetch_assoc($query_profile)){
?>
<table width="98%" border="0" cellpadding="2" cellspacing="1" class="table_data" align="center" >
<tr class="header_data" >
    <td colspan="6">
	<strong style="font-size:14px;">โปรไฟล์:</strong> <?php echo $profile['logic_profile_name']?>
    </td>
  </tr>
  <tr  class="header_data" align="center">
    <td width="40">ลำดับ</td>
    <td >ตำแหน่ง</td>
    <td width="200">ระดับ</td>
    <td width="80">จัดการ</td>
  </tr>
  <?php	
    	$where_type = ($_GET['letter_type']!="")?" AND letter_type='".$_GET['letter_type']."'  ":""; 
        $sql_type = "	SELECT cmd_position_radub.*
								FROM cmd_position_radub 
								WHERE cmd_position_radub.profile_id='".$profile['profile_id']."'
								".$where_type."
								GROUP BY cmd_position_radub.letter_type
								ORDER BY letter_type ASC
								";
		$query_type = mysql_db_query($db_app, $sql_type);
  		while($row_type = mysql_fetch_assoc($query_type)){
  ?>
<tr class="body_data" >
    <td colspan="6" bgcolor="#89AFC7">
	<strong style="font-size:14px;">ประเภทคำสั่ง: <?php echo getLetterType($row_type['letter_type'])?></strong>
    </td>
  </tr>
<?	
        $sql_position_radub = "SELECT cmd_profile.logic_profile_name, cmd_position_radub.*
												FROM cmd_profile 
												INNER JOIN cmd_position_radub 
												ON cmd_profile.profile_id = cmd_position_radub.profile_id 
												WHERE cmd_position_radub.letter_type='".$row_type['letter_type']."'
												ORDER BY letter_type,pid,level_id ASC
												";
		$query_position_radub = mysql_db_query($db_app, $sql_position_radub);
  		$intR=0;
  		while($position_radub = mysql_fetch_assoc($query_position_radub)){
		$intR++;
  ?>
  <tr class="body_data" align="center">
    <td><?=$intR?></td>
    <td align="left"><?php echo getPosition($position_radub['pid'])?></td>
    <td  align="left"><?php echo getRadub($position_radub['level_id'])?></td>
    <td  align="center">
    <img src="images/pencil.png" border="0" title="แก้ไขคุณสมบัติตำแหน่ง" align="absmiddle"  style="cursor:pointer;" onclick="linkPage('create_position_condition.php?match_id=<?php echo $position_radub['match_id']?>', 'body-detail-container');" />&nbsp;
    <img src="images/cross_disable.png" border="0" title="ไม่สามารถลบคุณสมบัติตำแหน่ง เนื่องจากมีการใช้งาน" align="absmiddle"  style="cursor:pointer;" />
    </td>
  </tr>
  		<?php
			 } 
		} 
		?>
</table>
<?php } ?>