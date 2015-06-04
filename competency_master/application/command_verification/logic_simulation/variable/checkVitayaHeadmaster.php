<?php
/**
 * ��Ǩ�ͺ�Է°ҹ� ��. �.�.
 *
 * @author  -
 * @copyright 2011 Sapphire
 * @description ��Ǩ�ͺ�Է°ҹ� ��. �.�.
 * @param string $idcard, �Ţ�ѵû�Шӵ�ǻ�ЪҪ�, 3580200031678 
 * @param string $vitaya_new, �Է·���,  3
 * @param string $effective_date, ������ѹ���,  2015-01-15
 * @return boolean
 "
 */
class checkVitayaHeadmaster extends utility{
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
		$this->comment = array('','��ç���˹��ͧ����ӹ�¡��ʶҹ�֡�� �����������¡��� 1 �� ���ʹ�ç�Ӥ�ٷ�����Է°ҹ��٧���Ҫӹҭ��� �Ѻ�֧�ѹ�����蹤���ͧ');
		$arr_tmp = $this->getViewGeneralDetail($this->idcard);
		$this->pos_date = $arr_tmp['comeday_c'];
		if($arr_tmp['pid']=='425471000'){//�ҡ�繤��
			$arr_tmp = $this->getVitayaStat($this->idcard);
			if($arr_tmp['vitaya_id']>1)return true;
			return false;
		}else if($arr_tmp['pid']=='325001010'){//�ҡ�� �ͧ �.�.
			$this->date_period = $this->getPeriodReal($arr_tmp['comeday_c'], $this->effective_date);
			if($this->date_period[0]>=1)return true;
			return false;
		}
		return false;
	}
	
	public function checkVitaya1(){
		$this->comment = array('�ӹҭ���','��ç���˹觼���ӹ�¡��ʶҹ�֡�� �����������¡��� 1 �� ���ʹ�ç���˹���蹷�� �.�.�. ��º��������������¡��� 1 �� �Ѻ�֧�ѹ�����蹤���ͧ');
		$arr_tmp = $this->getViewGeneralDetail($this->idcard);
		$this->pos_date = $arr_tmp['comeday_c'];
		$this->date_period = $this->getPeriodReal($arr_tmp['comeday_c'], $this->effective_date);
		//echo  'req : '.$this->vitaya_new.' / '.$arr_tmp['comeday_c'].' - '.$this->effective_date; //debug
		if($arr_tmp['pid']!='325471008')return false;
		if($this->date_period[0]>=1)return true;
		return false;
	}
	public function checkVitaya2(){
		$this->comment = array('�ӹҭ��þ����','��ç���˹觼���ӹ�¡��ʶҹ�֡�ҷ�����Է°ҹм���ӹ�¡��ʶҹ�֡�Ҫӹҭ��� �����������¡��� 1 �� ���ʹ�ç���˹���蹷�� �.�.�. ��º��������������¡��� 1 �� �Ѻ�֧�ѹ�����蹤���ͧ');
		$val = $this->getVitayaStat($this->idcard);
		$this->date_period = $this->getPeriodReal($val['date_start'], $this->effective_date);
		if($this->date_period[0]>=1)return true;
		return false;
	}
	public function checkVitaya3(){
		$this->comment = array('����Ǫҭ','��ç���˹觼���ӹ�¡��ʶҹ�֡�ҷ�����Է°ҹм���ӹ�¡��ʶҹ�֡�Ҫӹҭ��þ���� �����������¡��� 3 �� ���ʹ�ç���˹觼���ӹ�¡��ʶҹ�֡�ҷ�����Է°ҹм���ӹ�¡��ʶҹ�֡�Ҫӹҭ��� �����������¡��� 5 �� ���ʹ�ç���˹���蹷�� �.�.�. ��º��������������¡��� 3 �� �Ѻ�֧�ѹ�����蹤���ͧ');
		$val = $this->getVitayaStat($this->idcard);
		if($val['vitaya_id']=='2'){ $y = 3; }else if($val['vitaya_id']=='1'){ $y = 5; };
		
		$this->date_period = $this->getPeriodReal($val['date_start'], $this->effective_date);
		if(!isset($y))return false;
		if($this->date_period[0]>=$y)return true;
		return false;
	}
	public function checkVitaya4(){
		$this->comment = array('����Ǫҭ�����','��ç���˹觼���ӹ�¡��ʶҹ�֡�� ������Է°ҹм���ӹ�¡��ʶҹ�֡�����Ǫҭ �����������¡��� 2 �� ���ʹ�ç���˹���蹷�� �.�.�. ��º��������������¡��� 2 �� �Ѻ�֧�ѹ�����蹤���ͧ');
		$val = $this->getVitayaStat($this->idcard);
		$this->date_period = $this->getPeriodReal($val['date_start'], $this->effective_date);
		if($val['vitaya_id']!=3) return false;
		if($this->date_period[0]>=2)return true;
		return false;
	}
	
	public function checkExp(){
		switch($this->vitaya_new){
			case 1 : return $this->checkVitaya1();
			case 2 : return $this->checkVitaya2();	
			case 3 : return $this->checkVitaya3();
			case 4 : return $this->checkVitaya4();
			default : return $this->checkVitaya0();
		}
	}
	
	public function showExp(){
		echo '<div style="border:1px solid #006600; border-style:dashed; background-color:#aecde4;padding:5px;text-align: left;"><font color="#000000">';
			echo "<font color=\"#6A3500\"><b>����ʹ��� : </b>".$this->comment[1];
			echo "<br/><font color=\"#6A3500\"><b>�����Ũҡ�к� : </b>�ѹ������Ѻ".(($this->vitaya_new=='')?'���˹�':'�Է°ҹ�')."�Ѩ�غѹ ".$this->dateConvert($this->pos_date, 'en-th-ddmmyy')
			 .' �ѹ�����蹢� : '.$this->dateConvert($this->effective_date, 'en-th-ddmmyy')." ��ç���˹������� : ".$this->date_period[0]." �� "
			.($this->date_period[1]>0? $this->date_period[1].' ��͹ ':'')
			.($this->date_period[2]>0? $this->date_period[2].' �ѹ':'')
			.'</font>'
			.'</div>';
	}
	
}

?>