<?php
/**
* @comment ไฟล์สำหรับระบบตรวจสอบคำสั่ง
* @projectCode 57CMSS10
* @tor 10.2.1.5
* @package core
* @author Nattapong Charoensook
* @access public
* @created 13/11/2557
*/
 
 //----------------------------------------------------------------
 
 /**
 * CG_form Class
 *
 * @package     System from Exiting
 * @subpackage  Libraries
 * @category  Form
 * @author    Nattapong Charoensook
 * @link    http://www.na2bgroup.com
 */
require_once("Core.php");
class Form extends Core {
	
	/**
	 * @param string html from form
	 * @return string html for put to database
	 */
	public function encodeHTML($html=false) {
		return htmlspecialchars($html,ENT_QUOTES);
	}
	
	/**
	 * @param string html from database
	 * @return string html from form
	 */
	public function decodeHTML($html=false) {
		return htmlspecialchars_decode($html,ENT_QUOTES);
	}
	
	
	/**
	 * showDebug()
	 * @access protected
	 * @param string msg
	 * @param string class of debug รูปแบบของ CSS ว่าจะเป็น warning, error, show or notice
	 * @return string HTML for show debug msg
	 */
	public function showDebug($msg, $class="error" ) {
		$html = "<div class=\"debug-$class\">";
			$html .= "$msg";
		$html .= "</div>";
				
		return $html;
	}
	
	/**
	 * @param void ()
	 * @return Display text
	 */
	public function displayComponent($t=FALSE) {
		echo $t;
	}
	
	/**
	 * getLogin()
	 * @param string xml
	 * @param datatype paramname
	 * @param string mapping path
	 * @return string Form Box
	 */
	public function getLogin($table=false, $actpath=false, $mapping=false) {
		
		if(!$mapping) {
			$mapping = "mapping.xml";
		}
		
		if(!$actpath) {
			$actpath = "";
		}
		
		$f = simplexml_load_file($mapping);
		$t = $f->form->$table;
		$field = $f->form->$table->field;
		
		echo "<div id='login-wrapper'> \n" .
				"<div id='login-container'> \n";
		echo "<div id='login-title'>".$t['title']."</div>\n";
		echo "<form id='".$table."' name='".$table."' action='".$actpath."' method='post' enctype='multipart/form-data'> \n";
		
		foreach($field as $ff) {
			
			$param = $ff->param;
			$type = $ff->type;
			
				if($type!="hidden" && $type!="") {
					echo "<div class='lg-wrapper'> \n";
					echo "<div class='lg-label'> ".$ff->label."</div> \n"; // End div .f-label			
					echo "<div class='lg-input'>".$this->getComponent($ff)."</div> \n"; // End div .f-input			
					echo "</div>\n"; // End div .f-wrapper
				}
				else {
					echo $this->getComponent($ff)."\n";
				}
		}
		
		echo "<input type='hidden' name='formname' value='".$table."' />\n";
		echo "</form>\n"; // End form
		echo "</div>\n" . // End div #form-container
				"</div>\n"; // End div #form-wrapper
		
		return TRUE;
	}	
	
