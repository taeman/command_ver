<?php
/**
* @comment class ตรวจสอบการเลื่อนขั้นเงินเดือน กรณีได้รับเงินเดือนหรือค่าจ้างถึงขั้นสูง หรือใกล้ถึงขั้นสูงของอันดับหรือตำแหน่ง
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Eakkasit Kamwong
* @access private
* @created 02/04/2014
*/

class checkUpSalaryHightLevel extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ตรวจสอบผลการเลื่อนขั้นเงินเดือน กรณีได้รับเงินเดือนหรือค่าจ้างถึงขั้นสูง หรือใกล้ถึงขั้นสูงของอันดับหรือตำแหน่ง เป็นไปตามระเบียบกระทรวงการคลังว่าด้วยการเบิกจ่ายค่าตอบแทนพิเศษของข้าราชการครูและลูกจ้างประจำผู้ได้รับเงินเดือนหรือค่าจ้างถึงขั้นสูงหรือใกล้ถึงขั้นสูงของอันดับหรือตำแหน่ง พ.ศ.2550 และที่แก้ไขเพิ่มเติม</font>";
		echo '</div>';
			
	}
	
}

?>