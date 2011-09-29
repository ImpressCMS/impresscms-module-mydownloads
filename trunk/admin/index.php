<?php
// $Id: index.php,v 1.18 2004/12/26 19:11:55 onokazu Exp $
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

include '../../../include/cp_header.php';
if (file_exists(ICMS_ROOT_PATH . '/modules/mydownloads/language/' . $icmsConfig['language'] . '/main.php' ) )
{
	include_once ICMS_ROOT_PATH . '/modules/mydownloads/language/' . $icmsConfig['language'] . '/main.php';
}
else
{
	include_once ICMS_ROOT_PATH . '/modules/mydownloads/language/english/main.php';
}
include '../include/functions.php';
include_once ICMS_ROOT_PATH.'/class/xoopstree.php';
include_once ICMS_ROOT_PATH.'/class/xoopslists.php';
include_once ICMS_ROOT_PATH.'/include/xoopscodes.php';
include_once ICMS_ROOT_PATH.'/class/module.errorhandler.php';
include_once ICMS_ROOT_PATH.'/class/uploader.php';
include_once ICMS_ROOT_PATH.'/modules/mydownloads/class/xoopstree.php';
require_once 'functions.php';
include_once ICMS_ROOT_PATH.'/class/xoopsformloader.php';

$myts =& MyTextSanitizer::getInstance();
$eh = new ErrorHandler;
$mytree = new XoopsTree($xoopsDB->prefix('mydownloads_cat'),'cid','pid');

function mydownloads()
{
	global $xoopsDB, $icmsModule;
	xoops_cp_header();
	mydnl_adminMenu(1);
	echo '<h4>'._MD_DLCONF.'</h4>';
	echo "<table width='100%' border='0' cellspacing='1' class='outer'><tr class=\"odd\"><td>";
	// Temporarily 'homeless' downloads (to be revised in index.php breakup)
	$result = $xoopsDB->query('SELECT COUNT(*) FROM '.$xoopsDB->prefix('mydownloads_broken').'');
	list($totalbrokendownloads) = $xoopsDB->fetchRow($result);
	if($totalbrokendownloads>0){
		$totalbrokendownloads = "<span style='color: #ff0000; font-weight: bold'>$totalbrokendownloads</span>";
	}
	$result2 = $xoopsDB->query('SELECT COUNT(*) FROM '.$xoopsDB->prefix('mydownloads_mod').'');
	list($totalmodrequests) = $xoopsDB->fetchRow($result2);
	if($totalmodrequests>0){
		$totalmodrequests = "<span style='color: #ff0000; font-weight: bold'>$totalmodrequests</span>";
	}
	$result3 = $xoopsDB->query('SELECT COUNT(*) FROM '.$xoopsDB->prefix('mydownloads_downloads').' WHERE status=0');
	list($totalnewdownloads) = $xoopsDB->fetchRow($result3);
	if($totalnewdownloads>0){
		$totalnewdownloads = "<span style='color: #ff0000; font-weight: bold'>$totalnewdownloads</span>";
	}
	echo " - <a href='".ICMS_URL."/modules/system/admin.php?fct=preferences&amp;op=showmod&amp;mod=".$icmsModule->getVar('mid')."'>"._MD_GENERALSET."</a>";
	echo "<br /><br />";
	echo " - <a href=index.php?op=downloadsConfigMenu>"._MD_ADDMODDELETE."</a>";
	echo "<br /><br />";
	echo " - <a href=index.php?op=listNewDownloads>"._MD_DLSWAITING." ($totalnewdownloads)</a>";
	echo "<br /><br />";
	echo " - <a href=index.php?op=listBrokenDownloads>"._MD_BROKENREPORTS." ($totalbrokendownloads)</a>";
	echo "<br /><br />";
	echo " - <a href=index.php?op=listModReq>"._MD_MODREQUESTS." ($totalmodrequests)</a>";
	$result=$xoopsDB->query("SELECT COUNT(*) FROM ".$xoopsDB->prefix("mydownloads_downloads")." WHERE status>0");
	list($numrows) = $xoopsDB->fetchRow($result);
	echo "<br /><br /><div>";
	printf(_MD_THEREARE,$numrows);	echo "</div>";
	echo"</td></tr></table>";
}

function listNewDownloads()
{
	global $xoopsDB, $myts, $eh, $mytree, $icmsModuleConfig, $icmsModule;
	// List downloads waiting for validation
	$downimg_array = XoopsLists::getImgListAsArray($icmsModuleConfig['shotsuploadfolderpath']);
	$result = $xoopsDB->query("SELECT lid, cid, title, url, homepage, version, size, platform, logourl, submitter FROM ".$xoopsDB->prefix("mydownloads_downloads")." where status=0 ORDER BY date DESC");
	$numrows = $xoopsDB->getRowsNum($result);
	xoops_cp_header();
	mydnl_adminMenu(3);
	echo "<h4>"._MD_DLCONF."</h4>";
	echo "<h4>"._MD_DLSWAITING."&nbsp;($numrows)</h4><br />";
	if ($numrows>0) {
		while(list($lid, $cid, $title, $url, $homepage, $version, $size, $platform, $logourl, $uid) = $xoopsDB->fetchRow($result)) {
			$result2 = $xoopsDB->query("SELECT description FROM ".$xoopsDB->prefix("mydownloads_text")." WHERE lid=$lid");
			list($description) = $xoopsDB->fetchRow($result2);
			$title = $myts->htmlSpecialChars($title);
			$url = $myts->htmlSpecialChars($url);
			$homepage = $myts->htmlSpecialChars($homepage);
			$version = $myts->htmlSpecialChars($version);
			$size = $myts->htmlSpecialChars($size);
			$platform = $myts->htmlSpecialChars($platform);
			$description = $myts->htmlSpecialChars($description);
			$submitter = XoopsUser::getUnameFromId($uid);

			// **************************************************************************************************
			include_once ICMS_ROOT_PATH."/class/xoopsformloader.php";
			$sform = new XoopsThemeForm(_MD_MODDL, "filefom", ICMS_URL.'/modules/'.$icmsModule->getVar('dirname').'/admin/index.php', 'post');
			//$sform->setExtra('enctype="multipart/form-data"');
			$sform->addElement(new XoopsFormLabel(_MD_SUBMITTER,"<a href=\"".ICMS_URL."/userinfo.php?uid=".$uid."\">$submitter</a>"),false);
			$sform->addElement(new XoopsFormLabel(_MD_FILEID,$lid),false);
			$sform->addElement(new XoopsFormText(_MD_FILETITLE,'title',50,512,$title),true);
			$sform->addElement(new XoopsFormText(_MD_DLURL,'url',50,255,$url),false);
			$sform->addElement(new XoopsFormLabel(_MD_DOWNLOAD,"<a href=\"$url\">"._MD_DOWNLOAD."</a>"),false);
			//$sform->addElement(new XoopsFormFile(_MD_UPLOAD_FILE, 'attachedfile', $icmsModuleConfig['maxuploadsize']), false);

			$categoryselect = new XoopsFormSelect(_MD_CATEGORYC, 'cid', $cid);
			$tbl = array();
			$tbl = $mytree->getChildTreeArray(0,'title');
			foreach($tbl as $oneline) {
				if($oneline['prefix']=='.') {
					$oneline['prefix']='';
				}
				$oneline['prefix'] = str_replace('.','-',$oneline['prefix']);
				$categoryselect->addOption($oneline['cid'], $oneline['prefix'].' '.$oneline['title']);
			}
			$sform->addElement($categoryselect,true);
			$sform->addElement(new XoopsFormText(_MD_HOMEPAGEC,'homepage',50,255,$homepage),false);
			$sform->addElement(new XoopsFormText(_MD_VERSIONC,'version',10,255,$version),false);
			$sform->addElement(new XoopsFormText(_MD_FILESIZEC.' ('._MD_BYTES.')','size',10,80,$size),false);

			// Plateforme *************************************************************************
			$sform->addElement(new XoopsFormText(_MD_PLATFORMC,'platform',50,255,$platform),false);
			// ************************************************************************************

			$editor = mydownloads_getWysiwygForm(_MD_DESCRIPTIONC,'description', $description, '100%', '300px', 'description_hidden');
			if($editor) {
				$sform->addElement($editor, true);
			}
			$sform->addElement(new XoopsFormHidden('op', 'modDownloadS'), false);
			$sform->addElement(new XoopsFormHidden('lid', $lid), false);
			// Screenshot
			$shot_tray = new XoopsFormElementTray(_MD_SHOTIMAGE ,'');
			$shotselect = new XoopsFormSelect('', 'logourl',$logourl);
			$shotselect->addOption(' ','------');
			foreach($downimg_array as $image){
				$shotselect->addOption($image,$image);
			}
			$shot_tray->addElement($shotselect);
			$directory = $icmsModuleConfig['shotsuploadfolderurl'];
			$shot_tray->addElement(new XoopsFormLabel('<br />'.sprintf(_MD_MUSTBEVALID,$directory)), false);
			$sform->addElement($shot_tray,false);
			// Submit button
			$button_tray = new XoopsFormElementTray('' ,'');
			$submit_btn = new XoopsFormButton('', 'post', _MD_APPROVE, 'submit');
			$button_tray->addElement($submit_btn);
			$sform->addElement($button_tray);
			$sform->display();
			echo myTextForm("index.php?op=delNewDownload&lid=$lid",_MD_DELETE);
			// **************************************************************************************************
			echo "<br /><br />";
		}
	}else{
		echo _MD_NOSUBMITTED;
	}
	xoops_cp_footer();
}


