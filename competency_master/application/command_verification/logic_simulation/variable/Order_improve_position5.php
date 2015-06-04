<?php
/**
* @comment class คำแนะนำของการปรับปรุงการกําหนดตําแหน่งข้าราชการครูและบุคลากรทางการศึกษาตําแหน่งครูที่ว่าง และเกินเกณฑ์อัตรากําลังที่ ก.ค.ศ. กําหนด
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Pinya
* @access private
* @created 29/09/2014
*/

class Order_improve_position5 extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
		
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>เป็นการปรับปรุงการกําหนดตําแหน่งข้าราชการครูและบุคลากรทางการศึกษาตําแหน่งครูที่ว่าง และเกินเกณฑ์อัตรากําลังที่ ก.ค.ศ. กําหนด เป็นตําแหน่งรองผู้อํานวยการสถานศึกษาในสถานศึกษาเดิม โดยมีเงื่อนไขว่าเมื่อปรับปรุงกําหนดตําแหน่งแล้ว จํานวนตําแหน่งรองผู้อํานวยการสถานศึกษาต้องไม่เกินเกณฑ์ที่ ก.ค.ศ. กําหนด และอัตรากําลังข้าราชการครูและบุคลากรทางการศึกษาของสถานศึกษาต้องไม่เกินเกณฑ์อัตรากําลังที่ก.ค.ศ. กําหนด </font>";
		echo '</div>';
			
	}
	
}

?>