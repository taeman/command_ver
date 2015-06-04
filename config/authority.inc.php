<?
// ตรวจสอบสิทธิการเข้าถึงโปรแกรม

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
					 if (confirm('สิทธิของท่านไม่สามารถใช้โปรแกรมที่เรียกได้ ถ้าต้องการปิดหน้าต่างนี้กด OK ถ้าต้องการย้อนกลับกด CANCEL')) {window.close();} else {window.history.go(-1);}
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
					 if (confirm('สิทธิของท่านไม่สามารถใช้โปรแกรมที่เรียกได้ ถ้าต้องการปิดหน้าต่างนี้กด OK ถ้าต้องการย้อนกลับกด CANCEL')) {window.close();} else {window.history.go(-1);}
				</script>
		</head>
		</html>
		";
		die;
}

?>