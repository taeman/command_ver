<?php
/**
* @comment class ตรวจสอบคำสั่ง
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Eakkasit Kamwong
* @access private
* @created 29/09/2014
*/

class checkPropertyCommand6 extends utility{
	
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
             	echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ให้ตรวจสอบการให้ได้รับเงินเดือน ผู้ไปปฏิบัติงานตามมติคณะรัฐมนตรี ให้ได้รับเงินเดือนในรอบการประเมินผลการปฏิบัติราชการ ไม่เกินร้อยละ 3 ของฐานเงินเดือนที่ผู้นั้นรับอยู่ก่อนออกจากราชการทั้งนี้ต้องไม่ สูงกว่าเงินเดือนขั้นสูงสุดของตำแหน่ง ประเภทสายงานและอันดับที่บรรจุกลับในกรณีที่มีการปรับบัญชีเงินเดือนขั้นต่ำ ขั้นสูง ก็ให้ปรับเงินเดือนที่ได้รับอยู่เดิมเข้าสู่อัตราในบัญชีที่ปรับใหม่ด้วย</font>";
          	 	echo '</div>';
		}
	
}

?>