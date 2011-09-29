<?php
// $Id: index.php,v 1.14 2004/12/26 19:11:55 onokazu Exp $
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
include_once 'header.php';
include_once ICMS_ROOT_PATH.'/class/xoopstree.php';

$myts =& MyTextSanitizer::getInstance(); // MyTextSanitizer object
$mytree = new XoopsTree($xoopsDB->prefix('mydownloads_cat'),'cid','pid');
$xoopsOption['template_main'] = 'mydownloads_index.html';
include_once ICMS_ROOT_PATH.'/header.php';

$sql = 'SELECT cid, title, imgurl FROM '.$xoopsDB->prefix('mydownloads_cat').' WHERE pid = 0 ';

$categories = mydownloads_MygetItemIds();
if(is_array($categories) && count($categories) > 0) {
	$sql .= ' AND cid IN ('.implode(',', $categories).') ';
} else {	// User can't see any category
	redirect_header(ICMS_URL.'/index.php', 3, _NOPERM);
	exit();
}
$sql .= 'ORDER BY title';

$result = $xoopsDB->query($sql);

$count = 1;
$content = '';
while($myrow = $xoopsDB->fetchArray($result)) {
	$title = $myts->htmlSpecialChars($myrow['title']);
	if ($myrow['imgurl'] && $myrow['imgurl'] != 'http://'){
		$imgurl = $myts->htmlSpecialChars($myrow['imgurl']);
	} else {
		$imgurl = '';
	}
	$totaldownload = getTotalItems($myrow['cid'], 1);
	$content .= $title.' ';

	// get child category objects
	$arr = array();
	if(in_array($myrow['cid'], $categories)) {
		$arr = $mytree->getFirstChild($myrow['cid'], 'title');
		$space = 0;
		$chcount = 0;
		$subcategories = '';
		foreach($arr as $ele){
			if(in_array($ele['cid'], $categories)) {
				$chtitle=$myts->htmlSpecialChars($ele['title']);
				if ($chcount>5){
					$subcategories .= '...';
					break;
				}
				if ($space>0) {
					$subcategories .= ', ';
				}
				$subcategories .= "<a href=\"".ICMS_URL."/modules/mydownloads/viewcat.php?cid=".$ele['cid']."\">".$chtitle.'</a>';
				$space++;
				$chcount++;
				$content .= $ele['title'].' ';
			}
		}
		$xoopsTpl->append('categories', array('image' => $imgurl, 'id' => $myrow['cid'], 'title' => $myts->htmlSpecialChars($myrow['title']), 'subcategories' => $subcategories, 'totaldownloads' => $totaldownload, 'count' => $count));
		$count++;
	}
}

$sql = 'SELECT COUNT(*) FROM '.$xoopsDB->prefix('mydownloads_downloads').' WHERE status > 0';
if(is_array($categories) && count($categories) > 0) {
	$sql .= ' AND cid IN ('.implode(',', $categories).') ';
}

list($numrows) = $xoopsDB->fetchRow($xoopsDB->query($sql));
$xoopsTpl->assign('lang_thereare', sprintf(_MD_THEREARE,$numrows));

$start = 0;
// Pager
$limit = $icmsModuleConfig['newdownloads'];
if(mydownloads_getmoduleoption('usepager') == 1) {
	if($numrows > $limit) {
		$start = isset($_GET['start']) ? intval($_GET['start']) : 0;
		include_once ICMS_ROOT_PATH.'/class/pagenav.php';
		$pagenav = new XoopsPageNav($numrows, $limit, $start, 'start');
		$xoopsTpl->assign('pagenav', $pagenav->renderNav());
	}
}

if ($icmsModuleConfig['useshots'] == 1) {
	$xoopsTpl->assign('shotwidth', $icmsModuleConfig['shotwidth']);
	$xoopsTpl->assign('tablewidth', $icmsModuleConfig['shotwidth'] + 10);
	$xoopsTpl->assign('show_screenshot', true);
	$xoopsTpl->assign('lang_noscreenshot', _MD_NOSHOTS);
}

if (is_object($xoopsUser) && $xoopsUser->isAdmin($icmsModule->mid())) {
	$isadmin = true;
} else {
	$isadmin = false;
}