	/**
	 * @param string xml
	 * @param datatype paramname
	 * @param string mapping path
	 * @return string Form Box
	 */
	public function getFormInsert($table=false, $actpath=false, $mapping=false) {
		if(!$mapping) {
			$mapping = "mapping.xml";
		}
		
		if(!$actpath) {
			$actpath = "";
		}
		
		$f = simplexml_load_file($mapping);
		$t = $f->table->$table;
		$field = $f->table->$table->field; 
		
		$msg = "<div id='form-wrapper'> \n" .
				"<div id='form-container'> \n";
		$msg .= "<div id='form-title'>".$t['title']."</div>\n";
		$msg .= "<form id='".$table."' name='".$table."' action='".$actpath."' method='post' enctype='multipart/form-data'> \n";
		
		foreach($field as $ff) {
			
			$param = $ff->param;
			$type = $ff->type;
				if($type!="hidden" && $type!="") {
					$msg .= "<div class='f-wrapper'> \n";
					$msg .= "<div class='f-label'> ".$ff->label."</div> \n"; // End div .f-label			
					$msg .= "<div class='f-input'>".$this->getComponent($ff)."</div> \n"; // End div .f-input			
					$msg .= "</div>\n"; // End div .f-wrapper
				}
				else {
					$msg .= $this->getComponent($ff)."\n";
				}
		}
		
		$msg .= "<input type='hidden' name='formname' value='".$table."' />\n";
		$msg .= "</form>\n"; // End form
		$msg .= "</div>\n" . // End div #form-container
				"</div>\n"; // End div #form-wrapper
		
		return $this->displayComponent($msg);
	}
	
	/**
	 * getFormUpdate()
	 * @access public
	 * @param string xml
	 * @param string action path
	 * @param string path of mapping file
	 * @return sring Form for update
	 */
	public function getFormUpdate($xml, $actpath=false,$mapping=false) {
		if(!$mapping) {
			$mapping = "mapping.xml";
		}
		
		if(!$actpath) {
			$actpath = "";
		}
		
		$e = simplexml_load_string($xml);		
		$f = simplexml_load_file($mapping);
		
		$table = $e->table;
		$t = $f->table->$table;
		$field = $f->table->$table->field;
		
		$rs = $this->gets($xml);
		//print_r($rs);
		
		$msg = "<div id='form-wrapper'> \n" .
				"<div id='form-container'> \n";
		$msg .= "<div id='form-title'>".$t['title']."</div>\n";
		$msg .= "<form id='".$table."' name='".$table."' action='".$actpath."' method='post' enctype='multipart/form-data'> \n";
		
		foreach($field as $ff) {
			$name =  $ff["name"]; // ชื่อของฟิลด์ในฐานข้อมูล และ ใน mapping ไฟล์
			$param = $ff->param;
			$type = $ff->type;
				if($type!="hidden" && $type!="") {
					$msg .= "<div class='f-wrapper'> \n";
					$msg .= "<div class='f-label'> ".$ff->label."</div> \n"; // End div .f-label			
					$msg .= "<div class='f-input'>".$this->getComponent($ff,$rs[0]["$name"])."</div> \n"; // End div .f-input			
					$msg .= "</div>\n"; // End div .f-wrapper
				}
				else {
					$msg .= $this->getComponent($ff,$rs[0]["$name"])."\n";
				}
		}
		
		$msg .= "<input type='hidden' name='formname' value='".$table."' />\n";
		$msg .= "</form>\n"; // End form
		$msg .= "</div>\n" . // End div #form-container
				"</div>\n"; // End div #form-wrapper
		
		return $this->displayComponent($msg);
	}

     /**
      * getFormDelete()
      * @access public
      * @param string xml
      * @param string action path
      * @param string path of mapping file
      * @return sring Form for update
      */
	public function getFormDelete($xml, $actpath=false, $mapping=false) {
	    
          if(!$actpath) {
               $actpath = "";
          }
          
          if(!$mapping) {
               $mapping = "mappiing.xml";
          }
          
          $e = simplexml_load_string($xml);
          $f = simplexml_load_file($mapping);
          
          $table = $e->table;
          $t = $f->table->$table;
          $deletefield = $e->deletefield;
          
          $rs = $this->gets($xml);
          
          $msg = "<div id=\"form-wrapper\"> \n" .
                    "<div id=\"form-container\"> \n";
          $msg .= "<div id=\"form-title\">".$t['title']."</div>\n";
          $msg .= "<form id='".$table."' name='".$table."' action='".$actpath."' method='post' enctype='multipart/form-data'> \n";
               
               foreach($e->wheres as $wh) {
                    $msg .= "<input type=\"hidden\" name=\"".$wh["pkf"]."\" value=\"".$wh."\" />\n";
               }
               
               $msg .= "<div class='debug-error'>\n
                    <div class=\"debug-show\">คุณต้องการลบข้อมูล <span class=\"bb\">".$rs[0]["$deletefield"]."</span> ใ่ช่หรือไม่ <br/>
                    <br /><input type=\"submit\" name=\"formadd\" value=\" ลบข้อมูล \" />
                    </div>\n
               </div>\n";
               
          $msg .= "<input type='hidden' name='formname' value='".$table."' />\n";
          $msg .= "</form>\n"; // End form
          $msg .= "</div>\n" . // End div #form-container
                    "</div>\n"; // End div #form-wrapper
          
          return $this->displayComponent($msg);
	}
	
