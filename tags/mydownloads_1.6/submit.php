<?php
// $Id: submit.php,v 1.15 2004/12/26 19:11:56 onokazu Exp $
//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <http://www.xoops.org/>                             //
// ------------------------------------------------------------------------- //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  You may not change or alter any portion of this comment or credits       //
//  of supporting developers from this source code or any supporting         //
//  source code which is considered copyrighted (c) material of the          //
//  original comment or credit authors.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
//  ------------------------------------------------------------------------ //

include 'header.php';
include_once XOOPS_ROOT_PATH.'/class/xoopstree.php';
include_once XOOPS_ROOT_PATH.'/class/module.errorhandler.php';
include_once XOOPS_ROOT_PATH.'/include/xoopscodes.php';
include_once XOOPS_ROOT_PATH.'/class/uploader.php';

$myts =& MyTextSanitizer::getInstance(); // MyTextSanitizer object
$eh = new ErrorHandler; //ErrorHandler object
$mytree = new XoopsTree($xoopsDB->prefix('mydownloads_cat'), 'cid', 'pid');
$categories = mydownloads_MygetItemIds('mydownloads_submit');

if (empty($xoopsUser) && !$xoopsModuleConfig['anonpost']) {
	redirect_header(XOOPS_URL.'/user.php',2,_MD_MUSTREGFIRST);
	exit();
}

