<?php
/**
 * ��Ǩ�ͺ�زԷ������ǡѺ�ԪҪվ������� �.�ѳ�Ե
 *
 * @author  -
 * @copyright 2011 Sapphire
 * @description ��Ǩ�ͺ�زԷ������ǡѺ�ԪҪվ������� �.�ѳ�Ե
 * @param string $education, �ز�, Ƿ.�. 
 * @return boolean
 "
 */
class degreeComparison extends utility{
	public $education;
	
	public function __construct($education=""){
		$this->debug = "off";
	    $this->education = $education;
	}
	
	public function checkExp(){
		$degree_tmp = array();
		$sql = "SELECT degree_id,degree_name FROM hr_adddegree WHERE ( degree_name IS NOT NULL AND degree_name != '' )";
		$query = mysql_db_query($this->dbMaster,$sql) or die (mysql_error());
		while($row = mysql_fetch_assoc($query)){
			array_push($degree_tmp,$row['degree_name']);
		}
		array_push($degree_tmp,'�.�ѳ�Ե');
		if(in_array($this->education,$degree_tmp)){
			return true;
		}else{
			return true;
		}
	}
	
	public function showExp(){
			
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
			echo "<font color=\"#6A3500\"><b>��Ǩ�ͺ������ :</b>�Ӣ������زԡ���֡�ҷ���к����º��º�Ѻ�زԷ������ǡѺ�ԪҪվ������� �.�ѳ�Ե</font>";
			echo '</div>';
	}
	
}

?>