	/**
	 * @param Array object of each field from mapping.xml
	 * @return string component of HTML form
	 */
	public function getComponent($ff=FALSE ,$rsvalue=FALSE) {
		
		$dfvalue = $ff->defaultvalue;
		$dbfieldname = $ff['name'];
		
		if($ff->type=="submit" || $ff->type=="buttonAjax" || $ff->type=="button") {
			$dfvalue = " บันทึกข้อมูล ";
		}
		elseif($rsvalue) {
			$dfvalue = $rsvalue;
		}
		elseif($dfvalue=="get" || $dfvalue=="post" || $dfvalue=="") {
			$dfvalue = $this->decodeHTML($this->getParam($dbfieldname,$rsvalue));
		}		
		else {
			//$dfvalue
		}
			
		if($ff->type == "textarea") {
			$msg = "<textarea id=\"".$dbfieldname."\" ";
			foreach ($ff->param as $pp) {
				
				if($pp['field']=="value") {					
					$value = $this->getParam($dbfieldname,$pp);
				}
				
				$msg .= $pp['field']."=\"".$pp."\" ";
			}
			$msg .= ">".$dfvalue."</".$ff->type.">";
		}
		elseif($ff->type == "buttonAjax") {
			$msg = "";
			foreach ($ff->button as $bt) {
				$msg .= "<a ";
				foreach($bt->param as $pp) {
					$msg .= $pp['field']."=\"".$pp."\" ";
				}
				
				$msg .= "><span>".$bt->label."</span>";
			
				$msg .= "</a>";
			}
		}
		elseif($ff->type == "submit") {
			$msg = "<input type=\"".$ff->type."\" ";
			foreach ($ff->param as $pp) {
				$msg .= $pp['field']."=\"".$pp."\" ";
			}
			$msg .= " />";
		}
		elseif($ff->type == "dropdown") {
		     $ddtable = $ff->ddtable;
		     $idf = $ddtable["idfield"];
               $namef = $ddtable["namefield"];
               $first = $ddtable["first"];
               $order = $ddtable["order"];
               $xmlpath = $ff->xmlpath;
               
               $xml = "<command>
               <table>$ddtable</table>
               <action>select</action>
               <order>$order</order>
               <mapping>$xmlpath</mapping>
               <page>-1</page>
               </command>";
               //echo $this->xml2sql($xml);
               $rs = $this->gets($xml);
               //print_r($rs);
               $msg = "<select id=\"".$dbfieldname."\" ";
               
               foreach($ff->param as $pp) {
                    $msg .= $pp['field']."=\"".$pp."\" ";
               }
               
               $msg .= ">";
          
               if($first!="no") {
                    $msg .= "<option value='0'>".$first."</option>";
               }
               
               for($i=0; $i<$rs["rows"]; $i++) {
                    
                    if($dfvalue==$rs[$i]["$idf"])
                         $selected = "selected";
                    else
                         $selected = "";
                    
                    $msg .= "<option title=\"".$rs[$i]["$namef"]."\" value=\"".$rs[$i]["$idf"]."\" $selected >".$rs[$i]["$namef"]."</option>\n";
               }
                    
               $msg .= "</select>";
               
		}
		else {
			$msg = "<input id=\"".$dbfieldname."\" ";
			foreach ($ff->param as $pp) {
				$msg .= $pp['field']."=\"".$pp."\" ";
			}
			
			$msg .= "value=\"".$dfvalue."\" ";
			$msg .= "/>";
		}	
		
		
		return $msg;
	}
	
