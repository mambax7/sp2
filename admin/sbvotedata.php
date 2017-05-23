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
        $adminObject->addItemButton(_AM_SOAPBOX8_ADD_SBVOTEDATA, 'sbvotedata.php?op=new', 'add');
        echo $adminObject->displayButton('left');
        $start                     = Request::getInt('start', 0);
        $sbvotedataPaginationLimit = $GLOBALS['xoopsModuleConfig']['userpager'];

        $criteria = new CriteriaCompo();
        $criteria->setSort('ratingid ASC, ratingid');
        $criteria->setOrder('ASC');
        $criteria->setLimit($sbvotedataPaginationLimit);
        $criteria->setStart($start);
        $sbvotedataTempRows  = $sbvotedataHandler->getCount();
        $sbvotedataTempArray = $sbvotedataHandler->getAll($criteria);/*
//
// 
                    <th class='center width5'>"._AM_SOAPBOX8_FORM_ACTION."</th>
//                    </tr>";
//            $class = "odd";
*/

        // Display Page Navigation
        if ($sbvotedataTempRows > $sbvotedataPaginationLimit) {
            require_once XOOPS_ROOT_PATH . '/class/pagenav.php';

            $pagenav = new XoopsPageNav($sbvotedataTempRows, $sbvotedataPaginationLimit, $start, 'start', 'op=list' . '&sort=' . $sort . '&order=' . $order . '');
            $GLOBALS['xoopsTpl']->assign('pagenav', null === $pagenav ? $pagenav->renderNav() : '');
        }

        $GLOBALS['xoopsTpl']->assign('sbvotedataRows', $sbvotedataTempRows);
        $sbvotedataArray = array();

        //    $fields = explode('|', ratingid:int:11:unsigned:NOT NULL::primary:ratingid|lid:int:11:unsigned:NOT NULL:0::lid|ratinguser:int:11::NOT NULL:0::ratinguser|rating:tinyint:3:unsigned:NOT NULL:0::rating|ratinghostname:varchar:60::NOT NULL:::ratinghostname|ratingtimestamp:int:10::NOT NULL:0::ratingtimestamp);
        //    $fieldsCount    = count($fields);

        $criteria = new CriteriaCompo();

        //$criteria->setOrder('DESC');
        $criteria->setSort($sort);
        $criteria->setOrder($order);
        $criteria->setLimit($sbvotedataPaginationLimit);
        $criteria->setStart($start);

        $sbvotedataCount     = $sbvotedataHandler->getCount($criteria);
        $sbvotedataTempArray = $sbvotedataHandler->getAll($criteria);

        //    for ($i = 0; $i < $fieldsCount; ++$i) {
        if ($sbvotedataCount > 0) {
            foreach (array_keys($sbvotedataTempArray) as $i) {

                //        $field = explode(':', $fields[$i]);

                $selectorratingid = Soapbox8Utility::selectSorting(_AM_SOAPBOX8_SBVOTEDATA_RATINGID, 'ratingid');
                $GLOBALS['xoopsTpl']->assign('selectorratingid', $selectorratingid);
                $sbvotedataArray['ratingid'] = $sbvotedataTempArray[$i]->getVar('ratingid');

                $selectorlid = Soapbox8Utility::selectSorting(_AM_SOAPBOX8_SBVOTEDATA_LID, 'lid');
                $GLOBALS['xoopsTpl']->assign('selectorlid', $selectorlid);
                $sbvotedataArray['lid'] = $sbarticlesHandler->get($sbvotedataTempArray[$i]->getVar('lid'))->getVar('headline');

                $selectorratinguser = Soapbox8Utility::selectSorting(_AM_SOAPBOX8_SBVOTEDATA_RATINGUSER, 'ratinguser');
                $GLOBALS['xoopsTpl']->assign('selectorratinguser', $selectorratinguser);
                $sbvotedataArray['ratinguser'] = $sbvotedataTempArray[$i]->getVar('ratinguser');

                $selectorrating = Soapbox8Utility::selectSorting(_AM_SOAPBOX8_SBVOTEDATA_RATING, 'rating');
                $GLOBALS['xoopsTpl']->assign('selectorrating', $selectorrating);
                $sbvotedataArray['rating'] = $sbvotedataTempArray[$i]->getVar('rating');

                $selectorratinghostname = Soapbox8Utility::selectSorting(_AM_SOAPBOX8_SBVOTEDATA_RATINGHOSTNAME, 'ratinghostname');
                $GLOBALS['xoopsTpl']->assign('selectorratinghostname', $selectorratinghostname);
                $sbvotedataArray['ratinghostname'] = $sbvotedataTempArray[$i]->getVar('ratinghostname');

                $selectorratingtimestamp = Soapbox8Utility::selectSorting(_AM_SOAPBOX8_SBVOTEDATA_RATINGTIMESTAMP, 'ratingtimestamp');
                $GLOBALS['xoopsTpl']->assign('selectorratingtimestamp', $selectorratingtimestamp);
                $sbvotedataArray['ratingtimestamp'] = date(_DATESTRING, strtotime($sbvotedataTempArray[$i]->getVar('ratingtimestamp')));
                $sbvotedataArray['edit_delete']     = "<a href='sbvotedata.php?op=edit&ratingid=" . $i . "'><img src=" . $pathIcon16 . "/edit.png alt='" . _EDIT . "' title='" . _EDIT . "'></a>
               <a href='sbvotedata.php?op=delete&ratingid=" . $i . "'><img src=" . $pathIcon16 . "/delete.png alt='" . _DELETE . "' title='" . _DELETE . "'></a>
               <a href='sbvotedata.php?op=clone&ratingid=" . $i . "'><img src=" . $pathIcon16 . "/editcopy.png alt='" . _CLONE . "' title='" . _CLONE . "'></a>";

                $GLOBALS['xoopsTpl']->append_by_ref('sbvotedataArrays', $sbvotedataArray);
                unset($sbvotedataArray);
            }
            unset($sbvotedataTempArray);
            // Display Navigation
            if ($sbvotedataCount > $sbvotedataPaginationLimit) {
                require_once XOOPS_ROOT_PATH . '/class/pagenav.php';
                $pagenav = new XoopsPageNav($sbvotedataCount, $sbvotedataPaginationLimit, $start, 'start', 'op=list' . '&sort=' . $sort . '&order=' . $order . '');
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
            }

            //                     echo "<td class='center width5'>

            //                    <a href='sbvotedata.php?op=edit&ratingid=".$i."'><img src=".$pathIcon16."/edit.png alt='"._EDIT."' title='"._EDIT."'></a>
            //                    <a href='sbvotedata.php?op=delete&ratingid=".$i."'><img src=".$pathIcon16."/delete.png alt='"._DELETE."' title='"._DELETE."'></a>
            //                    </td>";

            //                echo "</tr>";

            //            }

            //            echo "</table><br><br>";

            //        } else {

            //            echo "<table width='100%' cellspacing='1' class='outer'>

            //                    <tr>

            //                     <th class='center width5'>"._AM_SOAPBOX8_FORM_ACTION."XXX</th>
            //                    </tr><tr><td class='errorMsg' colspan='7'>There are noXXX sbvotedata</td></tr>";
            //            echo "</table><br><br>";

            //-------------------------------------------

            echo $GLOBALS['xoopsTpl']->fetch(XOOPS_ROOT_PATH . '/modules/' . $GLOBALS['xoopsModule']->getVar('dirname') . '/templates/admin/soapbox8_admin_sbvotedata.tpl');
        }

        break;

    case 'new':
        $adminObject->addItemButton(_AM_SOAPBOX8_SBVOTEDATA_LIST, 'sbvotedata.php', 'list');
        echo $adminObject->displayButton('left');

        $sbvotedataObject = $sbvotedataHandler->create();
        $form             = $sbvotedataObject->getForm();
        $form->display();
        break;

    case 'save':
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('sbvotedata.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if (0 != Request::getInt('ratingid', 0)) {
            $sbvotedataObject = $sbvotedataHandler->get(Request::getInt('ratingid', 0));
        } else {
            $sbvotedataObject = $sbvotedataHandler->create();
        }
        // Form save fields
        $sbvotedataObject->setVar('lid', Request::getVar('lid', ''));
        $sbvotedataObject->setVar('ratinguser', Request::getVar('ratinguser', ''));
        $sbvotedataObject->setVar('rating', Request::getVar('rating', ''));
        $sbvotedataObject->setVar('ratinghostname', Request::getVar('ratinghostname', ''));
        $sbvotedataObject->setVar('ratingtimestamp', date('Y-m-d H:i:s', strtotime($_REQUEST['ratingtimestamp']['date']) + $_REQUEST['ratingtimestamp']['time']));
        if ($sbvotedataHandler->insert($sbvotedataObject)) {
            redirect_header('sbvotedata.php?op=list', 2, _AM_SOAPBOX8_FORMOK);
        }

        echo $sbvotedataObject->getHtmlErrors();
        $form = $sbvotedataObject->getForm();
        $form->display();
        break;

    case 'edit':
        $adminObject->addItemButton(_AM_SOAPBOX8_ADD_SBVOTEDATA, 'sbvotedata.php?op=new', 'add');
        $adminObject->addItemButton(_AM_SOAPBOX8_SBVOTEDATA_LIST, 'sbvotedata.php', 'list');
        echo $adminObject->displayButton('left');
        $sbvotedataObject = $sbvotedataHandler->get(Request::getString('ratingid', ''));
        $form             = $sbvotedataObject->getForm();
        $form->display();
        break;

    case 'delete':
        $sbvotedataObject = $sbvotedataHandler->get(Request::getString('ratingid', ''));
        if (1 == Request::getInt('ok', 0)) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                redirect_header('sbvotedata.php', 3, implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($sbvotedataHandler->delete($sbvotedataObject)) {
                redirect_header('sbvotedata.php', 3, _AM_SOAPBOX8_FORMDELOK);
            } else {
                echo $sbvotedataObject->getHtmlErrors();
            }
        } else {
            xoops_confirm(array('ok' => 1, 'ratingid' => Request::getString('ratingid', ''), 'op' => 'delete'), Request::getCmd('REQUEST_URI', '', 'SERVER'), sprintf(_AM_SOAPBOX8_FORMSUREDEL, $sbvotedataObject->getVar('ratingid')));
        }
        break;

    case 'clone':

        $id_field = Request::getString('ratingid', '');

        if (Soapbox8Utility::cloneRecord('soapbox8_sbvotedata', 'ratingid', $id_field)) {
            redirect_header('sbvotedata.php', 3, _AM_SOAPBOX8_CLONED_OK);
        } else {
            redirect_header('sbvotedata.php', 3, _AM_SOAPBOX8_CLONED_FAILED);
        }

        break;
}
require_once __DIR__ . '/admin_footer.php';
