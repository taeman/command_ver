<?php
session_start();
include("app_config.php");
include("function/functions.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=TIS-620" />
<title>การตรวจสอบ</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="js/extjs/resources/css/ext-all.css">
</head>
<body topmargin="0" leftmargin="0" rightmargin="0">
<script>
    function genValidateName(my_id){
		 var var_name = opener.document.getElementById("var_name");
		 document.getElementById(my_id).innerHTML = var_name.value+"=";
    }
</script>
<?php
if($_GET['var_type']==1){
?>
 <center>
<p/>&nbsp;
<strong>ประเภทตัวแปร&nbsp;</strong><span id="type_label">Constant</span>
<table  width="80%" border="0" style="margin:5px;" align="center" >
              <tr>
                <td width="100" align="right" valign="middle"><strong>ค่าที่ได้คือ</strong>&nbsp;</td>
                <td align="center" style=" padding:5px; border:#A6C8D4 1px solid; background-color:#CCE5F4;">
                <span id="txt_var_name"></span>
                <?php
				echo $_GET['parameter'];
				?>
                </td>
              </tr>
  </table>
  <DIV>
   <input type="button" name="b_cancel" value="ปิด" onclick="window.close();" />
  </DIV>
  </center>
  <script>
    genValidateName("txt_var_name");
</script>
<?php
}else if($_GET['var_type']==2){

$arr_parameter = explode("|",$_GET['parameter']);
foreach($arr_parameter as $val_p){
		$arr_parameter[] = $val_p;
}
$parameter = readParameter();
?>
<center>
	<form action="" method="post">
    <strong>ประเภทตัวแปร&nbsp;</strong><span id="type_label">SQL</span>
         <table width="99%" style="font-size:12px;" border="0" cellpadding="1" cellspacing="1" id="tb_parameter" class="table_data" align="center">
            <tr class="header_data">
              <td  width="100" align="left">Parameter</th>
              <td  align="left">Parameter Name</th>
              <td   align="left"width="150" >Defualt Value</th>
            </tr>
            <?php
			$intR=0;
			foreach($parameter as $key=>$val){
				if(in_array($val['parameter_eval'], $arr_parameter)){
					$parameter_eval = str_replace(array("[","]"),array(""),$val['parameter_eval']);
			?>
            <tr class="body_data">
            	<td  align="left"><?=$val['parameter_eval']?></td>
                <td  align="left"><?=$val['parameter_name']?></td>
              	<td  align="left">
                <?php
				if($val['parameter_eval']!="[dbMaster]" && $val['parameter_eval']!="[dbSite]"){
                ?>
                <input type="text" name="param[<?=$parameter_eval?>]" style="width:95%;" value="<?=(($_POST['param'][$parameter_eval])?$_POST['param'][$parameter_eval]:$val['defualt_value'])?>"/>
                <?php 
				}else{ 
				?>
                	<input type="hidden" name="param[<?=$parameter_eval?>]"  value="<?=$val['defualt_value'];?>"/>
                <?php
                	echo $val['defualt_value'];
				} 
				?>
                </td>
              </tr>
            <?php
				}
			}
            ?>
        </table>	
          <input type="hidden" id="sql_txt" name="sql_txt" value=""/>
          <br/>
          <table width="98%" border="0">
          <tr>
            <td>
            <?php
			if($_POST){
				include("class/class.utility.php");
				include("class/class.validate.php");
				$VLD = new Validate($_POST['param']['idcard']);
            ?>
            <table  width="80%" border="0" style="margin:5px;" align="center" >
              <tr>
                <td width="100" align="right" valign="middle"><strong>ค่าที่ได้คือ</strong>&nbsp;</td>
                <td align="center" style=" padding:5px; border:#A6C8D4 1px solid; background-color:#CCE5F4;">
                <span id="txt_var_name"></span>
                <?php 
				/*echo "<pre>";
				print_r($_POST);
				echo "</pre>";*/
				$dataValidate = $VLD->sqlValidate($_POST['sql_txt'], $_POST['param']);
				echo $dataValidate;
				?>
                </td>
              </tr>
            </table>
            <?php } ?>
            </td>
          </tr>
          <tr>
            <td align="center">
            <input type="submit" name="b_process" value="ประมวลผล"/>&nbsp;
            <input type="button" name="b_cancel" value="ยกเลิก" onclick="window.location='?var_type=<?=$_GET['var_type']?>&parameter=<?=$_GET['parameter']?>';" />
            </td>
          </tr>
        </table>
     </form>
</center>
  <script>
    function genFormValidate(){
		 var var_eval = opener.document.getElementById("var_eval");
		 document.getElementById("sql_txt").value = var_eval.value;
    }
    genFormValidate();
    genValidateName("txt_var_name");
    </script>
 <?php
  }else if($_GET['var_type']==3 || $_POST['var_type']==3){
	  $sql_function  = " SELECT * FROM cmd_function WHERE func_name='".$_GET['parameter']."' ";
	  $query_function = mysql_db_query($db_app, $sql_function) or die(mysql_error());	
	  $func = mysql_fetch_assoc($query_function);
?>
<center>
<strong>ประเภทตัวแปร&nbsp;</strong><span id="type_label">PHP Function</span>
<form action="" method="post">
<table  border="0" align="center" width="99%" class="table_data" >
  <tr class="header_data">
    <td width="150" >
    Function Name:&nbsp;<?php echo $func['func_name']; ?>
    <input type="hidden" name="func_name" value="<?php echo $func['func_name']; ?>"/>
    </td>
  </tr>
  <tr class="body_data">
    <td align="top" >
    <table id="sql_parameter" width="100%" border="1" cellpadding="2" cellspacing="1" class="table_data" align="center" >
          <tr  class="header_data" align="center">
            <td>ลำดับ</td>
            <td>Parameter</td>
            <td>Parameter Name</td>
            <td>Defualt Value</td>
          </tr>
   		<?php
		$sql_param = "SELECT * FROM `cmd_function_param` WHERE id_func='".$func['id_func']."' ";
		 $query_param = mysql_db_query($db_app, $sql_param) or die(mysql_error());
		$numRow=0;
		while($param = mysql_fetch_assoc($query_param)){
        $numRow++;
				echo '<tr>';
				echo '<td align="center"><label id="rec_'.$numRow.'">'.$numRow.'</label></td>';
				echo '<td><input type="hidden" name="parameter[]" value="'.$param['param_name'].'" title="[parameter]" />'.$param['param_name'].'</td>';
				echo '<td><input type="hidden" name="parameter_name[]" value="'.$param['param_detail'].'" title="[parameter_name]" />'.$param['param_detail'].'</td>';
				echo '<td><input type="text" name="defual_value['.$param['param_name'].']" value="'.(($_POST['defual_value'][$param['param_name']])?$_POST['defual_value'][$param['param_name']]:$param['param_values']).'" style="width:98%;"  /></td>';
				echo '</tr>';
		}
      ?>
    </table>
    </td>
  </tr>
</table>
<br/>
      <table width="98%" border="0">
          <tr>
            <td>
            <?php
			if($_POST){
				//echo "variable_temp/expPosition.php";
				require_once("class/class.utility.php");
				require_once("class/class.education.php");
				require_once("class/class.validate.php");
				
				#Require_once Function
				$sql_func  = " SELECT * FROM cmd_function WHERE func_name!='' ";
			  	$query_func = mysql_db_query($db_app, $sql_func) or die(mysql_error());	
			  	while($func_name = mysql_fetch_assoc($query_func)){
					if(is_file("variable/".$func_name['func_name'].".php")){
						require_once("variable/".$func_name['func_name'].".php");
					}
				}
				
				require_once("variable/".$_POST['func_name'].".php");
				$str_param = "";
				$func_name = $_POST['func_name'];
				$count_val = count($_POST['defual_value']);
				$intV = 0;
				foreach($_POST['defual_value'] as $value){
					$intV++;
					$str_param .= ' "'.$value.'" ';
					$str_param .= ($intV!=$count_val)?",":"";
				}
				
				//$objExp = new expPosition('3180500030751','525471147','92255106','2010-04-21','2');
				$createEval = "\$objExp = new ".$func_name."( ".$str_param." );";
				eval($createEval);
				
            ?>
            <table  width="98%" border="0" style="margin:5px;" align="center" >
              <tr>
                <td width="100" align="right" valign="middle"><strong>ค่าแสดงผลคือ</strong>&nbsp;</td>
                <td align="center" style=" padding:5px; border:#A6C8D4 1px solid; background-color:#CCE5F4;">
                <?php 
				$objExp->checkExp();
				$objExp->showExp();
				?>
                </td>
              </tr>
              <tr>
                <td width="180" align="right" valign="middle"><strong>ค่าผลการตรวจสอบคือ</strong>&nbsp;</td>
                <td align="left" style=" padding:5px; border:#A6C8D4 1px solid; background-color:#CCE5F4;"  >
                <?php 
				if($objExp->checkExp() === true || $objExp->checkExp() === false){
					if($objExp->checkExp()){
						echo '<span style="color:#060"><strong>เป็นจริง</strong></span>';
					}else{
						echo  '<span style="color:#CC0000"><strong>เป็นเท็จ</strong></span>';
					}
				}else{
					echo '<span style="color:#060"><strong>'.$objExp->checkExp().'</strong></span>';
				}
				?>
                </td>
              </tr>
            </table>
            <?php } ?>
            </td>
          </tr>
          <tr>
            <td align="center">
            <input type="hidden" name="var_type" value="3"/>
            <input type="submit" name="b_process" value="ประมวลผล"/>&nbsp;
            <input type="button" name="b_cancel" value="ยกเลิก" onclick="window.location='?var_type=3&parameter=<?=$_GET['parameter']?>';" />
            </td>
          </tr>
        </table>
</form>
</center>
<?php } ?>
</body>
</html>
