<?php
/**
* @comment ตรวจสอบอัตรากำลังว่าตำแหน่งรองผู้อำนวยการสถานศึกษาว่าง
* @projectCode 57CMSS10
* @tor  -
* @package core
* @author Supachai
* @access private
* @created 21/1/2558
*/

class checkEmptySchoolDeputyDirectorPosition extends checkEmptyTeacherPosition{
	
		public $profile_id;
		private $template_id=""; 
		private $input_data=array();
		private $data=array();
		private $limit_lowcase=120;
		private $std_conf=array();
		private $workforce_std=array();
	
	function std_conf_workforce(){
        $this->std_conf['a']['room']="30";
        $this->std_conf['a']['teacher']="25"; 
        $this->std_conf['p']['room']="40";
        $this->std_conf['p']['teacher']="25"; 
        $this->std_conf['m']['room']="40";
        $this->std_conf['m']['teacher']="20"; 
    }
	
	public function getProfileId(){
		$sql = "SELECT profile_id FROM analyze_profile order by profile_id desc";
		$res = mysql_db_query('cmss_'.$this->secid,$sql);
		$row=mysql_fetch_assoc($res);
		return $row['profile_id'];
	}
	
	public function getNumStudent(){
		$sql = "SELECT analyze_student.*,allschool.office AS schoolname FROM analyze_student LEFT JOIN {$this->dbMaster}.allschool ON analyze_student.schoolid=allschool.id WHERE profile_id='{$this->profile_id}' AND class_code NOT IN('17','18','19','27','28','29') ORDER BY allschool.office ASC";
		$res = mysql_db_query('cmss_'.$this->secid,$sql) or die(mysql_error());
		while($row = mysql_fetch_assoc($res)){
			$schoolid = $row['schoolid'];
			$class_code = $row['class_code'];
			$arr_student[$schoolid][$class_code]+= $row['student']; 
		}
		return $arr_student;
	}

	function get_student_all($profile_id,$schoolid){
		$dbsite = 'cmss_'.$this->secid;
		$dbmaster = $this->dbMaster;
		$sql = "SELECT analyze_student.*,allschool.office AS schoolname ,p_disciplines_class.labelcode 
		FROM analyze_student 
		LEFT JOIN $dbmaster.allschool ON analyze_student.schoolid=allschool.id 
		LEFT JOIN $dbmaster.p_disciplines_class ON p_disciplines_class.code = analyze_student.class_code
		WHERE profile_id='$profile_id' AND schoolid='$schoolid' AND class_code NOT IN('17','18','19','27','28','29') 
		ORDER BY allschool.office ASC";
		$res = mysql_db_query($dbsite,$sql) or die(mysql_error());
		
		while($row = mysql_fetch_assoc($res)){
			$label_code = $row['labelcode'];
			$prefix_label = substr($row['labelcode'],0,1);
			$arr_student[$prefix_label][$label_code]+= $row['student']; 
		}
		return $arr_student;
	}

	function get_teacher($profile_id,$schoolid){
		$dbsite = 'cmss_'.$this->secid;
		$dbmaster = $this->dbMaster;
		
		$obj = explode("_",$dbsite);
		$siteid = $obj[1];
		
		$sql3 = "SELECT 
		SUM(IF(analyze_j18.pid IN ('325001000','325001005','325001006','325001007','325001011','325471008','325471012') , 1, 0)) AS executive_cn ,
		SUM(IF(analyze_j18.pid IN('325001001','325001002','325001003','325001004','325001010','325471009','325471013','325481014','325481015'),1,0)) AS subexecutive_cn , 
		SUM(IF(substr(analyze_j18.pid,1,1)='4',1,0)) AS teacher_cn, 
		SUM(IF(NOT substr(analyze_j18.pid,1,1) IN ('3','4'),1,0)) AS support_cn,
		analyze_j18.schoolid 
		FROM analyze_j18  
		INNER JOIN analyze_general ON analyze_j18.CZ_ID = analyze_general.CZ_ID AND analyze_j18.profile_id = analyze_general.profile_id
		WHERE analyze_j18.profile_id='$profile_id' 
		AND analyze_j18.schoolid='$schoolid' AND analyze_j18.schoolid <> '$siteid'
		GROUP BY analyze_j18.schoolid ";

		$res3 = mysql_db_query($dbsite,$sql3) or die(mysql_error());
		unset($arr_teacher);
		while($row3 = mysql_fetch_assoc($res3)){
			$schoolid = $row3['schoolid'];
			$arr_teacher[$schoolid]['executive']+= $row3['executive_cn']; 
			$arr_teacher[$schoolid]['subexecutive']+= $row3['subexecutive_cn']; 
			$arr_teacher[$schoolid]['teacher']+= $row3['teacher_cn']; 
			$arr_teacher[$schoolid]['support']+= $row3['support_cn']; 
		}	
		return $arr_teacher;
	}

