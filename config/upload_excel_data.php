<?php
session_start();
include "config.inc.php";
require_once "xsl_reader/reader.php";
$arrErrMsg = array('no_order'=>'เลขที่คำสั่งเป็นค่าว่าง','date_create'=>'ลงวันที่ เป็นค่าว่าง หรือ รูปแบบวันที่ไม่ถูกต้อง','date_order'=>'สั่ง ณ วันที่ เป็นค่าว่าง หรือ รูปแบบวันที่ไม่ถูกต้อง',
                   'schoolid'=>'ไม่สามารถหา รหัสโรงเรียนจากชื่อนี้ได้','name'=>'ชื่อเป็นค่าว่าง','surname'=>'นามสกุลเป็นค่าว่าง',
                   'idcard'=>'หมายเลขบัตรประชาชนเป็นค่าว่าง','position'=>'ไม่สามารถหารหัสตำแหน่งจากชื่อตำแหน่งได้','vitaya'=>'ไม่สามารถหารหัสวิทยฐานะได้','no_position'=>'เลขที่ตำแหน่งเป็นค่าว่าง',
				   'level_before'=>'ไม่สามารถหารหัส อันดับได้','salary_before'=>'เงินเดือนก่อนเลื่อนไม่ถูกต้อง','salary_after'=>'เงินเดือนหลังเลื่อนไม่ถูกต้อง',
				   'command_file'=>'ไม่พบไฟล์คำสั่ง','attach_file'=>'ไม่พบไฟล์บัญชีแนบ');
				   
				  $arr_gender = array("ชาย"=>"1","หญิง"=>"2");
				  
				  ## เงิ่อนไขการตรวจสอบข้อมูลที่เป็นค่า none
				 $conField  = " WHERE Field NOT IN('education','degree','schoolname','birthday','begindate','sex','gender_id')";
				   
				   
function ConvDate($d){
	if($d == "") return "";
	if($d == "00/00/000") return "";
	if($d == "0000-00-00") return "";
	$arr = explode("/",$d);
	return  $arr[2]."-".$arr[1]."-".$arr[0];
}

function GetPositionId($position){
	global $dbnamemaster;
	$sql = "SELECT
pid
FROM `hr_addposition_now` where `position`='$position' ";	
	$result = mysql_db_query(_DBCMSS,$sql);
	$rs = mysql_fetch_assoc($result);
	return $rs[pid];
}// end function GetPositionId($position){
	
function GetEduactionId($highgrade){
	global $dbnamemaster;
	$sql = "SELECT runid  FROM hr_addhighgrade WHERE highgrade='$highgrade'";	
	$result = mysql_db_query(_DBCMSS,$sql);
	$rs = mysql_fetch_assoc($result);
	return $rs[runid];
}
function GetDegreeId($degree_fullname){
	global $dbnamemaster;
	$sql = "SELECT degree_id  FROM hr_adddegree WHERE degree_fullname='$degree_fullname' ";	
	$result = mysql_db_query(_DBCMSS,$sql);
	$rs = mysql_fetch_assoc($result);
	return $rs[degree_id];
}