function downloadsConfigMenu()
{
	global $xoopsDB, $myts, $eh, $icmsModule, $icmsModuleConfig;
	// Add a New Main Category
	xoops_cp_header();
	mydnl_adminMenu(2);

	$downimg_array = XoopsLists::getImgListAsArray($icmsModuleConfig['shotsuploadfolderpath']);
	echo '<h4>'._MD_DLCONF.'</h4>';

	$form = new XoopsThemeForm(_MD_ADDMAIN, 'addmaincateg', 'index.php', 'post');
	$form->setExtra('enctype="multipart/form-data"');
	$form->addElement(new XoopsFormText(_MD_TITLEC, 'title', 50, 255, ''), true);
	$form->addElement(new XoopsFormText(_MD_IMGURL, 'imgurl', 50, 255, 'http://'), false);
	$form->addElement(new XoopsFormFile(_MD_UPLOAD_FILE, 'attachedfile', $icmsModuleConfig['maxuploadsize']), false);
	$form->addElement(new XoopsFormHidden('cid', '0'), false);
	$form->addElement(new XoopsFormHidden('op', 'addCat'), false);

	$button_tray = new XoopsFormElementTray('' ,'');
	$submit_btn = new XoopsFormButton('', 'post', _MD_ADD, 'submit');
	$button_tray->addElement($submit_btn);
	$form->addElement($button_tray);
	$form->display();
	unset($button_tray, $form);

	// Add a New Sub-Category
	$result=$xoopsDB->query("SELECT COUNT(*) FROM ".$xoopsDB->prefix("mydownloads_cat")."");
	list($numrows)=$xoopsDB->fetchRow($result);
	if($numrows>0) {
		echo '<br />';
		$mytree = new mydlXoopsTree($xoopsDB->prefix('mydownloads_cat'),'cid','pid');
		$forms = new XoopsThemeForm(_MD_ADDSUB, 'addsubcateg', 'index.php', 'post');
		$forms->addElement(new XoopsFormText(_MD_TITLEC, 'title', 50, 255, ''), true);
		$forms->addElement(new XoopsFormLabel(_MD_IN, $mytree->mydl_makeMySelBox('title', 'title',0,1,'cid')));
		$forms->addElement(new XoopsFormHidden('op', 'addCat'), false);

		$button_tray = new XoopsFormElementTray('' ,'');
		$submit_btn = new XoopsFormButton('', 'post', _MD_ADD, 'submit');
		$button_tray->addElement($submit_btn);
		$forms->addElement($button_tray);
		$forms->display();
		unset($button_tray, $forms);

		echo '<br />';
		// If there is a category, add a New Download
		// **************************************************************************************************

		$sform = new XoopsThemeForm(_MD_ADDNEWFILE, 'filefom', ICMS_URL.'/modules/'.$icmsModule->getVar('dirname').'/admin/index.php', 'post');
		$sform->setExtra('enctype="multipart/form-data"');
		$sform->addElement(new XoopsFormText(_MD_FILETITLE,'title',50,255,''),true);
		$sform->addElement(new XoopsFormText(_MD_DLURL,'url',50,255,'http://'),false);
		$sform->addElement(new XoopsFormFile(_MD_UPLOAD_FILE, 'attachedfile', $icmsModuleConfig['maxuploadsize']), false);

		$categoryselect = new XoopsFormSelect(_MD_CATEGORYC, 'cid');
		$tbl = array();
		$tbl = $mytree->getChildTreeArray(0,'title');
		foreach($tbl as $oneline) {
			if($oneline['prefix']=='.') {
				$oneline['prefix']='';
			}
			$oneline['prefix'] = str_replace('.','-',$oneline['prefix']);
			$categoryselect->addOption($oneline['cid'], $oneline['prefix'].' '.$oneline['title']);
		}
		$sform->addElement($categoryselect,true);
		$sform->addElement(new XoopsFormText(_MD_HOMEPAGEC,'homepage',50,255,''),false);
		$sform->addElement(new XoopsFormText(_MD_VERSIONC,'version',10,255,''),false);
		$sform->addElement(new XoopsFormText(_MD_FILESIZEC.' ('._MD_BYTES.')','size',10,100,''),false);
		// Plateforme *************************************************************************
		$sform->addElement(new XoopsFormText(_MD_PLATFORMC,'platform',50,255,''),false);
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
		foreach($downimg_array as $image){
			$shotselect->addOption($image,$image);
		}
		$shot_tray->addElement($shotselect);
		$directory = $icmsModuleConfig['shotsuploadfolderurl'];
		$shot_tray->addElement(new XoopsFormLabel('<br />'.sprintf(_MD_MUSTBEVALID,$directory)), false);
		$sform->addElement($shot_tray,false);
		// Submit button
		$button_tray = new XoopsFormElementTray('' ,'');
		$submit_btn = new XoopsFormButton('', 'post', _MD_ADD, 'submit');
		$button_tray->addElement($submit_btn);
		$sform->addElement($button_tray);
		$sform->display();
		unset($sform, $button_tray);
		// **************************************************************************************************

		// Modify Category
		echo '<br />';
		$formm = new XoopsThemeForm(_MD_MODCAT, 'modcat', 'index.php', 'post');
		$formm->addElement(new XoopsFormLabel(_MD_CATEGORYC, $mytree->mydl_makeMySelBox('title', 'title',0,1,'cid')));
		$formm->addElement(new XoopsFormHidden('op', 'modCat'), false);
		$button_tray = new XoopsFormElementTray('' ,'');
		$submit_btn = new XoopsFormButton('', 'post', _MD_MODIFY, 'submit');
		$button_tray->addElement($submit_btn);
		$formm->addElement($button_tray);
		$formm->display();
		unset($button_tray, $formm);
		echo "<br />";
	}
	// Modify Download
	$result2 = $xoopsDB->query("SELECT COUNT(*) FROM ".$xoopsDB->prefix('mydownloads_downloads')."");
	list($numrows2) = $xoopsDB->fetchRow($result2);
	if ($numrows2>0) {
		echo '<br />';
		$formi = new XoopsThemeForm(_MD_MODDL, 'frmmodwnl', 'index.php', 'get');
		$formi->addElement(new XoopsFormText(_MD_FILEID, 'lid', 15, 15, ''), true);
		$formi->addElement(new XoopsFormHidden('op', 'modDownload'), false);
		$formi->addElement(new XoopsFormHidden('fct', 'mydownloads'), false);

		$button_tray = new XoopsFormElementTray('' ,'');
		$submit_btn = new XoopsFormButton('', 'post', _MD_MODIFY, 'submit');
		$button_tray->addElement($submit_btn);
		$formi->addElement($button_tray);
		$formi->display();
		unset($button_tray, $formi);
	}
	xoops_cp_footer();
}

