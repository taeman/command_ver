<?php
/**
  *��Ǩ�ͺ��ͺ�ѵ�ҡ��ѧ
 *
 * @author  -
 * @copyright 2011 Sapphire
 * @description ��Ǩ�ͺ��ͺ�ѵ�ҡ��ѧ
 * @param date $dateStar, �ѹ����ռ�, 2011-12-03
 * @param date $dateStar2, �ѹ����ռ�, 2011-12-12
 * @param string $siteId, ����ࢵ��鹷�����֡��, 5001
 * @param string $noPosition, �Ţ�����˹�, �1
 * @param integer $positionId, ���ʵ��˹�, 525471119
 * @param integer $levelId, �����дѺ, 92255107
 * @return boolean
 "
 */
class expFrame extends utility{
  public $arrDataExp = array();
  public $dateStart;
  public $siteId;
  public $noPosition;
  public $positionId;
  public $levelId;
  public $errCode = 0;
  
  public function __construct($dateStart="",$siteId="",$noPosition="",$positionId="",$levelId=""){
    $this->dateStart = $dateStart;
    $this->siteId = $siteId;
	$this->noPosition = $noPosition;
	$this->positionId = $positionId;
	$this->levelId = $levelId;
  }
  
 /**
  * ��Ǩ�ͺ��ͺ�ѵ�ҡ��ѧ
 *
 * @return boolean
 */  
  public function checkExp(){
    #get Frame Profile
    $sqlProfile = "SELECT * FROM command_frame_profile WHERE frame_profile_start <= '".$this->dateStart."' AND frame_profile_end >= '".$this->dateStart."' ";
	$queryProfile = mysql_db_query($this->dbApp,$sqlProfile)or die(mysql_error());
	$rowsProfile = mysql_fetch_array($queryProfile);
	$tblMatch = $rowsProfile['tbl_match'];
    $tblDetail = $rowsProfile['tbl_detail'];
    $frameProfileId = $rowsProfile['frame_profile_id'];	
	
	if($tblMatch != "" and $tblDetail != ""){
	 $sqlMatch = "SELECT $tblMatch.*,command_frame_group.frame_group_name 
                  FROM $tblMatch
				  JOIN command_frame_group ON command_frame_group.frame_group_id =  $tblMatch.frame_group_id
				  WHERE $tblMatch.noposition = '".$this->noPosition."'  AND $tblMatch.siteid = '".$this->siteId."' ";
	 $queryMatch = mysql_db_query($this->dbApp,$sqlMatch)or die(mysql_error());
	 $numMatch = mysql_num_rows($queryMatch);
	 if($numMatch > 0){
	   $rowsMatch = mysql_fetch_array($queryMatch);
	   $this->arrDataExp['��ͺ�ѵ�ҡ��ѧ����㹡����'] = $rowsMatch['frame_group_name'];
	   $this->arrDataExp['�Ţ�����˹�'] = $rowsMatch['noposition'];
	   $this->arrDataExp['���˹�/�дѺ���˹�'] = $rowsMatch['frame_comment'];
	   
	   $sqlDetail = "SELECT ".$this->dbApp.".$tblDetail.* , ".$this->dbMaster.".hr_addposition_now.position , ".$this->dbMaster.".hr_addradub.radub
                     FROM ".$this->dbApp.".$tblDetail 
			         JOIN ".$this->dbMaster.".hr_addposition_now ON ".$this->dbMaster.".hr_addposition_now.pid = ".$this->dbApp.".$tblDetail.position_id
			         JOIN ".$this->dbMaster.".hr_addradub ON ".$this->dbMaster.".hr_addradub.level_id = ".$this->dbApp.".$tblDetail.level_id
			         WHERE ".$this->dbApp.".$tblDetail.frame_match_id = '".$rowsMatch['frame_match_id']."'
					 GROUP BY ".$this->dbApp.".$tblDetail.level_id, ".$this->dbApp.".$tblDetail.position_id ";				 			   
      $queryDetail = mysql_db_query($this->dbApp,$sqlDetail)or die(mysql_error());	
      $i =1;
	  $find = 0;
	  $arrFrameDetail = array();
      while($rowsDetail = mysql_fetch_array($queryDetail)){
	   $arrFrameDetail[$i][] = $rowsDetail['position'];
	   $arrFrameDetail[$i][] = $rowsDetail['radub'];
	   if($this->positionId == $rowsDetail['position_id'] and $this->levelId == $rowsDetail['level_id']){
	    $arrFrameDetail[$i][] = '<img src="images/accept.png" align="absmiddle" />';
		$find = 1;
	   }else{
	    $arrFrameDetail[$i][] = '';
	   }
	   $i++;
	  }
	  $this->arrDataExp['��Ǩ�ͺ���˹�'] = $arrFrameDetail;
	  
	  
	  $arrCondition = explode("-",$rowsMatch['frame_condition']);
	  $strCondition = "";
	  foreach($arrCondition as $txt){
	   if(trim($txt) != ""){
	    $strCondition .= "&bull;&nbsp;".$txt."<br>";
	   }
	  }
	  $this->arrDataExp['���͹䢡������͹'] = $strCondition;
	  
	  
	  $sqlRef = "SELECT * FROM command_frame_profile_ref WHERE frame_profile_id = '$frameProfileId' AND siteid = '".$this->siteId."' ";
	  $queryRef = mysql_db_query($this->dbApp,$sqlRef)or die(mysql_error());
	  $strRef = "";
	  while($rowsRef = mysql_fetch_array($queryRef)){
	    $strRef .= "<a href=\"#\"><font color=\"#FFFFCC\">".$rowsRef['profile_ref_name']."</font></a><br>";
      }
	  $this->arrDataExp['��ҧ�ԧ�֧'] = $strRef;
	  
	  
	  
	  if($find == 1){
	   return true;
	  }else{
	   $this->errCode = 1;
	   return false;
	  }  
	 }else{
	   $this->errCode = 2;
	   return false;
	 }
	}else{
	 $this->errCode = 2;
	 return false;
	}
	  			
  }
  
