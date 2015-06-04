<?php
class eduPhd extends education{
 public $arrData = array();
 
 public function getPhd(){
  $sql = "SELECT * FROM graduate WHERE id = '".$this->idcard."' AND graduate_level = '80' ";
  $query = mysql_db_query($this->dbNow,$sql)or die(mysql_error());
  while($rows = mysql_fetch_array($query)){
    $this->arrData[$rows['runid']] = $rows['graduate_level']; 
  }
  return $this->arrData;
 }
 
 public function havePhd(){
   if(count($this->arrData) > 0){
     return true;
   }else{
     return false;
   }
 }
 
 
} 
?>