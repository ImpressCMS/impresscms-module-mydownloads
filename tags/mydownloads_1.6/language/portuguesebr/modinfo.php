<?php
/**
* Translation of mydownloads for Portuguese users
* $Id: main.php,v 1..50 2008/06/16 18:50:57 GibaPhp Exp $
* @Module: mydownloads
* @Version: 1.50
* @Release Date: 2008/06/16
* @Author: onokazu / Hervé / Mowaffak Ali
* @Language: Portuguesebr
* @Translators: GibaPhp / 
* @Revision: 
* @Licence: GNU
*/
// $Id: modinfo.php,v 1.16 2004/12/26 19:11:56 onokazu Exp $
// Module Info

// The name of this module
define("_MI_MYDOWNLOADS_NAME","Downloads");

// A brief description of this module
define("_MI_MYDOWNLOADS_DESC","Cria uma seção downloads onde os usuários podem baixar/ enviar/votar em diversos arquivos.");

// Names of blocks for this module (Not all module has blocks)
define("_MI_MYDOWNLOADS_BNAME1","Downloads Recentes");
define("_MI_MYDOWNLOADS_BNAME2","Melhores Downloads");

// Sub menu titles
define("_MI_MYDOWNLOADS_SMNAME1","Enviar");
define("_MI_MYDOWNLOADS_SMNAME2","Popular");
define("_MI_MYDOWNLOADS_SMNAME3","Mais Votados");

// Names of admin menu items
define("_MI_MYDOWNLOADS_ADMENU2","Incluir/Editar Downloads");
define("_MI_MYDOWNLOADS_ADMENU3","Downloads Apresentados");
define("_MI_MYDOWNLOADS_ADMENU4","Downloads Quebrados");
define("_MI_MYDOWNLOADS_ADMENU5","Downloads Modificados");

// Title of config items
define('_MI_MYDOWNLOADS_POPULAR', 'Número de acessos que um downloads deverá receber para ser marcado como popular');
define('_MI_MYDOWNLOADS_NEWDLS', 'Número máximo de novos ítens de download a ser disponibilizado no topo da página');
define('_MI_MYDOWNLOADS_PERPAGE', 'Número máximo de ítens de download a ser exibido em cada página');
define('_MI_MYDOWNLOADS_USESHOTS', 'Selecione Sim para exibir ScreenShot de imagens para cada item de download');
define('_MI_MYDOWNLOADS_SHOTWIDTH', 'Largura máxima das imagens de ScreenShot');
define('_MI_MYDOWNLOADS_CHECKHOST', 'Bloquear o link de downloads diretos? (leeching)');
define('_MI_MYDOWNLOADS_REFERERS', 'Estes Sites podem utilizar um link direto para os arquivos <br />cada um deve ser separado com um | ');
define("_MI_MYDOWNLOADS_ANONPOST","Permite que usuários anônimos podem fazer downloads?");
define('_MI_MYDOWNLOADS_AUTOAPPROVE','Auto aprovar novos downloads sem intervenção do admin?');
define('_MI_MYDOWNLOADS_TOPORDER',"Como mostrar itens na página de índice ?");
define('_MI_MYDOWNLOADS_TOPORDERDSC','Você pode selecionar quais itens serão mostrados na página de índice');
define('_MI_MYDOWNLOADS_TOPORDER1',"Data (DESC)");
define('_MI_MYDOWNLOADS_TOPORDER2',"Data (ASC)");
define('_MI_MYDOWNLOADS_TOPORDER3',"Acessos (DESC)");
define('_MI_MYDOWNLOADS_TOPORDER4',"Acessos (ASC)");
define('_MI_MYDOWNLOADS_TOPORDER5',"Votos (DESC)");
define('_MI_MYDOWNLOADS_TOPORDER6',"Votos (ASC)");

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
define('_MI_MYDOWNLOADS_GLOBAL_NOTIFYDSC', 'Global - opções de notificação para downloads.');

define('_MI_MYDOWNLOADS_CATEGORY_NOTIFY', 'Categoria');
define('_MI_MYDOWNLOADS_CATEGORY_NOTIFYDSC', 'Opções de Notificação que se aplicam somente aos arquivos desta categoria.');

