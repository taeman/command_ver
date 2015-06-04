<?php
/**
* @comment class มาตรา 133
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Eakkasit Kamwong
* @access private
* @created 30/09/2014
*/

class law133 extends utility{
	
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
             	echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ให้ตรวจสอบว่าในระหว่างที่ยังมิได้ตราพระราชกฤษฎีกา หรื ก.ค.ศ. ยังมิได้ออกกฎ ข้อบังคับ ระเบียบ หรือจัดทำมาตรฐานตำแหน่งวิทยฐานะ หรือกำหนดกรณีใดเพื่อปฏิบัติตามพระราชบัญัตินี้ ให้นำพระราชกฤษฎีกา กฎ ก.พ. กฎ ก.ค. มติ ก.พ. มติ ก.ค. มติ คณะรัฐมนตรี ระเบียบ มาตรฐานกำหนดตำแหน่ง หรือกรณีที่ ก.ค. หรือ ก.พ. กำหนดไว้แล้ว ซึ่งใช้บังคับอยู่เดิมมาใช้บังคับโดยอนุโลม<br>
				&nbsp;&nbsp;&nbsp;&nbsp;ในกรณีที่มีปัญหาในด้านการดำเนินการตามวรรคหนึ่งให้ ก.ค.ศ. มีอำนาจวินิจฉัยชี้ขาด<br>
				&nbsp;&nbsp;&nbsp;&nbsp;ในกรณีที่ดำเนินการในเรื่องใดตามพระราชบัญญัตินี้กำหนดให้เป็นไปตามกฎ ก.ค.ศ. ถ้ายังมิได้มีกฎ ก.ค.ศ. ในเรื่องนั้นและไม่อานำความในวรรคหนึ่งมาใช้บังคับได้ ให้ ก.ค.ศ. ชั่วคราว ซึ่งทำหน้าที่ ก.ค.ศ. มีมติกำหนดการในเรื่องนั้นเพื่อใช้บังคับเป็นการชั่วคราวได้</font>";
          	 	echo '</div>';
		}
	
}

?>