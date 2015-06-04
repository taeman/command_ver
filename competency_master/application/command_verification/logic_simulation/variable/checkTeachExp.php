<?php
/**
* @comment ตรวจสอบประสิบการณ์ในการสอน
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author
* @access private
* @created 14/1/2558
*/

class checkTeachExp extends utility{
	public $idcard;
	public $effective_date;
	public $month_diff;
	
	public function __construct($idcard="", $effective_date=""){
		$this->debug = "off";
		$this->idcard = $idcard;
		$this->effective_date = $effective_date;
	}
	
	public function checkExp(){
		// $sql="SELECT 
				// if(pid LIKE '4%' AND abs(period_diff(
					// date_format(comeday, '%Y%m'),
					// date_format(DATE_ADD('{$this->effective_date}', INTERVAL 543 YEAR), '%Y%m')
				// )) >= 24, 1, 0) AS teach_exp,
				// abs(period_diff(
					// date_format(comeday, '%Y%m'),
					// date_format(DATE_ADD('{$this->effective_date}', INTERVAL 543 YEAR), '%Y%m')
				// )) as month_diff
			// FROM view_general
			// WHERE CZ_ID = '{$this->idcard}'";
		// $result = mysql_db_query($this->dbMaster, $sql);
		// $row = mysql_fetch_assoc($result);
		// $this->month_diff = $row['month_diff'];
		// return $row['teach_exp']==1?true:false;
		
		return true;
	}
	
	public function showExp(){
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
			echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>กรณีรับโอนเป็นตำแหน่งประเภทสายการสอนให้ตรวจสอบประสบการณ์ทำงานต้องไม่น้อยกว่า 2 ปี นับถึงวันที่ยื่นคำขอ</font><br>";
			//echo "<font color=\"#6A3500\"><b>ผลการตรวจสอบจากระบบ :</b>อายุของตำแหน่งงานปัจจุบัน : {$this->month_diff} เดือน</font><br>";
			echo '</div>';
	}
	
}

?>