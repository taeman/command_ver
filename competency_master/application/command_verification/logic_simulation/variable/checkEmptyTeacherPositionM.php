<?php
/**
* @comment ��Ǩ�ͺ�ѵ�ҡ��ѧ��ҵ��˹觤����ҧ �������Թࡳ���ѵ�ҡ��ѧ��� �.�.�. ��˹�
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Supachai
* @access private
* @created 21/1/2558
*/

class checkEmptyTeacherPositionM extends checkEmptySchoolDeputyDirectorPosition{
	
 	public function checkExp(){	

		$std_comp=$this->getWorkforce();
		//echo '<pre>', print_r($std_comp); die; 			
		//������M1M2	��ټ���͹E	����ʹѺʹعS		std real
		
		$this->caption = '��Ǩ�ͺ�ѵ�ҡ��ѧ��ҵ��˹觤����ҧ �������Թࡳ���ѵ�ҡ��ѧ��� �.�.�. ��˹� ����ö��˹����˹��繵��˹��ͧ����ӹ�¡��ʶҹ�֡�� �¤��Թ��͹ ���� ��鹵�����˹���� ����ͻ�Ѻ��ا��˹����˹����� �ӹǹ�������ͧ����ӹ�¡��ʶҹ�֡�ҵ�ͧ����Թࡳ������� �.�.�. ��˹�';
		
		$sql = "SELECT COUNT(*) AS empty_position
				FROM j18_position_temp 
				WHERE post_code = '425471000' 
				AND (CZ_ID IS NULL OR CZ_ID = '')
				AND position_id = '{$this->position_id}'";
		$result = mysql_db_query('cmss_'.$this->secid, $sql);
		$row = mysql_fetch_assoc($result);
		
		if($row['empty_position']>0 && $this->salary_increases == $this->salary_income && $std_comp['E']['std'] > $std_comp['E']['real'] && $std_comp['M2']['std'] > $std_comp['M2']['real']){
			$this->result= '�ѵ�ҡ��ѧ��ҵ��˹觤����ҧ����ö��˹����˹��繵��˹��ͧ����ӹ�¡��ʶҹ�֡����';
			return true;
		}
		$this->result= '�ѵ�ҡ��ѧ��ҵ��˹觤����ҧ�������ö��˹����˹��繵��˹��ͧ����ӹ�¡��ʶҹ�֡����';
		return false;
	}
}

?>