<?php
/**
* @comment ไฟล์สำหรับระบบตรวจสอบคำสั่ง
* @projectCode 57CMSS10
* @tor 10.2.1.5
* @package   core
* @author    Nattapong Charoensook
* @access public
* @created 13/11/2557
*/
require_once("Mysql.php");
class Core {
	
	protected $base_url;
	protected $system_folder;
	protected $application_folder;
	protected $cms_folder;
	protected $client_ip;
     
	protected $cfg; // config ไฟล์จากไฟล์ config.inc.php
	
	 /**
      * สำหรับคลาส Form
      */
	protected $msg;
	protected $fncontrol;
	protected $recordcount;
	protected $lastinsertid;
	protected $affectedrows;
	protected $showpage;
	protected $totalpages;
	protected $_error;
	
	protected $colordebug;
	
     /**
      * สำหรับคลาส Authen
      */
     protected $u_id;
     protected $u_name;
     protected $u;
     protected $g_id;
     protected $ip;
     
	public function __construct($cfg) {
		$this->cfg = $cfg;
		extract($cfg);
          
		$this->base_url = $base_url;
		$this->system_folder = $system_folder;
		$this->template_folder = $template_folder;
		$this->cms_folder = $cms_folder;
          
          $this->recordcount = 0;
          $this->lastinsertid = 0;
          $this->affectedrows = 0;
          $this->showpage = 20;
	}
	
	/**
	 * @param string Component name
	 * @param string/int Default value when Component don't have value.
	 * @return string/int Value of this Component
	 */
	public function getParam($name=FALSE, $ignore=FALSE) {
		if($_POST[$name]) {
			return $_POST[$name];
		} 
		elseif($_GET[$name]) {
			return $_GET[$name];
		}
		elseif($_FILES[$name]) {
			return $_FILES[$name];
		}
		else {
			return $ignore;
		}
	}
	
	/**
	 * getRealIpAddr()
	 * @access public
	 * @param void none
	 * @return string Ip Address of Client
	 */
	public function getRealIpAddr()
	{
	    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
	    {
	      $ip=$_SERVER['HTTP_CLIENT_IP'];
	    }
	    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
	    {
	      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
	    }
	    else
	    {
	      $ip=$_SERVER['REMOTE_ADDR'];
	    }
	    return $ip;
	}
	
	/**
	 * Return base url of this site
	 * baseURL()
	 * 
	 * @access public
	 * @param void
	 * @return string
	 */
	public function baseURL() {
		//return $this->base_url;
		return BASE_URL;
	}
	
	/**
	 * Return system folder
	 * SYSfolder()
	 * 
	 * @access public
	 * @param void
	 * @return string
	 */
	public function sysURL() {
		return $this->system_folder;
	}
	
	/**
	 * Return application folder
	 * tplURL()
	 * 
	 * @access public
	 * @param void
	 * @return string
	 */
	public function tplURL() {
		return $this->template_folder;
	}
	
	/**
	 * Return system folder
	 * cmsURL()
	 * 
	 * @access public
	 * @param void
	 * @return string
	 */
	public function cmsURL() {
		return $this->cms_folder;
	}
	
	/**
	 * ctype_digit()
	 * 
	 * Determines if a string is comprised only of digits
	 * @access	public
	 * @param	string
 	 * @return	bool
	 */
	public function ctype_digit($str=FALSE)
	{
		if( ! is_string($str) OR $str == '')
		{
			return FALSE;
		}
		
		return ! preg_match('/[^0-9]/', $str);
	}
	
	/**
	 * ctype_alnum()
	 *
	 * Determines if a string is comprised of only alphanumeric characters
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	public function ctype_alnum($str=FALSE)
	{
		if( ! is_string($str) OR $str == '')
		{
			return FALSE;
		}
		
		return ! preg_match('/[^0-9a-z]/i', $str);
	}
  	
  	/**
  	 * curPageURL()
  	 * @access public
  	 * @param void
  	 * @return page URL
  	 * 
  	 */
	public function curPageURL() {
		$pageURL = 'http';
		if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
			$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		return $pageURL;
	}
	
	/**
	 * getCfg()
	 * @access public
	 * @return array config
	 */
	public function getCfg() {
		return $this->cfg;
	}
	
	/**
	 * getControl()
	 * @access public
	 * @param $_GET
	 * @return Full file path of control
	 */
	public function getControl($g) {
	     $this->setControl($this->getParam("fn","common"));
		$c = "module/".$this->getParam("fn","common");
		return $c;
	}
	
	/**
	 * getModule()
	 * @access public
	 * @param $_GET
	 * @return Full file path of module
	 */
	public function getModule($g) {
		$m = $this->getParam("mod","index");
		return $m;
	}
	
