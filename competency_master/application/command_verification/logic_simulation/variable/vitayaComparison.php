<?php
/**
* @comment ���º��º�Է°ҹТͧ���˹�����Ѻ�Է°ҹз���è�����觵������
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Supachai
* @access private
* @created 12/1/2558
*/

class vitayaComparison extends utility{
	public $idcard;
	public $oldVitaya;
	public $newVitaya;
	public $vitaya_arr = array('1'=>'�ӹҭ���','2'=>'�ӹҭ��þ����','3'=>'����Ǫҭ','4'=>'����Ǫҭ�����');
	
	public function __construct($idcard="", $oldVitaya="", $newVitaya=""){
		$this->debug = "off";
		$this->idcard = $idcard;
	    $this->oldVitaya = $oldVitaya;
		$this->newVitaya = $newVitaya;
	}
	
	public function checkExp(){
		if($this->newVitaya <= $this->oldVitaya) return true;
		return false;
	}
	
	public function showExp(){
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
			echo "<font color=\"#6A3500\"><b>����ʹ��� :</b> �Ӣ������Է°ҹТͧ���˹��ѧ�Ѵ����������º��º�Է°ҹТͧ���˹觷���è�����觵�������º��º�ҡ�Է°ҹз���è�����</font><br>";
			echo "<font color=\"#6A3500\"><b>�����Ũҡ�к� : </b>�Է°ҹ������к� : {$this->vitaya_arr[$this->oldVitaya]} / �Է°ҹз��к�è� : {$this->vitaya_arr[$this->newVitaya]}</font>";
			echo '</div>';
	}
	
}

?>