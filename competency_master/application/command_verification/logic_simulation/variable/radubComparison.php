<?php
/**
 * เปรียบเทียบอันดับของตำแหน่งเดิมกับอันดับที่บรรจุและแต่งตั้งใหม่
 *
 * @author  -
 * @copyright 2011 Sapphire
 * @description เปรียบเทียบอันดับของตำแหน่งเดิมกับอันดับที่บรรจุและแต่งตั้งใหม่
 * @param string $idcard, เลขบัตรประจำตัวประชาชน, 3659900233211 
 * @param integer $radub_old, อันดับของตำแหน่งเดิม, ท.7
 * @param integer $radub_new, อันดับของตำแหน่งใหม่, ท.8
 * @return boolean
 "
 */
class radubComparison extends utility{
	public $idcard;
	public $radub_old;
	public $radub_new;
	
	public function __construct($idcard="", $radub_old="", $radub_new=""){
		$this->debug = "off";
		$this->idcard = $idcard;
	    $this->radub_old = $radub_old;
		$this->radub_new = $radub_new;
	}
	
	public function getOrderBy(){
		$sql = "SELECT
						if(table_new.orderby <= table_old.orderby,'T','F')AS less_than
					FROM
						hr_addradub table_old
					LEFT JOIN hr_addradub table_new ON table_new.radub = '".$this->radub_new."'
					WHERE table_old.radub = '".$this->radub_old."' ";
		$query = mysql_db_query($this->dbMaster,$sql) or die (mysql_error());
		$row = mysql_fetch_assoc($query);
		return $row['less_than'];
	}
	
	public function checkExp(){
		//return $this->getOrderBy();
		if($this->getOrderBy()=='T') return true;
		return false;
	}
	
	public function showExp(){
			
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
			echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ :</b>นำข้อมูลอันดับของตำแหน่งสังกัดเดิมโดยมาเปรียบเทียบอันดับของตำแหน่งที่บรรจุและแต่งตั้งโดยเปรียบเทียบจาก 
 อันดับที่บรรจุใหม่ น้อยกว่าหรือเท่ากับ อันดับเดิม ซึ่งจะมีผลลัพธ์เป็นจริง</font>";
			echo '</div>';
	}
	
}

?>