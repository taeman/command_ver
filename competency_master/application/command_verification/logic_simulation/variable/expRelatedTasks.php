<?php
/**
 * ���ʺ��ó��û�Ժѵԧҹ�������Ǣ�ͧ
 *
 * @author  -
 * @copyright 2011 Sapphire
 * @description ���ʺ��ó��û�Ժѵԧҹ�������Ǣ�ͧ
 * @param string $idcard, �Ţ�ѵû�Шӵ�ǻ�ЪҪ�, 3180500030751 
 * @param integer $positionId, ���ʵ��˹觷������͹, 525471147
 * @param integer $levelId, �����дѺ�������͹, 92255106
 * @param date $startDate, �ѹ����ռ�, 2010-04-21
 * @param integer $periodExp, ���ʺ��ó�㹵��˹�(��), 1
 * @return boolean
 "
 */
class expRelatedTasks extends expPosition{
  /**
 * @param string $idcard
 * @param string $positionId
 * @param string $levelId
 * @param string $startDate
 
 */
  public function __construct($idcard="",$positionId="",$levelId="",$startDate="",$periodExp=""){
    parent::__construct($idcard,$positionId,$levelId,$startDate,$periodExp = 1);
	
	#find Position
	$sqlOldPos = "SELECT pid FROM hr_addposition_now 
		          WHERE position_line IN(".$this->strPositionLineBefore.") ";
	$queryOldPos = mysql_db_query($this->dbMaster,$sqlOldPos)or die(mysql_error());
	while($rowsOldPos = mysql_fetch_array($queryOldPos)){
		$this->arrPosition[] = $rowsOldPos['pid']; 
	}
		   
	$strPositionId = implode(",",$this->arrPosition);
	
	##get List of Position
	$this->sql = "SELECT salary.*
	        FROM ".$this->dbNow.".salary AS salary 
			LEFT JOIN ".$this->dbMaster.".hr_addradub AS hr_addradub ON hr_addradub.level_id = salary.level_id
			WHERE salary.id = '".$this->idcard."' AND
			      salary.date <= '".$this->startDateTh."' AND
				  salary.date != '' AND
				  ( (hr_addradub.orderby < '".$this->orderLevel."' AND salary.position_id = '".$this->positionId."') OR salary.position_id IN($strPositionId)) 
		    GROUP BY salary.position_id
		    ORDER BY salary.date "; 
  }

} 
?>