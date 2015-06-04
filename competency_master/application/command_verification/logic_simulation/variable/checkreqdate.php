<?php
/**
* @comment ตรวจสอบผูู้้ขอย้ายสับเปลี่ยนต้องเป็นผู้ที่มีอายุราชการเหลือไม่น้อยกว่า 12 เดือน นับถึงวันที่ 30 กันยายน ของปีที่ครบเกษียณอายุราชการ
* @projectCode 57CMSS12
* @tor  -
* @package core
* @author Wised Wisesvatcharajaren
* @access private
* @created 03/04/2015
*/
class checkreqdate extends utility{
	public function __construct($pin){
		$this->pin = $pin;
		$this->debug = "off";
		$this->dbNow = "cmss_".$this->getSiteNow($this->pin);
	}
	
	public function checkExp(){
		$sql = "SELECT
						startdate,
						CONCAT((SUBSTR(retire_label,LENGTH(retire_label)-4,LENGTH(retire_label)))-543,'-09-30') AS retireDate,
						DATE(NOW()) AS dateNow
					FROM
						general
					WHERE
					idcard = '".$this->pin."' ";
		$result = mysql_db_query($this->dbNow,$sql);
		$row = mysql_fetch_array($result);
		$arrDateDiff = $this->getPeriodReal($row['dateNow'],$row['retireDate']);
		if( (($arrDateDiff[0]*12)+$arrDateDiff[1]) >= 12 ){
			return true;
		}else{
			return false;
		}
	}
	
	 public function showExp(){
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ตรวจสอบวัันที่ยื่นคำขอให้ได้รับเงินเดือนและ /หรือปรังปรุงการกำหนดตำแหน่ง เลื่อนและแต่งตั้งให้ดำรงตำแหน่ง กรณีที่ได้รับคุณวุฒิเพิ่มชึ้น ภายใน 60 วัน กับวันที่สถานศึกษารับรองให้สำเร็จการศึกษา</font>";
		echo '</div>';
  	}
	
}

?>