<?php
/**
* @comment class ��Ǩ�ͺ����͹�ѵ���Թ��͹�ͧ���˹�˹������ѵ���Թ��͹�ͧ�ա���˹�˹�� ����յ��˹��������ѧ������ѵ���Թ��͹ 
* @projectCode 28CMSS12
* @tor 8.8
* @package core
* @author Supachai
* @access private
* @created 2/4/2558
*/

class compareBirthDay extends utility{
	private $birthday;
	private $effective_date;
	private $preiod;
		
	public function __construct($birthday="", $effective_date=""){
		$this->birthday=$birthday;
		$this->effective_date=$effective_date;
	}	
	
	public function checkExp(){
		$this->preiod = $this->getPeriodReal($this->birthday, $this->effective_date);
		if($this->preiod[0] < 50)
			return true;
		else if($this->preiod[0] == 50 && $this->preiod[1] == 0 && $this->preiod[2] == 0)
			return true;
		else	
			return false;
	}
	
	public function showExp(){
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>���͹� :</b>��������Թ 50 �� �Ѻ�֧�ѹ�ش���¢ͧ����Ѻ��Ѥ�</font><br>";
		echo "<font color=\"#6A3500\"><b>�š�õ�Ǩ�ͺ :</b>���� {$this->preiod[0]} �� {$this->preiod[1]} ��͹ {$this->preiod[2]} �ѹ �Ѻ�֧������ѹ��� </font>";
		echo '</div>';
			
	}
	
}

?>