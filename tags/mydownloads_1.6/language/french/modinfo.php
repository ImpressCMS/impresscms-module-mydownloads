<?php
// $Id: modinfo.php,v 1.13 2003/03/27 12:11:05 w4z004 Exp $
// Support Francophone de Xoops (www.frxoops.org)
// Module Info

// The name of this module
define("_MI_MYDOWNLOADS_NAME","T&eacute;l&eacute;chargements");

// A brief description of this module
define("_MI_MYDOWNLOADS_DESC","Cr&eacute;e une section t&eacute;l&eacute;chargements o&ugrave; les utilisateurs peuvent t&eacute;l&eacute;charger/proposer/noter divers fichiers.");

// Names of blocks for this module (Not all module has blocks)
define("_MI_MYDOWNLOADS_BNAME1","T&eacute;l&eacute;chargements r&eacute;cents");
define("_MI_MYDOWNLOADS_BNAME2","Top T&eacute;l&eacute;chargements");

// Sub menu titles
define("_MI_MYDOWNLOADS_SMNAME1","Proposer");
define("_MI_MYDOWNLOADS_SMNAME2","Populaire");
define("_MI_MYDOWNLOADS_SMNAME3","Mieux not&eacute;s");

// Names of admin menu items
define("_MI_MYDOWNLOADS_ADMENU2","Ajouter/Editer des t&eacute;l&eacute;chargements");
define("_MI_MYDOWNLOADS_ADMENU3","Proposer des t&eacute;l&eacute;chargements");
define("_MI_MYDOWNLOADS_ADMENU4","T&eacute;l&eacute;chargements bris&eacute;s");
define("_MI_MYDOWNLOADS_ADMENU5","T&eacute;l&eacute;chargements modifi&eacute;s");

// Title of config items
define('_MI_MYDOWNLOADS_POPULAR', 'Hits pour &ecirc;tre populaire');
define('_MI_MYDOWNLOADS_NEWDLS', "Nombre de nouveaux t&eacute;l&eacute;chargements sur la page d'accueil");
define('_MI_MYDOWNLOADS_PERPAGE', 'T&eacute;l&eacute;chargements affich&eacute;s par page');
define('_MI_MYDOWNLOADS_USESHOTS', "Utiliser des copies d'&eacute;crans ?");
define('_MI_MYDOWNLOADS_SHOTWIDTH', "Largeur des copies d'&eacute;crans");
define('_MI_MYDOWNLOADS_CHECKHOST', "Limiter les aspirateurs de fichiers ?");
define('_MI_MYDOWNLOADS_REFERERS', "Sites avec acc&egrave;s pour lier les t&eacute;l&eacute;chargements");
define("_MI_MYDOWNLOADS_ANONPOST","Autoriser les utilisateurs anonymes &agrave; proposer des t&eacute;l&eacute;chargements ?");
define('_MI_MYDOWNLOADS_AUTOAPPROVE',"Approuver automatiquement les nouveaux t&eacute;l&eacute;chargements sans l'intervention d'un administrateur ?");
define('_MI_MYDOWNLOADS_TOPORDER',"Comment afficher les téléchargement sur la page d'index ?");
define('_MI_MYDOWNLOADS_TOPORDERDSC','Vous pouvez sélectionner quels éléments afficher sur la page d\'index');
define('_MI_MYDOWNLOADS_TOPORDER1',"Date (DESC)");
define('_MI_MYDOWNLOADS_TOPORDER2',"Date (ASC)");
define('_MI_MYDOWNLOADS_TOPORDER3',"Téléchargements (DESC)");
define('_MI_MYDOWNLOADS_TOPORDER4',"Téléchargements (ASC)");
define('_MI_MYDOWNLOADS_TOPORDER5',"Votes (DESC)");
define('_MI_MYDOWNLOADS_TOPORDER6',"Votes (ASC)");

// Description of each config items
define('_MI_MYDOWNLOADS_POPULARDSC', '');
define('_MI_MYDOWNLOADS_NEWDLSDSC', '');
define('_MI_MYDOWNLOADS_PERPAGEDSC', '');
define('_MI_MYDOWNLOADS_USESHOTSDSC', '');
define('_MI_MYDOWNLOADS_SHOTWIDTHDSC', '');
define('_MI_MYDOWNLOADS_REFERERSDSC', '');
define('_MI_MYDOWNLOADS_AUTOAPPROVEDSC', '');

// Text for notifications

