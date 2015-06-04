<?php
/**
 * ระยะการปฏิบัติงาน ณ หน่วยงานปัจจุบัน (เดือน)
 *
 * @author  -
 * @copyright 2011 Sapphire
 * @description ระยะการปฏิบัติงาน ณ หน่วยงานปัจจุบัน (เดือน)
 * @param string $idcard, เลขบัตรประจำตัวประชาชน, 3180500030751 
 * @param integer $schoolid, รหัสหน่วยงานที่สังกัด, 5001
 * @param date $startDate, วันที่มีผล, 2010-04-21
 * @return integer
 "
 */
class expStartDate extends utility{
  public $idcard;
  public $schoolid;
  public $startDate;
  public $startDateTh;
  public $siteNow;
  public $dbNow;
  public $arrDataExp = array();
  protected $sql;
  
/**
 * @param string $idcard
 * @param string $positionId
 * @param string $levelId
 * @param string $startDate
 
 */
public function __construct($idcard="",$schoolid="",$startDate=""){
		$this->idcard = $idcard;
		$this->schoolid = $schoolid;
		$this->startDate = $startDate;
		$this->siteNow = $this->getSiteNow($this->idcard);
		$this->dbNow = "cmss_".$this->siteNow;	
		$this->startDateTh = $this->dateConvert($this->startDate,'en-th-ymd');
}
  
 /**
 * ระยะการปฏิบัติงาน ณ หน่วยงานปัจจุบัน (เดือน)
 *
 * @return integer
 */ 
public function checkExp(){
		unset($arrSalary);
		$arrSalary=$this->getDataSalary($this->schoolid);
		
		if($arrSalary[runno]!=""){
				$sql_select_sch="
				SELECT
				salary.id,
				salary.runno,
				salary.runid,
				salary.`date`,
				salary.`position`,
				salary.radub,
				salary.schoolid,
				salary.school_label,
				salary.pls
				FROM `salary`
				WHERE		salary.id =  '".$this->idcard."' AND	salary.runno <  '".$arrSalary[runno]."'
				ORDER BY		salary.`date` DESC
				LIMIT 1
				";
				$rs_select_sch=mysql_db_query($this->dbNow,$sql_select_sch) or die(mysql_error());
				$res_select_sch=mysql_fetch_assoc($rs_select_sch);
				if($res_select_sch['schoolid']!="" && $res_select_sch['schoolid']!="0"){
						unset($arrSalary2);
						$arrSalary2=$this->getDataSalary($res_select_sch['schoolid']);
						if($arrSalary2[strdate]!=""){
								$sql_select_numdate="
								SELECT
								FLOOR((TIMESTAMPDIFF(MONTH,'".$arrSalary2[strdate]."','".$this->startDateTh."')/1)) as NUM_START
								";
								$rs_select_numdate=mysql_db_query($this->dbNow,$sql_select_numdate) or die(mysql_error());
								$res_select_numdate=mysql_fetch_assoc($rs_select_numdate);
								
								$this->arrDataExp[STATUS] = "Y";
								$this->arrDataExp[STR_DATE] = $arrSalary2[strdate];
								$this->arrDataExp[NUM_START_DATE] = $res_select_numdate['NUM_START'];
								$this->arrDataExp[SHOW_START_DATE] = $this->getPeriodReal($arrSalary2[strdate],$this->startDateTh);
						}else{
								$this->arrDataExp[STATUS] = "N";
								$this->arrDataExp[STR_DATE] = "";
								$this->arrDataExp[NUM_START_DATE] = 0;
								$this->arrDataExp[SHOW_START_DATE] ="";
						}
				}else{
						$this->arrDataExp[STATUS] = "N";
						$this->arrDataExp[STR_DATE] = "";
						$this->arrDataExp[NUM_START_DATE] = 0;
						$this->arrDataExp[SHOW_START_DATE] ="";
				}
				
				$this->arrDataExp[NUM_START_DATE] = $arrRunId[$positionId];
		}else{
				$this->arrDataExp[STATUS] = "N";
				$this->arrDataExp[STR_DATE] = "";
				$this->arrDataExp[NUM_START_DATE] = 0;
				$this->arrDataExp[SHOW_START_DATE] ="";
		}
		
		return $this->arrDataExp[NUM_START_DATE];
}	// end public function checkExp

  /**
 * @return array
 */
private function getDataSalary($schoolid){
		$sql_select="
		SELECT
		salary.id,
		salary.runno,
		salary.runid,
		salary.`date`,
		salary.`position`,
		salary.radub,
		salary.schoolid,
		salary.school_label,
		salary.pls
		FROM `salary`
		WHERE		salary.id =  '".$this->idcard."' AND	salary.schoolid =  '".$schoolid."'
		ORDER BY		salary.`date` ASC
		";
		$rs_select=mysql_db_query($this->dbNow,$sql_select) or die(mysql_error());
		$res_select=mysql_fetch_assoc($rs_select);
		
		$arr[runno]=$res_select['runno'];
		$arr[runid]=$res_select['runid'];
		$arr[strdate]=$res_select['date'];
		$arr[schoolid]=$res_select['schoolid'];
		$arr[position]=$res_select['position'];
		$arr[radub]=$res_select['radub'];
		
		return $arr;
}	// end private function getDataSalary
  
  /**
 * @return array
 */
  public function getExp(){
    return $this->arrDataExp;
  }
  
  /**
  * แสดงระยะการปฏิบัติงาน ณ หน่วยงานปัจจุบัน (เดือน)
 *
 * @return string
 */
public function showExp(){
		//echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#002D00;padding:5px;"><font color="#FFFFFF">';
		//echo "<font color=\"#FFCC00\"><b>เงื่อนไข :</b> ประสบการณ์ไม่น้อยกว่า <font color=\"#ffffff\"><b>".$this->periodExp."</b></font> ปี</font>";
		//echo '</div>';
		if($this->arrDataExp[STATUS] == "Y"){
				echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"3\">";				
				echo "<tr>";
				echo "<td colspan=\"5\"><b>ระยะการปฏิบัติงาน ณ หน่วยงานเดิม เท่ากับ </b>".$this->arrDataExp[SHOW_START_DATE]."</td>";
				echo "</tr>";
				echo "</table>";
		}else{
				echo "<p>ไม่พบข้อมูลหน่วยงานเดิม</p>";
		}
}	// end public function showExp
  
  
} 
?>