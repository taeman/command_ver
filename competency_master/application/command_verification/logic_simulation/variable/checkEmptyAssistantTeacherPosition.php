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

class checkEmptyAssistantTeacherPosition extends checkEmptyTeacherPosition{

	public function checkExp(){	
		$this->caption = '��Ǩ�ͺ�ѵ�ҡ��ѧ��ҵ��˹觤�ټ�������ҧ����ö��˹����˹��繵��˹觤�� �¤��Թ��͹ ���� ��鹵�����˹����';
		$sql = "SELECT COUNT(*) AS empty_position
				FROM j18_position_temp 
				WHERE post_code = '425471006' 
				AND (CZ_ID IS NULL OR CZ_ID = '')
				AND position_id = '{$this->position_id}'";
		$result = mysql_db_query('cmss_'.$this->secid, $sql);
		$row = mysql_fetch_assoc($result);

		if($row['empty_position']>0 && $this->salary_increases == $this->salary_income){
			$this->result= '�ѵ�ҡ��ѧ��ҵ��˹觤�ټ�������ҧ����ö��˹����˹��繵��˹觤����';
			return true;
		}
		$this->result= '�ѵ�ҡ��ѧ��ҵ��˹觤�ټ�������ҧ�������ö��˹����˹��繵��˹觤����';
		return false;
	}
}

?>