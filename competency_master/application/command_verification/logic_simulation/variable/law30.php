<?php
/**
* @comment class มาตรา 30
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Eakkasit Kamwong
* @access private
* @created 26/09/2014
*/
class law30 extends utility{
	public function __construct($idcard="", $birthday="", $letter_id=""){
		$this->debug = "off";
		$this->idcard = $idcard;
		$this->birthday = $birthday;
		$this->siteNow = $this->getSiteNow($this->idcard);
		$ins = $_GET['service'] == 'c2' ? $this->getLetterDetail($letter_id) : $this->getInstructionDetail($letter_id);
		$cur_site = empty($this->siteNow) ? $ins['siteid'] : $this->siteNow;
	    $this->dbNow = "cmss_".$cur_site;
		$this->age = $this->checkAge();
		$this->nation = $this->checkNation();
		$this->prohibit = $this->checkProhibit();
		$this->prohibit2 = $this->checkProhibit2();
	}
	
	public function checkNation(){
				$sql = "SELECT nationality FROM general WHERE idcard ='".$this->idcard."'" ;
				$query = mysql_db_query($this->dbNow,$sql)or die(mysql_error());
				$rs = @mysql_fetch_assoc($query);
				$nationality = empty($rs["nationality"]) ? 'ไม่พบข้อมูลในระบบ' : $rs["nationality"];
				return $nationality;
	}
		public function checkAge(){
				$sql = "SELECT  TIMESTAMPDIFF(YEAR, CONCAT(LEFT(birthday,4)-543,RIGHT(birthday,6)) , CURDATE())  AS age FROM general WHERE idcard = '".$this->idcard."'" ;
				$query = mysql_db_query($this->dbNow,$sql)or die(mysql_error());
				$rs = mysql_fetch_assoc($query);
				if(@mysql_num_rows() > 0){
					$age = $rs["age"];
					return $age;					
				}else{
					$arr = $this->getPeriodReal($this->birthday, date('Y-m-d')); //, strtotime('+543 years')
					return $arr[0];
				}
	}
	
	public function checkProhibit(){
				$sql = "SELECT  prohibit_type FROM hr_prohibit  WHERE id = ".$this->idcard ;
				$query = mysql_db_query($this->dbNow,$sql)or die(mysql_error());
				while($rs = mysql_fetch_assoc($query)){
					if($rs["prohibit_type"] == 4 ){
						return false;
					}else if( $rs["prohibit_type"] == 12){
						$sql_type = "SELECT  yy FROM hr_prohibit  WHERE id = '".$this->idcard."' and prohibit_type = 11 order by yy desc limit 1" ;
						$query_type = mysql_db_query($this->dbNow,$sql_type)or die(mysql_error());
						$rs_type = mysql_fetch_assoc();
						if($rs_type["yy"] != "" && $rs_type["yy"] != "0000-00-00"){
							$date_in = explode("-",$rs_type["yy"]);
							if($date_in[1]  == "00" && $date_in[2] == "00"){
								if(($date_in[0]-543)<date('Y',time())){
									continue;
								}else{
									return false;	
								}
							}else if($date_in[2] == "00"){
								$date_check  = "";
								$date_cur = "";
									$date_check = mktime(0,0,0,$date_in[1],01,($date_in[2]-543));
									$date_cur  = mktime(0,0,0,date('m',time()),01,date('Y',time()));
									if($date_check  < $date_cur){
										continue;
									}else{
										return false;
									}
							}else{
								$date_check  = "";
								$date_cur = "";
									$date_check = mktime(0,0,0,$date_in[1],$date_in[2],($date_in[0]-543));
									$date_cur  = mktime(0,0,0,date('m',time()),date('d',time()),date('Y',time()));
									if($date_check  < $date_cur){
										continue;
									}else{
										return false;
									}
								}
							
						}else{
							continue;	
						}
						return false;
					}else{
						continue;
					}
				}
			return true;
	}
	
	public function checkProhibit2(){
		$sql = "SELECT  prohibit_type FROM hr_prohibit  WHERE id = '".$this->idcard."'  AND (prohibit_type = 4 OR prohibit_type = 5 OR prohibit_type = 6) "		;
				$query = mysql_db_query($this->dbNow,$sql)or die(mysql_error());
				$count_prohibit = mysql_num_rows($query);
				if($count_prohibit > 0){
					return false;
				}else{
					return true	;
				}
	}

	
	public function checkExp(){
		if($this->nation != "ไทย" && $_GET[service] != 'c2'){
			return false;
		}else if($this->age < 18){
			return false;
		}else if($this->prohibit == false){
			return false;
		}else{
			return true;	
		}
		
	}
	
