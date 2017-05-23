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

$GLOBALS['xoopsOption']['template_main'] = 'soapbox8_sbvotedata.tpl';
require_once __DIR__ . '/header.php';
$start = Request::getInt('start', 0);
// Define Stylesheet
$xoTheme->addStylesheet($stylesheet);
// Get Handler
/** @var XoopsObjectHandler $sbvotedataHandler */
$sbvotedataHandler         = xoops_getModuleHandler('sbvotedata', $moduleDirName);
$sbvotedataPaginationLimit = $GLOBALS['xoopsModuleConfig']['userpager'];

$criteria = new CriteriaCompo();

$criteria->setOrder('DESC');
$criteria->setLimit($sbvotedataPaginationLimit);
$criteria->setStart($start);

$sbvotedataCount = $sbvotedataHandler->getCount($criteria);
$sbvotedataArray = $sbvotedataHandler->getAll($criteria);
if ($sbvotedataCount > 0) {
    foreach (array_keys($sbvotedataArray) as $i) {
        $sbvotedata['ratingid'] = $sbvotedataArray[$i]->getVar('ratingid');
        /** @var XoopsObjectHandler $sbarticlesHandler */

        $sbarticlesHandler             = xoops_getModuleHandler('sbarticles', $moduleDirName);
        $sbvotedata['lid']             = $sbarticlesHandler->get($sbvotedataArray[$i]->getVar('lid'))->getVar('headline');
        $sbvotedata['ratinguser']      = $sbvotedataArray[$i]->getVar('ratinguser');
        $sbvotedata['rating']          = $sbvotedataArray[$i]->getVar('rating');
        $sbvotedata['ratinghostname']  = $sbvotedataArray[$i]->getVar('ratinghostname');
        $sbvotedata['ratingtimestamp'] = date(_DATESTRING, strtotime($sbvotedataArray[$i]->getVar('ratingtimestamp')));
        $GLOBALS['xoopsTpl']->append('sbvotedata', $sbvotedata);
        $keywords[] = $sbvotedataArray[$i]->getVar('ratingid');
        unset($sbvotedata);
    }
    // Display Navigation
    if ($sbvotedataCount > $sbvotedataPaginationLimit) {
        require_once XOOPS_ROOT_PATH . '/class/pagenav.php';
        $pagenav = new XoopsPageNav($sbvotedataCount, $sbvotedataPaginationLimit, $start, 'start');
        $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
    }
}
//keywords
if (isset($keywords)) {
    Soapbox8Utility::meta_keywords(xoops_getModuleOption('keywords', $moduleDirName) . ', ' . implode(', ', $keywords));
}
//description
Soapbox8Utility::meta_description(_MD_SOAPBOX8_SBVOTEDATA_DESC);
//
$GLOBALS['xoopsTpl']->assign('xoops_mpageurl', _MD_SOAPBOX8_URL . '/sbvotedata.php');
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