   /**
    * workforce_std      คำนวณหาจำนวนครูตามเกณฑ์ที่ ก.ค.ศ. กำหนด
    * 
    * @param mixed $array_student a=ก่อนประถม,p=ประถมศึกษา,m=มัธยม
    */
    function workforce_std($array_student){
        $reval=null; 
        $this->input_data=$array_student; 
        if(is_array($array_student)){
            $num_student_total=0;
/*			echo "<pre>";
			print_r($array_student);*/
			foreach($array_student as $class_level => $o_student){
				foreach($o_student as $class_id => $num_student){
					$num_student_total+=$num_student;
				}
			}
/*			echo "no of student : ".$num_student_total."<br />";*/
            if($num_student_total>0&&$num_student_total<=$this->limit_lowcase) {
					

					$reval['R'] += $this->std_room($class_level,$num_student_total);
							
                     if($num_student_total<=$this->limit_lowcase){//  น.ร น้อยกว่า 102 คน   ทุกระดับชั้น
                        $num_student=$num_student_total;
                        $reval['M1']=1;  
                        $reval['M2']=0; 
                      if($num_student>0 && $num_student<=20){
                         $reval['S']=0;
                         $reval['E']=1;
						 //$reval['R']=1; 
                      }else if($num_student>=21 && $num_student<=40){
                         $reval['S']=0;
                         $reval['E']=2; 
						 //$reval['R']=2; 
                      }else if($num_student>=41 && $num_student<=60){
                         $reval['S']=0;
                         $reval['E']=3;
						 //$reval['R']=3;
                      }else if($num_student>=61 && $num_student<=80){
                         $reval['S']=1;
                         $reval['E']=4;
						 //$reval['R']=4;
                      }else if($num_student>=81 && $num_student<=100){
                         $reval['S']=1; 
                         $reval['E']=5; 
						 //$reval['R']=5;
                      }else if($num_student>=101 && $num_student<=120){
                         $reval['S']=1;
                         $reval['E']=6;  
						 //$reval['R']=6;  
                      } 
                    }
            }else if($num_student_total>$this->limit_lowcase){
                $xnum=0; //no of teacher
				$rnum=0; //no of room
                    foreach($array_student as $class_level=>$o_student){
						foreach($o_student as $class_id=>$num_student){
                         	$num=0; 
                         	$arr_data=$this->std_by_classlevel($class_level,$num_student);
							
							// echo "<pre>";
							// echo "$class_id".":".$num_student;
							// print_r($arr_data); 
                            $xnum+=$arr_data['teacher']; 
							$rnum+=$arr_data['room']; 
						}
                    }
					
                    $reval['E']=$xnum; // no of the expect teacher
					$reval['R']=$rnum;// no of the expect room
                    $reval['S']=$this->std_teacher_support($xnum);
                    $reval['M1']=1;
                     
                    if($num_student_total>0 && $num_student_total<=359){   
                        $reval['M2']=0; 
                    }else if($num_student_total>=360 && $num_student_total<=719){   
                        $reval['M2']=1; 
                    }else if($num_student_total>=720 && $num_student_total<=1079){   
                        $reval['M2']=2; 
                    }else if($num_student_total>=1080 && $num_student_total<=1679){   
                        $reval['M2']=3; 
                    }else if($num_student_total>=1680){   
                        $reval['M2']=4; 
                    }
                }
            } 
			
		
     $this->workforce_std =$reval;      
     return $reval;     
    }

   /**
    * std_teacher_support หาจำนวน ครูสนับสนุนการสอน
    * 
    * @param mixed $teacher    จำนวนครูสายงานสอนทั้งหมด
    * @param mixed $std         ค่ามาตราฐาน  defual  10%
    * @return float
    */
   private function std_teacher_support($teacher,$std=0.1){
         $reval=0;
         $reval =round($teacher*$std); 
         return $reval;  
    }   
	
