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

class Vars extends Base {

    protected $tablename = "cmd_variable";

    protected $var_id;

    public function __construct() {
        parent::__construct($this->tablename);
        $this->setPKkey("var_id");
        $this->var_id = 0;
    }

    public function getTreeStore($textfield="", $idfield="", $dataname = "data") {
        if($idfield == "") {
            $idfield = $this->getPKkey();
        }

        if($textfield == "") {
            $this->setErrMsg("please set textfield to make Tree");
            return false;
        }

        $rs = $this->selectAll("*");
		//$rs = $this->selectAllCconditionGroup();
        $d = array("data"=>array());

        for($i=0; $i<$rs['rows']; $i++) {
            $data = array("text" => $rs[$i][$textfield], "id" => $rs[$i][$this->getPKkey()],"data"=>$rs[$i]['var_detail'], "leaf" => true);
            
            array_push($d["data"],$data);
        }



        return json_encode($d);
    }

    public function _insert() {

    }

    public function _update() {

    }
}
?>