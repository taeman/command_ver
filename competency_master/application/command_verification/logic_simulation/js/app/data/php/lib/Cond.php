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

class Cond extends Base {

    protected $tablename = "cmd_condition";

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
		//$rs = $this->selectAllJsonCconditionGroup();
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

        $SQL = "insert into ".$this->getTablename()." (cond_name,cond_detail, cond_status, gcond_id, cond_update) ";
        $SQL .= "values(";
        $SQL .= "'$cond_name','$cond_detail','$cond_status','$gcond_id','".date("Ymd")."');" ;

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
        $SQL .= "gcond_id='$gcond_id',cond_name='$cond_name',cond_detail='$cond_detail',cond_status='$cond_status',cond_update='".date("Ymd")."' " ;
        $SQL .= "where ".$this->getPKkey()."=".$post["".$this->getPKkey().""]." limit 1";

        if($debug) {
            echo $SQL;
            return $debug;
        }

        return $this->setResult($SQL);
    }

    public function updateEval($id=0,$eval='',$html) {
        if(!$id) {
            return false;
        }

        $SQL = "update ".$this->getTablename()." set ";
        $SQL .= "cond_eval='$eval',cond_html='$html' ";
        $SQL .= "where cond_id=$id limit 1";

        return $this->setResult($SQL);
    }

    public function getHTML($id=0) {
        if(!$id) {
            return false;
        }
        $SQL = "select cond_html from cmd_condition where cond_id=$id";

        return $this->getResutl($SQL);
    }

    public function getVarName($id=0) {
        if(!$id) {
            return false;
        }

        $SQL = "select var_name from cmd_variable where var_id=$id";

        return $this->getResutl($SQL);
    }
}

?>