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

use Xmf\Module\Helper\Permission;

if (!isset($moduleDirName)) {
    $moduleDirName = basename(dirname(__DIR__));
}
$permHelper = new Permission($moduleDirName);

/**
 * Class Soapbox8Sbcolumns
 */
class Soapbox8Sbcolumns extends XoopsObject
{
    /**
     * Constructor
     *
     * @param null
     */
    public function __construct()
    {
        parent::__construct();
        $this->initVar('columnID', XOBJ_DTYPE_INT);
        $this->initVar('author', XOBJ_DTYPE_INT);
        $this->initVar('name', XOBJ_DTYPE_TXTBOX);
        $this->initVar('description', XOBJ_DTYPE_TXTAREA);
        $this->initVar('total', XOBJ_DTYPE_INT);
        $this->initVar('weight', XOBJ_DTYPE_INT);
        $this->initVar('colimage', XOBJ_DTYPE_TXTBOX);
        $this->initVar('created', XOBJ_DTYPE_INT);
    }

    /**
     * Get form
     *
     * @param null
     * @return Soapbox8SbcolumnsForm
     */
    public function getForm()
    {
        require_once XOOPS_ROOT_PATH . '/modules/soapbox8/class/form/sbcolumns.php';

        $form = new Soapbox8SbcolumnsForm($this);

        return $form;
    }

    /**
     * @return array|null
     */
    public function getGroupsRead()
    {
        global $permHelper;

        //return $this->publisher->getHandler('permission')->getGrantedGroupsById('sbcolumns_read', columnID);
        return $permHelper->getGroupsForItem('sbcolumns_read', $this->getVar('columnID'));
    }

    /**
     * @return array|null
     */
    public function getGroupsSubmit()
    {
        global $permHelper;

        //        return $this->publisher->getHandler('permission')->getGrantedGroupsById('sbcolumns_submit', columnID);
        return $permHelper->getGroupsForItem('sbcolumns_submit', $this->getVar('columnID'));
    }

    /**
     * @return array|null
     */
    public function getGroupsModeration()
    {
        global $permHelper;

        //        return $this->publisher->getHandler('permission')->getGrantedGroupsById('sbcolumns_moderation', columnID);
        return $permHelper->getGroupsForItem('sbcolumns_moderation', $this->getVar('columnID'));
    }

}

/**
 * Class Soapbox8SbcolumnsHandler
 */
class Soapbox8SbcolumnsHandler extends XoopsPersistableObjectHandler
{
    /**
     * Constructor
     * @param null|XoopsDatabase $db
     */

    public function __construct(XoopsDatabase $db)
    {
        parent::__construct($db, 'soapbox8_sbcolumns', 'Soapbox8Sbcolumns', 'columnID', 'name');
    }
}
