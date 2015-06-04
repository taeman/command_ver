<?php
session_start();
header("Content-Type: text/html; charset=windows-874");
include("app_config.php");
?>
<script type="text/javascript">

$(document).ready(function(){
	$('#form_variatable').submit(function() {
		//Begin Check Form Data
		if($("#group_id").val()==""){
			alert("กรุณาเลือกกลุ่มตัวแปร");
			return false;
		}else if($("#var_name").val()==""){
			alert("กรุณากรอกชื่อตัวแปร");
			return false;
		}else if($("#var_detail").val()==""){
			alert("กรุณากรอกคำอธิบาย");
			return false;
		}else if($("#var_type").val()==""){
			alert("กรุณาเลือกประเภทตัวแปร");
			return false;
		}else if($("#var_eval").val()==""){
			if($("#var_type").val()==1){
				alert("กรุณากรอกค่า Constant");
			}else if($("#var_type").val()==2){
				alert("กรุณากรอกค่า SQL");
			}else if($("#var_type").val()==3){
				alert("กรุณาเลือก Function");
			}
			return false;
		}else if($("#var_status").val()==""){
			alert("กรุณาเลือกสถานะการใช้งาน");
			return false;
		}
		/*if($("#var_id").val()!=""){
			$.get("ajex.check_data.php?get_data=variable&get_val"+$("#var_name").val(), function(data) {
				  alert(data);
				  return false;
			});
		}*/
		//End Check Form Data
		
		if($("#var_type").val()==1){
			
			//Send Data
			$.post(
				"process_variable.php",
				{
					var_id:$("#var_id").val(),
					group_id:$("#group_id").val(),
					var_name:$("#var_name").val(),
					var_detail:$("#var_detail").val(),
					var_type:$("#var_type").val(),
					var_eval:$("#var_eval").val(),
					var_status:$("#var_status").val()
				},
				function(msg){
					if(msg=="true"){
						alert("บันทึกข้อมูลเรียบร้อย");
						linkPage("tree_variable.php", "tree-detail-container");
					}else if(msg=="false"){
						alert("ไม่สามารถบันทึกข้อมูลได้");
					}
				}
			);
			return false; 
		}else if($("#var_type").val()==2){
			//Send Data
			$.post(
				"process_variable.php",
				{
					var_id:$("#var_id").val(),
					group_id:$("#group_id").val(),
					var_name:$("#var_name").val(),
					var_detail:$("#var_detail").val(),
					var_type:$("#var_type").val(),
					var_eval:$("#var_eval").val(),
					parameter:getParameter(),
					defual_value:getDefual_value(),
					var_status:$("#var_status").val()
				},
				function(msg){
					$("#msg").html(msg);
					if(msg=="true"){
						alert("บันทึกข้อมูลเรียบร้อย");
						linkPage("tree_variable.php", "tree-detail-container");
					}else if(msg=="false"){
						alert("ไม่สามารถบันทึกข้อมูลได้");
					}
				}
			);
			return false; 
		}else if($("#var_type").val()==3){
			//Send Data
			$.post(
				"process_variable.php",
				{
					var_id:$("#var_id").val(),
					group_id:$("#group_id").val(),
					var_name:$("#var_name").val(),
					var_detail:$("#var_detail").val(),
					var_type:$("#var_type").val(),
					var_eval:$("#var_eval").val(),
					var_status:$("#var_status").val()
				},
					function(msg){
						//$("#msg").html(msg);
						if(msg=="true"){
							alert("บันทึกข้อมูลเรียบร้อย");
							linkPage("tree_variable.php", "tree-detail-container");
						}else if(msg=="false"){
							alert("ไม่สามารถบันทึกข้อมูลได้");
						}
					}
				);
				return false; 
		}
		
       return false; 
	});
});
</script>

<script>
function changeObjVar(var_type, var_id){
	linkPage('object_var_type.php?var_type='+var_type+'&var_id='+var_id, 'object_var_type');
}