     /**
      * setControl()
      * @access public
      * @param string $fn
      * @return true
      * 
      */
     public function setControl($fn=false) {
          if(!$fn) {
               $fn = "common";
          }
          $this->fncontrol = $fn;
          return true;
     }
	/**
	 * loadControl()
	 * @access public
      * @param void
	 * @return string $fn name
	 */
	public function loadControl() {
		return $this->fncontrol;
	}
	
	/**
	 * rndString(length)
	 * @access public
	 * @param int length
	 * @return string character of string Upper and Lower case
	 */
	function rndString($inlength)
	{
		$rndstr="";
		while(strlen($rndstr)<$inlength){
			$rnd_num=rand(1,2);
			if($rnd_num>1){
				$rndstr=$rndstr.chr(rand(65,90));
			}else{
				$rndstr=$rndstr.chr(rand(97,122));
			}
		}
		return($rndstr);
	}
	
     /**
      * @param String $xml XML string
      * @param String $mapping file mapping or put on $xmlstring
      * @param bool $debug
      * 
      * @example String How to use it.
      * <command>
      * <table>ชื่อ table</table>
      * <action>select,insert,update or delete</action> ใช้ในการบอกว่าต้องการ SQL แบบใดออกมา
      * <fields>ชื่อฟิลด์ที่ต้องการเรียกดู ค่ามาตรฐานคือ (*)</fields> * บันทัดนี้ใช้สำหรับ action ที่เป็น select เท่านั้น
      * <field pkf='ชื่อฟิลด์'>ค่าต่างๆที่ต้องการเซตในฟิลด์นี้</field> ** บันทัดนี้ใช้สำหรับ action insert, update และ delete
      * <jointable pk='' pkf='' fgkt='' fgkf=''> ชนิดของการ join ex. (left join, right join, inner join) </jointable>
      * <wheres pk='' pkf='' option='[=,<=,>=,<,>]' logic='and,or'>...where statement can use more 1 row...</wheres>
      * <groupby>ฟิลด์ที่ต้องการใช้ใน group by</groupby> *ใช้ใน action select เท่านั้น
      * <orderby>ฟิลด์ที่ต้องการใช้ในการเรียงลำดับ</orderby> *ใช้ใน action select เท่านั้น
      * <dirt>การเรียงลำดับของข้อมูล ASC น้อยไปมาก และ DSC มากไปน้อย</dirt> *ใช้ใน action select เท่านั้น
      * <mapping>path ของไฟล์ mapping ที่อยู่ในแต่ละ module</mapping>
      * <page>เลขหน้า</page>
      * <showpage>จำนวน record ที่ต้องการแสดงให้แต่ละหน้า</showpage>
      * </command>
      */
     public function xml2sql($xmlstring=false, $mapping = "mapping.xml") {
          
          $e = simplexml_load_string($xmlstring);
          if($e->mapping) {
               $mapping = $e->mapping;
          }
          
          $f = simplexml_load_file($mapping);
          
          $page = 1;
          
          $SQL = $e->sql;
          $action = $e->action;
          $table = $e->table;
          $fields = $e->fields; // for select
          $field = $e->field; // for insert, update or delete
          $jointable = $e->jointable;
          $wheres = $e->wheres;
          $groupby = $e->groupby;
          $orderby = $e->orderby;
          $dirt = $e->dirt;
          $showpage = $e->showpage;
          
          if($action == "select") {
               if(!$SQL) {
                    $SQL = "";
                    if(!$fields) {
                         $field = " * ";
                    }
                    else {
                         $field = $fields;
                    }
                    
                    if($e->page) {
                         $page = $e->page;
                    }
                    
                    if($showpage) {
                         $limited = $showpage;
                    }
                    else {
                         $limited = $f->table->$table->showpage;
                    }
                    
                    $this->setShowpage($limited);
                    
                    $joy = "";
                    if($jointable) {
                                             
                         foreach($jointable as $j) {
                              if($j['pkt'] == "") {
                                   $joy .= $j." ".$j['fgkt']." on ".$table.".".$j['pkf']."=".$j['fgkt'].".".$j['fgkf'];
                              }
                              else {
                                   $joy .= $j." ".$j['pkt']." on ".$j['pkt'].".".$j['pkf']."=".$j['fgkt'].".".$j['fgkf'];
                              }
                         }
                    }
                    
                    if($wheres) {
                         
                         $wh = " where ";
                         $i=0;
                         foreach($wheres as $w) {
                              if($i) {
                                   $wh .= " ".$w['logic']." ";
                              }
                              
                              $wh .= $w['pkt'].".".$w['pkf']." ".htmlspecialchars($w["option"]." '$w' ");
                              
                              $i++;
                         }
                    }
                    
                    if(!$groupby)
                         $groupby = "";
                    else
                         $groupby = "group by ".$groupby;
                    
                    if(!$orderby)
                         $orderby = "";
                    else
                         $orderby = "order by ".$orderby." ".$dirt;
                         
                    $SQL = "select ".$field." from ".$table." ".$joy." ".$wh." ".$groupby." ".$orderby;                                
                    
                    /* ทำการเซตจำนวน page ทั้งหมด */
                    $this->setTotalpage($this->genTotalPage($SQL, $this->getShowpage()));
                    
                    if($page > 0)
                         $SQL .= "limit ".$this->getStartPageLimit($page, $limited).",".$limited;
                    
               }
               else {
                    return $SQL;
               }
               
               
          }
          else {
               
               if(!$SQL) {
                    $SQL = "";
                    $values = "";
                    $fields = "";
                    
                    if($action == "insert") {
                         $i=0;
                         foreach($field as $ff) {
                              if($i) {
                                   $values .= ",";
                                   $fields .= ",";
                              }
                              
                              $fields .= $ff["pkf"];
                              $values .= "'".htmlspecialchars($ff,ENT_QUOTES)."'";
                              
                              $i++;
                         }
                         
                         $SQL = $action." into ".$table."(".$fields.") values(".$values.")";
                    }
                    elseif($action == "update" || $action == "delete") {
                         $set = "";
                         foreach($field as $ff) {
                              $fields = $ff["pkf"];
                              $values = "'".htmlspecialchars($ff,ENT_QUOTES)."'";
                              if($set) {
                                   $set .= ",";                            
                              }
                                   
                              $set .= $fields."=".$values;
                         }
                         
                         if($wheres) {
                              $wh = "";
                              $i=0;
                              foreach($wheres as $w) {
                                   if($i) {
                                        $wh .= " ".$w['logic']." ";
                                   }
                                   
                                   $wh .= $w['pkt'].".".$w['pkf'].htmlspecialchars($w["option"]."'$w' ");
                                   
                                   $i++;
                              }
                         }
                         
                         if($action == "update") {
                              $SQL .= $action." ".$table." set ".$set." where ".$wh;
                         }
                         else {
                              $SQL .= $action." from ".$table." where ".$wh;
                         }
                    }
               }
               else {
                    return $SQL;
               }
               
          }
          
          return $SQL;
     }
     
