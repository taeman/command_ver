<?php
/**
* @comment ไฟล์ถูกสร้างขึ้นมาสำหรับกำหนดค่า define
* @projectCode 56CMSS09
* @tor 
* @package core
* @author Pairoj Panturat
* @access private
* @created 24/05/2014
*/
### กำหนดค่า DEFINE วันที่เริ่มปรับใช้ผังเงินเดือนแบบใหม่
define("DD_CHPOSITION","18");
define("MM_CHPOSITION","04");
define("YY_CHPOSITION","2550");

### กำหนดค่า DEFINE เพื่อแสดงใน column ส่วนข้อมูลทั่วไป
define("TEXT_NO", "ลำดับ");
define("TEXT_IDCARD", "เลขประจำตัวประชาชน");
define("TEXT_NAME", "ชื่อ - นามสกุล");
define("TEXT_POSITION", "ตำแหน่ง");
define('TEXT_POSTITION_AGENCIES','ตำแหน่ง/<BR>หน่วยงาน');
define('TEXT_POSTITION_AGENCIES_2','ตำแหน่ง/หน่วยงาน');
define("TEXT_NOPOSITION", "เลขที่ตำแหน่ง");
define("TEXT_NOPOSITION_2", "ตำแหน่งเลขที่");
define("TEXT_RADUB", "อันดับ/ระดับ");
define("TEXT_GRADE", "ระดับ");
define("TEXT_RATING", "อันดับ");
define("TEXT_SALARY", "เงินเดือน");
define("TEXT_VITAYA", "วิทยฐานะ");
define("TEXT_SCHOOL", "สถานศึกษา");
define("TEXT_EDUAREA", "สำนักงานเขตพื้นที่การศึกษา");
define("TEXT_COMMENT", "หมายเหตุ");
define("TEXT_TOOL", "เครื่องมือ");
define("TEXT_STATUS", "สถานะ");
define("TEXT_PERSON38K", "รายชื่อบุคลากรทางการศึกษาอื่นตามมาตรา 38ค.(2)");
define("TEXT_PERSON", "คน");
define("TEXT_TIME", "ครั้ง");
define("TEXT_DAY", "วัน");
define("TEXT_AMOUNT", "จำนวน");
define('TEXT_NO_LAUREL', 'ลำดับที่<br />ความดี<br />ความชอบ');
define('TEXT_NO_UPSALARY', 'ลำดับที่<br />ร้อยละ<br />การเลื่อน');
define('TEXT_NUM_EMPLOYEE', 'จำนวน<br />ข้าราชการ');
define('TEXT_RADUB_POSITION', 'ระดับตำแหน่ง');