    /**
    * std_room หาจำนวนห้องเรียน
    * 
    * @param mixed $class_level    a=ก่อนประถม,p=ประถมศึกษา,m=มัธยม
    * @param mixed $num_student     จำนวนนักเรียนตามระดับชั้น      
    * @return float
    */
   private function std_room($class_level,$num_student){
         $room=0; 
		 if($this->std_conf["$class_level"]['room']>0){      
			$var1 =floor($num_student/$this->std_conf["$class_level"]['room']);  #หาว่างต้องมีอย่างน้อยกี่ห้อง
			
			$var2 = $num_student-($var1*$this->std_conf["$class_level"]['room']);  #หาจำนวนคนที่เหลือ
			 if($var2>=10){
				$room=$var1+1; 
			 }else{
			 	$var1 = $var1 <=0 ? 1 : $var1;
				$room=$var1; 
			 }  
		 }
		 return $room;  
    }
	
    /**
    * std_student_per_room นักเรียนต่อห้อง      
    * 
    * 
    * @param mixed $class_level    a=ก่อนประถม,p=ประถมศึกษา,m=มัธยม
    * @param mixed $num_student     จำนวนนักเรียนตามระดับชั้น
    * @return float
    */
   private function  std_student_per_room($class_level,$num_student){ 
    $num=0;   
        $num= $this->std_conf["$class_level"]['room'];    
        return $num;         
    }

    /**
    * std_student_per_teacher ครูต่อนักเรียน
    * 
    * @param mixed $class_level    a=ก่อนประถม,p=ประถมศึกษา,m=มัธยม
    * @param mixed $num_student     จำนวนนักเรียนตามระดับชั้น
    * @return float
    */
    private function  std_student_per_teacher($class_level,$num_student){
		$num=0; 
	    $num=$this->std_conf["$class_level"]['teacher']  ;
	    return $num;
    }
	
    /**
    * std_by_classlevel  คำนวณหาจำนวนครูตามเกณฑ์ที่ ก.ค.ศ. กำหนด   ตามระดับชั้น
    * 
    * 
    * @param mixed $class_level   a=ก่อนประถม,p=ประถมศึกษา,m=มัธยม
    * @param mixed $num_student   จำนวนนักเรียนตามระดับชั้น
    */
    private function std_by_classlevel($class_level,$num_student){
         $reval=null;
		 if($num_student > 0){
			 $room=$this->std_room($class_level,$num_student);  
			 $student_room=$this->std_student_per_room($class_level,$num_student) ;
			 $student_teacher=$this->std_student_per_teacher($class_level,$num_student) ; 
			 if($class_level=="a"){ 
					$num=round(((($room*$student_room)/$student_teacher)+($num_student/$student_teacher))/2) ;
			 }else if($class_level=="p"){
					$num=round(((($room*$student_room)/$student_teacher)+($num_student/$student_teacher))/2) ;   
			 }else if($class_level=="m"){
					$num =round(($room*$student_room)/$student_teacher)    ;
			 }
			//unset($reval);
	//		if($class_level == 'm'){
	//			echo $num;
	//			exit;
	//		}
			$reval['teacher']=$num; 
			$reval['room']=$room; 
		}
        return $reval;      
    }	
	
    /**
    * workforce_compare
    * 
    * @param mixed $real_data       ข้อมูลอัตราตามควมเป้นจริงแยกสายงาน
    * @param mixed $workforce_std   จำนวนครูตามเกณฑ์ที่ ก.ค.ศ. กำหนด      
    */
    function workforce_compare($real_data,$workforce_std=null){
        $reval=array();
            if(is_array($workforce_std)){
                 $this->$workforce_std=$workforce_std;
//				 echo "<pre>";
//				 print_r($this->workforce_std);
//				 exit;   
            } 
           
  
//  				echo "<pre>";
//				print_r($workforce_std);
				//exit;
                 foreach($real_data as $index=>$values){
                     
                     $var_real=$values['real'];  
                     $var_empty=$values['empty']; 
                     $var_total=$var_real+$var_empty;  
					 
					 if(is_array($workforce_std)){
                     	$std=$workforce_std[$index];
					 } 
					 
                     $diff=$var_total-$std;
                     $flage='N';
                     if($diff>0){
                        $flage='O';   #over
                     }else if($diff==0){
                        $flage='N';  #nomal
                     }else{
                        $flage='U';  #under
                     }
                     $reval[$index]=array('Flag'=>"$flage",'diff'=>"$diff",'std'=>"$std",'total'=>"$var_total",'real'=>"$var_real",'empty'=>"$var_empty");
                 } 
           
				 // echo "<pre>";
				 // print_r($reval);
				 // exit;
         return  $reval; 
    }
	
