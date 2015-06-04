<?php
/**
* @comment ไฟล์ถูกสร้างขึ้นมาสำหรับสร้างเงื่อนไขการตรวจสอบคุณสมบัติของตำแหน่ง
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
require_once("class/class.utility.php");
require_once("class/class.validate.php");
$VLD = new Validate();

/*if($_POST){
echo "<pre>";
print_r($_POST);
echo "</pre>";
exit();
}*/
?>
<script type="text/javascript">

$(document).ready(function(){
	$('#form_position_radub').submit(function() {
		//Begin Check Form Data
		if($("#profile_id").val()==""){
			alert("กรุณาเลือกโปรไฟล์");
			return false;
		}else if($("#pid").val()==""){
			alert("กรุณาเลือกตำแหน่ง");
			return false;
		}else if($("#level_id").val()==""){
			alert("กรุณาเลือกระดับ");
			return false;
		}else if($("#letter_type").val()==""){
			alert("กรุณาเลือกประเภทคำสั่ง");
			return false;
		}
		
		//End Check Form Data
			//Send Data
			//alert($("#div_parameter").find( 'input[name="parameter[]"]' ).val());
			$.post(
				"process_position_condition.php",
				{
					profile_id:$("#profile_id").val(),
					pid:$("#pid").val(),
					level_id:$("#level_id").val(),
					letter_type:$("#letter_type").val(),
					parameter:getValToProcess(),
					//'parameter[]':$("#div_parameter").find( 'input[name="parameter[]"]' ).val(),
					//'period[]':$("#div_parameter").find( 'input[name="period[]"]' ).val(),
					match_id:$("#match_id").val()
				},
				function(msg){
					$("#msg").html(msg);
					if(msg=="true"){
						alert("บันทึกข้อมูลเรียบร้อย");
						linkPage("tree_position.php", "tree-detail-container");
						linkPage('position_condition.php?profile_id=', 'body-detail-container');
					}else if(msg=="false"){
						alert("ไม่สามารถบันทึกข้อมูลได้");
					}
				}
			);
			return false; 
	});
	
	$("#profile_id").change(function(){
		var p_type = $('option:selected',this).attr('class');
		
		$('#letter_type option[class="'+p_type+'"]').show();
		$('#letter_type option[class!="'+p_type+'"]').hide();

		$('#pid option[class="'+p_type+'"]').show();
		$('#pid option[class!="'+p_type+'"]').hide();		
	});
});

function checkCountPositionRadub(){
	match_id = $("#match_id").val();
	profile_id = $("#profile_id").val();
	letter_type = $("#letter_type").val();
	pid = $("#pid").val();
	level_id = $("#level_id").val();
	str_url = "ajex.check_data.php?get_data=position_radub";
	str_param = "&get_val="+match_id+"&get_val1="+profile_id+"&get_val2="+letter_type+"&get_val3="+pid+"&get_val4="+level_id;
	$.get(str_url+str_param, function(data) {
			if(data=="true"){
				alert("มีข้อมูลนี้อยู่แล้วกรุณาตรวจสอบ");
				document.getElementById('b_save').disabled=true;
			}else{
				document.getElementById('b_save').disabled=false;
			}
	});
}

</script>

<script>
function changePosition(pid, level_id){
	linkPage('ajex.radub.php?pid='+pid+'&level_id='+level_id, 'ajax_level_id');
}

function popWindow(url, w, h){
	var popup		= "Popup"; 
	if(w == "") 	w = 640;
	if(h == "") 	h = 480;
	var newwin 	= window.open(url, popup,'location=0,status=no,scrollbars=yes,resizable=no,width=' + w + ',height=' + h + ',top=20');
	newwin.focus();
}
function popupAddCon(){
	popWindow("macth_condition.php?"+getVal(),700,450);
}

function getValToProcess(){
	var txt_parameter = "";
		var txt_period = "";
		var tagMeta = document.getElementById("tb_parameter").getElementsByTagName ( 'input' );
			for(i=0;i<tagMeta.length;i++){
				if(tagMeta[i].type == "hidden"){
					inputs = tagMeta[i];
					if( inputs.title == '[parameter]' ){
						txt_parameter += inputs.value+"|";
					}
					
					if( inputs.title == '[period]' ){
						txt_period += inputs.value+"|";
					}
				}
			}
		return txt_parameter+"&"+txt_period;
}
function getVal(){
		var txt_parameter = "parameter=";
		var txt_period = "period=";
		var tagMeta = document.getElementById("tb_parameter").getElementsByTagName ( 'input' );
			for(i=0;i<tagMeta.length;i++){
				if(tagMeta[i].type == "hidden"){
					inputs = tagMeta[i];
					if( inputs.title == '[parameter]' ){
						txt_parameter += inputs.value+"|";
					}
					
					if( inputs.title == '[period]' ){
						txt_period += inputs.value+"|";
					}
				}
			}
		return txt_parameter+"&"+txt_period;
}

