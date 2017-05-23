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
 * Class Soapbox8Sbarticles
 */
class Soapbox8Sbarticles extends XoopsObject
{
    /**
     * Constructor
     *
     * @param null
     */
    public function __construct()
    {
        parent::__construct();
        $this->initVar('articleID', XOBJ_DTYPE_INT);
        $this->initVar('columnID', XOBJ_DTYPE_INT);
        $this->initVar('headline', XOBJ_DTYPE_TXTBOX);
        $this->initVar('lead', XOBJ_DTYPE_TXTAREA);
        $this->initVar('bodytext', XOBJ_DTYPE_TXTAREA);
        $this->initVar('teaser', XOBJ_DTYPE_TXTAREA);
        $this->initVar('uid', XOBJ_DTYPE_INT);
        $this->initVar('submit', XOBJ_DTYPE_INT);
        $this->initVar('datesub', XOBJ_DTYPE_INT);
        $this->initVar('counter', XOBJ_DTYPE_INT);
        $this->initVar('weight', XOBJ_DTYPE_INT);
        $this->initVar('html', XOBJ_DTYPE_INT);
        $this->initVar('smiley', XOBJ_DTYPE_INT);
        $this->initVar('xcodes', XOBJ_DTYPE_INT);
        $this->initVar('breaks', XOBJ_DTYPE_INT);
        $this->initVar('block', XOBJ_DTYPE_INT);
        $this->initVar('artimage', XOBJ_DTYPE_TXTBOX);
        $this->initVar('votes', XOBJ_DTYPE_INT);
        $this->initVar('rating', XOBJ_DTYPE_DECIMAL);
        $this->initVar('commentable', XOBJ_DTYPE_INT);
        $this->initVar('offline', XOBJ_DTYPE_INT);
        $this->initVar('notifypub', XOBJ_DTYPE_INT);
    }

    /**
     * Get form
     *
     * @param null
     * @return Soapbox8SbarticlesForm
     */
    public function getForm()
    {
        require_once XOOPS_ROOT_PATH . '/modules/soapbox8/class/form/sbarticles.php';

        $form = new Soapbox8SbarticlesForm($this);

        return $form;
    }

    /**
     * @return array|null
     */
    public function getGroupsRead()
    {
        global $permHelper;

        //return $this->publisher->getHandler('permission')->getGrantedGroupsById('sbarticles_read', articleID);
        return $permHelper->getGroupsForItem('sbcolumns_read', $this->getVar('articleID'));
    }

    /**
     * @return array|null
     */
    public function getGroupsSubmit()
    {
        global $permHelper;

        //        return $this->publisher->getHandler('permission')->getGrantedGroupsById('sbarticles_submit', articleID);
        return $permHelper->getGroupsForItem('sbcolumns_submit', $this->getVar('articleID'));
    }

    /**
     * @return array|null
     */
    public function getGroupsModeration()
    {
        global $permHelper;

        //        return $this->publisher->getHandler('permission')->getGrantedGroupsById('sbarticles_moderation', articleID);
        return $permHelper->getGroupsForItem('sbcolumns_moderation', $this->getVar('articleID'));
    }

}

/**
 * Class Soapbox8SbarticlesHandler
 */
class Soapbox8SbarticlesHandler extends XoopsPersistableObjectHandler
{
    /**
     * Constructor
     * @param null|XoopsDatabase $db
     */

    public function __construct(XoopsDatabase $db)
    {
        parent::__construct($db, 'soapbox8_sbarticles', 'Soapbox8Sbarticles', 'articleID', 'headline');
    }
}
