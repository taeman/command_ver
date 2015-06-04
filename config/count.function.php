<?


function echo_percen($val1){
	if (is_int($val1)){
		$returnval = number_format($val1) ; 
	}else if ($val1 == 0 ) {		
		$returnval = 0 ; 		
	}else{
		$returnval = number_format($val1 ,2) ; 
	}
	return $returnval ; 
}

function query_array($xdbname , $sql){
	$result  = mysql_db_query($xdbname , $sql);
	if (mysql_errno() != 0){ echo "<br>LINE ".__LINE__. " <hr><pre> $sql </pre><hr> ".mysql_error() ."<br>"  ;   } 
	while ($rs = mysql_fetch_array($result)){
#		echo " <hr> ";
#		print_r($rs) ; echo " <hr> ";
		$arrtmp[0] =   $rs[0] ; 
	} 
	return $arrtmp ;
} ######### END function query_array($sql){ 

function count_type_position($xtype){ // บุคลากรจำแนกตามสายงาน
global $xsiteid;
	$db_site = "cmss_".$xsiteid;
	$xconW = " ".find_groupstaff($xtype);
	$sql_type = "SELECT COUNT(*)  AS num1 FROM view_general WHERE  $xconW ";
	$result_type = mysql_db_query($db_site,$sql_type);
	$rs_t = mysql_fetch_assoc($result_type);
	return $rs_t[num1];
}



## function นับจำนวนบุคลากรแยกรายหน่วยงานแยกตามสายงาน
function count_person_area_appv($status_appv,$xtype,$schoolid){

global $xsiteid;
	$db_site = "cmss_".$xsiteid;
	
		//echo $xconW;
		if($xtype != ""){
			$xconW = " AND ".find_groupstaff($xtype);
		}else{
			$xconW = " ";
		}
		
		
		### สถานะ รับรองข้อมูล
		if($status_appv == "approve"){
				$xconv = " AND approve_status LIKE '%approve%'";
		}else{
				$xconv = " AND (approve_status = '' or approve_status IS NULL)";
		}
	#### 
		
		$sql_area = "SELECT COUNT(*)  AS num1 FROM view_general WHERE  schoolid = '$schoolid' $xconv $xconW ";
		//echo $sql_area;
		$result_area = @mysql_db_query($db_site,$sql_area);
		$rs_area = @mysql_fetch_assoc($result_area);
		return $rs_area[num1];
	//	$result_area = mysql_db_query($);
}
## function count_person_area_appv($xtype,$schoolid){

function count_school($xsiteid){ // นับจำนวนโรงเรียน
global $dbnamemaster;
//	$sql_count = "SELECT
//count(distinct schoolid) as NUM1
//FROM
//cmss_$xsiteid.general as t1
//Right Join cmss_master.allschool ON cmss_master.allschool.id = t1.schoolid
//WHERE cmss_master.allschool.siteid='$xsiteid'";
//echo $sql_count;
	$sql_count = "SELECT COUNT(*) AS NUM1 FROM allschool  WHERE siteid='$xsiteid'";
	$result_count = mysql_db_query($dbnamemaster,$sql_count);
	$rs_c = mysql_fetch_assoc($result_count);
	return $rs_c[NUM1]-1;
}

### exsum
function CountExsum($get_siteid){
	$db_site = "cmss_$get_siteid";
//	$sqlh1 = find_positiongroup(1);// สายงานบริหารการศึกษา
//	$sqlh2 = find_positiongroup(2);// สายงานนิเทศการศึกษา
//	$sqlh3 = find_positiongroup(3);// สายงานบริหารสถานศึกษา
//	$sqlh4 = find_positiongroup(4);// สายงานการสอน
//	$sqlh5 = find_positiongroup(5);// บุคลากรทางการศึกษา 38 ค.(2)
	
		$sqlh1 = find_groupstaff(1); // ผอ. เขต
		$sqlh2 = find_groupstaff(2); // รอง ผอ.เขต
		$sqlh3 = find_groupstaff(3); // ศึกษานิเทศ
		$sqlh4 = find_groupstaff(4); // ผอ.โรงเรียน 
		$sqlh5 = find_groupstaff(5); // รอง ผอ.โรงเรียน 
		$sqlh6 = find_groupstaff(6)." or ".find_groupstaff(8); // ครู+ครูผู้ช่วย
		$sqlh7 = find_groupstaff(7); // 38 ค
	
	$sql = "SELECT 
		sum(if($sqlh1,1,0)) as LineH1,
		sum(if($sqlh2,1,0)) as LineH2,
		sum(if($sqlh3,1,0)) as LineH3,
		sum(if($sqlh4,1,0)) as LineH4,
		sum(if($sqlh5,1,0)) as LineH5,
		sum(if($sqlh6,1,0)) as LineH6,
		sum(if($sqlh7,1,0)) as LineH7
		FROM general ";
	$result = mysql_db_query($db_site,$sql);
	$rs = mysql_fetch_assoc($result);
	$arr['LineH1'] = $rs['LineH1'];
	$arr['LineH2'] = $rs['LineH2'];
	$arr['LineH3'] = $rs['LineH3'];
	$arr['LineH4'] = $rs['LineH4'];
	$arr['LineH5'] = $rs['LineH5'];
	$arr['LineH6'] = $rs['LineH6'];
	$arr['LineH7'] = $rs['LineH7'];
		
	return $arr;	
}//end function CountExsum(){