### ส่วนที่เกี่ยวของกับเงินเดือน
define("TEXT_RATESALARY", "อัตราเงินเดือน");
define("TEXT_TITLE_RATESALARY", "จำนวนขั้นเงิน/เงินเดือนที่ใช้เลื่อน");
define("TEXT_LEVEL", "ขั้น");
define("TEXT_NUM_LEVEL", "จำนวนขั้น");
define("TEXT_USE_SALARY", "เงินใช้แล้ว");
define("TEXT_USE_SALARY_GENERAL", "เงินใช้");
define("TEXT_EXTRA_SALARY", "ค่าตอบแทนพิเศษ");
define("TEXT_NO_SALARY", "เลื่อนขั้นเงินเดือน ครั้งที่");
define("TEXT_SALARY_TODAY", "เงินเดือนปัจจุบัน");
define("TEXT_NEW_SALARY", "เงินเดือนใหม่ที่ได้รับ");
define("TEXT_USE_UPSALARY", "ใช้เงินเลื่อน");
define("TEXT_SUM_SALARY", "รวมใช้เงินเลื่อน");
define("TEXT_MEDIUM", "ค่ากลาง");
define("TEXT_ESTIMATEPOINT", "คะแนนการประเมิน");
define("TEXT_ESTIMATERESULT", "ผลการประเมิน");
define("TEXT_PERCENT_UPSALARY", "ร้อยละที่ได้เลื่อน");
define('TEXT_PERCENT_SCORE','ร้อยละ<br />ของคะแนน<br />ประเมิน');
define("TEXT_ACCOUNT_TO_PAY", "ข้อมูลข้าราชการครูและบุคลากรทางการศึกษา");
define("TEXT_UPSALARY_ALL_YEAR", "ขั้นรวมทั้งปี(เม.ย.,ต.ค.)");
define("TEXT_FROMLEVEL", "จากขั้น");
define("TEXT_TOLEVEL", "เป็นขั้น");
define("TEXT_MONEY_POK", "ใช้เงินพอก");
define("TEXT_BEFORE_LEVEL", "ขั้นที่ได้ก่อนหน้า");
define("TEXT_BEFORE_MONEY", "เงินที่ใช้เลื่อนก่อนหน้า");
define('TEXT_NUM_LATE','มาสาย<br />กี่ครั้ง');
define('TEXT_ONE_YEAR_AGO','ในครึ่งปีที่แล้วมา');
define('TEXT_UPSALARY','เลื่อนให้ได้รับ');
define('TEXT_UPSALARY_USE_MONEY','ใช้เงินเลื่อนขั้น');
define('TEXT_UPSALARY_MONEY','เงินเลื่อนขั้น');
define('TEXT_UPSALARY_MONEY_2','เลื่อน<br />เงินเดือน');
define('TEXT_REPAY_MONEY','เงินตอบแทนฯ');
define('TEXT_REPAY_MONEY_2','ค่าตอบแทนฯ');
define('TEXT_MONEY','เงิน');
define('TEXT_POINT','คะแนน');
define('TEXT_BASE_MEDIUM','ฐานในการ<br />คำนวณ<br />ค่ากลาง');
define('TEXT_SALARY_OBTAIN','เงินดือน<br />ที่<br />ได้รับ');

define("STR_SALARIES_ACCOUNT", "ชื่อบัญชีเลื่อนเงินเดือน");
define("STR_ACCOUNT_NAME", "ชื่อบัญชีนับตัว");
define("STR_FISCAL_YEAR", " ปีงบประมาณ");
define("STR_NUM_NO", "ครั้งที่");
define("STR_LIST_CERTIFICATE", "รับรองรายชื่อนับตัว ณ วันที่");
define("STR_USER_DATA", "ใช้ข้อมูล ณ วันที่");
define('STR_COMMENT_1','กฎ ก.ค.ศ/<br />ระเบียบกระทรวง<br />การคลังฯ ข้อ');
define('STR_COMMENT_2','สาเหตุ<br />ที่ไม่ได้รับ<br />การเลื่อนขั้น');
define('STR_COMMENT_3','ไม่ได้เลื่อน<br />ตามกฎ ก.ค.ศ.<br />ข้อ ...');
define('TXT_SUM_SALARY','เงินเดือน<br />รวม<br />ต่อเดือน');
define('TXT_AMOUNT_ALLOCATE','วงเงิน<br />ที่ สพฐ.<br />จัดสรร');
define('TXT_AMOUNT_REMAIN','วงเงิน<br />คงเหลือ<br />หลังจาก<br />เลื่อนเงินเดือน');
define('TXT_SUM_REMAIN','รวมคน/เลื่อนเงินเดือน<br />และค่าตอบแทนฯ<br />ทั้งสิ้น');
define('TXT_UPSALARY_REJECT','ไม่ได้รับการ<br />เลื่อน<br />เงินเดือน');
define('TXT_UPSALARY_REQUEST','เสนอ<br />ขอเลื่อน<br />ร้อยละ');
define('TXT_UPSALARY_AMOUNT','จำนวนเงิน<br />ที่ใช้เลื่อน<br />เงินเดือน');
define('TXT_UPSALARY_REPAY_SUM','รวมเงินเลื่อนฯ<br />และค่าตอบแทน<br />พิเศษ');
define('TXT_RESERVE_FUND','เงินสำรอง<br />วงเงิน<br />เลื่อนเงินเดือน<br />ทุกกรณี');
define('TXT_HEAD_UPSALARY_4','รายละเอียดแสดงจำนวนและเงิน (เลื่อนเงินเดือน + ตอบแทนฯ) ที่ใช้เลื่อนเงินเดือน  ณ');