define('_MI_MYDOWNLOADS_FILE_NOTIFY', 'Arquivo');
define('_MI_MYDOWNLOADS_FILE_NOTIFYDSC', 'Opções de Notificação que se aplicam somente aos arquivos atuais.');

define('_MI_MYDOWNLOADS_GLOBAL_NEWCATEGORY_NOTIFY', 'Nova Categoria');
define('_MI_MYDOWNLOADS_GLOBAL_NEWCATEGORY_NOTIFYCAP', 'Avise-me quando um novo arquivo for criado nesta categoria.');
define('_MI_MYDOWNLOADS_GLOBAL_NEWCATEGORY_NOTIFYDSC', 'Receber notificação quando um novo arquivo for criado nesta categoria.');
define('_MI_MYDOWNLOADS_GLOBAL_NEWCATEGORY_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} Notificação Automática: Novo arquivo nesta categoria');

define('_MI_MYDOWNLOADS_GLOBAL_FILEMODIFY_NOTIFY', 'Solicitar Modificação em arquivo');
define('_MI_MYDOWNLOADS_GLOBAL_FILEMODIFY_NOTIFYCAP', 'Avise-me sobre qualquer pedido de modificação nos arquivos.');
define('_MI_MYDOWNLOADS_GLOBAL_FILEMODIFY_NOTIFYDSC', 'Receber notificação quando qualquer pedido de modificação em arquivos for apresentado.');
define('_MI_MYDOWNLOADS_GLOBAL_FILEMODIFY_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} Notificação Automática: Alteração de Arquivo foi Solicitada');

define('_MI_MYDOWNLOADS_GLOBAL_FILEBROKEN_NOTIFY', 'Arquivo Quebrado Apresentado');
define('_MI_MYDOWNLOADS_GLOBAL_FILEBROKEN_NOTIFYCAP', 'Avise-me de qualquer relatório de arquivo quebrado.');
define('_MI_MYDOWNLOADS_GLOBAL_FILEBROKEN_NOTIFYDSC', 'Receber notificação quando qualquer relatório de arquivo quebrado for apresentado.');
define('_MI_MYDOWNLOADS_GLOBAL_FILEBROKEN_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} Notificação Automática: Relatos sobre arquivo Quebrado');

define('_MI_MYDOWNLOADS_GLOBAL_FILESUBMIT_NOTIFY', 'Arquivo Enviado');
define('_MI_MYDOWNLOADS_GLOBAL_FILESUBMIT_NOTIFYCAP', 'Avise-me quando um novo arquivo for enviado (aguardando aprovação).');
define('_MI_MYDOWNLOADS_GLOBAL_FILESUBMIT_NOTIFYDSC', 'Receber notificação quando um novo arquivo for apresentado  (aguardando aprovação).');
define('_MI_MYDOWNLOADS_GLOBAL_FILESUBMIT_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} Notificação Automática: Novo arquivo apresentado');

define('_MI_MYDOWNLOADS_GLOBAL_NEWFILE_NOTIFY', 'Novo Arquivo');
define('_MI_MYDOWNLOADS_GLOBAL_NEWFILE_NOTIFYCAP', 'Avise-me quando qualquer novo arquivo for publicado.');
define('_MI_MYDOWNLOADS_GLOBAL_NEWFILE_NOTIFYDSC', 'Receber notificação quando qualquer novo arquivo for publicado.');
define('_MI_MYDOWNLOADS_GLOBAL_NEWFILE_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} Notificação Automática: Novo Arquivo');

define('_MI_MYDOWNLOADS_CATEGORY_FILESUBMIT_NOTIFY', 'Arquivo Enviado');
define('_MI_MYDOWNLOADS_CATEGORY_FILESUBMIT_NOTIFYCAP', 'Avise-me quando for apresentado um novo arquivo (aguardando aprovação) nesta categoria.');
define('_MI_MYDOWNLOADS_CATEGORY_FILESUBMIT_NOTIFYDSC', 'Receber notificação quando um novo arquivo for apresentado (e aguarda aprovação) para a categoria atual.');
define('_MI_MYDOWNLOADS_CATEGORY_FILESUBMIT_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} Notificação Automática: Novo arquivo apresentado nesta categoria');

