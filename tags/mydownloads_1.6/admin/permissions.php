<?php
/**
 * ****************************************************************************
 * mydownloads - MODULE FOR XOOPS
 * author of this script : Hervé Thouzard of Instant Zero (http://www.instant-zero.com)
 * Created on 13 juin 08 15:31:22
 * Version : $Id$
 * ****************************************************************************
 */
include_once '../../../include/cp_header.php';
include_once XOOPS_ROOT_PATH.'/class/xoopstopic.php';
include_once XOOPS_ROOT_PATH.'/class/xoopslists.php';
include_once XOOPS_ROOT_PATH.'/class/xoopsform/grouppermform.php';
include_once XOOPS_ROOT_PATH.'/modules/mydownloads/admin/functions.php';

xoops_cp_header();
if ( file_exists('../language/'.$xoopsConfig['language'].'/main.php') ) {
	include_once '../language/'.$xoopsConfig['language'].'/main.php';
} else {
	include_once ''; '../language/english/main.php';
}

mydnl_adminMenu(6);
echo '<br /><br /><br />';
$permission = isset($_POST['permission']) ? intval($_POST['permission']) : 1;
$selected = array('','');
$selected[$permission - 1]= ' selected';

echo "<form method='post' name='fselperm' action='permissions.php'><table border='0'><tr><td><select name='permission' onChange='javascript: document.fselperm.submit()'><option value='1'".$selected[0].">"._MD_PERM_VIEW."</option><option value='2'".$selected[1].">"._MD_PERM_SUBMIT."</option></select></td></tr><tr><td><input type='submit' name='go'></tr></table></form>";

$moduleId = $xoopsModule->getVar('mid');

switch($permission) {
	case 1:	// View permission
		$formTitle = _MD_PERM_VIEW;
		$permissionName = 'mydownloads_view';
		$permissionDescription = _MD_PERM_VIEW_DSC;
		break;
	case 2:	// Submit Permission
		$formTitle = _MD_PERM_SUBMIT;
		$permissionName = 'mydownloads_submit';
		$permissionDescription = _MD_PERM_SUBMIT_DSC;
		break;
}

$permissionsForm = new XoopsGroupPermForm($formTitle, $moduleId, $permissionName, $permissionDescription);

$sql = 'SELECT cid, pid, title FROM '.$xoopsDB->prefix('mydownloads_cat').' ORDER BY title';
$result = $xoopsDB->query($sql);
if($result) {
	while ($row = $xoopsDB->fetchArray($result)) {
		$permissionsForm->addItem($row['cid'], $row['title'], $row['pid']);
	}
}
echo $permissionsForm->render();
echo "<br /><br /><br /><br />\n";
unset ($permissionsForm);

xoops_cp_footer();
?>