### ส่วนที่เกี่ยวของกับการลา
define('TEXT_SICK_LEAVE','ลาป่วย');
define('TEXT_WORK_LEAVE','ลากิจ');
define('TEXT_TOTAL_LEAVE','รวมลา');

#### ข้อความที่ใช้กับระบบเลื่อนเงินเดือน
$arr_budget_caption[1] ="* โปรดระบุ<u>จำนวน</u>ผู้ได้รับผลการเลื่อนเงินเดือน<br /><br />&nbsp;&nbsp;&nbsp;ระดับดีเด่น 1 ขั้นสูงสุดในแต่ละโรงเรียน/หน่วยงาน<br /><br />&nbsp;&nbsp;&nbsp;เป็น<u>จำนวนเต็มไม่มีทศนิยม</u>";
$arr_budget_caption[2]  = "* โปรดระบุ<u>จำนวน</u>ผู้ได้รับผลการเลื่อนเงินเดือน<br /><br />&nbsp;&nbsp;&nbsp;ระดับดีเด่นทั้งปี 2 ขั้นสูงสุดในแต่ละโรงเรียน/หน่วยงาน<br /><br />&nbsp;&nbsp;&nbsp;เป็น<u>จำนวนเต็มไม่มีทศนิยม</u>";


#### เพิ่มเติมระบบ E-service
define("TEXT_BIRTHDAY", "วัน เดือน ปี เกิด");
define("TEXT_PIVATE_KEY", "กุญแจอิเล็กทรอนิกส์");
define("TEXT_SECNAME", "สังกัด");
define("TEXT_REQ_REASON", "เหตุผลการขอคัดสำเนา");
define("TEXT_PHONE_NO", "หมายเลขโทรศัพท์มือถือ");
define("TEXT_EMAIL", "e-mail");
define("TEXT_REQ_DATE", "วันที่ยื่น");
define("TEXT_E_TICKET", "e-ticket");
define("TEXT_SMS", "sms");

	### เกี่ยวกับ path รูปภาพ
	define("PATH_IMG","/image_file");
	
#### ส่วนของการ define ฟอร์มและรายงานของ ก.ค.ศ. 16
define("K1_PIC","รูป");
define("K1_PICYEAR","พ.ศ.");
define("K2_FULLNAME","ชื่อ-นามสกุล");
define("K2_IDCARD","เลขประจำตัวประชาชน");
define("K3_BDATE","วัน เดือน ปี เกิด");
define("K4_BLOOD","หมู่โลหิต");
define("K5_FATHNAME","ชื่อ-นามสกุล บิดา");
define("K6_MOTHNAME","ชื่อ-นามสกุล มารดา");
define("K7_MARNAME","ชื่อ-นามสกุล คู่สมรส");
define("K8_STARTDATE","วันบรรจุ");
define("K9_RETIREDATE","วันครบเกษียณอายุ");
define("K10_HOUSENO","ที่อยู่บ้านเลขที่");
define("K10_MOO","หมู่ที่");
define("K10_SOI","ตรอกหรือซอย");
define("K10_ROAD","ถนน");
define("K10_SUBDISTRICT","แขวง/ตำบล");
define("K10_DISTRICT","เขต/อำเภอ");
define("K10_PROV","จังหวัด");
define("K10_PSTCODE","รหัสไปรษณีย์");
define("K10_PHONE","โทรศัพท์บ้าน");
define("K10_MOBILE","โทรศัพท์เคลื่อนที่");
define("K11_DATE","วันที่ได้รับ");
define("K11_TITLE","เครื่องราชอิสริยาภรณ์/เหรียญตรา");
define("K11_NO","ลำดับที่");
define("K11_BOOKNO","เล่มที่");
define("K11_BOOK","เล่ม");
define("K11_PHRASE","ตอนที่");
define("K11_PAGE","หน้า");
define("K12_HEALTH","ลาป่วย");
define("K11_ISSUE","วันประกาศในราชกิจจานุเบกษา");
define("K12_YEAR","ปีงบประมาณ");
define("K12_CASUAL","ลากิจส่วนตัว");
define("K12_MATER","ลาคลอดบุตร");


