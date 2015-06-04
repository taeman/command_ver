<?php 

class checkVitayaSalary extends utility{
	
		public function __construct($salary_income='',$salary_increases='',$radub_new){
			$this->debug = "off";
			$this->salary_income = $salary_income;
			$this->salary_increases = $salary_increases;
			$this->radub_new = $radub_new;
			$this->dbNow = "cmss_".$this->siteNow;
			$this->salary = new check_salary_level;
		}
		
		public function checkExp(){
			if($this->salary_increases>=$this->salary_income && $this->salary->check($this->radub_new,$this->salary_increases,date("Y-m-d")) == true){ # เงินเดือนถูกต้อง
				return true;				
			}else{
				return false;	
			}
		}

		public function showExp(){
				
			echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
             	echo "<font color=\"#6A3500\"><b>เงื่อนไข :</b>ตรวจสอบเงินเดือนในช่องที่ได้รับ เท่ากับเงินเดือนเดิมหรือถ้าสูงกว่าต้องสามารถเทียบขั้นได้ว่าตามอันดับที่ได้เลื่อนไม่มีเงินเดือนเงินเดือนขั้นนั้น</font>";
          	 	echo '</div>';
		}
	
}


class check_salary_level{
    private $radub;
    private $money;
    private $xdate;
    var $radub_id;
    private $db_master="cmss_master";
    private $array_level_upper;
    private $xstatus=false;
	 private $levelnow="";
	 var $positionname="";
	var $arr_pos_sp=array('แพทย์','นักกฎหมายกฤษฎีกา','การเกษตร','ประมง','ป่าไม้','สัตวบาล','อุตุนิยมวิทยา','อุทกวิทยา','สาธารณสุข','สัตวแพทย์','ช่างศิลปกรรม','ช่างเครื่องกล','ปฏิบัติงาน','ช่างเทคนิค','ช่างไฟฟ้า','นายช่างไฟฟ้า','ช่างโยธา','ช่างรังวัด','ช่างสำรวจ','ช่างชลประทาน','นายช่างศิลปกรรม','นายช่างเครื่องกล','นายปฏิบัติงาน','นายช่างเทคนิค','นายช่างไฟฟ้า','นายช่างโยธา','นายช่างรังวัด','นายช่างสำรวจ','นายช่างชลประทาน');
    
