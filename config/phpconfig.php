<?php
//include ("session.inc.php");
require_once("config_hr.inc.php");


$monthname = array( "","���Ҥ�","����Ҿѹ��","�չҤ�","����¹","����Ҥ�","�Զع�¹", "�á�Ҥ�","�ԧ�Ҥ�","�ѹ��¹","���Ҥ�","��Ȩԡ�¹","�ѹ�Ҥ�");
$month 			= array( "","�.�.","�.�.","��.�.","��.�.","�.�.","��.�.", "�.�.","�.�.","�.�.","�.�.","�.�.","�.�.");

/* open connection Mysql Server */
/* �ѧ���� Close connection */
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
�ѹ���
<select name="<?=$pre?>_day" >
<?
echo "<option value=''> ����к�</option>";
for ($i=1;$i<=31;$i++){
	if (intval($d1[2])== $i){
		echo "<option SELECTED>" .  sprintf("%02d",$i) . "</option>";
	}else{
		echo "<option>" .  sprintf("%02d",$i) . "</option>";
	}
}
?>
</select>

��͹ 
<select name="<?=$pre?>_month" >
<?
echo "<option value=''>����к� </option>";
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

�� �.�. 
<select name="<?=$pre?>_year" >
<?
echo "<option> </option>";
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

function DateInput1($d,$pre){
	global $month;
	if (!$d){
		$d = (intval(date("Y")) + 543) . "-" . date("m-d"); // default date is today
	}

	$d1=explode("-",$d);
?>
�ѹ���
<select name="<?=$pre?>_day" >
<?
echo "<option> </option>";
for ($i=1;$i<=31;$i++){
	if (intval($d1[2])== $i){
		echo "<option SELECTED>" .  sprintf("%02d",$i) . "</option>";
	}else{
		echo "<option>" .  sprintf("%02d",$i) . "</option>";
	}
}
?>
</select>

��͹ 
<select name="<?=$pre?>_month" >
<?
echo "<option> </option>";
for ($i=1;$i<=12;$i++){
	$xi = sprintf("%02d",$i);
	if (intval($d1[1])== $i){
//		echo "<option value='$xi' SELECTED>$xi</option>";
		echo "<option value='$xi' SELECTED>$month[$i]</option>";
	}else{
//		echo "<option value='$xi'>$xi</option>";
		echo "<option value='$xi'>$month[$i]</option>";
	}
}
?>
</select>

�� �.�. 
<select name="<?=$pre?>_year" >
<?
echo "<option> </option>";
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
	if (!$d) $xdate =  "";
	
	$d1=explode("-",$d);
	
	if($d1[2]!=0 and $d1[1] !=0 and $d1[0]!=0){ 	
		$xdate =  intval($d1[2]) . " " . $monthname[intval($d1[1])] . " �.�. " . $d1[0];
	}else if($d1[2]==0 and $d1[1] !=0 and $d1[0]!=0 ){ 
		$xdate = $monthname[intval($d1[1])] . " �.�. " . $d1[0];
	}else	if($d1[2]==0 and $d1[1] ==0 and $d1[0]!=0 ){ 
		$xdate = $d1[0] ;
	}else{
		$xdate =  "";
	}
	return $xdate ;
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

	return "30 �ѹ��¹ ".$retire_year;
}

//function ������ʴ��ѹ���Ẻ��
function showdaythai($temp){
if($temp != "0000-00-00"){
	$month = array("���Ҥ�", "����Ҿѹ��", "�չҤ�", "����¹", "����Ҥ�", "�Զع�¹", "�á�Ҥ�", "�ԧ�Ҥ�", "�ѹ��¹", "���Ҥ�", "��Ȩԡ�¹", "�ѹ�Ҥ�");
	$num = explode("-", $temp);			
	if($num[0] == "0000"){
	  $date = "����к�";
	} else {
	  $tyear = $num[0] +  543;
	  $date = remove_zero($num[2])."&nbsp;".$month[$num[1] - 1 ]."&nbsp; �.�. ".$tyear;	
	}
} else { 	$date = "����к�"; }	
return $date;
}


function Query1($sql){
	$result = mysql_query($sql);
	$rs = mysql_fetch_array($result);
	return $rs[0];
}


