<?php
/**
 * ��Ǩ�ͺ�Է°ҹ� ���Ѻ�͹��ѡ�ҹ��ǹ��ͧ���
 *
 * @author  -
 * @copyright 2011 Sapphire
 * @description ��Ǩ�ͺ�Է°ҹ� ���Ѻ�͹��ѡ�ҹ��ǹ��ͧ���
 * @return boolean
 "
 */
class checkVitaya extends utility{
	
	public function __construct(){
		$this->debug = "off";
	}
	
	public function checkExp(){
		return true;
	}
	
	public function showExp(){
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
			echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>��Ǩ�ͺ�Է°ҹ� �óշ���Է°ҹ��鹪ӹҭ��� �ӹҭ��þ���� ��ҡóշ��������Ǫҭ �������Ǫҭ���������ʴ���ͤ�������͹���ӡ�â�͹��ѵ� �.�.�.�繡ó�੾�����</font>";
			echo '</div>';
	}
	
}

?>