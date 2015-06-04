<?php
class expRelatedTasks extends expPosition{
  
  public function __construct($idcard="",$positionId="",$levelId="",$startDate="",$periodExp=""){
    $periodExp = 1;
    parent::__construct($idcard,$positionId,$levelId,$startDate,$periodExp);
	##get List of Position
	$this->sql = "SELECT salary.*
	        FROM ".$this->dbNow.".salary AS salary 
			WHERE salary.id = '".$this->idcard."' AND
			      salary.date <= '".$this->startDateTh."' AND
				  salary.date != '' AND
				  salary.position_id = '".$this->positionId."' 
		    GROUP BY salary.position_id
		    ORDER BY salary.date "; 
  }

} 
?>