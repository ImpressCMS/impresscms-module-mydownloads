<?php
// $Id: functions.php,v 1.10 2004/12/26 19:11:56 onokazu Exp $
//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <http://www.xoops.org/>                             //
//  ------------------------------------------------------------------------ //
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

function mainheader($mainlink=1) {
		echo "<br /><br /><p><a href=\"".ICMS_URL."/modules/mydownloads/index.php\"><img src=\"".ICMS_URL."/modules/mydownloads/images/logo-en.gif\" border=\"0\" alt\"\" /></a></p><br /><br />";
}

function newdownloadgraphic($time, $status) {
	global $icmsModuleConfig;
	$count = 7;
	$new = '';
	$startdate = (time()-(86400 * $count));
	if($icmsModuleConfig['showupdated'] == 1) {
		if ($startdate < $time) {
			if($status==1) {
				$new = "&nbsp;<img src=\"".ICMS_URL."/modules/mydownloads/images/newred.gif\" alt=\""._MD_NEWTHISWEEK."\" />";
			} elseif($status==2) {
				$new = "&nbsp;<img src=\"".ICMS_URL."/modules/mydownloads/images/update.gif\" alt=\""._MD_UPTHISWEEK."\" />";
			}
		}
	}
	return $new;
}

function popgraphic($hits) {
	global $icmsModuleConfig;
	if ($hits >= $icmsModuleConfig['popular']) {
		return "&nbsp;<img src =\"".ICMS_URL."/modules/mydownloads/images/pop.gif\" alt=\""._MD_POPULAR."\" />";
	}
	return '';
}
//Reusable Link Sorting Functions
function convertorderbyin($orderby) {
	switch (trim($orderby)) {
	case "titleA":
		$orderby = "title ASC";
		break;
	case "dateA":
		$orderby = "date ASC";
		break;
	case "hitsA":
		$orderby = "hits ASC";
		break;
	case "ratingA":
		$orderby = "rating ASC";
		break;
	case "titleD":
		$orderby = "title DESC";
		break;
	case "hitsD":
		$orderby = "hits DESC";
		break;
	case "ratingD":
		$orderby = "rating DESC";
		break;
	case"dateD":
	default:
		$orderby = "date DESC";
		break;
	}
	return $orderby;
}
function convertorderbytrans($orderby) {
	if ($orderby == "hits ASC")   $orderbyTrans = _MD_POPULARITYLTOM;
	if ($orderby == "hits DESC")    $orderbyTrans = _MD_POPULARITYMTOL;
	if ($orderby == "title ASC")    $orderbyTrans = _MD_TITLEATOZ;
	if ($orderby == "title DESC")   $orderbyTrans = _MD_TITLEZTOA;
	if ($orderby == "date ASC") $orderbyTrans = _MD_DATEOLD;
	if ($orderby == "date DESC")   $orderbyTrans = _MD_DATENEW;
	if ($orderby == "rating ASC")  $orderbyTrans = _MD_RATINGLTOH;
	if ($orderby == "rating DESC") $orderbyTrans = _MD_RATINGHTOL;
	return $orderbyTrans;
}
function convertorderbyout($orderby) {
	if ($orderby == "title ASC")            $orderby = "titleA";
	if ($orderby == "date ASC")            $orderby = "dateA";
	if ($orderby == "hits ASC")          $orderby = "hitsA";
	if ($orderby == "rating ASC")        $orderby = "ratingA";
	if ($orderby == "title DESC")              $orderby = "titleD";
	if ($orderby == "date DESC")            $orderby = "dateD";
	if ($orderby == "hits DESC")          $orderby = "hitsD";
	if ($orderby == "rating DESC")        $orderby = "ratingD";
	return $orderby;
}

function PrettySize($size) {
	if($size>0) {
		$mb = 1024*1024;
		if ( $size > $mb ) {
			$mysize = sprintf ("%01.2f",$size/$mb) . " MB";
		}
		elseif ( $size >= 1024 ) {
			$mysize = sprintf ("%01.2f",$size/1024) . " KB";
		}
		else {
		    $mysize = sprintf(_MD_NUMBYTES,$size);
		}
		return $mysize;
	} else {
		return '';
	}
}

