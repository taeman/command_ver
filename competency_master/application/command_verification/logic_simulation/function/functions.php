<?php
function readParameter(){
	$arr_parameter = array();
	$arr_parameter[] = array(
											"parameter_eval"=>"[idcard]",
											"parameter_name"=>"บัตรประจำตัวประชาชน",
											"defualt_value"=>"3620200034234"
											);
	$arr_parameter[] = array(
											"parameter_eval"=>"[dbMaster]",
											"parameter_name"=>"ฐานข้อมูลกลาง",
											"defualt_value"=>"cmss_master"
											);
	$arr_parameter[] = array(
											"parameter_eval"=>"[dbSite]",
											"parameter_name"=>"ฐานข้อมูล สพท.",
											"defualt_value"=>"cmss_5001"
											);
	return $arr_parameter;
}
?>
