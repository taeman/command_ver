<?php
/**
* @comment class ��Ǩ�ͺ�óյ��˹������� ��ټ�����
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Eakkasit  Kamwong
* @access private
* @created 04/02/2015
*/

class checkOldPositionNo extends utility{
		public $idcard;
		public $letter_id;
		public function __construct($pid_old=""){
			$this->debug = "off";
			$this->pid_old = $pid_old;
		}
		
		public function checkExp(){
			$check=true;
			if($this->pid_old == '425471006'){
				$check=false;
			}
			return $check;
		}
		public function showExp(){
				echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
             	echo "<font color=\"#6A3500\"><b>���͹� :</b>��Ǩ�ͺ���˹������ͧ����繤�ټ����� ���ͧ�ҡ���˹觤�ټ����� ����㹪�ǧ�����ҧ���ͧ��Ժѵ�˹�ҷ���Ҫ�����������������������оѲ�����ҧ���</font>";
          	 	echo '</div>';
				

		}
	
}

?>