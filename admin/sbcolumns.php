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
        $adminObject->addItemButton(_AM_SOAPBOX8_ADD_SBCOLUMNS, 'sbcolumns.php?op=new', 'add');
        echo $adminObject->displayButton('left');
        $start                    = Request::getInt('start', 0);
        $sbcolumnsPaginationLimit = $GLOBALS['xoopsModuleConfig']['userpager'];

        $criteria = new CriteriaCompo();
        $criteria->setSort('columnID ASC, name');
        $criteria->setOrder('ASC');
        $criteria->setLimit($sbcolumnsPaginationLimit);
        $criteria->setStart($start);
        $sbcolumnsTempRows  = $sbcolumnsHandler->getCount();
        $sbcolumnsTempArray = $sbcolumnsHandler->getAll($criteria);/*
//
// 
                    <th class='center width5'>"._AM_SOAPBOX8_FORM_ACTION."</th>
//                    </tr>";
//            $class = "odd";
*/

        // Display Page Navigation
        if ($sbcolumnsTempRows > $sbcolumnsPaginationLimit) {
            require_once XOOPS_ROOT_PATH . '/class/pagenav.php';

            $pagenav = new XoopsPageNav($sbcolumnsTempRows, $sbcolumnsPaginationLimit, $start, 'start', 'op=list' . '&sort=' . $sort . '&order=' . $order . '');
            $GLOBALS['xoopsTpl']->assign('pagenav', null === $pagenav ? $pagenav->renderNav() : '');
        }

        $GLOBALS['xoopsTpl']->assign('sbcolumnsRows', $sbcolumnsTempRows);
        $sbcolumnsArray = array();

        //    $fields = explode('|', columnID:tinyint:4::NOT NULL::primary:columnID|author:int:8::NOT NULL:::author|name:varchar:255::NOT NULL:::name|description:text:0::NOT NULL:::description|total:int:11::NOT NULL:0::total|weight:int:11::NOT NULL:1::weight|colimage:varchar:255::NOT NULL:blank.png::colimage|created:int:11::NOT NULL:1033141070::created);
        //    $fieldsCount    = count($fields);

        $criteria = new CriteriaCompo();

        //$criteria->setOrder('DESC');
        $criteria->setSort($sort);
        $criteria->setOrder($order);
        $criteria->setLimit($sbcolumnsPaginationLimit);
        $criteria->setStart($start);

        $sbcolumnsCount     = $sbcolumnsHandler->getCount($criteria);
        $sbcolumnsTempArray = $sbcolumnsHandler->getAll($criteria);

        //    for ($i = 0; $i < $fieldsCount; ++$i) {
        if ($sbcolumnsCount > 0) {
            foreach (array_keys($sbcolumnsTempArray) as $i) {

                //        $field = explode(':', $fields[$i]);

                $selectorcolumnID = Soapbox8Utility::selectSorting(_AM_SOAPBOX8_SBCOLUMNS_COLUMNID, 'columnID');
                $GLOBALS['xoopsTpl']->assign('selectorcolumnID', $selectorcolumnID);
                $sbcolumnsArray['columnID'] = $sbcolumnsTempArray[$i]->getVar('columnID');

                $selectorauthor = Soapbox8Utility::selectSorting(_AM_SOAPBOX8_SBCOLUMNS_AUTHOR, 'author');
                $GLOBALS['xoopsTpl']->assign('selectorauthor', $selectorauthor);
                $sbcolumnsArray['author'] = $sbcolumnsTempArray[$i]->getVar('author');

                $selectorname = Soapbox8Utility::selectSorting(_AM_SOAPBOX8_SBCOLUMNS_NAME, 'name');
                $GLOBALS['xoopsTpl']->assign('selectorname', $selectorname);
                $sbcolumnsArray['name'] = $sbcolumnsTempArray[$i]->getVar('name');

                $selectordescription = Soapbox8Utility::selectSorting(_AM_SOAPBOX8_SBCOLUMNS_DESCRIPTION, 'description');
                $GLOBALS['xoopsTpl']->assign('selectordescription', $selectordescription);
                $sbcolumnsArray['description'] = strip_tags($sbcolumnsTempArray[$i]->getVar('description'));

                $selectortotal = Soapbox8Utility::selectSorting(_AM_SOAPBOX8_SBCOLUMNS_TOTAL, 'total');
                $GLOBALS['xoopsTpl']->assign('selectortotal', $selectortotal);
                $sbcolumnsArray['total'] = $sbcolumnsTempArray[$i]->getVar('total');

                $selectorweight = Soapbox8Utility::selectSorting(_AM_SOAPBOX8_SBCOLUMNS_WEIGHT, 'weight');
                $GLOBALS['xoopsTpl']->assign('selectorweight', $selectorweight);
                $sbcolumnsArray['weight'] = $sbcolumnsTempArray[$i]->getVar('weight');

                $selectorcolimage = Soapbox8Utility::selectSorting(_AM_SOAPBOX8_SBCOLUMNS_COLIMAGE, 'colimage');
                $GLOBALS['xoopsTpl']->assign('selectorcolimage', $selectorcolimage);
                $sbcolumnsArray['colimage'] = $sbcolumnsTempArray[$i]->getVar('colimage');

                $selectorcreated = Soapbox8Utility::selectSorting(_AM_SOAPBOX8_SBCOLUMNS_CREATED, 'created');
                $GLOBALS['xoopsTpl']->assign('selectorcreated', $selectorcreated);
                $sbcolumnsArray['created']     = date(_SHORTDATESTRING, strtotime($sbcolumnsTempArray[$i]->getVar('created')));
                $sbcolumnsArray['edit_delete'] = "<a href='sbcolumns.php?op=edit&columnID=" . $i . "'><img src=" . $pathIcon16 . "/edit.png alt='" . _EDIT . "' title='" . _EDIT . "'></a>
               <a href='sbcolumns.php?op=delete&columnID=" . $i . "'><img src=" . $pathIcon16 . "/delete.png alt='" . _DELETE . "' title='" . _DELETE . "'></a>
               <a href='sbcolumns.php?op=clone&columnID=" . $i . "'><img src=" . $pathIcon16 . "/editcopy.png alt='" . _CLONE . "' title='" . _CLONE . "'></a>";

                $GLOBALS['xoopsTpl']->append_by_ref('sbcolumnsArrays', $sbcolumnsArray);
                unset($sbcolumnsArray);
            }
            unset($sbcolumnsTempArray);
            // Display Navigation
            if ($sbcolumnsCount > $sbcolumnsPaginationLimit) {
                require_once XOOPS_ROOT_PATH . '/class/pagenav.php';
                $pagenav = new XoopsPageNav($sbcolumnsCount, $sbcolumnsPaginationLimit, $start, 'start', 'op=list' . '&sort=' . $sort . '&order=' . $order . '');
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
            }

            //                     echo "<td class='center width5'>

            //                    <a href='sbcolumns.php?op=edit&columnID=".$i."'><img src=".$pathIcon16."/edit.png alt='"._EDIT."' title='"._EDIT."'></a>
            //                    <a href='sbcolumns.php?op=delete&columnID=".$i."'><img src=".$pathIcon16."/delete.png alt='"._DELETE."' title='"._DELETE."'></a>
            //                    </td>";

            //                echo "</tr>";

            //            }

            //            echo "</table><br><br>";

            //        } else {

            //            echo "<table width='100%' cellspacing='1' class='outer'>

            //                    <tr>

            //                     <th class='center width5'>"._AM_SOAPBOX8_FORM_ACTION."XXX</th>
            //                    </tr><tr><td class='errorMsg' colspan='9'>There are noXXX sbcolumns</td></tr>";
            //            echo "</table><br><br>";

            //-------------------------------------------

            echo $GLOBALS['xoopsTpl']->fetch(XOOPS_ROOT_PATH . '/modules/' . $GLOBALS['xoopsModule']->getVar('dirname') . '/templates/admin/soapbox8_admin_sbcolumns.tpl');
        }

        break;

    case 'new':
        $adminObject->addItemButton(_AM_SOAPBOX8_SBCOLUMNS_LIST, 'sbcolumns.php', 'list');
        echo $adminObject->displayButton('left');

        $sbcolumnsObject = $sbcolumnsHandler->create();
        $form            = $sbcolumnsObject->getForm();
        $form->display();
        break;

    case 'save':
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('sbcolumns.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if (0 != Request::getInt('columnID', 0)) {
            $sbcolumnsObject = $sbcolumnsHandler->get(Request::getInt('columnID', 0));
        } else {
            $sbcolumnsObject = $sbcolumnsHandler->create();
        }
        // Form save fields
        $sbcolumnsObject->setVar('author', Request::getVar('author', ''));
        $sbcolumnsObject->setVar('name', Request::getVar('name', ''));
        $sbcolumnsObject->setVar('description', Request::getVar('description', ''));
        $sbcolumnsObject->setVar('total', Request::getVar('total', ''));
        $sbcolumnsObject->setVar('weight', Request::getVar('weight', ''));

        require_once XOOPS_ROOT_PATH . '/class/uploader.php';
        $uploadDir = XOOPS_UPLOAD_PATH . '/soapbox8/images/';
        $uploader  = new XoopsMediaUploader($uploadDir, xoops_getModuleOption('mimetypes', 'soapbox8'), xoops_getModuleOption('maxsize', 'soapbox8'), null, null);
        if ($uploader->fetchMedia(Request::getArray('xoops_upload_file', '', 'POST')[0])) {

            //$extension = preg_replace( '/^.+\.([^.]+)$/sU' , '' , $_FILES['attachedfile']['name']);
            //$imgName = str_replace(' ', '', $_POST['']).'.'.$extension;

            $uploader->setPrefix('colimage_');
            $uploader->fetchMedia(Request::getArray('xoops_upload_file', '', 'POST')[0]);
            if (!$uploader->upload()) {
                $errors = $uploader->getErrors();
                redirect_header('javascript:history.go(-1)', 3, $errors);
            } else {
                $sbcolumnsObject->setVar('colimage', $uploader->getSavedFileName());
            }
        } else {
            $sbcolumnsObject->setVar('colimage', Request::getVar('colimage', ''));
        }

        $sbcolumnsObject->setVar('created', $_REQUEST['created']);
        //Permissions
        //===============================================================

        $mid = $GLOBALS['xoopsModule']->mid();
        /** @var XoopsGroupPermHandler $gpermHandler */
        $gpermHandler = xoops_getHandler('groupperm');
        $columnID     = Request::getInt('columnID', 0);

        /**
         * @param $myArray
         * @param $permissionGroup
         * @param $columnID
         * @param $gpermHandler
         * @param $permissionName
         * @param $mid
         */
        function setPermissions($myArray, $permissionGroup, $columnID, $gpermHandler, $permissionName, $mid)
        {
            $permissionArray = $myArray;
            if ($columnID > 0) {
                $sql = 'DELETE FROM `' . $GLOBALS['xoopsDB']->prefix('group_permission') . "` WHERE `gperm_name` = '" . $permissionName . "' AND `gperm_itemid`= $columnID;";
                $GLOBALS['xoopsDB']->query($sql);
            }
            //admin
            $gperm = $gpermHandler->create();
            $gperm->setVar('gperm_groupid', XOOPS_GROUP_ADMIN);
            $gperm->setVar('gperm_name', $permissionName);
            $gperm->setVar('gperm_modid', $mid);
            $gperm->setVar('gperm_itemid', $columnID);
            $gpermHandler->insert($gperm);
            unset($gperm);
            //non-Admin groups
            if (is_array($permissionArray)) {
                foreach ($permissionArray as $key => $cat_groupperm) {
                    if ($cat_groupperm > 0) {
                        $gperm = $gpermHandler->create();
                        $gperm->setVar('gperm_groupid', $cat_groupperm);
                        $gperm->setVar('gperm_name', $permissionName);
                        $gperm->setVar('gperm_modid', $mid);
                        $gperm->setVar('gperm_itemid', $columnID);
                        $gpermHandler->insert($gperm);
                        unset($gperm);
                    }
                }
            } elseif ($permissionArray > 0) {
                $gperm = $gpermHandler->create();
                $gperm->setVar('gperm_groupid', $permissionArray);
                $gperm->setVar('gperm_name', $permissionName);
                $gperm->setVar('gperm_modid', $mid);
                $gperm->setVar('gperm_itemid', $columnID);
                $gpermHandler->insert($gperm);
                unset($gperm);
            }
        }

        //setPermissions for View items
        $permissionGroup   = 'groupsRead';
        $permissionName    = 'soapbox8_view';
        $permissionArray   = Request::getArray($permissionGroup, '');
        $permissionArray[] = XOOPS_GROUP_ADMIN;
        //setPermissions($permissionArray, $permissionGroup, $columnID, $gpermHandler, $permissionName, $mid);
        $permHelper->savePermissionForItem($permissionName, $columnID, $permissionArray);

        //setPermissions for Submit items
        $permissionGroup   = 'groupsSubmit';
        $permissionName    = 'soapbox8_submit';
        $permissionArray   = Request::getArray($permissionGroup, '');
        $permissionArray[] = XOOPS_GROUP_ADMIN;
        //setPermissions($permissionArray, $permissionGroup, $columnID, $gpermHandler, $permissionName, $mid);
        $permHelper->savePermissionForItem($permissionName, $columnID, $permissionArray);

        //setPermissions for Approve items
        $permissionGroup   = 'groupsModeration';
        $permissionName    = 'soapbox8_approve';
        $permissionArray   = Request::getArray($permissionGroup, '');
        $permissionArray[] = XOOPS_GROUP_ADMIN;
        //setPermissions($permissionArray, $permissionGroup, $columnID, $gpermHandler, $permissionName, $mid);
        $permHelper->savePermissionForItem($permissionName, $columnID, $permissionArray);

        /*
                    //Form soapbox8_view
                    $arr_soapbox8_view = Request::getArray('cat_gperms_read');
                    if ($columnID > 0) {
                        $sql
                            =
                            'DELETE FROM `' . $GLOBALS['xoopsDB']->prefix('group_permission') . "` WHERE `gperm_name`='soapbox8_view' AND `gperm_itemid`=$columnID;";
                        $GLOBALS['xoopsDB']->query($sql);
                    }
                    //admin
                    $gperm = $gpermHandler->create();
                    $gperm->setVar('gperm_groupid', XOOPS_GROUP_ADMIN);
                    $gperm->setVar('gperm_name', 'soapbox8_view');
                    $gperm->setVar('gperm_modid', $mid);
                    $gperm->setVar('gperm_itemid', $columnID);
                    $gpermHandler->insert($gperm);
                    unset($gperm);
                    if (is_array($arr_soapbox8_view)) {
                        foreach ($arr_soapbox8_view as $key => $cat_groupperm) {
                            $gperm = $gpermHandler->create();
                            $gperm->setVar('gperm_groupid', $cat_groupperm);
                            $gperm->setVar('gperm_name', 'soapbox8_view');
                            $gperm->setVar('gperm_modid', $mid);
                            $gperm->setVar('gperm_itemid', $columnID);
                            $gpermHandler->insert($gperm);
                            unset($gperm);
                        }
                    } else {
                        $gperm = $gpermHandler->create();
                        $gperm->setVar('gperm_groupid', $arr_soapbox8_view);
                        $gperm->setVar('gperm_name', 'soapbox8_view');
                        $gperm->setVar('gperm_modid', $mid);
                        $gperm->setVar('gperm_itemid', $columnID);
                        $gpermHandler->insert($gperm);
                        unset($gperm);
                    }
        */

        //===============================================================

        if ($sbcolumnsHandler->insert($sbcolumnsObject)) {
            redirect_header('sbcolumns.php?op=list', 2, _AM_SOAPBOX8_FORMOK);
        }

        echo $sbcolumnsObject->getHtmlErrors();
        $form = $sbcolumnsObject->getForm();
        $form->display();
        break;

    case 'edit':
        $adminObject->addItemButton(_AM_SOAPBOX8_ADD_SBCOLUMNS, 'sbcolumns.php?op=new', 'add');
        $adminObject->addItemButton(_AM_SOAPBOX8_SBCOLUMNS_LIST, 'sbcolumns.php', 'list');
        echo $adminObject->displayButton('left');
        $sbcolumnsObject = $sbcolumnsHandler->get(Request::getString('columnID', ''));
        $form            = $sbcolumnsObject->getForm();
        $form->display();
        break;

    case 'delete':
        $sbcolumnsObject = $sbcolumnsHandler->get(Request::getString('columnID', ''));
        if (1 == Request::getInt('ok', 0)) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                redirect_header('sbcolumns.php', 3, implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($sbcolumnsHandler->delete($sbcolumnsObject)) {
                redirect_header('sbcolumns.php', 3, _AM_SOAPBOX8_FORMDELOK);
            } else {
                echo $sbcolumnsObject->getHtmlErrors();
            }
        } else {
            xoops_confirm(array('ok' => 1, 'columnID' => Request::getString('columnID', ''), 'op' => 'delete'), Request::getCmd('REQUEST_URI', '', 'SERVER'), sprintf(_AM_SOAPBOX8_FORMSUREDEL, $sbcolumnsObject->getVar('name')));
        }
        break;

    case 'clone':

        $id_field = Request::getString('columnID', '');

        if (Soapbox8Utility::cloneRecord('soapbox8_sbcolumns', 'columnID', $id_field)) {
            redirect_header('sbcolumns.php', 3, _AM_SOAPBOX8_CLONED_OK);
        } else {
            redirect_header('sbcolumns.php', 3, _AM_SOAPBOX8_CLONED_FAILED);
        }

        break;
}
require_once __DIR__ . '/admin_footer.php';