define("K12_MATERHLP1","ลาไปช่วยเหลือภริยา");
define("K12_MATERHLP2","ที่คลอดบุตร");
define("K12_MATERHLP",K12_MATERHLP1.K12_MATERHLP2);

define("K12_HOLIDAY","ลาพักผ่อน");

define("K12_OEDIN1","ลาอุปสมบทหรือ");
define("K12_OEDIN2","ลาไปประกอบพิธีฮัจย์");
define("K12_OEDIN",K12_OEDIN1.K12_OEDIN2);

define("K12_MILSERV1","ลาเข้ารับการตรวจเลือก");
define("K12_MILSERV2","หรือเข้ารับการเตรียมพล");
define("K12_MILSERV",K12_MILSERV1.K12_MILSERV2);

define("K12_WORKSHOP","ลาไปศึกษา ฝึกอบรม ปฏิบัติการวิจัย หรือดูงาน");

define("K12_WSIN","ในประเทศ");
define("K12_WSOUT","ต่างประเทศ");

define("K12_INTERORG1","ลาไปปฏิบัติงานใน");
define("K12_INTERORG2","องค์การระหว่างประเทศ");
define("K12_INTERORG",K12_INTERORG1.K12_INTERORG2);

define("K12_FAMILY","ลาติดตามคู่สมรส");

define("K12_RESKL1","ลาไปฟื้นฟูสมรรถภาพ");
define("K12_RESKL2","ด้านอาชีพ");
define("K12_RESKL",K12_RESKL1.K12_RESKL2);

define("K12_OBSENCE","ขาดราชการ");
define("K12_LATE","มาสาย");
define("K13_YEAR","พ.ศ.");
define("K13_TITLE","สถานโทษ");
define("K13_DETAIL","ลักษณะความผิด");
define("K13_REF","เอกสารอ้างอิง");
define("K13_NOTE","หมายเหตุ");
define("K14_PERIOD","ตั้งแต่ - ถึง(เดือน ปี)");
define("K14_TITLE","รายการ");
define("K14_REF","เอกสารอ้างอิง");
define("K15_PERIOD","ตั้งแต่ - ถึง(เดือน ปี)");
define("K15_PLACE","สถานที่ (ในประเทศ / ต่างประเทศ)");
define("K15_NOTE","หมายเหตุ");
define("K16_SKLFIELD","ด้าน");
define("K16_FLDDETAIL","รายละเอียด");
define("K16_NOTE","หมายเหตุ");
define("K17_PERIOD","ตั้งแต่ - ถึง(เดือน ปี)");
define("K17_DETAIL","รายละเอียด");
define("K17_REF","เอกสารอ้างอิง");
define("K18_PERIOD","ตั้งแต่ - ถึง(เดือน ปี)");
define("K18_CERTFC","ประกาศนียบัตร/หลักสูตร");
define("K18_PLACE","สถานที่");
define("K18_ORG","หน่วยงานที่จัด");
define("K19_DATE","วัน เดือน ปี");
define("K19_POSITION","ตำแหน่ง/ส่วนราชการ /หน่วยงานการศึกษา");
define("K19_SKILL","วิทยฐานะ");
define("K19_POSNO","เลขที่ตำแหน่ง");
define("K19_POSTYPE","ตำแหน่งประเภท");
define("K19_LEVEL","อันดับ/ระดับ");
define("K19_SAlRATE","อัตราเงินเดือน");
define("K19_SKLRATE","เงินวิทยฐานะ/ค่าตอบแทน/เงิน พตก.");
define("K19_REF","เอกสารอ้างอิง");
define("K20_EDU","ระดับการศึกษา");
define("K20_SCHOOL","สถานศึกษา");
define("K20_EDUPERIOD","ตั้งแต่ - ถึง (เดือน ปี)");
define("K20_DGREELABEL","วุฒิที่ได้รับ");
define("K20_DGREE","วุฒิ");
define("K20_MAJOR","สาขาวิชาเอก");
define("K20_MINOR","สาขาวิชาโท");
define("K21_CERTFC","ใบอนุญาตประกอบวิชาชีพ ประเภท");
define("K21_CERTFCNO","เลขที่");
define("K21_CERTFCEXPI","วันหมดอายุ");