function modDownload()
{
	global $xoopsDB,$myts, $eh, $mytree, $icmsModuleConfig, $icmsModule;
	$downimg_array = XoopsLists::getImgListAsArray($icmsModuleConfig['shotsuploadfolderpath']);
	$lid = intval($_GET['lid']);
	xoops_cp_header();
	mydnl_adminMenu(2);
	echo "<h4>"._MD_DLCONF."</h4>";
	$result = $xoopsDB->query("SELECT cid, title, url, homepage, version, size, platform, logourl FROM ".$xoopsDB->prefix("mydownloads_downloads")." WHERE lid=$lid") or $eh->show("0013");
	list($cid, $title, $url, $homepage, $version, $size, $platform, $logourl) = $xoopsDB->fetchRow($result);
	$title = $myts->htmlSpecialChars($title);
	$url = $myts->htmlSpecialChars($url);
	$homepage = $myts->htmlSpecialChars($homepage);
	$version = $myts->htmlSpecialChars($version);
	$size = $myts->htmlSpecialChars($size);
	$platform = $myts->htmlSpecialChars($platform);
	$logourl = $myts->htmlSpecialChars($logourl);
	$result2 = $xoopsDB->query("SELECT description FROM ".$xoopsDB->prefix("mydownloads_text")." WHERE lid=$lid");
	list($description)=$xoopsDB->fetchRow($result2);
	$GLOBALS['description'] = $myts->htmlSpecialChars($description);

	// **************************************************************************************************
	include_once ICMS_ROOT_PATH."/class/xoopsformloader.php";
	$sform = new XoopsThemeForm(_MD_MODDL, "filefom", ICMS_URL.'/modules/'.$icmsModule->getVar('dirname').'/admin/index.php', 'post');
	$sform->setExtra('enctype="multipart/form-data"');
	$sform->addElement(new XoopsFormLabel(_MD_FILEID,$lid),false);
	$sform->addElement(new XoopsFormText(_MD_FILETITLE,'title',50,255,$title),true);
	$sform->addElement(new XoopsFormText(_MD_DLURL,'url',50,255,$url),false);
	$sform->addElement(new XoopsFormFile(_MD_UPLOAD_FILE, 'attachedfile', $icmsModuleConfig['maxuploadsize']), false);

	$categoryselect = new XoopsFormSelect(_MD_CATEGORYC, 'cid', $cid);
	$tbl = array();
	$tbl = $mytree->getChildTreeArray(0,'title');
	foreach($tbl as $oneline) {
		if($oneline['prefix']=='.') {
			$oneline['prefix']='';
		}
		$oneline['prefix'] = str_replace('.','-',$oneline['prefix']);
		$categoryselect->addOption($oneline['cid'], $oneline['prefix'].' '.$oneline['title']);
	}
	$sform->addElement($categoryselect,true);
	$sform->addElement(new XoopsFormText(_MD_HOMEPAGEC,'homepage',50,255,$homepage),false);
	$sform->addElement(new XoopsFormText(_MD_VERSIONC,'version',50,255,$version),false);
	$sform->addElement(new XoopsFormText(_MD_FILESIZEC.' ('._MD_BYTES.')','size',10,100,$size),false);
	// Plateforme *************************************************************************
	$sform->addElement(new XoopsFormText(_MD_PLATFORMC,'platform',50,255,$platform),false);
	// ************************************************************************************

	$editor = mydownloads_getWysiwygForm(_MD_DESCRIPTIONC,'description', $description, '100%', '300px', 'description_hidden');
	if($editor) {
		$sform->addElement($editor, true);
	}
	$sform->addElement(new XoopsFormHidden('op', 'modDownloadS'), false);
	$sform->addElement(new XoopsFormHidden('lid', $lid), false);
	// Screenshot
	$shot_tray = new XoopsFormElementTray(_MD_SHOTIMAGE ,'');
	$shotselect = new XoopsFormSelect('', 'logourl',$logourl);
	$shotselect->addOption(' ','------');
	foreach($downimg_array as $image){
		$shotselect->addOption($image,$image);
	}
	$shot_tray->addElement($shotselect);
	$directory = $icmsModuleConfig['shotsuploadfolderurl'];
	$shot_tray->addElement(new XoopsFormLabel('<br />'.sprintf(_MD_MUSTBEVALID,$directory)), false);
	$sform->addElement($shot_tray,false);
	// Submit button
	$button_tray = new XoopsFormElementTray('' ,'');
	$submit_btn = new XoopsFormButton('', 'post', _MD_SUBMIT, 'submit');
	$button_tray->addElement($submit_btn);
	$sform->addElement($button_tray);
	$sform->display();
	// **************************************************************************************************

	echo myTextForm("index.php?op=delDownload&lid=".$lid , _MD_DELETE);
	echo myTextForm("index.php?op=downloadsConfigMenu", _MD_CANCEL);
	echo "<hr>";

	$result5=$xoopsDB->query("SELECT COUNT(*) FROM ".$xoopsDB->prefix("mydownloads_votedata")."");
	list($totalvotes) = $xoopsDB->getRowsNum($result5);
	echo "<table width=100%>\n";
	echo "<tr><td colspan=7><b>";
	printf(_MD_DLRATINGS,$totalvotes);
	echo "</b><br /><br /></td></tr>\n";
	// Show Registered Users Votes
	$result5=$xoopsDB->query("SELECT ratingid, ratinguser, rating, ratinghostname, ratingtimestamp FROM ".$xoopsDB->prefix("mydownloads_votedata")." WHERE lid = $lid AND ratinguser != 0 ORDER BY ratingtimestamp DESC");
	$votes = $xoopsDB->getRowsNum($result5);
	echo "<tr><td colspan='7'><br /><br /><b>";
	printf(_MD_REGUSERVOTES,$votes);
	echo "</b><br /><br /></td></tr>\n";
	echo "<tr><td><b>" ._MD_USER."  </b></td><td><b>" ._MD_IP."  </b></td><td><b>" ._MD_RATING."  </b></td><td><b>" ._MD_USERAVG."  </b></td><td><b>" ._MD_TOTALRATE."  </b></td><td><b>" ._MD_DATE."  </b></td><td align=\"center\"><b>" ._MD_DELETE."</b></td></tr>\n";
	if ($votes == 0){
		echo "<tr><td align=\"center\" colspan=\"7\">" ._MD_NOREGVOTES."<br /></td></tr>\n";
	}
	$x=0;
	$colorswitch="dddddd";
	while(list($ratingid, $ratinguser, $rating, $ratinghostname, $ratingtimestamp)=$xoopsDB->fetchRow($result5)) {
		$formatted_date = formatTimestamp($ratingtimestamp);
		//Individual user information
		$result2=$xoopsDB->query("SELECT rating FROM ".$xoopsDB->prefix("mydownloads_votedata")." WHERE ratinguser = $ratinguser");
		$uservotes = $xoopsDB->getRowsNum($result2);
		$useravgrating = 0;
		while(list($rating2) = $xoopsDB->fetchRow($result2)){
			$useravgrating = $useravgrating + $rating2;
		}
		$useravgrating = $useravgrating / $uservotes;
		$useravgrating = number_format($useravgrating, 1);
		$ratinguname = XoopsUser::getUnameFromId($ratinguser);
		echo "<tr><td bgcolor=\"$colorswitch\">$ratinguname</td><td bgcolor=\"$colorswitch\">$ratinghostname</td><td bgcolor=\"$colorswitch\">$rating</td><td bgcolor=\"$colorswitch\">$useravgrating</td><td bgcolor=\"$colorswitch\">$uservotes</td><td bgcolor=\"$colorswitch\">$formatted_date</td><td bgcolor=\"$colorswitch\" align=\"center\">";
		echo myTextForm("index.php?op=delVote&lid=$lid&rid=$ratingid" , "X");
		echo "</td></tr>\n";

		$x++;
		if ($colorswitch=="dddddd"){
			$colorswitch="ffffff";
		} else {
			$colorswitch="dddddd";
		}
	}

	// Show Unregistered Users Votes
	$result5=$xoopsDB->query("SELECT ratingid, rating, ratinghostname, ratingtimestamp FROM ".$xoopsDB->prefix("mydownloads_votedata")." WHERE lid = $lid AND ratinguser = 0 ORDER BY ratingtimestamp DESC");
	$votes = $xoopsDB->getRowsNum($result5);
	echo "<tr><td colspan=7><b><br /><br />";
	printf(_MD_ANONUSERVOTES,$votes);
	echo "</b><br /><br /></td></tr>\n";
	echo "<tr><td colspan=2><b>" ._MD_IP."  </b></td><td colspan=3><b>" ._MD_RATING."  </b></td><td><b>" ._MD_DATE."  </b></b></td><td align=\"center\"><b>" ._MD_DELETE."</b></td><br /></tr>";
	if ($votes == 0) {
		echo "<tr><td colspan=\"7\" align=\"center\">" ._MD_NOUNREGVOTES."<br /></td></tr>";
	}
	$x=0;
	$colorswitch="dddddd";
	while(list($ratingid, $rating, $ratinghostname, $ratingtimestamp)=$xoopsDB->fetchRow($result5)) {
		$formatted_date = formatTimestamp($ratingtimestamp);
		// echo "<td colspan=\"2\" bgcolor=\"$colorswitch\">$ratinghostname</td><td colspan=\"3\" bgcolor=\"$colorswitch\">$rating</td><td bgcolor=\"$colorswitch\">$formatted_date</td><td bgcolor=\"$colorswitch\" aling=\"center\"><b><a href=index.php?op=delVote&lid=$lid&rid=$ratingid>X</a></b></td></tr>";
		echo "<td colspan=\"2\" bgcolor=\"$colorswitch\">$ratinghostname</td><td colspan=\"3\" bgcolor=\"$colorswitch\">$rating</td><td bgcolor=\"$colorswitch\">$formatted_date</td><td bgcolor=\"$colorswitch\" align=\"center\">";
		//echo "<table><tr><td>\n";
		//align=\"center\"
		echo myTextForm("index.php?op=delVote&lid=$lid&rid=$ratingid" , "X");
		//echo "</td></tr></table>\n";

		echo "</td></tr>";

		$x++;
		if ($colorswitch=="dddddd") {
			$colorswitch="ffffff";
		} else {
			$colorswitch="dddddd";
		}
	}
	echo "<tr><td colspan=\"6\">&nbsp;<br /></td></tr>\n";
	echo "</table>\n";
	echo"</td></tr></table>";
	xoops_cp_footer();
}

