<?php
 /**
 * @comment ตัวแปรสำหรับตรวจสอบคำสั่ง
 * @projectCode 57CMSS10
 * @tor 10.4.1
 * @package core
 * @author Sathianphong Sukin
 * @access public
 * @created 23/01/2015
 */
	session_start();
	header("Content-Type: text/html; charset=windows-874");
	include("app_config.php");
	
	$sql_position = " 	SELECT * FROM hr_addposition_now WHERE hr_addposition_now.pid='".$_GET['pid']."' ";
	$query_position = mysql_db_query( $db_master, $sql_position ) or die(mysql_error());
	$position = mysql_fetch_assoc($query_position);
	
	$teacher_pid = array('425471006','425471000','325001010','225471000','325471008','125471009','125471008');
	
	if($position['status_active']=="yes" && !in_array($_GET['pid'], $teacher_pid)){
			/*$sql = " 	SELECT level_id,radub
					FROM hr_addradub 
					WHERE  `active_now` = '1' 
					AND (`type_id` = '3' OR `type_id` = '4') order by `orderby`
					
			";
			$sql = " 	SELECT hr_addradub.radub, 
					position_math_radub.position_id, 
					hr_addposition_now.position, 
					hr_addposition_now.pid,
					hr_addradub.level_id
					FROM hr_addradub INNER JOIN position_math_radub ON hr_addradub.runid = position_math_radub.radub_id
					INNER JOIN hr_addposition_now ON hr_addposition_now.runid = position_math_radub.position_id 
					WHERE hr_addposition_now.pid='".$_GET['pid']."' 
			";
			*/
			
			if($position['position_line_after']=="1"){
				$where_position = " AND (  hr_addradub.radub LIKE('%การ%') OR  hr_addradub.radub LIKE('%เชี่ยวชาญ%') OR  hr_addradub.radub LIKE('%ทรงคุณวุฒิ%')  )";
			}else if($position['position_line_after']=="2"){
				$where_position = " AND (  hr_addradub.radub LIKE('%งาน%')  OR  hr_addradub.radub LIKE('%อาวุโส%')   )";
			}
			$sql = " 	SELECT level_id,radub
					FROM hr_addradub 
					WHERE  `active_now` = '1' 
					AND (`type_id` = '3' OR `type_id` = '4') ".$where_position." ORDER BY  `orderby` ASC
					
			";
	}else{
		$sql = " 	SELECT hr_addradub.radub, 
					position_math_radub.position_id, 
					hr_addposition_now.position, 
					hr_addposition_now.pid,
					hr_addradub.level_id
					FROM hr_addradub INNER JOIN position_math_radub ON hr_addradub.runid = position_math_radub.radub_id
					INNER JOIN hr_addposition_now ON hr_addposition_now.runid = position_math_radub.position_id 
					WHERE hr_addposition_now.pid='".$_GET['pid']."' 
					ORDER BY hr_addradub.orderby ASC
			";
	}	
?>
	<select id="level_id" name="level_id" style="width:230px;" onchange="checkCountPositionRadub();">
	<option value="">ระบุระดับ</option>
<?php
	
	$query = mysql_db_query($db_master, $sql ) or die(mysql_error());
	while($row = mysql_fetch_assoc($query)){
		$sldL = ($row['level_id']==$_GET['level_id'])?"SELECTED":""; 
?>
	<option value="<?php echo $row['level_id']?>" <?=$sldL?>><?php echo $row['radub']?></option>
<?	
	}
?>
	</select>
	