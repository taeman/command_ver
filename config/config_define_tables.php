<?php  ######################  start Header ########################
/**
* @comment ไฟล์สำหรับการ Define ตารางสำหรับเพิ่มลบแก้ไขข้อมูลทั้งหมดในระบบ
* @projectCode 57CMSS10
* @tor Unkonw
* @package core
* @author Suwat.K 
* @access private
* @created 14/10/2014
*/

#@modify Suwat.K  14/10/2014 Define ตารางสำหรับเก็บข้อมูลปฐมภูมิ
    ## ข้อมูลทะเบียนประวัติอิเล็กทรอนิกส์ ตารางหลักสำหรับอ้างอิงข้อมูล
        define('TBL_ALLSCHOOL', 'allschool');# ตารางเก็บข้อมูลสถานศึกษา
        define('TBL_EDUAREA', 'eduarea');# ตารางเก็บข้อมูลเขตพื้นที่การศึกษา
        define('TBL_TABLE_CONFIG', 'table_config'); # เก็บรายการข้อมูลตารางข้อมูลปฐมภูมิสำหรับการย้าย
        define('TBL_EDUAREA_ALTER_TABLE', 'eduarea_alter_table_structure'); # เก็บรายการข้อมูลตารางข้อมูลปฐมภูมิสำหรับการย้าย
        
    ## ข้อมูลทะเบียนประวัติอิเล็กทรอนิกส์ ขอมูลบุคคลรวมทั้งประวัติการรับราชการ
        define('TBL_VIEW_GENERAL', 'view_general');# ตารางเก็บข้อมูลทั่วไปบุคลากร
        define('TBL_SALARY', 'salary');#ตารางเก็บข้อมูลประวัติตำแหน่งและอัตราเงินเดือน
        
        
    ## ข้อมูลของระบบเลื่อนเงินเดือน
        define('TBL_UP_SALARY_WLOG', 'up_salary_writedoc_log');#ตารางเก็บข้อมูลรูปแบบการเขียนข้อมูลทะเบียนประวัติ
        


    ## ตารางสำหรับ temp  สำหรับตรวจสอบข้อมูลและเก็บข้อมูลชั่วคราว
        define('TBL_DATA_DUPLICATE','temp_view_general_duplicate'); # เก็บข้อมูลบุคลากรสำหรับตรวจสอบข้อมูลซ้ำในระบบฐานกลางและจำหน่ายรายคน
        define('TBL_DATA_DUPLICATE_DETAIL','temp_view_general_duplicate_detail'); # เก็บข้อมูลบุคลากรสำหรับตรวจสอบข้อมูลซ้ำในระบบฐานกลางและจำหน่ายตามรายการข้อมูล
   
#@end

//@modify pannawit 29/10/2014 define ตารางระบบเลื่อนขั้นเงินเดือน
define('UpSalaryDetail','up_salary_detail');  # เก็บข้อมูลคนที่ได้เลื่อนขั้นเงินเดือน
define('UpSalaryMaster','up_salary_master');  # เก็บข้อมูลโปรไฟล์เลื่อนขั้นเงินเดือน
define('UpConfirmMaster','up_confirm_master');  # เก็บข้อมูลบัญชีที่เกี่ยวกับการเลื่อนขั้นเงินเดือน
define('UpSalaryStyle','up_salary_style'); #เก็บค่า config ของโปรไฟล์เลื่อนขั้นเงินเดือน
define('UpConfirmDetail','up_confirm_detail'); #เก็บรายละเอียดข้อมูล
define('TempCleansingChecklist','temp_cleansing_checklist'); #ตารางเก็บข้อมูลที่ตรวจสอบความถูกต้องแล้ว เพื่อ cleansing ข้อมูลทะเบียนประวัติ
//@end

//@modify Supachai 17/4/2558 ตารางระบบยื่นขอรับรองคุณวุฒิ

# @Define_Table
define('TB_VIEW_GENERAL','view_general');

define('TB_REQ_QUALIFICATION','req_qualification');
define('TB_REQ_QUALIFICATION_DETAIL','req_qualification_detail');
//define('TB_REQ_QUALIFICATION_ATTACH','req_qualification_attach');
define('TB_REQ_MAJOR','req_major');
define('TB_REQ_APPLICATION_MENU','req_application_menu');
define('TB_REQ_NOTIFICATION','req_notification');

define('TB_CMD_COMMAND_QUALIFICATION','cmd_command_qualification');
define('TB_CMD_COMMAND_QUALIFICATION_INPUT','cmd_command_qualification_input');
define('TB_CMD_COMMAND_LETTER','cmd_command_letter');
define('TB_CMD_COMMAND_LETTER_ATTACH','cmd_command_letter_attach');
define('TB_CMD_COMMAND_TBL_SALARY_ACCOUNT_NAME','cmd_command_tbl_salary_account_name');
define('TB_CMD_COMMAND_TBL_SALARY_ACCOUNT_USER','cmd_command_tbl_salary_account_user');
define('TB_CMD_COMMAND_UP_FILESATTACH','cmd_command_up_filesattach');
define('TB_CMD_COMMAND_CONFIG','cmd_command_config');
define('TB_CMD_COMMAND_CONFIG_DETAIL','cmd_command_config_detail');
define('TB_CMD_COMMAND_CONFIG_MATCH','cmd_command_config_match');

define('TB_EDUAREA','eduarea');
define('TB_ALLSCHOOL','allschool');
define('TB_CMD_COMMAND_SR_DETAIL','cmd_command_sr_detail');
define('TB_CMD_COMMAND_SR_GUARANTOR','cmd_command_sr_guarantor');
define('TB_CMD_TEMPLATE','cmd_template');
define('TB_REF_DIGIT','ref_digit');
define('TB_COMMAND_CATEGORY','command_category');

define('TB_REQ_UNIVERSITY','hr_adduniversity');
define('TB_AGD_COMMAND_LETTER_QUALIFICATION','agenda_command_letter_qualification');

//@end
?>