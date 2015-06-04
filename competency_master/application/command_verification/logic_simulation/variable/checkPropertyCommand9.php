<?php
/**
* @comment class ตรวจสอบคำสั่งการโอน
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Eakkasit Kamwong
* @access private
* @created 29/09/2014
*/

class checkPropertyCommand9 extends utility{
	
		public function __construct($idcard=""){
		$this->debug = "off";
		$this->idcard = $idcard;
		$this->siteNow = $this->getSiteNow($this->idcard);
	    $this->dbNow = "cmss_".$this->siteNow;
	}
		
		public function checkExp(){
			return true;
		}
		public function showExp(){
				
			echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
             	echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ให้ตรวจสอบกรณีการรับโอนผู้สอบแข่งขันได้ หรือผู้ได้รับคัดเลือกนอกจากต้องตรวจสอบตามข้อ 1 - 7 แล้ว ให้ตรวจสอบรายละเอียดเพิ่มเติม ดังนี้<br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ประกาศผลการสอบแข่งขัน หรือการคัดเลือก<br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;หนังสือเรียกตัวมาบรรจุและแต่งตั้งตามลำดับที่</font>";
          	 	echo '</div>';
		}
	
}

?>