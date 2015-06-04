<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=TIS-620" />
<title></title>
</head>
<style>
 
body{
	background: #F1F1F1;
}
.panel{
	width:990px;
    margin:10% auto  ;
}
.box{
	float: left;
	height: 102px;
	width: 330px;
}
.box .img{
	float: left;
	height: 92px;
	width: 102;
	margin:10px;
}
.box .headtext{
	width: 328px;
	margin:2px;
	padding-top:10px;
	font-family:"Century Gothic", Helvetica, sans-serif;
	font-size: 18px;
	color:#03F; 
	text-shadow:1px 1px 1px #fff;
	width:100%;
	
}
.box .detailtext{
	 width: 328px;
	 margin:2px;
	 
	 font-family:"Century Gothic", Helvetica, sans-serif;
	 font-size: 12px;
	 color:#000; 
	 text-shadow:1px 1px 1px #fff;
	 width:100%;
}
</style>

<body>
<div class='panel'>
    <div class="box">
        <a href="javascript:linkMainPage('manage_variable.php');"><img  class="img" src="images/img_icon_step1.png" width="92" height="102" border="0" /></a>
        <div class='headtext' >สร้างตัวแปร </div>
        <div class='detailtext'></div>
    </div>
    <div class="box">
        <a href="javascript:linkMainPage('manage_variable.php');"><img  class="img" src="images/img_icon_step2.png" width="92" height="102" border="0" /></a>
        <div class='headtext' >สร้างตรรกะการตรวจสอบ </div>
        <div class='detailtext'></div>
    </div>
    <div class="box">
        <a href="manage_condition.php"><img  class="img" src="images/img_icon_step3.png" width="92" height="102" border="0" /></a>
        <div class='headtext' >กำหนดเงื่อนไขการตรวจสอบคำสั่ง</div>
        <div class='detailtext'></div>
    </div>
</div>
</body>
</html>
