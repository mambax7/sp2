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

use Xmf\Module\Admin;

use Xmf\Request;

require __DIR__ . '/admin_header.php';
xoops_cp_header();
//count "total Sbcolumns"
$totalSbcolumns = $sbcolumnsHandler->getCount();
//count "total Sbarticles"
$totalSbarticles = $sbarticlesHandler->getCount();
//count "total Sbvotedata"
$totalSbvotedata = $sbvotedataHandler->getCount();
//count "total Test"
$totalTest = $testHandler->getCount();
// InfoBox Statistics
$adminObject->addInfoBox(_AM_SOAPBOX8_STATISTICS);

// InfoBox sbcolumns
$adminObject->addInfoBoxLine(sprintf(_AM_SOAPBOX8_THEREARE_SBCOLUMNS, $totalSbcolumns));

// InfoBox sbarticles
$adminObject->addInfoBoxLine(sprintf(_AM_SOAPBOX8_THEREARE_SBARTICLES, $totalSbarticles));

// InfoBox sbvotedata
$adminObject->addInfoBoxLine(sprintf(_AM_SOAPBOX8_THEREARE_SBVOTEDATA, $totalSbvotedata));

// InfoBox test
$adminObject->addInfoBoxLine(sprintf(_AM_SOAPBOX8_THEREARE_TEST, $totalTest));
// Render Index
//echo $adminObject->displayNavigation(basename(__FILE__));
//echo $adminObject->renderIndex();

//---------------- XMF -------------------
// code marker
$adminObject->displayNavigation(basename(__FILE__));
$adminObject->addConfigModuleVersion('system', 212);
//$adminObject->addConfigWarning('These are just examples!');
//$adminObject->addConfigBoxLine('notarealmodule', 'module');
//$adminObject->addConfigBoxLine(array('notarealmodule', 'warning'), 'module');

require_once __DIR__ . '/../testdata/index.php';
$adminObject->addItemButton(_AM_SOAPBOX8_ADD_SAMPLEDATA, '__DIR__ . /../../testdata/index.php?op=load', 'add');
$adminObject->displayButton('left', '');

$adminObject->displayIndex();
// code end
//codeDump(__FILE__);
require_once __DIR__ . '/admin_footer.php';
