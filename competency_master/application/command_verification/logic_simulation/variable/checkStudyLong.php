<?php
/**
* @comment class ตรวจสอบการสไลต์ข้ามแท่งไม่ถูกต้อง
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Kiatisak  Chansawnag
* @access private
* @created 22/01/2015
*/
class checkStudyLong extends utility{
	
		public function __construct($education_level_id,$date_out,$date_return){
			$this->debug = "off";
			$this->education_level_id = $education_level_id;
			$this->date_out = $date_out;
			$this->date_return = $date_return;
			$this->dbNow = "cmss_".$this->siteNow;
			
		}
		
		public function checkExp(){
			if($this->education_level_id == '' || $this->date_out == '' || $this->date_return == ''){
				return false;
			}else{
				//echo $this->date_out.':'.$this->date_return.' = ';				
				$d1 = $this->date_out;
				$d2 = $this->date_return;
				
			    $month = (int)abs((strtotime($d1) - strtotime($d2))/(60*60*24*30));
	
				if($this->education_level_id == '40' && $month <= 24){
					return true;
				}elseif($this->education_level_id == '60' && $month <= 24){
					return true;
				}elseif($this->education_level_id == '80' && $month <= 48){
					return true;
				}else{
					return false;
				}
			}
		}
		
		public function showExp(){
				
			echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
             	echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ตรวจสอบความสัมพันธ์ระหว่างระยะเวลาที่ลาศึกษาต่อ และระดับการศึกษา</font>";
          	 	echo '</div>';
		}
	
}

?>