	public function getList($xml=false, $mapping=false, $debug=false) {
		if(!$mapping) {
			$mapping = "mapping.xml";
		}
		
		if(!$xml) {
			return false;
		}
		
		$e = simplexml_load_string($xml);
		$f = simplexml_load_file($mapping);
		
		$table = $e->table;
		$fn = $e->fn;
          
		if($e->modedit!="") {
			$modedit = $e->modedit;
		}
		else {
			$modedit = "edit";
		}
		
		if($e->moddel!="") {
			$moddel = $e->moddel;
		}
		else {
			$moddel = "delete";
		}
		
		$ff = $f->table->$table;
		
		$rs = $this->gets($xml,$debug);
		
		$title = $ff["title"];
		
		
		if($ff["width"]) {
			$width = "width=\"".$ff["width"]."\"";
		}
		else {
			$width = "width=\"778\"";
		}
		
		echo "<div class=\"list-title\">$title</div>\n";
		echo "<table $width cellspacing=\"1\" id=\"the-table\">\n";
		$i=0;
		foreach( $ff->field as $field ) {
			$showckeck = $field["show"];
			$class = $field["type"];
			
			
			if(!$i)	{
				echo "<thead>\n";
				echo "<tr>\n";
			}
			
			if($showckeck==1) {
				echo "<th class=\"list-$class\">";
					echo $field->label;
				echo "</th>\n";
				$i++;
			}
			
		}
		echo "<th width='75'>Option</th>\n";
		echo "</tr>\n";
		echo "</thead>\n";
		
		echo "<tbody>\n";
		
		for($i=0; $i<$rs["rows"]; $i++) {
			$ck = 0;
			echo "<tr>\n";
			foreach($ff->field as $field) {
				
				$n = $field["name"];
                    $class = $field["type"];
                    
				if(!$ck) {
					$key = "$n=".$rs[$i]["$n"];
				}
				if($field["show"]==1) {
					echo "<td class=\"list-$class\">".$rs[$i]["$n"]."</td>\n";
				}
				$ck++;
			}
			echo "<td>[<a onclick=\"location='?fn=$fn&mod=$modedit&$key'\">edit</a>] | [<a onclick=\"location='?fn=$fn&mod=$moddel&$key'\">del</a>]</td>";
			echo "</tr>\n";
		}
		echo "</tbody>\n";
		
		echo "</table>";
	}
	
	/**
	 * readForm()
	 * @access public
	 * @param string xml
	 * @param string mapping
	 * @return array post value
	 */
	public function readForm($post, $mapping=false) {
		$formname = $post["formname"];

 		$f = simplexml_load_file($mapping);
 		$a = array();
 		$aform = $f->table->$formname;
 		
 		foreach($aform->field as $ff) {
 			$type = $ff->type;
 			if($type!="buttonAjax" && $type!="button" && $type!="file" && $type!="textlink" && $type!="submit" ) {
 				$t = $ff["name"];
 				$a["$t"] = $post["$t"];
 			}
 		}
 		
 		return $a;
	}
	