function GetSchoolid($schoolname,$siteid){
	global $dbnamemaster;
	$sql = "SELECT id FROM allschool WHERE office='$schoolname' AND siteid='$siteid'";	
	$result = mysql_db_query(_DBCMSS,$sql) or die(mysql_error()."".__LINE__);
	$rs = mysql_fetch_assoc($result);
	return $rs[id];
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Upload excel data</title>
</head>
<script>
function ValidateDoc()
{   
    var cr        = unescape("\n");
    var ErrorMsg  = "เกิดข้อผิดพลาดดังนี้ :  "+cr+cr;
    var InitLen   = ErrorMsg.length;
    var TheForm   = document.frm;
	
	if (TheForm.profile_name.value.length < 1)
       ErrorMsg =  ErrorMsg + "ชื่อโปรไฟล์ข้อมูล  " + cr;
	if (TheForm.checklist.value.length < 1)
       ErrorMsg =  ErrorMsg + "ไฟล์ข้อมูล  " + cr;
	if (TheForm.siteid.value.length < 1)
       ErrorMsg =  ErrorMsg + "เขตพื้นที่การศึกษา  " + cr;   
	
	if ( ErrorMsg.length > InitLen ){
        alert( ErrorMsg );
        return (false);
    }
    return(true);
}
</script>
<body style="font-size:12px;">
<?php
if($_POST['bt_submit'] != ""){
	
	# insert profile
	$sqlProfile = "INSERT INTO excel_profile(excel_id,siteid,profile_name,staffid,upload_time)
	               VALUES(NULL,'".$_POST['siteid']."','".$_POST['profile_name']."','".$_SESSION['session_staffid']."',NOW())";
	mysql_db_query(_DBNAME,$sqlProfile)or die(mysql_error());
	$excelId = mysql_insert_id();
	
	# upload file
	$filename = time().".xls";
    $dir = "excel_file/".$filename;
	move_uploaded_file($_FILES['checklist']['tmp_name'],$dir);
	$sqlFile = "INSERT INTO excel_file(file_id,excel_id,file_name)
	            VALUES(NULL,'$excelId','$filename')";
	mysql_db_query(_DBNAME,$sqlFile)or die(mysql_error());
	
	# insert data to temp
	$data = new Spreadsheet_Excel_Reader();
    $data->setOutputEncoding('TIS-620');
    $data->read($dir);
    $setstrartrow = 4;
	#echo "debug => <br><pre>";
	#print_r($data);die;
	for($i = $setstrartrow ; $i <= $data->sheets[0]['numRows']; $i++) {
         
		 $excel_id = $excelId;
         $no_order = trim($data->sheets[0]['cells'][$i][2]);
         $date_create = trim($data->sheets[0]['cells'][$i][3]);
         $date_order = trim($data->sheets[0]['cells'][$i][4]);
         $siteid = trim($data->sheets[0]['cells'][$i][5]);
         $schoolid = trim($data->sheets[0]['cells'][$i][6]);
         $prename = trim($data->sheets[0]['cells'][$i][7]);
         $name = trim($data->sheets[0]['cells'][$i][8]);
         $surname = trim($data->sheets[0]['cells'][$i][9]);
         $idcard = trim($data->sheets[0]['cells'][$i][10]);
         $position = trim($data->sheets[0]['cells'][$i][11]);
         $vitaya = trim($data->sheets[0]['cells'][$i][12]);
         $no_position = trim($data->sheets[0]['cells'][$i][13]);
         $level_before = trim($data->sheets[0]['cells'][$i][14]);
         $salary_before = trim($data->sheets[0]['cells'][$i][15]);
         $salary_after = trim($data->sheets[0]['cells'][$i][16]);
         $payment_2 = trim($data->sheets[0]['cells'][$i][17]);
         $payment_4 = trim($data->sheets[0]['cells'][$i][18]);
         $payment_6 = trim($data->sheets[0]['cells'][$i][19]);
		 
		 ### ข้อมูลส่วนเพิ่ม
		 $education = trim($data->sheets[0]['cells'][$i][20]); // การศึกษาสูงสุด
		 $degree = trim($data->sheets[0]['cells'][$i][21]); // วุฒิการศึกษา
		 $schoolname = trim($data->sheets[0]['cells'][$i][22]); // โรงเรียน
		 $birthday = trim($data->sheets[0]['cells'][$i][23]); // วันเดือนปีเกิด
		 $begindate = trim($data->sheets[0]['cells'][$i][24]); // วันเริ่มปฏิบัติราชการ
		 $sex = trim($data->sheets[0]['cells'][$i][25]); // เพศ
		  $percen_up =  	  trim($data->sheets[0]['cells'][$i][26]); // เปอร์เซ้นการเลื่อนขั้นของ 38 ค 	 	
		 
         $import_status = 0;
		 
		 $sqlTemp = "INSERT INTO excel_data_temp(temp_id,excel_id,no_order,date_create,date_order,siteid,schoolid,prename,name,surname,idcard,`position`,
		                                         vitaya,no_position,level_before,salary_before,salary_after,payment_2,payment_4,payment_6,import_status,time_update,education,degree,schoolname,birthday,begindate,sex,percen_up)
					 VALUES(NULL,'$excel_id','$no_order','$date_create','$date_order','$siteid','$schoolid','$prename','$name','$surname','$idcard',
					       '$position','$vitaya','$no_position','$level_before','$salary_before','$salary_after','$payment_2','$payment_4','$payment_6',
						   '$import_status',NOW(),'$education','$degree','$schoolname','$birthday','$begindate','$sex','$percen_up')";
		 mysql_db_query(_DBNAME,$sqlTemp)or die(mysql_error());				   
		 
	}// end for			 			   
	
	# find id and filter data
	$sqlFind = "SELECT * FROM excel_data_temp WHERE excel_id = '$excelId' ";
	$queryFind = mysql_db_query(_DBNAME,$sqlFind)or die(mysql_error());
	while($rowsFind = mysql_fetch_array($queryFind)){
		
		#clear value
		 $temp_id = '';
		 $excel_id = ''; 
		 $no_order = '';
         $date_create = '';
         $date_order ='';
         $siteid = '';
         $schoolid = '';
         $prename = '';
         $name = '';
         $surname = '';
         $idcard = '';
         $position = '';
         $vitaya = '';
         $no_position = '';
         $level_before = '';
         $salary_before = '';
         $salary_after = '';
         $payment_2 = '';
         $payment_4 = '';
         $payment_6 = '';
		 $command_file = '';
		 $attach_file = '';
		 $ref_file = '';
		 $kp7_file = '';
		 $education = "";
		 $degree = "";
		 $schoolname = "";
		 $birthday = "";
		 $begindate = "";
		 $sex = "";
		
		#temp id
		$temp_id = $rowsFind['temp_id'];
		
		
		
		#excel_id
		$excel_id = $excelId;
		
		
		### การศึกษาสูงสุด
		$education= GetEduactionId($rowsFind[education]); // รหัสการศึกษาสูงสุด
		if($education == ""){
			$education = "none";
		}
		$degree = GetDegreeId($rowsFind[degree]); // รหัสวุฒิการศึกษา
		if($degree == ""){
			$degree = "none";
		}
		$xschoolid = GetSchoolid($rowsFind['schoolname'],$siteid); // หารหัสโรงเรียน
		if($xschoolid == ""){
				$xschoolid = "none";
		}
		$birthday = ConvDate($rowsFind[birthday]);
		if($birthday == ""){
				$birthday = "none";
		}
		$begindate = ConvDate($rowsFind[begindate]);
		if($begindate == ""){
				$begindate = "none";
		}
		$sex = $rowsFind[sex];

		$gender_id = $arr_gender[$sex];
		if($gender_id == ""){
				$sex = "none";
		}
		
		#check no order
		$yearOrder = '';
		$arrNoOrder = '';
		if($rowsFind['no_order'] != ''){
		  $arrNoOrder = explode("/",$rowsFind['no_order']);
		  if(strlen($arrNoOrder[1]) == 2){
			  $yearOrder = '25'.$arrNoOrder[1];
		  }else{
		      $yearOrder = $arrNoOrder[1];
		  }	
		  $no_order = $arrNoOrder[0]."/".$yearOrder;	
		}else{
		  $no_order = 'none';
		}
		
		#check date create
		if(eregi('^[0-9]+/+[0-9]+/+[0-9]+$',$rowsFind['date_create'])){
		  $arrDateCreate = explode('/',$rowsFind['date_create']);
		  if(strlen($arrDateCreate[2]) == 2){
			  $year = '25'.$arrDateCreate[2];
		  }else{
			  $year = $arrDateCreate[2];
		  }
		  $date_create = ($year-543)."-".$arrDateCreate[1]."-".$arrDateCreate[0];
		}else{
		  $date_create = 'none';
		}
		
		#check date order
		if(eregi('^[0-9]+/+[0-9]+/+[0-9]+$',$rowsFind['date_order'])){
		  $arrDateOrder = explode('/',$rowsFind['date_order']);
		  if(strlen($arrDateOrder[2]) == 2){
			  $year = '25'.$arrDateOrder[2];
		  }else{
			  $year = $arrDateOrder[2];
		  }
		  $date_order = ($year-543)."-".$arrDateOrder[1]."-".$arrDateOrder[0];
		}else{
		  $date_order = 'none';
		}
		
		#site id
		$siteid = $_POST['siteid'];
		
		#check schoolid
		if($rowsFind['schoolid'] != ''){
		  $sqlSc = "SELECT id FROM allschool WHERE office = '".$rowsFind['schoolid']."' AND siteid = '$siteid' ";
		  $querySc = mysql_db_query('cmss_master',$sqlSc)or die(mysql_error());
		  $numSc = mysql_num_rows($querySc);
		  if($numSc == 1){
			  $rowsSc = mysql_fetch_array($querySc);
			  $schoolid = $rowsSc['id'];
		  }else{
		      $schoolid = 'none';
		  }
		}
		
		#prename
		$prename = $rowsFind['prename'];
		
		#name
		if($rowsFind['name'] != ''){
		  $name = $rowsFind['name'];
		}else{
		  $name = 'none';
		}
		
		#surname
		if($rowsFind['surname'] != ''){
		  $surname = $rowsFind['surname'];
		}else{
		  $surname = 'none';
		}
		
		#idcard
		if($rowsFind['idcard'] != ''){
		  $idcard = $rowsFind['idcard'];
		}else{
		  $idcard = 'none'; 
		}
		
		#position
		if($rowsFind['position'] != ''){
		  $sqlPosition = "SELECT pid FROM hr_addposition_now WHERE position = '".$rowsFind['position']."' ";
		  $queryPosition = mysql_db_query('cmss_master',$sqlPosition)or die(mysql_error());
		  $numPosition = mysql_num_rows($queryPosition);
		  if($numPosition == 1){
			  $rowsPosition = mysql_fetch_array($queryPosition);
			  $position = $rowsPosition['pid'];
		  }else{
		      $position = 'none';
		  }
		}else{
		  $position = 'none';
		}
		
		#vitaya
		if($rowsFind['vitaya'] != ''){
			$sqlVitaya = "SELECT runid FROM vitaya WHERE vitayaname = '".$rowsFind['vitaya']."' ";
			$queryVitaya = mysql_db_query('cmss_master',$sqlVitaya)or die(mysql_error());
			$numVitaya = mysql_num_rows($queryVitaya);
			if($numVitaya == 1){
			  $rowsVitaya = mysql_fetch_array($queryVitaya);	
			  $vitaya = $rowsVitaya['runid'];	
			}else{
			  $vitaya = 'none';
			}
		}
		
		#no_position
		if($rowsFind['no_position'] != ''){
		  $no_position = $rowsFind['no_position'];
		}else{
		  $no_position = 'none';
		}
		
		#level_before
		if($rowsFind['level_before'] != ''){
		  $sqlLevel = "SELECT level_id FROM hr_addradub WHERE radub = '".$rowsFind['level_before']."' ";
		  $queryLevel = mysql_db_query('cmss_master',$sqlLevel)or die(mysql_error());
		  $numLevel = mysql_num_rows($queryLevel);
		  if($numLevel == 1){
			 $rowsLevel = mysql_fetch_array($queryLevel);
			 $level_before = $rowsLevel['level_id']; 
		  }else{
		    $level_before = 'none';
		  }	
		}else{
		  $level_before = 'none';
		}
		
		#salary_before
		if($rowsFind['salary_before'] != ''){
		  $salary_before = str_replace(',','',$rowsFind['salary_before']);	
		}else{
		  $salary_before = 'none';	
		}
		
		#salary_after
		if($rowsFind['salary_after'] != ''){
		  $salary_after = str_replace(',','',$rowsFind['salary_after']);	
		}else{
		  $salary_after = 'none';	
		}
		
		#payment_2
		$payment_2 = str_replace(',','',$rowsFind['payment_2']);
		
		#payment_4
		$payment_4 = str_replace(',','',$rowsFind['payment_4']);
		
		#payment_6
		$payment_6 = str_replace(',','',$rowsFind['payment_6']);
		
		#command file
		if($rowsFind['schoolid'] != '' and $schoolid != 'none'){
			$commandName = $siteid."-".$schoolid."-".$yearOrder."-".$arrNoOrder[0]."-1.pdf";
		}else{
		    $commandName = $siteid."-".$siteid."-".$yearOrder."-".$arrNoOrder[0]."-1.pdf";
		}
		
		$dirCommand = 'source_pdf/'.$siteid."/".$commandName;
		$dirCommandTarget = "../../../command_file_command/".$siteid."/".$commandName;
		if(file_exists($dirCommand)){
			if(copy($dirCommand,$dirCommandTarget)){
			   $command_file = $commandName;
			}else{
			   $command_file = 'none';	
			}
		}else{
		    $command_file = 'none';
		}
		
		
		$command_file = ""; // เปิดสถานะการนำเข้าไฟล์
		#attach file
		if($rowsFind['schoolid'] != '' and $schoolid != 'none'){
			$attachName = $siteid."-".$schoolid."-".$yearOrder."-".$arrNoOrder[0]."-2.pdf";
		}else{
		    $attachName = $siteid."-".$siteid."-".$yearOrder."-".$arrNoOrder[0]."-2.pdf";
		}
		
		$dirAttach = 'source_pdf/'.$siteid."/".$attachName;
		$dirAttachTarget = "../../../command_file_attach/".$siteid."/".$attachName;
		if(file_exists($dirAttach)){
			if(copy($dirAttach,$dirAttachTarget)){
			  $attach_file = $attachName;
			}else{
			  $attach_file = 'none';
			}
		}else{
		    $attach_file = 'none';
		}
		
		
		$attach_file = ""; // เปิดสถานะการนำเข้าไฟล์
		#ref file
		if($rowsFind['schoolid'] != '' and $schoolid != 'none'){
			$refName = $siteid."-".$schoolid."-".$yearOrder."-".$arrNoOrder[0]."-3.pdf";
		}else{
		    $refName = $siteid."-".$siteid."-".$yearOrder."-".$arrNoOrder[0]."-3.pdf";
		}
		
		$dirRef = 'source_pdf/'.$siteid."/".$refName;
		$dirRefTarget = "../../../command_file_reference/".$siteid."/".$refName;
		if(file_exists($dirRef)){
			if(copy($dirRef,$dirRefTarget)){
			  $ref_file = $refName;
			}
		}
		
		#kp7 file
		if($rowsFind['schoolid'] != '' and $schoolid != 'none'){
			$kp7Name = $siteid."-".$schoolid."-".$yearOrder."-".$arrNoOrder[0]."-4.pdf";
		}else{
		    $kp7Name = $siteid."-".$siteid."-".$yearOrder."-".$arrNoOrder[0]."-4.pdf";
		}
		
		$dirKp7 = 'source_pdf/'.$siteid."/".$kp7Name;
		$dirKp7Target = "../../../command_file_kp7/".$siteid."/".$kp7Name;
		if(file_exists($dirKp7)){
			if(copy($dirKp7,$dirKp7Target)){
			  $kp7_file = $kp7Name;
			}
		}
		
		
		$sqlTemp = "INSERT INTO excel_data(temp_id,excel_id,no_order,date_create,date_order,siteid,schoolid,prename,name,surname,idcard,`position`,
		                                   vitaya,no_position,level_before,salary_before,salary_after,payment_2,payment_4,payment_6,import_status,
										   command_file,attach_file,ref_file,kp7_file,time_update,education,degree,schoolname,birthday,begindate,sex,gender_id,percen_up)
					 VALUES('$temp_id','$excel_id','$no_order','$date_create','$date_order','$siteid','$schoolid','$prename','$name','$surname','$idcard',
					       '$position','$vitaya','$no_position','$level_before','$salary_before','$salary_after','$payment_2','$payment_4','$payment_6',
						   '$import_status','$command_file','$attach_file','$ref_file','$kp7_file',NOW(),'$education','$degree','$xschoolid','$birthday','$begindate','$sex','$gender_id','$rowsFind[percen_up]')";
		mysql_db_query(_DBNAME,$sqlTemp)or die(mysql_error());
		
		
	}
	
	#start import to command data table
	$arrErrId = array();
	$arrErrField = array();
	$sqlData = "SELECT * FROM excel_data 
	            WHERE excel_id = '$excelId' ";
	$queryData = mysql_db_query(_DBNAME,$sqlData)or die(mysql_error());
	$numImport = 0;
	
	while($rowsData = mysql_fetch_array($queryData)){
		
		##check keyin protection
		$err = 0;
		$sqlField = "SHOW FIELDS FROM excel_data $conField";
		$queryField = mysql_db_query(_DBNAME,$sqlField)or die(mysql_error());
		while($rowsField = mysql_fetch_array($queryField)){
			if($rowsData[$rowsField['Field']] == 'none'){
				$err = 1;
				$arrErrField[$rowsData['temp_id']][] = $rowsField['Field'];
				//echo $rowsField['Field']." = ".$rowsData[$rowsField['Field']]."<br>";
			}
		}
		
		if($err == 0){
		   
		   #command value
		   $temp_id = $rowsData['temp_id'];
		   $arrNoOrder = explode("/",$rowsData['no_order']);
		   $letter_code = $arrNoOrder[0];
		   $letter_code2 = $arrNoOrder[1];
		   $letter_date = $rowsData['date_create'];
		   $secid = $rowsData['siteid'];
		   if($rowsData['schoolid'] != ''){
		     $schoolid = $rowsData['schoolid'];
			 $letter_type = '135';
			 $letter_sub_type = '66';
		   }else{
			 $schoolid = $secid;
			 $letter_type = '10';
			 $letter_sub_type = '24';  
		   }
		   #check duplicate
		   $sqlDuplicate = "SELECT letter_id FROM command_letter 
		                    WHERE letter_code = '$letter_code' AND
							      letter_code2 = '$letter_code2' AND
								  secid = '$secid' AND
								  schoolid = '$schoolid'  ";
		   $queryDuplicate = mysql_db_query(_DBNAME,$sqlDuplicate)or die(mysql_error());
		   $numDuplicate = mysql_num_rows($queryDuplicate);
		   if($numDuplicate == 0){
			  #insert command 
		      $sqlInsertCommand = "INSERT INTO command_letter(letter_id,letter_code,letter_code2,letter_date,secid,schoolid,letter_type,dateadd,letter_sub_type,temp_id)
			                       VALUES(NULL,'$letter_code','$letter_code2','$letter_date','$secid','$schoolid','$letter_type',NOW(),'$letter_sub_type','$temp_id')";
			  mysql_db_query(_DBNAME,$sqlInsertCommand)or die(mysql_error());
			  $letter_id = mysql_insert_id();					   
		   }else{
		      $rowsDuplicate = mysql_fetch_array($queryDuplicate);
			  $letter_id = $rowsDuplicate['letter_id'];
		   }						  
		   
		   
		   #attach value
		   $effective_date = $rowsData['date_order'];
		   $prename = $rowsData['prename'];
		   $firstname = $rowsData['name'];
		   $surname = $rowsData['surname'];
		   $pin = $rowsData['idcard'];
		   $pid_old = $rowsData['position'];
		   $pid_new = $rowsData['position'];
		   $vitaya_old = $rowsData['vitaya'];
		   $vitaya_new = $rowsData['vitaya'];
		   $position_id = $rowsData['no_position'];
		   $position2_id = $rowsData['no_position'];
		   $level_id_old = $rowsData['level_before'];
		   $level_id_new = $rowsData['level_before'];
		   $salary_old = $rowsData['salary_before'];
		   $salary_new = $rowsData['salary_after'];
		   $payment_2 = $rowsData['payment_2'];
		   $payment_4 = $rowsData['payment_4'];
		   $payment_6 = $rowsData['payment_6'];
		   
		   #check duplicate attach
		   $sqlDupAtt = "SELECT attach_id FROM command_letter_attach 
		                 WHERE letter_id = '$letter_id' AND 
						       pin = '$pin' AND
							   firstname = '$firstname' AND
							   surname = 'surname' ";
		   $queryDupAtt = mysql_db_query($sqlDupAtt);
		   $numDupAtt = mysql_num_rows($queryDupAtt);					   
		   
		    #insert attach
		   if($numDupAtt == 0){	
		    $sqlInsertAtt = "INSERT INTO command_letter_attach(attach_id,pin,prename,firstname,surname,position_id,position2_id,effective_date,dateadd,letter_id,pid_old,
		                                                      pid_new,level_id_old,level_id_new,salary_old,salary_new,vitaya_old,vitaya_new,payment_2,payment_4,payment_6)
							 VALUES(NULL,'$pin','$prename','$firstname','$surname','$position_id','$position2_id','$effective_date',NOW(),'$letter_id','$pid_old',
		                           '$pid_new','$level_id_old','$level_id_new','$salary_old','$salary_new','$vitaya_old','$vitaya_new','$payment_2','$payment_4','$payment_6')";
		    mysql_db_query(_DBNAME,$sqlInsertAtt)or die(mysql_error());	
			$import = 1;					   
		   }else{
			$import = 2;    
		   }
		   $sqlUpdate = "UPDATE excel_data SET import_status = '$import' WHERE temp_id = '$temp_id'";
		   $sqlUpdate2 = "UPDATE excel_data_temp SET import_status = '$import' WHERE temp_id = '$temp_id'";
		   mysql_db_query(_DBNAME,$sqlUpdate)or die(mysql_error());
		    mysql_db_query(_DBNAME,$sqlUpdate2)or die(mysql_error());
		   $numImport++;
		   
		}else{
		  $arrErrId[] = $rowsData['temp_id']; 
		}
		
	}
	