//updates rating data in itemtable for a given item
function updaterating($sel_id){
	global $xoopsDB;
	$query = "select rating FROM ".$xoopsDB->prefix("mydownloads_votedata")." WHERE lid = ".intval($sel_id)."";
	$voteresult = $xoopsDB->query($query);
		$votesDB = $xoopsDB->getRowsNum($voteresult);
	$totalrating = 0;
		while(list($rating)=$xoopsDB->fetchRow($voteresult)){
		$totalrating += $rating;
	}
	$finalrating = $totalrating/$votesDB;
	$finalrating = number_format($finalrating, 4);
	$sql = sprintf("UPDATE %s SET rating = %u, votes = %u WHERE lid = %u", $xoopsDB->prefix('mydownloads_downloads'), $finalrating, $votesDB, $sel_id);
	$xoopsDB->query($sql);
}

//returns the total number of items in items table that are accociated with a given table $table id
function getTotalItems($sel_id, $status=""){
	global $xoopsDB, $mytree;
	$categories = mydownloads_MygetItemIds();
	$count = 0;
	$arr = array();
	if(in_array($sel_id, $categories)) {
		$query = "select count(*) from ".$xoopsDB->prefix('mydownloads_downloads')." where cid=".intval($sel_id)."";
		if($status!=""){
			$query .= " and status>=$status";
		}
		$result = $xoopsDB->query($query);
		list($thing) = $xoopsDB->fetchRow($result);
		$count = $thing;
		$arr = $mytree->getAllChildId($sel_id);
		$size = count($arr);
		for($i=0;$i<$size;$i++){
			if(in_array($arr[$i], $categories)) {
				$query2 = "select count(*) from ".$xoopsDB->prefix('mydownloads_downloads')." where cid=".intval($arr[$i])."";
				if($status!=""){
					$query2 .= " and status>=$status";
				}
				$result2 = $xoopsDB->query($query2);
				list($thing) = $xoopsDB->fetchRow($result2);
				$count += $thing;
			}
		}
	}
	return $count;
}

/**
 * Create the page's title
 *
 * @package Xoops
 * @author Herv� Thouzard (http://www.herve-thouzard.com)
 * @copyright Herv� Thouzard
*/
function mydownloads_create_page_title($article = '', $topic = '')
{
	global $icmsModule, $xoopsTpl;
	$myts =& MyTextSanitizer::getInstance();
	$content='';
	if(!empty($article)) $content .= strip_tags($myts->displayTarea($article));
	if(!empty($topic)) {
		if(xoops_trim($content)!='') {
			$content .= ' - '.strip_tags($myts->displayTarea($topic));
		} else {
			$content .= strip_tags($myts->displayTarea($topic));		// ttmlSpecialChars
		}
	}
	if(is_object($icmsModule) && xoops_trim($icmsModule->name())!='') {
		if(xoops_trim($content)!='') {
			$content.=' - '.strip_tags($myts->displayTarea($icmsModule->name()));
		} else {
			$content.=strip_tags($myts->displayTarea($icmsModule->name()));
		}
	}
	if($content!='') {
		$xoopsTpl->assign('xoops_pagetitle', $content);
	}
}


/**
 * Create the meta description based on the content
 *
 * @package Xoops
 * @author Herv� Thouzard (http://www.herve-thouzard.com)
 * @copyright Herv� Thouzard
*/
function mydownloads_create_meta_description($content)
{
	global $xoopsTpl, $xoTheme;
	$myts =& MyTextSanitizer::getInstance();
	$content= $myts->undoHtmlSpecialChars($myts->displayTarea($content));
	if(isset($xoTheme) && is_object($xoTheme)) {
		$xoTheme->addMeta( 'meta', 'description', strip_tags($content));
	} else {	// Compatibility for old Xoops versions
		$xoopsTpl->assign('xoops_meta_description', strip_tags($content));
	}
}


