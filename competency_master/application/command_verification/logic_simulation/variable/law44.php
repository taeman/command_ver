<?php
/**
* @comment class ตรวจสอบกฎหมายมาตรา 44
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Eakkasit Kamwong
* @access private
* @created 02/04/2014
*/

class law44 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ตรวจสอบอัตราเงินเดือนตามขั้นอันดับเงินเดือน เงินวิทยฐานะ และเงินประจำตำแหน่งตามกฎหมายว่าด้วยเงินเดือน เงินวิทยฐานะ และเงินประจำตำแหน่งข้าราชการครูและบุคลากรทางการศึกษา ตามมาตรา ๓๑ ให้เป็นไปตามที่ ก.ค.ศ. กำหนด โดยให้ได้รับเงินเดือนในขั้นต่ำของอันดับ ในกรณีที่จะให้ได้รับเงินเดือนสูงกว่าหรือต่ำกว่าขั้นต่ำหรือสูงกว่าขั้นสูงของอันดับ ให้เป็นไปตามหลักเกณฑ์และวิธีการที่กำหนดในกฎ ก.ค.ศ.</font>";
		echo '</div>';
			
	}
	
}

?>