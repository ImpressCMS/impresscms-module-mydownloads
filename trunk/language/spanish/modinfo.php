<?php // Xoops Spanish Support (http://www.esxoops.com)
// $Id: modinfo.php,v 1.10 2003/03/27 23:17:10 w4z004 Exp $
// Module Info

// The name of this module
define("_MI_MYDOWNLOADS_NAME","Descargas");

// A brief description of this module
define("_MI_MYDOWNLOADS_DESC","Crea una sección de Descargas donde los usuarios pueden bajar/enviar/valorar varios archivos.");

// Names of blocks for this module (Not all module has blocks)
define("_MI_MYDOWNLOADS_BNAME1","Descargas Recientes");
define("_MI_MYDOWNLOADS_BNAME2","Top Descargas");

// Sub menu titles
define("_MI_MYDOWNLOADS_SMNAME1","Enviar");
define("_MI_MYDOWNLOADS_SMNAME2","Popular");
define("_MI_MYDOWNLOADS_SMNAME3","Top Valoración");

// Names of admin menu items
define("_MI_MYDOWNLOADS_ADMENU2","Agregar/Editar Descargas");
define("_MI_MYDOWNLOADS_ADMENU3","Descargas Enviadas");
define("_MI_MYDOWNLOADS_ADMENU4","Descargas Rotas");
define("_MI_MYDOWNLOADS_ADMENU5","Descargas Modificadas");

// Title of config items
define('_MI_MYDOWNLOADS_POPULAR', 'Número de hits para ser marcado como popular');
define('_MI_MYDOWNLOADS_NEWDLS', 'Máximo número de nuevos items mostrados en la página principal');
define('_MI_MYDOWNLOADS_PERPAGE', 'Máximo número de items mostrados en cada página');
define('_MI_MYDOWNLOADS_USESHOTS', 'Seleccione SI para mostrar imágenes para cada item de descarga');
define('_MI_MYDOWNLOADS_SHOTWIDTH', 'Máximo ancho de las imágenes');
define('_MI_MYDOWNLOADS_CHECKHOST', '¿ Restringir el enlace directo a tus Archivos ? (Leeching)');
define('_MI_MYDOWNLOADS_REFERERS', 'Estos sitios podrán enlazar directamente los archivos <br />Separar cada uno con | ');
define("_MI_MYDOWNLOADS_ANONPOST","¿ Permitir a los usuarios anónimos el envío de descargas ?");
define('_MI_MYDOWNLOADS_AUTOAPPROVE','¿ Auto aprobar nuevas Descargas sin la intervención del Adminstrador ?');

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
define('_MI_MYDOWNLOADS_GLOBAL_NOTIFYDSC', 'Opciones de Notificación Global de Descargas.');

define('_MI_MYDOWNLOADS_CATEGORY_NOTIFY', 'Categoría');
define('_MI_MYDOWNLOADS_CATEGORY_NOTIFYDSC', 'Opciones de Notificación que se aplican a la categoría actual de archivos.');

define('_MI_MYDOWNLOADS_FILE_NOTIFY', 'Archivo');
define('_MI_MYDOWNLOADS_FILE_NOTIFYDSC', 'Opciones de Notificación que se aplican al archivo actual.');

define('_MI_MYDOWNLOADS_GLOBAL_NEWCATEGORY_NOTIFY', 'Nueva Categoría');
define('_MI_MYDOWNLOADS_GLOBAL_NEWCATEGORY_NOTIFYCAP', 'Notificarme cuando una nueva categoría es creada.');
define('_MI_MYDOWNLOADS_GLOBAL_NEWCATEGORY_NOTIFYDSC', 'Recibir notificación cuando una categoría es creada.');
define('_MI_MYDOWNLOADS_GLOBAL_NEWCATEGORY_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notificación : Nueva categoría');

define('_MI_MYDOWNLOADS_GLOBAL_FILEMODIFY_NOTIFY', 'Modificación de archivo Requerida');
define('_MI_MYDOWNLOADS_GLOBAL_FILEMODIFY_NOTIFYCAP', 'Notificarme de cualquier pedido de modificación de archivo.');
define('_MI_MYDOWNLOADS_GLOBAL_FILEMODIFY_NOTIFYDSC', 'Recibir notificación cuando cualquier pedido de modificación es enviado.');
define('_MI_MYDOWNLOADS_GLOBAL_FILEMODIFY_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notificación : Modificación de archivo Requerida');

define('_MI_MYDOWNLOADS_GLOBAL_FILEBROKEN_NOTIFY', 'Archivo Roto reportado');
define('_MI_MYDOWNLOADS_GLOBAL_FILEBROKEN_NOTIFYCAP', 'Notificarme de cualquier reporte de archivo roto.');
define('_MI_MYDOWNLOADS_GLOBAL_FILEBROKEN_NOTIFYDSC', 'Recibir notificación cuando un reporte de cualquier archivo roto es enviado.');
define('_MI_MYDOWNLOADS_GLOBAL_FILEBROKEN_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notificación :  Archivo Roto reportado');