/**
 * Create the meta keywords based on the content
 *
 * @package Xoops
 * @author Herv� Thouzard (http://www.herve-thouzard.com)
 * @copyright Herv� Thouzard
*/
function mydownloads_create_meta_keywords($content)
{
	// Parameters you can change **********************************************************
	$method = 1;			// Method to use
							// 1=Create keywords in the same order as in the text
							// 2=Keywords order is made according to the reverse keywords frequency
							// (so the less frequent words appear in first in the list)
							// 3=Same as previous, the only difference is that the most frequent
							// words will appear in first in the list
	$keywords_count = 40;	// Number of keywords to create
	// ************************************************************************************
	global $xoopsTpl, $xoTheme;
	$tmp=array();
	if(isset($_SESSION['xoops_keywords_limit'])) {		// Search the "Minimum keyword length"
		$limit = $_SESSION['xoops_keywords_limit'];
	} else {
		$config_handler =& xoops_gethandler('config');
		$icmsConfigSearch =& $config_handler->getConfigsByCat(ICMS_CONF_SEARCH);
		$limit=$icmsConfigSearch['keyword_min'];
		$_SESSION['xoops_keywords_limit']=$limit;
	}
	$myts =& MyTextSanitizer::getInstance();
	$content = str_replace ("<br />", " ", $content);
	$content= $myts->undoHtmlSpecialChars($content);
	$content= strip_tags($content);
	$content=strtolower($content);
	$search_pattern=array("&nbsp;","\t","\r\n","\r","\n",",",".","'",";",":",")","(",'"','?','!','{','}','[',']','<','>','/','+','-','_','\\','*');
	$replace_pattern=array(' ',' ',' ',' ',' ',' ',' ',' ','','','','','','','','','','','','','','','','','','','');
	$content = str_replace($search_pattern, $replace_pattern, $content);
	$keywords=explode(' ',$content);
	switch($method) {
		case 1:	// Returns keywords in the same order that they were created in the text
			$keywords=array_unique($keywords);
			break;

		case 2:	// the keywords order is made according to the reverse keywords frequency (so the less frequent words appear in first in the list)
			$keywords=array_count_values($keywords);
			asort($keywords);
			$keywords=array_keys($keywords);
			break;

		case 3:	// Same as previous, the only difference is that the most frequent words will appear in first in the list
			$keywords=array_count_values($keywords);
			arsort($keywords);
			$keywords=array_keys($keywords);
			break;
	}

	foreach($keywords as $keyword) {
		if(strlen($keyword)>=$limit && !is_numeric($keyword)) {
			$tmp[]=$keyword;
		}
	}
	$tmp=array_slice($tmp,0,$keywords_count);
	if(count($tmp)>0) {
		if(isset($xoTheme) && is_object($xoTheme)) {
			$xoTheme->addMeta( 'meta', 'keywords', implode(',',$tmp));
		} else {	// Compatibility for old Xoops versions
			$xoopsTpl->assign('xoops_meta_keywords', implode(',',$tmp));
		}
	} else {
		if(!isset($config_handler) || !is_object($config_handler)) {
			$config_handler =& xoops_gethandler('config');
		}
		$xoopsConfigMetaFooter =& $config_handler->getConfigsByCat(ICMS_CONF_METAFOOTER);
		if(isset($xoTheme) && is_object($xoTheme)) {
			$xoTheme->addMeta( 'meta', 'keywords', $xoopsConfigMetaFooter['meta_keywords']);
		} else {	// Compatibility for old Xoops versions
			$xoopsTpl->assign('xoops_meta_keywords', $xoopsConfigMetaFooter['meta_keywords']);
		}
	}
}


/**
 * Returns a module's option
 *
 * Return's a module's option (for the mydownloads module)
 * @param string $option	module option's name
 */
