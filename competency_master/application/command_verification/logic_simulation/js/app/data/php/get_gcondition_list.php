<?php
require("lib/Gcond.php");

$obj = new Gcond();
$mod = $obj->valPostGet("mod",false);
$debug = false;

echo $obj->selectAllJson('*');

?>