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

use Xmf\Language;
use Xmf\Module\Helper;

require_once dirname(dirname(__DIR__)) . '/mainfile.php';
require_once XOOPS_ROOT_PATH . '/header.php';
if (!isset($moduleDirName)) {
    $moduleDirName = basename(__DIR__);
}
$moduleHelper = Helper::getHelper($moduleDirName);

$modulePath = XOOPS_ROOT_PATH . '/modules/' . $moduleDirName;
require_once __DIR__ . '/include/config.php';
require_once __DIR__ . '/class/utility.php';

$myts       = MyTextSanitizer::getInstance();
$stylesheet = "modules/{$moduleDirName}/assets/css/style.css";
if (file_exists($GLOBALS['xoops']->path($stylesheet))) {
    $GLOBALS['xoTheme']->addStylesheet($GLOBALS['xoops']->url("www/{$stylesheet}"));
}
/** @var XoopsObjectHandler $sbcolumnsHandler */
$sbcolumnsHandler = xoops_getModuleHandler('sbcolumns', $moduleDirName);
/** @var XoopsObjectHandler $sbarticlesHandler */
$sbarticlesHandler = xoops_getModuleHandler('sbarticles', $moduleDirName);
/** @var XoopsObjectHandler $sbvotedataHandler */
$sbvotedataHandler = xoops_getModuleHandler('sbvotedata', $moduleDirName);
/** @var XoopsObjectHandler $testHandler */
$testHandler = xoops_getModuleHandler('test', $moduleDirName);

// Load language files
Language::load('modinfo', $moduleDirName);
Language::load('main', $moduleDirName);