 /**
 * @return array
 */
  public function getExp(){
    return $this->arrDataExp;
  }
  
  /**
   * �ʴ�������
 *
 * @return string
 */
  public function showExp(){
   switch($this->errCode){
   	case '0':
	echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\">";
	  foreach($this->arrDataExp as $key=>$value){
  		echo "<tr>";
    		echo "<td width=\"32%\" valign=\"top\">".$key."</td>";
    		echo "<td width=\"68%\" valign=\"top\">";
			  if(is_array($value)){	
				echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\">";
				  $i = 1;
				  foreach($value as $subValue){
  					echo "<tr";
					      if($i%2 == 1){
						    echo " bgcolor=\"#aecde4\" ";
						  }else{
						    echo " bgcolor=\"#cbe1f2\" ";
						  }
					echo " style='color:#000000;' >";
    					echo "<td width=\"55%\">".$subValue[0]."</td>";
    					echo "<td width=\"25%\">".$subValue[1]."</td>";
    					echo "<td width=\"20%\" align=\"right\">".$subValue[2]."</td>";
  					echo "</tr>";
					$i++;
				  }	
				echo "</table>";
			  }else{
			   echo $value;
			  }	
			echo "</td>";
 		 echo "</tr>";
	  }	 
	echo "</table>";	
	break;
	case '1':
	 echo "�������͹���ç��ͺ <br><font color=\"#000000\"><b><u><em>����й�</em></u></b> ��Ǩ�ͺ�������¹���˹� ˹��§ҹ����֡�ҷ���Ѻ����觵�駵�ͧ�ըӹǹ���˹� ����Թࡳ���ѵ�ҡ��ѧ ���͡�ͺ�ѵ�ҡ��ѧ��� �.�.�. ��˹�</font>";
	break;
	case '2':
	 echo "<center><font color='#cc0000'><b>��辺�����š�ͺ�ѵ�ҡ��ѧ</b></font></center>";
	break;
   }	
  }
  
  
}

 
?>