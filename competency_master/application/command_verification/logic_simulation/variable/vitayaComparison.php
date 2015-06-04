<?php
/**
* @comment เปรียบเทียบวิทยฐานะของตำแหน่งเดิมกับวิทยฐานะที่บรรจุและแต่งตั้งใหม่
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Supachai
* @access private
* @created 12/1/2558
*/

class vitayaComparison extends utility{
	public $idcard;
	public $oldVitaya;
	public $newVitaya;
	public $vitaya_arr = array('1'=>'ชำนาญการ','2'=>'ชำนาญการพิเศษ','3'=>'เชี่ยวชาญ','4'=>'เชี่ยวชาญพิเศษ');
	
	public function __construct($idcard="", $oldVitaya="", $newVitaya=""){
		$this->debug = "off";
		$this->idcard = $idcard;
	    $this->oldVitaya = $oldVitaya;
		$this->newVitaya = $newVitaya;
	}
	
	public function checkExp(){
		if($this->newVitaya <= $this->oldVitaya) return true;
		return false;
	}
	
	public function showExp(){
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
			echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b> นำข้อมูลวิทยฐานะของตำแหน่งสังกัดเดิมโดยมาเปรียบเทียบวิทยฐานะของตำแหน่งที่บรรจุและแต่งตั้งโดยเปรียบเทียบจากวิทยฐานะที่บรรจุใหม่</font><br>";
			echo "<font color=\"#6A3500\"><b>ข้อมูลจากระบบ : </b>วิทยฐานะเดิมในระบบ : {$this->vitaya_arr[$this->oldVitaya]} / วิทยฐานะที่จะบรรจุ : {$this->vitaya_arr[$this->newVitaya]}</font>";
			echo '</div>';
	}
	
}

?>