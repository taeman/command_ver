<?php

include("config_hr.inc.php");


$monthname = array( "","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน", "กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
$month 			= array( "","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.", "ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");

/* open connection Mysql Server */


/* ฟังก์ชั่น Close connection */
function CloseDB()
{
    global $conn;
    mysql_close($conn);
}

function DateInput($d,$pre){
	global $monthname;
	if (!$d){
		$d = (intval(date("Y")) + 543) . "-" . date("m-d"); // default date is today
	}

	$d1=explode("-",$d);
?>
วันที่
<select name="<?=$pre?>_day" >
<?
for ($i=1;$i<=31;$i++){
	if (intval($d1[2])== $i){
		echo "<option SELECTED>" .  sprintf("%02d",$i) . "</option>";
	}else{
		echo "<option>" .  sprintf("%02d",$i) . "</option>";
	}
}
?>
</select>

เดือน 
<select name="<?=$pre?>_month" >
<?
for ($i=1;$i<=12;$i++){
	$xi = sprintf("%02d",$i);
	if (intval($d1[1])== $i){
//		echo "<option value='$xi' SELECTED>$xi</option>";
		echo "<option value='$xi' SELECTED>$monthname[$i]</option>";
	}else{
//		echo "<option value='$xi'>$xi</option>";
		echo "<option value='$xi'>$monthname[$i]</option>";
	}
}
?>
</select>

ปี พ.ศ. 
<select name="<?=$pre?>_year" >
<?
$thisyear = date("Y") + 543;
$y1 = $thisyear - 80;
$y2 = $thisyear ;
					
for ($i=$y1;$i<=$y2;$i++){
	if ($d1[0]== $i){
		echo "<option SELECTED>$i</option>";
	}else{
		echo "<option>$i</option>";
	}
}
?>
</select>
<?
}




function MakeDate($d){
global $monthname;
	if (!$d) return "";
	
	$d1=explode("-",$d);
	return intval($d1[2]) . " " . $monthname[intval($d1[1])] . " " . $d1[0];
}

function MakeDate2($d){
	
	global $month;	
	if (!$d) return "";	
	$d1=explode("-",$d);
	return intval($d1[2]) . " " . $month[intval($d1[1])] . " " . $d1[0];
	
}

function checkFloat($temp){

	if(strpos($temp, ".") >= 1){
		$s			= explode(".", $temp);
		$data	= ($s[1] >= 1) ? $s[0].".".$s[1] : $s[0] ;
	} else {
		$data 	= $temp;
	}
	return $data;
	
}

function retireDate($date){

	$d			= explode("-",$date);
	$year	= $d[0];
	$month	= $d[1];
	$date	= $d[2];
	
	
		
	if($month == 1 || $month == 2 || $month == 3){		
		$retire_year	= ($year < 2484) ? $year + 61 : $year + 60 ;		
	} else if($month == 10 || $month == 11 || $month == 12){		
		$retire_year 	= ($date <= 1 && $month == 10) ? $year + 60 :  $year + 61;		
	} else {
		$retire_year 	= $year + 60;
	}		

	return "30 กันยายน พ.ศ. ".$retire_year;
}

//function ที่ใช้แสดงวันที่แบบไทย
function showdaythai($temp){
if($temp != "0000-00-00"){
	$month = array("มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
	$num = explode("-", $temp);			
	if($num[0] == "0000"){
	  $date = "ไม่ระบุ";
	} else {
	  $tyear = $num[0] +  543;
	  $date = remove_zero($num[2])."&nbsp;".$month[$num[1] - 1 ]."&nbsp; พ.ศ. ".$tyear;	
	}
} else { 	$date = "ไม่ระบุ"; }	
return $date;
}


function Query1($sql){
	$result = mysql_query($sql);
	$rs = mysql_fetch_array($result);
	return $rs[0];
}

?>