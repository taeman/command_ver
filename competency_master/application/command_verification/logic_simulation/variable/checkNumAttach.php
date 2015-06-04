<?php
/**
 * ตรวจสอบคนในบัญชีแนบ
 *
 * @author  -
 * @copyright 2011 Sapphire
 * @description ตรวจสอบคนในบัญชีแนบ
 * @param string $idcard, เลขบัตรประจำตัวประชาชน, 3659900273833 
 * @param integer $letter_id, รหัสหนังสือคำสั่ง, 700
 * @param integer $ranking, อันดับที่, 3
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
				return false;//'อันดับที่ ไม่ถูกต้องกรุณาระบุหมายเหตุ';
			}
		}
		return true;
	}
	
	public function showExp(){
			
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
			echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>การบรรจุบุคคลเข้ารับราชการเป็นข้าร้าชการครูและบุคลากรทางการศึกษา เพื่อแต่งตั้งให้ดำรงตำแหน่งใด ให้บรรจุและแต่งตั้งจากผู้สอบแข่งขั้นได้สำหรับตำแหน่งนั้น โดยบรรจุและแต่งตั้งตามลำดับที่ในบัญชีผู้สอบแข่งขันได้<br/>
			&nbsp;&nbsp;&nbsp;&nbsp;- การเรียงลำดับที่ในบัญชีผู้สอบแข่งขันได้ ให้เรียงตามลำดับที่ของตัวเลขลำดับที่สอบแข่งขันได้ <br/>
			&nbsp;&nbsp;&nbsp;&nbsp;- หากข้อมูลลำดับที่ไม่เรียงลำดับกัน ให้แสดงหมายเหตุ</font>";
			echo '</div>';
	}
	
}

?>