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
use Xmf\Language;
use Xmf\Module\Admin;

$GLOBALS['xoopsOption']['template_main'] = 'soapbox8_test.tpl';
require_once __DIR__ . '/header.php';
$start = Request::getInt('start', 0);
// Define Stylesheet
$xoTheme->addStylesheet($stylesheet);
// Get Handler
/** @var XoopsObjectHandler $testHandler */
$testHandler         = xoops_getModuleHandler('test', $moduleDirName);
$testPaginationLimit = $GLOBALS['xoopsModuleConfig']['userpager'];

$criteria = new CriteriaCompo();

$criteria->setOrder('DESC');
$criteria->setLimit($testPaginationLimit);
$criteria->setStart($start);

$testCount = $testHandler->getCount($criteria);
$testArray = $testHandler->getAll($criteria);
if ($testCount > 0) {
    foreach (array_keys($testArray) as $i) {
        $test['id']             = $testArray[$i]->getVar('id');
        $test['text']           = $testArray[$i]->getVar('text');
        $test['textarea']       = strip_tags($testArray[$i]->getVar('textarea'));
        $test['dhtml']          = strip_tags($testArray[$i]->getVar('dhtml'));
        $test['checkbox']       = $testArray[$i]->getVar('checkbox');
        $test['radioyn']        = $testArray[$i]->getVar('radioyn');
        $test['selectbox']      = $testArray[$i]->getVar('selectbox');
        $test['selectuser']     = $testArray[$i]->getVar('selectuser');
        $test['colorpicker']    = $testArray[$i]->getVar('colorpicker');
        $test['uploadimage']    = $testArray[$i]->getVar('uploadimage');
        $test['uploadfile']     = $testArray[$i]->getVar('uploadfile');
        $test['textdataselect'] = date(_SHORTDATESTRING, strtotime($testArray[$i]->getVar('textdataselect')));
        $test['datetimeselect'] = date(_DATESTRING, strtotime($testArray[$i]->getVar('datetimeselect')));
        /** @var XoopsObjectHandler $sbarticlesHandler */

        $sbarticlesHandler    = xoops_getModuleHandler('sbarticles', $moduleDirName);
        $test['articleslink'] = $sbarticlesHandler->get($testArray[$i]->getVar('articleslink'))->getVar('headline');
        $GLOBALS['xoopsTpl']->append('test', $test);
        $keywords[] = $testArray[$i]->getVar('text');
        unset($test);
    }
    // Display Navigation
    if ($testCount > $testPaginationLimit) {
        require_once XOOPS_ROOT_PATH . '/class/pagenav.php';
        $pagenav = new XoopsPageNav($testCount, $testPaginationLimit, $start, 'start');
        $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
    }
}
//keywords
if (isset($keywords)) {
    Soapbox8Utility::meta_keywords(xoops_getModuleOption('keywords', $moduleDirName) . ', ' . implode(', ', $keywords));
}
//description
Soapbox8Utility::meta_description(_MD_SOAPBOX8_TEST_DESC);
//
$GLOBALS['xoopsTpl']->assign('xoops_mpageurl', _MD_SOAPBOX8_URL . '/test.php');
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
