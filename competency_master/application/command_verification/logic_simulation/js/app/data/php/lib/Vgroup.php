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

class Vgroup extends Base {

    protected $tablename = "cmd_variable_group";

    public function __construct() {
        parent::__construct($this->tablename);
        $this->init();
    }

    public function _insert() {

    }

    public function _update() {

    }

    public function getTreeStore($fktable="", $fkfield="", $debug = false) {
        if($fktable == "" && $fkfield == "") {
            $this->setErrMsg("please insert Tablename and Id field to join");
            return false;
        }
        $SQL = "select * from ".$this->getTablename()." left join ".$fktable." ";
        $SQL .= "on ".$this->getTablename().".".$this->getPKkey()."=".$fktable.".".$fkfield." ";
		

        return $this->getResutl($SQL, $debug);
    }
}

?>