?>
<table width="70%" border="1" cellspacing="0" cellpadding="3" align="center" bordercolor="#006600" bgcolor="#D5FFD5" style="border-collapse:collapse;">
  <tr>
    <td align="center"><strong>ระบบสามารถนำเข้าข้อมูลได้ทั้งหมด  <?=$numImport?> รายการ</strong></td>
  </tr>
</table>
<br />

<?php
#ถ้าพบรายการที่ไม่สามารถนำเข้าได้
if(count($arrErrId) > 0){
	
	/*echo "<pre>";
	print_r($arrErrField);
	echo "</pre>";*/
	
?>
<table width="70%" border="1" cellspacing="0" cellpadding="3" align="center" bordercolor="#CCCCCC" style="border-collapse:collapse;">
  <tr>
    <td width="6%" align="center" bgcolor="#eeeeee"><strong>ลำดับ</strong></td>
    <td width="15%" align="center" bgcolor="#eeeeee"><strong>เลขที่คำสั่ง</strong></td>
    <td width="22%" align="center" bgcolor="#eeeeee"><strong>หมายเลขบัตรประชาชน</strong></td>
    <td width="57%" align="center" bgcolor="#eeeeee"><strong>รายการข้อผิดพลาด</strong></td>
  </tr>
<?php
$i = 1;
foreach($arrErrId as $tempId){
	$sqlErr = "SELECT * FROM excel_data_temp WHERE temp_id = '$tempId' ";
    $queryErr = mysql_db_query(_DBNAME,$sqlErr)or die(mysql_error());
    $rowsErr = mysql_fetch_array($queryErr);
?>  
  <tr>
    <td align="center" valign="top"><?=$i?></td>
    <td align="center" valign="top"><?=$rowsErr['no_order']?></td>
    <td align="center" valign="top"><?=$rowsErr['idcard']?></td>
    <td valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="3">
<?php

foreach($arrErrField[$tempId] as $field){
?>
  <tr>
    <td width="53%">
	<?php 
	if($field == 'command_file'){
	  echo "ไฟล์คำสั่ง";	
	}elseif($field == 'attach_file'){
	  echo "ไฟล์บัญชีแนบ";		
	}else{ 
	 echo $rowsErr[$field];
	}
	?>
    </td>
    <td width="47%"><font color="#CC0000"><?=$arrErrMsg[$field]?></font></td>
  </tr>
<?php
}
?>  
</table>  
    </td>
  </tr>
<?php
  $i++;
}
?>  
</table>
<?php		
}
#จบการแสดงผล ถ้าพบรายการที่ไม่สามารถนำเข้าได้
echo " &nbsp;&nbsp;&nbsp;&nbsp;<input type=\"button\" name=\"tbl_clobt_closese\" id=\"bt_close\" value=\"ปิดหน้าโปรแกรม\" onclick=\"location.href='?action=close'\"> ";
}
?>

