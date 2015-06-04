<?php
/**
* @comment ตรวจสอบการศึกษาต่อของผู้ลาศึกษา (ภาคนอกเวลา)
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author
* @access private
* @created 19/1/2558
*/

class checkFurtherEduOutTime extends utility{
	public $idcard;
	public $date_out;
	public $date_period;
	public $result;
	public $view_general;
	public $birth_day;
	public $caption;
	
	public function __construct($idcard="", $date_out=""){
		$this->debug = "off";
		$this->idcard = $idcard;
		$this->date_out = $date_out;
		$this->view_general = $this->getViewGeneralDetail($idcard);
		$this->caption = "ผู้ลาศึกษาจะต้องมีอายุน้อยกว่าหรือเท่ากับ 55 ปี นับถึงวันที่ 15 มิถุนายน ของปีที่เข้าการศึกษา";
	}
	
	public function checkExp(){
		
		$this->birth_day = $this->view_general['birthday'];
		
		$this->date_period = $this->getPeriodReal($this->birth_day, '2558-06-15');
		
		if($this->date_period[0] >= 55){
			$this->result= 'ไม่สามารถลาศึกษาต่อได้';
			return false;
		}
		$this->result= 'สามารถลาศึกษาต่อได้';
		return true;
	}
	
	public function showExp(){
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
			echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b> {$this->caption}</font><br>";
			echo "<font color=\"#6A3500\"><b>ข้อมูลจากระบบ : </b>เกิดวันที่ ";
			echo $this->dateConvert($this->birth_day, 'th-th-ddmmyy');
			echo " นับถึงวันที่ 15 มิถุนายน ของปีที่เข้าการศึกษา   : {$this->date_period[0]} ปี ";
			echo $this->date_period[1]>0? $this->date_period[1].' เดือน ':'';
			echo $this->date_period[2]>0? $this->date_period[2].' วัน':'';
			echo ' '.$this->result;
			echo '</div>';
	}
	
}

?>