	/**
	 * read2insert()
	 * @access public
	 * @param array post or $_POST
	 * @param string mapping real path of xml file
	 * @param bool debug
	 * @return int 0 for false insert and last ID of this rows
	 */
	public function read2insert($post, $mapping=false, $debug=false ) {
		$id = false; // return parameter
 		
 		$formname = $post["formname"];
 		$a = $this->readForm($post, $mapping);
 		
 		$key = array_keys($a);
 		$field = ""; // field name after take out formtype: submit, button, file and textlink
 		$value = ""; // values from form we need to insert on new record
 		
 		for($i=0; $i<count($key); $i++) {
 			$field .= $key[$i];
 			$value .= "'".htmlspecialchars($a[$key[$i]],ENT_QUOTES)."'";
 			if($i< (count($key)-1)) {
 				$field .= ",";
 				$value .= ",";
 			}
 		}
 		
 		$sql = "insert into ".$formname."(".$field.") values(".$value.") ";
 		$xml = "<command>" .
 				"<action>insert</action>" .
 				"<sql>".$sql."</sql>" .
 				"</command>";
 		
		
		if(!$debug) {
			$id = $this->sets($xml);
		}
		else {			
			echo $this->showDebug($sql,"warning");
			return false;
		}
		
		return $id ;
	}
	
	/**
	 * read2update()
	 * @access public
	 * @param array post or $_POST
	 * @param string mapping real path of xml file
	 * @param bool debug
	 * @return int 0 for false insert and last ID of this rows
	 */
	public function read2update($post, $mapping=false, $debug=false ) {
		$id = false;
 		
 		$formname = $post["formname"];
 		
 		$a = $this->readForm($post,$mapping);
 		
 		$key = array_keys($a);
 		
 		$field = "";
 		$value = "";
 		$set = false;
 		
 		for($i=1; $i<count($key); $i++) {
 			$field = $key[$i];
 			$value = "'".htmlspecialchars($a[$key[$i]],ENT_QUOTES)."'";
 			if($set) {
 				$set.=",";
 			}
 			
 			$set.= $field."=".$value;
 		}
 		
 		$sql = "update ".$formname." set ".$set." where ".$key[0]."=".$a[$key[0]];
 		
 		$xml = "<command>" .
 				"<action>update</action>" .
 				"<sql>".$sql."</sql>".
 				"</command>";
 				
 		if(!$debug) {
 			$id = $this->sets($xml);
 		}	
 		else {
 			echo $this->showDebug("Debug is set true <br> SQL: $sql","warning");
 			
 		}
 		
 		if(!$id) {
 			echo $this->showDebug("Function: Form::read2Update() <br> SQL: $sql","error");
 		}
 		
 		return $id;
	}
     
     /**
      * read2delete()
      * @access public
      * @param array $_POST
      * @param bool $debug
      * @return int $affected rows
      */
     public function read2delete($post, $mapping=false,$debug=false) {
          $formname = $post["formname"];
          
          if(!$mapping) {
               $mapping = "mapping.xml";
          }
          
           $a = $this->readForm($post, $mapping);
          
          $key = array_keys($a);
          
          $sql = "delete from ".$formname." where ".$key[0]."=".$a[$key[0]]." limit 1 ";
          $xml = "<command>" .
                    "<action>delete</action>" .
                    "<sql>".$sql."</sql>".
                    "</command>";
          
          if(!$debug) {
               $id = $this->sets($xml);
          }    
          else {
               echo $this->showDebug("Debug is set true <br> SQL: $sql","warning");
          }
          
          return $id;
     }
     
     /**
      * getInfoRecord()
      * @access public
      * @param array $_POST
      * @param string $mapping
      * @return string $msg
      */
     public function getInfoRecord($post, $mapping=false) {
          if(!$mapping) {
               $mapping = "mapping.xml";
          }
          
          $tablename = $post["formname"];
          
          $f = simplexml_load_file($mapping);
          
          $tb = $f->table->$tablename;
          
          $msg = "<span class=\"bb\">ข้อมูล</span> <br />";
          foreach($tb->field as $ff) {
               if($ff["show"]==1) {
                    $n = $ff["name"];
                    $msg .= "<span class=\"bb\">".$ff->label."</span> : ".$post["$n"]."<br />";
               }
          }
          
          return $msg;
     }
}
?>
