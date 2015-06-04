<?php
class eduEconomics extends education{
 public $arrDataEco = array();
 
 public function getEconomics(){
  $sql = "SELECT * FROM ".$this->dbNow.".graduate AS g
          LEFT JOIN ".$this->dbMaster.".hr_addmajor_line_match AS m ON m.major_id = g.major_level
          WHERE g.id = '".$this->idcard."' AND m.major_line_id = '30' ";		  
  $query = mysql_db_query($this->dbNow,$sql)or die(mysql_error());
  while($rows = mysql_fetch_array($query)){
    $this->arrDataEco[] = $rows['runid'];
  }
  return $this->arrDataEco;
 }
 
 public function haveEconomics(){
   if(count($this->arrDataEco) > 0){
     return true;
   }else{
     return false;
   }
 } 

} 
?>