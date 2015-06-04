<?php
 /**
 * @comment ตัวแปรสำหรับตรวจสอบคำสั่ง
 * @projectCode 57CMSS10
 * @tor 10.4.1
 * @package core
 * @author Sathianphong Sukin
 * @access public
 * @created 23/01/2015
 */
class utility{
  public $dbApp = "command_verification";
  public $dbMaster = "cmss_master";
  public $xsite;
  
  public function getSiteNow($idcard){
	  
      $sql = "SELECT siteid FROM view_general WHERE CZ_ID = '$idcard' ";
	  $query = mysql_db_query($this->dbMaster,$sql)or die(mysql_error());
	  $num = mysql_num_rows($query);
	  if($num > 0){
	   $rows = mysql_fetch_array($query);
	   $site = $rows['siteid'];
	  }else{
	    $sql = "SELECT CZ_ID FROM view_general WHERE CZ_ID = '$idcard' ";
		$query = mysql_db_query('cmss_0000',$sql)or die(mysql_error());
		$num = mysql_num_rows($query);
		if($num > 0){
		  $site = "0000";
		}else{
			//@modify Supachai 30/3/2558 หา site ของคนนั้นไม่เจอ เพราะเป็นคำสั่งบรรจุ จึงยังไม่มีข้อมูลใน view_general เลยต้องไปหาใน agenda_command_letter_attach 
			$sql = "SELECT site FROM agenda_view_report_detail WHERE attach_id = '{$_GET[attach_id]}' ";
			$query = mysql_db_query($this->dbMaster,$sql)or die(mysql_error());
			$rows = mysql_fetch_array($query);
			$site = $rows['site'];
			//@end
		}
	  }
	  	
	  return $site;
  }
 
  
  public function getPeriodReal($date_start,$date_end){
    $arr_start = explode("-",$date_start);
    $arr_end = explode("-",$date_end);
    $mk_start = @mktime(0,0,0,$arr_start[1],$arr_start[2],$arr_start[0]);
    $mk_end = @mktime(0,0,0,$arr_end[1],$arr_end[2],$arr_end[0]);
    $all_day = (($mk_end - $mk_start)/86400)+1;
	$plus_day = 0;
	$mk_compare = $mk_start - 86400;
	
    $num_day = 0;
    $num_month = 0;
	if($arr_start[1] == '3' and $arr_start[2] == '1'){
	 $day_compare = '30';
	}else{
     $day_compare = date('d',$mk_compare);
	} 
	$arr_end_month = array();
    $j = 1;
    $k = 1;
	
    for($i=$mk_start;$i<=$mk_end;$i=($i+86400)){
  	   $num_day = $num_day+1;
 	   $y = date('Y',$i);
  	   $m = date('m',$i);
       $d = date('d',$i);
       $end_of_month = date('t',$i);
	   $arr_end_month[] = $end_of_month;
	 
       if($end_of_month < $day_compare){
        $day_compare = $end_of_month;
       }
   
       #####
       if($j == 1 and $d == $end_of_month and $num_month == 0){
        $plus_day = 1;
       }
   
       if($num_day > 1){
        if((int)$day_compare == (int)$d ){
	      $num_month = $num_month+1;
          $all_day = $all_day - $j;
	      $j = 0;
        }
       }
   
       if($arr_start[1] == '3' and $arr_start[2] == '1'){
	    $day_compare = '31';
	   }else{
	    if($m == '2' and $arr_start[1] == '2'){
	     //echo "Feb";
	    }
	    if($arr_start[2] != '1'){
	     $day_compare = date('d',$mk_compare);
	    }else{ 
	     $day_compare = $end_of_month;
	    }
	  }
   	
     $j++;
     $k++;
   }## end for

   if(number_format($all_day) == '30' and $end_of_month == '30'){
    $num_month = $num_month+1;
    $all_day = 0;
   }
   if(number_format($all_day) == '31' and $end_of_month == '31'){
    $num_month = $num_month+1;
    $all_day = 0;
   }
   if(number_format($all_day) >= '31' ){
    $num_month = $num_month+1;
    $all_day = 0;
   }
 
   ######
   if($plus_day == '1' and $arr_end_month[0] > end($arr_end_month)){
     $all_day++;
   }
   $num_year = 0;
   while($num_month >= 12){
     $num_year = $num_year+1;
     $num_month = $num_month-12;
   }
   $arrPeriod = array($num_year,$num_month,number_format($all_day));
   return $arrPeriod;
  
  }
  
  
  public function splitDate($arrPeriod){
    $strPeriod = "";
    if($arrPeriod[0] > 0){
      $strPeriod .= $arrPeriod[0]." ปี ";
    }
	if($arrPeriod[1] > 0){
      $strPeriod .= $arrPeriod[1]." เดือน ";
    }
    if($arrPeriod[2] > 0){
      $strPeriod .= $arrPeriod[2]." วัน ";
    }
    return $strPeriod;
  }
  
  
  public function dateConvert($date,$type){
    $arr_month = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
	$arrDate = explode("-",$date);
    switch($type){
	  case 'en-th-ymd':
		$dateReturn = ($arrDate[0]+543)."-".$arrDate[1]."-".$arrDate[2];
	  break;
	  case 'th-en-ymd':
		$dateReturn = ($arrDate[0]-543)."-".$arrDate[1]."-".$arrDate[2];
	  break;
	  case 'en-th-ddmmyy':
	    $dateReturn = (int)$arrDate[2]." ".$arr_month[(int)$arrDate[1]]." ".($arrDate[0]+543);
	  break;
	  case 'th-th-ddmmyy':
	    $dateReturn = (int)$arrDate[2]." ".$arr_month[(int)$arrDate[1]]." ".($arrDate[0]);
	  break;
	}
	
	return $dateReturn;
  }
  