function delVote()
{
	global $xoopsDB, $eh;
	$rid = $_GET['rid'];
	$lid = $_GET['lid'];
	$sql = sprintf("DELETE FROM %s WHERE ratingid = %u", $xoopsDB->prefix("mydownloads_votedata"), $rid);
	$xoopsDB->query($sql) or $eh->show("0013");
	updaterating($lid);
	redirect_header("index.php",1,_MD_VOTEDELETED);
}

function listBrokenDownloads()
{
	global $xoopsDB, $eh;
	$result = $xoopsDB->query("SELECT * FROM ".$xoopsDB->prefix("mydownloads_broken")." ORDER BY reportid");
	$totalbrokendownloads = $xoopsDB->getRowsNum($result);
	xoops_cp_header();
	mydnl_adminMenu(4);
	echo "<h4>"._MD_DLCONF."</h4>";
        echo"<table width='100%' border='0' cellspacing='1' class='outer'>"
           ."<tr class=\"odd\"><td>";
	echo "<h4>"._MD_BROKENREPORTS." ($totalbrokendownloads)</h4><br />";

	if ($totalbrokendownloads==0) {
		echo _MD_NOBROKEN;
	} else {
		echo "<center>"._MD_IGNOREDESC."<br />"._MD_DELETEDESC."</center><br /><br /><br />";
		$colorswitch="#dddddd";
		echo "<table align=\"center\" width=\"90%\">";
		echo "
		<tr>
			<td><b>"._MD_FILETITLE."</b></td>
			<td><b>" ._MD_REPORTER."</b></td>
			<td><b>" ._MD_FILESUBMITTER."</b></td>
			<td><b>" ._MD_IGNORE."</b></td>
			<td><b>" ._EDIT."</b></td>
			<td><b>" ._MD_DELETE."</b></td>
		</tr>";
		while(list($reportid, $lid, $sender, $ip)=$xoopsDB->fetchRow($result)){
			$result2 = $xoopsDB->query("SELECT title, url, submitter FROM ".$xoopsDB->prefix("mydownloads_downloads")." WHERE lid=$lid");
			if ($sender != 0) {
				$result3 = $xoopsDB->query("SELECT uname, email FROM ".$xoopsDB->prefix("users")." WHERE uid=".$sender."");
				list($sendername, $email)=$xoopsDB->fetchRow($result3);
			}
			list($title, $url, $owner)=$xoopsDB->fetchRow($result2);
			$result4 = $xoopsDB->query("SELECT uname, email FROM ".$xoopsDB->prefix("users")." WHERE uid=".$owner."");
			list($ownername, $owneremail)=$xoopsDB->fetchRow($result4);
			echo "<tr><td bgcolor=$colorswitch><a href=$url target='_blank'>$title</a></td>";
			if ($email=="") {
				echo "<td bgcolor=$colorswitch>$sendername ($ip)";
			} else {
				echo "<td bgcolor=$colorswitch><a href=mailto:$email>$sendername</a> ($ip)";
			}
			echo "</td>";
			if ($owneremail=='') {
				echo "<td bgcolor=$colorswitch>$ownername";
			} else {
				echo "<td bgcolor=$colorswitch><a href=mailto:$owneremail>$ownername</a>";
			}
			echo "</td><td bgcolor='$colorswitch' align='center'>\n";
			echo myTextForm("index.php?op=ignoreBrokenDownloads&lid=$lid" , "X");
			echo "</td><td bgcolor='$colorswitch' align='center'>\n";
			echo myTextForm("index.php?op=modDownload&lid=$lid" , "X");
			echo "</td><td bgcolor='$colorswitch' align='center'>\n";
			echo myTextForm("index.php?op=delBrokenDownloads&lid=$lid" , "X");
			echo "</td></tr>\n";
			if ($colorswitch=="#dddddd") {
				$colorswitch="#ffffff";
			} else {
				$colorswitch="#dddddd";
			}
		}
                echo "</table>";
	}
	echo"</td></tr></table>";
	xoops_cp_footer();
}

function delBrokenDownloads()
{
	global $xoopsDB, $eh;
	$lid = $_GET['lid'];
	$sql = sprintf("DELETE FROM %s WHERE lid = %u", $xoopsDB->prefix("mydownloads_broken"), $lid);
	$xoopsDB->query($sql) or $eh->show("0013");
	$sql = sprintf("DELETE FROM %s WHERE lid = %u", $xoopsDB->prefix("mydownloads_downloads"), $lid);
	$xoopsDB->query($sql) or $eh->show("0013");
	redirect_header("index.php",1,_MD_FILEDELETED);
}

function ignoreBrokenDownloads()
{
	global $xoopsDB, $eh;
	$sql = sprintf("DELETE FROM %s WHERE lid = %u", $xoopsDB->prefix("mydownloads_broken"), $_GET['lid']);
	$xoopsDB->query($sql) or $eh->show("0013");
	redirect_header("index.php",1,_MD_BROKENDELETED);
}

