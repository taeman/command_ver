<?php  ######################  start Header ########################
/**
* @comment �������Ѻ��� Define ���ҧ����Ѻ����ź��䢢����ŷ�������к�
* @projectCode 57CMSS10
* @tor Unkonw
* @package core
* @author Suwat.K 
* @access private
* @created 14/10/2014
*/

#@modify Suwat.K  14/10/2014 Define ���ҧ����Ѻ�红����Ż������
    ## �����ŷ���¹����ѵ�����硷�͹ԡ�� ���ҧ��ѡ����Ѻ��ҧ�ԧ������
        define('TBL_ALLSCHOOL', 'allschool');# ���ҧ�红�����ʶҹ�֡��
        define('TBL_EDUAREA', 'eduarea');# ���ҧ�红�����ࢵ��鹷�����֡��
        define('TBL_TABLE_CONFIG', 'table_config'); # ����¡�â����ŵ��ҧ�����Ż����������Ѻ�������
        define('TBL_EDUAREA_ALTER_TABLE', 'eduarea_alter_table_structure'); # ����¡�â����ŵ��ҧ�����Ż����������Ѻ�������
        
    ## �����ŷ���¹����ѵ�����硷�͹ԡ�� ����źؤ�������駻���ѵԡ���Ѻ�Ҫ���
        define('TBL_VIEW_GENERAL', 'view_general');# ���ҧ�红����ŷ���仺ؤ�ҡ�
        define('TBL_SALARY', 'salary');#���ҧ�红����Ż���ѵԵ��˹�����ѵ���Թ��͹
        
        
    ## �����Ţͧ�к�����͹�Թ��͹
        define('TBL_UP_SALARY_WLOG', 'up_salary_writedoc_log');#���ҧ�红������ٻẺ�����¹�����ŷ���¹����ѵ�
        


    ## ���ҧ����Ѻ temp  ����Ѻ��Ǩ�ͺ����������红����Ū��Ǥ���
        define('TBL_DATA_DUPLICATE','temp_view_general_duplicate'); # �红����źؤ�ҡ�����Ѻ��Ǩ�ͺ�����ū����к��ҹ��ҧ��Ш�˹�����¤�
        define('TBL_DATA_DUPLICATE_DETAIL','temp_view_general_duplicate_detail'); # �红����źؤ�ҡ�����Ѻ��Ǩ�ͺ�����ū����к��ҹ��ҧ��Ш�˹��µ����¡�â�����
   
#@end

//@modify pannawit 29/10/2014 define ���ҧ�к�����͹����Թ��͹
define('UpSalaryDetail','up_salary_detail');  # �红����Ť����������͹����Թ��͹
define('UpSalaryMaster','up_salary_master');  # �红��������������͹����Թ��͹
define('UpConfirmMaster','up_confirm_master');  # �红����źѭ�շ������ǡѺ�������͹����Թ��͹
define('UpSalaryStyle','up_salary_style'); #�纤�� config �ͧ���������͹����Թ��͹
define('UpConfirmDetail','up_confirm_detail'); #����������´������
define('TempCleansingChecklist','temp_cleansing_checklist'); #���ҧ�红����ŷ���Ǩ�ͺ�����١��ͧ���� ���� cleansing �����ŷ���¹����ѵ�
//@end

//@modify Supachai 17/4/2558 ���ҧ�к���蹢��Ѻ�ͧ�س�ز�

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