    function  check_salary_level($radub="",$money="",$xdate=""){
        if($xdate!=""){$this->xdate=$xdate;}
        if($this->xdate==""){$this->xdate=date('Y-m-d');}  
        if($radub!=""){$this->radub=$radub;}
        if($money!=""){$this->money=$money;}        
        
    }
     function over_level($xdate=""){
        if($xdate!=""){$this->xdate=$xdate;}
        $arr=explode("-",$this->xdate);
        $mk_start=mktime(0,0,0,10,1,2010);
        $mk_stop=mktime(0,0,0,date('n'),date('j'),(date('Y')+1));
        $mkcheck=mktime(0,0,0,$arr[1]*1,$arr[2]*1,$arr[0]*1);
        if($mkcheck>=$mk_start && $mkcheck<=$mk_stop){
            return true;
        }else{
            return false;
        }
        
    } 
    function check_useprofile38($xdate){
        $arr=explode("-",$this->xdate);
        $mk_start=mktime(0,0,0,10,1,2009);
        $mk_stop=mktime(0,0,0,date('n'),date('j'),(date('Y')+1));
        $mkcheck=mktime(0,0,0,$arr[1]*1,$arr[2]*1,$arr[0]*1);
        //if($mkcheck>=$mk_start ){
			  if($mkcheck>=$mk_start && $mkcheck<=$mk_stop){
            return true;
        }else{
            return false;
        }
    }
   function genurl($radub="",$money="",$xdate=""){
       $db_master=$this->db_master; 
        if($xdate!=""){$this->xdate=$xdate;}
        if($radub!=""){$this->radub=$radub;}
        if($money!=""){$this->money=$money;} 
        $this->get_radubid($this->radub); 
        //echo $this->radub_id;         
        $pos_38=$this->check_pos_38($this->radub_id);
        if($pos_38){
           $pos_38=$this->check_useprofile38($this->xdate);
        }    
        if($pos_38){
        $xcond="select tbl_salary_profile.profile_id,tbl_salary_profile.profile
FROM
tbl_salary_profile
        Inner Join tbl_salary_radub ON tbl_salary_profile.profile_id = tbl_salary_radub.profile_id
        Inner Join tbl_salary_math_radub ON tbl_salary_radub.salary_radub_id = tbl_salary_math_radub.salary_radub_id
        Inner Join hr_addradub ON hr_addradub.runid = tbl_salary_math_radub.radub_id      
         WHERE tbl_salary_profile.active_status='1'  AND ( '$this->xdate'   between   tbl_salary_profile.date_start and  if(tbl_salary_profile.date_stop is null ,'$this->xdate' ,tbl_salary_profile.date_stop) )   AND tbl_salary_profile.profile_type='2' group by   tbl_salary_profile.profile_id  limit 1";
      //AND hr_addradub.radub='$this->radub'
	    }else{
        $xcond="select tbl_salary_profile.profile_id,tbl_salary_profile.profile
FROM
tbl_salary_profile
        Inner Join tbl_salary_radub ON tbl_salary_profile.profile_id = tbl_salary_radub.profile_id
        Inner Join tbl_salary_math_radub ON tbl_salary_radub.salary_radub_id = tbl_salary_math_radub.salary_radub_id
        Inner Join hr_addradub ON hr_addradub.runid = tbl_salary_math_radub.radub_id      
         WHERE tbl_salary_profile.active_status='1'  AND ( '$this->xdate'   between   tbl_salary_profile.date_start and  if(tbl_salary_profile.date_stop is null ,'$this->xdate' ,tbl_salary_profile.date_stop) )  AND hr_addradub.radub='$this->radub' AND tbl_salary_profile.profile_type='1' group by   tbl_salary_profile.profile_id limit 1 "; 
        }  
   
           $result=mysql_db_query($db_master,$xcond);
           while($row=mysql_fetch_array($result)){
			 if($pos_38){  
           		 $url[]="http://61.19.255.75/competency_master/application/salary_mangement/salary_report_degree.php?profile_id=$row[profile_id]";   
			 }else{
			 	$url[]="http://61.19.255.75/competency_master/application/salary_mangement/salary_report.php?profile_id=$row[profile_id]";   
			 }
           }
           if($result){ mysql_free_result($result);} 

        return $url;
   } 
   private function checkmathradub($radub1){
    $sql="SELECT   `date`,  radub, salary  FROM salary where id='$xidcard' and date(`date`)<date('$date_sel') order by  date(`date`) desc  limit  1  ";    
        
    $array_radub['ปฏิบัติการ']=array('3','4','5');  
    $array_radub['ชำนาญการ']=array('6','6ว','7','7ว','7วช');  
    $array_radub['ชำนาญการพิเศษ']=array('8','8ว','8วช');     
    $array_radub['เชียวชาญ']=array('9วช','9ชช');  
    $array_radub['ทรงคุณวุฒิ']=array('10วช','10ชช','11วช','11ชช');       
    $array_radub['ปฏิบัติงาน']=array('1','2','3','4'); 
    $array_radub['ชำนาญงาน']=array('5','6');    
    $array_radub['อาวุโส']=array('7','8');       
    $array_radub['ทักษะพิเศษ']=array('9ชช');     
   
  //1
      $radub="";
      $arr=$array_radub[$radub2]; 
      if(count($arr)>0){
       if (in_array($radub1, $arr)){
            $radub=$radub2;
       }
      }
      if($radub==""){
        $arr=$array_radub[$radub1]; 
        if(count($arr)>0){  
            if (in_array($radub2, $arr)){ 
             $radub=$radub1;    
            }
        }
      }
      return $radub;
    
   }
    function  get_max($radub="",$xdate=""){
        if($xdate!=""){$this->xdate=$xdate;}
        if($radub!=""){$this->radub=$radub;} 
        $this->get_radubid($this->radub);
        $pos_38=$this->check_pos_38($this->radub_id);
        if($pos_38){
           $pos_38=$this->check_useprofile38($this->xdate);
        }
               if($pos_38){// เปอร์เซ น
                   $get_lv=$this->calculate_getlevelmoney_now($this->money,$this->radub,">=","2",$this->radub_id,"1",$this->xdate);
               }else{
                   $get_lv=$this->calculate_getlevelmoney_now($this->money,$this->radub,">=","1",$this->radub_id,"1",$this->xdate);
               } 
         return      $get_lv;  
    }
    function check($radub="",$money="",$xdate=""){
		$radub=str_replace( 'ปฎิบัติการ','ปฏิบัติการ',$radub);
        if($xdate!=""){$this->xdate=$xdate;}
        if($radub!=""){$this->radub=$radub;}
        if($money!=""){$this->money=$money;} 
        $this->get_radubid($this->radub);
        $pos_38=$this->check_pos_38($this->radub_id);
        if($pos_38){
           $pos_38=$this->check_useprofile38($this->xdate);
        }
        
 
        if($pos_38){// เปอร์เซน
           $get_lv=$this->calculate_getlevelmoney_now($this->money,$this->radub,"=","2",$this->radub_id,"0",$this->xdate);
            if(is_array($get_lv)){
                $this->xstatus= true;
            }else{
			   //เงินเดือนเกินขั้น
			 $max_level=  $this->get_max($radub,$xdate);
			 if($max_level[maxmoney]>0){
			  if($this->money>$max_level[maxmoney]){
			  	 $this->xstatus= true;
				 $get_lv=$this->calculate_getlevelmoney_now($max_level[maxmoney],$this->radub,"=","2",$this->radub_id,"0",$this->xdate);
			  }
			 }
			}              
             
        }else{//ไม่ใช่ 38 ค    
		     
          $get_lv = $this->calculate_getlevelmoney_now($this->money,$this->radub,"=","1",$this->radub_id,"0",$this->xdate);
		  
            if(is_array($get_lv)){
				
                $this->xstatus= true;
            }else{
			  
               $get_lvmax=$this->calculate_getlevelmoney_now($this->money,$this->radub,"=","1",$this->radub_id,"1",$this->xdate);
			  	
              if(is_array($get_lvmax)){
                
                   if($this->money > $get_lvmax[maxmoney]){
					    
                    if($this->over_level($this->xdate)){// ใช้กฎ ขั้มขันหรือป่าว
                              $arr_overlv=$this->get_up_level($this->radub_id);  
							  
                             $get_lv=$this->calculate_getlevelmoney_now($this->money,$arr_overlv[radub_upper],"=","1",$arr_overlv[level_upper],"0",$this->xdate);
                      
                        if(is_array($get_lv)){
                             $this->xstatus= true;
                        }else{
							//edit
							 $get_lvmax=$this->calculate_getlevelmoney_now($this->money,$arr_overlv[radub_upper],"=","1",$arr_overlv[level_upper],"1",$this->xdate);
							 
							//echo $this->money." > ".$get_lvmax[maxmoney];
						   if($this->money < $get_lvmax[maxmoney]){
								$this->xstatus= true;
							}else{
								$this->xstatus=false; 
							}
                        }
						
                    }else{
                        $this->xstatus=false;  
                    } 
                   }else{
                       
                    if($this->over_level($this->xdate)){// ใช้กฎ ขั้มขันหรือป่าว
                              $arr_overlv=$this->get_up_level($this->radub_id);                                                   
                             $get_lv=$this->calculate_getlevelmoney_now($this->money,$arr_overlv[radub_upper],"=","1",$arr_overlv[level_upper],"0",$this->xdate);
                       
                        if(is_array($get_lv)){
                             $this->xstatus= true;
                        }else{
                             $this->xstatus=false; 
                        }
                    }else{
                        $this->xstatus=false;  
                    }  
                       
                   }
              }else{
                 $this->xstatus=false;  
              }           
            
            
            }
        }   
     
        $this->levelnow=$get_lv;
        return   $this->xstatus;    
        
    }
    function get_levelnow(){
	 return $this->levelnow;
	}
    function get_up_level($level_nowid){     
    $db_master=$this->db_master; 
       if(!isset($this->array_level_upper)) {
           $sql="SELECT level_now,runno_now,radub_now,level_upper,runno_upper,radub_upper FROM `up_levelmoney_upper` where status='1'";
           $result=mysql_db_query($db_master,$sql);
           while($row=mysql_fetch_array($result)){
             $this->array_level_upper[$row['level_now']]=$row;             
           }
           if($result){ mysql_free_result($result);}
       }
       return  $this->array_level_upper[$level_nowid];
}
    function calculate_getlevelmoney_now($salary,$radub,$consy="=",$chk_mode="1",$radub_id="",$ismax="0",$date=""){
        $db_master=$this->db_master; 
		
		if(in_array($this->positionname,$this->arr_pos_sp)&&in_array($radub,array('ทรงคุณวุฒิ','อาวุโส'))){
	    	 $str_sp=" and tbl_salary_level_degree.status_salary ='1'";
			
	 }else{
	     $str_sp=" and tbl_salary_level_degree.status_salary ='0' ";
		 
	 }		
		
		
		
        if($date!=""){
         $xcond_in1="SELECT profile_id FROM tbl_salary_profile Where  active_status='1'  AND  '$date'   between   tbl_salary_profile.date_start and  if(tbl_salary_profile.date_stop is null ,'$date' ,tbl_salary_profile.date_stop)";
          $xcond_in2=" AND ( '$date'   between   tbl_salary_profile.date_start and  if(tbl_salary_profile.date_stop is null ,'$date' ,tbl_salary_profile.date_stop))";
        }else{
            $xcond_in1="SELECT profile_id FROM tbl_salary_profile Where  active_status='1'";
            $xcond_in2="";
        }
     $values=NULL;
    if($chk_mode=="2"){// 38 ค
    if($radub=="อาวุโส"){
        
    }
    
     if($ismax){
        $sql="SELECT
        tbl_salary_radub.radub_label,
        tbl_salary_level_degree.level_cal as level,
        min(tbl_salary_level_degree.min_salary) as minmoney,        
        max(tbl_salary_level_degree.max_salary) as maxmoney,
        hr_typeposition.type_position,
        tbl_salary_math_radub.salary_radub_id as radub_id,
        tbl_salary_level_degree.status_salary
        FROM
        tbl_salary_profile
        Inner Join tbl_salary_radub ON tbl_salary_profile.profile_id = tbl_salary_radub.profile_id
        Inner Join tbl_salary_math_radub ON tbl_salary_radub.salary_radub_id = tbl_salary_math_radub.salary_radub_id
        Inner Join hr_addradub ON hr_addradub.runid = tbl_salary_math_radub.radub_id
        Inner Join tbl_salary_level_degree ON tbl_salary_radub.salary_radub_id = tbl_salary_level_degree.salary_radub_id
        Inner Join hr_typeposition ON hr_addradub.type_id = hr_typeposition.type_id
        WHERE tbl_salary_profile.active_status='1' AND tbl_salary_profile.profile_type='2' $xcond_in2 AND hr_addradub.radub='$radub' $str_sp
        GROUP BY tbl_salary_math_radub.radub_id 
        ORDER BY hr_typeposition.type_id,tbl_salary_math_radub.salary_radub_id,tbl_salary_radub.radub_label desc"; 
         
     }else{
        $sql="SELECT
        tbl_salary_radub.radub_label,
        tbl_salary_level_degree.level_cal as level,
        tbl_salary_level_degree.min_salary,
        tbl_salary_level_degree.medium_salary as money,
        tbl_salary_level_degree.max_salary,
        hr_typeposition.type_position,
        tbl_salary_math_radub.salary_radub_id as radub_id,
        tbl_salary_level_degree.status_salary
        FROM
        tbl_salary_profile
        Inner Join tbl_salary_radub ON tbl_salary_profile.profile_id = tbl_salary_radub.profile_id
        Inner Join tbl_salary_math_radub ON tbl_salary_radub.salary_radub_id = tbl_salary_math_radub.salary_radub_id
        Inner Join hr_addradub ON hr_addradub.runid = tbl_salary_math_radub.radub_id
        Inner Join tbl_salary_level_degree ON tbl_salary_radub.salary_radub_id = tbl_salary_level_degree.salary_radub_id
        Inner Join hr_typeposition ON hr_addradub.type_id = hr_typeposition.type_id
        WHERE tbl_salary_profile.active_status='1' AND tbl_salary_profile.profile_type='2'  $xcond_in2  AND hr_addradub.radub='$radub' 
        AND (  '$salary' between tbl_salary_level_degree.min_salary and   tbl_salary_level_degree.max_salary) $str_sp
        ORDER BY hr_typeposition.type_id,tbl_salary_math_radub.salary_radub_id,tbl_salary_radub.radub_label ASC"; 
    }
    
        
    }else{
        if($ismax){
            $sql="SELECT
            tbl_salary_math_radub.salary_radub_id as radub_id,
            max(salary_level_id) as level_id,
            max(tbl_salary_level.level) as maxlevel,
            max(tbl_salary_level.money) as maxmoney
            FROM
            hr_addradub
            Inner Join tbl_salary_math_radub ON hr_addradub.runid = tbl_salary_math_radub.radub_id
            Inner Join tbl_salary_level ON tbl_salary_math_radub.salary_radub_id = tbl_salary_level.salary_radub_id
            Inner Join tbl_salary_radub ON tbl_salary_level.salary_radub_id = tbl_salary_radub.salary_radub_id
            where  hr_addradub.radub='$radub'  and  tbl_salary_radub.profile_id in($xcond_in1)
            GROUP BY tbl_salary_math_radub.radub_id order by tbl_salary_math_radub.salary_radub_id"; 
        }else{
        $sql="SELECT
            hr_addradub.radub,
            tbl_salary_math_radub.salary_radub_id as radub_id,
            salary_level_id as level_id,
            tbl_salary_level.level as level,
            tbl_salary_level.money as money
            FROM
            hr_addradub
            Inner Join tbl_salary_math_radub ON hr_addradub.runid = tbl_salary_math_radub.radub_id
            Inner Join tbl_salary_level ON tbl_salary_math_radub.salary_radub_id = tbl_salary_level.salary_radub_id
            Inner Join tbl_salary_radub ON tbl_salary_level.salary_radub_id = tbl_salary_radub.salary_radub_id
            where  hr_addradub.radub='$radub'  and tbl_salary_level.money $consy '$salary' and  tbl_salary_radub.profile_id in($xcond_in1) order by tbl_salary_level.money limit 1";
       }
     
    }  
	
      $result=mysql_db_query("$db_master",$sql);
      $row=mysql_fetch_assoc($result);
      $values=$row;
	  
      if($result){mysql_free_result($result);}               
   return $values;        
  }
   function calculate_getbasemoney_now($level,$radub,$date=""){
        $db_master=$this->db_master; 
        if($date!=""){
         $xcond_in1="SELECT profile_id FROM tbl_salary_profile as tbl_salary_profile  Where  active_status='1'  AND  '$date'   between   tbl_salary_profile.date_start and  if(tbl_salary_profile.date_stop is null ,'$date' ,tbl_salary_profile.date_stop)";
          $xcond_in2=" AND ( '$date'   between   tbl_salary_profile.date_start and  if(tbl_salary_profile.date_stop is null ,'$date' ,tbl_salary_profile.date_stop))";
        }else{
            $xcond_in1="SELECT profile_id FROM tbl_salary_profile as tbl_salary_profile  Where  active_status='1'";
            $xcond_in2="";
        }
     $values=NULL;
 
       
        $sql="SELECT
            hr_addradub.radub,
            tbl_salary_math_radub.salary_radub_id as radub_id,
            salary_level_id as level_id,
            tbl_salary_level.level as level,
            tbl_salary_level.money as money
            FROM
            hr_addradub
            Inner Join tbl_salary_math_radub  as tbl_salary_math_radub ON hr_addradub.runid = tbl_salary_math_radub.radub_id
            Inner Join tbl_salary_level  as tbl_salary_level ON tbl_salary_math_radub.salary_radub_id = tbl_salary_level.salary_radub_id
            Inner Join tbl_salary_radub as tbl_salary_radub ON tbl_salary_level.salary_radub_id = tbl_salary_radub.salary_radub_id
            where  hr_addradub.radub='$radub'  and  tbl_salary_level.level = '$level' and  tbl_salary_radub.profile_id in($xcond_in1)";
      
     

      $result=mysql_db_query("$db_master",$sql);
      $row=mysql_fetch_assoc($result);
      $values=$row;
      if($result){mysql_free_result($result);}               
   return $values;  
      
  }
  function getbasemoney_now($salary,$level,$radub,$date=""){
        $db_master=$this->db_master; 
        if($date!=""){
         $xcond_in1="SELECT profile_id FROM tbl_salary_profile as tbl_salary_profile  Where  active_status='1'  AND  '$date'   between   tbl_salary_profile.date_start and  if(tbl_salary_profile.date_stop is null ,'$date' ,tbl_salary_profile.date_stop)";
          $xcond_in2=" AND ( '$date'   between   tbl_salary_profile.date_start and  if(tbl_salary_profile.date_stop is null ,'$date' ,tbl_salary_profile.date_stop))";
        }else{
            $xcond_in1="SELECT profile_id FROM tbl_salary_profile as tbl_salary_profile  Where  active_status='1'";
            $xcond_in2="";
        }
     $values=NULL;
 
       
        $sql="SELECT
            tbl_salary_level.money as money
            FROM
            hr_addradub
            Inner Join tbl_salary_math_radub  as tbl_salary_math_radub ON hr_addradub.runid = tbl_salary_math_radub.radub_id
            Inner Join tbl_salary_level  as tbl_salary_level ON tbl_salary_math_radub.salary_radub_id = tbl_salary_level.salary_radub_id
            Inner Join tbl_salary_radub as tbl_salary_radub ON tbl_salary_level.salary_radub_id = tbl_salary_radub.salary_radub_id
            where  hr_addradub.radub='$radub' and tbl_salary_level.money >=".$salary." and  tbl_salary_radub.profile_id in($xcond_in1) ORDER by tbl_salary_level.money asc LIMIT 1";
      
     

      $result=mysql_db_query("$db_master",$sql);
      $row=mysql_fetch_assoc($result);
      $values=$row[money];
      if($result){mysql_free_result($result);}               
   return $values;  
      
  }