<?
		if($action == "close"){
		echo "<script>location.href='index_upload.php';</script>";
		exit;
		}//end 


	if($action == ""){
	$_POST['bt_submit'] = "";
?>
<form action="" method="post" name="frm" enctype="multipart/form-data" onSubmit= "return ValidateDoc()">
<input type="hidden" name="action" value="upload" />
<table width="70%" border="1" cellspacing="0" cellpadding="3" align="center" bordercolor="#999999" bgcolor="#CCCCCC" style="border-collapse:collapse;">
  <tr>
    <td>
    
<table width="100%" border="0" cellspacing="0" cellpadding="3">
  <tr>
    <td width="42%" align="right"><strong>ชื่อโปรไฟล์ข้อมูล</strong></td>
    <td width="58%">
      <input name="profile_name" type="text" size="50" />
      </td>
  </tr>
  <tr>
    <td align="right"><strong>ไฟล์ข้อมูล</strong></td>
    <td>
    <input name="checklist" type="file" />
    </td>
  </tr>
  <tr>
    <td align="right"><strong>เขตพื้นที่การศึกษา</strong></td>
    <td>
       <?php
       $sql = "SELECT secid,secname,secname_short FROM eduarea WHERE  secid='$xsiteid'";
       $query = mysql_db_query('cmss_master',$sql)or die(mysql_error());
       $rows = mysql_fetch_array($query);
	   echo "$rows[secname]";
	?>
    <input type="hidden" name="siteid" id="siteid" value="<?=$xsiteid?>">
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input name="bt_submit" type="submit" value=" Upload " />
      
      </td>
  </tr>
</table>
    
    </td>
  </tr>
</table>
</form>
<?
	}//end if($action == ""){
?>
</body>
</html>