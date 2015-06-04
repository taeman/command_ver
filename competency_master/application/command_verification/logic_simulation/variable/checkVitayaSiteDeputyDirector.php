<?php
/**
 * ตรวจสอบวิทยฐานะ ผอ. ร.ร.
 *
 * @author  -
 * @copyright 2011 Sapphire
 * @description ตรวจสอบวิทยฐานะ ผอ. ร.ร.
 * @param string $idcard, เลขบัตรประจำตัวประชาชน, 3659900273833 
 * @param string $vitaya_new, วิทยที่ขอ,  3
 * @param string $effective_date, ตั้งแต่วันที่,  2015-01-15
 * @return boolean
 "
 */
class checkVitayaSiteDeputyDirector extends utility{
	public $idcard;
	public $vitaya_new;
	public $effective_date;
	public $comment;
	public $pos_date;
	
	public function __construct($idcard="", $vitaya_new="", $effective_date=""){
		$this->debug = "off";
		$this->idcard = $idcard;
		$this->vitaya_new = $vitaya_new;
		$this->effective_date = $effective_date;
	}
	
	public function getVitayaStat($idcard){
		$result = $this->getViewGeneralDetail($this->idcard);
		$this->pos_date = $result['comeday_c'];
		$sql = 'SELECT vitaya_id,`name`,date_start FROM cmss_'.$result['siteid'].'.vitaya_stat WHERE id = "'.$this->idcard.'" ORDER BY date_start DESC LIMIT 1';
		$result = mysql_db_query('cmss_'.$result['siteid'],$sql) or die (mysql_error());
		$row = mysql_fetch_assoc($result);
		$tmp = explode('-',$row['date_start']);
		$row['date_start'] = ($tmp[0]-543).'-'.$tmp[1].'-'.$tmp[2];
		return array('vitaya_id'=>$row['vitaya_id'],'name'=>$row['name'],'date_start'=>$row['date_start']);
	}
	
	public function checkVitaya0(){
		$this->comment = array('','ดำรงตำแหน่งรองผู้อำนวยการสถานศึกษาที่มีวิทยฐานะสูงกว่าชำนาญการพิเศษ หรือดำรงตำแหน่งผู้อำนวยการสถานศึกษาที่มีวิทยฐานะสูงกว่าชำนาญการพิเศษ');
		$arr_tmp = $this->getViewGeneralDetail($this->idcard);
		if(in_array($arr_tmp['pid'],array('325001010','325471008'))){//ผ.อ. หรือ รอง ผ.อ. ตรวจสอบวิทยฐานะมากกว่าหรือเท่ากับชำนาญการพิเศษ
			$arr_tmp = $this->getVitayaStat($this->idcard);
			if($arr_tmp['vitaya_id']>=2)return true;
			return false;
		}
		return false;
	}
	
	public function checkVitaya2(){
		$this->comment = array('ชำนาญการพิเศษ','ดำรงตำแหน่งรองผู้อำนวยการสำนักงานเขตพื้นที่การศึกษา มาแล้วไม่น้อยกว่า 1 ปี หรือดำรงตำแหน่งอื่นที่ ก.ค.ศ. เทียบเท่ามาแล้วไม่น้อยกว่า 1 ปี นับถึงวันที่ยื่นคำร้อง');
		$arr_tmp = $this->getViewGeneralDetail($this->idcard);
		if($arr_tmp['pid']!='125471009')return false;
		
		$val = $this->getVitayaStat($this->idcard);
		$this->date_period = $this->getPeriodReal($val['date_start'], $this->effective_date);
		if($this->date_period[0]>=1)return true;
		return false;
	}
	public function checkVitaya3(){
		$this->comment = array('เชี่ยวชาญ','ดำรงตำแหน่งรองผู้อำนวยการสำนักงานเขตพื้นที่การศึกษาที่มีวิทยฐานะรองผู้อำนวยการสำนักงานเขตพื้นที่การศึกษาชำนาญการพิเศษ มาแล้วไม่น้อยกว่า 3 ปี หรือดำรงตำแหน่งอื่นที่ ก.ค.ศ.เที่ยบเท่ามาแล้วไม่น้อยกว่า 3 ปี นับถึงวันที่ยื่นคำร้อง');
		$arr_tmp = $this->getViewGeneralDetail($this->idcard);
		if($arr_tmp['pid']!='125471009')return false;
		
		$val = $this->getVitayaStat($this->idcard);
		$this->date_period = $this->getPeriodReal($val['date_start'], $this->effective_date);
		if($val['vitaya_id']!='2')return false;
		if($this->date_period[0]>=3)return true;
		return false;
	}
	
	public function checkExp(){
		switch($this->vitaya_new){
			case 2 : return $this->checkVitaya2();	
			case 3 : return $this->checkVitaya3();
			default : return $this->checkVitaya0();
		}
	}
	
	public function showExp(){
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
			echo "<font color=\"#6A3500\"><b>ข้อเสนอแนะ : </b>".$this->comment[1];
			echo "<br/><font color=\"#6A3500\"><b>ข้อมูลจากระบบ : </b>วันที่ได้รับ".(($this->vitaya_new=='')?'ตำแหน่ง':'วิทยฐานะ')."ปัจจุบัน ".$this->dateConvert($this->pos_date, 'en-th-ddmmyy')
			 .' วันที่ยื่นขอ : '.$this->dateConvert($this->effective_date, 'en-th-ddmmyy')." ดำรงตำแหน่งมาแล้ว : ".$this->date_period[0]." ปี "
			.($this->date_period[1]>0? $this->date_period[1].' เดือน ':'')
			.($this->date_period[2]>0? $this->date_period[2].' วัน':'')
			.'</font>'
			.'</div>';
	}
	
}

?>