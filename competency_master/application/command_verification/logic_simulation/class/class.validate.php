<?php
class  Validate extends utility{
  //public $dbApp = "command_verification";
  //public $dbMaster = "cmss_master";
  public $idcard;
  public $siteNow;
  public $dbNow;
  
  public function __construct($idcard=""){
	$this->idcard = $idcard;
	if($this->idcard){
    	$this->siteNow = $this->getSiteNow($this->idcard);
		$this->dbNow = "cmss_".$this->siteNow;
	}
  }
  
  /**
  $sql string
  $parameter array
  */
  public function sqlValidate($sql="", $parameter=array()){
	  $arr_key = array();
	  $arr_val = array();
	  foreach($parameter as $key=>$val){
		  if($key=="dbSite"){
		  	$arr_key[] = "[dbSite]";
		  	$arr_val[] = $this->dbNow;
		  }else{
			 $arr_key[] = "[".$key."]";
		  	$arr_val[] = $val;
		 }
	  }
	  //echo $sql;
	  //echo $this->dbNow;
	  $re_sql = str_replace($arr_key, $arr_val, $sql); 
	  $query = mysql_db_query($this->dbMaster,$re_sql)or die(mysql_error());
	  $row = mysql_fetch_row($query);
	  return $row[0];
  }
  
  /**
  * @copyright 2011 Sapphire
 * @description เลขบัตรที่ใช้ในการตรวจสอบ
  * @param string $pid, รหัสระดับ, 525471147
  * @param string $level_id, รหัสระดับ, 92255106
  * @param integer $letter_type, รหัสประเภท, 1
  * @return array 
  */
  public function getDataCommandValidate($pid="", $level_id="", $letter_type=""){
	  $arr_data = array();
	  $sql_letter = " 
						SELECT 
							cmss_master.view_general_report.CZ_ID AS idcard,
							cmss_master.view_general_report.siteid AS siteid,
							command_letter.letter_id,
							command_letter_attach.effective_date,
							command_letter_attach.pid_old,
							command_letter_attach.level_id_new,
							command_letter_attach.level_id_old
						FROM command_letter INNER JOIN command_letter_attach ON command_letter.letter_id = command_letter_attach.letter_id
							 INNER JOIN cmss_master.view_general_report ON command_letter_attach.pin = cmss_master.view_general_report.CZ_ID
						WHERE command_letter.`letter_type` ='".$letter_type."' 
						AND command_letter_attach.pid_new = '".$pid."'
						AND command_letter_attach.level_id_new = '".$level_id."'
						AND command_letter_attach.pin != 'N/A' 
						AND cmss_master.view_general_report.salary >0
						LIMIT 10
	   						";
	  $query_letter = mysql_db_query($this->dbApp, $sql_letter) or die(mysql_error());
	  while($row_letter = mysql_fetch_assoc($query_letter)){
		  $this->siteNow = $this->getSiteNow($row_letter['idcard']);
		  $this->dbNow = "cmss_".$this->siteNow;
		  //echo "SITEID:".$this->dbNow."<br/>";
		  $sql_salary = 	"    SELECT COUNT(id) AS count_data FROM `salary` 
										  WHERE `id` = '".$row_letter['idcard']."' 
										  AND (
										  	position_id='".$pid."' 
										  	AND position_id='".$row_letter['pid_old']."'  
										  ) 
										  AND (
										  	level_id='".$row_letter['level_id_new']."'
											OR
											level_id='".$row_letter['level_id_old']."'
										  )
										  AND date<='".(substr($row_letter['effective_date'],0,4)+543).(substr($row_letter['effective_date'],4,10))."'
										  AND date!=''
									";
		  //echo $sql_salary;
		  //echo "<br/>";
		  $query_salary = mysql_db_query($this->dbNow, $sql_salary) or die(mysql_error());
		  $row_salary = mysql_fetch_assoc($query_salary);
		  $sql_graduate = "	SELECT COUNT(id) AS count_data FROM `graduate` 
		  									WHERE `id` = '".$row_letter['idcard']."' 
											AND finishyear<='".(substr($row_letter['effective_date'],0,4)+543)."'
										";
		  //echo $sql_graduate;
		  //echo "<br/>";								
		  $query_graduate = mysql_db_query($this->dbNow, $sql_graduate) or die(mysql_error());
		  $row_graduate = mysql_fetch_assoc($query_graduate);
		  if($row_salary['count_data']>0 && $row_graduate['count_data']>0){
		  		$arr_data[] = array("salary"=>$row_salary['count_data'], "graduate"=>$row_graduate['count_data'], "idcard"=>$row_letter['idcard'], "letter_id"=>$row_letter['letter_id']  );
		  }
	  }
	  
	  arsort($arr_data);
	  /*echo "<pre>";
	  print_r($arr_data);
	  echo "</pre>";*/
	  
	  $arr_current = current($arr_data);
	  
	  return $arr_current;
  }
  
  
}
?>