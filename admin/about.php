<?php
//use Xmf\Module\Admin;

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

require __DIR__ . '/admin_header.php';
xoops_cp_header();

// code marker
echo $adminObject->displayNavigation(basename(__FILE__));
\Xmf\Module\Admin::setPaypal('6KJ7RW5DR3VTJ');
echo $adminObject->displayAbout(false);

// code end

//codeDump(__FILE__);
require_once __DIR__ . '/admin_footer.php';
