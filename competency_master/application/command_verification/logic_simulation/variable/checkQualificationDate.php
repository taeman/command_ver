<?php
/**
* @comment class ตรวจสอบวันที่ได้รับวุฒิเพิ่ม
* @projectCode 58CMSS12
* @tor  -
* @package core
* @author Wised Wisesvatcharajaren
* @access private
* @created 02/04/2015
*/

class checkQualificationDate extends utility{
		public $edu_finish;
		public $pin;
	
		public function __construct($edu_finish="",$pin=""){
			$this->debug = "on";
			$this->edu_finish = $edu_finish;
			$this->pin = $pin;
			$this->dbNow = "cmss_".$this->getSiteNow($this->pin);
		}
		
		public function checkExp(){
			$arr = explode('-',$this->edu_finish);
			$strDate = ($arr[0]+543).'-'.$arr[1].'-'.$arr[2];
			$sql = " SELECT
							IF(COUNT(CZ_ID)>0,true,false) AS checkDate
						FROM view_general
						WHERE CZ_ID = '".$this->pin."'
						AND '".$strDate."' >= startdate ";
			$result = mysql_db_query($this->dbNow,$sql) or die(mysql_error().' || sql = '.$sql.' || '.__LINE__);
			$row = mysql_fetch_object($result);
			$val = $row->checkDate;
			if($val=='1'){
				return true;
			}else{
				return false;
			}
		}
		public function showExp(){
				echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
             	echo "<font color=\"#6A3500\"><b>เงื่อนไข :</b>ตรวจสอบวันที่ได้รับคุณวุฒิเพิ่มขึ้น กับวันที่บรรจุและแต่งตั้ง โดยวันที่ได้รับคุณวุฒิเพิ่มขึ้นจะต้องไม่น้อยกว่าวันที่บรรจุและแต่งตั้ง</font>";
          	 	echo '</div>';
		}
	
}

?>