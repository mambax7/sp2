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
 * Class Soapbox8SbarticlesForm
 */
class Soapbox8SbarticlesForm extends XoopsThemeForm
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

        $title = $this->targetObject->isNew() ? sprintf(_AM_SOAPBOX8_SBARTICLES_ADD) : sprintf(_AM_SOAPBOX8_SBARTICLES_EDIT);
        parent::__construct($title, 'form', xoops_getenv('PHP_SELF'), 'post', true);
        $this->setExtra('enctype="multipart/form-data"');

        //include ID field, it's needed so the module knows if it is a new form or an edited form

        $hidden = new XoopsFormHidden('articleID', $this->targetObject->getVar('articleID'));
        $this->addElement($hidden);
        unset($hidden);

        // ArticleID
        $this->addElement(new XoopsFormLabel(_AM_SOAPBOX8_SBARTICLES_ARTICLEID, $this->targetObject->getVar('articleID'), 'articleID'));
        // ColumnID
        $sbcolumnsHandler    = xoops_getModuleHandler('sbcolumns', 'soapbox8');
        $sbcolumns_id_select = new XoopsFormSelect(_AM_SOAPBOX8_SBARTICLES_COLUMNID, 'columnID', $this->targetObject->getVar('columnID'));
        $sbcolumns_id_select->addOptionArray($sbcolumnsHandler->getList());
        $this->addElement($sbcolumns_id_select, false);
        // Headline
        $this->addElement(new XoopsFormText(_AM_SOAPBOX8_SBARTICLES_HEADLINE, 'headline', 50, 255, $this->targetObject->getVar('headline')), false);
        // Lead
        if (class_exists('XoopsFormEditor')) {
            $editorOptions           = array();
            $editorOptions['name']   = 'lead';
            $editorOptions['value']  = $this->targetObject->getVar('lead', 'e');
            $editorOptions['rows']   = 5;
            $editorOptions['cols']   = 40;
            $editorOptions['width']  = '100%';
            $editorOptions['height'] = '400px';
            //$editorOptions['editor'] = xoops_getModuleOption('soapbox8_editor', 'soapbox8');
            //$this->addElement( new XoopsFormEditor(_AM_SOAPBOX8_SBARTICLES_LEAD, 'lead', $editorOptions), false  );
            if ($moduleHelper->isUserAdmin()) {
                $descEditor = new XoopsFormEditor(_AM_SOAPBOX8_SBARTICLES_LEAD, $moduleHelper->getConfig('soapbox8EditorAdmin'), $editorOptions, $nohtml = false, $onfailure = 'textarea');
            } else {
                $descEditor = new XoopsFormEditor(_AM_SOAPBOX8_SBARTICLES_LEAD, $moduleHelper->getConfig('soapbox8EditorUser'), $editorOptions, $nohtml = false, $onfailure = 'textarea');
            }
        } else {
            $descEditor = new XoopsFormDhtmlTextArea(_AM_SOAPBOX8_SBARTICLES_LEAD, 'description', $this->targetObject->getVar('description', 'e'), '100%', '100%');
        }
        $this->addElement($descEditor);
        // Bodytext
        if (class_exists('XoopsFormEditor')) {
            $editorOptions           = array();
            $editorOptions['name']   = 'bodytext';
            $editorOptions['value']  = $this->targetObject->getVar('bodytext', 'e');
            $editorOptions['rows']   = 5;
            $editorOptions['cols']   = 40;
            $editorOptions['width']  = '100%';
            $editorOptions['height'] = '400px';
            //$editorOptions['editor'] = xoops_getModuleOption('soapbox8_editor', 'soapbox8');
            //$this->addElement( new XoopsFormEditor(_AM_SOAPBOX8_SBARTICLES_BODYTEXT, 'bodytext', $editorOptions), false  );
            if ($moduleHelper->isUserAdmin()) {
                $descEditor = new XoopsFormEditor(_AM_SOAPBOX8_SBARTICLES_BODYTEXT, $moduleHelper->getConfig('soapbox8EditorAdmin'), $editorOptions, $nohtml = false, $onfailure = 'textarea');
            } else {
                $descEditor = new XoopsFormEditor(_AM_SOAPBOX8_SBARTICLES_BODYTEXT, $moduleHelper->getConfig('soapbox8EditorUser'), $editorOptions, $nohtml = false, $onfailure = 'textarea');
            }
        } else {
            $descEditor = new XoopsFormDhtmlTextArea(_AM_SOAPBOX8_SBARTICLES_BODYTEXT, 'description', $this->targetObject->getVar('description', 'e'), '100%', '100%');
        }
        $this->addElement($descEditor);
        // Teaser
        if (class_exists('XoopsFormEditor')) {
            $editorOptions           = array();
            $editorOptions['name']   = 'teaser';
            $editorOptions['value']  = $this->targetObject->getVar('teaser', 'e');
            $editorOptions['rows']   = 5;
            $editorOptions['cols']   = 40;
            $editorOptions['width']  = '100%';
            $editorOptions['height'] = '400px';
            //$editorOptions['editor'] = xoops_getModuleOption('soapbox8_editor', 'soapbox8');
            //$this->addElement( new XoopsFormEditor(_AM_SOAPBOX8_SBARTICLES_TEASER, 'teaser', $editorOptions), false  );
            if ($moduleHelper->isUserAdmin()) {
                $descEditor = new XoopsFormEditor(_AM_SOAPBOX8_SBARTICLES_TEASER, $moduleHelper->getConfig('soapbox8EditorAdmin'), $editorOptions, $nohtml = false, $onfailure = 'textarea');
            } else {
                $descEditor = new XoopsFormEditor(_AM_SOAPBOX8_SBARTICLES_TEASER, $moduleHelper->getConfig('soapbox8EditorUser'), $editorOptions, $nohtml = false, $onfailure = 'textarea');
            }
        } else {
            $descEditor = new XoopsFormDhtmlTextArea(_AM_SOAPBOX8_SBARTICLES_TEASER, 'description', $this->targetObject->getVar('description', 'e'), '100%', '100%');
        }
        $this->addElement($descEditor);
        // Uid
        $this->addElement(new XoopsFormText(_AM_SOAPBOX8_SBARTICLES_UID, 'uid', 50, 255, $this->targetObject->getVar('uid')), false);
        // Submit
        $this->addElement(new XoopsFormText(_AM_SOAPBOX8_SBARTICLES_SUBMIT, 'submit', 50, 255, $this->targetObject->getVar('submit')), false);
        // Datesub
        $this->addElement(new XoopsFormText(_AM_SOAPBOX8_SBARTICLES_DATESUB, 'datesub', 50, 255, $this->targetObject->getVar('datesub')), false);
        // Counter
        $this->addElement(new XoopsFormText(_AM_SOAPBOX8_SBARTICLES_COUNTER, 'counter', 50, 255, $this->targetObject->getVar('counter')), false);
        // Weight
        $this->addElement(new XoopsFormText(_AM_SOAPBOX8_SBARTICLES_WEIGHT, 'weight', 50, 255, $this->targetObject->getVar('weight')), false);
        // Html
        $html       = $this->targetObject->isNew() ? 0 : $this->targetObject->getVar('html');
        $check_html = new XoopsFormCheckBox(_AM_SOAPBOX8_SBARTICLES_HTML, 'html', $html);
        $check_html->addOption(1, " ");
        $this->addElement($check_html);
        // Smiley
        $smiley       = $this->targetObject->isNew() ? 0 : $this->targetObject->getVar('smiley');
        $check_smiley = new XoopsFormCheckBox(_AM_SOAPBOX8_SBARTICLES_SMILEY, 'smiley', $smiley);
        $check_smiley->addOption(1, " ");
        $this->addElement($check_smiley);
        // Xcodes
        $xcodes       = $this->targetObject->isNew() ? 0 : $this->targetObject->getVar('xcodes');
        $check_xcodes = new XoopsFormCheckBox(_AM_SOAPBOX8_SBARTICLES_XCODES, 'xcodes', $xcodes);
        $check_xcodes->addOption(1, " ");
        $this->addElement($check_xcodes);
        // Breaks
        $breaks       = $this->targetObject->isNew() ? 0 : $this->targetObject->getVar('breaks');
        $check_breaks = new XoopsFormCheckBox(_AM_SOAPBOX8_SBARTICLES_BREAKS, 'breaks', $breaks);
        $check_breaks->addOption(1, " ");
        $this->addElement($check_breaks);
        // Block
        $this->addElement(new XoopsFormText(_AM_SOAPBOX8_SBARTICLES_BLOCK, 'block', 50, 255, $this->targetObject->getVar('block')), false);
        // Artimage
        $this->addElement(new XoopsFormText(_AM_SOAPBOX8_SBARTICLES_ARTIMAGE, 'artimage', 50, 255, $this->targetObject->getVar('artimage')), false);
        // Votes
        $this->addElement(new XoopsFormText(_AM_SOAPBOX8_SBARTICLES_VOTES, 'votes', 50, 255, $this->targetObject->getVar('votes')), false);
        // Rating
        $this->addElement(new XoopsFormText(_AM_SOAPBOX8_SBARTICLES_RATING, 'rating', 50, 255, $this->targetObject->getVar('rating')), false);
        // Commentable
        $commentable       = $this->targetObject->isNew() ? 0 : $this->targetObject->getVar('commentable');
        $check_commentable = new XoopsFormCheckBox(_AM_SOAPBOX8_SBARTICLES_COMMENTABLE, 'commentable', $commentable);
        $check_commentable->addOption(1, " ");
        $this->addElement($check_commentable);
        // Offline
        $offline       = $this->targetObject->isNew() ? 0 : $this->targetObject->getVar('offline');
        $check_offline = new XoopsFormCheckBox(_AM_SOAPBOX8_SBARTICLES_OFFLINE, 'offline', $offline);
        $check_offline->addOption(1, " ");
        $this->addElement($check_offline);
        // Notifypub
        $notifypub       = $this->targetObject->isNew() ? 0 : $this->targetObject->getVar('notifypub');
        $check_notifypub = new XoopsFormCheckBox(_AM_SOAPBOX8_SBARTICLES_NOTIFYPUB, 'notifypub', $notifypub);
        $check_notifypub->addOption(1, " ");
        $this->addElement($check_notifypub);

        $this->addElement(new XoopsFormHidden('op', 'save'));
        $this->addElement(new XoopsFormButton('', 'submit', _SUBMIT, 'submit'));
    }
}