define('_MI_MYDOWNLOADS_GLOBAL_FILESUBMIT_NOTIFY', 'Archivo enviado');
define('_MI_MYDOWNLOADS_GLOBAL_FILESUBMIT_NOTIFYCAP', 'Notificarme cuando cualquier nuevo archivo es enviado (aguardando aprobación).');
define('_MI_MYDOWNLOADS_GLOBAL_FILESUBMIT_NOTIFYDSC', 'Recibir una notificación cuando cualquier archivo nuevo es enviado (aguardando aprobación).');
define('_MI_MYDOWNLOADS_GLOBAL_FILESUBMIT_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notificación : Nuevo archivo enviado');

define('_MI_MYDOWNLOADS_GLOBAL_NEWFILE_NOTIFY', 'Nuevo Archivo');
define('_MI_MYDOWNLOADS_GLOBAL_NEWFILE_NOTIFYCAP', 'Notificarme cuando un nuevo archivo es publicado.');
define('_MI_MYDOWNLOADS_GLOBAL_NEWFILE_NOTIFYDSC', 'Recibir una noticicación cuando cualquier archivo nuevo sea publicado.');
define('_MI_MYDOWNLOADS_GLOBAL_NEWFILE_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notificación : Nuevo archivo');

define('_MI_MYDOWNLOADS_CATEGORY_FILESUBMIT_NOTIFY', 'Archivo enviado');
define('_MI_MYDOWNLOADS_CATEGORY_FILESUBMIT_NOTIFYCAP', 'Notificarme cuando un nuevo archivo es enviado (aguardando aprobación) en la categoría actual.');
define('_MI_MYDOWNLOADS_CATEGORY_FILESUBMIT_NOTIFYDSC', 'Recibir una notificación cuando un nuevo archivo es enviado (aguardando aprobación) en la categoría actual.');
define('_MI_MYDOWNLOADS_CATEGORY_FILESUBMIT_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notificación : Nuevo archivo enviado en categoría');

define('_MI_MYDOWNLOADS_CATEGORY_NEWFILE_NOTIFY', 'Nuevo archivo');
define('_MI_MYDOWNLOADS_CATEGORY_NEWFILE_NOTIFYCAP', 'Notificarme cuando un nuevo archivo es publicado en la categoría actual.');
define('_MI_MYDOWNLOADS_CATEGORY_NEWFILE_NOTIFYDSC', 'Recibir una notificación cuando un nuevo archivo es publicado en la categoría actual.');
define('_MI_MYDOWNLOADS_CATEGORY_NEWFILE_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notificación : Nuevo archivo en categoría');

define('_MI_MYDOWNLOADS_FILE_APPROVE_NOTIFY', 'Archivo Aprobado');
define('_MI_MYDOWNLOADS_FILE_APPROVE_NOTIFYCAP', 'Notificarme cuando este archivo es aprobado.');
define('_MI_MYDOWNLOADS_FILE_APPROVE_NOTIFYDSC', 'Recibir una notificación cuando este archivo sea aprobado.');
define('_MI_MYDOWNLOADS_FILE_APPROVE_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} auto-notificación : Archivo Aprobado');

// Añadido por Herv
define('_MI_MYDOWNLOADS_MIMETYPE',"Mime Types");
define('_MI_MYDOWNLOADS_MIMETYPE_DSC',"Enter the authorized mime types separated by a |");
define('_MI_MYDOWNLOADS_MAXUPLOAD_SIZE',"Max uploaded files size");
define('_MI_MYDOWNLOADS_USE_EDITOR',"Use Kiovi?");
define('_MI_MYDOWNLOADS_AUTO_SUMMARY',"Automatic Summary ?");

// Añadido en v1.4
define('_MI_MYDOWNLOADS_UPLOAD_FOLDER',"Seleccionar directorio de subida (RUTA)");
define('_MI_MYDOWNLOADS_UPLOAD_URL',"Seleccionar la URL");
define('_MI_MYDOWNLOADS_RENAME_FILES',"¿Renombrar el archivo al subirlo?");

// Añadido en v1.44
define('_MI_MYDOWNLOADS_SHOW_UPDATED',"¿Mostrar imágenes de 'actualizado' y 'nuevo'?");

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
define('_MI_MYDL_SHOTSUPLOAD_FOLDER',"Select upload folder (THE PATH) for screenshots (without trailing slash)");
define('_MI_MYDL_SHOTSUPLOAD_URL',"Select the matching URL for screenshots (without trailing slash)");
define("_MI_MYDOWNLOADS_PLATFORM", "Platform");
?>