function mydownloads_getmoduleoption($option, $repmodule='mydownloads')
{
	global $icmsModuleConfig, $icmsModule;
	static $tbloptions= Array();
	if(is_array($tbloptions) && array_key_exists($option,$tbloptions)) {
		return $tbloptions[$option];
	}

	$retval = false;
	if (isset($icmsModuleConfig) && (is_object($icmsModule) && $icmsModule->getVar('dirname') == $repmodule && $icmsModule->getVar('isactive'))) {
		if(isset($icmsModuleConfig[$option])) {
			$retval= $icmsModuleConfig[$option];
		}
	} else {
		$module_handler =& xoops_gethandler('module');
		$module =& $module_handler->getByDirname($repmodule);
		$config_handler =& xoops_gethandler('config');
		if ($module) {
		    $moduleConfig =& $config_handler->getConfigsByCat(0, $module->getVar('mid'));
	    	if(isset($moduleConfig[$option])) {
	    		$retval= $moduleConfig[$option];
	    	}
		}
	}
	$tbloptions[$option]=$retval;
	return $retval;
}


/**
 * Retreive an editor according to the module's option "form_options"
 */
function &mydownloads_getWysiwygForm($caption, $name, $value = '', $width = '100%', $height = '400px', $supplemental='')
{
	$editor = false;
	$x22=false;
	$xv=str_replace('XOOPS ','',XOOPS_VERSION);
	if(substr($xv,2,1)=='2') {
		$x22=true;
	}
	$editor_configs=array();
	$editor_configs['name'] =$name;
	$editor_configs['value'] = $value;
	$editor_configs['rows'] = 35;
	$editor_configs['cols'] = 60;
	$editor_configs['width'] = $width;
	$editor_configs['height'] = $height;


	switch(strtolower(mydownloads_getmoduleoption('form_options'))) {
		case 'spaw':
			if(!$x22) {
				if (is_readable(ICMS_ROOT_PATH . '/class/spaw/formspaw.php'))	{
					include_once(ICMS_ROOT_PATH . '/class/spaw/formspaw.php');
					$editor = new XoopsFormSpaw($caption, $name, $value);
				}
			} else {
				$editor = new XoopsFormEditor($caption, 'spaw', $editor_configs);
			}
			break;

		case 'fck':
			if(!$x22) {
				if ( is_readable(ICMS_ROOT_PATH . '/class/fckeditor/formfckeditor.php'))	{
					include_once(ICMS_ROOT_PATH . '/class/fckeditor/formfckeditor.php');
					$editor = new XoopsFormFckeditor($caption, $name, $value);
				}
			} else {
				$editor = new XoopsFormEditor($caption, 'fckeditor', $editor_configs);
			}
			break;

		case 'htmlarea':
			if(!$x22) {
				if ( is_readable(ICMS_ROOT_PATH . '/class/htmlarea/formhtmlarea.php'))	{
					include_once(ICMS_ROOT_PATH . '/class/htmlarea/formhtmlarea.php');
					$editor = new XoopsFormHtmlarea($caption, $name, $value);
				}
			} else {
				$editor = new XoopsFormEditor($caption, 'htmlarea', $editor_configs);
			}
			break;

		case 'dhtml':
			if(!$x22) {
				$editor = new XoopsFormDhtmlTextArea($caption, $name, $value, 10, 50, $supplemental);
			} else {
				$editor = new XoopsFormEditor($caption, 'dhtmltextarea', $editor_configs);
			}
			break;

		case 'textarea':
			$editor = new XoopsFormTextArea($caption, $name, $value);
			break;

		case 'tinyeditor':
			if ( is_readable(ICMS_ROOT_PATH.'/class/xoopseditor/tinyeditor/formtinyeditortextarea.php')) {
				include_once ICMS_ROOT_PATH.'/class/xoopseditor/tinyeditor/formtinyeditortextarea.php';
				$editor = new XoopsFormTinyeditorTextArea(array('caption'=> $caption, 'name'=>$name, 'value'=>$value, 'width'=>$width, 'height'=>$height));
			}
			break;

		case 'koivi':
			if(!$x22) {
				if ( is_readable(ICMS_ROOT_PATH . '/class/wysiwyg/formwysiwygtextarea.php')) {
					include_once(ICMS_ROOT_PATH . '/class/wysiwyg/formwysiwygtextarea.php');
					$editor = new XoopsFormWysiwygTextArea($caption, $name, $value, $width, $height, '');
				}
			} else {
				$editor = new XoopsFormEditor($caption, 'koivi', $editor_configs);
			}
			break;
		}
		return $editor;
}

