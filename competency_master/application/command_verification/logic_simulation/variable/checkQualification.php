<?php
/**
* @comment class ��Ǩ�ͺ�����
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Pinya
* @access private
* @created 16/03/2015
*/

class checkQualification extends utility{
	
	public function checkExp(){
		return true;
	}
	public function showExp(){
		
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
		echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>��Ǩ�ͺ �ز���� �Ѻ �ѹ����ç���˹觻Ѩ�غѹ �Ѻ �زԷ��������� �������͹� �ѧ��� </br>
			1) �Ǫ. �ҡ����������ҡѺ �ѹ����ç���˹觻Ѩ�غѹ 1 ��  �֧����ö���ز� ���. ����蹢ͻ�Ѻ�ѵ���Թ��͹��</br>
			2) �زԻ.��� �ҡ����������ҡѺ �ѹ����ç���˹觻Ѩ�غѹ 1 ��   �֧����ö���ز� �.�. ����蹢ͻ�Ѻ�ѵ���Թ��͹��</br>
			3) �زԻ.� �ҡ����������ҡѺ �ѹ����ç���˹觻Ѩ�غѹ 2 ��   �֧����ö���ز� �.�͡. ����蹢ͻ�Ѻ�ѵ���Թ��͹��</br>
			4) �زԷ����� ��ͧ��仵����� ��. ��˹�
			</font>";
		echo '</div>';
			
	}
	
}




?>