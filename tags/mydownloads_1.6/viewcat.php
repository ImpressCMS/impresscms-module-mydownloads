<?php
// $Id: viewcat.php,v 1.17 2004/12/26 19:11:56 onokazu Exp $
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
include_once XOOPS_ROOT_PATH."/class/xoopstree.php";
$xoopsOption['template_main'] = 'mydownloads_viewcat.html';
$myts =& MyTextSanitizer::getInstance();// MyTextSanitizer object
$mytree = new XoopsTree($xoopsDB->prefix('mydownloads_cat'), 'cid', 'pid');

$cid = isset($_GET['cid']) ? intval($_GET['cid']) : 0;

$categories = mydownloads_MygetItemIds();
if(is_array($categories) && count($categories) > 0) {
	if(!in_array($cid, $categories)) {
		redirect_header(XOOPS_URL.'/modules/mydownloads/index.php', 3, _NOPERM);
		exit();
	}
} else {	// User can't see any category
	redirect_header(XOOPS_URL.'/index.php', 3, _NOPERM);
	exit();
}

$cidsav = $cid;
include XOOPS_ROOT_PATH."/header.php";

if (isset($_GET['show']) && $_GET['show']!="") {
	$show = intval($_GET['show']);
} else {
	$show = $xoopsModuleConfig['perpage'];
}
$min = isset($_GET['min']) ? intval($_GET['min']) : 0;
if (!isset($max)) {
	$max = $min + $show;
}
if(isset($_GET['orderby'])) {
	$orderby = convertorderbyin($_GET['orderby']);
} else {
	$orderby = 'title ASC';
}

$content='';
$pathstring = "<a href='index.php'>".$xoopsModule->name()."</a>&nbsp;:&nbsp;";
$pathstring .= $mytree->getNicePathFromId($cid, 'title', 'viewcat.php?op=');
$xoopsTpl->assign('module_name', $xoopsModule->getVar('name'));
$xoopsTpl->assign('category_path', $pathstring);
$xoopsTpl->assign('category_id', $cid);
// get child category objects
$arr = array();
$arr = $mytree->getFirstChild($cid, "title");
if ( count($arr) > 0 ) {
	$scount = 1;
	foreach($arr as $ele){
		if(in_array($ele['cid'], $categories)) {
			$sub_arr = array();
			$sub_arr = $mytree->getFirstChild($ele['cid'], 'title');
			$space = 0;
			$chcount = 0;
			$infercategories = "";
			foreach($sub_arr as $sub_ele){
				$chtitle = $myts->htmlSpecialChars($sub_ele['title']);
				if ($chcount>5){
					$infercategories .= "...";
					break;
				}
				if ($space>0) {
					$infercategories .= ", ";
				}
				$infercategories .= "<a href=\"".XOOPS_URL."/modules/mydownloads/viewcat.php?cid=".$sub_ele['cid']."\">".$chtitle."</a>";
				$space++;
				$chcount++;
			}
			$xoopsTpl->append('subcategories', array('title' => $myts->htmlSpecialChars($ele['title']), 'id' => $ele['cid'], 'infercategories' => $infercategories, 'totallinks' => getTotalItems($ele['cid'], 1), 'count' => $scount));
			$scount++;
		}
	}
}

if ($xoopsModuleConfig['useshots'] == 1) {
	$xoopsTpl->assign('shotwidth', $xoopsModuleConfig['shotwidth']);
	$xoopsTpl->assign('tablewidth', $xoopsModuleConfig['shotwidth'] + 10);
	$xoopsTpl->assign('show_screenshot', true);
	$xoopsTpl->assign('lang_noscreenshot', _MD_NOSHOTS);
}

