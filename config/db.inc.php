<?
/*****************************************************************************
Function		: ��駤�ҡ���������� Database ��� ��� function ��ҧ� �����㹷ء���
Version			: 1.0
Last Modified	: 27/7/2548
Changes		:
	27/7/2548 - �ͧ�Ѻ����������� Database ������ (������ǹ�ͧ $_SESSION)
	6/8/2548	- �ٻ��� Stretch ����¹�繢�Ҵ 189 * 120

*****************************************************************************/

//include ("session.inc.php");
session_start();
require_once("conndb_nonsession.inc.php");
// Default Database Setting
$org_name = " ʾ�.��§���� ࢵ 2"; 



/*if ($_SESSION[newdb] == "yes"){
	$hostname = $_SESSION[xhostname];
	$db_name= $_SESSION[xdbname];
	$db_username = $_SESSION[xuser];
	$db_password = $_SESSION[xpwd];
}*/

// Banner Size
$wx = 189;
$hx = 120;

// Banner Base Directory
$basedir = "./bimg/";






function GetCellProperty($id,$sec1,$cellno){
		$result = mysql_query("select * from cellinfo where rid=$id and sec='$sec1' and cellno='$cellno';");
		if ($result){
			$rs=mysql_fetch_array($result,MYSQL_ASSOC);
			$prop = "";
			if ($rs[alignment]){
				$prop .= " align='$rs[alignment]' ";
			}

			if ($rs[valign]){
				$prop .= " valign='$rs[valign]' ";
			}

			if ($rs[bgcolor]){
				$prop .= " bgcolor='$rs[bgcolor]' ";
			}

			if ($rs[width]){
				$prop .= " width='$rs[width]' ";
			}

			return $prop;

		}else{
			return "";
		}
}

function GetCellValue($id,$sec1,$cellno){
		$result = mysql_query("select * from cellinfo where rid=$id and sec='$sec1' and cellno='$cellno';");
		if ($result){
			$rs=mysql_fetch_array($result,MYSQL_ASSOC);
			$val1 = $rs[caption];

			if ($rs[celltype] == 1){
				$val1 .= " [db] ";
			}else if ($rs[celltype] == 2){
				$val1 .= " [fld] ";
			}else if ($rs[celltype] == 3){
				$val1 .= " [fn] ";
			}

			if ($rs[font]){
				$val1 = "<span style='$rs[font]'>$val1</span>";
			}

			if ($rs[url]){
				$val1 = "<a href='$rs[url]' target='_blank'>$val1</a>";
			}
			
			return $val1;

		}else{
			return "&nbsp;";
		}
}

function DB2Array($arrayname,$sql){
	$s = "\$$arrayname  = array(";
	$result = mysql_query($sql);
	$i = 0;
	$firstrow = true;
	while ($rs = mysql_fetch_assoc($result)){
		if ($firstrow){
			$firstrow = false;
		}else{
			$s .= ",";
		}

		$firstcol = true;
		$s .= "$i => array(";
		foreach($rs as $key => $value){
			if ($firstcol){
				$firstcol = false;
			}else{
				$s .= ", ";
			}
			$s .= "\"$key\"=>\"" . ($value) . "\"";
		}
		$s .= ")";

		$i++;
	}

	$s .= ");";

	return $s;
}


?>