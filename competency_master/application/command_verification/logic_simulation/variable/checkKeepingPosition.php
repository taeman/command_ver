<?php
/**
* @comment ��Ǩ�ͺ���˹觡���ѡ��㹵��˹�
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Supachai
* @access private
* @created 19/1/2558
*/

class checkKeepingPosition extends utility{
	public $pid_old;
	public $pid_new;
	
	public function __construct($pid_old="", $pid_new=""){
		$this->debug = "off";
		$this->pid_old = $pid_old;
		$this->pid_new = $pid_new;
	}
	
	public function checkExp(){
		$pid = empty($this->pid_old) ? $this->pid_new : $this->pid_old;
		
		if($pid == '325001010' || $pid == '325471008' || $pid == '125471009' || $pid == '125471008'){
			return false;
		}
		return true;
	}
	
	public function showExp(){
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
			echo "<font color=\"#6A3500\"><b>����ʹ��� :</b> ���˹觼���ӹ�¡���ӹѡ�ҹࢵ��鹷�����֡��, ���˹觼���ӹ�¡��ʶҹ�֡��, 
���˹��ͧ����ӹ�¡���ӹѡ�ҹࢵ��鹷�����֡����е��˹��ͧ����ӹ�¡��ʶҹ�֡�� �������ö�ѡ�ҡ��㹵��˹���</font><br>";
			echo '</div>';
	}
	
}

?>