function listModReq()
{
	global $xoopsDB, $myts, $eh, $mytree, $icmsModuleConfig;
	$result = $xoopsDB->query("SELECT * FROM ".$xoopsDB->prefix("mydownloads_mod")." ORDER BY requestid");
	$totalmodrequests = $xoopsDB->getRowsNum($result);
	xoops_cp_header();
	mydnl_adminMenu(5);
	echo "<h4>"._MD_DLCONF."</h4>";
        echo"<table width='100%' border='0' cellspacing='1' class='outer'>"
           ."<tr class=\"odd\"><td>";
	echo "<h4>"._MD_USERMODREQ." ($totalmodrequests)</h4><br />";
	if($totalmodrequests>0){
		echo "<table width=95%><tr><td>";
		$lookup_lid = array();
		while(list($requestid, $lid, $cid, $title, $url, $homepage, $version, $size, $platform, $logourl, $description, $modifysubmitter)=$xoopsDB->fetchRow($result)) {
			$lookup_lid[$requestid] = $lid;
			$result2 = $xoopsDB->query("SELECT cid, title, url, homepage, version, size, platform, logourl, submitter FROM ".$xoopsDB->prefix("mydownloads_downloads")." WHERE lid=$lid");
			list($origcid, $origtitle, $origurl, $orighomepage, $origversion, $origsize, $origplatform, $origlogourl, $owner)=$xoopsDB->fetchRow($result2);
			$result2 = $xoopsDB->query("SELECT description FROM ".$xoopsDB->prefix("mydownloads_text")." WHERE lid=$lid");
			list($origdescription) = $xoopsDB->fetchRow($result2);
			$result7 = $xoopsDB->query("SELECT uname, email FROM ".$xoopsDB->prefix("users")." WHERE uid=$modifysubmitter");
			$result8 = $xoopsDB->query("SELECT uname, email FROM ".$xoopsDB->prefix("users")." WHERE uid=$owner");
			$cidtitle=$mytree->getPathFromId($cid, "title");
			$origcidtitle=$mytree->getPathFromId($origcid, "title");
			list($submittername, $submitteremail)=$xoopsDB->fetchRow($result7);
			list($ownername, $owneremail)=$xoopsDB->fetchRow($result8);
			$title = $myts->htmlSpecialChars($title);
			$url = $myts->htmlSpecialChars($url);
			$homepage = $myts->htmlSpecialChars($homepage);
			$version = $myts->htmlSpecialChars($version);
			$size = $myts->htmlSpecialChars($size);
			$platform = $myts->htmlSpecialChars($platform);

			// use original image file to prevent users from changing screen shots file
			$origlogourl = $myts->htmlSpecialChars($origlogourl);
			$logourl = $origlogourl;
			$description = $myts->displayTarea($description, 0);
			$origurl = $myts->htmlSpecialChars($origurl);
			$orighomepage = $myts->htmlSpecialChars($orighomepage);
			$origversion = $myts->htmlSpecialChars($origversion);
			$origsize = $myts->htmlSpecialChars($origsize);
			$origplatform = $myts->htmlSpecialChars($origplatform);
			$origdescription = $myts->displayTarea($origdescription, 0);
			if (empty($ownername)) {
				$ownername = "administration";
			}
			echo "<table border=1 bordercolor=black cellpadding=5 cellspacing=0 align=center width=450><tr><td>
				<table width=100% bgcolor=dddddd>
				<tr>
				<td valign=top width=45%><b>"._MD_ORIGINAL."</b></td>
				<td rowspan=14 valign=top align=left><br />"._MD_DESCRIPTIONC."<br />$origdescription</td>
				</tr>
				<tr><td valign=top width=45%><small>"._MD_FILETITLE." ".$origtitle."</small></td></tr>
				<tr><td valign=top width=45%><small>"._MD_DLURL." ".$origurl."</small></td></tr>
				<tr><td valign=top width=45%><small>"._MD_CATEGORYC." ".$origcidtitle."</small></td></tr>
				<tr><td valign=top width=45%><small>"._MD_HOMEPAGEC." ".$orighomepage."</small></td></tr>
				<tr><td valign=top width=45%><small>"._MD_VERSIONC." ".$origversion."</small></td></tr>
				<tr><td valign=top width=45%><small>"._MD_FILESIZEC." ".$origsize."</small></td></tr>
				<tr><td valign=top width=45%><small>"._MD_PLATFORMC." ".$origplatform."</small></td></tr>
                                <tr><td valign=top width=45%><small>"._MD_SHOTIMAGE."</small> ";
			if ( $icmsModuleConfig['useshots'] && !empty($origlogourl) ){
				echo "<img src=\"".$icmsModuleConfig['shotsuploadfolderurl'].$origlogourl."\" width=\"".$icmsModuleConfig['shotwidth']."\">";
			}else{
				echo "&nbsp;";
			}
			echo "</td></tr>
				</table></td></tr><tr><td>
				<table width=100%>
					<tr>
					<td valign=top width=45%><b>"._MD_PROPOSED."</b></td>
					<td rowspan=14 valign=top align=left><br />"._MD_DESCRIPTIONC."<br />$description</td>
					</tr>
					<tr><td valign=top width=45%><small>"._MD_FILETITLE." ".$title."</small></td></tr>
					<tr><td valign=top width=45%><small>"._MD_DLURL." ".$url."</small></td></tr>
					<tr><td valign=top width=45%><small>"._MD_CATEGORYC." ".$cidtitle."</small></td></tr>
					<tr><td valign=top width=45%><small>"._MD_HOMEPAGEC." ".$homepage."</small></td></tr>
					<tr><td valign=top width=45%><small>"._MD_VERSIONC." ".$version."</small></td></tr>
					<tr><td valign=top width=45%><small>"._MD_FILESIZEC." ".$size."</small></td></tr>
					<tr><td valign=top width=45%><small>"._MD_PLATFORMC." ".$platform."</small></td></tr>
					<tr><td valign=top width=45%><small>"._MD_SHOTIMAGE."</small> ";
			if ( $icmsModuleConfig['useshots'] && !empty($logourl) ){
				echo "<img src=\"".$icmsModuleConfig['shotsuploadfolderurl'].$logourl."\" width=\"".$icmsModuleConfig['shotwidth']."\">";
			} else {
				echo "&nbsp;";
			}
			echo "</td></tr>
				</table></td></tr></table>
				<table align=center width=450>
				<tr>";
			if ( $submitteremail=="" ) {
				echo "<td align=left><small>"._MD_SUBMITTER." $submittername</small></td>";
			} else {
				echo "<td align=left><small>"._MD_SUBMITTER." <a href=mailto:$submitteremail>$submittername</a></small></td>";
			}
			if ($owneremail=="") {
				echo "<td align=center><small>"._MD_OWNER." $ownername</small></td>";
			} else {
				echo "<td align=center><small>"._MD_OWNER." <a href=mailto:$owneremail>$ownername</a></small></td>";
			}
			echo "<td align=right><small>\n";
			echo "<table><tr><td>\n";
			echo myTextForm("index.php?op=changeModReq&requestid=$requestid" , _MD_APPROVE);
			echo "</td><td>\n";
			echo myTextForm("index.php?op=modDownload&lid=$lookup_lid[$requestid]", _EDIT);
			echo "</td><td>\n";
			echo myTextForm("index.php?op=ignoreModReq&requestid=$requestid", _MD_IGNORE);
			echo "</td></tr></table>\n";
			echo "</small></td></tr>\n";
			echo "</table><br /><br />";
		}
		echo "</td></tr></table>";
	}else {
		echo _MD_NOMODREQ;
	}
	echo"</td></tr></table>";
	xoops_cp_footer();
}

function changeModReq()
{
	global $xoopsDB, $eh, $myts;
	$requestid = $_GET['requestid'];
	$query = "SELECT lid, cid, title, url, homepage, version, size, platform, logourl, description FROM ".$xoopsDB->prefix("mydownloads_mod")." WHERE requestid=$requestid";
	$result = $xoopsDB->query($query);
	while(list($lid, $cid, $title, $url, $homepage, $version, $size, $platform, $logourl, $description)=$xoopsDB->fetchRow($result)) {
		if (get_magic_quotes_runtime()) {
			$title = stripslashes($title);
			$url = stripslashes($url);
			$homepage = stripslashes($homepage);
			$logourl = stripslashes($logourl);
			$description = stripslashes($description);
		}
		$title = addslashes($title);
		$url = addslashes($url);
		$homepage = addslashes($homepage);
		$logourl = addslashes($logourl);
		$description = addslashes($description);
		$sql = sprintf("UPDATE %s SET cid = %u,title = '%s', url = '%s', homepage = '%s', version = '%s', size = %u, platform = '%s', logourl = '%s', status = %u, date = %u WHERE lid = %u", $xoopsDB->prefix("mydownloads_downloads"), $cid, $title, $url, $homepage, $version, $size, $platform, $logourl, 2, time(), $lid);
		$xoopsDB->query($sql) or $eh->show("0013");
		$sql = sprintf("UPDATE %s SET description = '%s' WHERE lid = %u", $xoopsDB->prefix("mydownloads_text"), $description, $lid);
		$xoopsDB->query($sql) or $eh->show("0013");
		$sql = sprintf("DELETE FROM %s WHERE requestid = %u", $xoopsDB->prefix("mydownloads_mod"), $requestid);
		$xoopsDB->query($sql) or $eh->show("0013");
	}
	redirect_header("index.php",1,_MD_DBUPDATED);
}

function ignoreModReq()
{
	global $xoopsDB, $eh;
	$sql = sprintf("DELETE FROM %s WHERE requestid = %u", $xoopsDB->prefix("mydownloads_mod"), $_GET['requestid']);
	$xoopsDB->query($sql) or $eh->show("0013");
	redirect_header("index.php",1,_MD_MODREQDELETED);
}

function modDownloadS()
{
	global $xoopsDB, $myts, $eh, $icmsModuleConfig;
	$cid = $_POST['cid'];
	if (($_POST['url']) || ($_POST['url']!='')) {
		$url = $myts->addSlashes($_POST['url']);
	}
	$logourl = $myts->addSlashes($_POST['logourl']);
	$title = $myts->addSlashes($_POST['title']);
	$homepage = $myts->addSlashes($_POST['homepage']);
	$version = $myts->addSlashes($_POST['version']);
	$size = $myts->addSlashes($_POST['size']);
	$platform = $myts->addSlashes($_POST['platform']);
	$description = $myts->addSlashes($_POST['description']);
	// ********************************************************************************************************************
	if(isset($_POST['xoops_upload_file'])) {
		$fldname = $_FILES[$_POST['xoops_upload_file'][0]];
		$fldname = (get_magic_quotes_gpc()) ? stripslashes($fldname['name']) : $fldname['name'];
		if(xoops_trim($fldname!='')) {
			$destname = mydownloads_createUploadName($icmsModuleConfig['uploadfolderpath'],$fldname);
			$tbl_tmp = @split('|',$icmsModuleConfig['mimetype']);
			$permittedtypes = @array_walk($tbl_tmp,'trim');
			$uploader = new XoopsMediaUploader( $icmsModuleConfig['uploadfolderpath'], $tbl_tmp, $icmsModuleConfig['maxuploadsize']);
			$uploader->setTargetFileName($destname);
			if ($uploader->fetchMedia($_POST['xoops_upload_file'][0])) {
				if ($uploader->upload()) {
					$url = $icmsModuleConfig['uploadfolderurl'].'/'.$destname;
				} else {
					echo _MD_UPLOAD_ERROR. ' ' . $uploader->getErrors();
				}
			} else {
				echo $uploader->getErrors();
			}
		}
	}
	// ********************************************************************************************************************

	$sql = sprintf("UPDATE %s SET cid = %u, title = '%s', url = '%s', homepage = '%s', version = '%s', size = %u, platform = '%s', logourl = '%s', status = %u, date = %u WHERE lid = %u", $xoopsDB->prefix("mydownloads_downloads"), $cid, $title, $url, $homepage, $version, $size, $platform, $logourl, 2, time(), $_POST['lid']);
	$xoopsDB->query($sql)  or $eh->show("0013");
	$sql = sprintf("UPDATE %s SET description = '%s' WHERE lid = %u", $xoopsDB->prefix("mydownloads_text"), $description, $_POST['lid']);
	$xoopsDB->query($sql)  or $eh->show("0013");
	redirect_header("index.php",1,_MD_DBUPDATED);
}

