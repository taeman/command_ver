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
 include("function/functions.php");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=TIS-620" />
<title>จัดการ Parameter</title>
<link rel="stylesheet" type="text/css" href="js/extjs/resources/css/ext-all.css">
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>
<script>

function returnvalue(){
var o  = new Object();
var tagMeta = document.getElementById("tb_parameter").getElementsByTagName ( 'input' );
var str_val = "";
	for(i=0;i<tagMeta.length;i++){
		if(tagMeta[i].type == "checkbox" && tagMeta[i].checked==true){
			inputs = tagMeta[i];
			str_val += inputs.value+"|";
		}
	}
	//alert(str_val);
	o.text_parameter = str_val;
	o.resetParameter = true;
	//window.returnValue = o;
	window.opener.GetDialog(o);
	window.close();
}

</script>
<?php
$arr_parameter = explode("|",$_GET['parameter']);
foreach($arr_parameter as $val_p){
	$arr_parameter[] = $val_p;
}
?>
<body>
         <table width="99%" style="font-size:14px;" border="0" cellpadding="1" cellspacing="1" id="tb_parameter" class="table_data" align="center">
          	<tr class="header_data">
              <td colspan="4" ><strong>จัดการ Parameter</strong></td>
            </tr>
            <tr class="header_data" align="center">
              <td width="100" >Parameter</th>
              <td >Parameter Name</th>
              <td  width="150" >Defualt Value</th>
              <td align="center">เลือก</th>
            </tr>
            <?php
			$parameter = readParameter();
			$intR=0;
			foreach($parameter as $key=>$val){
				$intR++;
				$chk = (in_array($val['parameter_eval'], $arr_parameter))?"CHECKED":"";
			?>
            <tr class="body_data">
            	<td  align="left"><?=$val['parameter_eval']?></th>
                <td  align="left"><?=$val['parameter_name']?></th>
              	<td  align="left"><?=$val['defualt_value']?></th>
                <td  align="center">
                <input type="checkbox" id="parameter<?=$intR?>" name="parameter[]" value="<?=$val['parameter_eval']?>:<?=$val['parameter_name']?>:<?=$val['defualt_value']?>" <?=$chk?> />
                </td>
              </tr>
            <?php
			}
            ?>
        </table>	
        <br/>&nbsp;
        <table align="center">
        <tr>
              <th>
             	  <input  type="button" name="b_add" value="บันทึก" id="b_add"  onclick="returnvalue();"  />
                  &nbsp;
                  <input type="reset" value="ยกเลิก"  onclick="window.close();"/>
               </th>
            </tr>
        </table>
</body>
</html>
