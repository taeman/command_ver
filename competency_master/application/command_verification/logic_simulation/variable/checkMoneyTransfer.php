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

class checkMoneyTransfer extends utility{

		
	public function checkExp(){
		return true;
	}
	
	public function showExp(){
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>���й� :</b>��Ǩ�ͺ����͹�ѵ���Թ��͹�ͧ���˹�˹������ѵ���Թ��͹�ͧ�ա���˹�˹�� ����յ��˹��������ѧ������ѵ���Թ��͹ </font>";
		echo '</div>';
			
	}
	
}

?>