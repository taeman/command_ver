<?php
/**
 * ตรวจสอบขึ้นเงินเดือนของข้าราชการที่รับโอน
 *
 * @author  -
 * @copyright 2011 Sapphire
 * @description ตรวจสอบขึ้นเงินเดือนของข้าราชการที่รับโอน
 * @param string $salary_increases, เงินเดือนที่เลื่อน, 27450
 * @param string $salary_income, เงินเดือนที่ได้รับ, 27450
 * @return boolean
 "
 */
class checkSalary extends utility{
	public $salary_increases;
	public $salary_income;
	
	public function __construct($salary_increases="", $salary_income=""){
		$this->debug = "off";
		$this->salary_increases = $salary_increases;
		$this->salary_income = $salary_income;
	}
	
	public function checkExp(){
		//return $this->salary_increases.'-'.$this->salary_income;
		if($this->salary_income<=$this->salary_increases)return true;
		return false;
	}
	
	public function showExp(){
			
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
			echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>หน่วยงานการศึกษาหรือส่วนราชการที่รับโอน ต้องส่งให้ได้รับเงินเดือนในขั้นเดิม ในกรณีอัตราเงินเดือนในขั้นเดิมไม่กำหนดอยู่ในอัดดับนั้น ต้องสั่งให้ได้รับเงินเดือนในขั้นที่น้อยกว่าหรือเท่ากับเงินเดือนขั้นเดิม และต้องน้อยกว่าหรือเท่ากับอัตราเงินเดือน ต้องตำแหน่งนั้นด้วย กรณีน้องเหนือจากนี้ให้ขออนุมัติ ก.ค.ศ. เป็นกรณีเฉพาะราย</font>";
			echo '</div>';
	}
	
}

?>