<?php
/**
* @comment ��Ǩ�ͺ�ҵðҹ���˹觷��е�ͧ�Ѻ����¹
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Supachai
* @access private
* @created 14/1/2558
*/

class checkCrossPosition extends utility{

	public $pid_old;
	public $pid_new;
	public $vitaya_new;
		
	public function __construct($pid_old="", $pid_new="", $vitaya_new=""){
		$this->debug = "off";
		$this->pid_old = $pid_old;
		$this->pid_new = $pid_new;
		$this->vitaya_new = $vitaya_new;
	}
	
	public function checkExp(){
		$p_old = substr($this->pid_old,0,1);
		$p_new = substr($this->pid_new,0,1);
		if(
			($p_old=='4' && $p_new=='5' && $this->vitaya_new != '') ||
			($p_old=='5' && $p_new=='4' && $this->vitaya_new != '')
		) return false;

		return true;
	}
	
	public function showExp(){
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
			echo "<font color=\"#6A3500\"><b>����ʹ��� :</b> ��Ǩ�ͺ�ҵðҹ���˹觷��е�ͧ�Ѻ����¹ �óշ�����Է°ҹ� �ҡ ��� �� 38.� ���ͨҡ 38.� �� ��� �е�ͧ�ӡ�õѴ�Է°ҹй���͡ </font><br>";
			echo '</div>';
	}
	
}

?>