define('_MI_MYDOWNLOADS_GLOBAL_NOTIFY', 'Globale');
define('_MI_MYDOWNLOADS_GLOBAL_NOTIFYDSC', 'Options de notification globale des t&eacute;l&eacute;chargements.');

define('_MI_MYDOWNLOADS_CATEGORY_NOTIFY', 'Cat&eacute;gorie');
define('_MI_MYDOWNLOADS_CATEGORY_NOTIFYDSC', "Options de notification s'appliquant &agrave; la cat&eacute;gorie de fichiers actuelle.");

define('_MI_MYDOWNLOADS_FILE_NOTIFY', 'Fichier');
define('_MI_MYDOWNLOADS_FILE_NOTIFYDSC', "Options de notification s'appliquant au fichier actuel.");

define('_MI_MYDOWNLOADS_GLOBAL_NEWCATEGORY_NOTIFY', 'Nouvelle cat&eacute;gorie');
define('_MI_MYDOWNLOADS_GLOBAL_NEWCATEGORY_NOTIFYCAP', 'Notifiez-moi quand une nouvelle cat&eacute;gorie de fichier est cr&eacute;&eacute;e.');
define('_MI_MYDOWNLOADS_GLOBAL_NEWCATEGORY_NOTIFYDSC', "Recevoir une notification lorsqu'une nouvelle cat&eacute;gorie de fichier est cr&eacute;&eacute;e.");
define('_MI_MYDOWNLOADS_GLOBAL_NEWCATEGORY_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} notification automatique : Nouvelle cat&eacute;gorie de fichier');

define('_MI_MYDOWNLOADS_GLOBAL_FILEMODIFY_NOTIFY', 'Modification de fichier demand&eacute;e');
define('_MI_MYDOWNLOADS_GLOBAL_FILEMODIFY_NOTIFYCAP', 'Notifiez-moi pour chaque demande de modification de fichier.');
define('_MI_MYDOWNLOADS_GLOBAL_FILEMODIFY_NOTIFYDSC', "Recevoir une notification quand une demande de modification de fichier est propos&eacute;e.");
define('_MI_MYDOWNLOADS_GLOBAL_FILEMODIFY_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} notification automatique : Modification de fichier demand&eacute;e');

define('_MI_MYDOWNLOADS_GLOBAL_FILEBROKEN_NOTIFY', 'Fichier bris&eacute; propos&eacute;');
define('_MI_MYDOWNLOADS_GLOBAL_FILEBROKEN_NOTIFYCAP', 'Notifiez-moi pour chaque rapport de fichier bris&eacute;.');
define('_MI_MYDOWNLOADS_GLOBAL_FILEBROKEN_NOTIFYDSC', 'Recevoir une notification quand un rapport de fichier bris&eacute; est propos&eacute;.');
define('_MI_MYDOWNLOADS_GLOBAL_FILEBROKEN_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} notification automatique : Fichier bris&eacute; rapport&eacute;');

define('_MI_MYDOWNLOADS_GLOBAL_FILESUBMIT_NOTIFY', 'Nouveau fichier propos&eacute;');
define('_MI_MYDOWNLOADS_GLOBAL_FILESUBMIT_NOTIFYCAP', "Notifiez-moi lorsqu'un nouveau fichier est propos&eacute; (attente d'&ecirc;tre approuv&eacute;).");
define('_MI_MYDOWNLOADS_GLOBAL_FILESUBMIT_NOTIFYDSC', "Recevoir une notification quand un nouveau fichier est propos&eacute; (attente d'&ecirc;tre approuv&eacute;).");
define('_MI_MYDOWNLOADS_GLOBAL_FILESUBMIT_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} notification automatique : Nouveau fichier propos&eacute;');

define('_MI_MYDOWNLOADS_GLOBAL_NEWFILE_NOTIFY', 'Nouveau fichier');
define('_MI_MYDOWNLOADS_GLOBAL_NEWFILE_NOTIFYCAP', "Notifiez-moi lorsqu'un nouveau fichier est post&eacute;.");
define('_MI_MYDOWNLOADS_GLOBAL_NEWFILE_NOTIFYDSC', 'Recevoir une notification quand un nouveau fichier est post&eacute;.');
define('_MI_MYDOWNLOADS_GLOBAL_NEWFILE_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} notification automatique : Nouveau fichier');

