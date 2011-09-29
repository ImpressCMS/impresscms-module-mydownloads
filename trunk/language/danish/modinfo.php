<?php
// $Id: modinfo.php,v 1.16 2004/12/26 19:11:56 onokazu Exp $
// Module Info

// The name of this module
define('_MI_MYDOWNLOADS_NAME', 'Downloads');

// A brief description of this module
define('_MI_MYDOWNLOADS_DESC', 'Opretter en downloadsektion, hvor brugere kan tilf�je downloads, og stemme p� disse.');

// Names of blocks for this module (Not all module has blocks)
define('_MI_MYDOWNLOADS_BNAME1', 'Nyeste Downloads');
define('_MI_MYDOWNLOADS_BNAME2', 'Top Downloads');

// Sub menu titles
define('_MI_MYDOWNLOADS_SMNAME1', 'Indsend download');
define('_MI_MYDOWNLOADS_SMNAME2', 'Popul�r');
define('_MI_MYDOWNLOADS_SMNAME3', 'Bedst bed�mte');

// Names of admin menu items
define('_MI_MYDOWNLOADS_ADMENU2', 'Tilf�j/redig�r downloads');
define('_MI_MYDOWNLOADS_ADMENU3', 'Indsendte Downloads');
define('_MI_MYDOWNLOADS_ADMENU4', 'Defekte Downloads');
define('_MI_MYDOWNLOADS_ADMENU5', '�ndrede Downloads');

// Title of config items
define('_MI_MYDOWNLOADS_POPULAR', 'Antallet af hits f�r et download bliver markeret som popul�rt');
define('_MI_MYDOWNLOADS_NEWDLS', 'Max. antal nye downloads vist p� hovedsiden');
define('_MI_MYDOWNLOADS_PERPAGE', 'Max. antal downloads vist p� hver side');
define('_MI_MYDOWNLOADS_USESHOTS', 'V�lg ja for at f� vist screenshot billeder ved hver fil.');
define('_MI_MYDOWNLOADS_SHOTWIDTH', 'Indtast max brede p� screenshot billed');
define('_MI_MYDOWNLOADS_CHECKHOST', 'Forbyd direct download link? (leeching)');
define('_MI_MYDOWNLOADS_REFERERS', 'Dette site kan linke direkte til dine filer <br />Adskild hver side med | ');
define('_MI_MYDOWNLOADS_ANONPOST', 'Tillad anonyme bruger at indsende downloads.');
define('_MI_MYDOWNLOADS_AUTOAPPROVE', 'Godkend automatisk nye downloads uden godkendelse fra admin?');
define('_MI_MYDOWNLOADS_TOPORDER', 'Hvordan skal visningen v�re p� indexsiden ?');
define('_MI_MYDOWNLOADS_TOPORDERDSC', 'Du kan v�lge hvilke downloads der skal vises p� indexsiden');
define('_MI_MYDOWNLOADS_TOPORDER1', 'Dato (nyeste f�rst)');
define('_MI_MYDOWNLOADS_TOPORDER2', 'Dato (�ldste f�rst)');
define('_MI_MYDOWNLOADS_TOPORDER3', 'Hits (flest hits f�rst)');
define('_MI_MYDOWNLOADS_TOPORDER4', 'Hits (f�rrest hits f�rst)');
define('_MI_MYDOWNLOADS_TOPORDER5', 'Bed�mmelser (flest ratings f�rst)');
define('_MI_MYDOWNLOADS_TOPORDER6', 'Bed�mmelser (f�rrest ratings f�rst)');

// Description of each config items
define('_MI_MYDOWNLOADS_POPULARDSC', '');
define('_MI_MYDOWNLOADS_NEWDLSDSC', '');
define('_MI_MYDOWNLOADS_PERPAGEDSC', '');
define('_MI_MYDOWNLOADS_USESHOTSDSC', '');
define('_MI_MYDOWNLOADS_SHOTWIDTHDSC', '');
define('_MI_MYDOWNLOADS_REFERERSDSC', '');
define('_MI_MYDOWNLOADS_AUTOAPPROVEDSC', '');

