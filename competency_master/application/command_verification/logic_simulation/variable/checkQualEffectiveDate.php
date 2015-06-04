<?php
/**
* @comment ตรวจสอบการขยายการศึกษา
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Supachai
* @access private
* @created 16/3/2558
*/

class checkQualEffectiveDate extends utility{
	public $effective_date;
	public $idcard;
	public $date_period;
	public $result;
	public $comeday;
	public $caption;
	
	public function __construct($idcard="", $effective_date=""){
		$this->debug = "off";
		$this->effective_date = $effective_date;
		$this->idcard = $idcard;

		$this->caption = "คุณวุฒิที่เพิ่มขึ้น สามารถตรวจสอบได้โดย ตั้งแต่วันที่หลังวันที่ดำรงตำแหน่งปัจจุบัน";
	}
	
	public function checkExp(){
		$general = $this->getViewGeneralDetail($this->idcard);
		$this->comeday = $general[comeday_c];
		$this->date_period = $this->getPeriodReal($this->comeday, $this->effective_date);
		
		if($this->date_period[2] > 1 || $this->date_period[1] > 1 || $this->date_period[0] > 1){
			$this->result= 'สามารถขยายการศึกษาต่อได้';
			return true;
		}
		$this->result= 'ไม่สามารถขยายการศึกษาต่อได้';
		return false;	
	}
	
	public function showExp(){
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
			echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b> {$this->caption}</font><br>";
			echo "<font color=\"#6A3500\"><b>ข้อมูลจากระบบ : </b>ขอขยายการศึกษาต่อตั้งแต่วันที่ ";
			echo $this->dateConvert($this->comeday, 'en-th-ddmmyy');
			echo " ถึงวันที่ ";
			echo $this->dateConvert($this->effective_date, 'en-th-ddmmyy');
			echo " เป็นระยะเวลา : {$this->date_period[0]} ปี ";
			echo $this->date_period[1]>0? $this->date_period[1].' เดือน ':'';
			echo $this->date_period[2]>0? $this->date_period[2].' วัน':'';
			echo ' '.$this->result;
			echo '</div>';
	}
	
}

?>