  function calculate_money($money){
    // แหลงเป้นจำนวนเต็ม 10
   $money= floor($money); 
   $arr=explode(".",$money);
   $str_money=$arr[0];   
   $unit=substr($str_money,strlen($str_money)-1,1);
   $str_money=$money+(10-$unit);
   return  $str_money;  
   
}
    
     function get_radubid($name){
        $name=trim($name);
        $sql="SELECT runid, level_id, radub FROM `hr_addradub` where radub='$name'";
        $result=@mysql_db_query($this->db_master,$sql);
        $row=@mysql_fetch_assoc($result);
        @mysql_free_result($result);
        $this->radub_id=$row[level_id];
    }
	
	//@modify Jullachai เพิ่มเงื่อนไข ไม่ให้ดึงบางตำแหน่งมาคิดด้วย
     function check_pos_38($level_id){
        $sql="SELECT  substr(hr_addposition_now.pid,1,1) as group_pid
        FROM
        position_math_radub
        Inner Join hr_addposition_now ON position_math_radub.position_id = hr_addposition_now.runid
        Inner Join hr_addradub ON position_math_radub.radub_id = hr_addradub.runid
        where  hr_addradub.level_id='$level_id' AND `ignore_salary`<>1
        group by group_pid having  group_pid=5";
        $result=@mysql_db_query($this->db_master,$sql);
        $row=@mysql_fetch_assoc($result);
        @mysql_free_result($result);
        return  ($row[group_pid]==5)?true:false;
        
    }
    //@end
}
?>