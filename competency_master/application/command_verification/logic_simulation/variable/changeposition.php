<?php
/**
* @comment ��Ǩ�ͺ���˹觡������¹���˹�
* @projectCode 57CMSS12
* @tor  -
* @package core
* @author Kiatisak Chansawang
* @access private
* @created 02/04/2015
*/
class changeposition extends utility{
	public $pid_old;
	public $pid_exam;
	
	public function __construct($pid_old,$pid_exam){
		$this->pid_old = $pid_old;
		$this->pid_exam = $pid_exam;
		$this->debug = "off";
	}
	
	public function checkExp(){
		if($this->pid_old !=$this->pid_exam && $this->pid_exam !="225471000" && $this->pid_exam !="425471006") {
			return true;
		}else{
			return false;
		}
		
	}
	
	 public function showExp(){
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>���͹� :</b>��Ǩ�ͺ���˹觷������¹ ��ͧ�繡���觵�駢���Ҫ��ä����кؤ�ҡ÷ҧ����֡������ç���˹觵���ҵ�� 38�.(2) �ҵ�� 38 �.(1)-(4),(7) �����ҵ�� 38�. ���������˹觷���ç������� �˹��§ҹ����֡����� ����˹��§ҹ����֡�����</font>";
		echo '</div>';
  	}
	
}
?>