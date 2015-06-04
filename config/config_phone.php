<?php
/**
* @comment ฟังก์ชั่นสำหรับดึงข้อมูลเบอร์โทรศัพท์และอีเมล์
* @projectCode 56CMSS09
* @tor 
* @package core
* @author Sathianphong Sukin
* @access private
* @created 2/07/2014
*/
//$Phone[0]="088-137-0334 ถึง <br/>093-139-5564";
$Email[0]="cmss-1";
$Email[1]=" ถึง ";
$Email[2]="cmss-10";
/*$Phone[0] = "088-137-0334";
$Phone[1] = "088-137-0335";
$Phone[2] = "088-137-0336";
$Phone[3] = "093-139-9713";
$Phone[4] = "093-139-9317";
$Phone[5] = "093-139-5546";
$Phone[6] = "093-139-5582";
$Phone[7] = "093-139-5573";
$Phone[8] = "093-139-5591";
$Phone[9] = "093-139-5564";*/
$db_master = "cmss_master";
$Phone = gettelephone('10','ASC','1');

function gettelephone($tel_number="10",$orderby="ASC",$status="1"){//จำนวนแถว, เรียง ASC/DESC, สถาณะ 0/1
	global $db_master;
	$like = " WHERE tel_active = '".$status."'";
	$sql="SELECT telno FROM callcenter_phone".$like." ORDER BY orderby ".$orderby." LIMIT ".$tel_number;
	$result=mysql_db_query($db_master,$sql);
	while($row = mysql_fetch_assoc($result)){
		$tel_phone[] = $row['telno'];
	}
		return $tel_phone;
}
?>
