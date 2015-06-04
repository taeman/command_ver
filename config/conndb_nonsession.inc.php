<?php
/**
* @comment ไฟล์ถูกสร้างขึ้นมาสำหรับconnect ฐานข้อมูล
* @projectCode 56CMSS09
* @tor 
* @package core
* @author Pairoj Panturat
* @access private
* @created 24/05/2014
*/

#@modify 28/06/2014 ประกาศปิดระบบเพื่อปรับปรุงข้อมูล ทะเบียนประวัติอิเล็กทรอนิกส์
$dd = date('d');
$mm = date('m');
$yy = date('Y');
$hh = date('H');
$checkip = substr($_SERVER[REMOTE_ADDR],0,11);#180.183.157
#echo "yy = $yy :: mm= $mm :: dd = $dd :: hh = $hh";die();
if((($yy == "2015" and $mm == "05" and $dd >= '15' and $hh >= '16') and ($yy == "2015" and $mm == "05" and $dd < '18' )) and $checkip <> "180.183.157" ){ #and $hh <= "09"
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-874\">";
	echo "<table width=\"640\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\" style=\"background:#FC0; font-style:italic; border-bottom-color:#F00; color:#F00; font-size:24px\">
	
  <tr>
    <td align=\"center\">!ประกาศปิดระบบฐานข้อมูลทะเบียนประวัติเพื่อปรับปรุงและสำรองข้อมูลของระบบฯ<br />
 ในวันที่ 15 พฤษภาคม 2558 เวลา 16:00 น.  <br />
โดยจะเปิดให้บริการอีกทีในวันที่ 18 พฤษภาคม  2558  เวลา 09:00 น.<br />
ขออภัยในความไม่สะดวก  </td>
  </tr>
</table>";	
die;
}
#end
### ปิดระบบชั่วคราว

function CloseLogin($user){
	$arrdata =array('piyaporn-sro','sangthong-pak','uraiwan-tho','ohec-001','univ-001','univ-002','univ-003','univ-004','univ-005','univ-006','univ-007','univ-008','univ-009','univ-010','univ-011','univ-012','univ-013','univ-014','univ-015','univ-016','univ-017','univ-018','univ-019','univ-020','univ-021','univ-022','univ-023','univ-024','univ-025','univ-026','univ-027','univ-028','univ-029','univ-030','univ-031','univ-032','univ-033','univ-034','univ-035','univ-036','univ-037','univ-038','univ-039','univ-040','univ-041','univ-042','univ-043','univ-044','univ-045','univ-046','univ-047','univ-048','univ-049','univ-050','univ-051','univ-052','univ-053','univ-054','univ-055','univ-056','univ-057','univ-058','univ-059','univ-060','univ-061','univ-062','univ-063','univ-064','univ-065','univ-066','univ-067','univ-068','univ-069','univ-070','univ-071','univ-072','univ-073','univ-074','univ-075','univ-076','univ-077','univ-078','univ-079','univ-080','univ-081','univ-082','univ-083','univ-084','univ-085','univ-086','univ-087','univ-088','univ-089','univ-090','univ-091','univ-092','univ-093','univ-094','univ-095','univ-096','univ-097','univ-098','univ-099','univ-100','univ-101','univ-102','univ-103','univ-104','univ-105','univ-106','univ-107','univ-108','univ-109','univ-110','univ-111','univ-112','univ-113','univ-114','univ-115','univ-116','univ-117','univ-118','univ-119','univ-120','univ-121','univ-122','univ-123','univ-124','univ-125','univ-126','univ-127','univ-128','univ-129','univ-130','univ-131','univ-132','univ-133','univ-134','univ-135','univ-136','univ-137','univ-138','univ-139','univ-140','univ-141','univ-142','univ-143','univ-144','univ-145','univ-146','univ-147','univ-148','univ-149','univ-150','univ-151','univ-152','univ-153','univ-154','univ-155','univ-156','univ-157','univ-158','univ-159','univ-160','univ-161','univ-162','univ-163','univ-164','univ-165','univ-166','univ-167','univ-168','univ-169','univ-171','univ-172','univ-173','univ-174','univ-175','univ-176','univ-177','univ-178','univ-179','univ-180','univ-181','univ-182','univ-183','univ-184','univ-185','univ-186','univ-187','univ-188','univ-189','univ-190','univ-191','univ-192','univ-193','univ-194','univ-195','univ-227','univ-197','univ-198','univ-199','univ-200','univ-201','univ-202','univ-203','univ-204','univ-205','univ-290','univ-207','univ-208','univ-209','univ-210','univ-212','univ-213','univ-214','univ-215','univ-216','univ-217','univ-218','univ-219','univ-220','univ-221','univ-222','univ-223','univ-224','univ-225','univ-226','univ-229','univ-230','univ-231','univ-232','univ-233','univ-234','univ-235','univ-236','univ-237','univ-238','univ-239','univ-240','univ-241','univ-242','univ-243','univ-244','univ-245','univ-246','univ-247','univ-248','univ-249','univ-250','univ-251','univ-252','univ-253','univ-254','univ-255','univ-256','univ-257','univ-258','univ-259','univ-260','univ-261','univ-262','univ-263','univ-264','univ-265','univ-266','univ-267','univ-268','univ-269','univ-270','univ-271','univ-272','univ-273','univ-274','univ-275','univ-276','univ-277','univ-278','univ-279','univ-280','univ-281','univ-282','univ-283','univ-284','univ-285','univ-286','univ-287','univ-288','univ-289','univ-291','univ-292','univ-293','univ-294','univ-295','univ-296','cmss999','cmss201');
	
	if (in_array("$user", $arrdata)) {
		return true;
	}else{
		/*echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-874\">";
	echo "<table width=\"640\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\" style=\"background:#FC0; font-style:italic; border-bottom-color:#F00; color:#F00; font-size:24px\">
	
  <tr>
    <td align=\"center\">!ปิดการเข้าใช้งานระบบชั่วคราว<br />
 ในวันที่ 19 พฤษภาคม 2558 เวลา 15:00 น.  <br />
โดยจะเปิดให้บริการอีกทีในวันที่ 20 พฤษภาคม  2558  เวลา 09:00 น.<br />
ขออภัยในความไม่สะดวก  </td>
  </tr>
</table>";	
die;*/
	}

	
	
}


