<?php
/**
* @comment ��Ǩ�ͺ����к��˵ط���͡�ҡ�Ҫ���
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Supachai
* @access private
* @created 17/3/2558
*/

class checkOutComment extends utility{
	public $comment;
	public $caption = '����觤���к��˵ط���͡�ҡ�Ҫ��ô��� 㹪�ͧ����� "�����˵�"';
	
	public function __construct($comment=""){
		$this->debug = "off";
		$this->comment = $comment;	
	}
	
	public function checkExp(){
		return empty($this->comment) ? false : true;
	}
	
	public function showExp(){
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
			echo "<font color=\"#6A3500\"><b>����ʹ��� :</b> {$this->caption}</font><br>";
			echo '</div>';
	}
	
}

?>