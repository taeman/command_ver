<?
// ��Ǩ�ͺ�Է�ԡ����Ҷ֧�����

//print_r($_SESSION[applistname]);
if($_SESSION[applistname]){
if($BypassAPP==false){
foreach ($_SESSION[applistname] as $value) {
	if($value == $ApplicationName){
		$check_authority = true;
		break;
	}else{
		$check_authority = false;
	}
}
	if($check_authority){
		//continue;
	}else{
		echo "
		<HTML>
		<HEAD>
		<TITLE>app</TITLE>
		<meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-874\">
		<head>
				<SCRIPT language=JavaScript>
					 if (confirm('�Է�Ԣͧ��ҹ�������ö�������������¡�� ��ҵ�ͧ��ûԴ˹�ҵ�ҧ��顴 OK ��ҵ�ͧ�����͹��Ѻ�� CANCEL')) {window.close();} else {window.history.go(-1);}
				</script>
		</head>
		</html>
		";
		die;
	}
}
}else{
		echo "
		<HTML>
		<HEAD>
		<TITLE>app</TITLE>
		<meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-874\">
		<head>
				<SCRIPT language=JavaScript>
					 if (confirm('�Է�Ԣͧ��ҹ�������ö�������������¡�� ��ҵ�ͧ��ûԴ˹�ҵ�ҧ��顴 OK ��ҵ�ͧ�����͹��Ѻ�� CANCEL')) {window.close();} else {window.history.go(-1);}
				</script>
		</head>
		</html>
		";
		die;
}

?>