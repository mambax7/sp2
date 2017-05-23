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
 * Class Soapbox8Test
 */
class Soapbox8Test extends XoopsObject
{
    /**
     * Constructor
     *
     * @param null
     */
    public function __construct()
    {
        parent::__construct();
        $this->initVar('id', XOBJ_DTYPE_INT);
        $this->initVar('text', XOBJ_DTYPE_TXTBOX);
        $this->initVar('textarea', XOBJ_DTYPE_TXTAREA);
        $this->initVar('dhtml', XOBJ_DTYPE_TXTAREA);
        $this->initVar('checkbox', XOBJ_DTYPE_INT);
        $this->initVar('radioyn', XOBJ_DTYPE_INT);
        $this->initVar('selectbox', XOBJ_DTYPE_INT);
        $this->initVar('selectuser', XOBJ_DTYPE_INT);
        $this->initVar('colorpicker', XOBJ_DTYPE_TXTBOX);
        $this->initVar('uploadimage', XOBJ_DTYPE_TXTBOX);
        $this->initVar('uploadfile', XOBJ_DTYPE_TXTBOX);
        $this->initVar('textdataselect', XOBJ_DTYPE_TXTBOX);
        $this->initVar('datetimeselect', XOBJ_DTYPE_INT);
        $this->initVar('articleslink', XOBJ_DTYPE_INT);
    }

    /**
     * Get form
     *
     * @param null
     * @return Soapbox8TestForm
     */
    public function getForm()
    {
        require_once XOOPS_ROOT_PATH . '/modules/soapbox8/class/form/test.php';

        $form = new Soapbox8TestForm($this);

        return $form;
    }

    /**
     * @return array|null
     */
    public function getGroupsRead()
    {
        global $permHelper;

        //return $this->publisher->getHandler('permission')->getGrantedGroupsById('test_read', id);
        return $permHelper->getGroupsForItem('sbcolumns_read', $this->getVar('id'));
    }

    /**
     * @return array|null
     */
    public function getGroupsSubmit()
    {
        global $permHelper;

        //        return $this->publisher->getHandler('permission')->getGrantedGroupsById('test_submit', id);
        return $permHelper->getGroupsForItem('sbcolumns_submit', $this->getVar('id'));
    }

    /**
     * @return array|null
     */
    public function getGroupsModeration()
    {
        global $permHelper;

        //        return $this->publisher->getHandler('permission')->getGrantedGroupsById('test_moderation', id);
        return $permHelper->getGroupsForItem('sbcolumns_moderation', $this->getVar('id'));
    }

}

/**
 * Class Soapbox8TestHandler
 */
class Soapbox8TestHandler extends XoopsPersistableObjectHandler
{
    /**
     * Constructor
     * @param null|XoopsDatabase $db
     */

    public function __construct(XoopsDatabase $db)
    {
        parent::__construct($db, 'soapbox8_test', 'Soapbox8Test', 'id', 'text');
    }
}