  public function getPeriodRealHalf($date_start,$date_end){
   
	$arr_start = explode("-",$date_start);
    $arr_end = explode("-",$date_end);
    if(count($arr_start) == 3 and 
      count($arr_end) == 3 and 
	  $arr_start[0] != '' and 
	  $arr_start[1] != '' and 
	  $arr_start[2] != '' and 
	  $arr_end[0] != '' and 
	  $arr_end[1] != '' and 
	  $arr_end[2] != ''){	
        $mk_start = @mktime(0,0,0,$arr_start[1],$arr_start[2],$arr_start[0]);
        $mk_end = @mktime(0,0,0,$arr_end[1],$arr_end[2],$arr_end[0]);
        $all_day = (($mk_end - $mk_start)/86400)+1;
    
	    $mk_period = $mk_end - $mk_start;
	    $half_mk_period = $mk_period/2;
	    $mk_new_end = $mk_start + $half_mk_period;
	    $date_new_end = date('Y-m-d',$mk_new_end);
	    $all_day = (($mk_new_end - $mk_start)/86400)+1;
	    return $date_new_end;
    }else{
        return 0;
    }	
  
  }
  
   public function getPeriod(){
	   
	   if($this->eduId == '10'){
		   $sqlTxt = "SELECT grade FROM graduate WHERE id = '".$this->idcard."' AND graduate_level = '10' ";
		   $queryTxt = mysql_db_query($this->dbNow,$sqlTxt)or die(mysql_error());
		   $rowsTxt = mysql_fetch_array($queryTxt);
		   if(eregi('ป.ว.ช',$rowsTxt['grade']) or eregi('ปวช',$rowsTxt['grade']) or (eregi('ประกาศนียบัตรวิชาชีพ',$rowsTxt['grade']) and !eregi('สูง',$rowsTxt['grade']))){
	          $where = " AND edu_type = '1' ";
		   }
        }
	   
        $sql = "SELECT * FROM command_letter_period WHERE degree_id = '".$this->eduId."' AND pos_new = '".$this->levelId."' $where ";
        $query = mysql_db_query($this->dbApp,$sql)or die(mysql_error());
        $rows = mysql_fetch_array($query);
    
	    return $rows['time_period'];
   }
   
   public function check38kPos($idcard,$effective_date){
	   $date = $this->dateConvert($effective_date,'en-th-ymd');
	   $dbSite = "cmss_".$this->getSiteNow($idcard);
	   $sql = "SELECT position_id FROM salary WHERE id = '$idcard' AND 
	                                               (position_id LIKE '1%' OR position_id LIKE '2%' OR position_id LIKE '3%' OR 
												    position_id LIKE '4%' OR position_id LIKE '6%') AND 
													date <= '$date' ";
	  $query = mysql_db_query($dbSite,$sql)or die(mysql_error());
	  $num = mysql_num_rows($query);
	  if($num > 0){
		  return true;
	  }else{
	      return false;
	  }												
   }
   
    public function getInstructionDetail($letter_id){
		$sql="SELECT * FROM cmd_command_instruction_remove WHERE letter_id = {$letter_id}";
		$result = mysql_db_query($this->dbApp,$sql)or die(mysql_error());
		return mysql_fetch_assoc($result);
    }
	
	public function getLetterDetail($letter_id){	
		$sql = "SELECT site FROM agenda_view_report_detail WHERE letter_id = '{$letter_id}' ";
		$query = mysql_db_query($this->dbMaster,$sql)or die(mysql_error());
		$rows = mysql_fetch_array($query);

		$sql="SELECT * FROM agenda_command WHERE letter_id = {$letter_id}";
		$result = mysql_db_query('cmss_'.$rows['site'],$sql)or die(mysql_error());

		return mysql_fetch_assoc($result);
    }

    public function getViewGeneralDetail($idcard){
		$sql="SELECT *, ADDDATE(comeday, INTERVAL -543 YEAR) AS comeday_c,
			ADDDATE(startdate, INTERVAL -543 YEAR) AS startdate_c,
			ADDDATE(begindate, INTERVAL -543 YEAR) AS begindate_c
		FROM view_general WHERE CZ_ID = '{$idcard}'";
		$result = mysql_db_query($this->dbMaster,$sql)or die(mysql_error());
		return mysql_fetch_assoc($result);
    }
	
    public function getVitayaStatDetail($idcard, $siteid){
		$sql="SELECT *, ADDDATE(date_start, INTERVAL -543 YEAR) AS date_start_c
			FROM vitaya_stat WHERE id = '{$idcard}'";
		$result = mysql_db_query('cmss_'.$siteid, $sql)or die(mysql_error());
		while($row = mysql_fetch_assoc($result)){
			$data[$row['vitaya_id']] = $row;
		}
		return $data;
    }		
}
?>