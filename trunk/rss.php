<?php
//  ------------------------------------------------------------------------ //
//                      RSS FEED FOR MYDOWNLOADS				             //
//                  Copyright (c) 2005-2006 Herv� Thouzard                   //
//                     <http://www.herve-thouzard.com/>                      //
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

include_once 'header.php';
include_once ICMS_ROOT_PATH.'/class/template.php';
$items_count = $icmsModuleConfig['newdownloads']; // Number of items to display, by default, the module's preference used to select the count of items to display on the index page
$cid = isset($_GET['cid']) ? intval($_GET['cid']) : 0;

if (function_exists('mb_http_output')) {
	mb_http_output('pass');
}
$charset = 'utf-8';
header ('Content-Type:text/xml; charset='.$charset);
$tpl = new XoopsTpl();

$tpl->xoops_setCaching(2);		// 1 = Cache global, 2 = Cache individuel (par template)
$tpl->xoops_setCacheTime(3600);	// Temps de cache en secondes

$groups = is_object($xoopsUser) ? $xoopsUser->getGroups() : XOOPS_GROUP_ANONYMOUS;
$cacheId = $cid.'-'.implode('-', $groups);

if (!$tpl->is_cached('db:mydownloads_rss.html', $cacheId)) {
	$myts =& MyTextSanitizer::getInstance();
	$sitename = htmlspecialchars($icmsConfig['sitename'], ENT_QUOTES);
	$email = checkEmail($icmsConfig['adminmail'], false);
	$slogan = htmlspecialchars($icmsConfig['slogan'], ENT_QUOTES);
	$module = $icmsModule->getVar('name');
	$channel_link = ICMS_URL.'/';
	$channel_desc = xoops_utf8_encode($slogan);
	$channel_lastbuild = formatTimestamp(time(), 'rss');
	$channel_webmaster = xoops_utf8_encode($email);
	$channel_editor = xoops_utf8_encode($email);
	$channel_category = xoops_utf8_encode($category);
	$channel_generator = xoops_utf8_encode(htmlspecialchars($module, ENT_QUOTES));
	$channel_language = _LANGCODE;
	$image_url = ICMS_URL.'/images/logo.gif';
	$dimention = getimagesize(ICMS_ROOT_PATH.'/images/logo.gif');
	if (empty($dimention[0])) {
		$width = 88;
	} else {
		$width = ($dimention[0] > 144) ? 144 : $dimention[0];
	}
	if (empty($dimention[1])) {
		$height = 31;
	} else {
		$height = ($dimention[1] > 400) ? 400 : $dimention[1];
	}
	$image_width = $width;
	$image_height = $height;
	
	$and = '';
	$category = '';
	$categories = mydownloads_MygetItemIds();
	$and = ' AND cid IN ('.implode(',', $categories).') ';
	if($cid > 0 && in_array($cid, $categories)) {
		$sql = 'SELECT title FROM '.$xoopsDB->prefix('mydownloads_cat').' WHERE cid='.$cid;
		$result = $xoopsDB->query($sql);
		if($result) {
			$myrow = $xoopsDB->fetchArray($result);
			$category = ' - '.$myts->displayTarea($myrow['title']);
		}
		$and = ' AND cid='.$cid.' ';
	}
	
	$title = $sitename.' - '.$module.$category;
	$channel_title = xoops_utf8_encode(htmlspecialchars($title, ENT_QUOTES));
	
	$tpl->assign('charset',$charset);
	$tpl->assign('channel_title', $channel_title);
	$tpl->assign('channel_link', $channel_link);
	$tpl->assign('channel_desc', $channel_desc);
	$tpl->assign('channel_lastbuild', $channel_lastbuild);
	$tpl->assign('channel_generator', $channel_generator);
	$tpl->assign('channel_category', $channel_category);
	$tpl->assign('channel_editor', $channel_editor);
	$tpl->assign('channel_webmaster', $channel_webmaster);
	$tpl->assign('channel_language', $channel_language);
	$tpl->assign('image_url', $image_url);
	$tpl->assign('image_width', $image_width);
	$tpl->assign('image_height', $image_height);

	if(count($categories) > 0) {
		$sql = 'SELECT d.lid, d.cid, d.title, d.submitter, d.date, t.description FROM '.$xoopsDB->prefix('mydownloads_downloads').' d LEFT JOIN '.$xoopsDB->prefix('mydownloads_text').' t ON t.lid=d.lid WHERE status>0 '.$and.'ORDER BY date DESC';
		$result = $xoopsDB->query($sql, $items_count);
		while($myrow = $xoopsDB->fetchArray($result)) {
			$titre = $myrow['title'];
			$titre = $myts->displayTarea($titre,0);
			$titre = htmlspecialchars($titre, ENT_QUOTES);
		
			$description = $myrow['description'];
			$description = $myts->displayTarea($description,0);
			$description = htmlspecialchars($description, ENT_QUOTES);
	
			$title = xoops_utf8_encode($titre);
			$description = xoops_utf8_encode($description);
			$link = ICMS_URL.'/modules/mydownloads/singlefile?cid='.$myrow['cid'].'&amp;lid='.$myrow['lid'];
   			$guid = $link;
			$pubdate = formatTimestamp($myrow['date'], 'rss');
			$tpl->append('items', array('title' => $title, 'link' => $link, 'guid' => $link, 'pubdate' => $pubdate, 'description' => $description));
		}
	}
}
$tpl->display('db:mydownloads_rss.html', $cacheId);
?>