/**
 * Create (in a link) a javascript confirmation's box
 *
 * @author Instant Zero http://www.instant-zero.com
 * @copyright	(c) Instant Zero http://www.instant-zero.com
 *
 * @param string $msg	Le message � afficher
 * @param boolean $form	Est-ce une confirmation pour un formulaire ?
 * @return string La "commande" javscript � ins�rer dans le lien
 */
function mydownloads_JavascriptLinkConfirm($msg, $form = false)
{
	if(!$form) {
		return "onclick=\"javascript:return confirm('".str_replace("'"," ",$msg)."')\"";
	} else {
		return "onSubmit=\"javascript:return confirm('".str_replace("'"," ",$msg)."')\"";
	}
}


/**
 * Function used to create a unique name for an uploaded file
 */
function mydownloads_createUploadName($folder, $filename, $trimname = false)
{
	global $icmsModuleConfig;
	if($icmsModuleConfig['renamefiles'] == 0) {
		if(substr($folder,-1,1) != '/') {
			$fullFilename = $folder.'/'.$filename;
		} else {
			$fullFilename =	$folder.$filename;
		}
		if(file_exists($fullFilename)) {
			redirect_header('index.php', 5, "ERROR, a file with this filename already exists, your file is not added");
			exit();
		}
		return $filename;
	}
	$workingfolder = $folder;
	if(xoops_substr($workingfolder,strlen($workingfolder)-1,1)<>'/') {
		$workingfolder.='/';
	}
	$ext = basename($filename);
	$ext = explode('.', $ext);
	$ext = '.'.$ext[count($ext)-1];
	$true = true;
	while($true) {
		$ipbits = explode('.', $_SERVER['REMOTE_ADDR']);
		list($usec, $sec) = explode(' ',microtime());
		$usec = (integer) ($usec * 65536);
		$sec = ((integer) $sec) & 0xFFFF;

		if($trimname) {
			$uid = sprintf("%06x%04x%04x",($ipbits[0] << 24) | ($ipbits[1] << 16) | ($ipbits[2] << 8) | $ipbits[3], $sec, $usec);
		} else {
			$uid = sprintf("%08x-%04x-%04x",($ipbits[0] << 24) | ($ipbits[1] << 16) | ($ipbits[2] << 8) | $ipbits[3], $sec, $usec);
		}
       	if(!file_exists($workingfolder.$uid.$ext)) {
       		$true = false;
       	}
	}
	return $uid.$ext;
}

/**
 * Internal function for permissions
 *
 * Returns a list of all the permitted categories Ids for the current user
 *
 * @param string	$permtype	The type of permission
 * @return array Permitted categories Ids
 *
 * @package News
 * @author Herv� Thouzard of Instant Zero (http://xoops.instant-zero.com)
 * @copyright (c) Instant Zero
 */
function mydownloads_MygetItemIds($permtype = 'mydownloads_view')
{
	global $xoopsUser;
	static $permissions = array();
	if(is_array($permissions) && array_key_exists($permtype, $permissions)) {
		return $permissions[$permtype];
	}

   	$module_handler =& xoops_gethandler('module');
   	$mydownloadsModule =& $module_handler->getByDirname('mydownloads');
   	$groups = is_object($xoopsUser) ? $xoopsUser->getGroups() : XOOPS_GROUP_ANONYMOUS;
   	$gperm_handler =& xoops_gethandler('groupperm');
   	$categories = $gperm_handler->getItemIds($permtype, $groups, $mydownloadsModule->getVar('mid'));
   	$permissions[$permtype] = $categories;
    return $categories;
}
?>