if (!empty($xoopsUser) && $xoopsUser->isAdmin($xoopsModule->mid())) {
	$isadmin = true;
} else {
	$isadmin = false;
}
$summary = '';
$sql = 'SELECT COUNT(*) FROM '.$xoopsDB->prefix('mydownloads_downloads')." WHERE cid=$cid AND status>0";
$fullcountresult = $xoopsDB->query($sql);
list($numrows) = $xoopsDB->fetchRow($fullcountresult);
$page_nav = '';
if($numrows>0){
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
	$xoopsTpl->assign('lang_comments' , _COMMENTS);
	$xoopsTpl->assign('show_links', true);
	$q = "SELECT d.lid, d.title, d.url, d.homepage, d.version, d.size, d.platform, d.logourl, d.status, d.date, d.hits, d.rating, d.votes, d.comments, t.description FROM ".$xoopsDB->prefix('mydownloads_downloads')." d, ".$xoopsDB->prefix('mydownloads_text')." t WHERE cid=".$cid." AND d.status>0 AND d.lid=t.lid ORDER BY ".$orderby."";
	$result = $xoopsDB->query($q,$show,$min);

//if 2 or more items in result, show the sort menu
	if($numrows>1){
		$xoopsTpl->assign('show_nav', true);
		$orderbyTrans = convertorderbytrans($orderby);
		$xoopsTpl->assign('lang_sortby', _MD_SORTBY);
		$xoopsTpl->assign('lang_title', _MD_TITLE);
		$xoopsTpl->assign('lang_date', _MD_DATE);
		$xoopsTpl->assign('lang_rating', _MD_RATING);
		$xoopsTpl->assign('lang_popularity', _MD_POPULARITY);
		$xoopsTpl->assign('lang_cursortedby', sprintf(_MD_CURSORTBY, convertorderbytrans($orderby)));
	}
	// Hack Hervé (http://www.herve-thouzard.com)
	$cpt = 0;
	while(list($lid, $dtitle, $url, $homepage, $version, $size, $platform, $logourl, $status, $time, $hits, $rating, $votes, $comments, $description)=$xoopsDB->fetchRow($result)) {
		$path = $mytree->getPathFromId($cid, "title");
		$path = substr($path, 1);
		$path = str_replace("/"," <img src='".XOOPS_URL."/modules/mydownloads/images/arrow.gif' board='0' alt=''> ",$path);
		$rating = number_format($rating, 2);
		$dtitle = $myts->htmlSpecialChars($dtitle);
		$cpt++;
		// You can also point the download to its individual description
		//$summary .= "<a href='".XOOPS_URL.'/modules/mydownloads/singlefile.php?cid='.$cid.'&lid='.$lid."'>".$dtitle.'</a><br />';
		$summary .= "<a href='#l".$cpt."'>".$dtitle.'</a><br />';
		$url = $myts->htmlSpecialChars($url);
		$homepage = $myts->htmlSpecialChars($homepage);
		$version = $myts->htmlSpecialChars($version);
		$size = PrettySize($myts->htmlSpecialChars($size));
		$platform = $myts->htmlSpecialChars($platform);
		$logourl = $myts->htmlSpecialChars($logourl);
		$datetime = formatTimestamp($time,"s");
		$description = $myts->displayTarea($description,1); //no html
		$new = newdownloadgraphic($time, $status);
		$pop = popgraphic($hits);
		if ($isadmin) {
			$adminlink = '<a href="'.XOOPS_URL.'/modules/mydownloads/admin/index.php?lid='.$lid.'&amp;fct=mydownloads&amp;op=modDownload"><img src="'.XOOPS_URL.'/modules/mydownloads/images/editicon.gif" border="0" alt="'._MD_EDITTHISDL.'" /></a>';
		} else {
			$adminlink = '';
		}
		if ($votes == 1) {
			$votestring = _MD_ONEVOTE;
		} else {
			$votestring = sprintf(_MD_NUMVOTES,$votes);
		}
		$xoopsTpl->append('file', array('id' => $lid, 'cid' => $cid, 'rating' => $rating,'title' => $dtitle.$new.$pop,'logourl' => $logourl,'updated' => $datetime,'description' => $description,'adminlink' => $adminlink,'hits' => $hits,'votes' => $votestring, 'comments' => $comments, 'platform' => $platform,'size'  => $size,'homepage' => $homepage,'version'  => $version,'category'  => $path,'lang_dltimes' => sprintf(_MD_DLTIMES,$hits),'mail_subject' => rawurlencode(sprintf(_MD_INTFILEFOUND,$xoopsConfig['sitename'])),'mail_body' => rawurlencode(sprintf(_MD_INTFILEFOUND,$xoopsConfig['sitename']).':  '.XOOPS_URL.'/modules/mydownloads/singlefile.php?cid='.$cid.'&amp;lid='.$lid)));
		$content.=$dtitle.' ';
	}
	$orderby = convertorderbyout($orderby);
//Calculates how many pages exist.  Which page one should be on, etc...
	$downpages = ceil($numrows / $show);
//Page Numbering
	if ($downpages!=1 && $downpages!=0) {
		$prev = $min - $show;
		if ($prev>=0) {
			$page_nav .= "<a href='viewcat.php?cid=$cid&amp;min=$prev&amp;orderby=$orderby&amp;show=$show'><b><u>&laquo</u></b></a>&nbsp;";
		}
		$counter = 1;
		$currentpage = ($max / $show);
		while ( $counter<=$downpages ) {
			$mintemp = ($show * $counter) - $show;
			if ($counter == $currentpage) {
			$page_nav .= "<b>($counter)</b>&nbsp;";
			} else {
				$page_nav .= "<a href='viewcat.php?cid=$cid&amp;min=$mintemp&amp;orderby=$orderby&amp;show=$show'>$counter</a>&nbsp;";
			}
				$counter++;
		}
		if ( $numrows>$max ) {
			$page_nav .= "<a href='viewcat.php?cid=$cid&amp;min=$max&amp;orderby=$orderby&amp;show=$show'>";
				$page_nav .= "<b><u>&raquo;</u></b></a>";
		}
	}
}
$xoopsTpl->assign('page_nav', $page_nav);


// Hack made by Hervé Thouzard (http://www.herve-thouzard.com)
if($xoopsModuleConfig['autosummary']) {
	$xoopsTpl->assign('summary', $summary);
} else {
	$xoopsTpl->assign('summary', '');
}

$title='';
if($cidsav > 0) {
    $sql = 'SELECT title FROM '.$xoopsDB->prefix('mydownloads_cat')." t where cid=$cidsav";
    $result = $xoopsDB->query($sql,$show,$min);
	$myrow = $xoopsDB->fetchArray($result);
	$title = $myrow['title'];
}
$title = $myts->htmlSpecialChars($title);
$xoopsTpl->assign('category_title', $title);

$xoopsTpl->assign('shotsuploadfolderpath', $xoopsModuleConfig['shotsuploadfolderpath']);
$xoopsTpl->assign('shotsuploadfolderurl', $xoopsModuleConfig['shotsuploadfolderurl']);

mydownloads_create_page_title($title);
mydownloads_create_meta_description($title);
mydownloads_create_meta_keywords($content);
// End Hack
include XOOPS_ROOT_PATH."/modules/mydownloads/footer.php";
?>
