<?php
/**
* @comment ��Ǩ�ͺ�ѵ�ҡ��ѧ��ҵ��˹觤����ҧ
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Supachai
* @access private
* @created 20/1/2558
*/

class checkEmptyTeacherPosition extends utility{
	public $position_id;
	public $salary_increases;
	public $salary_income;
	public $secid;
	public $allschool_new;
	
	public $result;
	public $caption = '��Ǩ�ͺ�ѵ�ҡ��ѧ��ҵ��˹觤����ҧ����ö��˹����˹��繵��˹觤�ټ����� �¤��Թ��͹ ���� ��鹵�����˹����';
	
	public function __construct($position_id="", $salary_increases="", $salary_income="", $secid="", $allschool_new=""){
		$this->debug = "off";	
		$this->position_id = $position_id;	
		$this->salary_increases = $salary_increases;
		$this->salary_income = $salary_income;
		$this->secid = $secid;	
		$this->allschool_new = $allschool_new;
	}
	
	public function checkExp(){	
		$sql = "SELECT COUNT(*) AS empty_position
				FROM j18_position_temp 
				WHERE post_code = '425471000' 
				AND (CZ_ID IS NULL OR CZ_ID = '')
				AND position_id = '{$this->position_id}'";
		$result = mysql_db_query('cmss_'.$this->secid, $sql);
		$row = mysql_fetch_assoc($result);

		if($row['empty_position']>0 && $this->salary_increases == $this->salary_income){
			$this->result= '���˹觤����ҧ����ö��˹����˹��繵��˹觤�ټ�������';
			return true;
		}
		$this->result= '���˹觤����ҧ�������ö��˹����˹��繵��˹觤�ټ�������';
		return false;
	}
	
	public function showExp(){
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
			echo "<font color=\"#6A3500\"><b>����ʹ��� :</b> {$this->caption}</font><br>";
			echo "<font color=\"#6A3500\"><b>�š�õ�Ǩ�ͺ  : </b> ".$this->result;
			echo '</div>';
	}
	
}

?>