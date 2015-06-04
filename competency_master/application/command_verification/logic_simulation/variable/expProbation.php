<?php
//include "../../../../config/conndb_nonsession.inc.php";
//include "../class/class.utility.php";

/**
 *�礻���ѵԡ�÷��ͧ���ѵ��Ҫ���
 *
 * @author  -
 * @copyright 2011 Sapphire
 * @description ��Ǩ�ͺ�������ҡ�÷��ͧ��Ժѵ��Ҫ���
 * @param string $idcard, �Ţ�ѵû�Шӵ�ǻ�ЪҪ�
 * @param integer $positionId, ���ʵ��˹觷������͹
 * @param integer $levelId, �����дѺ�������͹
 * @param date $startDate, �ѹ����ռ�
 * @param integer $periodExp, �������ҡ�÷��ͧ�ҹ
 * @return boolean
 "
 */
class expProbation extends utility{
  public $idcard;
  public $positionId;
  public $levelId;
  public $startDate;
  public $startDateTh;
  public $siteNow;
  public $dbNow;
  public $positionLineAfter;
  public $orderLevel;
  public $periodExp;
  public $arrDataExp = array();
  public $errMsg;
  
/**
 * @param string $idcard
 * @param string $positionId
 * @param string $levelId
 * @param string $startDate
 
 */
  public function __construct($idcard="",$positionId="",$levelId="",$startDate="",$periodExp=""){
    $this->idcard = $idcard;
	$this->positionId = $positionId;
	$this->levelId = $levelId;
	$this->startDate = $startDate;
	$this->periodExp = $periodExp;
	$this->siteNow = $this->getSiteNow($this->idcard);
	$this->dbNow = "cmss_".$this->siteNow;
	$this->startDateTh = $this->dateConvert($this->startDate,'en-th-ymd');
	$this->probationDate = $this->getProbationDate();
	$this->probationPassDate = $this->getProbationPassDate();
	$this->periodExp = 6;
	   
  }

  public function checkExp(){
	if($this->probationPassDate != ''){ 
	  $arrPeriodProbation = $this->getPeriodReal($this->probationDate,$this->probationPassDate);
	  $this->strPeriodProbation = $this->splitDate($arrPeriodProbation);
	  if((int)$arrPeriodProbation[0] > 0){
		  return true;
	  }else{
	     if((int)$arrPeriodProbation[1] >= $this->periodExp){
		     return true;
	     }else{
			 $this->errMsg = "�������ҷ��ͧ��Ժѵ�˹�ҷ���Ҫ������֧ ".$this->periodExp." ��͹";
	         return false;
	     }
	  }
	}else{
	  $this->errMsg = "�к���辺����觾鹨ҡ��÷��ͧ��Ժѵ�˹�ҷ���Ҫ��� <br><b><em><u>����й�</u></em></b> ��سҵ�Ǩ�ͺ������㹷���¹����ѵ� ��.7 �������´�ա����";	
	  return false;	
	}
  }
  
  public function getProbationDate(){
        $sql = "SELECT position,date FROM salary 
		        WHERE id = '".$this->idcard."' AND 
				      date != '' AND
					  date NOT LIKE '%--%' AND
					  date NOT LIKE '-%' AND
					  date NOT LIKE '%-'
				ORDER BY date
				LIMIT 0,1 ";
		$query = mysql_db_query($this->dbNow,$sql)or die(mysql_error());
		$rows = mysql_fetch_array($query);
		$this->positionStart = $rows['position'];
		return $this->dateConvert($rows['date'],'th-en-ymd');		
  }
  
  public function getProbationPassDate(){
	    $sql = "SELECT runno,position,date FROM salary 
		        WHERE id = '".$this->idcard."' AND 
				      date != '' AND
					  date NOT LIKE '%--%' AND
					  date NOT LIKE '-%' AND
					  date NOT LIKE '%-' AND
					  (order_type = '9' OR
					   noorder LIKE '%��%���ͧ%' OR 
	                   pls LIKE '%��%���ͧ%' OR 
		               label_salary LIKE '%��%���ͧ%' OR 
		               label_dateorder LIKE '%��%���ͧ%' OR 
		               label_noposition LIKE '%��%���ͧ%' OR 
					   noorder LIKE '%�ú%���ͧ%' OR 
	                   pls LIKE '%�ú%���ͧ%' OR 
		               label_salary LIKE '%�ú%���ͧ%' OR 
		               label_dateorder LIKE '%�ú%���ͧ%' OR 
		               label_noposition LIKE '%�ú%���ͧ%' OR
					   noorder LIKE '%���ͧ%�ú%' OR 
	                   pls LIKE '%���ͧ%�ú%' OR 
		               label_salary LIKE '%���ͧ%�ú%' OR 
		               label_dateorder LIKE '%���ͧ%�ú%' OR 
		               label_noposition LIKE '%���ͧ%�ú%')
				ORDER BY date
				LIMIT 0,1 ";	
		$query = mysql_db_query($this->dbNow,$sql)or die(mysql_error());
		$rows = mysql_fetch_array($query);
		if($rows['date'] != ''){
		 return $this->dateConvert($rows['date'],'th-en-ymd');
		}
  }
  
  public function getExp(){
    return $this->arrDataExp;
  }
  
  public function showExp(){
	echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;"><font color="#000000">';
    echo "<font color=\"#6A3500\"><b>���͹� :</b> ������������ҧ���ͧ��Ժѵ�˹�ҷ���Ҫ������͡������������������оѲ�����ҧ��� ��� ����ͺ�è��觵�駵�ͧ���ͧ��Ժѵ�˹�ҷ���Ҫ��������¡��� <font color=\"#000000\"><b>".$this->periodExp."</b></font> ��͹</font>";
    echo '</div>';

    echo '<table width="100%" border="0" cellspacing="0" cellpadding="3">';
    echo '<tr>';
    echo '<td width="38%" align="right"><strong>��è������ : </strong></td>';
    echo '<td width="19%">'.$this->dateConvert($this->probationDate,'en-th-ddmmyy').'</td>';
    echo '<td width="13%" align="right"><strong>㹵��˹� :</strong></td>';
    echo '<td width="30%">'.$this->positionStart.'</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td align="right"><strong>��ҹ��÷��ͧ���ѵ��Ҫ�������� : </strong></td>';
    echo '<td>'; 
	  if($this->probationPassDate != ''){ echo $this->dateConvert($this->probationPassDate,'en-th-ddmmyy');} 
	echo '</td>';
    echo '<td align="right">&nbsp;</td>';
    echo '<td>&nbsp;</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td align="right"><strong>����������ҡ�÷��ͧ��Ժѵ��Ҫ��÷����� : </strong></td>';
    echo '<td>'.$this->strPeriodProbation.'</td>';
    echo '<td align="right">&nbsp;</td>';
    echo '<td>&nbsp;</td>';
    echo '</tr>';
    echo '</table>';
	if($this->errMsg != ''){
      echo '<div style="border:1px solid #800000; color:#FF0000; padding:3px;"><img src="images/error.png" align="absmiddle" />&nbsp;'.$this->errMsg.'</div><br>';
	}
  }
  
  
}

//$objExp = new expProbation('3110102422358','525471007','92255111','2009-12-11','6');
//$objExp->checkExp();
//$objExp->showExp(); 
?>