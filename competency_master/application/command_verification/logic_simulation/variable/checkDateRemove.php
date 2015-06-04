<?php
/**
 * ตรวจสอบวัน เดือน ปี กรณีการย้ายสับเปลี่ยน
 *
 * @author  -
 * @copyright 2011 Sapphire
 * @description ตรวจสอบวัน เดือน ปี กรณีการย้ายสับเปลี่ยน
 * @param string $letter_id, รหัสหนังสือคำสั่ง, 842
 * @return boolean
 "
 */
class checkDateRemove extends utility{
	public $letter_id;
	
	public function __construct($letter_id=""){
		$this->debug = "off";
		$this->letter_id = $letter_id;
	}
	
	public function dateFormat($date){
		$arr = explode('/',trim($date));
		$date = ($arr[2]-543).'-'.$arr[1].'-'.$arr[0];
		return date_create($date);
	}
	
	public function checkExp(){
		$arr_letter = $this->getInstructionDetail($this->letter_id);
		$date_start = $this->dateFormat($arr_letter['date_instruction']);
		$date_remove = $this->dateFormat($arr_letter['date_remove']);
		if($date_start>=$date_remove)return true;
		return false;
	}
	
	public function showExp(){
			
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
			echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>กรณีการย้ายสับเปลี่ยน วัน เดือน ปี ที่คำสั่งมีผลใช้บังคับ ต้องเป็นวัน เดือน ปีเดียวกัน ดังตัวอย่าง ดังนี้
ข้อมูล \"ตั้งแต่วันที่\" มากกว่าหรือเท่ากับ ข้อมูล \"ลงวันที่\" </font>";
			echo '</div>';
	}
	
}

?>