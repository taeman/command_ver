<?php
/**
* @comment class คำแนะนำของการปรับปรุงการกําหนดตําแหน่งข้าราชการครูและบุคลากรทางการศึกษาตําแหน่งรองผู้อํานวยการสถานศึกษาที่ว่าง
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Pinya
* @access private
* @created 29/09/2014
*/

class Order_improve_position4 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>เป็นการปรับปรุงการกําหนดตําแหน่งข้าราชการครูและบุคลากรทางการศึกษาตําแหน่งรองผู้อํานวยการสถานศึกษาที่ว่าง และไม่อยู่ในเกณฑ์ที่จะกําหนดให้มีตําแหน่งรองผู้อํานวยการสถานศึกษาได้เป็นตําแหน่งครูในสถานศึกษาเดิม โดยมีเงื่อนไขว่าเมื่อปรับปรุงกําหนดตําแหน่งแล้วจํานวนครูต้องไม่เกินเกณฑ์ที่ ก.ค.ศ. กําหนด และจํานวนตําแหน่งข้าราชการครูและบุคลากรทางการศึกษาต้องไม่เกินเกณฑ์อัตรากําลังที่ก.ค.ศ. กําหนด </font>";
		echo '</div>';
			
	}
	
}

?>