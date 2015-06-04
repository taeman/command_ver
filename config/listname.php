<?
session_start();
$_SESSION[secid]  = $secname ; 

//include("../../../config/db.inc.php");
#include("../../../config/conndb_nonsession.inc.php");
include("../../../config/config_hr.inc.php");
include("../../../config/phpconfig.php");
//conn2DB();
#$cmss_db = "hr_temp";
$smonth = array("","ม.ค.", "ก.พ.", "มี.ค.", "เม.ย", "พ.ค", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
function count_person_m($schoolid){// นับจำนวนผู้ชาย
$db_site = "cmss_"."".$_SESSION[secid];
	$sql_count = "SELECT COUNT(*) AS  num1 FROM general WHERE schoolid = '$schoolid' and sex like '%ชาย%'";
	//echo $sql_count."<br>$db_site";
	$result_count = mysql_db_query($db_site,$sql_count);
	$rs_c = mysql_fetch_assoc($result_count);
	return $rs_c[num1];
}// end function count_person(){

function count_person_f($schoolid){// นับจำนวนผู้หญิง
$db_site = "cmss_"."".$_SESSION[secid];
	$sql_count = "SELECT COUNT(*) AS  num1 FROM general WHERE schoolid = '$schoolid' and sex like '%หญิง%'";
	//echo $sql_count."<br>$db_site";
	$result_count = mysql_db_query($db_site,$sql_count);
	$rs_c = mysql_fetch_assoc($result_count);
	return $rs_c[num1];
}// end function count_person(){



#   http://202.129.35.104/competency_master/application/hr3/register/listname.php?secname=5001&login=pass
$sql = "   SELECT secid ,   IP  , intra_ip  FROM   cmss_master.area_info    
Inner Join cmss_master.eduarea  ON  cmss_master.area_info.`area_id` = cmss_master.eduarea.`area_id`  
where secid =  '$secname'     "; 
//echo $sql."<br>";
$result = mysql_query($sql);
$rs = mysql_fetch_assoc($result) ; 
$ip_database  = $rs[intra_ip] ;   
$ip_internet  = $rs[IP] ;   
$ip_now = $_SERVER[SERVER_ADDR] ; 

//echo " <hr>   $ip_database   <br>     $ip_now   <hr>  ";
if ($ip_database !=  $ip_now ){
	$newurl = "http://" . $ip_internet ."/competency_master/application/hr3/register/listname.php?secname=".$secname."&login=pass";   
	echo " <center><h4>  ขออภัยเกิดการเีรียกใช้คอมพิวเตอร์แม่ข่ายผิดพลาด  <br> หากท่านเข้าระบบโดยเรียกจาก Favorites  <br> ";
	echo " <a href='$newurl'  >คลิ๊กที่นี่ เพื่อไปยังคอมพิวเตอร์แม่ข่ายที่ถูกต้อง</a>  ";	
	die; 
} ###### END if ($ip_database !=  $ip_now ){
if ($delid != ""){

	$err_msg = ""; 
	$sql = "  SELECT * FROM  `salary`  WHERE  `id`  LIKE '%$delid%'  ";
	$result = mysql_query($sql);  $numrow = @mysql_num_rows($result) ; 
	if ($numrow > 0 ){  	$err_msg .= " <br>- ข้อมูล ตำแหน่งและอัตราเงินเดือน  "; }
	
	$sql = "  SELECT * FROM  `graduate`  WHERE  `id`  LIKE '%$delid%'   ";
	$result = mysql_query($sql);  $numrow = @mysql_num_rows($result) ; 
	if ($numrow > 0 ){  	$err_msg .= " <br>- ข้อมูล ประวัติการศึกษา  "; }
	
	$sql = "  SELECT * FROM  `seminar`  WHERE  `id`  LIKE '%$delid%'   ";
	$result = mysql_query($sql);  $numrow = @mysql_num_rows($result) ; 
	if ($numrow > 0 ){  	$err_msg .= " <br>- ข้อมูล ฝึกอบรมและดูงาน  "; }
	
	$sql = "  SELECT * FROM  `getroyal`  WHERE  `id`  LIKE '%$delid%'  ";
	$result = mysql_query($sql);  $numrow = @mysql_num_rows($result) ; 
	if ($numrow > 0 ){  	$err_msg .= " <br>- ข้อมูล เครื่องราชอิสริยาภรณ์ "; }

	if (($err_msg !="")and($godel=="")){
		$err_msg1   =  "<center>  บุคลากรที่ต้องการลบมีการนำเข้าข้อมูล เรื่อง  <br> ". $err_msg  ; 
	    //$err_msg1   .= "<br><br> <font color=red>  หากยืนยันการลบ ข้อมูลดังกล่าวจะถูกลบจากระบบ   </font> ";		
		//$err_msg1   .= "<br><br>  <a href='?secname=$secname&delid=$delid&godel=1'>ต้องการยืนยันการลบ คลิ๊ก ที่นี่ </a> ";
		//$err_msg1   .= "<br>   <a href='?secname=$secname'>ยกเลิกคลิ๊กที่นี่ </a> ";	
		$err_msg1   .= "<br><br> <font color=red>  หากยืนยันต้องการลบต้องลบข้อมูลที่เคยนำเข้าก่อนจึงจะสามารถลบได้    </font> ";
		echo $err_msg1 ; 
		die; 
	}
 
	$sql = "	DELETE FROM `general` WHERE (`id`='$delid')        ";
	$result = mysql_query($sql);
	if ($result){
		$sys_msg = "ลบเสร็จสิ้น";
	}

} ###### END if ($delid != ""){

//if($_SERVER['REQUEST_METHOD']=="POST"){
//
//#	$sql1 = " SELECT  *  FROM  login where  (username = '$usr')  AND  (pwd = '$password') AND  (id = '$secname')  ";
//	$sql1 = " SELECT  *  FROM  login where  (username = '$usr')  AND  (pwd = '$password')   ";	
//	//echo $sql1;die;
//	$result1= mysql_query($sql1);
//	 $numrows = mysql_num_rows($result1);
//
//	if($numrows<1){
// 	#	echo $numrows;die;
//		echo "  <script language=\"JavaScript\">  alert(\"่ท่านกรอกข้อมูลไม่ถูกต้อง\") ; </script> ";	
//		#echo $sql1 ; die;
//	 #die(__LINE__ .  "::::::  ขออภัย กรุณาลองใหม่ อีก 30 นาที   ($numrows)"); 		
//		
//		#die; 
//		echo "<meta http-equiv='refresh' content='0; url=listname.php?secname=$secname&action=login'>";
//		exit;		
//		die;
//	}else{
//		
//		$_SESSION[siteid]  = $secname ; 
//		$_SESSION[login]  = "pass"  ; 		
//		echo "<html><head><meta http-equiv='Refresh' content='0;URL=listname.php?secname=$secname&login=pass' /></head>";
//	}	
//}
//


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<link href="../../../common/style.css" type="text/css" rel="stylesheet">
<title></title>
<script language="javascript">
function mOvr(src,clrOver){ 
	if (!src.contains(event.fromElement)) src.bgColor = clrOver; 
} 

function mOut(src,clrIn){ 
	if (!src.contains(event.toElement)) src.bgColor = clrIn; 
} 
</script>
<SCRIPT LANGUAGE="JavaScript">
<!--Start
function   chk_confirm_person(name01) {
		if (!(confirm("ต้องการลบ "+ name01 +" หรือไม่"))){
				return false; 
		}
}	  


function clearall(){
	document.form2.name_th.value = '';	
	document.form2.surname_th.value = '';	
	document.form2.idcard.value = '';	
}
//-->
</SCRIPT>
<style type="text/css">
<!--
.page {
	font						: 9px tahoma;
	font-weight			: bold; 	
	color					: #0280D5;	
	padding				: 1px 3px 1px 3px;
}	

.pagelink {
	font						: 9px tahoma;
	font-weight			: bold; 
	color					: #000000;
	text-decoration	: underline;
	padding				: 1px 3px 1px 3px;
}
.go {
	BORDER: #59990e 1px solid; 
	PADDING-RIGHT: 0.38em; 
	PADDING-LEFT: 0.38em; 
	FONT-WEIGHT: bold; 
	FONT-SIZE: 105%; 
	BACKGROUND: url(../../application/hr3/hr_report/images/hdr_bg.png) #6eab26 repeat-x 0px -90px; 
	FLOAT: left; 
	PADDING-BOTTOM: 0px; 
	COLOR: #fff; 
	MARGIN-RIGHT: 0.38em; 
	PADDING-TOP: 0px; 
	HEIGHT: 1.77em
}
#bf .go {
	FLOAT: none
}
.go:hover {
	BORDER: #3f8e00 1px solid; 
	BACKGROUND: url(../../application/hr3/hr_report/images/hdr_bg.png) #63a218 repeat-x 0px -170px; 
}
.q {
	BORDER-RIGHT: #5595CC 1px solid; 
	PADDING-RIGHT: 0.7em; 
	BORDER-TOP: #5595CC 1px solid; 
	PADDING-LEFT: 0.7em; 
	FONT-WEIGHT: normal; FONT-SIZE: 105%; 
	FLOAT: left; 
	PADDING-BOTTOM: 0px; 
	MARGIN: 0px 0.38em 0px 0px; 
	BORDER-LEFT: #5595CC 1px solid; 
	WIDTH: 300px; 
	PADDING-TOP: 0.29em; 
	BORDER-BOTTOM: #5595CC 1px solid; 
	HEIGHT: 1.39em

}
.tabberlive .tabbertab {
	background-color:#FFFFFF;
  height:200px;
}
.style6 {font-size: 16}
-->
		#mainmenu ul{
			width: 100%;
			height: 30px;
			background-color: #393;
			margin: 0px;
			padding: 0px;
			font-size: 12px;
		}
			#mainmenu ul li{
				float: left;
				list-style: none;
				margin: 0px;
				position: relative;
				height: 30px;
                width: 200px;				
			}
				#mainmenu ul li a{
					display: block;
					padding: 0px 10px;
					height: 30px;
					line-height: 30px;
					color: #FFF;
					text-decoration: none;
					border-right: 1px solid #363;
					border-left: 1px solid #3c3;
				}

				#mainmenu ul li ul{
					width: 170px;
					position: absolute;
					left: -12000px;
					float: left;
					clear: left;
				}
				
					#mainmenu ul li.hover ul{
						left: 0px;
					}
				
					#mainmenu ul li ul li{
						background-color: #000;
					}
						#mainmenu ul li.hover ul li a{
							border-width: 0px;
							border-bottom: 1px solid #CCC;
							background-color: #000;
							height: 29px;
							width: 150px;
						}

				#mainmenu ul li.hover a{
					background-color: #3c3;
				}
				#mainmenu ul li ul li.hover a{
					background-color: #333;
				}		
												
	</style>
	<script src="jquery.min.js" type="text/javascript"></script>
	<script type="text/javascript">
		jQuery.noConflict();
		
		jQuery(document).ready(function(){
			jQuery('#mainmenu').find('li').mouseenter(function(){
				jQuery(this).addClass('hover');
			}).mouseleave(function(){
				jQuery(this).removeClass('hover');
			});
		});
		
	</script>