	function getWorkforce(){
		
		$this->std_conf_workforce();
	
		$sch_id = $this->allschool_new;

		$this->profile_id = $this->getProfileId();
		
		$arr = $this->get_student_all($this->profile_id, $sch_id);

		$arr_teacher = $this->get_teacher($this->profile_id, $sch_id);

		$arr_student = $this->getNumStudent();
		
		$arr['a']['a01']= $arr_student[$sch_id]['01'];
		$arr['a']['a02']= $arr_student[$sch_id]['02'];
		$arr['p']['p01']= $arr_student[$sch_id]['11'];
		$arr['p']['p02']= $arr_student[$sch_id]['12'];
		$arr['p']['p03']= $arr_student[$sch_id]['13'];
		$arr['p']['p04']= $arr_student[$sch_id]['14'];
		$arr['p']['p05']= $arr_student[$sch_id]['15'];
		$arr['p']['p06']= $arr_student[$sch_id]['16'];
		$arr['m']['m01']= $arr_student[$sch_id]['21'];
		$arr['m']['m02']= $arr_student[$sch_id]['22'];
		$arr['m']['m03']= $arr_student[$sch_id]['23'];
		$arr['m']['m04']= $arr_student[$sch_id]['24'];
		$arr['m']['m05']= $arr_student[$sch_id]['25'];
		$arr['m']['m06']= $arr_student[$sch_id]['26']; 

		$std=$this->workforce_std($arr);

		$real_data['M1']=array('real'=>$arr_teacher[$sch_id][executive],'empty'=>"0");  
		$real_data['M2']=array('real'=>$arr_teacher[$sch_id][subexecutive],'empty'=>"0");
		$real_data['E']=array('real'=>$arr_teacher[$sch_id][teacher],'empty'=>"0");
		$real_data['S']=array('real'=>$arr_teacher[$sch_id][support],'empty'=>"0"); 

		$std_comp = $this->workforce_compare($real_data,$std);
		
		return $std_comp;
	}
	
 	public function checkExp(){	

		$std_comp=$this->getWorkforce();
		//echo '<pre>', print_r($std_comp); die; 			
		//บริหารM1M2	ครูผู้สอนE	ฝ่ายสนับสนุนS		std real
		
		$this->caption = 'ตรวจสอบอัตรากำลังว่าตำแหน่งรองผู้อำนวยการสถานศึกษาว่างสามารถกำหนดตำแหน่งเป็นตำแหน่งครู โดยคงเงินเดือน หรือ ขั้นตามตำแหน่งเดิม โดยมีเงื่อนไขว่า เมื่อปรับปรุงกำหนดตำแหน่งแล้ว จำนวนครูต้องไม่เกินเกณฑ์ตามที่ ก.ค.ศ. กำหนด';
		
		$sql = "SELECT COUNT(*) AS empty_position
				FROM j18_position_temp 
				WHERE post_code = '325001010' 
				AND (CZ_ID IS NULL OR CZ_ID = '')
				AND position_id = '{$this->position_id}'";
		$result = mysql_db_query('cmss_'.$this->secid, $sql);
		$row = mysql_fetch_assoc($result);
		
		if($row['empty_position']>0 && $this->salary_increases == $this->salary_income && $std_comp['E']['std'] > $std_comp['E']['real']){
			$this->result= 'อัตรากำลังว่าตำแหน่งรองผู้อำนวยการสถานศึกษาว่างสามารถกำหนดตำแหน่งเป็นตำแหน่งครูได้';
			return true;
		}
		$this->result= 'อัตรากำลังว่าตำแหน่งรองผู้อำนวยการสถานศึกษาว่างไม่สามารถกำหนดตำแหน่งเป็นตำแหน่งครูได้';
		return false;
	}
}

?>