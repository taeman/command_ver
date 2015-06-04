<?php
 /**
 * @comment ตัวแปรสำหรับตรวจสอบคำสั่ง
 * @projectCode 57CMSS10
 * @tor 10.4.2
 * @package core
 * @author Sathianphong Sukin
 * @access public
 * @created 23/01/2015
 */
$_SESSION['session_staffid'] = '1';
include "../../../config/conndb_nonsession.inc.php";
include "class/class.utility.php";
include "class/class.education.php";
include "variable/expPosition.php";
include "variable/expRelatedTasks.php";

class logicProcess extends education{
  public $arrVar = array();
  public $arrVarValue = array();
  public $arrVarQuery = array();
  public $strCondition;
  public $returnId;
  
  public function __construct($idcard,$attachId){
    parent::__construct($idcard);
	
	#### Configulation Variables ####
	$this->condition = "((21==23)||(21==24)||(21==25))||((20==23)||(20==24)||(20==25))||((19==23)||(19==24)||(19==25))";
	//$this->condition = "(x7==true)";
	$this->formularToArray();
	
	$arrChar = array('(',')');
	$this->strCondition = str_replace($arrChar,"",$this->condition);
	
  }
   
  public function process(){
    
	foreach($this->arrVar as $var){
	  $this->arrVarQuery = array();
	  
	  #### get Variable Detail
	  $sqlVar = "SELECT * FROM cmd_variable WHERE var_id = '$var' ";
	  $queryVar = mysql_db_query($this->dbApp,$sqlVar)or die(mysql_error());
	  $rowsVar = mysql_fetch_array($queryVar);	  
	  $type = $rowsVar['var_type'];
	  $value = $rowsVar['var_eval'];
	  
	  switch($type){
	    case '1': // if constant
		  $this->arrVarValue[$var] = $value;
		break;
		case '2': // if SQL
		  $sql = $this->replaceSQL($value);
		  $this->arrVarValue[$var] = $this->querySQL($sql);
		break;
		case '3': // if PHP Function
		  $this->arrVarValue[$var] = true;
		break;
	  }
	  
	}
	
	echo $this->condition;
	echo "<hr>";
	
	foreach($this->arrVarValue as $key=>$value){
	  if($this->arrVarValue[$key] != ""){
	   $valueRe = $this->arrVarValue[$key];
	  }else{
	   $valueRe = "''";
	  }
	  $this->condition = str_replace($key,$valueRe,$this->condition);
	  $this->strCondition = str_replace($key,$valueRe,$this->strCondition);
	}
	
	$arrOperator1 = array('||','&&');
	$arrOperator2 = array('==','!=','>=','<=','>','<');
	$this->strCondition = str_replace($arrOperator1,"||",$this->strCondition);
	$arrCond = explode("||",$this->strCondition);
	foreach($arrCond as $key=>$value){
	  $arrVar = array();
	  $valueRe = str_replace($arrOperator2,"_",$value);
	  eval("\$value = $value;");
	  if($value){
		$arrVar = explode('_',$valueRe);
		if(is_numeric($arrVar[0])){
		 if($arrVar[0] > $this->returnId){
		  $this->returnId = $arrVar[0];
		 }
		}else{
		 $this->returnId = $arrVar[0]; 
		}
	  }
	}
	
	
	echo "<pre>";
	print_r($this->arrVarValue);
	echo "</pre>";
	echo $this->condition;
	echo "<hr>";
	echo "</pre>";
	echo $this->strCondition;
	echo "<hr>";
	
	
	$strCond = $this->condition;
	eval("\$strCond = $strCond;");
	if($strCond){
	  return true;
	}else{
	  return false;
	}
	 
  }
  
  public function formularToArray(){
    #### Condition
	$arrChar = array("(",")");
	$arrOperation = array("||","&&","==","!=",">=","<=",">","<");
	$conditionRe = str_replace($arrChar,"",$this->condition);
	$conditionRe = str_replace($arrOperation,"_",$conditionRe);
	$this->arrVar = explode("_",$conditionRe);
	
  }
  
  public function replaceSQL($sql){
   $sql = str_replace('[dbMaster]',$this->dbMaster,$sql);
   $sql = str_replace('[dbSite]',$this->dbNow,$sql);
   $sql = str_replace('[idcard]',$this->idcard,$sql);
   return $sql;
  }
  
  public function querySQL($sql){
    $query = mysql_db_query($this->dbNow,$sql)or die(mysql_error());
	$i = 0;
	$arrFields = array();
	#get Fields
	while($i < mysql_num_fields($query)){
	  $meta = mysql_fetch_field($query);
	  $arrFields[] = $meta->name;
	  $i++;
	}
	$i = 0;
	while($rows = mysql_fetch_array($query)){
	  $j = 0;
	  foreach($arrFields as $field){
	    $this->arrVarQuery[$i][$j] = $rows[$field];
	    $j++;
	  }
	 $i++;
	}
	
	return $this->arrVarQuery[0][0];
  }
  
  public function getReturnId(){
    return $this->returnId;
  }
  
}

$objProcess = new logicProcess('3250200209984','34890');
if($objProcess->process()){
  echo "True";
}else{
  echo "False";
}
echo "<br>";
echo $objProcess-> getReturnId();
?>