<?php
session_start();
include("app_config.php");
require_once("read_function.php");
require_once("class/class.utility.php");

mysql_query("SET NAMES 'tis620'");
header("Content-Type: text/html; charset=windows-874");
if($_POST){
		
		$name = $_FILES['php_function']['name'];
		$tmp = $_FILES['php_function']['tmp_name'];
		
		$sql_func  = " SELECT COUNT(func_name) AS count_func FROM cmd_function WHERE func_name='".str_replace(".php","",$name)."' GROUP BY  func_name";
		$query_func = mysql_db_query($db_app, $sql_func) or die($sql_func."<br/>".mysql_error());	
		$func = mysql_fetch_assoc($query_func);
		if($func>0){
			echo "	<script>
						alert('มีไฟล์ PHP Function อยู่ในระบแล้วกรุณาตรวจสอบ');
						window.location='?';
						</script>";
			exit();
		}
		
		$path = "variable/".basename($name);
		if(copy($tmp,$path)){
			
			#Require_once Function
			$sql_func  = " SELECT * FROM cmd_function WHERE func_name!='' ";
			$query_func = mysql_db_query($db_app, $sql_func) or die(mysql_error());	
			 while($func_name = mysql_fetch_assoc($query_func)){
					if(is_file("variable/".$func_name['func_name'].".php")){
						require_once("variable/".$func_name['func_name'].".php");
				}
			}
			
			$r= new read_Reflection();
			$c=$r->classReflection('variable/', $name);
				foreach($c as $classname=>$detail){
					$func_name = strtolower(substr($classname,0,1)).substr($classname,1,50);
					
					$sql_function  = "
						INSERT INTO cmd_function 
						SET func_name='".$func_name."',
						func_update=NOW(),
						func_status='1'
					";
					mysql_db_query($db_app, $sql_function) or die(mysql_error());	
					$id_func = mysql_insert_id();
					
    				$func_detail = $detail['classComment'];
					foreach($detail['classTags'] as $Tag=>$Tagcomment){
						if($Tag=="param"){
								foreach($Tagcomment as $comment){
									//echo"&nbsp;&nbsp;$Tag : $comment<br>";
									$arr_param = explode("$",$comment);
									$arr_comment = explode(",",$arr_param[1]);
									$param_name = $arr_comment[0];
									$param_detail = $arr_comment[1];
									$param_values = $arr_comment[2];
									$sql_function_param  = "
													INSERT INTO cmd_function_param 
													SET id_func='".$id_func."',
													param_name='$".trim($param_name)."',
													param_detail='".trim($param_detail)."',
													param_values='".trim($param_values)."'
												";
									//echo "<p>";			
								mysql_db_query($db_app, $sql_function_param ) or die(mysql_error());
							}
							
						}//IF
						if($Tag=="description"){
								foreach($Tagcomment as $description){
									$str_description .= $description;
								}
						}//IF
						if($Tag=="return"){
								foreach($Tagcomment as $return){
									$str_return .= trim(str_replace('"','',$return));
								}
						}//IF
					}//Foreach
					
					$sql_function_update  = "
						UPDATE cmd_function 
						SET func_detail='".$str_description."',
						func_param_out='".$str_return."'
						WHERE id_func='".$id_func."'
					";
					mysql_db_query($db_app, $sql_function_update) or die(mysql_error());
					
				}//Foreach
			echo "	<script>
					alert('บันทึกข้อมูลเรียบร้อย');
					window.location='?';
				</script>";
		}else{//IF copy
			echo "	<script>
					alert('ไม่สามารถบันทึกข้อมูลได้');
					window.location='?';
				</script>";
	
		}
}
?>
<?php
	$sql_list  = " SELECT * FROM cmd_function ";
	$query_list = mysql_db_query($db_app, $sql_list) or die(mysql_error());	
?>
<table width="95%" border="0" cellpadding="2" cellspacing="1" bgcolor="#333333" style="font-size:12px;" align="center">
  <tr align="center" bgcolor="#CCCCCC">
    <td width="50">ลำดับ</td>
    <td width="200">ชื่อฟังก์ชั่น</td>
    <td>คำอธิบาย</td>
  </tr>
 <?php
 $intR = 0;
 while($list = mysql_fetch_assoc($query_list)){
	 $intR++;
 ?>
  <tr bgcolor="#FFFFFF">
    <td align="center"><?php echo $intR;?></td>
    <td><?php echo $list['func_name'];?></td>
    <td><?php echo $list['func_detail'];?></td>
  </tr>
  <?php } ?>
</table>
<center>
<form action="" method="post" enctype="multipart/form-data">
<table  border="0">
  <tr>
    <td style="font-size:12px;">ไฟล์ PHP Function:</td><td><input type="file" name="php_function" id="php_function"/></td>
  </tr>
  <tr>
    <td>&nbsp;</td><td><input type="submit" name="b_upload" value="Upload"/></td>
  </tr>
</table>
</form>
</center>