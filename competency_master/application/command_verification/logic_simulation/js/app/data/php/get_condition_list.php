<?php
require('lib/Cond.php');

$obj = new Cond();
$mod = $obj->valPostGet("mod",false);
$debug = false;

if($mod == 'delete') {
    if($obj->_delete($obj->valPostGet("id",false),$debug)){
        echo "{success: true}";
    }
}
elseif($mod=='eval') {
    if($obj->valPostGet('cond_id',false)) {
        if($obj->updateEval($obj->valPostGet('cond_id'),$obj->valPostGet('cond_eval'),$obj->valPostGet('cond_html'))) {
            echo "{success: true}";
        }
    }
    else {
        echo "{success: false}";
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
    echo $obj->getTreeStore("cond_name");
}
elseif($mod == 'ghtml') {
    $rs = $obj->getHTML($obj->valPostGet('cond_id'));
    echo $rs[0]['cond_html'];
}
elseif($mod == 'name') {
    $rs = $obj->getVarName($obj->valPostGet('var_id'));
    //echo iconv('utf8','tis620',$rs[0]['var_name']);
    echo $rs[0]['var_name'];
}
else {
    //echo $obj->selectAllJson("*",$obj->valPostGet("page",1),$obj->valPostGet("start",0),$obj->valPostGet("limit"));
	echo $obj->selectAllJsonCconditionGroup("*",$obj->valPostGet("page",1),$obj->valPostGet("start",0),$obj->valPostGet("limit"));
}


?>