	/**
	 * gets()
	 * @access public
	 * @param string xmlstring
	 * @return array result set	 
	 */
	public function gets($xml, $debug=false) {
		$M = new Mysql($this->getCfg());
          $SQL = $this->xml2sql($xml);
          
		$rs = $M->getData($SQL,$debug);
          
          if($rs) {
              
          }
          
          if($debug) {
               //return "";
          }
		
		unset($M);
		return $rs;
	}
	
	/**
	 * sets()
	 * @access public
	 * @param string xmlstring
	 * @return int lastinsert id or affected rows
	 */
	public function sets($xml, $debug=false) {
		$M = new Mysql($this->getCfg());
          
          $SQL = $this->xml2sql($xml);
          
          if($debug) {
               echo $SQL;
               return false;
          }
          
          $rs = $M->setData($SQL);
		
		$e = simplexml_load_string($xml);
		if($e->action == "insert") {
			$this->lastinsertid = $M->getLastinsertId();
		}
		else {
			$this->affectedrows = $M->getAffected();
		}
		
		unset($M);
		return $rs;
	}
	
     /**
      * setShowpage()
      * @param int showpage
      * @return bool true/false
      */
     public function setShowpage($showpage) {
          $this->_showpage = $showpage;
          return true;
     }
     
     /**
      * getShowpage()
      * @param void no parameter
      * @return int showpage
      */
     public function getShowpage() {
          return $this->_showpage;
     }
     
	/**
	 * setTotalpage()
	 * @access public
	 * @param int totalpage
	 * @return bool true and false
	 */
	public function setTotalpage($totalpage=false) {
		if($totalpage)
			$this->totalpages = $totalpage;		
		
		return true;
	}
	
	/**
	 * getTotalpage()
	 * @access public
	 * @param void
	 * @return int total page of last SQL statment
	 */
	public function getTotalpage() {
		return $this->totalpages;
	}
	
     /**
      * genTotalPage()
      * @param string sql statement
      * @return int number of total pages
      */
     public function genTotalPage($SQL = false, $showpage=false) {
          $M = new Mysql($this->getCfg());
          
          $M->getData($SQL);
          
          $tt = (int)$M->getRecordcount();
          
          $p =  (int)($tt/$showpage);
          $mod = ($tt%$showpage);
          
          if($mod)
               $p++;
          
          
          return $p;
     }
     
