<?php
/**
 * ��Ǩ�ͺ��㹺ѭ��Ṻ
 *
 * @author  -
 * @copyright 2011 Sapphire
 * @description ��Ǩ�ͺ��㹺ѭ��Ṻ
 * @param string $idcard, �Ţ�ѵû�Шӵ�ǻ�ЪҪ�, 3659900273833 
 * @param integer $letter_id, ����˹ѧ��ͤ����, 700
 * @param integer $ranking, �ѹ�Ѻ���, 3
 * @return boolean
 "
 */
class checkNumAttach extends utility{
	public $idcard;
	public $letter_id;
	public $ranking;
	
	public function __construct($idcard="", $letter_id="", $ranking=""){
		$this->debug = "off";
		$this->idcard = $idcard;
		$this->letter_id = $letter_id;
		$this->ranking = $ranking;
	}
	
	public function checkExp(){
		$i = 1;
		$sql = "SELECT pin,`comment` FROM cmd_command_letter_attach WHERE letter_id = ".$this->letter_id." ORDER BY ranking";
		$query = mysql_db_query($this->dbApp,$sql) or die (mysql_error());
		$num = mysql_num_rows($query);
		if($num>1){
			while($row = mysql_fetch_assoc($query)){
				if($row['pin']==$this->idcard){
					$index_pin=$i;
					$index_comment = $row['comment'];
				}
				$i++;
			}
			if($index_pin==$this->ranking){
				return true;
			}else{
				if($index_comment!='')return true;
				return false;//'�ѹ�Ѻ��� ���١��ͧ��س��к������˵�';
			}
		}
		return true;
	}
	
	public function showExp(){
			
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
			echo "<font color=\"#6A3500\"><b>����ʹ��� :</b>��ú�èغؤ������Ѻ�Ҫ����繢����Ҫ��ä����кؤ�ҡ÷ҧ����֡�� �����觵������ç���˹�� ����è�����觵�駨ҡ����ͺ�觢��������Ѻ���˹觹�� �º�è�����觵�駵���ӴѺ���㹺ѭ�ռ���ͺ�觢ѹ��<br/>
			&nbsp;&nbsp;&nbsp;&nbsp;- ������§�ӴѺ���㹺ѭ�ռ���ͺ�觢ѹ�� ������§����ӴѺ���ͧ����Ţ�ӴѺ����ͺ�觢ѹ�� <br/>
			&nbsp;&nbsp;&nbsp;&nbsp;- �ҡ�������ӴѺ���������§�ӴѺ�ѹ ����ʴ������˵�</font>";
			echo '</div>';
	}
	
}

?>