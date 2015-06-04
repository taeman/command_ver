<?php
/**
 * ��Ǩ�ͺ�ѹ ��͹ �� �óա�������Ѻ����¹
 *
 * @author  -
 * @copyright 2011 Sapphire
 * @description ��Ǩ�ͺ�ѹ ��͹ �� �óա�������Ѻ����¹
 * @param string $letter_id, ����˹ѧ��ͤ����, 842
 * @return boolean
 "
 */
class checkDateRemove extends utility{
	public $letter_id;
	
	public function __construct($letter_id=""){
		$this->debug = "off";
		$this->letter_id = $letter_id;
	}
	
	public function dateFormat($date){
		$arr = explode('/',trim($date));
		$date = ($arr[2]-543).'-'.$arr[1].'-'.$arr[0];
		return date_create($date);
	}
	
	public function checkExp(){
		$arr_letter = $this->getInstructionDetail($this->letter_id);
		$date_start = $this->dateFormat($arr_letter['date_instruction']);
		$date_remove = $this->dateFormat($arr_letter['date_remove']);
		if($date_start>=$date_remove)return true;
		return false;
	}
	
	public function showExp(){
			
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
			echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>�óա�������Ѻ����¹ �ѹ ��͹ �� ��������ռ���ѧ�Ѻ ��ͧ���ѹ ��͹ �����ǡѹ �ѧ������ҧ �ѧ���
������ \"������ѹ���\" �ҡ����������ҡѺ ������ \"ŧ�ѹ���\" </font>";
			echo '</div>';
	}
	
}

?>