define('_MI_MYDOWNLOADS_CATEGORY_NEWFILE_NOTIFY', 'Novo Arquivo');
define('_MI_MYDOWNLOADS_CATEGORY_NEWFILE_NOTIFYCAP', 'Avise-me quando um novo arquivo for publicado nesta categoria.');
define('_MI_MYDOWNLOADS_CATEGORY_NEWFILE_NOTIFYDSC', 'Receber notificação quando um novo arquivo for publicado categoria atual.');
define('_MI_MYDOWNLOADS_CATEGORY_NEWFILE_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} Notificação Automática: Novo arquivo na categoria');

define('_MI_MYDOWNLOADS_FILE_APPROVE_NOTIFY', 'Arquivo Aprovado');
define('_MI_MYDOWNLOADS_FILE_APPROVE_NOTIFYCAP', 'Avise-me quando este arquivo for aprovado.');
define('_MI_MYDOWNLOADS_FILE_APPROVE_NOTIFYDSC', 'Receber notificação quando este arquivo for aprovado.');
define('_MI_MYDOWNLOADS_FILE_APPROVE_NOTIFYSBJ', '[{X_SITENAME}] {X_MODULE} Notificação Automática: Arquivo Aprovado');

// ajout Hervé
define('_MI_MYDOWNLOADS_MIMETYPE',"Tipos Mime");
define('_MI_MYDOWNLOADS_MIMETYPE_DSC',"Digite os tipos mime autorizados separados por um |");
define('_MI_MYDOWNLOADS_MAXUPLOAD_SIZE',"Tamanho Máximo para carregar o arquivo");
define('_MI_MYDOWNLOADS_USE_EDITOR',"Usar Kiovi?");
define('_MI_MYDOWNLOADS_AUTO_SUMMARY',"Resumo Automático ?");

// Added in v1.4
define('_MI_MYDOWNLOADS_UPLOAD_FOLDER',"Selecionar pasta de upload (O CAMINHO)");
define('_MI_MYDOWNLOADS_UPLOAD_URL',"Selecione a URL correspondente");
define('_MI_MYDOWNLOADS_RENAME_FILES',"Renomear arquivo ao fazer o upload ?");

// Added in v1.44
define('_MI_MYDOWNLOADS_SHOW_UPDATED',"Mostrar a 'atualização' e uma Imagem de 'novo' ?");

// Added in v1.45
define("_MI_MYDOWNLOADS_FORM_OPTIONS","Opções do Formulário");
define("_MI_MYDOWNLOADS_FORM_COMPACT","Compacto");
define("_MI_MYDOWNLOADS_FORM_DHTML","DHTML");
define("_MI_MYDOWNLOADS_FORM_SPAW","Editor Spaw");
define("_MI_MYDOWNLOADS_FORM_HTMLAREA","Editor HtmlArea");
define("_MI_MYDOWNLOADS_FORM_FCK","Editor FCK");
define("_MI_MYDOWNLOADS_FORM_KOIVI","Editor Koivi");
define("_MI_MYDOWNLOADS_FORM_TINYEDITOR","TinyEditor");
define("_MI_MYDOWNLOADS_ADMENU1", "Principal");

define('_MI_MYDL_SHOTSUPLOAD_FOLDER',"Selecione a pasta de upload (o caminho) para ScreenShots (sem barra no final)");
define('_MI_MYDL_SHOTSUPLOAD_URL',"Selecione a URL correspondente do ScreenShots (sem barra)");
define("_MI_MYDOWNLOADS_PLATFORM", "Plataforma");

// Added in version 1.5
define("_MI_MYDOWNLOADS_PAGER", "Usar página de índice do módulo na principal ?"); //Tenho dúvidas aqui...Giba
define("_MI_MYDOWNLOADS_ADMENU6", "Permissões");
?>