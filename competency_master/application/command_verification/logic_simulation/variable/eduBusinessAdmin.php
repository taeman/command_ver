<?php
class eduBusinessAdmin extends education{
 public $arrDataBusiness = array();
 
 public function getBusinessAdmin(){
  $sql = "SELECT * FROM ".$this->dbNow.".graduate AS g
          LEFT JOIN ".$this->dbMaster.".hr_addmajor_line_match AS m ON m.major_id = g.major_level
          WHERE g.id = '".$this->idcard."' AND m.major_line_id = '12' ";
  $query = mysql_db_query($this->dbNow,$sql)or die(mysql_error());
  while($rows = mysql_fetch_array($query)){
    $this->arrDataBusiness[] = $rows['runid'];
  }
  return $this->arrDataBusiness;
 }
 
 public function haveBusinessAdmin(){
   if(count($this->arrDataBusiness) > 0){
     return true;
   }else{
     return false;
   }
 } 

} 
?>