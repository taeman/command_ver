<?php
/**
* @comment class มาตรา 64
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Eakkasit Kamwong
* @access private
* @created 28/03/2015
*/

class law64 extends utility{
	
		public function __construct($idcard=""){
		$this->debug = "off";
		$this->idcard = $idcard;
		$this->siteNow = $this->getSiteNow($this->idcard);
	    $this->dbNow = "cmss_".$this->siteNow;
	}
		
		public function checkExp(){
			return true;
		}
		public function showExp(){
				
			echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
             	echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ตรวจสอบว่าข้าราชการครูและบคลากรทางการศึกษาที่ออกจากราชการไปแล้ว มิใช่เป็นการออกจากราชการในระหว่างทดลองปฏิบัติหน้าที่ราชการ เมื่อสมัครเข้ารับราชการเป็นข้าราชการครูและบุคลากรทางการศึกษา ทางราชการประสงค์จะรับผู้นั้นเข้ารับราชการ ตามหลักเกณฑ์และวิธีการที่ก.ค.ศ. กําหนด
				</font>";
          	 	echo '</div>';
		}
	
}

?>