function delDownload()
{
	global $xoopsDB, $eh, $icmsModule;
	$lid = intval($_POST['lid']);
	$sql = sprintf("DELETE FROM %s WHERE lid = %u", $xoopsDB->prefix("mydownloads_downloads"), $lid);
	$xoopsDB->query($sql) or $eh->show("0013");
	$sql = sprintf("DELETE FROM %s WHERE lid = %u", $xoopsDB->prefix("mydownloads_text"), $lid);
	$xoopsDB->query($sql) or $eh->show("0013");
	$sql = sprintf("DELETE FROM %s WHERE lid = %u", $xoopsDB->prefix("mydownloads_votedata"), $lid);
	$xoopsDB->query($sql) or $eh->show("0013");
	// delete comments
	xoops_comment_delete($icmsModule->getVar('mid'), $lid);
	redirect_header("index.php",1,_MD_FILEDELETED);
}

function modCat()
{
	global $xoopsDB, $myts, $eh, $icmsModuleConfig;
	$cid = intval($_POST['cid']);
	xoops_cp_header();
	mydnl_adminMenu(2);

	$result = $xoopsDB->query("SELECT pid, title, imgurl FROM ".$xoopsDB->prefix('mydownloads_cat')." WHERE cid=$cid");
	list($pid,$title,$imgurl) = $xoopsDB->fetchRow($result);
	$title = $myts->htmlSpecialChars($title);
	$imgurl = $myts->htmlSpecialChars($imgurl);

	echo '<h4>'._MD_DLCONF.'</h4>';
	$form = new XoopsThemeForm(_MD_MODCAT, 'addmaincateg', 'index.php', 'post');
	$form->setExtra('enctype="multipart/form-data"');
	$form->addElement(new XoopsFormText(_MD_TITLEC, 'title', 50, 255, $title), true);
	if(xoops_trim($imgurl) != '' && $imgurl != 'http://') {
		$form->addElement(new XoopsFormLabel(_IMAGE, "<img src='".$imgurl."' alt='' border='0' />"));
	}
	$form->addElement(new XoopsFormText(_MD_IMGURLMAIN, 'imgurl', 50, 255, $imgurl), false);
	$form->addElement(new XoopsFormFile(_MD_UPLOAD_FILE, 'attachedfile', $icmsModuleConfig['maxuploadsize']), false);

	$form->addElement(new XoopsFormHidden('cid', $cid), false);
	$form->addElement(new XoopsFormHidden('op', 'modCatS'), false);

	$mytree = new mydlXoopsTree($xoopsDB->prefix('mydownloads_cat'), 'cid', 'pid');
	$form->addElement(new XoopsFormLabel(_MD_PARENT, $mytree->mydl_makeMySelBox('title', 'title',$pid,1,'pid')));

	$button_tray = new XoopsFormElementTray('' ,'');
	$submit_btn = new XoopsFormButton('', 'post', _MD_SAVE, 'submit');
	$button_tray->addElement($submit_btn);

	$delButton =  new XoopsFormButton('', 'btndel', _MD_DELETE, 'button');
	$delButton->setExtra("onClick=\"location='index.php?pid=$pid&amp;cid=$cid&amp;op=delCat'\"");
	$button_tray->addElement($delButton);

	$cancelButton =  new XoopsFormButton('', 'btncancel', _MD_CANCEL, 'button');
	$cancelButton->setExtra(" onclick=\"javascript:history.go(-1)\"");
	$button_tray->addElement($cancelButton);
	$form->addElement($button_tray);
	$form->display();
	unset($button_tray, $form);
	xoops_cp_footer();
}

function modCatS()
{
	global $xoopsDB, $myts, $eh, $icmsModuleConfig;
	$cid =  $_POST['cid'];
	$sid =  $_POST['pid'];
	$title =  $myts->addSlashes($_POST['title']);
	if (empty($title)) {
		redirect_header("index.php", 2, _MD_ERRORTITLE);
		exit();
	}
	if (($_POST['imgurl']) || ($_POST['imgurl']!='')) {
		$imgurl = $myts->addSlashes($_POST['imgurl']);
	}

	if(isset($_POST['xoops_upload_file'])) {
		$fldname = $_FILES[$_POST['xoops_upload_file'][0]];
		$fldname = (get_magic_quotes_gpc()) ? stripslashes($fldname['name']) : $fldname['name'];
		if(xoops_trim($fldname!='')) {
			$destname = mydownloads_createUploadName($icmsModuleConfig['uploadfolderpath'],$fldname);
			$tbl_tmp = @split('|',$icmsModuleConfig['mimetype']);
			$permittedtypes = @array_walk($tbl_tmp,'trim');
			$uploader = new XoopsMediaUploader( $icmsModuleConfig['shotsuploadfolderpath'], $tbl_tmp, $icmsModuleConfig['maxuploadsize']);
			$uploader->setTargetFileName($destname);
			if ($uploader->fetchMedia($_POST['xoops_upload_file'][0])) {
				if ($uploader->upload()) {
					$imgurl = $icmsModuleConfig['shotsuploadfolderurl'].'/'.$destname;
				} else {
					echo _MD_UPLOAD_ERROR. ' ' . $uploader->getErrors();
				}
			} else {
				echo $uploader->getErrors();
			}
		}
	}
	$sql = sprintf("UPDATE %s SET title = '%s', imgurl = '%s', pid = %u WHERE cid = %u", $xoopsDB->prefix('mydownloads_cat'), $title, $imgurl, $sid, $cid);
	$xoopsDB->query($sql) or $eh->show("0013");
	redirect_header('index.php', 3,_MD_DBUPDATED);
}

function delCat()
{
	global $xoopsDB, $eh, $mytree, $icmsModule;
	$cid =  isset($_POST['cid']) ? intval($_POST['cid']) : intval($_GET['cid']);
	$ok =  isset($_POST['ok']) ? intval($_POST['ok']) : 0;
	if ($ok == 1) {
		//get all subcategories under the specified category
		$arr=$mytree->getAllChildId($cid);
		$lcount = count($arr);
		for ($i = 0; $i < $lcount; $i++) {
			//get all downloads in each subcategory
			$result=$xoopsDB->query("SELECT lid FROM ".$xoopsDB->prefix("mydownloads_downloads")." WHERE cid=".$arr[$i]."") or $eh->show("0013");
			//now for each download, delete the text data and vote ata associated with the download
			while ( list($lid)=$xoopsDB->fetchRow($result) ) {
				$sql = sprintf("DELETE FROM %s WHERE lid = %u", $xoopsDB->prefix('mydownloads_text'), $lid);
				$xoopsDB->query($sql) or $eh->show("0013");
				$sql = sprintf("DELETE FROM %s WHERE lid = %u", $xoopsDB->prefix('mydownloads_votedata'), $lid);
				$xoopsDB->query($sql) or $eh->show("0013");
				$sql = sprintf("DELETE FROM %s WHERE lid = %u", $xoopsDB->prefix('mydownloads_downloads'), $lid);
				$xoopsDB->query($sql) or $eh->show("0013");
				// delete comments
				xoops_comment_delete($icmsModule->getVar('mid'), $lid);
			}

			//all downloads for each subcategory is deleted, now delete the subcategory data
			$sql = sprintf("DELETE FROM %s WHERE cid = %u", $xoopsDB->prefix("mydownloads_cat"), $arr[$i]);
			$xoopsDB->query($sql) or $eh->show("0013");
		}
		//all subcategory and associated data are deleted, now delete category data and its associated data
		$result=$xoopsDB->query("SELECT lid FROM ".$xoopsDB->prefix("mydownloads_downloads")." WHERE cid=".$cid."") or $eh->show("0013");
		while(list($lid)=$xoopsDB->fetchRow($result)){
			$sql = sprintf("DELETE FROM %s WHERE lid = %u", $xoopsDB->prefix("mydownloads_downloads"), $lid);
			$xoopsDB->query($sql) or $eh->show("0013");
			$sql = sprintf("DELETE FROM %s WHERE lid = %u", $xoopsDB->prefix("mydownloads_text"), $lid);
			$xoopsDB->query($sql) or $eh->show("0013");
			// delete comments
			xoops_comment_delete($icmsModule->getVar('mid'), $lid);
			$sql = sprintf("DELETE FROM %s WHERE lid = %u", $xoopsDB->prefix("mydownloads_votedata"), $lid);
			$xoopsDB->query($sql) or $eh->show("0013");
		}
		$sql = sprintf("DELETE FROM %s WHERE cid = %u", $xoopsDB->prefix("mydownloads_cat"), $cid);
		$xoopsDB->query($sql) or $eh->show("0013");
		redirect_header("index.php",1,_MD_CATDELETED);
		exit();
	} else {
		xoops_cp_header();
		echo "<h4>"._MD_DLCONF."</h4>";
		xoops_confirm(array('op' => 'delCat', 'cid' => $cid, 'ok' => 1), 'index.php', _MD_WARNING);
		xoops_cp_footer();
	}
}