function popWindow(url, w, h){
	var popup		= "Popup"; 
	if(w == "") 	w = 640;
	if(h == "") 	h = 480;
	var newwin 	= window.open(url, popup,'location=0,status=no,scrollbars=yes,resizable=no,width=' + w + ',height=' + h + ',top=20');
	newwin.focus();
}
</script>
<style>
#form_tbvariatable td {
	padding:2px;
}
 .txt_red{
	 color:#F00;
}
</style>
<DIV style="margin:5px;">
<DIV id="msg"></DIV>
<?php
$sql_variable = "SELECT cmd_variable.*, 
									cmd_var_group.group_id
									FROM cmd_variable 
									INNER JOIN cmd_var_group 
									ON cmd_variable.var_id = cmd_var_group.var_id
									WHERE cmd_variable.var_id='".$_GET['var_id']."' ";
$query_variable = mysql_db_query($db_app, $sql_variable) or die(mysql_error());
$variable = mysql_fetch_assoc($query_variable);
?>
<form id="form_variatable" action="" method="post" enctype="multipart/formdata">
<table width="100%" border="0" id="form_tbvariatable">
      <tr>
        <td width="150" align="right">กลุ่มตัวแปร<span class="txt_red">*</span>:</td>
        <td>
        <?php
        $sql_qroup = "SELECT * FROM `cmd_variable_group` ";
		$query_qroup = mysql_db_query($db_app, $sql_qroup);
        ?>
            <select id="group_id" name="group_id">
           		<option value="">ระบุกลุ่มตัวแปร</option>
                <?php
				while($qroup = mysql_fetch_assoc($query_qroup)){
					$sldG = ($qroup['group_id']==$variable['group_id'])?"SELECTED":""; 
                ?>
                <option value="<?php echo $qroup['group_id']?>" <?=$sldG?>><?php echo $qroup['group_name']?></option>
                <?php } ?>
          </select>
        </td>
      </tr>
      <tr>
        <td align="right">ชื่อตัวแปร<span class="txt_red">*</span>:</td>
        <td><input type="text" style="width:450px;" id="var_name"  name="var_name" value="<?=$variable['var_name']?>"/></td>
      </tr>
      <tr>
        <td valign="top"  align="right">คำอธิบาย<span class="txt_red">*</span>:</td>
        <td><textarea id="var_detail" name="var_detail"  style="width:450px;" rows="3"><?=$variable['var_detail']?></textarea></td>
      </tr>
      <tr>
        <td align="right">ประเภทตัวแปร<span class="txt_red">*</span>:</td>
        <td>
        <?php
		$sldG = ($qroup['group_id']==$variable['group_id'])?"SELECTED":""; 
        ?>
            <select name="var_type" id="var_type" onchange="changeObjVar(this.value,'')">
                <option value="">ระบุประเภทตัวแปร</option>
                <option value="1" <?php echo ($variable['var_type']==1)?"SELECTED":"";?> >Constant</option>
                <option value="2" <?php echo ($variable['var_type']==2)?"SELECTED":"";?> >SQL</option>
                <option value="3" <?php echo ($variable['var_type']==3)?"SELECTED":"";?> >PHP Function</option>
				<option value="4" <?php echo ($variable['var_type']==4)?"SELECTED":"";?> >Suggestion</option>
          </select>
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>
        <DIV id="object_var_type"></DIV>
        <?php
		if($variable['var_type']!=""){
			echo '<script>';
			echo 'changeObjVar(\''.$variable['var_type'].'\',\''.$variable['var_id'].'\');';
			echo '</script>';
		}
        ?>
        </td>
      </tr>
      <tr>
        <td align="right">สถานะการใช้งาน<span class="txt_red">*</span>:</td>
        <td>
            <table border="0">
              <tr>
                <td width="70"><input type="checkbox" id="var_status" name="var_status" value="1" <?php echo (($variable['var_status']==1)?"CHECKED":"") ?> /></td>
 
              </tr>
            </table>
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>
        <input type="hidden" id="var_id"  name="var_name" value="<?=$variable['var_id']?>"/>
        <input type="submit" name="b_save" value="บันทึก"/>&nbsp;
        <input type="button" name="b_cancel" value="ยกเลิก"/>
        </td>
      </tr>
 </table>
 <div id="result"></div>
</form>
</DIV>
