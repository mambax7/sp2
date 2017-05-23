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
use Xmf\Database\Tables;
use Xmf\Debug;
use Xmf\Module\Helper;
use Xmf\Module\Helper\Permission;
use Xmf\Request;

require_once __DIR__ . '/admin_header.php';
xoops_cp_header();
//It recovered the value of argument op in URL$
$op    = Request::getString('op', 'list');
$order = Request::getString('order', 'desc');
$sort  = Request::getString('sort', '');

$adminObject->displayNavigation(basename(__FILE__));
/** @var Permission $permHelper */
$permHelper = new Permission($moduleDirName);

switch ($op) {
    case 'list':
    default:
        $adminObject->addItemButton(_AM_SOAPBOX8_ADD_TEST, 'test.php?op=new', 'add');
        echo $adminObject->displayButton('left');
        $start               = Request::getInt('start', 0);
        $testPaginationLimit = $GLOBALS['xoopsModuleConfig']['userpager'];

        $criteria = new CriteriaCompo();
        $criteria->setSort('id ASC, text');
        $criteria->setOrder('ASC');
        $criteria->setLimit($testPaginationLimit);
        $criteria->setStart($start);
        $testTempRows  = $testHandler->getCount();
        $testTempArray = $testHandler->getAll($criteria);/*
//
// 
                    <th class='center width5'>"._AM_SOAPBOX8_FORM_ACTION."</th>
//                    </tr>";
//            $class = "odd";
*/

        // Display Page Navigation
        if ($testTempRows > $testPaginationLimit) {
            require_once XOOPS_ROOT_PATH . '/class/pagenav.php';

            $pagenav = new XoopsPageNav($testTempRows, $testPaginationLimit, $start, 'start', 'op=list' . '&sort=' . $sort . '&order=' . $order . '');
            $GLOBALS['xoopsTpl']->assign('pagenav', null === $pagenav ? $pagenav->renderNav() : '');
        }

        $GLOBALS['xoopsTpl']->assign('testRows', $testTempRows);
        $testArray = array();

        //    $fields = explode('|', id:int:8::NOT NULL:::id|text:varchar:55::NOT NULL:::text|textarea:text:::NOT NULL:::textarea|dhtml:text:::NOT NULL:::dhtml|checkbox:int:::NOT NULL:::checkbox|radioyn:int:::NOT NULL:::radioyn|selectbox:int:::NOT NULL:::selectbox|selectuser:int:::NOT NULL:::selectuser|colorpicker:varchar:50::NOT NULL:::colorpicker|uploadimage:varchar:100::NOT NULL:::uploadimage|uploadfile:varchar:100::NOT NULL:::uploadfile|textdataselect:varchar:55::NOT NULL:::textdataselect|datetimeselect:int:::NOT NULL:::datetimeselect|articleslink:int:::NOT NULL:::articleslink);
        //    $fieldsCount    = count($fields);

        $criteria = new CriteriaCompo();

        //$criteria->setOrder('DESC');
        $criteria->setSort($sort);
        $criteria->setOrder($order);
        $criteria->setLimit($testPaginationLimit);
        $criteria->setStart($start);

        $testCount     = $testHandler->getCount($criteria);
        $testTempArray = $testHandler->getAll($criteria);

        //    for ($i = 0; $i < $fieldsCount; ++$i) {
        if ($testCount > 0) {
            foreach (array_keys($testTempArray) as $i) {

                //        $field = explode(':', $fields[$i]);

                $selectorid = Soapbox8Utility::selectSorting(_AM_SOAPBOX8_TEST_ID, 'id');
                $GLOBALS['xoopsTpl']->assign('selectorid', $selectorid);
                $testArray['id'] = $testTempArray[$i]->getVar('id');

                $selectortext = Soapbox8Utility::selectSorting(_AM_SOAPBOX8_TEST_TEXT, 'text');
                $GLOBALS['xoopsTpl']->assign('selectortext', $selectortext);
                $testArray['text'] = $testTempArray[$i]->getVar('text');

                $selectortextarea = Soapbox8Utility::selectSorting(_AM_SOAPBOX8_TEST_TEXTAREA, 'textarea');
                $GLOBALS['xoopsTpl']->assign('selectortextarea', $selectortextarea);
                $testArray['textarea'] = strip_tags($testTempArray[$i]->getVar('textarea'));

                $selectordhtml = Soapbox8Utility::selectSorting(_AM_SOAPBOX8_TEST_DHTML, 'dhtml');
                $GLOBALS['xoopsTpl']->assign('selectordhtml', $selectordhtml);
                $testArray['dhtml'] = strip_tags($testTempArray[$i]->getVar('dhtml'));

                $selectorcheckbox = Soapbox8Utility::selectSorting(_AM_SOAPBOX8_TEST_CHECKBOX, 'checkbox');
                $GLOBALS['xoopsTpl']->assign('selectorcheckbox', $selectorcheckbox);
                $testArray['checkbox'] = $testTempArray[$i]->getVar('checkbox');

                $selectorradioyn = Soapbox8Utility::selectSorting(_AM_SOAPBOX8_TEST_RADIOYN, 'radioyn');
                $GLOBALS['xoopsTpl']->assign('selectorradioyn', $selectorradioyn);
                $testArray['radioyn'] = $testTempArray[$i]->getVar('radioyn');

                $selectorselectbox = Soapbox8Utility::selectSorting(_AM_SOAPBOX8_TEST_SELECTBOX, 'selectbox');
                $GLOBALS['xoopsTpl']->assign('selectorselectbox', $selectorselectbox);
                $testArray['selectbox'] = $testTempArray[$i]->getVar('selectbox');

                $selectorselectuser = Soapbox8Utility::selectSorting(_AM_SOAPBOX8_TEST_SELECTUSER, 'selectuser');
                $GLOBALS['xoopsTpl']->assign('selectorselectuser', $selectorselectuser);
                $testArray['selectuser'] = $testTempArray[$i]->getVar('selectuser');

                $selectorcolorpicker = Soapbox8Utility::selectSorting(_AM_SOAPBOX8_TEST_COLORPICKER, 'colorpicker');
                $GLOBALS['xoopsTpl']->assign('selectorcolorpicker', $selectorcolorpicker);
                $testArray['colorpicker'] = $testTempArray[$i]->getVar('colorpicker');

                $selectoruploadimage = Soapbox8Utility::selectSorting(_AM_SOAPBOX8_TEST_UPLOADIMAGE, 'uploadimage');
                $GLOBALS['xoopsTpl']->assign('selectoruploadimage', $selectoruploadimage);
                $testArray['uploadimage'] = $testTempArray[$i]->getVar('uploadimage');

                $selectoruploadfile = Soapbox8Utility::selectSorting(_AM_SOAPBOX8_TEST_UPLOADFILE, 'uploadfile');
                $GLOBALS['xoopsTpl']->assign('selectoruploadfile', $selectoruploadfile);
                $testArray['uploadfile'] = $testTempArray[$i]->getVar('uploadfile');

                $selectortextdataselect = Soapbox8Utility::selectSorting(_AM_SOAPBOX8_TEST_TEXTDATASELECT, 'textdataselect');
                $GLOBALS['xoopsTpl']->assign('selectortextdataselect', $selectortextdataselect);
                $testArray['textdataselect'] = date(_SHORTDATESTRING, strtotime($testTempArray[$i]->getVar('textdataselect')));

                $selectordatetimeselect = Soapbox8Utility::selectSorting(_AM_SOAPBOX8_TEST_DATETIMESELECT, 'datetimeselect');
                $GLOBALS['xoopsTpl']->assign('selectordatetimeselect', $selectordatetimeselect);
                $testArray['datetimeselect'] = date(_DATESTRING, strtotime($testTempArray[$i]->getVar('datetimeselect')));

                $selectorarticleslink = Soapbox8Utility::selectSorting(_AM_SOAPBOX8_TEST_ARTICLESLINK, 'articleslink');
                $GLOBALS['xoopsTpl']->assign('selectorarticleslink', $selectorarticleslink);
                $testArray['articleslink'] = $sbarticlesHandler->get($testTempArray[$i]->getVar('articleslink'))->getVar('headline');
                $testArray['edit_delete']  = "<a href='test.php?op=edit&id=" . $i . "'><img src=" . $pathIcon16 . "/edit.png alt='" . _EDIT . "' title='" . _EDIT . "'></a>
               <a href='test.php?op=delete&id=" . $i . "'><img src=" . $pathIcon16 . "/delete.png alt='" . _DELETE . "' title='" . _DELETE . "'></a>
               <a href='test.php?op=clone&id=" . $i . "'><img src=" . $pathIcon16 . "/editcopy.png alt='" . _CLONE . "' title='" . _CLONE . "'></a>";

                $GLOBALS['xoopsTpl']->append_by_ref('testArrays', $testArray);
                unset($testArray);
            }
            unset($testTempArray);
            // Display Navigation
            if ($testCount > $testPaginationLimit) {
                require_once XOOPS_ROOT_PATH . '/class/pagenav.php';
                $pagenav = new XoopsPageNav($testCount, $testPaginationLimit, $start, 'start', 'op=list' . '&sort=' . $sort . '&order=' . $order . '');
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
            }

            //                     echo "<td class='center width5'>

            //                    <a href='test.php?op=edit&id=".$i."'><img src=".$pathIcon16."/edit.png alt='"._EDIT."' title='"._EDIT."'></a>
            //                    <a href='test.php?op=delete&id=".$i."'><img src=".$pathIcon16."/delete.png alt='"._DELETE."' title='"._DELETE."'></a>
            //                    </td>";

            //                echo "</tr>";

            //            }

            //            echo "</table><br><br>";

            //        } else {

            //            echo "<table width='100%' cellspacing='1' class='outer'>

            //                    <tr>

            //                     <th class='center width5'>"._AM_SOAPBOX8_FORM_ACTION."XXX</th>
            //                    </tr><tr><td class='errorMsg' colspan='15'>There are noXXX test</td></tr>";
            //            echo "</table><br><br>";

            //-------------------------------------------

            echo $GLOBALS['xoopsTpl']->fetch(XOOPS_ROOT_PATH . '/modules/' . $GLOBALS['xoopsModule']->getVar('dirname') . '/templates/admin/soapbox8_admin_test.tpl');
        }

        break;

    case 'new':
        $adminObject->addItemButton(_AM_SOAPBOX8_TEST_LIST, 'test.php', 'list');
        echo $adminObject->displayButton('left');

        $testObject = $testHandler->create();
        $form       = $testObject->getForm();
        $form->display();
        break;

    case 'save':
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('test.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if (0 != Request::getInt('id', 0)) {
            $testObject = $testHandler->get(Request::getInt('id', 0));
        } else {
            $testObject = $testHandler->create();
        }
        // Form save fields
        $testObject->setVar('text', Request::getVar('text', ''));
        $testObject->setVar('textarea', Request::getVar('textarea', ''));
        $testObject->setVar('dhtml', Request::getVar('dhtml', ''));
        $testObject->setVar('checkbox', ((1 == Request::getInt('checkbox', 0)) ? '1' : '0'));
        $testObject->setVar('radioyn', ((1 == Request::getInt('radioyn', 0)) ? '1' : '0'));
        $testObject->setVar('selectbox', Request::getVar('selectbox', ''));
        $testObject->setVar('selectuser', Request::getVar('selectuser', ''));
        $testObject->setVar('colorpicker', Request::getVar('colorpicker', ''));

        require_once XOOPS_ROOT_PATH . '/class/uploader.php';
        $uploadDir = XOOPS_UPLOAD_PATH . '/soapbox8/images/';
        $uploader  = new XoopsMediaUploader($uploadDir, xoops_getModuleOption('mimetypes', 'soapbox8'), xoops_getModuleOption('maxsize', 'soapbox8'), null, null);
        if ($uploader->fetchMedia(Request::getArray('xoops_upload_file', '', 'POST')[0])) {

            //$extension = preg_replace( '/^.+\.([^.]+)$/sU' , '' , $_FILES['attachedfile']['name']);
            //$imgName = str_replace(' ', '', $_POST['']).'.'.$extension;

            $uploader->setPrefix('uploadimage_');
            $uploader->fetchMedia(Request::getArray('xoops_upload_file', '', 'POST')[0]);
            if (!$uploader->upload()) {
                $errors = $uploader->getErrors();
                redirect_header('javascript:history.go(-1)', 3, $errors);
            } else {
                $testObject->setVar('uploadimage', $uploader->getSavedFileName());
            }
        } else {
            $testObject->setVar('uploadimage', Request::getVar('uploadimage', ''));
        }

        require_once XOOPS_ROOT_PATH . '/class/uploader.php';
        $uploadDir = XOOPS_UPLOAD_PATH . '/soapbox8/files/test/';
        $uploader  = new XoopsMediaUploader($uploadDir, xoops_getModuleOption('mimetypes', 'soapbox8'), xoops_getModuleOption('maxsize', 'soapbox8'), null, null);
        if ($uploader->fetchMedia(Request::getString('xoops_upload_file')[0], '', 'POST')) {
            $uploader->setPrefix('uploadfile_');
            $uploader->fetchMedia(Request::getString('xoops_upload_file')[0], '', 'POST');
            if (!$uploader->upload()) {
                $errors = $uploader->getErrors();
                redirect_header('javascript:history.go(-1)', 3, $errors);
            } else {
                $testObject->setVar("uploadfile", $uploader->getSavedFileName());
            }
        }

        $testObject->setVar('textdataselect', $_REQUEST['textdataselect']);
        $testObject->setVar('datetimeselect', date('Y-m-d H:i:s', strtotime($_REQUEST['datetimeselect']['date']) + $_REQUEST['datetimeselect']['time']));
        $testObject->setVar('articleslink', Request::getVar('articleslink', ''));
        if ($testHandler->insert($testObject)) {
            redirect_header('test.php?op=list', 2, _AM_SOAPBOX8_FORMOK);
        }

        echo $testObject->getHtmlErrors();
        $form = $testObject->getForm();
        $form->display();
        break;

    case 'edit':
        $adminObject->addItemButton(_AM_SOAPBOX8_ADD_TEST, 'test.php?op=new', 'add');
        $adminObject->addItemButton(_AM_SOAPBOX8_TEST_LIST, 'test.php', 'list');
        echo $adminObject->displayButton('left');
        $testObject = $testHandler->get(Request::getString('id', ''));
        $form       = $testObject->getForm();
        $form->display();
        break;

    case 'delete':
        $testObject = $testHandler->get(Request::getString('id', ''));
        if (1 == Request::getInt('ok', 0)) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                redirect_header('test.php', 3, implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($testHandler->delete($testObject)) {
                redirect_header('test.php', 3, _AM_SOAPBOX8_FORMDELOK);
            } else {
                echo $testObject->getHtmlErrors();
            }
        } else {
            xoops_confirm(array('ok' => 1, 'id' => Request::getString('id', ''), 'op' => 'delete'), Request::getCmd('REQUEST_URI', '', 'SERVER'), sprintf(_AM_SOAPBOX8_FORMSUREDEL, $testObject->getVar('text')));
        }
        break;

    case 'clone':

        $id_field = Request::getString('id', '');

        if (Soapbox8Utility::cloneRecord('soapbox8_test', 'id', $id_field)) {
            redirect_header('test.php', 3, _AM_SOAPBOX8_CLONED_OK);
        } else {
            redirect_header('test.php', 3, _AM_SOAPBOX8_CLONED_FAILED);
        }

        break;
}
require_once __DIR__ . '/admin_footer.php';
