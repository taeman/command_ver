<?php
session_start();
header("Content-Type: text/html; charset=windows-874");
include("app_config.php");
?>
<script type="text/javascript">
function delVar(id){
	if(confirm("คุณต้องการลบข้อมูลนี้ใช่หรือไม่") == true){
		$.get("process_variable.php?var_id="+id+"&action=delete", function(data) {
		  alert(data);
		  linkPage("variable.php?group_id=<?=$_GET['group_id']?>", "body-detail-container");
		  linkPage("tree_variable.php", "tree-detail-container");
		});
	}else{
		return false;
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
    <span onClick="linkPage('create_variable.php', 'body-detail-container');" style="cursor:pointer;">
    <img src="images/add.png" border="0" title="เพ่ิมตัวแปร"  align="absmiddle"  />เพิ่มตัวแปร</span>
    &nbsp;
    </td>
  </tr>
</table>
<p/>&nbsp;
<?php
$sql_cond  = " SELECT * FROM `cmd_condition` "; 
$query_cond = mysql_db_query($db_app, $sql_cond);
$str_id = "";
while($cond = mysql_fetch_assoc($query_cond)){
	$str_rep = str_replace(">=",":",$cond['cond_eval']); 
	$str_rep = str_replace("<=",":",$str_rep); 
	$str_rep = str_replace("==",":",$str_rep);
	$str_rep = str_replace(">",":",$str_rep);
	$str_rep = str_replace("<",":",$str_rep);
	$str_rep = str_replace("!=",":",$str_rep);
	$str_rep = str_replace("||",":",$str_rep);
	$str_rep = str_replace("&&",":",$str_rep);
	$str_rep = str_replace(array("(",")","true","false"),array(""),$str_rep);
	$str_id .= $str_rep.":";
}
$arr_eval = explode(":",$str_id);
foreach($arr_eval as $var_eval){
	$arr_ineval[] = $var_eval;
}

 $sql_variable = "SELECT cmd_variable_group.group_name, 
									cmd_variable.*
									FROM cmd_variable 
									INNER JOIN cmd_var_group ON cmd_variable.var_id = cmd_var_group.var_id
	 								INNER JOIN cmd_variable_group ON cmd_var_group.group_id = cmd_variable_group.group_id 
									";
 $sql_variable .= ($_GET['group_id']!="")?" WHERE cmd_variable_group.group_id = '".$_GET['group_id']."' OR cmd_variable_group.parent_id = '".$_GET['group_id']."' ":"";
 $query_variable = mysql_db_query($db_app, $sql_variable);
?>
<table width="98%" border="1" cellpadding="2" cellspacing="1" class="table_data" align="center" >
  <tr  class="header_data" align="center">
    <td width="50">ลำดับ</td>
    <td width="100">กลุ่มตัวแปร</td>
    <td width="30%">ชื่อตัวแปร</td>
    <td>คำอธิบาย</td>
    <td width="80">จัดการ</td>
  </tr>
  <?php
  $intR=0;
  	while($variable = mysql_fetch_assoc($query_variable)){
		$intR++;
		if($variable['var_type']==1){
			$images_var = "cons.png";
		}else if($variable['var_type']==2){
			$images_var = "sql.png";
		}else if($variable['var_type']==3){
			$images_var = "phpfuction.png";
		}else if($variable['var_type']==4){
			$images_var = "suggestion.png";
		}
		
  ?>
  <tr class="body_data" align="center">
    <td><?=$intR?></td>
    <td align="left"><?php echo $variable['group_name']?></td>
    <td align="left"><img src="images/<?=$images_var?>" border="0" align="absmiddle" width="18"/> <?php echo $variable['var_name']?></td>
    <td align="left"><?php echo $variable['var_detail']?></td>
    <td  align="center">
    <img src="images/pencil.png" border="0" title="แก้ไขตัวแปร" align="absmiddle"  style="cursor:pointer;" onclick="linkPage('create_variable.php?var_id=<?php echo $variable['var_id']?>', 'body-detail-container');" />&nbsp;
    <?php
	if(in_array($variable['var_id'],$arr_ineval)){
    ?>
    <img src="images/cross_disable.png" border="0" title="ไม่สามารถลบตัวแปรได้ เนื่องจากมีการใช้งานอยู่" align="absmiddle"  style="cursor:pointer;" />
   <?php
	}else{
	?>
    <img src="images/cross.png" border="0" title="ลบตัวแปร" align="absmiddle"  style="cursor:pointer;" onclick="delVar('<?php echo $variable['var_id']?>');" />
    <?php
	}
   ?>
    </td>
  </tr>
  <?php } ?>
</table>