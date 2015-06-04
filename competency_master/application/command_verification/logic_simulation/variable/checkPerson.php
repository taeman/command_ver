<?php
/**
 * ตรวจสอบการดำรงตำแหน่งของผู้ย้าย
 *
 * @author  -
 * @copyright 2011 Sapphire
 * @description ตรวจสอบการดำรงตำแหน่งของผู้ย้าย
 * @param string $idcard, เลขบัตรประจำตัวประชาชน, 3720901110408 
 * @param string $position_date_old, วันที่ได้รับตำแหน่งเดิม, 2557-04-01 
 * @param string $letter_id, รหัสหนังสือคำสั่ง, 842
 * @return boolean
 "
 */
class checkPerson extends utility{
	public $idcard;
	public $position_date_old;
	public $letter_id;
	
	public function __construct($idcard="", $position_date_old="", $letter_id=""){
		$this->debug = "off";
		$this->idcard = $idcard;
		$this->position_date_old = $position_date_old;
		$this->letter_id = $letter_id;
	}
	
	public function dateFormat($date){
		$arr = explode('/',trim($date));
		$date = ($arr[2]-543).'-'.$arr[1].'-'.$arr[0];
		return date_create($date);
	}
	
	public function checkExp(){
		$date_old = explode('/',$this->position_date_old);
		$date_old = $date_old[0].'/'.$date_old[1].'/'.($date_old[2]+1);
		$date_old =  $this->dateFormat($date_old);
		
		$date_remove = $this->getInstructionDetail($this->letter_id);
		$date_remove =  $this->dateFormat($date_remove['date_remove']);
		 //$diff = date_diff($date_old, $date_remove);
		 if($date_remove>=$date_old)return true;
		 return false;
	}
	
	public function showExp(){
			
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
			echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ตรวจสอบผู้ขอย้้ายต้องดำรงตำแหน่งในหน่วยงานการศึกษาปัจจุบัน ไม่น้อยกว่า 12 เดือน นับถึงวันที่ยื่นคำขอ</font>";
			echo '</div>';
	}
	
}

?>