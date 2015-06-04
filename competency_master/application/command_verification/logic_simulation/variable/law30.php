<?php
/**
* @comment class �ҵ�� 30
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
				$nationality = empty($rs["nationality"]) ? '��辺��������к�' : $rs["nationality"];
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
		if($this->nation != "��" && $_GET[service] != 'c2'){
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
					echo "<font color=\"#6A3500\"><b>����ʹ��� : </b>��ͧ���ѭ�ҵ���  </font>";
				else
					echo "<font color=\"#6A3500\"><b>���͹� :</b>���ѭ�ҵ���  </font>";
           		echo '</div>';
			  
			 	echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;margin-top:5px;text-align: left;"><font color="#000000">';
             	echo "<font color=\"#6A3500\"><b>���͹� :</b> ��ͧ����������ӡ����ԻỴ�պ�Ժ�ó�  </font>";
          	 	echo '</div>';
			   	echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\">";
			   	echo "<tr>";
              	echo "<td colspan=\"5\"><b>������ ��ҡѺ </b>". $this->age ." ��</td>";
              	echo "</tr>";
              	echo "</table>";
				
					echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
					echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>��ͧ����繼������������ҧ�١��觾ѡ�Ҫ��� �١�������͡�ҡ�Ҫ��� �١�������͡�ҡ�Ҫ�������͹�������Ҫ�ѭ�ѵԹ�� ���͵����������� ���Ͷ١��觾ѡ �����ԡ�͹�͹حҵ��Сͺ�ԪҪԾ�����ѡࡳ�����˹�㹡�����ͧ����ԪҪվ����  </font>";
					echo '</div>';
	
				// if($this->prohibit == false){
					// echo "<table width=\"98%\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\">";
					// echo "<tr>";
					// echo "<td>�ӴѺ</td>";
					// echo "<td>�����Դ</td>";
					// echo "<td>�͡�����ҧ�ԧ</td>";
					// echo "<td>�ѹ���</td>";
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
					// echo "<td colspan=\"5\"><b>��辺�����š�����������ҧ�ѡ�Ҫ��� ���� �١�������͡�Ҫ��� </b></td>";
					// echo "</tr>";
					// echo "</table>";
				// }
			 		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;margin-top:5px;text-align: left;"><font color="#000000">';
					echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>��ͧ����繼���¶١ŧ������͡ �Ŵ�͡ ��������͡���С�á�зӼԴ�Թ�µ������Ҫ�ѭ�ѵԹ�����͵�����������  </font>";
					echo '</div>';
				 // if($this->prohibit2 == false){
					// echo "<table width=\"98%\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\">";
					// echo "<tr>";
					// echo "<td>�ӴѺ</td>";
					// echo "<td>�����Դ</td>";
					// echo "<td>�͡�����ҧ�ԧ</td>";
					// echo "<td>�ѹ���</td>";
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
					// echo "<td colspan=\"5\"><b>��辺�����š�ö١ŧ��</b></td>";
					// echo "</tr>";
					// echo "</table>";
				// }	
			  
			   	echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;margin-top:5px;text-align: left;"><font color="#000000">';
             	echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>����Ǩ�ͺ����繼����������㹡�û���ͧ�к���ЪҸԻ���ѹ�վ����ҡ�ѵ����ç�繻���آ����Ѱ�����٭����Ҫ�ҳҨѡ���  </font>";
          	 	echo '</div>';
			   	echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\">";
			   	echo "<tr>";
              	echo "<td colspan=\"5\"><b> </b></td>";
             	echo "</tr>";
              	echo "</table>";
			  
				echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';			  
				echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>����Ǩ�ͺ�������繼���ç���˹觷ҧ������ͧ ��Ҫԡ��ҷ�ͧ��� ���ͼ������÷�ͧ���  </font>";
          	 	echo '</div>';
			   	echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\">";
			   	echo "<tr>";
              	echo "<td colspan=\"5\"><b> </b></td>";
              	echo "</tr>";
              	echo "</table>";
			    
				echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
				echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>����Ǩ�ͺ�������繤�����������ö ���ͨԵ�����͹�������Сͺ �������ä�������˹�㹡� �.�.�.  </font>";
          	 	echo '</div>';
			   	echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\">";
			   	echo "<tr>";
              	echo "<td colspan=\"5\"><b> </b></td>";
              	echo "</tr>";
              	echo "</table>";
			     
				 echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
				 echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>����Ǩ�ͺ�������繼�麡���ͧ���Ÿ����ѹ������Ѻ����Сͺ�ԪҪվ�����кؤ�ҡ÷ҧ����֡��  </font>";
          	 	echo '</div>';
			   	echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\">";
			   	echo "<tr>";
              	echo "<td colspan=\"5\"><b> </b></td>";
              	echo "</tr>";
              	echo "</table>";
			   	
				echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
				echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>����Ǩ�ͺ�������繡�����ú����þ�ä������ͧ�������˹�ҷ��㹾�ä������ͧ  </font>";
          	 	echo '</div>';
			   	echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\">";
			   	echo "<tr>";
              	echo "<td colspan=\"5\"><b> </b></td>";
             	 echo "</tr>";
              	echo "</table>";
			    
				echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
				echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>����Ǩ�ͺ�������繺ؤ����������  </font>";
          	 	echo '</div>';
			   	echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\">";
			   	echo "<tr>";
              	echo "<td colspan=\"5\"><b> </b></td>";
              	echo "</tr>";
              	echo "</table>";
			    
				echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
				echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>����Ǩ�ͺ�������繼���µ�ͧ�ɨӤء�¤ӾԾҡ�Ҷ֧����ش���Ӥء �������������Ѻ�����Դ������з��»���ҷ���ͤ����Դ�����  </font>";
          	 	echo '</div>';
			   	echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\">";
			   	echo "<tr>";
              	echo "<td colspan=\"5\"><b> </b></td>";
              	echo "</tr>";
              	echo "</table>";
			     
				 echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
				echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>����Ǩ�ͺ�������繼���¶١ŧ������͡ �Ŵ�͡ ��������͡�ҡ�Ѱ���ˡԨ ͧ�����Ҫ� ����˹��§ҹ��蹢ͧ�Ѱ ����ͧ���������ҧ�����  </font>";
          	 	echo '</div>';
				echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\">";
				echo "<tr>";
				echo "<td colspan=\"5\"><b> </b></td>";
				echo "</tr>";
				echo "</table>";
			   
			    echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
			  	echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>����Ǩ�ͺ�������繼���¡�зӡ�÷ب�Ե㹡���ͺ����Ѻ����Ҫ���������һ�Ժѵԧҹ�˹��§ҹ�ͧ�Ѱ  </font>";
          		echo '</div>';
			   	echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\">";
			   	echo "<tr>";
              	echo "<td colspan=\"5\"><b> </b></td>";
             	echo "</tr>";
              	echo "</table>";
  }
	
}
?>