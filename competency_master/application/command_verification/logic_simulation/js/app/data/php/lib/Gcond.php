<?php
/**
* @comment ไฟล์สำหรับระบบตรวจสอบคำสั่ง
* @projectCode 57CMSS10
* @tor 10.2.1.5
* @package     core
* @author      Nattapong Charoensook <nattapong@sapphire.co.th>
* @access public
* @created 13/11/2557
 */
require("Base.php");

class Gcond extends Base {

    protected $tablename = "cmd_condition_group";

    public function __construct() {
        parent::__construct($this->tablename);
        $this->init();
        $this->cond_id = 0;
    }

    public function setCondId($cond_id) {
        $this->cond_id = $cond_id;
    }

    public function getCondId() {
        return $this->cond_id;
    }

    public function getTreeStore($textfield="", $idfield = "", $dataname = "data") {
        if($idfield == "") {
            $idfield = $this->getPKkey();
        }

        if($textfield == "") {
            $this->setErrMsg("please set textfield to make Tree");
            return false;
        }

        $rs = $this->selectAll("*");
        $d = array("data"=>array());

        for($i=0; $i<$rs['rows']; $i++) {
            $data = array("text" => $rs[$i][$textfield], "id" => $rs[$i][$this->getPKkey()], "leaf" => true);
            //array_push($d,$data);
            array_push($d["data"],$data);
        }



        return json_encode($d);
    }

    public function _insert($post=false, $debug = false) {
        extract($post);

        if(!$cond_status) {
            $cond_status = '0';
        }

        $SQL = "insert into ".$this->getTablename()." (cond_name,cond_detail, cond_status, cond_update) ";
        $SQL .= "values(";
        $SQL .= "'$cond_name','$cond_detail','$cond_status','".date("Ymd")."');" ;

        if($debug) {
            echo $SQL;
            return $debug;
        }

        return $this->setResult($SQL);
    }

    public function _update($post=false, $debug = false) {
        extract($post);

        if(!$cond_status) {
            $cond_status = '0';
        }

        $SQL = "update ".$this->getTablename()." set ";
        $SQL .= "gcond_name='$gcond_name',gcond_detail='$gcond_detail' " ;
        $SQL .= "where ".$this->getPKkey()."=".$post["".$this->getPKkey().""]." limit 1";

        if($debug) {
            echo $SQL;
            return $debug;
        }

        return $this->setResult($SQL);
    }
}

?>