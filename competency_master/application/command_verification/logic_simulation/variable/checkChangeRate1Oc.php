<?php
/**
* @comment class ��Ǩ�ͺ�ѹ����ա�û�Ѻ�ѵ���Թ��͹��ѹ��� 1 ���Ҥ�
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Eakkasit Kamwong
* @access private
* @created 02/04/2014
*/

class checkChangeRate1Oc extends utility{
		public $edu_finish;
		public $pid_new;
		public $pid_old;
		public $salary_new;
		public $salary_old;
		
	
		public function __construct($edu_finish="",$pid_new="",$pid_old="",$salary_new="",$salary_old=""){
			$this->debug = "on";
			$this->edu_finish = $edu_finish;
			$this->pid_new = $pid_new;
			$this->pid_old = $pid_old;
			$this->salary_new = $salary_new;
			$this->salary_old = $salary_old;
		}
		
		public function checkExp(){
			//echo $this->pid_now."<".$this->salary_old;
			if($this->pid_new < $this->pid_old){//check �Ţ�����˹������ҡ���ҵ��˹����
				$check_date = substr($this->edu_finish,-5);
				
				if($check_date == "10-01"){// check �ѹ������Ѻ�ز����ѹ��� 1 ��
					if($this->salary_new > $this->salary_old){
						return true;
					}else{
						return false;
					}
				}else{
					return false;
				}
			}else{
				return false;
			}
			//return true;
		}
		public function showExp(){
				echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
             	echo "<font color=\"#6A3500\"><b>���͹� :</b>��Ǩ�ͺ�ѹ������Ѻ�Թ���͹ ���/���ͻ�Ѻ��ا��á�˹����˹� ����͹����觵������ç���˹� �óշ�����Ѻ�س�ز�������� ��ѹ��� 1 ���Ҥ� ���ӡ�þԨ�óһ�Ѻ�Թ��͹����س�زԷ�����Ѻ������� ��͹���зӡ������͹�Թ��͹����է�����ҳ</font>";
          	 	echo '</div>';
		}
	
}

?>