# ส่วนของประวัติการเปลี่ยนชื่อ
define("ACT_NAME","กำหนดแสดงผล");
define("DATE_CHANGE_SALARY","31/12/2552");

### อ้างถึงโฟลเดอร์เอกสารหลักฐานก่อตั้งสิทธิ
define("KP7REFDOC","kp7_refdoc");

## กำหนดการแบ่งการแสดงผลรายการบัญชีแนบ
define("CON_LIMIT_ACCOUNT","150");

## รหัสรูปแบบการประมวลผลคำสั่งผู้ไม่ได้เลื่อน
define("TEMPLATE_CMD_ID","19");

#@modify  Eakkasit Kamwong 12/03/2015 สร้างตัวแปรแสดงหัวตารางของการสร้างโปรไฟล์การนับตัว
## เลื่อนขั้นเงินเดือน
#@Define
	define("TEXT_RAISE_SARALY_PROFILE","บัญชีนับข้าราชการครูและบุคลากรทางการศึกษา");
	define("TEXT_RAISE_SARALY_ROUND1_TEXT","1 มีนาคม ");
	define("TEXT_RAISE_SARALY_ROUND2_TEXT","1 ตุลาคม ");
	define("TEXT_RAISE_SARALY_ROUND1_TEXT_SHORT","1 มี.ค. ");
	define("TEXT_RAISE_SARALY_ROUND2_TEXT_SHORT","1  ก.ย. ");
#@end Define
#@end 
#@Define Host
#@Define
	define("URL_WCS","http://wcs.cmss-otcsc.com/");
#end
#end 

