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
use Xmf\Module\Helper;
use Xmf\Module\Helper\Permission;

require_once __DIR__ . '/../../include/config.php';

$moduleDirName = basename(dirname(dirname(__DIR__)));
$moduleHelper  = Xmf\Module\Helper::getHelper($moduleDirName);
$permHelper    = new Permission($moduleDirName);

xoops_load('XoopsFormLoader');

/**
 * Class Soapbox8SbvotedataForm
 */
class Soapbox8SbvotedataForm extends XoopsThemeForm
{
    public $targetObject;

    /**
     * Constructor
     *
     * @param $target
     */
    public function __construct($target)
    {
        global $moduleHelper;
        $this->targetObject = $target;

        $title = $this->targetObject->isNew() ? sprintf(_AM_SOAPBOX8_SBVOTEDATA_ADD) : sprintf(_AM_SOAPBOX8_SBVOTEDATA_EDIT);
        parent::__construct($title, 'form', xoops_getenv('PHP_SELF'), 'post', true);
        $this->setExtra('enctype="multipart/form-data"');

        //include ID field, it's needed so the module knows if it is a new form or an edited form

        $hidden = new XoopsFormHidden('ratingid', $this->targetObject->getVar('ratingid'));
        $this->addElement($hidden);
        unset($hidden);

        // Ratingid
        $this->addElement(new XoopsFormLabel(_AM_SOAPBOX8_SBVOTEDATA_RATINGID, $this->targetObject->getVar('ratingid'), 'ratingid'));
        // Lid
        $sbarticlesHandler    = xoops_getModuleHandler('sbarticles', 'soapbox8');
        $sbarticles_id_select = new XoopsFormSelect(_AM_SOAPBOX8_SBVOTEDATA_LID, 'lid', $this->targetObject->getVar('lid'));
        $sbarticles_id_select->addOptionArray($sbarticlesHandler->getList());
        $this->addElement($sbarticles_id_select, false);
        // Ratinguser
        $this->addElement(new XoopsFormSelectUser(_AM_SOAPBOX8_SBVOTEDATA_RATINGUSER, 'ratinguser', false, $this->targetObject->getVar('ratinguser'), 1, false), false);
        // Rating
        $this->addElement(new XoopsFormText(_AM_SOAPBOX8_SBVOTEDATA_RATING, 'rating', 50, 255, $this->targetObject->getVar('rating')), false);
        // Ratinghostname
        $this->addElement(new XoopsFormText(_AM_SOAPBOX8_SBVOTEDATA_RATINGHOSTNAME, 'ratinghostname', 50, 255, $this->targetObject->getVar('ratinghostname')), false);
        // Ratingtimestamp
        $this->addElement(new XoopsFormDateTime(_AM_SOAPBOX8_SBVOTEDATA_RATINGTIMESTAMP, 'ratingtimestamp', '', strtotime($this->targetObject->getVar('ratingtimestamp'))));

        $this->addElement(new XoopsFormHidden('op', 'save'));
        $this->addElement(new XoopsFormButton('', 'submit', _SUBMIT, 'submit'));
    }
}
