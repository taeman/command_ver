<?php
session_start();
header("Content-Type: text/html; charset=windows-874");
include("app_config.php");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=TIS-620" />
<title>เลือกเงื่อนไข</title>
<link rel="stylesheet" type="text/css" href="js/extjs/resources/css/ext-all.css">
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery/jquery-1.6.4.min.js"></script>
<script type="text/javascript" src="js/jqueryui/js/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="js/main.js"></script>
<script>

function genInputPeriod(my_id, gcond_id){
	level_id = opener.$("#level_id").val();
	$.get("ajex.check_data.php?get_data=period_radub&get_val="+gcond_id+"&get_val1="+level_id, function(data) {
			//alert(document.getElementById('cond_'+my_id).checked);
			if(data=="true"){
				if(document.getElementById('cond_'+my_id).checked == true ){
					$("#input_period"+my_id).show();
				}else{
					$("#input_period"+my_id).hide();
				}
			}
	});
}

function returnValue(){
	var tagMeta = document.getElementById("tb_parameter").getElementsByTagName ( 'input' );
	opener.deleteAll();
	for(i=0;i<tagMeta.length;i++){
			if(tagMeta[i].type == "checkbox"){
					inputs = tagMeta[i];
					cond_id = inputs.id;
					if(document.getElementById(cond_id).checked==true){
							arr_cond_id = cond_id.split("_");
							period = $("#period_"+arr_cond_id[1]).val();
							period = (period>0)?period:0;
							opener.addItem(inputs.value, inputs.title, period);
					}		
			}
	}
	window.close();
}
</script>
</head>
<?php
$arr_parameter = explode("|",$_GET['parameter']);
$arr_period = explode("|",$_GET['period']);
/*echo "<pre>";
print_r($arr_period);
echo "</pre>";*/

$intP = 0;
foreach($arr_parameter as $val_p){
	$intP++;
	$arr_parameter[$val_p] = $val_p;
	$arr_period_val[$val_p] = $arr_period[$intP-1];
}
?>
<?php

$sql = "SELECT cmd_condition.*
			FROM cmd_condition_group INNER JOIN cmd_condition ON cmd_condition_group.gcond_id = cmd_condition.gcond_id
			WHERE cond_status='1'
			ORDER BY cmd_condition_group.order_by ASC ";
$query = mysql_db_query($db_app, $sql);
?>
<body>
         <table width="99%" style="font-size:14px;" border="0" cellpadding="1" cellspacing="1" id="tb_parameter" class="table_data" align="center">
          	<tr class="header_data">
              <td colspan="4" ><strong>เลือกเงื่อนไข</strong></td>
            </tr>
            <tr class="header_data" align="center">
              <td width="50" >ลำดับ</th>
              <td >เงื่อนไข</th>
              <td width="50">เลือก</th>
            </tr>
            <?php
			$intR=0;
			while($row = mysql_fetch_assoc($query)){
				$intR++;
				$chk = (in_array($row['cond_id'], $arr_parameter))?"CHECKED":"";
			?>
            <tr class="body_data">
            	<td  align="center"><?=$intR;?></th>
                <td  align="left">
                <table width="100%" border="0" style="font-size:12px;">
                  <tr>
                    <td width="60%" style="border:#FFF 0px solid;">&nbsp;<?=$row['cond_name']?></td>
                    <td style="border:#FFF 0px solid;" align="right">
                    <span id="input_period<?=$row['cond_id']?>" style="display:none;" ><!---->
                    ระยะเวลา <input type="text" id="period_<?=$row['cond_id']?>" name="period[]" value="<?php echo $arr_period_val[$row['cond_id']]?>" size="3"/> ปี
                    </span>
                    </td>
                  </tr>
                </table>
                </th>
                <td  align="center">
                <input type="checkbox" id="cond_<?=$row['cond_id']?>" title="<?=$row['cond_name']?>" name="cond_id[]" value="<?=$row['cond_id']?>" <?=$chk?> onClick="genInputPeriod('<?=$row['cond_id']?>','<?=$row['gcond_id']?>');" />
                </td>
              </tr>
            <?php
				if($chk=="CHECKED"){
					echo '<script>';
					echo "genInputPeriod('".$row['cond_id']."','".$row['gcond_id']."');";
					echo '</script>';
				}
			}
            ?>
        </table>	
        <br/>&nbsp;
        <table align="center">
        <tr>
              <th>
             	  <input  type="button" name="b_add" value="บันทึก" id="b_add"  onclick="returnValue();"  />
                  &nbsp;
                  <input type="reset" value="ยกเลิก"  onclick="window.close();"/>
               </th>
            </tr>
        </table>
</body>
</html>