// Text for notifications

define('_MI_MYDOWNLOADS_GLOBAL_NOTIFY', 'Global');
define('_MI_MYDOWNLOADS_GLOBAL_NOTIFYDSC', 'Overordnet downloads besked muligheder');

define('_MI_MYDOWNLOADS_CATEGORY_NOTIFY', 'Kategori');
define('_MI_MYDOWNLOADS_CATEGORY_NOTIFYDSC', 'Besked muligheder for denne fil kategori');

define('_MI_MYDOWNLOADS_FILE_NOTIFY', 'Fil');
define('_MI_MYDOWNLOADS_FILE_NOTIFYDSC', 'Besked muligheder for denne fil');

define('_MI_MYDOWNLOADS_GLOBAL_NEWCATEGORY_NOTIFY', 'Ny kategori');
define('_MI_MYDOWNLOADS_GLOBAL_NEWCATEGORY_NOTIFYCAP', 'Send mig en besked n�r der oprettes en ny kategori');
define('_MI_MYDOWNLOADS_GLOBAL_NEWCATEGORY_NOTIFYDSC', 'Modtag besked n�r en ny fil kategori oprettes');
define('_MI_MYDOWNLOADS_GLOBAL_NEWCATEGORY_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-besked : Ny fil-kategori');

define('_MI_MYDOWNLOADS_GLOBAL_FILEMODIFY_NOTIFY', 'Rediger fil kategori');
define('_MI_MYDOWNLOADS_GLOBAL_FILEMODIFY_NOTIFYCAP', 'Send mig en besked ved �ndringer af filer');
define('_MI_MYDOWNLOADS_GLOBAL_FILEMODIFY_NOTIFYDSC', 'Modtag en besked n�r der �nskes �ndringer til filer');
define('_MI_MYDOWNLOADS_GLOBAL_FILEMODIFY_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-besked : �nske om �ndring af fil.');

define('_MI_MYDOWNLOADS_GLOBAL_FILEBROKEN_NOTIFY', 'Defekt fil indsendt');
define('_MI_MYDOWNLOADS_GLOBAL_FILEBROKEN_NOTIFYCAP', 'Giv mig besked n�r der rapporteres om defekte filer');
define('_MI_MYDOWNLOADS_GLOBAL_FILEBROKEN_NOTIFYDSC', 'Modtag en besked n�r der indsendes defekte filer');
define('_MI_MYDOWNLOADS_GLOBAL_FILEBROKEN_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-besked : Rapport over defekte filer');

define('_MI_MYDOWNLOADS_GLOBAL_FILESUBMIT_NOTIFY', 'Fil indsendt');
define('_MI_MYDOWNLOADS_GLOBAL_FILESUBMIT_NOTIFYCAP', 'Giv mig besked n�r en hvilken som helst ny fil indsendes (afventer godkendelse)');
define('_MI_MYDOWNLOADS_GLOBAL_FILESUBMIT_NOTIFYDSC', 'Modtag besked n�r en hvilken som helst ny fil er indsendt (afventer godkendelse)');
define('_MI_MYDOWNLOADS_GLOBAL_FILESUBMIT_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-besked : Ny fil indsendt');

define('_MI_MYDOWNLOADS_GLOBAL_NEWFILE_NOTIFY', 'Ny fil');
define('_MI_MYDOWNLOADS_GLOBAL_NEWFILE_NOTIFYCAP', 'Giv mig besked n�r en ny fil godkendes.');
define('_MI_MYDOWNLOADS_GLOBAL_NEWFILE_NOTIFYDSC', 'Modtag besked n�r en ny fil er godkendt');
define('_MI_MYDOWNLOADS_GLOBAL_NEWFILE_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-besked : Ny fil');