     /**
      * getPageLink()
      * @access public
      * @param string $xml
      * @return string HTML
      * 
      * @example HTML of this return
      * <div id="pagination">page label ค่าของแท็ก pagelabel ในไฟล์ mapping.xml
      *   <ul>
      *       <li><a onclick="url">เลขหน้า</a></li>
      *   </ul>
      * </div>
      */
     public function getPageLink($xml, $mapping=false) {
          
          if(!$mapping) {
               $mapping = "mapping.xml";
          }
          
          $e = simplexml_load_string($xml);
          $f = simplexml_load_file($mapping);
          
          $table = $e->table;
          $pagelabel = $f->table->$table->pagelabel;
          $totalpage = $this->getTotalpage();
          $page = $e->page;
          
          $link = $this->baseURL()."index.php?fn=".$this->loadControl();
          
          foreach ( $e->param as $para ) {
               $link .= "&".$para["name"]."=".$para;
          }
          
          $j=1;
          
          
          echo "\n<div class='pagination' align='center'>\n";
          echo "<ul>\n";
          echo "<b>$pagelabel</b>\n";
          if($page > 1 && $totalpage > 1) {
               //echo "<li><a onclick=\"location='".$this->curPageURL()."$link&page=".($page-1)."'\" class=\"prevnext\">prev</a></li>\n";
               echo "<li><a onclick=\"location='$link&page=".($page-1)."'\" class=\"prevnext\">prev</a></li>\n";
          }
          
          if($totalpage==1) {
               //echo "<li><a onclick=\"location='".$this->curPageURL()."$link&page=1'\" class=\"currentpage\">1</a></li>\n";
               echo "<li><a onclick=\"location='$link&page=1'\" class=\"currentpage\">1</a></li>\n";
         }
         else{
          
               for($i=1;$i<=$totalpage;$i++)
               {
                    
                    if($totalpage > 10) { 
                         
                         if($j == $page) {
                              //echo "<li><a onclick=\"location='".$this->curPageURL()."$link&page=$j'\" class=\"currentpage\">$j</a></li>\n";
                              echo "<li><a onclick=\"location='$link&page=$j'\" class=\"currentpage\">$j</a></li>\n";
                         }
                         else if($page < 5 && $i < 10) {
                              //echo "<li><a  onclick=\"location='".$this->curPageURL()."$link&page=1'\">$j</a></li>\n";
                              echo "<li><a  onclick=\"location='$link&page=1'\">$j</a></li>\n";
                         }
                         else if(($j < ($page+6)) && ($j > ($page-5))) { 
                              //echo "<li><a onclick=\"location='".$this->curPageURL()."$link&page=$j'\">$j</a></li>\n";
                              echo "<li><a onclick=\"location='$link&page=$j'\">$j</a></li>\n";
                         }
                         
                    
                    }
                    else {
                         
                         if($j == $page) {
                              //echo "<li><a onclick=\"location='".$this->curPageURL()."$link&page=$j'\" class=\"currentpage\">$j</a></li>\n";
                              echo "<li><a onclick=\"location='$link&page=$j'\" class=\"currentpage\">$j</a></li>\n";
                         }
                         else { 
                              //echo "<li><a onclick=\"location='".$this->curPageURL()."$link&page=$j'\">$j</a></li>\n";
                              echo "<li><a onclick=\"location='$link&page=$j'\">$j</a></li>\n";
                         }
                    }
                    
                    $j++;
               }
     }    
     
          if(($page < $totalpage) && ($totalpage > 1))
           {
               //echo "<li><a  onclick=\"location='".$this->curPageURL()."$link&page=".($page+1)."'\" class=\"prevnext\">next</a></li>\n";
               echo "<li><a  onclick=\"location='$link&page=".($page+1)."'\" class=\"prevnext\">next</a></li>\n";
           }
           
          //echo "<li>".$this->getRecordcount()."</li>";
          echo "</ul>\n";
          echo "</div>\n";
          
     }
     
     /**
      * @param int current page
      * @param int number recorde per page have to show
      * @return int number start page to, limit
      */
     public function getStartPageLimit($page=false, $limited=false) {
          
          if(!$limited) {
               $limited = $this->getShowpage();
          }   
   
          if($page>0) {
               $page = $page - 1;
          }
          
          return $page*$limited;
     }
     
	/**
	 * getLastInsertId()
	 * @access public
	 * @param void
	 * @return int Last insert id of last INSERT statment
	 */
	public function getLastInsertId() {
		return $this->lastinsertid;
	}
	
	/**
	 * getAffecedRows()
	 * @access public
	 * @param void
	 * @return int number of Affected rows on UPDATE and DELETE statment
	 */	
	public function getAffectedRows() {
		return $this->affectedrows;
	}
	
     
	/**
      * getPageLimit()
      * 
      */
}
?>