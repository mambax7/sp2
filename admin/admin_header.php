<?php

/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * Module: soapbox8
 *
 * @category        Module
 * @package         soapbox8
 * @author          XOOPS Development Team <name@site.com> - <http://xoops.org>
 * @copyright       {@link http://xoops.org/ XOOPS Project}
 * @license         GPL 2.0 or later
 * @link            http://xoops.org/
 * @since           1.0.0
 */

use Xmf\Request;

$path = dirname(dirname(dirname(__DIR__)));
require_once $path . '/include/cp_header.php';
require_once $path . '/class/xoopsformloader.php';

require __DIR__ . '/../class/utility.php';

if (!isset($moduleDirName)) {
    $moduleDirName = basename(dirname(__DIR__));
}
if (false !== ($moduleHelper = Xmf\Module\Helper::getHelper($moduleDirName))) {
} else {
    $moduleHelper = Xmf\Module\Helper::getHelper('system');
}
$adminObject = \Xmf\Module\Admin::getInstance();

$pathIcon16    = \Xmf\Module\Admin::iconUrl('', 16);
$pathIcon32    = \Xmf\Module\Admin::iconUrl('', 32);
$pathModIcon32 = $moduleHelper->getModule()->getInfo('modicons32');

/** @var XoopsObjectHandler $sbcolumnsHandler */
$sbcolumnsHandler = xoops_getModuleHandler('sbcolumns', $moduleDirName);
/** @var XoopsObjectHandler $sbarticlesHandler */
$sbarticlesHandler = xoops_getModuleHandler('sbarticles', $moduleDirName);
/** @var XoopsObjectHandler $sbvotedataHandler */
$sbvotedataHandler = xoops_getModuleHandler('sbvotedata', $moduleDirName);
/** @var XoopsObjectHandler $testHandler */
$testHandler = xoops_getModuleHandler('test', $moduleDirName);

$myts = MyTextSanitizer::getInstance();
if (!isset($xoopsTpl) || !is_object($xoopsTpl)) {
    require_once XOOPS_ROOT_PATH . '/class/template.php';
    $xoopsTpl = new XoopsTpl();
}
/*
// System icons path
$xoopsTpl->assign('sysPathIcon16', $pathIcon16);
$xoopsTpl->assign('sysPathIcon32', $pathIcon32);
// Local icons path
$xoopsTpl->assign('modPathIcon16', $pathModIcon16);
$xoopsTpl->assign('modPathIcon32', $pathModIcon32);
*/

// Load language files
$moduleHelper->loadLanguage('admin');
$moduleHelper->loadLanguage('modinfo');
$moduleHelper->loadLanguage('main');

//xoops_cp_header();