//@modify Supachai 17/4/2558 ตารางระบบยื่นขอรับรองคุณวุฒิ
define("SYSTEM_TEXT", "ระบบข้อมูลคุณวุฒิที่ ก.ค.ศ. รับรอง");
define('TEXT_QUALIFICATION_NO_ATTACH','ลำดับ');
define('TEXT_QUALIFICATION_QU_NAME','ชื่อคุณวุฒิ');
define('TEXT_QUALIFICATION_COURSE','หลักสูตร');
define('TEXT_QUALIFICATION_COURSE_NOTE','คำอธิบาย หลักสูตร');
define('TEXT_QUALIFICATION_MAJOR','สาขาวิชา/โปรแกรมวิชา<br>/แขนงวิชา');
define('TEXT_QUALIFICATION_NO_BOOK_COURSE','เลขที่หนังสือ <br>สกอ.รับทราบ/เห็นชอบหลักสูตร');
define('TEXT_QUALIFICATION_BOOK_COURSE','เล่มหลักสูตร <br>ที่ประทับตรา สกอ.');
define('TEXT_QUALIFICATION_SET_RADUB','รับรองและ<br>กำหนดอัตราเงินเดือน');
define('TEXT_QUALIFICATION_RADUB','อันดับ');
define('TEXT_QUALIFICATION_SALARY','ขั้น');
define('TEXT_QUALIFICATION_COMMENT','หมายเหตุ');
define('TEXT_QUALIFICATION_APPROVE','รับรอง');// สถานะการรัยรองในส่วนของ exsum หน้า dashboard
define('TEXT_QUALIFICATION_WAIT','รอพิจารณา');// สถานะการรัยรองในส่วนของ exsum หน้า dashboard
define('TEXT_QUALIFICATION_UNAPPROVE','ไม่รับรอง');// สถานะการรัยรองในส่วนของ exsum หน้า dashboard
define('TEXT_QUALIFICATION_UNIMPORT','ยังไม่เข้าวาระพิจารณา');// สถานะการรัยรองในส่วนของ exsum หน้า dashboard
define('TEXT_QUALIFICATION_NO_TICKET','เลขทีคำร้อง');
define('TEXT_QUALIFICATION_NAME_REQ','ชื่อคำร้อง');
define('TEXT_QUALIFICATION_DATE_REQ','วันที่ยื่นคำร้องขอ');
define('TEXT_QUALIFICATION_STATUS_COMPLETE','สถานะการคัดกรอง<br>ความครบถ้วนของการรับรองคุณวุฒิ');
define('TEXT_QUALIFICATION_AMOUNT_QUA','จำนวนคุณวุฒิ');
define('TEXT_QUALIFICATION_TOOLS','เครื่องมือ');
define('TEXT_QUALIFICATION_AMOUNT_ALL','ทั้งหมด');
define('TEXT_QUALIFICATION_SHOW_QUA_LIST','รายการแสดงข้อมูลรายคุณวุฒิ');
define('TEXT_QUALIFICATION_SHOW_QUA','กระดานการยื่นขอรับรองคุณวุฒิ');
define('TEXT_QUALIFICATION_STATUS','สถานะ');
define('TEXT_QUALIFICATION_AMOUNT','จำนวน');
define('TEXT_QUALIFICATION','คุณวุฒิ');
define('TEXT_QUALIFICATION_REQ','คำขอ');
define('TEXT_QUALIFICATION_UNIVERSITY','มหาวิทยาลัย');
define('TEXT_QUALIFICATION_AMOUNT_REQ','จำนวนการยื่นขอ');
define('TEXT_QUALIFICATION_LIST','รายการ');
define('TEXT_QUALIFICATION_IMPORT_AGENDA','นำเข้าวาระการประชุมเพื่อพิจารณา');
define('TEXT_QUALIFICATION_UNIMPORT_AGENDA','รายการที่ยังไม่ได้นำเข้าวาระการประชุม');
define('TEXT_QUALIFICATION_STATUS_APPROVE','สถานะการรับรอง');
define('TEXT_QUALIFICATION_SENDBOOK','ชื่อหนังสือนำส่ง');
define('TEXT_QUALIFICATION_SENDNOBOOK','เลขที่หนังสือนำส่ง');
define('TEXT_QUALIFICATION_SHOW_GRAPH','กราฟแสดงสัดส่วนสถานะการยื่นขอคุณวุฒิ');
define('TEXT_QUALIFICATION_IN_AGENDA','เข้าวาระการประชุม');
define('TEXT_QUALIFICATION_SPECIAL','การประชุมเฉพาะกิจ');
define('TEXT_QUALIFICATION_MEETING_APPROVE','การประชุมเพื่อพิจารณารับรอง');
define('TEXT_QUALIFICATION_DOING','ดำเนินการ');
define('TEXT_QUALIFICATION_UNDOING','ยังไม่ได้ดำเนินการ');
define('TEXT_QUALIFICATION_NUM_BALANCE','คงค้าง');
define('TEXT_QUALIFICATION_NUM_AGENDA','นำเข้าวาระการประชุม');
define('TEXT_QUALIFICATION_HEADER_SEARCH','ค้นหารายชื่อคุณวุฒิที่นำเข้าวาระการประชุมเพื่อพิจารณา');
define('TEXT_QUALIFICATION_HEADER','รายชื่อคุณวุฒิที่นำเข้าวาระการประชุมเพื่อพิจารณา');
//@end
?>