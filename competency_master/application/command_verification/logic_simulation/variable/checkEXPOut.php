<?php
/**
* @comment ��Ǩ�ͺ�����Ѻ�Ҫ��âͧ������֡�� (�Ҥ����)
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Supachai
* @access private
* @created 19/1/2558
*/

class checkEXPOut extends checkEXPIn{

	public function checkExp(){
		$this->caption = "������֡�Ҩе�ͧ�������Ѻ�Ҫ��õԴ��͡ѹ �ҡ����������ҡѺ 12 ��͹��� ���� 1 �� �Ѻ�֧�ѹ��� 15 �Զع�¹ �ͧ�շ������֡��";
		
		$this->date_start = empty($this->view_general['startdate']) ? $this->view_general['begindate'] : $this->view_general['startdate'];
		
		$start_year = explode('-', $this->date_out);
		
		$this->date_period = $this->getPeriodReal($this->date_start, ($start_year[0]+543).'-06-15');
		
		if($this->date_period[0] < 1){
			$this->result= '<strong>�������ö���֡�ҵ����</strong>';
			return false;
		}
		$this->result= '<strong>����ö���֡�ҵ����</strong>';
		return true;
	}	

}

?>