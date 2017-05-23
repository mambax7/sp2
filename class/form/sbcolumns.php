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
 * Class Soapbox8SbcolumnsForm
 */
class Soapbox8SbcolumnsForm extends XoopsThemeForm
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

        $title = $this->targetObject->isNew() ? sprintf(_AM_SOAPBOX8_SBCOLUMNS_ADD) : sprintf(_AM_SOAPBOX8_SBCOLUMNS_EDIT);
        parent::__construct($title, 'form', xoops_getenv('PHP_SELF'), 'post', true);
        $this->setExtra('enctype="multipart/form-data"');

        //include ID field, it's needed so the module knows if it is a new form or an edited form

        $hidden = new XoopsFormHidden('columnID', $this->targetObject->getVar('columnID'));
        $this->addElement($hidden);
        unset($hidden);

        // ColumnID
        $this->addElement(new XoopsFormLabel(_AM_SOAPBOX8_SBCOLUMNS_COLUMNID, $this->targetObject->getVar('columnID'), 'columnID'));
        // Author
        $this->addElement(new XoopsFormSelectUser(_AM_SOAPBOX8_SBCOLUMNS_AUTHOR, 'author', false, $this->targetObject->getVar('author'), 1, false), false);
        // Name
        $this->addElement(new XoopsFormText(_AM_SOAPBOX8_SBCOLUMNS_NAME, 'name', 50, 255, $this->targetObject->getVar('name')), false);
        // Description
        if (class_exists('XoopsFormEditor')) {
            $editorOptions           = array();
            $editorOptions['name']   = 'description';
            $editorOptions['value']  = $this->targetObject->getVar('description', 'e');
            $editorOptions['rows']   = 5;
            $editorOptions['cols']   = 40;
            $editorOptions['width']  = '100%';
            $editorOptions['height'] = '400px';
            //$editorOptions['editor'] = xoops_getModuleOption('soapbox8_editor', 'soapbox8');
            //$this->addElement( new XoopsFormEditor(_AM_SOAPBOX8_SBCOLUMNS_DESCRIPTION, 'description', $editorOptions), false  );
            if ($moduleHelper->isUserAdmin()) {
                $descEditor = new XoopsFormEditor(_AM_SOAPBOX8_SBCOLUMNS_DESCRIPTION, $moduleHelper->getConfig('soapbox8EditorAdmin'), $editorOptions, $nohtml = false, $onfailure = 'textarea');
            } else {
                $descEditor = new XoopsFormEditor(_AM_SOAPBOX8_SBCOLUMNS_DESCRIPTION, $moduleHelper->getConfig('soapbox8EditorUser'), $editorOptions, $nohtml = false, $onfailure = 'textarea');
            }
        } else {
            $descEditor = new XoopsFormDhtmlTextArea(_AM_SOAPBOX8_SBCOLUMNS_DESCRIPTION, 'description', $this->targetObject->getVar('description', 'e'), '100%', '100%');
        }
        $this->addElement($descEditor);
        // Total
        $this->addElement(new XoopsFormText(_AM_SOAPBOX8_SBCOLUMNS_TOTAL, 'total', 50, 255, $this->targetObject->getVar('total')), false);
        // Weight
        $this->addElement(new XoopsFormText(_AM_SOAPBOX8_SBCOLUMNS_WEIGHT, 'weight', 50, 255, $this->targetObject->getVar('weight')), false);
        // Colimage
        $colimage = $this->targetObject->getVar('colimage') ? $this->targetObject->getVar('colimage') : 'blank.png';

        $uploadDir   = '/uploads/soapbox8/images/';
        $imgtray     = new XoopsFormElementTray(_AM_SOAPBOX8_SBCOLUMNS_COLIMAGE, '<br>');
        $imgpath     = sprintf(_AM_SOAPBOX8_FORMIMAGE_PATH, $uploadDir);
        $imageselect = new XoopsFormSelect($imgpath, 'colimage', $colimage);
        $imageArray  = XoopsLists::getImgListAsArray(XOOPS_ROOT_PATH . $uploadDir);
        foreach ($imageArray as $image) {
            $imageselect->addOption("$image", $image);
        }
        $imageselect->setExtra("onchange='showImgSelected(\"image_colimage\", \"colimage\", \"" . $uploadDir . "\", \"\", \"" . XOOPS_URL . "\")'");
        $imgtray->addElement($imageselect);
        $imgtray->addElement(new XoopsFormLabel('', "<br><img src='" . XOOPS_URL . '/' . $uploadDir . '/' . $colimage . "' name='image_colimage' id='image_colimage' alt='' />"));
        $fileseltray = new XoopsFormElementTray('', '<br>');
        $fileseltray->addElement(new XoopsFormFile(_AM_SOAPBOX8_FORMUPLOAD, 'colimage', xoops_getModuleOption('maxsize')));
        $fileseltray->addElement(new XoopsFormLabel(''));
        $imgtray->addElement($fileseltray);
        $this->addElement($imgtray);
        // Created
        $this->addElement(new XoopsFormTextDateSelect(_AM_SOAPBOX8_SBCOLUMNS_CREATED, 'created', '', strtotime($this->targetObject->getVar('created'))));

        //permissions
        /** @var XoopsMemberHandler $memberHandler */
        $memberHandler = xoops_getHandler('member');
        $groupList     = $memberHandler->getGroupList();
        /** @var XoopsGroupPermHandler $gpermHandler */
        $gpermHandler = xoops_getHandler('groupperm');
        $fullList     = array_keys($groupList);

        //========================================================================

        $mid = $GLOBALS['xoopsModule']->mid();

        // create admin checkbox
        foreach ($groupList as $groupId => $groupName) {
            if ($groupId == XOOPS_GROUP_ADMIN) {
                $groupIdAdmin   = $groupId;
                $groupNameAdmin = $groupName;
            }
        }

        $selectPermAdmin = new XoopsFormCheckBox('', 'admin', XOOPS_GROUP_ADMIN);
        $selectPermAdmin->addOption($groupIdAdmin, $groupNameAdmin);
        $selectPermAdmin->setExtra("disabled='disabled'"); //comment it out, if you want to allow to remove permissions for the admin 

        // ********************************************************
        // permission view items
        $cat_gperms_read     = $gpermHandler->getGroupIds('soapbox8_view', $this->targetObject->getVar('columnID'), $mid);
        $arr_cat_gperms_read = $this->targetObject->isNew() ? '0' : $cat_gperms_read;

        $permsTray = new XoopsFormElementTray(_AM_SOAPBOX8_PERMISSIONS_VIEW, '');

        $selectAllReadCheckbox = new XoopsFormCheckBox('', 'adminbox1', 1);
        $selectAllReadCheckbox->addOption('allbox', _AM_SYSTEM_ALL);
        $selectAllReadCheckbox->setExtra(" onclick='xoopsCheckGroup(\"form\", \"adminbox1\" , \"groupsRead[]\");' ");
        $selectAllReadCheckbox->setClass('xo-checkall');
        $permsTray->addElement($selectAllReadCheckbox);

        // checkbox webmaster
        $permsTray->addElement($selectPermAdmin, false);
        // checkboxes other groups
        //$selectPerm = new XoopsFormCheckBox('', 'cat_gperms_read', $arr_cat_gperms_read);
        //$selectPerm = new XoopsFormCheckBox('', 'groupsRead[]', $this->targetObject->getGroupsRead());
        $selectPerm = new XoopsFormCheckBox('', 'groupsRead[]', $arr_cat_gperms_read);
        foreach ($groupList as $groupId => $groupName) {
            if ($groupId != XOOPS_GROUP_ADMIN) {
                $selectPerm->addOption($groupId, $groupName);
            }
        }
        $permsTray->addElement($selectPerm, false);
        $this->addElement($permsTray, false);
        unset($permsTray, $selectPerm);

        // ********************************************************
        // permission submit item
        $cat_gperms_create     = $gpermHandler->getGroupIds('soapbox8_submit', $this->targetObject->getVar('columnID'), $mid);
        $arr_cat_gperms_create = $this->targetObject->isNew() ? '0' : $cat_gperms_create;

        $permsTray = new XoopsFormElementTray(_AM_SOAPBOX8_PERMISSIONS_SUBMIT, '');

        $selectAllSubmitCheckbox = new XoopsFormCheckBox('', 'adminbox2', 1);
        $selectAllSubmitCheckbox->addOption('allbox', _AM_SYSTEM_ALL);
        $selectAllSubmitCheckbox->setExtra(" onclick='xoopsCheckGroup(\"form\", \"adminbox2\" , \"groupsSubmit[]\");' ");
        $selectAllSubmitCheckbox->setClass('xo-checkall');
        $permsTray->addElement($selectAllSubmitCheckbox);

        // checkbox webmaster
        $permsTray->addElement($selectPermAdmin, false);
        // checkboxes other groups
        //$selectPerm = new XoopsFormCheckBox('', 'cat_gperms_create', $arr_cat_gperms_create);
        $selectPerm = new XoopsFormCheckBox('', 'groupsSubmit[]', $arr_cat_gperms_create);
        foreach ($groupList as $groupId => $groupName) {
            if ($groupId != XOOPS_GROUP_ADMIN) {
                $selectPerm->addOption($groupId, $groupName);
            }
        }
        $permsTray->addElement($selectPerm, false);
        $this->addElement($permsTray, false);
        unset($permsTray, $selectPerm);

        // ********************************************************
        // permission approve items
        $cat_gperms_admin     = $gpermHandler->getGroupIds('soapbox8_approve', $this->targetObject->getVar('columnID'), $mid);
        $arr_cat_gperms_admin = $this->targetObject->isNew() ? '0' : $cat_gperms_admin;

        $permsTray = new XoopsFormElementTray(_AM_SOAPBOX8_PERMISSIONS_APPROVE, '');

        $selectAllModerateCheckbox = new XoopsFormCheckBox('', 'adminbox3', 1);
        $selectAllModerateCheckbox->addOption('allbox', _AM_SYSTEM_ALL);
        $selectAllModerateCheckbox->setExtra(" onclick='xoopsCheckGroup(\"form\", \"adminbox3\" , \"groupsModeration[]\");' ");
        $selectAllModerateCheckbox->setClass('xo-checkall');
        $permsTray->addElement($selectAllModerateCheckbox);

        // checkbox webmaster
        $permsTray->addElement($selectPermAdmin, false);
        // checkboxes other groups
        //$selectPerm = new XoopsFormCheckBox('', 'cat_gperms_admin', $arr_cat_gperms_admin);
        $selectPerm = new XoopsFormCheckBox('', 'groupsModeration[]', $arr_cat_gperms_admin);
        foreach ($groupList as $groupId => $groupName) {
            if ($groupId != XOOPS_GROUP_ADMIN && $groupId != XOOPS_GROUP_ANONYMOUS) {
                $selectPerm->addOption($groupId, $groupName);
            }
        }
        $permsTray->addElement($selectPerm, false);
        $this->addElement($permsTray, false);
        unset($permsTray, $selectPerm);

        //=========================================================================        
        $this->addElement(new XoopsFormHidden('op', 'save'));
        $this->addElement(new XoopsFormButton('', 'submit', _SUBMIT, 'submit'));
    }
}
