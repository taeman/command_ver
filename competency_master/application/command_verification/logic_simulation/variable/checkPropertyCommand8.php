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

class checkPropertyCommand8 extends utility{
	
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
             	echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ให้ตรวจสอบการให้ได้รับเงินเดือน ต้องสั่งให้ได้รับเงินเดือนในขั้นเดิม กรณีอัตราเงิรเดือนในขั้นเดิม ไม่มีกำหนดในอันดับนั้น ต้องสั่งให้ได้รับ้งินเดือนใกล้เคียง แต่ไม่สูงกว่า</font>";
          	 	echo '</div>';
		}
	
}

?>