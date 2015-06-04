<?php
session_start();
header("Content-Type: text/html; charset=windows-874");
include("app_config.php");
	$sql_list  = " SELECT * FROM cmd_function WHERE func_name='".$_GET['var_eval']."' ";
	$query_list = mysql_db_query($db_app, $sql_list) or die(mysql_error());	
	$list = mysql_fetch_assoc($query_list);
?>
<table  width="100%" border="0" cellpadding="2" cellspacing="1" align="center" style="border:#BBB 1px solid;" >
      <tr bgcolor="#EEE" align="center">
          <td width="150" bgcolor="#CCCCCC" align="right" style="border:#BBB 1px solid;">ชื่อฟันก์ชั่น:</td>
          <td align="left" style="border:#BBB 1px solid;"><?php echo $list['func_name'] ?></td>
       </tr>
       <tr bgcolor="#EEE" align="center">
          <td  align="right" bgcolor="#CCCCCC" style="border:#BBB 1px solid;">คำอธิบาย:</td>
          <td align="left" style="border:#BBB 1px solid;"><?php echo $list['func_detail'] ?></td>
       </tr>
       <tr bgcolor="#EEE" align="center">
          <td  align="right" bgcolor="#CCCCCC" style="border:#BBB 1px solid;">ส่งค่ากลับ:</td>
          <td align="left" style="border:#BBB 1px solid;"><?php echo $list['func_param_out'] ?></td>
       </tr>
</table>
<table id="sql_parameter" width="100%" border="1" cellpadding="2" cellspacing="1" class="table_data" align="center" >
          <tr  class="header_data" align="center">
            <td>ลำดับ</td>
            <td>Parameter</td>
            <td>Parameter Name</td>
            <td>Defualt Value</td>
          </tr>
          <?php
		  	
		  	$sql_param = "SELECT * FROM `cmd_function_param` WHERE id_func='".$list['id_func']."' ";
		  	$query_param = mysql_db_query($db_app, $sql_param) or die(mysql_error());
			$numRow=0;
			while($param = mysql_fetch_assoc($query_param)){
				$numRow++;
				echo '<tr>';
				echo '<td align="center"><label id="rec_'.$numRow.'">'.$numRow.'</label></td>';
				echo '<td><input type="hidden" name="parameter[]" value="'.$param['param_name'].'" title="[parameter]" />'.$param['param_name'].'</td>';
				echo '<td><input type="hidden" name="parameter_name[]" value="'.$param['param_detail'].'" title="[parameter_name]" />'.$param['param_detail'].'</td>';
				echo '<td><input type="hidden" name="defual_value[]" value="'.$param['param_values'].'"  />'.$param['param_values'].'</td>';
				echo '</tr>';
			}
          ?>
  </table>
  <DIV id="button_validate" style="margin:5px;" >
        <input type="button" name="validate" value="การตรวจสอบ" onclick="popWindow('validate.php?var_type=3&parameter=<?=$list['func_name']?>',800,450)"/>
  </DIV>