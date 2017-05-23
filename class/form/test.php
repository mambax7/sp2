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
 * Class Soapbox8TestForm
 */
class Soapbox8TestForm extends XoopsThemeForm
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

        $title = $this->targetObject->isNew() ? sprintf(_AM_SOAPBOX8_TEST_ADD) : sprintf(_AM_SOAPBOX8_TEST_EDIT);
        parent::__construct($title, 'form', xoops_getenv('PHP_SELF'), 'post', true);
        $this->setExtra('enctype="multipart/form-data"');

        //include ID field, it's needed so the module knows if it is a new form or an edited form

        $hidden = new XoopsFormHidden('id', $this->targetObject->getVar('id'));
        $this->addElement($hidden);
        unset($hidden);

        // Id
        $this->addElement(new XoopsFormLabel(_AM_SOAPBOX8_TEST_ID, $this->targetObject->getVar('id'), 'id'));
        // Text
        $this->addElement(new XoopsFormText(_AM_SOAPBOX8_TEST_TEXT, 'text', 50, 255, $this->targetObject->getVar('text')), false);
        // Textarea
        $this->addElement(new XoopsFormTextArea(_AM_SOAPBOX8_TEST_TEXTAREA, 'textarea', $this->targetObject->getVar('textarea'), 4, 47), false);
        // Dhtml
        if (class_exists('XoopsFormEditor')) {
            $editorOptions           = array();
            $editorOptions['name']   = 'dhtml';
            $editorOptions['value']  = $this->targetObject->getVar('dhtml', 'e');
            $editorOptions['rows']   = 5;
            $editorOptions['cols']   = 40;
            $editorOptions['width']  = '100%';
            $editorOptions['height'] = '400px';
            //$editorOptions['editor'] = xoops_getModuleOption('soapbox8_editor', 'soapbox8');
            //$this->addElement( new XoopsFormEditor(_AM_SOAPBOX8_TEST_DHTML, 'dhtml', $editorOptions), false  );
            if ($moduleHelper->isUserAdmin()) {
                $descEditor = new XoopsFormEditor(_AM_SOAPBOX8_TEST_DHTML, $moduleHelper->getConfig('soapbox8EditorAdmin'), $editorOptions, $nohtml = false, $onfailure = 'textarea');
            } else {
                $descEditor = new XoopsFormEditor(_AM_SOAPBOX8_TEST_DHTML, $moduleHelper->getConfig('soapbox8EditorUser'), $editorOptions, $nohtml = false, $onfailure = 'textarea');
            }
        } else {
            $descEditor = new XoopsFormDhtmlTextArea(_AM_SOAPBOX8_TEST_DHTML, 'description', $this->targetObject->getVar('description', 'e'), '100%', '100%');
        }
        $this->addElement($descEditor);
        // Checkbox
        $checkbox       = $this->targetObject->isNew() ? 0 : $this->targetObject->getVar('checkbox');
        $check_checkbox = new XoopsFormCheckBox(_AM_SOAPBOX8_TEST_CHECKBOX, 'checkbox', $checkbox);
        $check_checkbox->addOption(1, " ");
        $this->addElement($check_checkbox);
        // Radioyn
        $radioyn = $this->targetObject->isNew() ? 0 : $this->targetObject->getVar('radioyn');
        $this->addElement(new XoopsFormRadioYN(_AM_SOAPBOX8_TEST_RADIOYN, 'radioyn', $radioyn), false);
        // Selectbox
        $selectbox    = new XoopsFormSelect(_AM_SOAPBOX8_TEST_SELECTBOX, 'selectbox', $this->targetObject->getVar('selectbox'));
        $optionsArray = Soapbox8Utility::enumerate('soapbox8_test', 'selectbox');
        foreach ($optionsArray as $enum) {
            $selectbox->addOption($enum, (defined($enum) ? constant($enum) : $enum));
        }
        $this->addElement($selectbox, false);
        // Selectuser
        $this->addElement(new XoopsFormSelectUser(_AM_SOAPBOX8_TEST_SELECTUSER, 'selectuser', false, $this->targetObject->getVar('selectuser'), 1, false), false);
        // Colorpicker
        $this->addElement(new XoopsFormColorPicker(_AM_SOAPBOX8_TEST_COLORPICKER, 'colorpicker', $this->targetObject->getVar('colorpicker')), false);
        // Uploadimage
        $uploadimage = $this->targetObject->getVar('uploadimage') ? $this->targetObject->getVar('uploadimage') : 'blank.png';

        $uploadDir   = '/uploads/soapbox8/images/';
        $imgtray     = new XoopsFormElementTray(_AM_SOAPBOX8_TEST_UPLOADIMAGE, '<br>');
        $imgpath     = sprintf(_AM_SOAPBOX8_FORMIMAGE_PATH, $uploadDir);
        $imageselect = new XoopsFormSelect($imgpath, 'uploadimage', $uploadimage);
        $imageArray  = XoopsLists::getImgListAsArray(XOOPS_ROOT_PATH . $uploadDir);
        foreach ($imageArray as $image) {
            $imageselect->addOption("$image", $image);
        }
        $imageselect->setExtra("onchange='showImgSelected(\"image_uploadimage\", \"uploadimage\", \"" . $uploadDir . "\", \"\", \"" . XOOPS_URL . "\")'");
        $imgtray->addElement($imageselect);
        $imgtray->addElement(new XoopsFormLabel('', "<br><img src='" . XOOPS_URL . '/' . $uploadDir . '/' . $uploadimage . "' name='image_uploadimage' id='image_uploadimage' alt='' />"));
        $fileseltray = new XoopsFormElementTray('', '<br>');
        $fileseltray->addElement(new XoopsFormFile(_AM_SOAPBOX8_FORMUPLOAD, 'uploadimage', xoops_getModuleOption('maxsize')));
        $fileseltray->addElement(new XoopsFormLabel(''));
        $imgtray->addElement($fileseltray);
        $this->addElement($imgtray);
        // Uploadfile
        $this->addElement(new XoopsFormFile(_AM_SOAPBOX8_TEST_UPLOADFILE, 'uploadfile', $moduleHelper->getConfig('maxsize')), false);
        // Textdataselect
        $this->addElement(new XoopsFormTextDateSelect(_AM_SOAPBOX8_TEST_TEXTDATASELECT, 'textdataselect', '', strtotime($this->targetObject->getVar('textdataselect'))));
        // Datetimeselect
        $this->addElement(new XoopsFormDateTime(_AM_SOAPBOX8_TEST_DATETIMESELECT, 'datetimeselect', '', strtotime($this->targetObject->getVar('datetimeselect'))));
        // Articleslink
        $sbarticlesHandler    = xoops_getModuleHandler('sbarticles', 'soapbox8');
        $sbarticles_id_select = new XoopsFormSelect(_AM_SOAPBOX8_TEST_ARTICLESLINK, 'articleslink', $this->targetObject->getVar('articleslink'));
        $sbarticles_id_select->addOptionArray($sbarticlesHandler->getList());
        $this->addElement($sbarticles_id_select, false);

        $this->addElement(new XoopsFormHidden('op', 'save'));
        $this->addElement(new XoopsFormButton('', 'submit', _SUBMIT, 'submit'));
    }
}
