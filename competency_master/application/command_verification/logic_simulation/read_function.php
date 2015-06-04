<?
/**
 * Created by JetBrains PhpStorm.
 * User: sanitkeawtawan
 * Date: 11/13/11 AD
 * Time: 4:25 PM
 */
 header("Content-Type: text/html; charset=windows-874");
if (!defined('APPPATH')) {define('APPPATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);}

class read_Reflection{
    
    public function classReflection($path_file, $file)
    {
        $controllers=array();
     if (is_file($path_file.$file)) {
         if (strpos($file, '.php')) {
          $class = explode('.php', $file);
		  //$class = str_replace($path_file,"",$class);
          array_pop($class);
          $class = ucwords(implode('', $class));
          if (!class_exists($class)) {
           		require_once($path_file.$file);
          }

          $classReflection = new ReflectionClass($class);
          $classComment = $classReflection->getDocComment();
          $classTags = $this->__getDocTags($this->__commentToArray($classComment));
		  
		  //print_r($classTags);
          // return array('class'=>$class,'classComment'=>$classComment,'classTags'=>$classTags);
          $actions = $this->get_this_class_methods($class);
          foreach ($actions as $a) {
         //  if ($a === $class || strpos($a, '_') === 0){
         //  continue;
         // }
           // Get Reflection method
           $methodReflection = $classReflection->getMethod($a);
           // Get Comment
           $comment = $methodReflection->getDocComment();
           $tags='';
           if ($comment){
                $tags = $this->__getDocTags($this->__commentToArray($comment));
           }
           $public_actions[$a] = array(
            'methodComment' => $comment,
            'methodTags' => $tags,
           );

           }
        $controllers[$class] = array(
        'classComment' => $classComment,
        'classTags' => $classTags,
        'actions' => $public_actions,
        );
        }
     }
      return $controllers;
    }
    function __commentToArray($sDocComment = ''){
        $sDocComment = preg_replace("/(^[\\s]*\\/\\*\\*)
        |(^[\\s]\\*\\/)
        |(^[\\s]*\\*?\\s)
        |(^[\\s]*)
        |(^[\\t]*)/ixm", "", $sDocComment);

        $sDocComment = str_replace("\r", "", $sDocComment);
        $sDocComment = preg_replace("/([\\t])+/", "\t", $sDocComment);
        $aDocCommentLines = explode("\n", $sDocComment);

        return $aDocCommentLines;
    }

    function __getDocTags($docCommentArray){
        $tags = array();
        $currentTag = null;foreach ($docCommentArray as $line) {
        $line = trim($line);
        if (isset($line[0]) && $line[0] == '@') {
            $lineArray = explode(' ', $line);
            $lineArray = array_reverse($lineArray);
            $currentTag = str_replace('@', '', array_pop($lineArray));
            $lineArray = array_reverse($lineArray);
            $line = implode(' ', $lineArray);
            $tags[$currentTag][] = $line;
        } else {
        if ($currentTag !== null && $line != '*/') {
            $tags[$currentTag][] .= "\n" . $line;
        }
        }
        }

        return $tags;
    }
    function get_this_class_methods($class){
      $array1 = get_class_methods($class);
      if($parent_class = get_parent_class($class)){
        $array2 = get_class_methods($parent_class);
        $array3 = array_diff($array1, $array2);
      }else{
        $array3 = $array1;
      }
      return($array3);
    }
}
/*
require_once("class/class.utility.php");
//require_once("../class/class.expPosition.php");

$r= new read_Reflection();
$c=$r->classReflection('variable/expPosition.php');
echo"<pre>";

echo str_repeat('=',50)."Class".str_repeat('=',50)."<br>";
foreach($c as $classname=>$detail){
    echo"Class : $classname <br>";
    echo"Comment : <br> $detail[classComment] <br>";
    echo"ClassTAG : <br> ";
    foreach($detail['classTags'] as $Tag=>$Tagcomment){
       echo"&nbsp;&nbsp;$Tag : $Tagcomment<br>";
    }
    echo str_repeat('=',50)."Method".str_repeat('=',50)."<br>";
    foreach($detail['actions'] as $Action_name=>$actions){
        echo"Method : $Action_name<br>";
        echo"Comment :<br>$actions[methodComment]<br>";
        echo"MethodTAG :<br>";
      foreach($actions['methodTags'] as $method=>$Tags){
         echo"&nbsp;&nbsp;$method : $Tags<br>";
      }
      echo str_repeat('=',50)."<br>";
    }
}

*/
?>