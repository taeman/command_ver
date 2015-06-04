<?php
require('lib/Gcond.php');

$obj = new Gcond();
$mod = $obj->valPostGet("mod",false);
$debug = false;

if($mod == 'delete') {
    if($obj->_delete($obj->valPostGet("id",false),$debug)){
        echo "{success: true}";
    }
}
elseif($mod == 'update') {
    if(!$obj->valPostGet('cond_id',false)) {
        if($obj->_insert($_POST,$debug)) {
            echo "{success: true}";
        }
    }
    else {
        if($obj->_update($_POST,$debug)) {
            echo "{success: true}";
        }
    }

}
elseif($mod == 'treejson') {
    echo $obj->getTreeStore("gcond_name");
}
else {
    echo $obj->selectAllJson("*",$obj->valPostGet("page",1),$obj->valPostGet("start",0),$obj->valPostGet("limit"));
	
}


?>
