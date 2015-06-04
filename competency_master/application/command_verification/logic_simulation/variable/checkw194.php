<?php
/**
* @comment ว 19/4 พฤศจิกายน 2548 (การโอนผู้สอบแข่งขันได้หรือผู้ได้รับคัดเลือก)
* @projectCode 57CMSS12
* @tor  -
* @package core
* @author Kiatisak Chansawang
* @access private
* @created 02/04/2015
*/
class checkw194 extends utility{
	public function __construct(){
		$this->debug = "off";
	}
	
	public function checkExp(){
		return true;
	}
	
	 public function showExp(){
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ตรวจสอบการให้รับเงินเดือนตามตำแหน่งและคุณวุฒิที่สอบแข่งขันได้หรือได้รับคัดเลือก หากได้รับเงินเดือนสูงกว่าอัตราเงินเดือนตามตำแหน่งและคุณวุฒิที่สอบแข่งขันได้ ให้รับเงินเดือนในอันดับและขั้นเดิม แต่ต้องไม่สูงกว่าอันดับและขั้นสูงสุดของเงินเดือนสำหรับตำแหน่งที่สอบแข่งขันได้หรือได้รับคัดเลือก</font>";
		echo '</div>';
  	}
	
}
?>