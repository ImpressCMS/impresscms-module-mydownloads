<?php
// $Id: modinfo.php,v 1.16 2004/12/26 19:11:56 onokazu Exp $
// Module Info

// The name of this module
define("_MI_MYDOWNLOADS_NAME","���� �������");

// A brief description of this module
define("_MI_MYDOWNLOADS_DESC","����� ���� ����� ���� ������");

// Names of blocks for this module (Not all module has blocks)
define("_MI_MYDOWNLOADS_BNAME1","��� ����� �����");
define("_MI_MYDOWNLOADS_BNAME2","���� �������");

// Sub menu titles
define("_MI_MYDOWNLOADS_SMNAME1","��� ������");
define("_MI_MYDOWNLOADS_SMNAME2","���� ������� ������");
define("_MI_MYDOWNLOADS_SMNAME3","���� ������� ������");

// Names of admin menu items
define("_MI_MYDOWNLOADS_ADMENU2","����� ������ �����");
define("_MI_MYDOWNLOADS_ADMENU3","����� �����");
define("_MI_MYDOWNLOADS_ADMENU4","����� �� ���� ���");
define("_MI_MYDOWNLOADS_ADMENU5","����� �����");

// Title of config items
define('_MI_MYDOWNLOADS_POPULAR', '��� ���� ������� ����� �������� ����');
define('_MI_MYDOWNLOADS_NEWDLS', '��� ��� ������� ������� �� ������ ������ ������ �������');
define('_MI_MYDOWNLOADS_PERPAGE', '��� ������� �� �� ����');
define('_MI_MYDOWNLOADS_USESHOTS', '���� ��� ���� ���� ������� ��� ������');
define('_MI_MYDOWNLOADS_SHOTWIDTH', '���� ��� ��� ������ ��������� ��� ����');
define('_MI_MYDOWNLOADS_CHECKHOST', '��� ����� ������� �� ���� ����� � (������� ��������)');
define('_MI_MYDOWNLOADS_REFERERS', '��� ������� ����� ��� ���� ����� ������� ���� <br /> ���� ��� �� ���� ���� ������ | ');
define("_MI_MYDOWNLOADS_ANONPOST","���� ����� ������ ������ �");
define('_MI_MYDOWNLOADS_AUTOAPPROVE','��� �������� ��� ���� �� ������ �');
define('_MI_MYDOWNLOADS_TOPORDER',"��� ���� ��� ������� �� ������ �������� �������� �");
define('_MI_MYDOWNLOADS_TOPORDERDSC','����� ������ ����� ��� ������� ���� ����');
define('_MI_MYDOWNLOADS_TOPORDER1',"������� (������)");
define('_MI_MYDOWNLOADS_TOPORDER2',"������� (������)");
define('_MI_MYDOWNLOADS_TOPORDER3',"�������� (������)");
define('_MI_MYDOWNLOADS_TOPORDER4',"�������� (������)");
define('_MI_MYDOWNLOADS_TOPORDER5',"������� (������)");
define('_MI_MYDOWNLOADS_TOPORDER6',"������� (������)");

// Description of each config items
define('_MI_MYDOWNLOADS_POPULARDSC', '');
define('_MI_MYDOWNLOADS_NEWDLSDSC', '');
define('_MI_MYDOWNLOADS_PERPAGEDSC', '');
define('_MI_MYDOWNLOADS_USESHOTSDSC', '');
define('_MI_MYDOWNLOADS_SHOTWIDTHDSC', '');
define('_MI_MYDOWNLOADS_REFERERSDSC', '');
define('_MI_MYDOWNLOADS_AUTOAPPROVEDSC', '');

// Text for notifications

define('_MI_MYDOWNLOADS_GLOBAL_NOTIFY', '�����');
define('_MI_MYDOWNLOADS_GLOBAL_NOTIFYDSC', '������ ������� ������');

define('_MI_MYDOWNLOADS_CATEGORY_NOTIFY', '�������');
define('_MI_MYDOWNLOADS_CATEGORY_NOTIFYDSC', '��������� ������� �� �������');

define('_MI_MYDOWNLOADS_FILE_NOTIFY', '�������');
define('_MI_MYDOWNLOADS_FILE_NOTIFYDSC', '��������� ������� �� �������');

define('_MI_MYDOWNLOADS_GLOBAL_NEWCATEGORY_NOTIFY', '��� ����');
define('_MI_MYDOWNLOADS_GLOBAL_NEWCATEGORY_NOTIFYCAP', '������ ��� ����� ��� ����');
define('_MI_MYDOWNLOADS_GLOBAL_NEWCATEGORY_NOTIFYDSC', '������� ����� �� ��� ��� ��� ����');
define('_MI_MYDOWNLOADS_GLOBAL_NEWCATEGORY_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} ����� ���������� : ��� ���� �������');

define('_MI_MYDOWNLOADS_GLOBAL_FILEMODIFY_NOTIFY', '��� ����� ������');
define('_MI_MYDOWNLOADS_GLOBAL_FILEMODIFY_NOTIFYCAP', '������ �� ��� ���� ����� ��� ������');
define('_MI_MYDOWNLOADS_GLOBAL_FILEMODIFY_NOTIFYDSC', '������� ���� �� ��� ��� ����� �� ������');
define('_MI_MYDOWNLOADS_GLOBAL_FILEMODIFY_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} ����� ���������� : ��� ����� ������');

define('_MI_MYDOWNLOADS_GLOBAL_FILEBROKEN_NOTIFY', '���� ������ ���');
define('_MI_MYDOWNLOADS_GLOBAL_FILEBROKEN_NOTIFYCAP', '������ �� ��� ���� �� ����� �� ���� ������ �����');
define('_MI_MYDOWNLOADS_GLOBAL_FILEBROKEN_NOTIFYDSC', '������� ����� �� ��� ���� ��� �� ���� �� ������');
define('_MI_MYDOWNLOADS_GLOBAL_FILEBROKEN_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} ����� ���������� : ���� ������ �� ����');

