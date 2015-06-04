<?php
class education extends utility{
   
  public $idcard;
  public $siteNow;
  public $dbNow;
  public $arrDataEdu = array();
  
  public function __construct($idcard=""){
    $this->idcard = $idcard;
	$this->siteNow = $this->getSiteNow($this->idcard);
	$this->siteNow = empty($this->siteNow) ? $_SESSION[secid] : $this->siteNow;
	$this->dbNow = "cmss_".$this->siteNow;
  }
  
  public function getEducation(){
    $sql = "SELECT * FROM graduate WHERE id = '".$this->idcard."' AND graduate_level != '50' ORDER BY graduate_level DESC , finishyear DESC ";
    $query = mysql_db_query($this->dbNow,$sql)or die(mysql_error());
	$i=0;
    while($rows = mysql_fetch_array($query)){
      $this->arrDataEdu[$i]['runid'] = $rows['runid'];
	  $this->arrDataEdu[$i]['id'] = $rows['id'];
	  $this->arrDataEdu[$i]['finishyear'] = $rows['finishyear'];
	  $this->arrDataEdu[$i]['grade'] = $rows['grade'];
	  $this->arrDataEdu[$i]['graduate_level'] = $rows['graduate_level'];
	  $this->arrDataEdu[$i]['major_level'] = $rows['major_level'];
	  $i++;
    }
	return $this->arrDataEdu;
  }
  
  public function showEducation(){
     echo "<table width=\"70%\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\" align=\"center\">";
	  foreach($this->arrDataEdu as $key=>$value){
       echo "<tr>";
       echo "<td width=\"50%\">".$value['grade']."</td>";
       echo "<td width=\"50%\" align=\"center\"> <b>เมื่อ </b>".$value['finishyear']."</td>";
       echo "</tr>";
	  } 
     echo "</table>";
  }
  
  
}

?>

