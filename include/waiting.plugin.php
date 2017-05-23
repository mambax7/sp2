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
function b_waiting_soapbox8()
{
    $db  = XoopsDatabaseFactory::getDatabaseConnection();
    $ret = array();

    // waiting table sbcolumns
    $block  = array();
    $result = $db->query('SELECT COUNT(*) FROM ' . $db->prefix('soapbox8_sbcolumns') . ' WHERE _waiting = 1');
    if ($result) {
        $block['adminlink'] = XOOPS_URL . '/modules/soapbox8/admin/sbcolumns.php?op=list_waiting';
        list($block['pendingnum']) = $db->fetchRow($result);
        $block['lang_linkname'] = _MB_SOAPBOX8_SBCOLUMNS_WAITING;
    }
    $ret[] = $block;

    // waiting table sbarticles
    $block  = array();
    $result = $db->query('SELECT COUNT(*) FROM ' . $db->prefix('soapbox8_sbarticles') . ' WHERE _waiting = 1');
    if ($result) {
        $block['adminlink'] = XOOPS_URL . '/modules/soapbox8/admin/sbarticles.php?op=list_waiting';
        list($block['pendingnum']) = $db->fetchRow($result);
        $block['lang_linkname'] = _MB_SOAPBOX8_SBARTICLES_WAITING;
    }
    $ret[] = $block;

    // waiting table sbvotedata
    $block  = array();
    $result = $db->query('SELECT COUNT(*) FROM ' . $db->prefix('soapbox8_sbvotedata') . ' WHERE _waiting = 1');
    if ($result) {
        $block['adminlink'] = XOOPS_URL . '/modules/soapbox8/admin/sbvotedata.php?op=list_waiting';
        list($block['pendingnum']) = $db->fetchRow($result);
        $block['lang_linkname'] = _MB_SOAPBOX8_SBVOTEDATA_WAITING;
    }
    $ret[] = $block;

    // waiting table test
    $block  = array();
    $result = $db->query('SELECT COUNT(*) FROM ' . $db->prefix('soapbox8_test') . ' WHERE _waiting = 1');
    if ($result) {
        $block['adminlink'] = XOOPS_URL . '/modules/soapbox8/admin/test.php?op=list_waiting';
        list($block['pendingnum']) = $db->fetchRow($result);
        $block['lang_linkname'] = _MB_SOAPBOX8_TEST_WAITING;
    }
    $ret[] = $block;

    return $ret;
}