function addItem(parameter_id, parameter_name, period){
		//alert(parameter_id+", "+parameter_name+", "+period);
		var newCell = document.getElementById('tb_parameter');
		
		var numRow = newCell.rows.length;
		var insetTB = newCell.insertRow(numRow);
		insetTB.className = "body_data";
		
		var td1 = insetTB.insertCell(0);
		var td2 = insetTB.insertCell(1);
		
		//Text Field 
		text_field1 = '<label id="rec_'+numRow+'">'+numRow+'</label>';
		text_period = (period>0)?"  ระยะเวลา "+period+" ปี":"";
		text_field2 = '<input type="hidden" name="parameter[]" value="'+parameter_id+'" title="[parameter]" />';
		//alert(text_field2);
		text_field2 = text_field2 + '<input type="hidden" name="period[]" value="' + period + '" title="[period]" />';
		text_field2 = text_field2 + parameter_name + text_period;
		
		//Text TD
		insetTB.style.backgroundColor = "#FFFFFF";
		td1.innerHTML = text_field1;
		td2.innerHTML = text_field2;
		td1.style.textAlign = "center";
	}
	
	function deleteAll(){
		var newCell = document.getElementById('tb_parameter');
		var numRow = newCell.rows.length;		
		
		//Delete All Data
		for(intR=0;intR<numRow;intR++){
				if(intR>0){
						deleteRow("rec_"+intR);
				}
		}
	}
	
	function deleteRow(my_id){
		var i=document.getElementById(my_id).parentNode.parentNode.rowIndex;
		document.getElementById('tb_parameter').deleteRow(i);
	}
	
	function conF(my_id){
		if(confirm('ท่านต้องการลบรายการนี้ใช่หรือไม่?')){
			deleteRow(my_id);
			return true;
		}else{
			return false;
		}
	}
</script>
<style>
#form_tbvariatable td {
	padding:2px;
}
 .txt_red{
	 color:#F00;
}
.link_validate{
	text-align:center; 
	background-color:#EEE; 
	width:100px; 
	margin:2px; 
	border:#666 1px solid;
	border-radius: 3px 3px 3px 3px; 
	color:#000;
}
.nolink_validate{
	text-align:center; 
	background-color:#EEE; 
	width:100px; 
	margin:2px; 
	border:#CCC 1px solid;
	border-radius: 3px 3px 3px 3px; 
	color:#CCC;
}
</style>
<DIV style="margin:5px;">
<DIV id="msg"></DIV>
<?php
#ค่าที่ต้องการส่งไปเพื่อตรวจสอบ
#นักวิชาการเงินและบัญชี
$position_radub_validate[525471147][92255105][1] = array("letter_id"=>"7708","idcard"=>"3430300213850");
$position_radub_validate[525471147][92255106][1] = array("letter_id"=>"6494","idcard"=>"3250200209984");
$position_radub_validate[525471147][92255105][2] = array("letter_id"=>"9620","idcard"=>"3470400231302");
$position_radub_validate[525471147][92255106][2] = array("letter_id"=>"12928","idcard"=>"3479900207221");

#เจ้าพนักงานธุรการ
$position_radub_validate[525471018][92255110][1] = array("letter_id"=>"5964","idcard"=>"3461100281241");
$position_radub_validate[525471018][92255111][1] = array("letter_id"=>"6767","idcard"=>"3520300439083");
$position_radub_validate[525471018][92255110][2] = array("letter_id"=>"7018","idcard"=>"3301700079486");
$position_radub_validate[525471018][92255111][2] = array("letter_id"=>"12928","idcard"=>"5480500035510");

#นักวิชาการศึกษา
$position_radub_validate[525471174][92255105][1] = array("letter_id"=>"10799","idcard"=>"3869900058159");
$position_radub_validate[525471174][92255106][1] = array("letter_id"=>"5964","idcard"=>"3220100090152");


