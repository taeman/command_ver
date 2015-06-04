<?php
/**
* @comment class ตรวจสอบเลื่อนขั้นเงินเดือนไม่เกิน 3 เปอร์เซ็น
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Kiatisak  Chansawnag
* @access private
* @created 26/03/2015
*/

class check38k3percent extends utility{
		public $percent;
	
		public function __construct($percent=""){
			$this->debug = "off";
			$this->percent = $percent;
			$this->dbNow = "cmss_".$this->siteNow;
		}
		
		public function checkExp(){
			$check=true;
			$check = ($this->percent > 3) ? false : true;
			return $check;
		}
		public function showExp(){
				echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
             	echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ตรวจสอบการเลื่อนเงินเดือนในหนึ่งรอบไม่เกิน 3 %</font>";
          	 	echo '</div>';
				

		}
	
}

?>