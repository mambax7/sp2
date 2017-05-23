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

$GLOBALS['xoopsOption']['template_main'] = 'soapbox8_sbcolumns.tpl';
require_once __DIR__ . '/header.php';
$start = Request::getInt('start', 0);
// Define Stylesheet
$xoTheme->addStylesheet($stylesheet);
// Get Handler
/** @var XoopsObjectHandler $sbcolumnsHandler */
$sbcolumnsHandler         = xoops_getModuleHandler('sbcolumns', $moduleDirName);
$sbcolumnsPaginationLimit = $GLOBALS['xoopsModuleConfig']['userpager'];

$criteria = new CriteriaCompo();

$criteria->setOrder('DESC');
$criteria->setLimit($sbcolumnsPaginationLimit);
$criteria->setStart($start);

$sbcolumnsCount = $sbcolumnsHandler->getCount($criteria);
$sbcolumnsArray = $sbcolumnsHandler->getAll($criteria);
if ($sbcolumnsCount > 0) {
    foreach (array_keys($sbcolumnsArray) as $i) {
        $sbcolumns['columnID']    = $sbcolumnsArray[$i]->getVar('columnID');
        $sbcolumns['author']      = $sbcolumnsArray[$i]->getVar('author');
        $sbcolumns['name']        = $sbcolumnsArray[$i]->getVar('name');
        $sbcolumns['description'] = strip_tags($sbcolumnsArray[$i]->getVar('description'));
        $sbcolumns['total']       = $sbcolumnsArray[$i]->getVar('total');
        $sbcolumns['weight']      = $sbcolumnsArray[$i]->getVar('weight');
        $sbcolumns['colimage']    = $sbcolumnsArray[$i]->getVar('colimage');
        $sbcolumns['created']     = date(_SHORTDATESTRING, strtotime($sbcolumnsArray[$i]->getVar('created')));
        $GLOBALS['xoopsTpl']->append('sbcolumns', $sbcolumns);
        $keywords[] = $sbcolumnsArray[$i]->getVar('name');
        unset($sbcolumns);
    }
    // Display Navigation
    if ($sbcolumnsCount > $sbcolumnsPaginationLimit) {
        require_once XOOPS_ROOT_PATH . '/class/pagenav.php';
        $pagenav = new XoopsPageNav($sbcolumnsCount, $sbcolumnsPaginationLimit, $start, 'start');
        $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
    }
}
//keywords
if (isset($keywords)) {
    Soapbox8Utility::meta_keywords(xoops_getModuleOption('keywords', $moduleDirName) . ', ' . implode(', ', $keywords));
}
//description
Soapbox8Utility::meta_description(_MD_SOAPBOX8_SBCOLUMNS_DESC);
//
$GLOBALS['xoopsTpl']->assign('xoops_mpageurl', _MD_SOAPBOX8_URL . '/sbcolumns.php');
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
