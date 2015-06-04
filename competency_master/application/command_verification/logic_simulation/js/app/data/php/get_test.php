<?php
require('lib/Cond.php');

$cond = new Cond();
$mod = $cond->valPostGet("mod",false);
$id = $cond->valPostGet("id",false);
$debug = true;

if($mod == 'delete') {
    $cond->_delete($id,$debug);
}
elseif($mod == 'insert') {

}
else {
    echo $cond->selectAllJson("*",$cond->valPostGet("page",1),$cond->valPostGet("start",0),$cond->valPostGet("limit"));
}



?>