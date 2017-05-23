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

$GLOBALS['xoopsOption']['template_main'] = 'soapbox8_sbarticles.tpl';
require_once __DIR__ . '/header.php';
$start = Request::getInt('start', 0);
// Define Stylesheet
$xoTheme->addStylesheet($stylesheet);
// Get Handler
/** @var XoopsObjectHandler $sbarticlesHandler */
$sbarticlesHandler         = xoops_getModuleHandler('sbarticles', $moduleDirName);
$sbarticlesPaginationLimit = $GLOBALS['xoopsModuleConfig']['userpager'];

$criteria = new CriteriaCompo();

$criteria->setOrder('DESC');
$criteria->setLimit($sbarticlesPaginationLimit);
$criteria->setStart($start);

$sbarticlesCount = $sbarticlesHandler->getCount($criteria);
$sbarticlesArray = $sbarticlesHandler->getAll($criteria);
if ($sbarticlesCount > 0) {
    foreach (array_keys($sbarticlesArray) as $i) {
        $sbarticles['articleID'] = $sbarticlesArray[$i]->getVar('articleID');
        /** @var XoopsObjectHandler $sbcolumnsHandler */

        $sbcolumnsHandler          = xoops_getModuleHandler('sbcolumns', $moduleDirName);
        $sbarticles['columnID']    = $sbcolumnsHandler->get($sbarticlesArray[$i]->getVar('columnID'))->getVar('name');
        $sbarticles['headline']    = $sbarticlesArray[$i]->getVar('headline');
        $sbarticles['lead']        = strip_tags($sbarticlesArray[$i]->getVar('lead'));
        $sbarticles['bodytext']    = strip_tags($sbarticlesArray[$i]->getVar('bodytext'));
        $sbarticles['teaser']      = strip_tags($sbarticlesArray[$i]->getVar('teaser'));
        $sbarticles['uid']         = $sbarticlesArray[$i]->getVar('uid');
        $sbarticles['submit']      = $sbarticlesArray[$i]->getVar('submit');
        $sbarticles['datesub']     = $sbarticlesArray[$i]->getVar('datesub');
        $sbarticles['counter']     = $sbarticlesArray[$i]->getVar('counter');
        $sbarticles['weight']      = $sbarticlesArray[$i]->getVar('weight');
        $sbarticles['html']        = $sbarticlesArray[$i]->getVar('html');
        $sbarticles['smiley']      = $sbarticlesArray[$i]->getVar('smiley');
        $sbarticles['xcodes']      = $sbarticlesArray[$i]->getVar('xcodes');
        $sbarticles['breaks']      = $sbarticlesArray[$i]->getVar('breaks');
        $sbarticles['block']       = $sbarticlesArray[$i]->getVar('block');
        $sbarticles['artimage']    = $sbarticlesArray[$i]->getVar('artimage');
        $sbarticles['votes']       = $sbarticlesArray[$i]->getVar('votes');
        $sbarticles['rating']      = $sbarticlesArray[$i]->getVar('rating');
        $sbarticles['commentable'] = $sbarticlesArray[$i]->getVar('commentable');
        $sbarticles['offline']     = $sbarticlesArray[$i]->getVar('offline');
        $sbarticles['notifypub']   = $sbarticlesArray[$i]->getVar('notifypub');
        $GLOBALS['xoopsTpl']->append('sbarticles', $sbarticles);
        $keywords[] = $sbarticlesArray[$i]->getVar('headline');
        unset($sbarticles);
    }
    // Display Navigation
    if ($sbarticlesCount > $sbarticlesPaginationLimit) {
        require_once XOOPS_ROOT_PATH . '/class/pagenav.php';
        $pagenav = new XoopsPageNav($sbarticlesCount, $sbarticlesPaginationLimit, $start, 'start');
        $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
    }
}
//keywords
if (isset($keywords)) {
    Soapbox8Utility::meta_keywords(xoops_getModuleOption('keywords', $moduleDirName) . ', ' . implode(', ', $keywords));
}
//description
Soapbox8Utility::meta_description(_MD_SOAPBOX8_SBARTICLES_DESC);
//
$GLOBALS['xoopsTpl']->assign('xoops_mpageurl', _MD_SOAPBOX8_URL . '/sbarticles.php');
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