	 public function showExp(){
           		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
				if($_GET[service] == 'c2')
					echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ : </b>ต้องมีสัญชาติไทย  </font>";
				else
					echo "<font color=\"#6A3500\"><b>เงื่อนไข :</b>มีสัญชาติไทย  </font>";
           		echo '</div>';
			  
			 	echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;margin-top:5px;text-align: left;"><font color="#000000">';
             	echo "<font color=\"#6A3500\"><b>เงื่อนไข :</b> ต้องมีอายุไม่ต่ำกว่าสิปแปดปีบริบูรณ์  </font>";
          	 	echo '</div>';
			   	echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\">";
			   	echo "<tr>";
              	echo "<td colspan=\"5\"><b>มีอายุ เท่ากับ </b>". $this->age ." ปี</td>";
              	echo "</tr>";
              	echo "</table>";
				
					echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
					echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ต้องไม่เป็นผู้อยู่ในระหว่างถูกสั่งพักราชการ ถูกสั่งให้ออกจากราชการ ถูกสั่งให้ออกจากราชการไว้ก่อนตามพระราชบัญญัตินี้ หรือตามกฏหมายอื่น หรือถูกสั่งพัก หรือเพิกถอนใบอนุญาตประกอบวิชาชิพตามหลักเกณฑ์ที่กำหนดในกฏหมายองค์กรวิชาชีพนั้นๆ  </font>";
					echo '</div>';
	
				// if($this->prohibit == false){
					// echo "<table width=\"98%\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\">";
					// echo "<tr>";
					// echo "<td>ลำดับ</td>";
					// echo "<td>ความผิด</td>";
					// echo "<td>เอกสารอ้างอิง</td>";
					// echo "<td>วันที่</td>";
					// echo "</tr>";
					// $sql_prohibit = "SELECT   comment,refdoc,label_yy,yy FROM hr_prohibit  WHERE id = '".$this->idcard."' AND (prohibit_type = 4 OR  prohibit_type = 12)";
					// $query_prohibit = mysql_db_query($this->dbNow,$sql_prohibit);
					// $i_prohibit = 0;
					// while($rs_prohibit = mysql_fetch_assoc($query_prohibit)){
						// if($rs_prohibit["label_yy"] != ""){
							// $date_show_prohibit = $rs_prohibit["label_yy"];
						// }else{
							// $date_show_prohibit = $this->dateConvert($rs_prohibit["yy"],'th-th-ddmmyy');
						// }
					// echo "<tr>";
					// echo "<td >".++$i_prohibit."</td>";
					// echo "<td >".$rs_prohibit["comment"]."</td>";
					// echo "<td >".$rs_prohibit["refdoc"]."</td>";
					// echo "<td >".$date_show_prohibit."</td>";
					// echo "</tr>";
					// }
					// echo "</table>";
				// }else{
					// echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\">";
					// echo "<tr>";
					// echo "<td colspan=\"5\"><b>ไม่พบข้อมูลการอยู่ระหว่างพักราชการ หรือ ถูกสั่งให้ออกราชการ </b></td>";
					// echo "</tr>";
					// echo "</table>";
				// }
			 		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;margin-top:5px;text-align: left;"><font color="#000000">';
					echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ต้องไม่เป็นผู้เคยถูกลงโทษให้ออก ปลดออก หรือไล่ออกเพราะการกระทำผิดวินัยตามพระราชบัญญัตินี้หรือตามกฏหมายอื่น  </font>";
					echo '</div>';
				 // if($this->prohibit2 == false){
					// echo "<table width=\"98%\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\">";
					// echo "<tr>";
					// echo "<td>ลำดับ</td>";
					// echo "<td>ความผิด</td>";
					// echo "<td>เอกสารอ้างอิง</td>";
					// echo "<td>วันที่</td>";
					// echo "</tr>";
					// $sql_prohibit2 = "SELECT  comment,refdoc,label_yy,yy FROM hr_prohibit  WHERE id = '".$this->idcard."' AND (prohibit_type = 4 OR prohibit_type = 5 OR prohibit_type = 6)";
					// $query_prohibit2 = mysql_db_query($this->dbNow,$sql_prohibit2);
					// $i_prohibit2 = 0;
					// while($rs_prohibit2 = mysql_fetch_assoc($query_prohibit2)){
						// if($rs_prohibit2["label_yy"] != ""){
							// $date_show_prohibit2 = $rs_prohibit2["label_yy"];
						// }else{
							// $date_show_prohibit2 = $this->dateConvert($rs_prohibit2["yy"],'th-th-ddmmyy');
						// }
							
					// echo "<tr>";
					// echo "<td >".++$i_prohibit2."</td>";
					// echo "<td >".$rs_prohibit2["comment"]."</td>";
					// echo "<td >".$rs_prohibit2["refdoc"]."</td>";
					// echo "<td >".$date_show_prohibit2 ."</td>";
					// echo "</tr>";
					// }
					// echo "</table>";
				// }else{
					// echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\">";
					// echo "<tr>";
					// echo "<td colspan=\"5\"><b>ไม่พบข้อมูลการถูกลงโทษ</b></td>";
					// echo "</tr>";
					// echo "</table>";
				// }	
			  
			   	echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;margin-top:5px;text-align: left;"><font color="#000000">';
             	echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ให้ตรวจสอบว่าเป็นผู้เลื่อมใสในการปกครองระบบประชาธิปไตยอันมีพระมหากษัตริย์ทรงเป็นประมุขตามรัฐธรรมนูญแห่งราชอาณาจักรไทย  </font>";
          	 	echo '</div>';
			   	echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\">";
			   	echo "<tr>";
              	echo "<td colspan=\"5\"><b> </b></td>";
             	echo "</tr>";
              	echo "</table>";
			  
				echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';			  
				echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ให้ตรวจสอบว่าไม่เป็นผู้ดำรงตำแหน่งทางการเมือง สมาชิกสภาท้องถิ่น หรือผู้บริหารท้องถิ่น  </font>";
          	 	echo '</div>';
			   	echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\">";
			   	echo "<tr>";
              	echo "<td colspan=\"5\"><b> </b></td>";
              	echo "</tr>";
              	echo "</table>";
			    
				echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
				echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ให้ตรวจสอบว่าไม่เป็นคนไร้ความสามารถ หรือจิตฟั่นเฟือนไม่สมประกอบ หรือเป็นโรคตามที่กำหนดในกฏ ก.ค.ศ.  </font>";
          	 	echo '</div>';
			   	echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\">";
			   	echo "<tr>";
              	echo "<td colspan=\"5\"><b> </b></td>";
              	echo "</tr>";
              	echo "</table>";
			     
				 echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
				 echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ให้ตรวจสอบว่าไม่เป็นผู้บกพร่องในศีลธรรมอันดีสำหรับผู้ประกอบวิชาชีพครูและบุคลากรทางการศึกษา  </font>";
          	 	echo '</div>';
			   	echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\">";
			   	echo "<tr>";
              	echo "<td colspan=\"5\"><b> </b></td>";
              	echo "</tr>";
              	echo "</table>";
			   	
				echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
				echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ให้ตรวจสอบว่าไม่เป็นกรรมการบริหารพรรคการเมืองหรือเจ้าหน้าที่ในพรรคการเมือง  </font>";
          	 	echo '</div>';
			   	echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\">";
			   	echo "<tr>";
              	echo "<td colspan=\"5\"><b> </b></td>";
             	 echo "</tr>";
              	echo "</table>";
			    
				echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
				echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ให้ตรวจสอบว่าไม่เป็นบุคคลล้มละลาย  </font>";
          	 	echo '</div>';
			   	echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\">";
			   	echo "<tr>";
              	echo "<td colspan=\"5\"><b> </b></td>";
              	echo "</tr>";
              	echo "</table>";
			    
				echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
				echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ให้ตรวจสอบว่าไม่เป็นผู้เคยต้องโทษจำคุกโดยคำพิพากษาถึงที่สุดให้จำคุก เว้นแต่เป็นโทษสำหรับความผิดที่ได้กระทำโดยประมาทหรือความผิดลหุโทษ  </font>";
          	 	echo '</div>';
			   	echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\">";
			   	echo "<tr>";
              	echo "<td colspan=\"5\"><b> </b></td>";
              	echo "</tr>";
              	echo "</table>";
			     
				 echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
				echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ให้ตรวจสอบว่าไม่เป็นผู้เคยถูกลงโทษให้ออก ปลดออก หรือไล่ออกจากรัฐวิสหกิจ องค์กรมหาชน หรือหน่วยงานอื่นของรัฐ หรือองค์การระหว่างประเทศ  </font>";
          	 	echo '</div>';
				echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\">";
				echo "<tr>";
				echo "<td colspan=\"5\"><b> </b></td>";
				echo "</tr>";
				echo "</table>";
			   
			    echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
			  	echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>ให้ตรวจสอบว่าไม่เป็นผู้เคยกระทำการทุจริตในการสอบเข้ารับข้าราชการหรือเข้าปฏิบัติงานในหน่วยงานของรัฐ  </font>";
          		echo '</div>';
			   	echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\">";
			   	echo "<tr>";
              	echo "<td colspan=\"5\"><b> </b></td>";
             	echo "</tr>";
              	echo "</table>";
  }
	
}
?>