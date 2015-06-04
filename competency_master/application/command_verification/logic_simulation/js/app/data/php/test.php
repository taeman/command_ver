<?php
require("lib/Cond.php");

$obj = new Cond();

echo $obj->getPKkey();
echo $obj->getTablename();

echo $obj->selectAllJson("*");
?>