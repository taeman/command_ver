<?php
/**
* @comment class ��Ǩ�ͺ����觡���͹
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Eakkasit Kamwong
* @access private
* @created 29/09/2014
*/

class outEducationSuggestion extends utility{
		
		public function checkExp(){
			return true;
		}
		public function showExp(){
				
			echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
             	echo "<font color=\"#6A3500\"><b>����ʹ��� :</b> ������֡���¼��ѧ�Ѻ�ѭ��͹حҵ���͵���������繢ͧ˹��§ҹ���͵���س�زԢҴ�Ź ��
͹��ѵ� �.�.�. ���� �.�.�.�. ࢵ��鹷�����֡�ҷ�����Ѻ�ͺ���� ���Է�����Ѻ��þԨ�ó�����͹�Թ��͹
�����ҧ����֡�� �֡ͺ�� �����Ԩ�� ������ó� �����ѡࡳ���� �.�.�.��˹��</font>";
          	 	echo '</div>';
		}
	
}

?>