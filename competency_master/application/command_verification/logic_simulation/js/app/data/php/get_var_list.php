<?php
require("lib/Vars.php");

$obj = new Vars();
$mod = $obj->valPostGet("mod",false);
$debug = false;

if($mod=="delete") {
    if($obj->_delete($obj->valPostGet("id",false),$debug)){
        echo "{success: true}";
    }
}
elseif($mod=="insert") {

}
elseif($mod=="treejson") {
    echo $obj->getTreeStore("var_name",$debug);
}
else {
    echo $obj->selectAllJson("*",$obj->valPostGet("page",1),$obj->valPostGet("start",0),$obj->valPostGet("limit"));

}

?>