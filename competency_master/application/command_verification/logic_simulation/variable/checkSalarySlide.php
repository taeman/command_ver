<?php
/**
* @comment class ตรวจสอบการสไลต์ข้ามแท่งไม่ถูกต้อง
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Kiatisak  Chansawnag
* @access private
* @created 21/01/2015
*/

class checkSalarySlide extends utility{
		public $radub_id;
		public $money_befor;
		public $money_after;
	
		public function __construct($radub_id="",$money_befor="",$money_after=""){
			$this->debug = "off";
			$this->radub_id = $radub_id;
			$this->money_befor = $money_befor;
			$this->money_after = $money_after;
			$this->dbNow = "cmss_".$this->siteNow;
		}
		
		public function checkExp(){
			$check=true;
			$sql="SELECT
			t1.radub_id_now,
			t1.radub_now,
			t1.maxmoney
			FROM
			up_levelmoney_slide AS t1
			WHERE radub_id_now='".$this->radub_id."' ";
			$result=mysql_db_query(DB_MASTER,$sql)or die(mysql_error().__LINE__);
			$row=mysql_fetch_assoc($result);
			if($this->money_befor<$row[maxmoney] && $this->money_after>$row[maxmoney]){
				$check=false;
			}
			
			if($radub_id!='91254705'){
				$sql="SELECT
				t1.radub_now,
				t1.runno_upper,
				t3.maxmoney
				FROM
				up_levelmoney_upper AS t1
				INNER JOIN hr_addradub AS t2 ON t1.radub_now = t2.radub
				INNER JOIN up_levelmoney_slide AS t3 ON t1.radub_upper = t3.radub_now
				WHERE t2.level_id='".$this->radub_id."' ";
				$result=mysql_db_query(DB_MASTER,$sql)or die(mysql_error().__LINE__);
				$row=mysql_fetch_assoc($result);
				if($this->money_after>$row[maxmoney]){
					$check=false;
				}
			}
			return $check;
		}
		public function showExp(){
				echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
             	echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ให้ตรวจสอบความสัมพันธ์ระหว่างตำแหน่ง ระดับ และเงินเดือนที่ได้รับ ในกรณีที่บุคลากรได้รับเงินเดือนสูงกว่าขั้นกว่าขั้นสูงของอันดับ</font>";
          	 	echo '</div>';
				

		}
	
}

?>