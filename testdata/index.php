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

require_once __DIR__ . '/../../../mainfile.php';

$op = Request::getCmd('op', '');

switch ($op) {
    case 'load':
        loadSampleData();
        break;
}

// XMF TableLoad for SAMPLE data

function loadSampleData()
{
    $moduleDirName = basename(dirname(__DIR__));
    xoops_loadLanguage('admin', $moduleDirName);

    $sbcolumnsData = \Xmf\Yaml::readWrapped('sbcolumns.yml');
    \Xmf\Database\TableLoad::truncateTable('sbcolumns');
    \Xmf\Database\TableLoad::loadTableFromArray('sbcolumns', $sbcolumnsData);

    $sbarticlesData = \Xmf\Yaml::readWrapped('sbarticles.yml');
    \Xmf\Database\TableLoad::truncateTable('sbarticles');
    \Xmf\Database\TableLoad::loadTableFromArray('sbarticles', $sbarticlesData);

    $sbvotedataData = \Xmf\Yaml::readWrapped('sbvotedata.yml');
    \Xmf\Database\TableLoad::truncateTable('sbvotedata');
    \Xmf\Database\TableLoad::loadTableFromArray('sbvotedata', $sbvotedataData);

    $testData = \Xmf\Yaml::readWrapped('test.yml');
    \Xmf\Database\TableLoad::truncateTable('test');
    \Xmf\Database\TableLoad::loadTableFromArray('test', $testData);

    redirect_header('../admin/main.php', 1, _AM_SOAPBOX8_SAMPLEDATA_SUCCESS);
}
