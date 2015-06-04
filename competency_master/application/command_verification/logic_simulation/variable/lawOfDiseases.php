<?php
/**
* @comment classกฎ ก.ค.ศ. ว่าด้วยโรค
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Eakkasit Kamwong
* @access private
* @created 30/09/2014
*/

class lawOfDiseases extends utility{
	
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
             	echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ให้ตรวจสอบข้อมูลตามกฎ ก.ค.ศ.ว่าด้วยโรคตามด้านล่างนี้ <br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;โอาศัยอำนาจตามความในมาตรา ๑๙ (๔) และมาตรา ๓๐ (๕) แห่งพระราชบัญญัติระเบียบข้าราการครูและบุคลากรทางการศึกษา พ.ศ. ๒๕๔๗ ก.ค.ศ. โดยได้รับอนุมัติจากคณะรัฐมนตรีอกกกฎ ก.ค.ศ. ไว้ดังต่อไปนี้<br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;โรคตามมาตรา ๓๐ (๕) คือ<br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(๑) โรคเรื้อนในระยะติดต่อหรือในระยะที่ปรากฏอาการเป็นที่รังเกียจแก่สังคม<br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(๒) วัณโรคในระยะติดต่อ<br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(๓) โรคเท้าช้างในระยะที่ปรากฏอาการเป็นที่รังเกียจแก่สังคม<br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(๔) โรคติดยาเสพติดให้โทษ<br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(๕) โรคพิษสุราเรื้อรัง<br>
				</font>";
          	 	echo '</div>';
		}
	
}

?>