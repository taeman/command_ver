<?php
session_start();
header("Content-Type: text/html; charset=windows-874");
include("app_config.php");
?>
<script type="text/javascript">

$(document).ready(function(){
	$('#form_variable_group').submit(function() {
		//Check Form Data 
			if($("#group_name").val()==""){
				alert("กรุณากรอกกลุ่มตัวแปร");
				return false;
			}
		//Send Data
			$.post(
				"process_variable_group.php",
				{
					group_name:$("#group_name").val(),
					group_id:$("#group_id").val()
				},
				function(msg){
					//$("#msg").html(msg);
					if(msg=="true"){
						alert("บันทึกข้อมูลเรียบร้อย");
						linkPage("tree_variable_group.php", "tree-detail-container-group");	
					}else if(msg=="false"){
						alert("ไม่สามารถบันทึกข้อมูลได้");
					}
				}
			);
			return false; 
	});
});
</script>
<style>
	#form_variable_group td {
		padding:2px;
	}
	 .txt_red{
		 color:#F00;
	}
</style>
<DIV style="margin:5px;">
<DIV id="msg"></DIV>
<?php
$sql_variable_group = "SELECT  * FROM cmd_variable_group WHERE group_id='".$_GET['group_id']."' ";
$query_variable_group = mysql_db_query($db_app, $sql_variable_group) or die(mysql_error());
$group = mysql_fetch_assoc($query_variable_group);
?>
<form id="form_variable_group" action="" method="post">
<table width="100%" border="0" id="form_tbvariatable_group">
      <tr>
        <td width="150" align="right">ชื่อกลุ่มตัวแปร<span class="txt_red">*</span>:</td>
        <td><input type="text" style="width:450px;" id="group_name"  name="group_name" value="<?=$group['group_name']?>"/></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>
        <input type="hidden" name="group_id" id="group_id" value="<?=$group['group_id']?>"/>
        <input type="submit" name="b_save" value="บันทึก"/>&nbsp;
        <input type="button" name="b_cancel" value="ยกเลิก"/>
        </td>
      </tr>
 </table>
 <div id="result"></div>
</form>
</DIV>
