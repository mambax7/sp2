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
 * Class Soapbox8Sbvotedata
 */
class Soapbox8Sbvotedata extends XoopsObject
{
    /**
     * Constructor
     *
     * @param null
     */
    public function __construct()
    {
        parent::__construct();
        $this->initVar('ratingid', XOBJ_DTYPE_INT);
        $this->initVar('lid', XOBJ_DTYPE_INT);
        $this->initVar('ratinguser', XOBJ_DTYPE_INT);
        $this->initVar('rating', XOBJ_DTYPE_INT);
        $this->initVar('ratinghostname', XOBJ_DTYPE_TXTBOX);
        $this->initVar('ratingtimestamp', XOBJ_DTYPE_INT);
    }

    /**
     * Get form
     *
     * @param null
     * @return Soapbox8SbvotedataForm
     */
    public function getForm()
    {
        require_once XOOPS_ROOT_PATH . '/modules/soapbox8/class/form/sbvotedata.php';

        $form = new Soapbox8SbvotedataForm($this);

        return $form;
    }

    /**
     * @return array|null
     */
    public function getGroupsRead()
    {
        global $permHelper;

        //return $this->publisher->getHandler('permission')->getGrantedGroupsById('sbvotedata_read', ratingid);
        return $permHelper->getGroupsForItem('sbcolumns_read', $this->getVar('ratingid'));
    }

    /**
     * @return array|null
     */
    public function getGroupsSubmit()
    {
        global $permHelper;

        //        return $this->publisher->getHandler('permission')->getGrantedGroupsById('sbvotedata_submit', ratingid);
        return $permHelper->getGroupsForItem('sbcolumns_submit', $this->getVar('ratingid'));
    }

    /**
     * @return array|null
     */
    public function getGroupsModeration()
    {
        global $permHelper;

        //        return $this->publisher->getHandler('permission')->getGrantedGroupsById('sbvotedata_moderation', ratingid);
        return $permHelper->getGroupsForItem('sbcolumns_moderation', $this->getVar('ratingid'));
    }

}

/**
 * Class Soapbox8SbvotedataHandler
 */
class Soapbox8SbvotedataHandler extends XoopsPersistableObjectHandler
{
    /**
     * Constructor
     * @param null|XoopsDatabase $db
     */

    public function __construct(XoopsDatabase $db)
    {
        parent::__construct($db, 'soapbox8_sbvotedata', 'Soapbox8Sbvotedata', 'ratingid', 'ratingid');
    }
}