############  นับจำนวนบุคลากรจำแนกรายตำแหน่ง
function CountNumPersonSchool($get_site){
		$db_site = "cmss_$get_site";
		$sqlh1 = find_groupstaff(1); // ผอ. เขต
		$sqlh2 = find_groupstaff(2); // รอง ผอ.เขต
		$sqlh3 = find_groupstaff(3); // ศึกษานิเทศ
		$sqlh4 = find_groupstaff(4); // ผอ.โรงเรียน 
		$sqlh5 = find_groupstaff(5); // รอง ผอ.โรงเรียน 
		$sqlh6 = find_groupstaff(6)." or ".find_groupstaff(8); // ครู+ครูผู้ช่วย
		$sqlh7 = find_groupstaff(7); // 38 ค
		
		$sql = "SELECT 
		sum(if($sqlh1,1,0)) as LineH1,
		sum(if($sqlh2,1,0)) as LineH2,
		sum(if($sqlh3,1,0)) as LineH3,
		sum(if($sqlh4,1,0)) as LineH4,
		sum(if($sqlh5,1,0)) as LineH5,
		sum(if($sqlh6,1,0)) as LineH6,
		sum(if($sqlh7,1,0)) as LineH7,
		schoolid
		FROM general GROUP BY schoolid";
		$result = mysql_db_query($db_site,$sql);
		while($rs = mysql_fetch_assoc($result)){
				$arr1[$rs[schoolid]]['LineH1'] = $rs['LineH1'];
				$arr1[$rs[schoolid]]['LineH2'] = $rs['LineH2'];
				$arr1[$rs[schoolid]]['LineH3'] = $rs['LineH3'];
				$arr1[$rs[schoolid]]['LineH4'] = $rs['LineH4'];
				$arr1[$rs[schoolid]]['LineH5'] = $rs['LineH5'];
				$arr1[$rs[schoolid]]['LineH6'] = $rs['LineH6'];
				$arr1[$rs[schoolid]]['LineH7'] = $rs['LineH7'];		
		}// end while($rs = mysql_fetch_assoc($result)){
	return $arr1;
}


function ChecklistSchoolSite($siteid){
	global $dbnamemaster;
	$sql = "SELECT id FROM allschool WHERE siteid='$siteid'";	
	$result = mysql_db_query($dbnamemaster,$sql);
	while($rs = mysql_fetch_assoc($result)){
			$arr[$rs[id]] = $rs[id];
	}
	return $arr;
}