function delNewDownload()
{
	global $xoopsDB, $eh, $icmsModule;
	$sql = sprintf("DELETE FROM %s WHERE lid = %u", $xoopsDB->prefix("mydownloads_downloads"), $_GET['lid']);
	$xoopsDB->query($sql) or $eh->show("0013");
	$sql = sprintf("DELETE FROM %s WHERE lid = %u", $xoopsDB->prefix("mydownloads_text"), $_GET['lid']);
	$xoopsDB->query($sql) or $eh->show("0013");
	// delete comments
	xoops_comment_delete($icmsModule->getVar('mid'), $_GET['lid']);
	redirect_header("index.php",1,_MD_FILEDELETED);
}

function addCat()
{
	global $xoopsDB, $myts, $eh, $icmsModuleConfig;
	$pid = $_POST["cid"];
	$title = $myts->addSlashes($_POST['title']);
	if (empty($title)) {
		redirect_header('index.php', 3, _MD_ERRORTITLE);
	}
	if ((isset($_POST['imgurl'])) && (trim($_POST['imgurl']!=''))) {
		$imgurl = $myts->addSlashes($_POST["imgurl"]);
	} else {
		$imgurl = '';
	}
	if(isset($_POST['xoops_upload_file'])) {
		$fldname = $_FILES[$_POST['xoops_upload_file'][0]];
		$fldname = (get_magic_quotes_gpc()) ? stripslashes($fldname['name']) : $fldname['name'];
		if(xoops_trim($fldname!='')) {
			$destname = mydownloads_createUploadName($icmsModuleConfig['shotsuploadfolderpath'],$fldname);
			$tbl_tmp = @split('|',$icmsModuleConfig['mimetype']);
			$permittedtypes = @array_walk($tbl_tmp,'trim');
			$uploader = new XoopsMediaUploader( $icmsModuleConfig['shotsuploadfolderpath'], $tbl_tmp, $icmsModuleConfig['maxuploadsize']);
			$uploader->setTargetFileName($destname);
			if ($uploader->fetchMedia($_POST['xoops_upload_file'][0])) {
				if ($uploader->upload()) {
					$imgurl = $icmsModuleConfig['shotsuploadfolderurl'].'/'.$destname;
				} else {
					echo _MD_UPLOAD_ERROR. ' ' . $uploader->getErrors();
				}
			} else {
				echo $uploader->getErrors();
			}
		}
	}

	$newid = $xoopsDB->genId($xoopsDB->prefix('mydownloads_cat').'_cid_seq');
	$sql = sprintf("INSERT INTO %s (cid, pid, title, imgurl) VALUES (%u, %u, '%s', '%s')", $xoopsDB->prefix("mydownloads_cat"), $newid, $pid, $title, $imgurl);
	$xoopsDB->query($sql) or $eh->show("0013");
	if ($newid == 0) {
		$newid = $xoopsDB->getInsertId();
	}
	// Notify of new category
	global $icmsModule;
	$tags = array();
	$tags['CATEGORY_NAME'] = $title;
	$tags['CATEGORY_URL'] = ICMS_URL . '/modules/' . $icmsModule->getVar('dirname') . '/viewcat.php?cid=' . $newid;
	$notification_handler =& xoops_gethandler('notification');
	$notification_handler->triggerEvent('global', 0, 'new_category', $tags);
	redirect_header('index.php', 3,_MD_NEWCATADDED);
}

function addDownload()
{
	global $xoopsDB, $xoopsUser, $icmsModule, $myts, $eh, $icmsModuleConfig;
	$url = $myts->addSlashes(formatURL($_POST["url"]));
	$logourl = $myts->addSlashes($_POST["logourl"]);
	$title = $myts->addSlashes($_POST["title"]);
	$homepage = $myts->addSlashes(formatURL($_POST["homepage"]));
	$version = $myts->addSlashes($_POST["version"]);
	$size = $myts->addSlashes($_POST["size"]);
	$platform = $myts->addSlashes($_POST["platform"]);
	$description = $myts->addSlashes($_POST["description"]);
	$submitter = $xoopsUser->uid();
	$result = $xoopsDB->query("SELECT COUNT(*) FROM ".$xoopsDB->prefix("mydownloads_downloads")." WHERE url='$url'");
	list($numrows) = $xoopsDB->fetchRow($result);
	$error = 0;
	$errormsg = '';
	if ($numrows>0) {
		$errormsg .= "<h4 style='color: #ff0000'>";
		$errormsg .= _MD_ERROREXIST."</h4><br />";
		$error = 1;
	}
	// Check if Title exist
	if ($title=='') {
		$errormsg .= "<h4 style='color: #ff0000'>";
		$errormsg .= _MD_ERRORTITLE."</h4><br />";
		$error =1;
	}
	if( empty($size) || !is_numeric($size) ){
		$size = 0;
	}
	// Check if Description exist
	if ($description=='') {
		$errormsg .= "<h4 style='color: #ff0000'>";
		$errormsg .= _MD_ERRORDESC."</h4><br />";
		$error =1;
	}
	if($error == 1) {
		xoops_cp_header();
		echo $errormsg;
		xoops_cp_footer();
		exit();
	}
	if ( !empty($_POST['cid']) ) {
		$cid = $_POST['cid'];
	} else {
		$cid = 0;
	}
	$newid = $xoopsDB->genId($xoopsDB->prefix("mydownloads_downloads")."_lid_seq");
// ********************************************************************************************************************
	if(isset($_POST['xoops_upload_file'])) {
		$fldname = $_FILES[$_POST['xoops_upload_file'][0]];
		$fldname = (get_magic_quotes_gpc()) ? stripslashes($fldname['name']) : $fldname['name'];
		if(xoops_trim($fldname!='')) {
			$destname = mydownloads_createUploadName($icmsModuleConfig['uploadfolderpath'],$fldname);
			$tbl_tmp = @split('|',$icmsModuleConfig['mimetype']);
			$permittedtypes = @array_walk($tbl_tmp,'trim');
			$uploader = new XoopsMediaUploader( $icmsModuleConfig['uploadfolderpath'], $tbl_tmp, $icmsModuleConfig['maxuploadsize']);
			$uploader->setTargetFileName($destname);
			if ($uploader->fetchMedia($_POST['xoops_upload_file'][0])) {
				if ($uploader->upload()) {
					$url = $icmsModuleConfig['uploadfolderurl'].'/'.$destname;
				} else {
					echo _MD_UPLOAD_ERROR. ' ' . $uploader->getErrors();
				}
			} else {
				echo $uploader->getErrors();
			}
		}
	}
// ********************************************************************************************************************
	$sql = sprintf("INSERT INTO %s (lid, cid, title, url, homepage, version, size, platform, logourl, submitter, status, date, hits, rating, votes, comments) VALUES (%u, %u, '%s', '%s', '%s', '%s', %u, '%s', '%s', %u, %u, %u, %u, %u, %u, %u)", $xoopsDB->prefix("mydownloads_downloads"), $newid, $cid, $title, $url, $homepage, $version, $size, $platform, $logourl, $submitter, 1, time(), 0, 0, 0, 0);
	$xoopsDB->query($sql) or $eh->show("0013");
	if( $newid == 0 ) {
		$newid = $xoopsDB->getInsertId();
	}
	$sql = sprintf("INSERT INTO %s (lid, description) VALUES (%u, '%s')", $xoopsDB->prefix("mydownloads_text"), $newid, $description);
	$xoopsDB->query($sql) or $eh->show("0013");

// ********************************************************************************************************************
	$tags = array();
	$tags['FILE_NAME'] = $title;
	$tags['FILE_URL'] = ICMS_URL . '/modules/' . $icmsModule->getVar('dirname') . '/singlefile.php?cid=' . $cid . '&amp;lid=' . $newid;
	$sql = "SELECT title FROM " . $xoopsDB->prefix("mydownloads_cat") . " WHERE cid=" . $cid;
	$result = $xoopsDB->query($sql);
	$row = $xoopsDB->fetchArray($result);
	$tags['CATEGORY_NAME'] = $row['title'];
	$tags['CATEGORY_URL'] = ICMS_URL . '/modules/' . $icmsModule->getVar('dirname') . '/viewcat.php?cid=' . $cid;
	$notification_handler =& xoops_gethandler('notification');
	$notification_handler->triggerEvent('global', 0, 'new_file', $tags);
	$notification_handler->triggerEvent('category', $cid, 'new_file', $tags);
	redirect_header("index.php?op=downloadsConfigMenu",1,_MD_NEWDLADDED);
}

