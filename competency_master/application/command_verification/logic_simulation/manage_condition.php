<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=TIS-620" />
<title>Logic Simulation</title>
<!--
Start Import ExtJS framework
 -->
	<link rel="stylesheet" type="text/css" href="js/extjs/resources/css/ext-all.css">
	<script type="text/javascript" src="js/extjs/builds/ext-core-debug.js"></script>
	<script type="text/javascript" src="js/extjs/ext-all-debug.js"></script>
    <script type="text/javascript" src="js/app.js"></script>
 <!--
End Import ExtJS framework
 -->
 <!--สำหรับ ทำ greybox-->
<script type="text/javascript">
	var GB_ROOT_DIR = "./greybox/";
</script>
<script type="text/javascript" src="greybox/AJS.js"></script>
<script type="text/javascript" src="greybox/AJS_fx.js"></script>
<script type="text/javascript" src="greybox/gb_scripts.js"></script>
<link href="greybox/gb_styles.css" rel="stylesheet" type="text/css" media="all" />
<!--จบ graybox-->
<script type="text/javascript" src="../../../common/jquery.js"></script>
<script type="text/javascript" src="js/jquery/jquery-1.6.4.min.js"></script>
<script type="text/javascript" src="js/jqueryui/js/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="js/main.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />

<style type="text/css">
#main_content {
	margin: 0px;
    overflow: hidden;
}

.logic_button {
    float: left;
}
</style>
</head>
<body topmargin="0" leftmargin="0" rightmargin="0">
<DIV class="bg_banner"><DIV class="banner"></DIV></DIV>
<DIV class="menu_bar">
    <ul>
    <li><a href="javascript:linkMainPage('main_page.php');">หน้าหลัก</a></li>
    <li><a href="javascript:linkMainPage('manage_variable.php');">สร้างตัวแปร</a></li>
    <li><a href="manage_condition.php">สร้างตรรกะการตรวจสอบ</a></li>
    <li><a href="javascript:linkMainPage('manage_position_condition.php');">กำหนดเงื่อนไขการตรวจสอบคำสั่ง</a></li>
    <li><a href="javascript:window.close();">ออกจากระบบ</a></li>
    </ul>
</DIV>
<DIV id="main_content"></DIV>
</body>
</html>
