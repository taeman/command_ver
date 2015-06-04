<?  
	define("HOST", "database.cmss-otcsc.com");
	define("HOST_TEMP", "database.cmss-otcsc.com");
	
	define("USERNAME_HOST","cmss");
	define("PASSWORD_HOST","2010cmss");
	
	# user ระบบเลื่อนเงินเดือน
	define("USERNAME_HOST_SALARY","salary_system");
	define("PASSWORD_HOST_SALARY","2013@salsapp");
	
	
	define("HOST_INTRA","61.19.255.75");
	define("USERNAME_HOST_INTRA","sapphire");
	define("PASSWORD_HOST_INTRA","sprd!@#$%");
	define("APPHOST","61.19.255.75");
	define("APPHOST_INTRA","61.19.255.75");
	define("AHTTP","http://");
	define("APHTTP","http://");
	define("APPHOST_TEST","61.19.255.75");
	define("HOST_FILE","61.19.255.75");
	define("HOST_DB_INTRA","database.cmss-otcsc.com");   	
	#### USER sapphire   
	define("USER_SAPPHIRE","sapphire");   
	define("PASS_SAPPHIRE","sprd!@#$%");   
	define("APPURL","http://master.cmss-otcsc.com");
	
		## path file server
	define("PKP7FILE","http://filemaster.cmss-otcsc.com/kp7file_original/");
	## User crontab
	define("USER_CRONTAB","cmss_crontab");
	define("PASS_CRONTAB","cmss!@#$%");
	
//      define("APPURL","http://61.19.255.75");
	define("MAIN_URL","http://www.cmss-otcsc.com");
	define("SITE_CENTER","0000"); // site ฐานข้อมูลกลาง
	define("RETIRE_CENTER","retireout"); // site ฐานข้อมูลกลาง เก็บข้อมูลคนที่เสียชีวิต ออกจากราชการถาวร
	
	define("SALARY_COMMENT", "1");//สถานะในการใส่หมายเหตุ salary 1=ใช้งาน, 0=ไม่ใช้งาน
	define("COPYRIGHT","สงวนลิขสิทธิ์โดย สำนักงานคณะกรรมการข้าราชการครูและบุคลากรทางการศึกษา กระทรวงศึกษาธิการ"); // ลิขสิทธิ์
	
	 $db_sitemonitor = "datasite_monitor";
	
	# ตัวแปรเก็บเขตที่ login โดยไม่ต้องหาข้อมูลในตาราง eduarea 
	$arr_sitelogin = array("0400");


?>
