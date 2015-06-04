<?php 
/**
* @comment logout
* @projectCode 57CMSS10
* @tor
* @package core
* @author Supachai
* @access public
* @created 03/09/2014
*/
session_start();
session_destroy();
header("Location: http://".$_SERVER['HTTP_HOST']);
?>