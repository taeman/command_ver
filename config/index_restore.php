<?php
session_start();
set_time_limit(60000); 
$nonsec="1";
$dirpath="../../";
include($dirpath."config/conndb_nonsession.inc.php");
$set_yy = "2557";


function CheckProfile($getsite,$yy=2557){
		
		$db = STR_PREFIX_DB.$getsite;
		$sql = "SELECT
		t1.con_id_master
		FROM
		$db.up_confirm_master AS t1
		WHERE
		t1.con_year = '$yy'  ";
		$result = mysql_db_query($db,$sql) or die(mysql_error()."$sql<br>LINE__".__LINE__);
		$rs = mysql_fetch_assoc($result);
		return $rs['con_id_master'];	
		
}// CheckProfile


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=TIS-620" />
<title>เครื่องมือปลดล็อกสถานะรับรอง</title>
<script src="../common/js/jquery-1.8.3.js"></script>
</head>

  <h1 style="font-size:16px;">เครื่องมือประมวลผลดึงข้อมูลนับตัวกลับ</h1>
  </center>
<table width="75%" align="center" border="0" cellspacing="1" cellpadding="1" class="tabledata" bgcolor="#000000">
  <tr bgcolor="#FFF">
    <td width="5%"  bgcolor="#999999">ลำดับ</td>
    <td align="center"   bgcolor="#999999">หน่วยงาน</td>
    <td width="20%"  align="center" bgcolor="#999999">เครื่องมือ</td>
  </tr>
   <?php
$sql="SELECT
eduarea.secid,
eduarea.secname
FROM eduarea
where eduarea.status='1' order by  eduarea.orderby ASC ";

$result=mysql_db_query(DB_MASTER,$sql) or die(mysql_error());
$i=0;
$profile_upconfirm = 0;
while($row=mysql_fetch_assoc($result)){
	$i++;
	$color=($i%2==0)?"#FFF":"#d6d6d6";
	
	
	$profile_upconfirm = CheckProfile($row[secid],$set_yy);
	
?>
  <tr bgcolor="<?php echo $color?>" >
    <td height="25" align="center"><?php echo $i?></td>
    <td><?php echo $row[secname]?></td>
    <td align="center" ><?
    
		if($profile_upconfirm < 1){
				echo "<a href='restore_data.php?xsiteid=$row[secid]&profile_upconfirm=$profile_upconfirm&action=restore&yy=$set_yy' target='_blank'>ประมวลผลย้ายข้อมูลกลับ</a>";
		}else{
				echo "มีข้อมูลอยู่แล้ว";	
		}
	?></td>
  </tr>
  <?php
}

  ?>
 </table>
 
</body>
</html>