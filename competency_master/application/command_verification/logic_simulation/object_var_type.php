<?php
/**
* @comment ไฟล์ถูกสร้างขึ้นมาสำหรับสร้างตัวแปรเพื่อใช้ในการทำตรรกะตรวจสอบคำสั่ง
* @projectCode 57CMSS10
* @tor
* @package core
* @author Sathianphong Sukin
* @access public
* @created 24/09/2014
*/
session_start();
header("Content-Type: text/html; charset=windows-874");
include("app_config.php");
 include("function/functions.php");
$var_type = $_GET['var_type'];
?>
<style>
.fieldset_var_type{
		border:1px #666 solid; 
		width:450px; 
		padding:5px;
}
</style>
<?php

if($var_type==1){
	#ประเภทตัวแปร Constant
	$sql_variable = "SELECT * FROM cmd_variable 
									WHERE cmd_variable.var_id='".$_GET['var_id']."' ";
	$query_variable = mysql_db_query($db_app, $sql_variable) or die(mysql_error());
	$variable = mysql_fetch_assoc($query_variable);
?>
    <fieldset  class="fieldset_var_type">
    <legend>กำหนดค่า Constant </legend>
        <table width="300" border="0">
          <tr>
            <td width="120" align="right">ค่าข้อมูล<span class="txt_red">*</span>:</td>
            <td><input type="text" id="var_eval" name="var_eval" value="<?=$variable['var_eval']?>"/></td>
          </tr>
        </table>
    </fieldset>
    <DIV id="button_validate" style="margin:5px;" >
        <input type="button" name="validate" value="การตรวจสอบ" onclick="popWindow('validate.php?var_type='+document.getElementById('var_type').value+'&parameter='+document.getElementById('var_eval').value,500,200)"/>
  </DIV>
<?php
}else if($var_type==2){
	#ประเภทตัวแปร SQL
	$sql_variable = "SELECT * FROM cmd_variable 
									WHERE cmd_variable.var_id='".$_GET['var_id']."' ";
	$query_variable = mysql_db_query($db_app, $sql_variable) or die(mysql_error());
	$variable = mysql_fetch_assoc($query_variable);
?>
<script>
	function getVal(){
		 var txt_parameter = "";
		var tagMeta = document.getElementById("sql_parameter").getElementsByTagName ( 'input' );
			for(i=0;i<tagMeta.length;i++){
				if(tagMeta[i].type == "hidden"){
					inputs = tagMeta[i];
					if( inputs.title == '[parameter]' ){
						txt_parameter += inputs.value+"|";
					}
				}
			}
			return txt_parameter;
	}
	function getParameter(){
		 var txt_parameter = "";
		var tagMeta = document.getElementById("sql_parameter").getElementsByTagName ( 'input' );
			for(i=0;i<tagMeta.length;i++){
				if(tagMeta[i].type == "hidden"){
					inputs = tagMeta[i];
					if( inputs.title == '[parameter]' ){
						txt_parameter += inputs.value+"|";
					}
				}
			}
			return txt_parameter;
	}
	function getDefual_value(){
		 var txt_defual_value = "";
		var tagMeta = document.getElementById("sql_parameter").getElementsByTagName ( 'input' );
			for(i=0;i<tagMeta.length;i++){
				if(tagMeta[i].type == "hidden"){
					inputs = tagMeta[i];
					if( inputs.title == '[defual_value]' ){
						txt_defual_value += inputs.value+"|";
					}
				}
			}
			return txt_defual_value;
	}
	
	function addItem(parameter, parameter_name, defual_value){
		//alert(parameter+", "+parameter_name+", "+defual_value);
		var newCell = document.getElementById('sql_parameter');
		var numRow = newCell.rows.length;
		var insetTB = newCell.insertRow(numRow);
		insetTB.className = "body_data";
		
		var td1 = insetTB.insertCell(0);
		var td2 = insetTB.insertCell(1);
		var td3 = insetTB.insertCell(2);
		var td4 = insetTB.insertCell(3);
		//var td5 = insetTB.insertCell(4);
		
		//Text Field 
		text_field1 = '<label id="rec_'+numRow+'">'+numRow+'</label>';
		text_field2 = '<input type="hidden" name="parameter[]" value="'+parameter+'" title="[parameter]" />'+parameter;
		text_field3 = '<input type="hidden" name="parameter_name[]" value="'+parameter_name+'" title="[parameter_name]" />'+parameter_name;
		text_field4 = '<input type="hidden" name="defual_value[]" value="'+defual_value+'"  title="[defual_value]"  />'+defual_value;
		
		//Text TD
		insetTB.style.backgroundColor = "#FFFFFF";
		td1.innerHTML = text_field1;
		td2.innerHTML = text_field2;
		td3.innerHTML = text_field3;
		td4.innerHTML = text_field4;
		td1.style.textAlign = "center";
	}
	
	function updateItem(my_id, defual_value, parameter){
		var dataCell = document.getElementById('sql_parameter');
		var index_row = document.getElementById(my_id).parentNode.parentNode.rowIndex;
		var objTable = dataCell.rows[index_row];
		objTd = objTable.getElementsByTagName("td");
		
		//Text Field 
		text_field2 = '<input type="hidden" name="parameter[]" value="'+parameter+'" title="[parameter]" />'+parameter;
		text_field3 = '<input type="hidden" name="defual_value[]" value="'+defual_value+'"  />'+defual_value;
		text_field4 = '<img src="images/pencil.png" border="0" title="Edite Parameter" align="absmiddle" onClick="popupupdate(\''+my_id+'\',\''+defual_value+'\',\''+parameter+'\');" style="cursor:pointer;" />&nbsp;<img src="images/cross.png" border="0" title="Delete Parameter" align="absmiddle" onclick="conF(\''+my_id+'\');" style="cursor:pointer;" />';
		
		objTd[1].innerHTML = text_field2;
		objTd[2].innerHTML = text_field3;
		objTd[3].innerHTML = text_field4;
	}
	
	function deleteRow(my_id){
		var i=document.getElementById(my_id).parentNode.parentNode.rowIndex;
		document.getElementById('sql_parameter').deleteRow(i);
		
	}
	
	function conF(my_id){
		if(confirm('ท่านต้องการลบรายการนี้ใช่หรือไม่?')){
			deleteRow(my_id);
			return true;
		}else{
			return false;
		}
	}
	
	function popupaddnew(){
		var txt_parameter = "";
		var tagMeta = document.getElementById("sql_parameter").getElementsByTagName ( 'input' );
		for(i=0;i<tagMeta.length;i++){
			if(tagMeta[i].type == "hidden"){
				inputs = tagMeta[i];
				if( inputs.title == '[parameter]' ){
					txt_parameter += inputs.value+"|";
				}
			}
		}
		 var url="manage_parameter.php?parameter="+txt_parameter+"&Rnd="+(Math.random()*1000);
		 var prop="dialogHeight: 250px; dialogWidth:550px; scroll: No; help: No; status: No;";
		 var o = open(url,"pop",prop); 
	}
	
	function GetDialog(o){
		if(o){
				 if(o.resetParameter == true){
					 
					var newCell = document.getElementById('sql_parameter');
					var numRow = newCell.rows.length;
					
					//Delete All Data
					for(intR=0;intR<numRow;intR++){
						if(intR>0){
							//alert("rec_"+intR);
							deleteRow("rec_"+intR);
						}
					}
					  
					 str_val =  o.text_parameter; 
					 arr_val_all = str_val.split("|");
					 for(i=0;i<arr_val_all.length;i++){
						 if(arr_val_all[i]!=""){
							arr_val = arr_val_all[i].split(":");
							if(arr_val[0]!=""){
								addItem(arr_val[0], arr_val[1], arr_val[2]);
							}
						 }
					 }
				}
			}
	}
	
</script>
	<fieldset class="fieldset_var_type">
	<legend>กำหนดค่า SQL </legend>
        <DIV>SQL<span class="txt_red">*</span><textarea style="width:450px;" rows="5" id="var_eval" name="var_eval"  ><?=$variable['var_eval']?></textarea></DIV>
    	<table width="100%" border="0">
          <tr>
            <td>Parameter</td>
            <td align="right">
            <img src="images/add.png" border="0" title="Add Parameter" style="cursor:pointer;" align="absmiddle" onClick="popupaddnew('','');" />
            </td>
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
		  	$parameter = readParameter();
			foreach($parameter as $key=>$val){
				$arr_param[$val['parameter_eval']] = $val['parameter_name'];
			}
		  	$sql_param = "SELECT * FROM `cmd_param` WHERE var_id='".$_GET['var_id']."' ";
		  	$query_param = mysql_db_query($db_app, $sql_param) or die(mysql_error());
			$numRow=0;
			while($param = mysql_fetch_assoc($query_param)){
				$numRow++;
				echo '<tr>';
				echo '<td align="center"><label id="rec_'.$numRow.'">'.$numRow.'</label></td>';
				echo '<td><input type="hidden" name="parameter[]" value="'.$param['param_name'].'" title="[parameter]" />'.$param['param_name'].'</td>';
				echo '<td><input type="hidden" name="parameter_name[]" value="'.$arr_param[$param['param_name']].'" title="[parameter_name]" />'.$arr_param[$param['param_name']].'</td>';
				echo '<td><input type="hidden" name="defual_value[]" value="'.$param['param_values'].'"  />'.$param['param_values'].'</td>';
				echo '</tr>';
			}
          ?>
        </table>
   </fieldset>
   <DIV id="button_validate" style="margin:5px;" >
        <input type="button" name="validate" value="การตรวจสอบ" onclick="popWindow('validate.php?var_type='+document.getElementById('var_type').value+'&parameter='+getVal(),500,250)"/>
  </DIV>
<?php
}else if($var_type==3 || $var_type==4){
	#ประเภทตัวแปร PHP Function
	$sql_variable = "SELECT * FROM cmd_variable 
									WHERE cmd_variable.var_id='".$_GET['var_id']."' ";
	$query_variable = mysql_db_query($db_app, $sql_variable) or die(mysql_error());
	$variable = mysql_fetch_assoc($query_variable);
?>
<fieldset class="fieldset_var_type">
	<legend>กำหนดค่า <?php echo ($var_type==3)?'Function':'Suggestion'?> </legend>
<script>
function changePHPFunc(var_eval){
	linkPage('php_function_detail.php?var_eval='+var_eval, 'php_function_detail');
}
</script>
    <table width="95%" align="center"  >
      <tr>
        <td valign="top" width="120" align="right">
        เลือก Function<span class="txt_red">*</span> :
        </td>
        <td align="left">
        <?php
		$sql_list  = "SELECT * FROM cmd_function
						LEFT JOIN cmd_variable ON cmd_function.func_name = cmd_variable.var_eval
						WHERE var_type='$var_type' OR var_type IS NULL
						GROUP BY id_func";
		$query_list = mysql_db_query($db_app, $sql_list) or die(mysql_error());	
        ?>
        <select name="var_eval" id="var_eval" onchange="changePHPFunc(this.value);">
        <option value="">ระบุ Function</option>
        <?php 
		while($list = mysql_fetch_assoc($query_list)){
			$sld = ($list['func_name']==$variable['var_eval'])?"SELECTED":"";
		?>
        <option value="<?php echo $list['func_name']; ?>" <?=$sld?> ><?php echo $list['func_name']; ?></option>
        <?php
		}
        ?>
        </select>
        </td>
      </tr>
      <tr>
      	<td colspan="2"><div id="php_function_detail"></div></td>
      </tr>
    </table>
    <?php
		if($variable['var_eval']){
			echo '<script>';
			echo 'changePHPFunc("'.$variable['var_eval'].'");';
			echo '</script>';
		}
        ?>
        </fieldset>
<?php
 } 
 ?>