$xoopsTpl->assign('module_name', $icmsModule->getVar('name'));
$xoopsTpl->assign('lang_description', _MD_DESCRIPTIONC);
$xoopsTpl->assign('lang_lastupdate', _MD_LASTUPDATEC);
$xoopsTpl->assign('lang_hits', _MD_HITSC);
$xoopsTpl->assign('lang_ratingc', _MD_RATINGC);
$xoopsTpl->assign('lang_email', _MD_EMAILC);
$xoopsTpl->assign('lang_ratethissite', _MD_RATETHISFILE);
$xoopsTpl->assign('lang_reportbroken', _MD_REPORTBROKEN);
$xoopsTpl->assign('lang_tellafriend', _MD_TELLAFRIEND);
$xoopsTpl->assign('lang_modify', _MD_MODIFY);
$xoopsTpl->assign('lang_version' , _MD_VERSION);
$xoopsTpl->assign('lang_subdate' , _MD_SUBMITDATE);
$xoopsTpl->assign('lang_dlnow' , _MD_DLNOW);
$xoopsTpl->assign('lang_category' , _MD_CATEGORYC);
$xoopsTpl->assign('lang_size' , _MD_FILESIZE);
$xoopsTpl->assign('lang_platform' , _MD_SUPPORTEDPLAT);
$xoopsTpl->assign('lang_homepage' , _MD_HOMEPAGE);
$xoopsTpl->assign('lang_latestlistings' , _MD_LATESTLIST);
$xoopsTpl->assign('lang_comments' , _COMMENTS);
$tblsort = array();
$tblsort[1]='date DESC';
$tblsort[2]='date ASC';
$tblsort[3]='hits DESC';
$tblsort[4]='hits ASC';
$tblsort[5]='rating DESC';
$tblsort[6]='rating ASC';
$sortorder = isset($icmsModuleConfig['toporder']) ? $icmsModuleConfig['toporder'] : 1;
$orderby = $tblsort[$sortorder];

$sql = "SELECT d.lid, d.cid, d.title, d.url, d.homepage, d.version, d.size, d.platform, d.logourl, d.status, d.date, d.hits, d.rating, d.votes, d.comments, t.description FROM ".$xoopsDB->prefix('mydownloads_downloads').' d, '.$xoopsDB->prefix('mydownloads_text')." t WHERE d.status>0 AND d.lid=t.lid ";
if(is_array($categories) && count($categories) > 0) {
	$sql .= ' AND d.cid IN ('.implode(',', $categories).') ';
}
$sql .= "ORDER BY $orderby";

$result = $xoopsDB->query($sql, $icmsModuleConfig['newdownloads'], $start);
while(list($lid, $cid, $dtitle, $url, $homepage, $version, $size, $platform, $logourl, $status, $time, $hits, $rating, $votes, $comments, $description)=$xoopsDB->fetchRow($result)) {
	$path = $mytree->getPathFromId($cid, 'title');
	$path = substr($path, 1);
	$path = str_replace("/"," <img src='".ICMS_URL."/modules/mydownloads/images/arrow.gif' board='0' alt=''> ",$path);
	$rating = number_format($rating, 2);
	$dtitle = $myts->htmlSpecialChars($dtitle);
	$url = $myts->htmlSpecialChars($url);
	$homepage = $myts->htmlSpecialChars($homepage);
	$version = $myts->htmlSpecialChars($version);
	$size = PrettySize($myts->htmlSpecialChars($size));
	$platform = $myts->htmlSpecialChars($platform);
	$logourl = $myts->htmlSpecialChars($logourl);
	$datetime = formatTimestamp($time,'s');
	$description = $myts->displayTarea($description,1); //no html
	$new = newdownloadgraphic($time, $status);
	$pop = popgraphic($hits);
	if ($isadmin) {
		$adminlink = '<a href="'.ICMS_URL.'/modules/mydownloads/admin/index.php?lid='.$lid.'&fct=mydownloads&op=modDownload" title="'._MD_EDITTHISDL.'"><img src="'.ICMS_URL.'/modules/mydownloads/images/editicon.gif" border="0" alt="'._MD_EDITTHISDL.'" /></a>';
	} else {
		$adminlink = '';
	}
	if ($votes == 1) {
		$votestring = _MD_ONEVOTE;
	} else {
		$votestring = sprintf(_MD_NUMVOTES,$votes);
	}
		$xoopsTpl->append('file', array('id' => $lid,'cid'=>$cid,'rating' => $rating,'title' => $dtitle.$new.$pop,'logourl' => $logourl,'updated' => $datetime,'description' => $description,'adminlink' => $adminlink,'hits' => $hits,'votes' => $votestring, 'comments' => $comments, 'platform' => $platform,'size'  => $size,'homepage' => $homepage,'version'  => $version,'category'  => $path,'lang_dltimes' => sprintf(_MD_DLTIMES,$hits),'mail_subject' => rawurlencode(sprintf(_MD_INTFILEFOUND,$icmsConfig['sitename'])),'mail_body' => rawurlencode(sprintf(_MD_INTFILEFOUND,$icmsConfig['sitename']).':  '.ICMS_URL.'/modules/mydownloads/singlefile.php?cid='.$cid.'&amp;lid='.$lid)));
}
$xoopsTpl->assign('shotsuploadfolderpath', $icmsModuleConfig['shotsuploadfolderpath']);
$xoopsTpl->assign('shotsuploadfolderurl', $icmsModuleConfig['shotsuploadfolderurl']);

// Hack made by Herv� Thouzard (http://www.herve-thouzard.com)
mydownloads_create_meta_keywords($content);
mydownloads_create_meta_description($icmsModule->name());
// End Hack

include ICMS_ROOT_PATH.'/modules/mydownloads/footer.php';
?>