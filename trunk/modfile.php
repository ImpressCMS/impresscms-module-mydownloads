<?php
// $Id: modfile.php,v 1.11 2004/12/26 19:11:55 onokazu Exp $
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

include "header.php";
include_once ICMS_ROOT_PATH."/class/xoopstree.php";
include_once ICMS_ROOT_PATH."/class/module.errorhandler.php";
$myts =& MyTextSanitizer::getInstance(); // MyTextSanitizer object
$mytree = new XoopsTree($xoopsDB->prefix('mydownloads_cat'), 'cid', 'pid');
$categories = mydownloads_MygetItemIds();

if(isset($_POST['submit'])) {
	$eh = new ErrorHandler; //ErrorHandler object
	if(empty($xoopsUser)){
		redirect_header(ICMS_URL."/user.php",2,_MD_MUSTREGFIRST);
		exit();
	} else {
		$ratinguser = $xoopsUser->getVar('uid');
	}
	$submit_vars = array('lid', 'title', 'url', 'homepage', 'description', 'logourl', 'cid', 'version', 'size', 'platform');
	foreach($submit_vars as $submit_key) {
		$$submit_key = $_POST[$submit_key];
	}
	$lid = intval($lid);

	// Check if Title exist
	if (trim($title)=="") {
		$eh->show("1001");
	}
	// Check if URL exist
	if (trim($url)=="") {
		$eh->show("1016");
	}
	// Check if HOMEPAGE exist
	if (trim($homepage)=="") {
		$eh->show("1016");
	}
	// Check if Description exist
	if (trim($description)=="") {
		$eh->show("1008");
	}

	$result = $xoopsDB->query('SELECT cid FROM '.$xoopsDB->prefix('mydownloads_downloads').' WHERE lid='.$lid);
	if($result) {
		$myrow = $xoopsDB->fetchArray($result);
		if(!in_array($myrow['cid'], $categories)) {
			redirect_header(ICMS_URL, 2, _NOPERM);
			exit();
		}
	} else {
		exit();
	}


	$url = $myts->addSlashes($url);
	$logourl = $myts->addSlashes($logourl);
	$cid = intval($cid);
	$title = $myts->addSlashes($title);
	$homepage = $myts->addSlashes($homepage);
	$version = $myts->addSlashes($version);
	$size = $myts->addSlashes($size);
	$platform = $myts->addSlashes($platform);
	$description = $myts->addSlashes($description);
	$newid = $xoopsDB->genId($xoopsDB->prefix("mydownloads_mod")."_requestid_seq");

	$sql = sprintf("INSERT INTO %s (requestid, lid, cid, title, url, homepage, version, size, platform, logourl, description, modifysubmitter) VALUES (%u, %u, %u, '%s', '%s', '%s', '%s', %u, '%s', '%s', '%s', %u)", $xoopsDB->prefix("mydownloads_mod"), $newid, $lid, $cid, $title, $url, $homepage, $version, $size, $platform, $logourl, $description, $ratinguser);
	$xoopsDB->query($sql) or $eh->show("0013");
	$tags = array();
	$tags['MODIFYREPORTS_URL'] = ICMS_URL . '/modules/' . $icmsModule->getVar('dirname') . '/admin/index.php?op=listModReq';
	$notification_handler =& xoops_gethandler('notification');
	$notification_handler->triggerEvent('global', 0, 'file_modify', $tags);
	redirect_header("index.php",2,_MD_THANKSFORINFO);
	exit();

} else {
	$lid = intval($_GET['lid']);
	if(empty($xoopsUser)){
		redirect_header(ICMS_URL."/user.php",2,_MD_MUSTREGFIRST);
		exit();
	}
	$xoopsOption['template_main'] = 'mydownloads_modfile.html';
	include ICMS_ROOT_PATH."/header.php";

	// Hack made by Herv� Thouzard (http://www.herve-thouzard.com)
	//$sql="SELECT l.*, t.description FROM ".$xoopsDB->prefix("mydownloads_downloads")." l, ".$xoopsDB->prefix("mydownloads_text")." t WHERE l.lid=$lid and l.lid=t.lid AND l.status>0";

	$result = $xoopsDB->query("SELECT l.cid, l.title, l.url, l.homepage, l.version, l.size, l.platform, l.logourl, l.rating, l.date, l.hits, t.description FROM ".$xoopsDB->prefix("mydownloads_downloads")." l, ".$xoopsDB->prefix("mydownloads_text")." t WHERE l.lid=".$lid." and l.lid=t.lid AND l.status>0");
	list($cid, $title, $url, $homepage, $version, $size, $platform, $logourl, $rating, $time, $hits, $description) = $xoopsDB->fetchRow($result);
	if(!in_array($cid, $categories)) {
		redirect_header(ICMS_URL, 2, _NOPERM);
		exit();
	}

	mydownloads_create_page_title($title, _MD_REQUESTMOD);
	mydownloads_create_meta_keywords($description);
	mydownloads_create_meta_description($title.' - '._MD_REQUESTMOD);
	// End Hack
	$xoopsTpl->assign('module_name', $icmsModule->getVar('name'));
	$xoopsTpl->assign('lang_requestmod', _MD_REQUESTMOD);
	$title = $myts->htmlSpecialChars($title);
	$url = $myts->htmlSpecialChars($url);
	$homepage = $myts->htmlSpecialChars($homepage);
	$version = $myts->htmlSpecialChars($version);
	$size = $myts->htmlSpecialChars($size);
	$platform = $myts->htmlSpecialChars($platform);
	$logourl = $myts->htmlSpecialChars($logourl);
	$result2 = $xoopsDB->query("SELECT description FROM ".$xoopsDB->prefix("mydownloads_text")." WHERE lid=$lid");
	list($description)=$xoopsDB->fetchRow($result2);
	$description = $myts->htmlSpecialChars($description);
	$xoopsTpl->assign('file', array('id' => $lid, 'rating' => number_format($rating, 2), 'title' => $title, 'url' => $url, 'logourl' => $logourl, 'updated' => formatTimestamp($time,"m"), 'description' => $description, 'hits' => $hits,'plataform' => $platform,'size'  => $size,'homepage' => $homepage,'version'  => $version,));
	$xoopsTpl->assign('lang_fileid', _MD_FILEID);
	$xoopsTpl->assign('lang_sitetitle', _MD_FILETITLE);
	$xoopsTpl->assign('lang_siteurl', _MD_DLURL);
	$xoopsTpl->assign('lang_category', _MD_CATEGORYC);
	$xoopsTpl->assign('lang_homepage', _MD_HOMEPAGEC);
	$xoopsTpl->assign('lang_version', _MD_VERSIONC);
	$xoopsTpl->assign('lang_size', _MD_FILESIZEC);
	$xoopsTpl->assign('lang_bytes', _MD_BYTES);
	$xoopsTpl->assign('lang_platform', _MD_PLATFORMC);
	ob_start();
	$mytree->makeMySelBox("title", "title", $cid);
	$selbox = ob_get_contents();
	ob_end_clean();
	$xoopsTpl->assign('category_selbox', $selbox);
	$xoopsTpl->assign('lang_description', _MD_DESCRIPTIONC);
	$xoopsTpl->assign('modifysubmitter', $xoopsUser->getVar('uid'));
	$xoopsTpl->assign('lang_sendrequest', _MD_SENDREQUEST);
	$xoopsTpl->assign('lang_cancel', _CANCEL);
	include ICMS_ROOT_PATH.'/footer.php';
}
?>