function CountCheckList($xsiteid){
	global $profile_id;
	$dbname_temp = "temp_check_data";
	$ins = "";
	
	$arrch = ChecklistSchoolSite($xsiteid); // function ตรวจสอบหน่วยงานโรงเรียนในเขต
	if(count($arrch) > 0){
			foreach($arrch as $k => $v){
					if($ins > "") $ins .= ",";
					$ins .= "'$v'";
			}
	}
	if($ins != ""){
		
		$xconif .= " or schoolid NOT IN($ins)";	
	}else{
		$xconif = "";	
	}
		
		

		$sql = "SELECT
	if(schoolid='' or schoolid IS NULL or schoolid='0' $xconif,'',schoolid) as schid,

		Count(idcard) AS NumAll,
		
		Sum(if(status_numfile='1' and status_file='1' and status_check_file='YES' and (mainpage IS NULL  or mainpage='' or mainpage='1' or mainpage <> '0') and status_id_false='0'  and page_upload>0  ,1,0 )) as NumUpload,
		
		Sum(if(status_numfile='1' and status_check_file='YES' and mainpage ='0' and status_file='1' and status_id_false='0' and page_upload > 0 ,1,0)) as NumUpNomain, 
		
		Sum(if(status_numfile='1' and status_file='1' and status_check_file='YES' and (mainpage IS NULL  or mainpage='' or mainpage='1' or mainpage <> '0') and status_id_false='0' ,1,0 )) as NumPass, 
		
		Sum(if(status_numfile='1' and status_file='0' and status_check_file='YES' and status_id_false='0' ,1,0 )) as NumNoPass, 
		sum(if(status_numfile='1' and status_check_file='YES' and mainpage ='0' and status_file='1' and status_id_false='0',1,0 )) as NumNoMain, 
		sum(if(status_numfile='1' and status_file='0' and status_check_file='NO' and status_id_false='0' ,1,0)) as NumDisC, 
		
		sum(if(status_numfile='1' and status_id_false='1' ,1,0)) as numidfalse,
		sum(if(status_numfile='0' and status_id_false='0' ,1,0)) as numnorecive,
		sum(if(status_numfile='0' and status_id_false='1' ,1,0)) as numnorecive_idfalse
FROM
temp_check_data.tbl_checklist_kp7
WHERE  profile_id='$profile_id' AND temp_check_data.tbl_checklist_kp7.siteid='$xsiteid' GROUP BY schid";

//echo 		"<pre>".$sql ."</pre><hR>";die;

	$result = mysql_db_query($dbname_temp,$sql);
	while($rs = mysql_fetch_assoc($result)){

		
		if($rs[schid] == "" or $rs[schid] == "0"){
			$idsch = "";	
		}else{
			$idsch = $rs[schid];
		}
		$arr[$idsch]['NumAll'] = $rs['NumAll'];
		$arr[$idsch]['NumUpload'] = $rs['NumUpload'];
		$arr[$idsch]['NumUpNomain'] = $rs['NumUpNomain'];
		$arr[$idsch]['NumPass'] = $rs['NumPass'];
		$arr[$idsch]['NumNoPass'] = $rs['NumNoPass'];
		$arr[$idsch]['NumNoMain'] = $rs['NumNoMain'];
		$arr[$idsch]['numidfalse'] = $rs['numidfalse'];
		$arr[$idsch]['numnorecive_idfalse'] = $rs['numnorecive_idfalse'];
		$arr[$idsch]['numnorecive'] = $rs['numnorecive'];
		$arr[$idsch]['numidfalse'] = $rs['numidfalse'];
		
		
		
	}
	//echo "<pre>";
	//print_r($arr);die;
	return $arr;
	
}//end  function CountCheckList(){


function NumPersonKey($xsiteid){
	global $profile_id;
		$dbname_temp = "temp_check_data";
	$sql = "SELECT
t1.schoolid,
count(t1.idcard) as numkey
FROM
temp_check_data.tbl_checklist_kp7 as t1
Inner Join callcenter_entry.tbl_assign_key as t2 ON t1.idcard = t2.idcard
AND  t1.profile_id = t2.profile_id AND t1.siteid=t2.siteid
WHERE
t1.profile_id =  '$profile_id' AND
t2.nonactive =  '0' AND
t2.approve =  '2' AND t1.siteid='$xsiteid' 
and ((t1.status_numfile='1' and t1.status_file='1' and t1.status_check_file='YES' and (t1.mainpage IS NULL  or t1.mainpage='' or t1.mainpage='1') and t1.status_id_false='0') or
(status_numfile='1' and status_check_file='YES' and mainpage ='0' and status_file='1' and status_id_false='0'))
GROUP BY t1.schoolid
";
	$result = mysql_db_query($dbname_temp,$sql);
	while($rs = mysql_fetch_assoc($result)){
		$arr1[$rs[schoolid]]['numkey'] = $rs['numkey'];
	}
	return $arr1;
}//


###########  นับจำนวนเลขบัตรไม่ตรองตามกรมการปกครอง
function NumIDFalse($siteid){
	global $profile_id;
		$dbname_temp = "temp_check_data";
		$sql = "SELECT
		count(tbl_checklist_kp7_false.idcard) as num1,
		tbl_checklist_kp7_false.schoolid
FROM
tbl_checklist_kp7_false
WHERE
tbl_checklist_kp7_false.siteid='$siteid' AND 
tbl_checklist_kp7_false.profile_id =  '$profile_id' AND
tbl_checklist_kp7_false.status_IDCARD LIKE  '%IDCARD_FAIL%' AND
tbl_checklist_kp7_false.status_chang_idcard LIKE  '%NO%' group by siteid";
$result = mysql_db_query($dbname_temp,$sql);
while($rs = mysql_fetch_assoc($result)){

			$arr[$rs[schoolid]] = $rs[num1];

}//end while($rs = mysql_fetch_assoc($result))
	return $arr;
}//end function NumIDFalse()

