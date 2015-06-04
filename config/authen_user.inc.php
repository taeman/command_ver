<?
//-------------------------------------------------
// เช็คสิทธิการแก้ไขข้อมูล
// เพื่อปิดปุ่มบันทึกขู้อมูล
//------------------------------------------------
session_start();

if(basename($_SERVER['PHP_SELF']) != "kp7.php" && basename($_SERVER['PHP_SELF']) != "listname.php" && (basename($_SERVER['PHP_SELF']) == "add_staff.php") && (basename($_SERVER['PHP_SELF']) == "add_headsc.php")){

$sql_fdata = " SELECT  id FROM general WHERE  id = '$_SESSION[session_username]'  AND  ((position_now LIKE '%ครู%' OR position_now LIKE '%อาจารย์%') AND position_now NOT LIKE '%ใหญ่%' )  ";
$result_fdata = @mysql_query($sql_fdata);
$rs_fdata = @mysql_fetch_assoc($result_fdata);
//echo $rs_fdata."<hr>$sql_fdata";

if((basename($_SERVER['PHP_SELF']) == "pic_history_add.php" )){
	$condforpic = "|| (input[j].type.toLowerCase() == 'button')";
}else{
	$condforpic = "";
}


if( ($_SESSION[kj]==1 && in_array("$_SESSION[secid]",$array_full_siteid)) || ( $_SESSION[kj]==1 &&  in_array("$_SESSION[secid]",$array_notfull_siteid) && $rs_fdata[id] =="" ) ){

echo "
<script language=\"javascript\">

window.onload = function(e) {
if (!document.getElementById || !document.createTextNode) { 
return false;
}
var forms = document.getElementsByTagName('form');
for (var i = 0; i < forms.length; i++) {
var input = forms[i].getElementsByTagName('input');
for (var j = 0; j < input.length; j++) {
if ((input[j].type.toLowerCase() == 'submit') $condforpic) {
input[j].setAttribute('value','สิทธิของท่านไม่สามารถบันทึกข้อมูลได้');
input[j].setAttribute('disabled', true);

}
}
}
}

</script>

";
}

}

?>