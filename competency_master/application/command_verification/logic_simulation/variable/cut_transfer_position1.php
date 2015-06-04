<?php
/**
* @comment class คำแนะนำการตัดโอนตำแหน่งระหว่างเขตพื้นที่การศึกษา
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Pinya
* @access private
* @created 29/09/2014
*/

class cut_transfer_position1 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>กรณีตัดโอนตำแหน่งระหว่างสำนักงานเขตพื้นที่การศึกษา ต้องได้รับการอนุมัติจาก ก.ค.ศ. ก่อน จะต้องทำการตรวจสอบ \"หน่วยงานการศึกษา\" โดย 
\"หน่วยงานการศึกษาของสังกัดเดิม\" จะต้องเท่ากับ \"หน่วยงานการศึกษาของสังกัดใหม่\" </font>";
		echo '</div>';
			
	}
	
}

?>