function date_print(){
	$month = array("","มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
	$cyy = date("Y");
	$cdd = intval(date("m"));
	if($cyy == "2011" and $cdd > 8){
			$date_curent = "31 สิงหาคม 2554";
	}else{
		$date_curent = intval(date("d"))." ".$month[intval(date("m"))]." ".(date("Y")+543);	
	}
	return $date_curent;
}


function CountCheckListSchool($xsiteid,$schoolid){
	global $profile_id,$type;
		$dbname_temp = "temp_check_data";
		if($type == ""  or $type == "all"){
				$conv = " AND schoolid='$schoolid'";
		}else{
				if($type == "diforg1"){
					$conv = " AND status_check_file='YES' and status_file='0'";
				}else if($type == "diforg"){
					$conv = " AND status_check_file='NO'";
				}else if($type == "org"){
					$conv = " AND page_upload > 0";
				}
					
		}
		
		$sql = "SELECT
temp_check_data.tbl_checklist_kp7.schoolid,
Count(idcard) AS NumAll,
Sum(if(page_upload > 0,1,0)) AS NumUpload,
sum(if(status_file=1,1,0)) as NumPass,
Sum(if(status_check_file='NO',1,0)) as NumDis,
Sum(if(status_check_file='YES' and status_file=0,1,0)) AS NumDocFalse

FROM
temp_check_data.tbl_checklist_kp7
WHERE  profile_id='$profile_id' AND temp_check_data.tbl_checklist_kp7.siteid='$xsiteid' $conv  group by schoolid";

	$result = mysql_db_query($dbname_temp,$sql);
	while($rs = mysql_fetch_assoc($result)){
		if($rs[schoolid] == "" or $rs[schoolid] == "0"){
				$ids = "";
		}else{
			$ids = $rs[schoolid];	
		}// end if($rs[schoolid] == "" or $rs[schoolid] == "0"){
		$arr[$ids]['NumAll'] = $rs['NumAll'];
		$arr[$ids]['NumUpload'] = $rs['NumUpload'];
		$arr[$ids]['NumPass'] = $rs['NumPass'];
		$arr[$ids]['NumDis'] = $rs['NumDis'];
		$arr[$ids]['NumDocFalse'] = $rs['NumDocFalse'];
			
	}
	return $arr;
}//end  function CountCheckList()


function NumPersonKeySchool($xsiteid,$schoolid){
	global $profile_id,$type;
		$dbname_temp = "temp_check_data";
		if($type == ""  or $type == "all"){
				$conv = " AND schoolid='$schoolid'";
		}else{
				if($type == "diforg1"){
					$conv = " AND status_check_file='YES' and status_file='0'";
				}else if($type == "diforg"){
					$conv = " AND status_check_file='NO'";
				}else if($type == "org"){
					$conv = " AND page_upload > 0";
				}
					
		}
	$sql = "SELECT
temp_check_data.tbl_checklist_kp7.schoolid,
count(temp_check_data.tbl_checklist_kp7.idcard) as numkey
FROM
temp_check_data.tbl_checklist_kp7
Inner Join callcenter_entry.tbl_assign_key ON temp_check_data.tbl_checklist_kp7.idcard = callcenter_entry.tbl_assign_key.idcard
WHERE
temp_check_data.tbl_checklist_kp7.profile_id =  '$profile_id' AND
callcenter_entry.tbl_assign_key.nonactive =  '0' AND
callcenter_entry.tbl_assign_key.approve =  '2' AND temp_check_data.tbl_checklist_kp7.siteid='$xsiteid' $conv group by schoolid
";
	$result = mysql_db_query($dbname_temp,$sql);
	while($rs = mysql_fetch_assoc($result)){
		$arr1[$rs[schoolid]]['numkey'] = $rs['numkey'];
	}
	return $arr1;
}//


function NumIDFalseSchool($xsiteid,$schoolid){
	global $profile_id,$type;
		$dbname_temp = "temp_check_data";
		if($type == ""  or $type == "all"){
				$conv = " AND schoolid='$schoolid'";
		}else{
				$conv = "";					
		}
		$sql = "SELECT
		count(tbl_checklist_kp7_false.idcard) as num1,
		tbl_checklist_kp7_false.schoolid
FROM
tbl_checklist_kp7_false
WHERE
tbl_checklist_kp7_false.profile_id =  '$profile_id' AND
tbl_checklist_kp7_false.status_IDCARD LIKE  '%IDCARD_FAIL%' AND
tbl_checklist_kp7_false.status_chang_idcard LIKE  '%NO%' and siteid='$xsiteid' $conv group by schoolid";
$result = mysql_db_query($dbname_temp,$sql);
while($rs = mysql_fetch_assoc($result)){

			$arr[$rs[schoolid]] = $rs[num1];

}//end while($rs = mysql_fetch_assoc($result)){
	
	return $arr;
}//end function NumIDFalse(){
	
	

?>
