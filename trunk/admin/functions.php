<?php
/**
 * ****************************************************************************
 * mydownloads - MODULE FOR XOOPS
 * Copyright (c) Herv� Thouzard of Instant Zero (http://www.instant-zero.com)
 * Created on 10 nov. 07 at 17:17:51
 * ****************************************************************************
 */
 function mydnl_adminMenu($currentoption = 0, $breadcrumb = '')
{
	global $icmsConfig, $icmsModule;
if (file_exists(ICMS_ROOT_PATH . '/modules/mydownloads/language/' . $icmsConfig['language'] . '/modinfo.php' ) )
{
	include_once ICMS_ROOT_PATH . '/modules/mydownloads/language/' . $icmsConfig['language'] . '/modinfo.php';
}
else
{
	include_once ICMS_ROOT_PATH . '/modules/mydownloads/language/english/modinfo.php';
}
	global $adminmenu;
	include 'menu.php';

	echo "<div id=\"buttontop\">\n";
	echo "<table style=\"width: 100%; padding: 0; \" cellspacing=\"0\">\n";
	echo "<tr>\n";
	echo "<td style=\"width: 70%; font-size: 10px; text-align: left; color: #2F5376; padding: 0 6px; line-height: 18px;\">\n";
	echo "<a href=\"../index.php\">"._AM_MD_GO_TO_MODULE."</a> | <a href=\"".ICMS_URL."/modules/system/admin.php?fct=preferences&amp;op=showmod&amp;mod=".$icmsModule->getVar('mid')."\">"._PREFERENCES."</a>\n";
	echo "</td>\n";
	echo "<td style=\"width: 30%; font-size: 10px; text-align: right; color: #2F5376; padding: 0 6px; line-height: 18px;\">\n";
	echo "<b>".$icmsModule->getVar('name')."&nbsp;"._AM_MD_ADMINISTRATION."</b>&nbsp;".$breadcrumb."\n";
	echo "</td>\n";
	echo "</tr>\n";
	echo "</table>\n";
	echo "</div>\n";
	echo "<div id=\"buttonbar\">\n";
	echo "<ul>\n";
	foreach($GLOBALS['adminmenu'] as $key=>$link) {
		if($key == $currentoption) {
			echo "<li class=\"current\">\n";
		} else {
			echo "<li>\n";
		}
		echo "<a href=\"".ICMS_URL."/modules/mydownloads/".$link['link']."\"><span>".$link['title']."</span></a>\n";
		echo "</li>\n";
	}
	echo "</ul>\n";
	echo "</div>\n";
	echo "<br style=\"clear:both;\" />\n";
}
?>