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

// get path to icons
$pathIcon32    = Admin::menuIconPath('');
$moduleDirName = basename(dirname(__DIR__));

$adminmenu[] = array(
    'title' => _MI_SOAPBOX8_ADMENU1,
    'link'  => 'admin/index.php',
    'icon'  => "{$pathIcon32}/home.png"
);

$adminmenu[] = array(
    'title' => _MI_SOAPBOX8_ADMENU2,
    'link'  => 'admin/sbcolumns.php',
    'icon'  => "{$pathIcon32}/category.png"
);

$adminmenu[] = array(
    'title' => _MI_SOAPBOX8_ADMENU3,
    'link'  => 'admin/sbarticles.php',
    'icon'  => "{$pathIcon32}/attach.png"
);

$adminmenu[] = array(
    'title' => _MI_SOAPBOX8_ADMENU4,
    'link'  => 'admin/sbvotedata.php',
    'icon'  => "{$pathIcon32}/user-icon.png"
);

$adminmenu[] = array(
    'title' => _MI_SOAPBOX8_ADMENU5,
    'link'  => 'admin/test.php',
    'icon'  => "{$pathIcon32}/administration.png"
);

$adminmenu[] = array(
    'title' => _MI_SOAPBOX8_ADMENU6,
    'link'  => 'admin/permissions.php',
    'icon'  => "{$pathIcon32}/permissions.png"
);

$adminmenu[] = array(
    'title' => _MI_SOAPBOX8_ADMENU7,
    'link'  => 'admin/about.php',
    'icon'  => "{$pathIcon32}/about.png"
);
