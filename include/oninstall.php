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

/**
 * Prepares system prior to attempting to install module
 * @param XoopsModule $module {@link XoopsModule}
 *
 * @return bool true if ready to install, false if not
 */
function xoops_module_pre_install_soapbox8(XoopsModule $module)
{
    $moduleDirName = basename(dirname(__DIR__));
    $className     = ucfirst($moduleDirName) . 'Utility';
    if (!class_exists($className)) {
        xoops_load('utility', $moduleDirName);
    }
    //check for minimum XOOPS version
    if (!$className::checkVerXoops($module)) {
        return false;
    }

    // check for minimum PHP version
    if (!$className::checkVerPhp($module)) {
        return false;
    }
    $mod_tables =& $module->getInfo('tables');
    foreach ($mod_tables as $table) {
        $GLOBALS['xoopsDB']->queryF('DROP TABLE IF EXISTS ' . $GLOBALS['xoopsDB']->prefix($table) . ';');
    }

    return true;
}

/**
 *
 * Performs tasks required during installation of the module
 * @param XoopsModule $module {@link XoopsModule}
 *
 * @return bool true if installation successful, false if not
 */
function xoops_module_install_soapbox8(XoopsModule $module)
{
    require_once dirname(dirname(dirname(__DIR__))) . '/mainfile.php';
    //    $moduleDirName = $xoopsModule->getVar('dirname');
    $moduleDirName = basename(dirname(__DIR__));
    xoops_loadLanguage('admin', $moduleDirName);
    xoops_loadLanguage('modinfo', $moduleDirName);
    $configurator = include __DIR__ . '/config.php';
    $classUtility = ucfirst($moduleDirName) . 'Utility';
    if (!class_exists($classUtility)) {
        xoops_load('utility', $moduleDirName);
    }
    global $xoopsModule;
    // default Permission Settings
    $moduleId = $xoopsModule->getVar('mid');
    //$moduleName = $xoopsModule->getVar('name');
    //$moduleDirName = $xoopsModule->getVar('dirname');
    //$moduleVersion = $xoopsModule->getVar('version');
    $gpermHandler = xoops_getHandler('groupperm');
    // access rights
    $gpermHandler->addRight('soapbox8_approve', 1, XOOPS_GROUP_ADMIN, $moduleId);
    $gpermHandler->addRight('soapbox8_submit', 1, XOOPS_GROUP_ADMIN, $moduleId);
    $gpermHandler->addRight('soapbox8_view', 1, XOOPS_GROUP_ADMIN, $moduleId);
    $gpermHandler->addRight('soapbox8_view', 1, XOOPS_GROUP_USERS, $moduleId);
    $gpermHandler->addRight('soapbox8_view', 1, XOOPS_GROUP_ANONYMOUS, $moduleId);

    //  ---  CREATE FOLDERS ---------------
    if (count($configurator['uploadFolders']) > 0) {
        //    foreach (array_keys($GLOBALS['uploadFolders']) as $i) {
        foreach (array_keys($configurator['uploadFolders']) as $i) {
            $classUtility::createFolder($configurator['uploadFolders'][$i]);
        }
    }
    //  ---  COPY blank.png FILES ---------------
    if (count($configurator['copyBlankFiles']) > 0) {
        $file = __DIR__ . '/../assets/images/blank.png';
        foreach (array_keys($configurator['copyBlankFiles']) as $i) {
            $dest = $configurator['copyBlankFiles'][$i] . '/blank.png';
            $classUtility::copyFile($file, $dest);
        }
    }

    return true;
}