## end ปิดระบบชีวคราว


//include("function_pingip.php");
$mode_connect = "intra";
#$mode_connect = "";
## กรณีต้องการ connect ip ใน
if($mode_connect == "intra"){
	include("cmss_var_intra.php");
}else{
	include("cmss_var.php");	
}

#@modify Suwat.k ให้เรียก connect db เป็น ip ใน
#include("cmss_var_intra.php");
#@end
#include("cmss_var.php");#หน้าที่ของมันคืออะไร ทำไมไม่เขียนไว้
include("cmss_var_config_linepagekp7.php"); #หน้าที่ของมันคืออะไร ทำไมไม่เขียนไว้
include("cmss_define.php");#หน้าที่ของมันคืออะไร ทำไมไม่เขียนไว้
include("define_config_db.php");#หน้าที่ของมันคืออะไร ทำไมไม่เขียนไว้
include("config_define_tables.php");#หน้าที่ของมันคืออะไร ทำไมไม่เขียนไว้

//require_once("../common/Script_CheckIdCard.php");
$SERVER_ID=1; //man server www.pdc-obec.com
if ($ob_bypass ==""){  ob_start(); } 
if ($secid_bypass != ""){ $_SESSION[secid]= $secid_bypass ; }
$db_name ="cmss_master"  ;
$dbnamemaster="cmss_master";
$dbname = "cmss_master";
$dbsystem = "competency_system";
 $dbcallcenter = "callcenter_entry";    
//system data base
$sysdbname =""  ;
$aplicationpath="competency_master";
//gov data
$gov_name = ""    ;
$ministry_name = "";
$gov_name_en = ""    ;
$connect_status =   ""   ;
$mainwebsite = "http://www.cmss-otcsc.com"  ;
$admin_email    = "";  
$local_ip = substr($_SERVER['REMOTE_ADDR'],0,7);
if($local_ip == "192.168"){
	$servergraph = "192.168.2.13";
}else{
	$servergraph = "202.129.35.106";
}
$masterserverip = "";
$policyFile="";
$array_full_siteid = array('5001','5002','5003','5004','5005','5006','4001','6002','6601','4005','6302','4101','7102','3405');
$array_notfull_siteid = array('3303','6502','6702','6301','8602','5101','7002','7103','7302','4802','5701','7203');
//echo "host = ".HOST ." user = ". USERNAME_HOST." pass = ". PASSWORD_HOST;
$myconnect = mysql_connect('localhost', 'root', 'root') OR DIE("Unable to connect to database");
//@mysql_select_db($dbname) or die( "<center>ไม่สามารถติดต่อฐานข้อมูลที่ท่านเรียกได้ <br> อาจเกิดจากท่านใส่รหัสพื้นที่(Siteid, $dbname )ผิด <br> กรุณาตรวจสอบอีกครั้ง</center>");
@mysql_select_db($dbname) or die(mysql_error());
$iresult = mysql_query("SET character_set_results=tis-620");
$iresult = mysql_query("SET NAMES TIS620");
$xarrmonth = array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
$dbname = $db_name;

?>