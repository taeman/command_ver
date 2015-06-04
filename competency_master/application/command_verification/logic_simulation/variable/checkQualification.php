<?php
/**
* @comment class ตรวจสอบคำสั่ง
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Pinya
* @access private
* @created 16/03/2015
*/

class checkQualification extends utility{
	
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ตรวจสอบ วุฒิเดิม กับ วันที่ดำรงตำแหน่งปัจจุบัน กับ วุฒิที่เพิ่มขึ้น โดยมีเงื่อนไข ดังนี้ </br>
			1) ปวช. มากกว่าหรือเท่ากับ วันที่ดำรงตำแหน่งปัจจุบัน 1 ปี  จึงสามารถใช้วุฒิ ปวส. มายื่นขอปรับอัตราเงินเดือนได้</br>
			2) วุฒิป.ตรี มากกว่าหรือเท่ากับ วันที่ดำรงตำแหน่งปัจจุบัน 1 ปี   จึงสามารถใช้วุฒิ ป.โท. มายื่นขอปรับอัตราเงินเดือนได้</br>
			3) วุฒิป.โท มากกว่าหรือเท่ากับ วันที่ดำรงตำแหน่งปัจจุบัน 2 ปี   จึงสามารถใช้วุฒิ ป.เอก. มายื่นขอปรับอัตราเงินเดือนได้</br>
			4) วุฒิทั้งหมด ต้องเป็นไปตามที่ กพ. กำหนด
			</font>";
		echo '</div>';
			
	}
	
}




?>