function approve()
{
	global $icmsConfig, $xoopsDB, $myts, $eh;
	$lid = $_POST['lid'];
	$title = $_POST['title'];
	$cid = $_POST['cid'];
	if ( empty($cid) ) {
		$cid = 0;
	}
	$homepage = $_POST['homepage'];
	$version = $_POST['version'];
	$size = $_POST['size'];
	$platform = $_POST['platform'];
	$description = $_POST['description'];
	if (($_POST["url"]) || ($_POST["url"]!="")) {
		$url = $myts->addSlashes($_POST["url"]);
	}
	$logourl = $myts->addSlashes($_POST["logourl"]);
	$title = $myts->addSlashes($title);
	$homepage = $myts->addSlashes($homepage);
	$version = $myts->addSlashes($_POST["version"]);
	$size = $myts->addSlashes($_POST["size"]);
	$platform = $myts->addSlashes($_POST["platform"]);
	$description = $myts->addSlashes($description);
	$sql = sprintf("UPDATE %s SET cid = %u, title = '%s', url = '%s', homepage = '%s', version = '%s', size = %u, platform = '%s', logourl = '%s', status = %u, date = %u WHERE lid = %u", $xoopsDB->prefix("mydownloads_downloads"), $cid, $title, $url, $homepage, $version, $size, $platform, $logourl, 1, time(), $lid);
	$xoopsDB->query($sql) or $eh->show("0013");
	$sql = sprintf("UPDATE %s SET description = '%s' WHERE lid = %u", $xoopsDB->prefix("mydownloads_text"), $description, $lid);
	$xoopsDB->query($sql) or $eh->show("0013");
	global $icmsModule;
	$tags = array();
	$tags['FILE_NAME'] = $title;
	$tags['FILE_URL'] = ICMS_URL . '/modules/' . $icmsModule->getVar('dirname') . '/singlefile.php?cid=' . $cid . '&amp;lid=' . $lid;
	$sql = "SELECT title FROM " . $xoopsDB->prefix('mydownloads_cat') . " WHERE cid=" . $cid;
	$result = $xoopsDB->query($sql);
	$row = $xoopsDB->fetchArray($result);
	$tags['CATEGORY_NAME'] = $row['title'];
	$tags['CATEGORY_URL'] = ICMS_URL . '/modules/' . $icmsModule->getVar('dirname') . '/viewcat.php?cid=' . $cid;
	$notification_handler =& xoops_gethandler('notification');
	$notification_handler->triggerEvent('global', 0, 'new_file', $tags);
	$notification_handler->triggerEvent('category', $cid, 'new_file', $tags);
	$notification_handler->triggerEvent('file', $lid, 'approve', $tags);
	redirect_header("index.php",1,_MD_NEWDLADDED);
}
if(!isset($_POST['op'])) {
	$op = isset($_GET['op']) ? $_GET['op'] : 'main';
} else {
	$op = $_POST['op'];
}
switch ($op) {
case "delNewDownload":
	delNewDownload();
	break;
case "approve":
	approve();
	break;
case "addCat":
	addCat();
	break;
case "addSubCat":
	addSubCat();
	break;
case "addDownload":
	addDownload();
	break;
case "listBrokenDownloads":
	listBrokenDownloads();
	break;
case "delBrokenDownloads":
	delBrokenDownloads();
	break;
case "ignoreBrokenDownloads":
	ignoreBrokenDownloads();
	break;
case "listModReq":
	listModReq();
	break;
case "changeModReq":
	changeModReq();
	break;
case "ignoreModReq":
	ignoreModReq();
	break;
case "delCat":
	delCat();
	break;
case "modCat":
	modCat();
	break;
case "modCatS":
	modCatS();
	break;
case "modDownload":
	modDownload();
	break;
case "modDownloadS":
	modDownloadS();
	break;
case "delDownload":
	delDownload();
	break;
case "delVote":
	delVote();
	break;
case "downloadsConfigMenu":
	downloadsConfigMenu();
	break;
case "listNewDownloads":
	listNewDownloads();
	break;
case 'main':
default:
	mydownloads();
	// List current files
	$start = isset($_GET['start']) ? intval($_GET['start']) : 0;
	$limit = 15;
	$sql = 'SELECT Count(*) as cpt FROM '.$xoopsDB->prefix('mydownloads_downloads').' WHERE status > 0';
	$result = $xoopsDB->query($sql);
	list($totalCount) = $xoopsDB->fetchRow($result);
	$pagenav = null;
	if($totalCount > $limit) {
		require_once ICMS_ROOT_PATH.'/class/pagenav.php';
		$pagenav = new XoopsPageNav( $totalCount, $limit, $start);
	}

	$sql = 'SELECT d.*, t.*, c.title as cattitle FROM '.$xoopsDB->prefix('mydownloads_downloads').' d, '.$xoopsDB->prefix('mydownloads_text').' t, '.$xoopsDB->prefix('mydownloads_cat').' c WHERE d.status > 0 AND d.lid = t.lid AND d.cid = c.cid ORDER BY d.title';
	$result = $xoopsDB->query($sql, $limit, $start);
	if($result && $totalCount > 0) {
		if (file_exists( ICMS_ROOT_PATH.'/language/'.$icmsConfig['language'].'/admin.php')) {
			require_once  ICMS_ROOT_PATH.'/language/'.$icmsConfig['language'].'/admin.php';
		} else {
			require_once  ICMS_ROOT_PATH.'/language/english/admin.php';
		}

		echo "<br />";
		echo "<table width='100%' cellspacing='1' cellpadding='3' border='0' class='outer'>";
		echo "<tr><th align='center'>"._MD_FILEID."</th><th align='center'>"._MD_TITLE."</th><th align='center'>"._MD_CATEGORY."</th><th align='center'>"._AD_ACTION."</th></tr>";
		$class = '';
		$conf_msg = mydownloads_JavascriptLinkConfirm(_AM_MD_DEL_ITEM);
		$conf_msg = '';
		while ($myrow = $xoopsDB->fetchArray($result)) {
			$class = ($class == 'even') ? 'odd' : 'even';
			$id = $myrow['lid'];
			$action_edit = "<a href='index.php?op=modDownload&lid=".$id."' title='"._AD_EDIT."'>"._AD_EDIT.'</a>';
			$action_delete = "<a href='index.php?op=deleteDownload&lid=".$id."' title='"._AD_DELETE."'".$conf_msg.">"._AD_DELETE.'</a>';

			echo "<tr class='".$class."'>\n";
			echo "<td align='center'>".$id."</td><td>".$myts->htmlSpecialChars($myrow['title'])."</td><td>".$myts->htmlSpecialChars($myrow['cattitle'])."</td><td align='center'>".$action_edit.' - '.$action_delete.'</td>';
			echo "</tr>";
		}
		echo '</table>';
		if(is_object($pagenav)) {
			echo "<div align='right'>".$pagenav->renderNav()."</div>";
		}
	}
	xoops_cp_footer();
	break;

case 'deleteDownload':
	xoops_cp_header();
	xoops_confirm(array('op' => 'delDownload', 'lid' => intval($_GET['lid']), 'ok' => 1), 'index.php', _AM_MD_DEL_ITEM);
	xoops_cp_footer();
	break;
}
?>