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

$GLOBALS['xoopsOption']['template_main'] = 'soapbox8_index.tpl';
require_once __DIR__ . '/header.php';
require_once XOOPS_ROOT_PATH . '/header.php';
require_once __DIR__ . '/include/config.php';
// Define Stylesheet
$xoTheme->addStylesheet($stylesheet);
// keywords
Soapbox8Utility::meta_keywords(xoops_getModuleOption('keywords', $moduleDirName));
// description
Soapbox8Utility::meta_description(_MD_SOAPBOX8_DESC);
//
$GLOBALS['xoopsTpl']->assign('xoops_mpageurl', _MD_SOAPBOX8_URL . '/index.php');
$GLOBALS['xoopsTpl']->assign('soapbox8_url', _MD_SOAPBOX8_URL);
$GLOBALS['xoopsTpl']->assign('adv', xoops_getModuleOption('advertise', $moduleDirName));
//
$GLOBALS['xoopsTpl']->assign('bookmarks', xoops_getModuleOption('bookmarks', $moduleDirName));
$GLOBALS['xoopsTpl']->assign('fbcomments', xoops_getModuleOption('fbcomments', $moduleDirName));
//
$GLOBALS['xoopsTpl']->assign('admin', _MD_SOAPBOX8_ADMIN);
$GLOBALS['xoopsTpl']->assign('copyright', $copyright);
//
require_once XOOPS_ROOT_PATH . '/footer.php';