define('_MI_MYDOWNLOADS_CATEGORY_FILESUBMIT_NOTIFY', 'Fil indsendt');
define('_MI_MYDOWNLOADS_CATEGORY_FILESUBMIT_NOTIFYCAP', 'Giv mig besked n�r en ny fil er indsendt (afventer godkendelse)');
define('_MI_MYDOWNLOADS_CATEGORY_FILESUBMIT_NOTIFYDSC', 'Modtage besked n�r en ny fil er indsendt (afventer godkendelse) til aktuel kategori');
define('_MI_MYDOWNLOADS_CATEGORY_FILESUBMIT_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-besked : Ny fil indsendt i kategori');

define('_MI_MYDOWNLOADS_CATEGORY_NEWFILE_NOTIFY', 'Ny fil');
define('_MI_MYDOWNLOADS_CATEGORY_NEWFILE_NOTIFYCAP', 'Giv mig besked n�r en ny fil indsendes i den aktuelle kategori');
define('_MI_MYDOWNLOADS_CATEGORY_NEWFILE_NOTIFYDSC', 'Modtage besked n�r en ny fil indsendes i den aktuelle kategori');
define('_MI_MYDOWNLOADS_CATEGORY_NEWFILE_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-besked: Ny fil i kategori');

define('_MI_MYDOWNLOADS_FILE_APPROVE_NOTIFY', 'Fil godkendt');
define('_MI_MYDOWNLOADS_FILE_APPROVE_NOTIFYCAP', 'Giv mig besked n�r denne fil er godkendt');
define('_MI_MYDOWNLOADS_FILE_APPROVE_NOTIFYDSC', 'Modtag besked n�r denne fil er godkendt.');
define('_MI_MYDOWNLOADS_FILE_APPROVE_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-besked: Fil godkendt');

// ajout Herv�
define('_MI_MYDOWNLOADS_MIMETYPE', 'Filtyper');
define('_MI_MYDOWNLOADS_MIMETYPE_DSC', 'Angiv hvilke filtyper der m� uploades (adskil med | )');
define('_MI_MYDOWNLOADS_MAXUPLOAD_SIZE', 'Maksimal filst�rrelse p� uploads');
define('_MI_MYDOWNLOADS_USE_EDITOR', 'Brug Kiovi?');
define('_MI_MYDOWNLOADS_AUTO_SUMMARY', 'Automatisk resum�');

// Added in v1.4
define('_MI_MYDOWNLOADS_UPLOAD_FOLDER', 'V�lg folder til uploads (STIEN)');
define('_MI_MYDOWNLOADS_UPLOAD_URL', 'V�lg den matchende URL');
define('_MI_MYDOWNLOADS_RENAME_FILES', 'Omd�b filer ved upload?');

// Added in v1.44
define('_MI_MYDOWNLOADS_SHOW_UPDATED',"Vis billederne 'opdateret' og 'ny'?");

// Added in v1.45
define("_MI_MYDOWNLOADS_FORM_OPTIONS","Form Option");
define("_MI_MYDOWNLOADS_FORM_COMPACT","Compact");
define("_MI_MYDOWNLOADS_FORM_DHTML","DHTML");
define("_MI_MYDOWNLOADS_FORM_SPAW","Spaw Editor");
define("_MI_MYDOWNLOADS_FORM_HTMLAREA","HtmlArea Editor");
define("_MI_MYDOWNLOADS_FORM_FCK","FCK Editor");
define("_MI_MYDOWNLOADS_FORM_KOIVI","Koivi Editor");
define("_MI_MYDOWNLOADS_FORM_TINYEDITOR","TinyEditor");
define("_MI_MYDOWNLOADS_ADMENU1", "Indeks");
define('_MI_MYDL_SHOTSUPLOAD_FOLDER',"V�lg upload mappe (STIEN) til screenshots (uden skr�streg )");
define('_MI_MYDL_SHOTSUPLOAD_URL',"V�lg den tilsvarende URL til screenshots (uden skr�streg)");
define("_MI_MYDOWNLOADS_PLATFORM", "Platform");
// Added in version 1.5
define("_MI_MYDOWNLOADS_PAGER", "Brugerside p� modulets indeks side?");
define("_MI_MYDOWNLOADS_ADMENU6", "Rettigheder");
?>