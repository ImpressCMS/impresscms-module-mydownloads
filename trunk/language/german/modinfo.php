<?php
// $Id: modinfo.php,v 1.16 2004/12/26 19:11:56 onokazu Exp $
// Module Info

// The name of this module
define('_MI_MYDOWNLOADS_NAME', 'Downloads');
// A brief description of this module
define('_MI_MYDOWNLOADS_DESC', 'Erzeugt eine Downloads-Rubrik, inder Benutzer Ihre Downloads einsenden können und verschiedene Dateien bewerten');
// Names of blocks for this module (Not all module has blocks)
define('_MI_MYDOWNLOADS_BNAME1', ' Aktuelle Downloads ');
define('_MI_MYDOWNLOADS_BNAME2', 'Top Downloads');
// Sub menu titles
define('_MI_MYDOWNLOADS_SMNAME1', 'Eintragen');
define('_MI_MYDOWNLOADS_SMNAME2', 'Populär');
define('_MI_MYDOWNLOADS_SMNAME3', 'Top Bewertet');
// Names of admin menu items
define('_MI_MYDOWNLOADS_ADMENU2', 'Hinzufügen/Ändern von DL');
define('_MI_MYDOWNLOADS_ADMENU3', 'Hinzugefügte DL');
define('_MI_MYDOWNLOADS_ADMENU4', 'Deffekte DL');
define('_MI_MYDOWNLOADS_ADMENU5', 'Geänderte DL');
// Title of config items
define('_MI_MYDOWNLOADS_POPULAR', 'Anzahl der Treffer markiert als populär');
define('_MI_MYDOWNLOADS_NEWDLS', 'Maximale Anzahl der neuen Download-Artikel auf die Hauptseite');
define('_MI_MYDOWNLOADS_PERPAGE', 'Maximale Anzahl von Download-Artikel, die auf jeder Seite zu sehen sind');
define('_MI_MYDOWNLOADS_USESHOTS', 'Wählen Sie "Ja", um Screenshot-Bilder für jeden Download Artikel zuzulassen');
define('_MI_MYDOWNLOADS_SHOTWIDTH', 'Geben Sie die maximale Breite der Bilder Screenshot an');
define('_MI_MYDOWNLOADS_CHECKHOST', 'Direkt verlinken zulassen? (leeching)');
define('_MI_MYDOWNLOADS_REFERERS', 'Diese Seite kann deine Dateien direkt verlinken <br />Trennen Sie die einzelnen eins mit| ');
define('_MI_MYDOWNLOADS_ANONPOST', 'Gäste dürfen Downloads posten?');
define('_MI_MYDOWNLOADS_AUTOAPPROVE', 'Neue Downloads ohne Überprüfung zulassen?');
define('_MI_MYDOWNLOADS_TOPORDER', 'Anzahl der angezeigten Eintrageungen auf der Indexseite?');
define('_MI_MYDOWNLOADS_TOPORDERDSC', 'Auswahl was auf der Indexseite gezeigt wird');
define('_MI_MYDOWNLOADS_TOPORDER1', 'Datum (aufsteigend)');
define('_MI_MYDOWNLOADS_TOPORDER2', 'Datum (absteigend)');
define('_MI_MYDOWNLOADS_TOPORDER3', 'Treffer (aufsteigend)');
define('_MI_MYDOWNLOADS_TOPORDER4', 'Treffer (absteigend)');
define('_MI_MYDOWNLOADS_TOPORDER5', 'Bewertungen (aufsteigend)');
define('_MI_MYDOWNLOADS_TOPORDER6', 'Bewertungen (absteigend)');
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
define('_MI_MYDOWNLOADS_GLOBAL_NOTIFYDSC', 'Global downloads notification options.');
define('_MI_MYDOWNLOADS_CATEGORY_NOTIFY', 'Kategorie');
define('_MI_MYDOWNLOADS_CATEGORY_NOTIFYDSC', 'Notification options that apply to the current file category.');
define('_MI_MYDOWNLOADS_FILE_NOTIFY', 'Datei');
define('_MI_MYDOWNLOADS_FILE_NOTIFYDSC', 'Notification options that apply to the current file.');
define('_MI_MYDOWNLOADS_GLOBAL_NEWCATEGORY_NOTIFY', 'Neue Kategorie');
define('_MI_MYDOWNLOADS_GLOBAL_NEWCATEGORY_NOTIFYCAP', 'Notify me when a new file category is created.');
define('_MI_MYDOWNLOADS_GLOBAL_NEWCATEGORY_NOTIFYDSC', 'Receive notification when a new file category is created.');
define('_MI_MYDOWNLOADS_GLOBAL_NEWCATEGORY_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : New file category');
define('_MI_MYDOWNLOADS_GLOBAL_FILEMODIFY_NOTIFY', 'Ändern Datei beantragt');
define('_MI_MYDOWNLOADS_GLOBAL_FILEMODIFY_NOTIFYCAP', 'Benachrichtigen Sie mich über jede Datei Änderung Anfrage.');
define('_MI_MYDOWNLOADS_GLOBAL_FILEMODIFY_NOTIFYDSC', 'Erhalten Sie Benachrichtigung, wenn eine beliebige Datei Änderung Antrag eingereicht wird.');
define('_MI_MYDOWNLOADS_GLOBAL_FILEMODIFY_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : File Modification Requested');
define('_MI_MYDOWNLOADS_GLOBAL_FILEBROKEN_NOTIFY', 'Deffekte Datei eingetragen');
define('_MI_MYDOWNLOADS_GLOBAL_FILEBROKEN_NOTIFYCAP', 'Benachrichtigen Sie mich über einen ungültigen Datei Bericht.');
define('_MI_MYDOWNLOADS_GLOBAL_FILEBROKEN_NOTIFYDSC', 'Receive notification when any broken file report is submitted.');
define('_MI_MYDOWNLOADS_GLOBAL_FILEBROKEN_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : Broken File Reported');
define('_MI_MYDOWNLOADS_GLOBAL_FILESUBMIT_NOTIFY', 'Datei eingetragen');
define('_MI_MYDOWNLOADS_GLOBAL_FILESUBMIT_NOTIFYCAP', 'Notify me when any new file is submitted (awaiting approval).');
define('_MI_MYDOWNLOADS_GLOBAL_FILESUBMIT_NOTIFYDSC', 'Receive notification when any new file is submitted (awaiting approval).');
define('_MI_MYDOWNLOADS_GLOBAL_FILESUBMIT_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notify : New file submitted');
define('_MI_MYDOWNLOADS_GLOBAL_NEWFILE_NOTIFY', 'Neue Datei');
define('_MI_MYDOWNLOADS_GLOBAL_NEWFILE_NOTIFYCAP', 'Nachricht wenn neue Datei eingesendet worden ist');
define('_MI_MYDOWNLOADS_GLOBAL_NEWFILE_NOTIFYDSC', 'Receive notification when any new file is posted.');
define('_MI_MYDOWNLOADS_GLOBAL_NEWFILE_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} Auto Nachricht: Neue Datei');
define('_MI_MYDOWNLOADS_CATEGORY_FILESUBMIT_NOTIFY', 'Datei eingetragen');
define('_MI_MYDOWNLOADS_CATEGORY_FILESUBMIT_NOTIFYCAP', 'Benachrichtigen Sie mich, wenn eine neue Datei eingereicht wird (noch nicht freigeschaltet) an die aktuelle Kategorie.');
define('_MI_MYDOWNLOADS_CATEGORY_FILESUBMIT_NOTIFYDSC', 'Erhalten Sie Benachrichtigung, wenn eine neue Datei eingereicht wird (noch nicht freigeschaltet) an die aktuelle Kategorie.');
define('_MI_MYDOWNLOADS_CATEGORY_FILESUBMIT_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE}Auto Nachricht: Neue Datei in Kategorie');
define('_MI_MYDOWNLOADS_CATEGORY_NEWFILE_NOTIFY', 'Neue Datei');
define('_MI_MYDOWNLOADS_CATEGORY_NEWFILE_NOTIFYCAP', 'Benachrichtigen Sie mich, wenn eine neue Datei in die aktuelle Kategorie gesendet wird.');
define('_MI_MYDOWNLOADS_CATEGORY_NEWFILE_NOTIFYDSC', 'Erhalten Sie Benachrichtigung, wenn eine neue Datei in dei aktuelle Kategorie gesendet wird.');
define('_MI_MYDOWNLOADS_CATEGORY_NEWFILE_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} Auto Nachricht: Neue Datei in Kategorie');
define('_MI_MYDOWNLOADS_FILE_APPROVE_NOTIFY', 'Datei überprüft');
define('_MI_MYDOWNLOADS_FILE_APPROVE_NOTIFYCAP', 'Nachricht an mich wenn Datei überprüft worden ist.');
define('_MI_MYDOWNLOADS_FILE_APPROVE_NOTIFYDSC', 'Nachricht erhalten bei überprüfter Datei');
define('_MI_MYDOWNLOADS_FILE_APPROVE_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} Auto Nachricht: Datei überprüft');
// ajout Hervé
define('_MI_MYDOWNLOADS_MIMETYPE', 'Endungs Types');
define('_MI_MYDOWNLOADS_MIMETYPE_DSC', 'Geben Sie zugelassene  MIME-Typen ein, getrennt durch ein |');
define('_MI_MYDOWNLOADS_MAXUPLOAD_SIZE', 'Max Größe der Datei zum hochladen');
define('_MI_MYDOWNLOADS_USE_EDITOR', 'Use Kiovi?');
define('_MI_MYDOWNLOADS_AUTO_SUMMARY', 'Automatisches Ergebnis?');
// Added in v1.4
define('_MI_MYDOWNLOADS_UPLOAD_FOLDER', 'Markiere Upload Verzeichnis (THE PATH)');
define('_MI_MYDOWNLOADS_UPLOAD_URL', 'Markiere URL');
define('_MI_MYDOWNLOADS_RENAME_FILES', 'Rename file while uploading them ?');
// Added in v1.44
define('_MI_MYDOWNLOADS_SHOW_UPDATED', 'Zeige \'Geänderte\'und \'Neue\'Bilder ?');
// Added in v1.45
define('_MI_MYDOWNLOADS_FORM_OPTIONS', 'Editor Form');
define('_MI_MYDOWNLOADS_FORM_COMPACT', 'Compakt');
define('_MI_MYDOWNLOADS_FORM_DHTML', 'DHTML');
define('_MI_MYDOWNLOADS_FORM_SPAW', 'Spaw Editor');
define('_MI_MYDOWNLOADS_FORM_HTMLAREA', 'HtmlArea Editor');
define('_MI_MYDOWNLOADS_FORM_FCK', 'FCK Editor');
define('_MI_MYDOWNLOADS_FORM_KOIVI', 'Koivi Editor');
define('_MI_MYDOWNLOADS_FORM_TINYEDITOR', 'TinyEditor');
define('_MI_MYDOWNLOADS_ADMENU1', 'Index');
define('_MI_MYDL_SHOTSUPLOAD_FOLDER', 'Markiere Upload Verzeichnis (THE PATH) für Screenshots(Ohne Slash)');
define('_MI_MYDL_SHOTSUPLOAD_URL', 'Markiere URL für  Screenshots (Ohne Slash)');
define('_MI_MYDOWNLOADS_PLATFORM', 'Plattform');
// Added in version 1.5
define('_MI_MYDOWNLOADS_PAGER', 'Verwenden Sie Pager-On-Modul-Index-Seite?');
define('_MI_MYDOWNLOADS_ADMENU6', 'Berechtigungen');
?>