define('_MI_MYDOWNLOADS_CATEGORY_FILESUBMIT_NOTIFY', 'Nouveau fichier propos&eacute;');
define('_MI_MYDOWNLOADS_CATEGORY_FILESUBMIT_NOTIFYCAP', "Notifiez-moi lorsqu'un nouveau fichier est propos&eacute; (attente d'&ecirc;tre approuv&eacute;) dans la cat&eacute;gorie actuelle.");
define('_MI_MYDOWNLOADS_CATEGORY_FILESUBMIT_NOTIFYDSC', "Recevoir une notification quand un nouveau fichier est propos&eacute; (attente d'&ecirc;tre approuv&eacute;) dans la cat&eacute;gorie actuelle.");
define('_MI_MYDOWNLOADS_CATEGORY_FILESUBMIT_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} notification automatique : Nouveau fichier propos&eacute; dans la cat&eacute;gorie');

define('_MI_MYDOWNLOADS_CATEGORY_NEWFILE_NOTIFY', 'Nouveau fichier');
define('_MI_MYDOWNLOADS_CATEGORY_NEWFILE_NOTIFYCAP', "Notifiez-moi lorsqu'un nouveau fichier est post&eacute; dans la cat&eacute;gorie actuelle.");
define('_MI_MYDOWNLOADS_CATEGORY_NEWFILE_NOTIFYDSC', "Recevoir une notification quand un nouveau fichier est post&eacute; dans la cat&eacute;gorie actuelle.");
define('_MI_MYDOWNLOADS_CATEGORY_NEWFILE_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} notification automatique : Nouveau fichier dans la cat&eacute;gorie');

define('_MI_MYDOWNLOADS_FILE_APPROVE_NOTIFY', 'Fichier approuv&eacute;');
define('_MI_MYDOWNLOADS_FILE_APPROVE_NOTIFYCAP', 'Notifiez-moi lorsque ce fichier est approuv&eacute;.');
define('_MI_MYDOWNLOADS_FILE_APPROVE_NOTIFYDSC', 'Recevoir une notification quand ce fichier est approuv&eacute;.');
define('_MI_MYDOWNLOADS_FILE_APPROVE_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} notification automatique : Fichier approuv&eacute;');

// ajout Hervé
define('_MI_MYDOWNLOADS_MIMETYPE',"Types mime autorisés");
define('_MI_MYDOWNLOADS_MIMETYPE_DSC',"Entrez les types mime autorisés séparés par un |");
define('_MI_MYDOWNLOADS_MAXUPLOAD_SIZE',"Taille maximale des téléchargements");
define('_MI_MYDOWNLOADS_USE_EDITOR',"Utiliser Kiovi ?");
define('_MI_MYDOWNLOADS_AUTO_SUMMARY',"Sommaire automatique ?");

// Added in v1.4
define('_MI_MYDOWNLOADS_UPLOAD_FOLDER',"Répertoire de téléchargement des fichiers");
define('_MI_MYDOWNLOADS_UPLOAD_URL',"URL de téléchargement correspondante");
define('_MI_MYDOWNLOADS_RENAME_FILES',"Renommer les fichiers uploadés ?");

// Added in v1.44
define('_MI_MYDOWNLOADS_SHOW_UPDATED',"Afficher l'image 'mis à jour' et 'nouveau' ?");

// Added in v1.45
define("_MI_MYDOWNLOADS_FORM_OPTIONS","Form Option");
define("_MI_MYDOWNLOADS_FORM_COMPACT","Compact");
define("_MI_MYDOWNLOADS_FORM_DHTML","DHTML");
define("_MI_MYDOWNLOADS_FORM_SPAW","Spaw Editor");
define("_MI_MYDOWNLOADS_FORM_HTMLAREA","HtmlArea Editor");
define("_MI_MYDOWNLOADS_FORM_FCK","FCK Editor");
define("_MI_MYDOWNLOADS_FORM_KOIVI","Koivi Editor");
define("_MI_MYDOWNLOADS_FORM_TINYEDITOR","TinyEditor");
define("_MI_MYDOWNLOADS_ADMENU1", "Index");
define('_MI_MYDL_SHOTSUPLOAD_FOLDER',"Choisissez le répertoire d'upload (le chemin) pour les copies d'écrans (sans slash final)");
define('_MI_MYDL_SHOTSUPLOAD_URL',"Choisissez l'URL correspondante (sans slash final)");
define("_MI_MYDOWNLOADS_PLATFORM", "Plateforme");

// Added in version 1.5
define("_MI_MYDOWNLOADS_PAGER", "Utiliser un pager sur la page d'index du module ?");
define("_MI_MYDOWNLOADS_ADMENU6", "Permissions");
?>