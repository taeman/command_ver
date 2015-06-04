<?php
/**
* @comment class ตรวจสอบคำสั่งเลื่อตำแหน่ง
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Eakkasit Kamwong
* @access private
* @created 30/09/2014
*/

class checkPropertyCommand10 extends utility{
	
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
             	echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ให้ตรวจสอบการเลื่อนระดับตำแหน่งเพื่อให้ได้รับเงินเดือนในระหว่างที่สูงขึ้น ต้องดำเนินการตามหลักเกณฑ์และวิธีการที่ ก.ค.ศ. กำหนด  </font>";
          	 	echo '</div>';
				

		}
	
}

?>