<?php
/**
* @comment ตรวจสอบการปรับปรุงตำแหน่งประเภทวิชาการ ระดับชำนาญการ
* @projectCode 58CMSS12
* @tor  -
* @package core
* @author Supachai
* @access private
* @created 17/3/2558
*/

class checkImproveAcademyPosition extends utility{
	public $position_id;
	public $pid_old;
	public $salary_income;
	public $salary_increases;
	public $level_id_old;
	public $level_id_new;
	public $result;
	
	public function __construct($position_id="", $pid_old="", $salary_income="", $salary_increases="", $level_id_old="", $level_id_new=""){
		$this->debug = "off";
		$this->position_id = $position_id;
		$this->pid_old = $pid_old;
		$this->salary_income = $salary_income;
		$this->salary_increases = $salary_increases;
		$this->level_id_old = $level_id_old;
		$this->level_id_new = $level_id_new;
	}
	
	public function checkEmptyPosition(){
		$sql = "SELECT CZ_ID FROM j18_position_temp WHERE position_id = '{$this->position_id}' AND post_code = '{$this->pid_old}'";
		$rs = mysql_db_query('cmss_'.$_SESSION['secid'],$sql);
		$row = mysql_fetch_object($rs);
		return $row->CZ_ID;
	}
	
	public function getRadub(){
		$sql = "SELECT level_id, radub, orderby FROM hr_addradub WHERE com_type_id = '2' AND active_now = '1'";
		$rs = mysql_db_query($this->dbMaster, $sql);
		while($row = mysql_fetch_object($rs)){
			$data[$row->level_id] = $row->orderby;
		}
		return $data;
	}	
	
	public function checkExp(){
		$radub = $this->getRadub();
		$idcard = $this->checkEmptyPosition();
		if(empty($idcard)){
			if(($radub[$this->level_id_old] >= $radub[$this->level_id_new] && $this->salary_income == $this->salary_increases) || ($radub[$this->level_id_old] == $radub[$this->level_id_new] && $this->salary_income != $this->salary_increases)){
				$this->result = 'สามารถปรับปรุงการกำหนดตำแหน่งเลขที่  '.$this->position_id.' ได้';
				return true;
			}else{
				$this->result = 'สามารถปรับเป็นระดับที่ต่ำกว่าและเท่ากัน และไม่สามารถปรับพร้อมการเลื่อนเงินเดือนได้ ดังนั้นจึงต้องทำการปรับปรุงการกำหนดตำแหน่งก่อน แล้วจึงสามารถทำการเลื่อนเงินเดือนได้';
				return false;
			}
		}else{
			$this->result = 'ตำแหน่งเลขที่  '.$this->position_id.' มีคนครองแล้ว';
			return false;
		}
	}
	
	public function showExp(){
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b> กรณีที่ข้าราชการครูและบุคลากรทางการศึกษา ตำแหน่งบุคลากรทางการศึกษาอื่น 38 ค.(2) ตำแหน่งประเภทวิชาการ ระดับชำนาญการ ที่เป็นตำแหน่งว่าง และมีอัตราเงินเดือนให้เป็นระดับปฎิบัติการ หรือชำนาญการ<br>
		* จะสามารถปรับเป็นระดับที่ต่ำกว่าและเท่ากับ<br>
		* ไม่สามารถปรับพร้อมการเลื่อนเงินเดือนได้ ดังนั้นจึงต้องทำการปรับปรุงการกำหนดตำแหน่งก่อน แล้วจึงสามารถทำการเลื่อนเงินเดือนได้
		</font><br>";
		echo "<font color=\"#6A3500\"><b>ผลการตรวจสอบ :</b> {$this->result}</font><br>";
		echo '</div>';
	}
}

?>