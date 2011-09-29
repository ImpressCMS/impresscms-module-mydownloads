<?php
// $Id: menu.php,v 1.8 2004/12/26 19:11:55 onokazu Exp $
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
$adminmenu[1]['title'] = _MI_MYDOWNLOADS_ADMENU1;
$adminmenu[1]['link'] = "admin/index.php";
$adminmenu[2]['title'] = _MI_MYDOWNLOADS_ADMENU2;
$adminmenu[2]['link'] = "admin/index.php?op=downloadsConfigMenu";
$adminmenu[3]['title'] = _MI_MYDOWNLOADS_ADMENU3;
$adminmenu[3]['link'] = "admin/index.php?op=listNewDownloads";
$adminmenu[4]['title'] = _MI_MYDOWNLOADS_ADMENU4;
$adminmenu[4]['link'] = "admin/index.php?op=listBrokenDownloads";
$adminmenu[5]['title'] = _MI_MYDOWNLOADS_ADMENU5;
$adminmenu[5]['link'] = "admin/index.php?op=listModReq";
$adminmenu[6]['title'] = _MI_MYDOWNLOADS_ADMENU6;
$adminmenu[6]['link'] = "admin/permissions.php";
?>