$sql_position_radub = "SELECT * FROM cmd_position_radub WHERE cmd_position_radub.match_id='".$_GET['match_id']."' ";
$query_position_radub = mysql_db_query($db_app, $sql_position_radub) or die(mysql_error());
$position_radub = mysql_fetch_assoc($query_position_radub);
?>
<form id="form_position_radub" action="" method="post" enctype="multipart/formdata">
<table width="100%" border="0" id="form_tbposition_radub">
	<tr>
        <td  width="150" align="right">โปรไฟล์<span class="txt_red">*</span>:</td>
        <td>
        <?php
        $sql_profile = "SELECT * FROM `cmd_profile`  ";
		$query_profile = mysql_db_query($db_app, $sql_profile) or die(mysql_error());
        ?>
        	<select id="profile_id" name="profile_id" style="width:520px;"  onchange="checkCountPositionRadub();">
           		<option value="">ระบุโปรไฟล์</option>
                <?php
				while($profile = mysql_fetch_assoc($query_profile)){
					$sldProF = ($profile['profile_id']==$position_radub['profile_id'])?"SELECTED":""; 
                ?>
                <option class="<?php echo $profile['profile_id']==2?'38k':'teacher' ?>" value="<?php echo $profile['profile_id']?>" <?=$sldProF?>><?php echo $profile['logic_profile_name']?></option>
                <?php } ?>
             </select>
        </td>
      </tr>
       <tr>
        <td align="right">ประเภทคำสั่ง<span class="txt_red">*</span>:</td>
        <td>
        <?php
        $sql_letter_type = "SELECT * FROM `command_letter_type`  ";
		$query_letter_type = mysql_db_query($db_app, $sql_letter_type) or die(mysql_error());
        ?>
        	<select id="letter_type" name="letter_type" style="width:520px;" onchange="checkCountPositionRadub();">
            	<option value="">ระบุประเภทคำสั่ง</option>
            	<?php
				while($letter_type = mysql_fetch_assoc($query_letter_type)){
					$sldT = ($letter_type['letter_type']==$position_radub['letter_type'])?"SELECTED":""; 
                ?>
           		 <option class="<?php echo $letter_type['letter_type_group']==1?'teacher':'38k' ?>" value="<?php echo $letter_type['letter_type']?>" <?=$sldT?>><?php echo $letter_type['letter_type_name']?></option>
                <?php } ?>
             </select>
        </td>
      </tr>
      <tr>
        <td align="right">ตำแหน่ง<span class="txt_red">*</span>:</td>
        <td>
        <?php
        //$sql_position = "SELECT * FROM `hr_addposition_now` WHERE  pid LIKE('5%') ORDER BY orderby ASC ";
		$sql_position = "SELECT
						hr_addposition_now.runid,
						hr_addposition_now.position,
						hr_addposition_now.for_unitid,
						hr_addposition_now.orderby,
						hr_addposition_now.pid,
						hr_addposition_now.status_vitaya,
						hr_addposition_now.position_type,
						hr_addposition_now.group_id,
						hr_addposition_now.status_active,
						hr_addposition_now.position_line,
						hr_addposition_now.position_line_after,
						hr_addposition_now.position_group,
						hr_addposition_now.v14group,
						hr_addposition_now.pos_typeno,
						hr_addposition_now.groupposition_id,
						hr_addposition_now.status_graduate_high,
						if(pid LIKE('5%') OR pid IN ('625482081','625471105','625471106','625471126','625471131','625471112'),'38k','teacher') AS p_type
						FROM `hr_addposition_now`
						WHERE  pid LIKE('5%') OR pid IN ('625482081','625471105','625471106','625471126','625471131','625471112')
						OR pid IN ('425471000','325001010','225471000','325471008','125471009','125471008','425471006')
						ORDER BY orderby ASC";
		$query_position = mysql_db_query($db_master, $sql_position);
        ?>
            <select id="pid" name="pid" style="width:230px;" onchange="changePosition(this.value,''),checkCountPositionRadub();">
           		<option value="">ระบุตำแหน่ง</option>
                <?php
				while($position = mysql_fetch_assoc($query_position)){
					$sldP = ($position['pid']==$position_radub['pid'])?"SELECTED":""; 
                ?>
                <option class="<?php echo $position['p_type']?>" value="<?php echo $position['pid']?>" <?=$sldP?>><?php echo $position['position']?></option>
                <?php } ?>
          </select>
        </td>
      </tr>
      <tr>
        <td align="right">ระดับ<span class="txt_red">*</span>:</td>
        <td>
        	<span id="ajax_level_id">
        	<select id="level_id" name="level_id" style="width:230px;">
           		<option value="">ระบุระดับ</option>
             </select>
             </span>
             <?php
			 if($position_radub['pid']!="" && $position_radub['level_id']!=""){
				 echo '<script>';
				 echo "changePosition('".$position_radub['pid']."', '".$position_radub['level_id']."');";
				 echo '</script>';
			 }
             ?>
        </td>
      </tr>
     
      <tr>
        <td align="right" valign="top">รายการการตรวจสอบ:</td>
        <td align="left">
        <table width="520" border="0">
          <tr>
            <td>&nbsp;</td>
            <td align="right"><img src="images/add.png" border="0" title="เพ่ิมเงื่อนไข" style="cursor:pointer;" align="absmiddle" onClick="popupAddCon();" /></td>
          </tr>
        </table>
        <?php
		$sql_macth_cond = "SELECT cmd_condition.cond_id, 
												cmd_condition.cond_name, 
												cmd_condition.cond_detail, 
												cmd_position_match_condition.match_id,
												cmd_position_match_condition.period
											FROM cmd_condition 
											INNER JOIN cmd_position_match_condition 
											ON cmd_condition.cond_id = cmd_position_match_condition.cond_id
											WHERE cmd_position_match_condition.match_id='".$position_radub['match_id']."'
											ORDER BY cmd_position_match_condition.order_by ASC
											;
										";							
		$query_macth_cond = mysql_db_query($db_app, $sql_macth_cond) or die(mysql_error());
        ?>
       <DIV id="div_parameter"> 
      <table id="tb_parameter" width="520" border="1" cellpadding="2" cellspacing="1" class="table_data"  >
          <tr  class="header_data" align="center">
            <td  width="50">ลำดับ</td>
            <td>รายการ</td>
          </tr>
          <?php
		  $intMB=0;
		  while($macth_cond = mysql_fetch_assoc($query_macth_cond)){
			  $intMB++;
          ?>
          <tr class="body_data">
            <td align="center">
            <label id="rec_<?php echo $intMB?>"><?php echo $intMB?></label>
            </td>
            <td>
            <input type="hidden" name="parameter[]" value="<?=$macth_cond['cond_id']?>" title="[parameter]" />
            <input type="hidden" name="period[]" value="<?=$macth_cond['period']?>" title="[period]" />
			<?=$macth_cond['cond_name']?><?php echo ($macth_cond['period']>0)?"  ระยะเวลา ".$macth_cond['period']." ปี":"";?>
            </td>
          </tr>
          <?php }?>
        </table>
        </DIV>
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>
        <?php
		if($position_radub['match_id']!=""){
			//$position_radub_validate = $VLD->getDataCommandValidate($position_radub['pid'], $position_radub['level_id'],$position_radub['letter_type'] );
			$letter_id = "";
			$idcard = "";
			//$letter_id = $position_radub_validate["letter_id"];
			//$idcard = $position_radub_validate["idcard"];
			$letter_id = $position_radub_validate[$position_radub['pid']][$position_radub['level_id']][$position_radub['letter_type']]['letter_id'];
			$idcard = $position_radub_validate[$position_radub['pid']][$position_radub['level_id']][$position_radub['letter_type']]['idcard'];
			if($letter_id!=""){
				$link_validate = "../position_verification_tool.php?letter_id=".$letter_id."&idcard=".$idcard."&by_person=1&pos=0&now=0&par=1&validate=1";
				$target_validate = 'target="_blank"';
				$link_class = "link_validate";
			}else{
				$link_validate = "#";
				$target_validate = '';
				$link_class = "nolink_validate";
			}
		?>
         <a href="<?=$link_validate?>" <?=$target_validate?>><DIV class="<?=$link_class?>">การตรวจสอบ</DIV></a>
		<?php	
		}
        ?>
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>
        <input type="hidden" id="match_id"  name="match_id" value="<?=$position_radub['match_id']?>"/>
        <input type="submit"  id="b_save" name="b_save" value="บันทึก"/>&nbsp;
        <input type="button" name="b_cancel" value="ยกเลิก"/>
        </td>
      </tr>
 </table>
 <div id="result"></div>
</form>
</DIV>
