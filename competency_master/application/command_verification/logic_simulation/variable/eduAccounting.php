<?php
class eduAccounting extends education{
 public $arrDataAcc = array();
 
 public function getAccounting(){
  $sql = "SELECT * FROM ".$this->dbNow.".graduate AS g
          LEFT JOIN ".$this->dbMaster.".hr_addmajor_line_match AS m ON m.major_id = g.major_level
          WHERE g.id = '".$this->idcard."' AND m.major_line_id = '1' ";
  $query = mysql_db_query($this->dbNow,$sql)or die(mysql_error());
  while($rows = mysql_fetch_array($query)){
    $this->arrDataAcc[] = $rows['runid'];
  }
  return $this->arrDataAcc;
 }
 
 public function haveAccounting(){
   if(count($this->arrDataAcc) > 0){
     return true;
   }else{
     return false;
   }
 } 

} 
?>