</head>
<body>
<? if($action != "login"){?>
<!--<div id="mainmenu">
	<ul>
		<li><a href="add_headsc.php?secid=<?=$secname?>">เพิ่มผู้บริหารหน่วยงาน</a></li>
		<li><a href="add_staff.php?siteid=<?=$secname?>">เพิ่มบุคลากรในหน่วยงาน</a></li>
		<!--<li><a href="#" onclick="window.close();" >ปิดหน้าต่าง</a></li>
   	</ul>
</div>
-->
<form id="form2" name="form2" method="post" action="">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td align="center"><table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr>
          <td width="29%" align="right"><span style=" font-size:14px; padding-left:20px">ชื่อ  : </span></td>
          <td width="26%"><input name="name_th" type="text"   value="<?=$name_th?>" size="25" /></td>
          <td width="45%"> </td>
        </tr>
        <tr>
          <td align="right"><span style=" font-size:14px; padding-left:20px">นามสกุล : </span></td>
          <td><input name="surname_th" type="text"   value="<?=$surname_th?>" size="25" /></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="right"><span style=" font-size:14px; padding-left:20px">รหัสประจำตัวประชาชน : </span></td>
          <td><input name="idcard" type="text"    value="<?=$idcard?>" size="25" /></td>
          <td><input name="submit2" type="submit" class="go" value="ค้นหา" />  <input name="Button" type="button" class="go" value="ล้างค่า" onclick="clearall();">
		  <input type="hidden" name="action" value="view_data">
		  <input type="hidden" name="search" value="search" />		  </td>
        </tr>
      </table></td>
    </tr>
  </table>
</form>
<?
} //end if($action != "login"){
if($action=="login"){
?> 
<form id="form1" name="form1" method="post" action="?">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="3" bgcolor="#E6E6E6">
  <tr>
    <td height="18" colspan="3" bgcolor="#A3B2CC" class="headerTB">กรุณา login เพื่อเข้าแก้ไขข้อมูล </td>
    </tr>
  <tr>
    <td width="40%" align="right" class="link_back">Username</td>
    <td width="46%"><input name="usr" type="text" id="usr" />
      <input name="secname" type="hidden" id="secname" value="<?=$secname?>" /></td>
    <td width="14%">&nbsp;</td>
  </tr>
  <tr>
    <td align="right" class="link_back">Password</td>
    <td><input name="password" type="password" id="password" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td><input type="submit" name="Submit" value="เข้าสู่ระบบ" /></td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
<?	
}else{
?>
<table width="100%" border="0"  cellpadding="0" cellspacing="0">
<tr>
<td>
<?

if ($secname == ""){
	echo "  <script language=\"JavaScript\">  alert(\"กรุณาเลือกเขตพื้นที่\") ; </script> ";	
	echo "<script language=\"JavaScript\"> window.location= \"http://www.cmss-otcsc.com\"  ;  </script> ";
}

$query_area = mysql_query(" SELECT  *  FROM  $dbnamemaster.eduarea  where secid = '$secname'    ") ;
while($rs1 = mysql_fetch_assoc($query_area)){
	$areaname = $rs1[secname] ; 
}

?>
<? if($action == "VIEW_DETAIL"){?>
 <table width="100%" border="0" cellspacing="0" cellpadding="0">
   <tr>
     <td align="center" bgcolor="#000000"><table width="100%" border="0" cellspacing="1" cellpadding="3">
       <tr>
         <td colspan="4" align="left" bgcolor="#A3B2CC"><span class="style6">รายงานสรุปการลงทะเบียนข้อมูลตั้งต้นรายหน่วยงาน 
           <?=$areaname?>
         </span></td>
         </tr>
       <tr>
         <td width="4%" rowspan="2" align="center" bgcolor="#A3B2CC"><span class="style6">ลำดับ</span></td>
         <td width="66%" rowspan="2" align="center" bgcolor="#A3B2CC"><span class="style6">หน่วยงาน</span></td>
         <td colspan="2" align="center" bgcolor="#A3B2CC"><span class="style6">จำนวนบุคลากร(คน)</span></td>
         </tr>
       <tr>
         <td width="14%" align="center" bgcolor="#A3B2CC"><span class="style6">ชาย</span></td>
         <td width="16%" align="center" bgcolor="#A3B2CC"><span class="style6">หญิง</span></td>
       </tr>
		 <?
		 	$sql_org = "SELECT * FROM allschool  WHERE  siteid ='".$_SESSION[secid]."' ORDER BY  id  DESC, office ASC ";
			$result_org = mysql_db_query($dbnamemaster,$sql_org);
			$n=0;
			while($rs_org = mysql_fetch_assoc($result_org)){
				if ($n++ %  2) $bgcolor = "#F0F0F0"; else $bgcolor = "#FFFFFF";
				 if($rs_org[id] != $rs_org[siteid]){ $schoolname =  "โรงเรียน".$rs_org[office];}else{  $schoolname = "$rs_org[office]";}
		 ?>

       <tr bgcolor="<?=$bgcolor?>">
         <td align="center"><?=$n?></td>
         <td align="left"><?=$schoolname?></td>
         <td align="center">
		 		 	<?
				if(count_person_m($rs_org[id]) > 0){
					echo "<a href='?action=view_data&schoolid=$rs_org[id]&office=$schoolname&secname=$secname&sex=m'>".count_person_m($rs_org[id])."</a>";
				}else{
					echo "0";
				}
			?>		 </td>
         <td align="center">
		 	<?
				if(count_person_f($rs_org[id]) > 0){
					echo "<a href='?action=view_data&schoolid=$rs_org[id]&office=$schoolname&secname=$secname&sex=f'>".count_person_f($rs_org[id])."</a>";
				}else{
					echo "0";
				}
			?>			</td>
       </tr>
	   	   <?
		   $total_m += count_person_m($rs_org[id]);
		   $total_f += count_person_f($rs_org[id]);
	   	}// end while($rs_org = mysql_fetch_assoc($result_org)){
	   ?>
       <tr >
         <td colspan="2" align="right" bgcolor="#FFFFFF">รวม&nbsp; </td>
         <td align="center" bgcolor="#FFFFFF"><?=number_format($total_m);?></td>
         <td align="center" bgcolor="#FFFFFF"><?=number_format($total_f);?></td>
       </tr>

     </table></td>
   </tr>
 </table>
<? } //end if($action == ""){
	if($action == "view_data"){
?>
	  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#000000">
       <tr  bgcolor="#A3B2CC" >
         <td colspan="6" align="left" ><strong><a href="?action=&secname=<?=$secname?>"><?=$areaname?></a><? if($search != "search"){?> => <?=$office?><? } ?></strong></td>
        </tr>
       <tr  bgcolor="#A3B2CC" >
         <td width="6%" align="center" >ลำดับ</td>
         <td width="24%" align="center"  >ชื่อ-นามสกุล</td>
         <td width="22%" align="center"  >เลขบัตรประจำตัวประชาชน</td>
         <td width="17%" align="center"  >วันเดือนปีเกิด</td>
         <td width="24%" align="center"  >ตำแหน่ง</td>
         <td width="7%" align="center"  >&nbsp;</td>
        </tr>	
<?
//$sql = " 
//SELECT * , general.id AS userid     FROM `general` 
//Left Join $dbnamemaster.allschool ON general.schoolid = $dbnamemaster.allschool.id
//WHERE general.siteid  LIKE '%$secname%'  ORDER BY  general.schoolid DESC, general.position_now DESC";
if($search == "search"){
	if($name_th != ""){ $xconv .= "  AND name_th LIKE '%$name_th%'";}
	if($surname_th != ""){ $xconv .= " AND surname_th LIKE '%$surname_th%'";}
	if($idcard != ""){ $xconv .= " AND idcard LIKE '%$idcard%'";}
	$sql = "SELECT *, general.id AS userid FROM general  WHERE 1 $xconv";
}else{
	if($sex == "m"){ $con1 = "  and  sex like '%ชาย%'";}
	if($sex == "f"){ $con1 = " and  sex  like '%หญิง%'";}
	$sql = "SELECT *, general.id AS userid FROM general WHERE schoolid = '$schoolid' $con1";
}// end if($search == "search"){
$result = mysql_query( $sql); 

echo mysql_error() ; 
while($rs = mysql_fetch_assoc($result)){
if ($bgcolor1 == "DDDDDD"){  $bgcolor1 = "EFEFEF"  ; } else {$bgcolor1 = "DDDDDD" ;}
$rs_id = $rs[userid] ; 
	$path_img = "../../../../kp7file/$rs[siteid]/$rs_id".".pdf";
	//echo $path_img;
	if(file_exists($path_img)){
			$link_img = "<a href='$path_img' target='_blank'><img src=\"../../../images_sys/gnome-mime-application-pdf.png\" width=\"20\" height=\"20\" alt=\"เอกสาร ก.พ.7 ต้นฉบับ\" border=\"0\"></a>";	
		
	}else{
			$link_img = "";
	}
	$arr_xb = explode("-",$rs[birthday]);
?>	
         <tr bgcolor="<?=$bgcolor1?>">
         <td align="center"><? $nonm++ ; ?>   <?=$nonm?>  </td>
		 <td align="left"> &nbsp; 
<a href="?secname=<?=$secname?>&delid=<?=$rs_id?>"></a> 
		 
		<!-- <a href ="register1.php?id=<?=$rs[userid]?>&secid=<?=$secname?>&schoolid=<?=$schoolid?>&office=<?=$office?>&sex=<?=$sex?>" >	 --> 
		 <?=$rs[prename_th]?><?=$rs[name_th]?> <?=$rs[surname_th]?>	<!--</a>--> </td>
         <td align="left"><?=$rs[userid]?></td>
         <td align="center"><? echo intval($arr_xb[2])." ".$smonth[intval($arr_xb[1])]." ".$arr_xb[0];?></td>
         <td align="left">&nbsp; <?=$rs[position_now]?></td>
         <td align="center"><? echo "<a href='login_data.php?name_th=$rs[name_th]&surname_th=$rs[surname_th]&idcard=$rs[idcard]&action=login&siteid=$rs[siteid]' target='_blank'><img src='../../../images_sys/person.gif' width='16' height='13' border='0'></a>";?></td>
        </tr>
<?   }   ?>  	   
     </table>
	 
	<?  } //end if($action == "view_data"){?>
</td>
  </tr>
</table>
<? } ?>
</body>
</html>