// Function �ѹ���㹡�á�͡����������

function DateInput_key($d,$pre,$headword){
	global $monthname;

	$d1=explode("-",$d);
?>
�ѹ���
<select name="<?=$pre?>_day" >
<?
echo "<option value=''> $headword</option>";
for ($i=1;$i<=31;$i++){
	if (intval($d1[2])== $i){
		echo "<option SELECTED>" .  sprintf("%02d",$i) . "</option>";
	}else{
		echo "<option>" .  sprintf("%02d",$i) . "</option>";
	}
}
?>
</select>

��͹ 
<select name="<?=$pre?>_month" >
<?
echo "<option value=''>$headword</option>";
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

�� �.�. 
<select name="<?=$pre?>_year" >
<?
echo "<option value=''> $headword </option>";
$thisyear = date("Y") + 543;
$y1 = $thisyear;
$y2 = $thisyear - 80 ;
					
for ($i=$y1;$i>=$y2;$i--){
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

## function  �Ѵ�Өҡ���˹觷���ͧ���
function CutWord($string1,$needle){
	  $needle_len = strlen($needle);
	  $position_num = strpos($string1,$needle) + $needle_len;
	  $result_string = substr("$string1",$position_num);
	  return "$result_string";  
}

##  �ʴ��дѺ����֡��
function ShowGraduate($get_level){
	global $dbnamemaster;
	$sql = "SELECT highgrade FROM hr_addhighgrade WHERE runid='$get_level'";
	$result = mysql_db_query($dbnamemaster,$sql);
	$rs = mysql_fetch_assoc($result);
	return  $rs[highgrade];
}

## end �ʴ��дѺ����֡��
##  �ʴ��زԡ���֡��
function ShowGraduateLevel($get_degree){
	global $dbnamemaster;
	$sql = "SELECT degree_name,degree_fullname FROM hr_adddegree WHERE degree_id='$get_degree'";
	$result = mysql_db_query($dbnamemaster,$sql);
	$rs = mysql_fetch_assoc($result);
	return $rs[degree_fullname]."($rs[degree_name])";
}
## �ʴ��Ң��Ԫ��͡
function ShowMajor($get_major){
	global $dbnamemaster;
	$sql = "SELECT * FROM  hr_addmajor WHERE major_id='$get_major'";
	$result = mysql_db_query($dbnamemaster,$sql);
	$rs = mysql_fetch_assoc($result);
	return $rs[major];
}
## �ʴ�ʶҹ����֡��
function ShowGraduatePlace($get_id){
	global $dbnamemaster;
	$sql = "SELECT * FROM hr_adduniversity WHERE u_id='$get_id'";
	$result = mysql_db_query($dbnamemaster,$sql);
	$rs = mysql_fetch_assoc($result);
	return $rs[u_name];
}
## function show date
###  �ʴ�����ࢵ��鹷�����֡��
	function ShowArea($get_secid){
		global $dbnamemaster;
		$sql_area = "SELECT secname FROM eduarea WHERE secid='$get_secid'";
		$result_area = mysql_db_query($dbnamemaster,$sql_area);
		$rs_area = mysql_fetch_assoc($result_area);
		return $rs_area[secname];
	}//end function ShowArea($get_secid){
	
###  �ѧ�����ʴ�˹��§ҹ
	function ShowSchool($get_schoolid){
		global $dbnamemaster;
		$sql_school = "SELECT office FROM allschool WHERE id='$get_schoolid'";
		$result_school = mysql_db_query($dbnamemaster,$sql_school);
		$rs_school = mysql_fetch_assoc($result_school);
		return $rs_school[office];
	}//end function ShowSchool($get_schoolid){



function ShowDateThai($get_dates,$get_datee){
	global $shortmonth,$monthname;
	$xdate_s = strpos($get_dates,"-");
	$xdate_e = strpos($get_datee,"-");	
	###  �ѹ����������
	if(!($xdate_s === false)){
			if($get_dates != "0000-00-00" and (strlen($get_dates) == 10)){
				$arrs = explode("-",$get_dates);
				$date_start = $arrs[2]." ".$shortmonth[intval($arrs[1])]." ".$arrs[0];	
			}else{
				$date_start = $get_dates;
			}
	}else{
		$date_start = $get_dates;
	}//end if(!($xdate_s === false)){
	### �ѹ�������ش
	if(!($xdate_e === false)){
			if($get_datee != "0000-00-00" and (strlen($get_datee) == 10)){
				$arre = explode("-",$get_datee);
				$date_end = $arre[2]." ".$shortmonth[intval($arre[1])]." ".$arre[0];
			}else{
				$date_end = $get_datee;
			}
	}else{
			$date_end = $get_datee;
	}//end if(!($xdate_e === false)){ 
	
	###  return ���
	if($date_start != "" and $date_end != ""){
			return $date_start." �֧ ".$date_end;
	}else{
		return $date_start."".$date_end;	
	}
}

function cut_stringschool($text){ 
 //return  array index
 #  4   �ӹѡ�ҹࢵ��鹷�����֡��
 #  3   �ӹѡ�ҹ��ж��֡�Ҩѧ��Ѵ
 #  2   �ӹѡ�ҹ��ж��֡�������
 #  1   �ç���¹
 #  0   ���˹�
    
    
  $arr['4']=array('ʾ�.','ʾ�','� � �','�ӹѡ�ҹࢵ��鹷�����֡��'); 
  $arr['3']=array('ʻ�.','ʻ�','� � �','�ӹѡ�ҹ��ж��֡�Ҩѧ��Ѵ'); 
  $arr['2']=array('ʻ�.','ʻ�','� � �','�ӹѡ�ҹ��ж��֡�������'); 
  $arr['1']=array('�.�.','�.�','� �','��.','��','�ç���¹'); 
 
  $arrcut=array('','(');    
  foreach($arr as $index=>$value){
     $xsearch=false; 
     $pos=false;           
      foreach($value as $subindex=>$subvalue){
           $pos=strpos($text,$subvalue, 1); 
               if($pos===false){         
               }else{
                   $xindex++;                
                     $name=substr($text,($pos+strlen($subvalue)),strlen($text)); 
                     $label=substr($text,$pos,strlen($text));
                     $text=substr($text,0,$pos);
                         // �Ѵ����ѡ��
                         $cutpos=false;
                         foreach($arrcut as $cutindex=>$cutstring){
                            $cutpos=strpos($label,$cutstring, 1); 
                               if($cutpos===false){
                               }else{ 
                                   $label=substr($label,0,$cutpos);
                                   $cutpos=strpos($name,$cutstring, 1); 
                                   if($cutpos===false){}else{  
                                     $name=substr($name,0,$cutpos);  
                                   } 
                                       
                               }
                         } 
                        //                       
                       $reval[$index]['name']=$name;  
                       $reval[$index]['label']=$label; 
                 break;
               }
      }
      $reval['0']['name']=$text;  
      $reval['0']['label']=$text;
                    
   }
  
   ksort($reval);  
   return  $reval;   
}


## function  �ѧ�����ʴ����˹�
function ShowPosition($get_positionid){
	global $dbnamemaster;
	$sql = "SELECT position FROM hr_addposition_now WHERE pid='$get_positionid'";
	$result = mysql_db_query($dbnamemaster,$sql);
	$rs = mysql_fetch_assoc($result);
	return $rs[position];
}//end function ShowPosition(){

##  function �ʴ��дѺ
function ShowRadub($get_radubid){
	global $dbnamemaster;
	$sql = "SELECT radub FROM hr_addradub WHERE level_id='$get_radubid'";
	$result = mysql_db_query($dbnamemaster,$sql);
	$rs = mysql_fetch_assoc($result);
	return $rs[radub];
}// end function ShowRadub(){
	
##  function ��Ǩ�ͺ order_type ���������Ѻ��Ǩ�ͺ����ѵԡ���Ѻ�Ҫ���
function CheckOrderType($get_order_type){
	global $dbnamemaster;
	$sql = "SELECT COUNT(*) AS numCheck FROM hr_order_type WHERE active_history ='1' AND id='$get_order_type'";
	$result = mysql_db_query($dbnamemaster,$sql);
	$rs = mysql_fetch_assoc($result);
	return $rs[numCheck];
}

?><script>
var maxyear=<?=date('Y')+543?>;
</script>