if (!empty($_POST['submit'])) {

	$submitter = !empty($xoopsUser) ? $xoopsUser->getVar('uid') : 0;

	// Check if Title exist
	if ($_POST['title']=='') {
		$eh->show('1001');
	}
	// Check if URL exist
	if ( isset($_POST['url']) || ($_POST['url']!='')) {
		$url = $_POST['url'];
	} else {
		$url='';
	}
/*
	if ($url=='') {
		$eh->show('1016');
	}
	// Check if HomePage exist
	if ($_POST['homepage']=='') {
		$eh->show('1017');
	}
*/
	// Check if Description exist
	if ($_POST['description']=='') {
		$eh->show('1008');
	}

	$notify = !empty($_POST['notify']) ? 1 : 0;

	if ( !empty($_POST['cid']) ) {
		$cid = intval($_POST['cid']);
	} else {
		$cid = 0;
	}
	if(!in_array($cid, $categories)) {
		redirect_header(XOOPS_URL, 2, _NOPERM);
		exit();
	}

	$logourl = isset($_POST['logourl']) ? $myts->addSlashes($_POST['logourl']) : '';
	$url = $myts->addSlashes(formatURL($url));
	$title = $myts->addSlashes($_POST['title']);
	$homepage = isset($_POST['homepage']) ? $myts->addSlashes($_POST['homepage']) : '';
	$version = isset($_POST['version']) ? $myts->addSlashes($_POST['version']) : '';
	$size = isset($_POST['size']) ? intval($_POST['size']) : '';
	$platform = isset($_POST['platform']) ? $myts->addSlashes($_POST['platform']) : '';
	$description = $myts->addSlashes($_POST['description']);
	$date = time();
	$newid = $xoopsDB->genId($xoopsDB->prefix('mydownloads_downloads').'_lid_seq');

	if ( $xoopsModuleConfig['autoapprove'] == 1 ) {
		$status = $xoopsModuleConfig['autoapprove'];
	} else {
		$status = 0;
	}

	// ********************************************************************************************************************
	if(isset($_POST['xoops_upload_file'])) {
		$fldname = $_FILES[$_POST['xoops_upload_file'][0]];
		$fldname = (get_magic_quotes_gpc()) ? stripslashes($fldname['name']) : $fldname['name'];
		if(xoops_trim($fldname!='')) {
			$destname = mydownloads_createUploadName($xoopsModuleConfig['uploadfolderpath'],$fldname);
			$tbl_tmp = @split('|',$xoopsModuleConfig['mimetype']);
			$permittedtypes = @array_walk($tbl_tmp,'trim');
			$uploader = new XoopsMediaUploader( $xoopsModuleConfig['uploadfolderpath'], $tbl_tmp, $xoopsModuleConfig['maxuploadsize']);
			$uploader->setTargetFileName($destname);
			if ($uploader->fetchMedia($_POST['xoops_upload_file'][0])) {
				if ($uploader->upload()) {
					$url = $xoopsModuleConfig['uploadfolderurl'].'/'.$destname;
				} else {
					echo _MD_UPLOAD_ERROR. ' ' . $uploader->getErrors();
				}
			} else {
				echo $uploader->getErrors();
			}
		}
	}
	// ********************************************************************************************************************

	$sql = sprintf("INSERT INTO %s (lid, cid, title, url, homepage, version, size, platform, logourl, submitter, status, date, hits, rating, votes, comments) VALUES (%u, %u, '%s', '%s', '%s', '%s', %u, '%s', '%s', %u, %u, %u, %u, %u, %u, %u)", $xoopsDB->prefix('mydownloads_downloads'), $newid, $cid, $title, $url, $homepage, $version, $size, $platform, $logourl, $submitter, $status, $date, 0, 0, 0, 0);
	$xoopsDB->query($sql) or $eh->show('0013');
	if($newid == 0){
		$newid = $xoopsDB->getInsertId();
	}
	$sql = sprintf("INSERT INTO %s (lid, description) VALUES (%u, '%s')", $xoopsDB->prefix('mydownloads_text'), $newid, $description);
	$xoopsDB->query($sql) or $eh->show('0013');
	// Notify of new link (anywhere) and new link in category
	$notification_handler =& xoops_gethandler('notification');
	$tags = array();
	$tags['FILE_NAME'] = $title;
	$tags['FILE_URL'] = XOOPS_URL . '/modules/' . $xoopsModule->getVar('dirname') . '/singlefile.php?cid=' . $cid . '&lid=' . $newid;
	$sql = 'SELECT title FROM ' . $xoopsDB->prefix('mydownloads_cat') . ' WHERE cid=' . $cid;
	$result = $xoopsDB->query($sql);
	$row = $xoopsDB->fetchArray($result);
	$tags['CATEGORY_NAME'] = $row['title'];
	$tags['CATEGORY_URL'] = XOOPS_URL . '/modules/' . $xoopsModule->getVar('dirname') . '/viewcat.php?cid=' . $cid;
	if ( $xoopsModuleConfig['autoapprove'] == 1 ) {
		$notification_handler->triggerEvent('global', 0, 'new_file', $tags);
		$notification_handler->triggerEvent('category', $cid, 'new_file', $tags);
		redirect_header('index.php',2,_MD_RECEIVED.'<br />'._MD_ISAPPROVED.'');
		exit;
	} else {
		$tags['WAITINGFILES_URL'] = XOOPS_URL . '/modules/' . $xoopsModule->getVar('dirname') . '/admin/index.php?op=listNewDownloads';
		$notification_handler->triggerEvent('global', 0, 'file_submit', $tags);
		$notification_handler->triggerEvent('category', $cid, 'file_submit', $tags);
		if ($notify) {
			include_once XOOPS_ROOT_PATH . '/include/notification_constants.php';
			$notification_handler->subscribe('file', $newid, 'approve', XOOPS_NOTIFICATION_MODE_SENDONCETHENDELETE);
		}
		redirect_header('index.php',4,_MD_RECEIVED);
		exit;
	}
	exit();

} else {

	$xoopsOption['template_main'] = 'mydownloads_submit.html';
	include XOOPS_ROOT_PATH.'/header.php';
/*
	ob_start();
	xoopsCodeTarea('message',37,8);
	$xoopsTpl->assign('xoops_codes', ob_get_contents());
	ob_end_clean();
	ob_start();
	xoopsSmilies('message');
	$xoopsTpl->assign('xoops_smilies', ob_get_contents());
	ob_end_clean();
*/
	$xoopsTpl->assign('module_name', $xoopsModule->getVar('name'));
	$xoopsTpl->assign('notify_show', !empty($xoopsUser) && !$xoopsModuleConfig['autoapprove'] ? 1 : 0);
	$xoopsTpl->assign('lang_submitonce', _MD_SUBMITONCE);
	$xoopsTpl->assign('lang_submitcath', _MD_SUBMITCATHEAD);
	$xoopsTpl->assign('lang_allpending', _MD_ALLPENDING);
	$xoopsTpl->assign('lang_dontabuse', _MD_DONTABUSE);
	$xoopsTpl->assign('lang_wetakeshot', _MD_TAKEDAYS);
	$xoopsTpl->assign('lang_category', _MD_CATEGORYC);
	$xoopsTpl->assign('lang_sitetitle', _MD_FILETITLE);
	$xoopsTpl->assign('lang_siteurl', _MD_DLURL);
	$xoopsTpl->assign('lang_category', _MD_CATEGORYC);
	$xoopsTpl->assign('lang_homepage', _MD_HOMEPAGEC);
	$xoopsTpl->assign('lang_version', _MD_VERSIONC);
	$xoopsTpl->assign('lang_size', _MD_FILESIZEC);
	$xoopsTpl->assign('lang_bytes', _MD_BYTES);
	$xoopsTpl->assign('lang_platform', _MD_PLATFORMC);
	$xoopsTpl->assign('lang_options', _MD_OPTIONS);
	$xoopsTpl->assign('lang_notify', _MD_NOTIFYAPPROVE);
	$xoopsTpl->assign('lang_description', _MD_DESCRIPTION);
	$xoopsTpl->assign('lang_submit', _SUBMIT);
	$xoopsTpl->assign('lang_cancel', _CANCEL);
	ob_start();
	$mytree->makeMySelBox('title', 'title', 0, 1);
	$selbox = ob_get_contents();
	ob_end_clean();
	$xoopsTpl->assign('category_selbox', $selbox);

	// Saisie avec formulaire "standard"
	include_once XOOPS_ROOT_PATH.'/class/xoopsformloader.php';
	include_once XOOPS_ROOT_PATH.'/modules/mydownloads/include/functions.php';

		$sform = new XoopsThemeForm(_MD_ADDNEWFILE, 'filefom', 'submit.php', 'post');
		$sform->setExtra('enctype="multipart/form-data"');
		$sform->addElement(new XoopsFormText(_MD_FILETITLE,'title',50,512,''),true);
		$sform->addElement(new XoopsFormText(_MD_DLURL,'url',50,255,'http://'),false);
		$sform->addElement(new XoopsFormFile(_MD_UPLOAD_FILE, 'attachedfile', $xoopsModuleConfig['maxuploadsize']), false);

		$categoryselect = new XoopsFormSelect(_MD_CATEGORYC, 'cid');
		$tbl = array();
		$tbl = $mytree->getChildTreeArray(0,'title');
		foreach($tbl as $oneline) {
			if($oneline['prefix']=='.') {
				$oneline['prefix']='';
			}
			$oneline['prefix'] = str_replace('.','-',$oneline['prefix']);
			if(in_array($oneline['cid'], $categories)) {
				$categoryselect->addOption($oneline['cid'], $oneline['prefix'].' '.$oneline['title']);
			}
		}
		$sform->addElement($categoryselect,true);
		$sform->addElement(new XoopsFormText(_MD_HOMEPAGEC,'homepage',50,255,''),false);
		$sform->addElement(new XoopsFormText(_MD_VERSIONC,'version',10,255,''),false);
		$sform->addElement(new XoopsFormText(_MD_FILESIZEC.' ('._MD_BYTES.')','size',10,100,''),false);

		// Plateforme *************************************************************************
		$sform->addElement(new XoopsFormText(_MD_PLATFORMC,'platform',45,255,''),false);
		// ************************************************************************************

		$editor = mydownloads_getWysiwygForm(_MD_DESCRIPTIONC,'description', '', '100%', '300px', 'description_hidden');
		if($editor) {
			$sform->addElement($editor, true);
		}
		$sform->addElement(new XoopsFormHidden('op', 'addDownload'), false);
		// Screenshot
		$shot_tray = new XoopsFormElementTray(_MD_SHOTIMAGE ,'');
		$shotselect = new XoopsFormSelect('', 'logourl');
		$tbl = array();
		$shotselect->addOption(' ','------');
		$downimg_array = XoopsLists::getImgListAsArray($xoopsModuleConfig['shotsuploadfolderpath']);
		foreach($downimg_array as $image){
			$shotselect->addOption($image,$image);
		}
		$shot_tray->addElement($shotselect);
		$directory = $xoopsModuleConfig['shotsuploadfolderurl'];
		$shot_tray->addElement(new XoopsFormLabel('<br />'.sprintf(_MD_MUSTBEVALID,$directory)), false);
		$sform->addElement($shot_tray,false);
		// Submit button
		$button_tray = new XoopsFormElementTray('' ,'');
		$submit_btn = new XoopsFormButton('', 'submit', _MD_ADD, 'submit');
		$button_tray->addElement($submit_btn);
		$sform->addElement($button_tray);
		$xoopsTpl->assign('themeForm', $sform->render());
		unset($sform, $button_tray);

	// Hack made by Hervé Thouzard (http://www.herve-thouzard.com)
	mydownloads_create_page_title(_MD_SUBMITCATHEAD);
	mydownloads_create_meta_description($xoopsModule->name().' - '._MD_SUBMITCATHEAD);
	// End Hack
	include XOOPS_ROOT_PATH.'/footer.php';
}
?>