define('_MI_MYDOWNLOADS_GLOBAL_FILESUBMIT_NOTIFY', '����� ������');
define('_MI_MYDOWNLOADS_GLOBAL_FILESUBMIT_NOTIFYCAP', '������ ��� ��� ����� ������ ���� (����� ���� �����).');
define('_MI_MYDOWNLOADS_GLOBAL_FILESUBMIT_NOTIFYDSC', '������� ����� �� ��� ������ �� ������ ���� (����� ���� �����).');
define('_MI_MYDOWNLOADS_GLOBAL_FILESUBMIT_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} ����� ���������� : ����� ������ ����');

define('_MI_MYDOWNLOADS_GLOBAL_NEWFILE_NOTIFY', '������ ����');
define('_MI_MYDOWNLOADS_GLOBAL_NEWFILE_NOTIFYCAP', '������ �� ��� ��� �� ������');
define('_MI_MYDOWNLOADS_GLOBAL_NEWFILE_NOTIFYDSC', '������� ����� �� ��� ���� �� ������ ���� ���� ����� �������');
define('_MI_MYDOWNLOADS_GLOBAL_NEWFILE_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} ����� ���������� : ������ ����');

define('_MI_MYDOWNLOADS_CATEGORY_FILESUBMIT_NOTIFY', '����� ������');
define('_MI_MYDOWNLOADS_CATEGORY_FILESUBMIT_NOTIFYCAP', '������ �� �� ������ ���� �� ��� ����� ����� ����� �����');
define('_MI_MYDOWNLOADS_CATEGORY_FILESUBMIT_NOTIFYDSC', '������� ����� �� ��� ���� ����� ������� �� ��� ����� ����� ����� �����');
define('_MI_MYDOWNLOADS_CATEGORY_FILESUBMIT_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} ����� ���������� : ������ ���� �� �����');

define('_MI_MYDOWNLOADS_CATEGORY_NEWFILE_NOTIFY', '������ ����');
define('_MI_MYDOWNLOADS_CATEGORY_NEWFILE_NOTIFYCAP', '������ �� ���  ��� ������ ���� �� ��� �����');
define('_MI_MYDOWNLOADS_CATEGORY_NEWFILE_NOTIFYDSC', '������� ����� �� ��� ��� ������ ���� �� ��� �����');
define('_MI_MYDOWNLOADS_CATEGORY_NEWFILE_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} ����� ���������� : ������ ���� �� �����');

define('_MI_MYDOWNLOADS_FILE_APPROVE_NOTIFY', '������ ���� ����� ���');
define('_MI_MYDOWNLOADS_FILE_APPROVE_NOTIFYCAP', '������ ��� ����� ��� �������� ����� ���');
define('_MI_MYDOWNLOADS_FILE_APPROVE_NOTIFYDSC', '������� ����� �� ��� ����� ����� ��� ��������');
define('_MI_MYDOWNLOADS_FILE_APPROVE_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} ����� ���������� : ����� ��� ��������');

// ajout Herv�
define('_MI_MYDOWNLOADS_MIMETYPE',"�������� �������");
define('_MI_MYDOWNLOADS_MIMETYPE_DSC',"���� �������� ������� ������� ��� � ���� ����� ������ |");
define('_MI_MYDOWNLOADS_MAXUPLOAD_SIZE',"����� ������ ������� ��������");
define('_MI_MYDOWNLOADS_USE_EDITOR',"������� ���� ������ koivi �");
define('_MI_MYDOWNLOADS_AUTO_SUMMARY',"������� �������� �");

// Added in v1.4
define('_MI_MYDOWNLOADS_UPLOAD_FOLDER',"��� ���� ����� ������� (������)");
define('_MI_MYDOWNLOADS_UPLOAD_URL',"��� ���� ���� ����� ������� �� ������");
define('_MI_MYDOWNLOADS_RENAME_FILES',"����� ������� ������� ��� ����� �");

// Added in v1.44
define('_MI_MYDOWNLOADS_SHOW_UPDATED',"��� ������ ���� � ���� �");

// Added in v1.45
define("_MI_MYDOWNLOADS_FORM_OPTIONS","������ ���������");
define("_MI_MYDOWNLOADS_FORM_COMPACT","Compact");
define("_MI_MYDOWNLOADS_FORM_DHTML","DHTML");
define("_MI_MYDOWNLOADS_FORM_SPAW","Spaw Editor");
define("_MI_MYDOWNLOADS_FORM_HTMLAREA","HtmlArea Editor");
define("_MI_MYDOWNLOADS_FORM_FCK","FCK Editor");
define("_MI_MYDOWNLOADS_FORM_KOIVI","Koivi Editor");
define("_MI_MYDOWNLOADS_FORM_TINYEDITOR","TinyEditor");
define("_MI_MYDOWNLOADS_ADMENU1", "��������");

define('_MI_MYDL_SHOTSUPLOAD_FOLDER',"��� ���� ����� (������) ������ ����� ��������� (���� ����� / �� �������)");
define('_MI_MYDL_SHOTSUPLOAD_URL',"��� ���� ���� ����� ����� ��������� �� ����� (���� ����� / �� �������)");
define("_MI_MYDOWNLOADS_PLATFORM", "���� �������");

// Added in version 1.5
define("_MI_MYDOWNLOADS_PAGER", "������ ��� ������� �");
define("_MI_MYDOWNLOADS_ADMENU6", "���������");
?>
