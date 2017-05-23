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
        $adminObject->addItemButton(_AM_SOAPBOX8_ADD_SBARTICLES, 'sbarticles.php?op=new', 'add');
        echo $adminObject->displayButton('left');
        $start                     = Request::getInt('start', 0);
        $sbarticlesPaginationLimit = $GLOBALS['xoopsModuleConfig']['userpager'];

        $criteria = new CriteriaCompo();
        $criteria->setSort('articleID ASC, headline');
        $criteria->setOrder('ASC');
        $criteria->setLimit($sbarticlesPaginationLimit);
        $criteria->setStart($start);
        $sbarticlesTempRows  = $sbarticlesHandler->getCount();
        $sbarticlesTempArray = $sbarticlesHandler->getAll($criteria);/*
//
// 
                    <th class='center width5'>"._AM_SOAPBOX8_FORM_ACTION."</th>
//                    </tr>";
//            $class = "odd";
*/

        // Display Page Navigation
        if ($sbarticlesTempRows > $sbarticlesPaginationLimit) {
            require_once XOOPS_ROOT_PATH . '/class/pagenav.php';

            $pagenav = new XoopsPageNav($sbarticlesTempRows, $sbarticlesPaginationLimit, $start, 'start', 'op=list' . '&sort=' . $sort . '&order=' . $order . '');
            $GLOBALS['xoopsTpl']->assign('pagenav', null === $pagenav ? $pagenav->renderNav() : '');
        }

        $GLOBALS['xoopsTpl']->assign('sbarticlesRows', $sbarticlesTempRows);
        $sbarticlesArray = array();

        //    $fields = explode('|', articleID:int:8::NOT NULL::primary:articleID|columnID:tinyint:4::NOT NULL:0::columnID|headline:varchar:255::NOT NULL:0::headline|lead:text:0::NOT NULL:::lead|bodytext:text:0::NOT NULL:::bodytext|teaser:text:0::NOT NULL:::teaser|uid:int:6::NULL:1::uid|submit:int:1::NOT NULL:0::submit|datesub:int:11::NOT NULL:1033141070::datesub|counter:int:8:unsigned:NOT NULL:0::counter|weight:int:11::NOT NULL:1::weight|html:tinyint:1::NOT NULL:0::html|smiley:tinyint:1::NOT NULL:0::smiley|xcodes:tinyint:1::NOT NULL:0::xcodes|breaks:tinyint:1::NOT NULL:1::breaks|block:int:11::NOT NULL:0::block|artimage:varchar:255::NOT NULL:::artimage|votes:int:11::NOT NULL:0::votes|rating:double:6,4::NOT NULL:0.0000::rating|commentable:int:11::NOT NULL:0::commentable|offline:int:11::NOT NULL:0::offline|notifypub:int:11::NOT NULL:0::notifypub);
        //    $fieldsCount    = count($fields);

        $criteria = new CriteriaCompo();

        //$criteria->setOrder('DESC');
        $criteria->setSort($sort);
        $criteria->setOrder($order);
        $criteria->setLimit($sbarticlesPaginationLimit);
        $criteria->setStart($start);

        $sbarticlesCount     = $sbarticlesHandler->getCount($criteria);
        $sbarticlesTempArray = $sbarticlesHandler->getAll($criteria);

        //    for ($i = 0; $i < $fieldsCount; ++$i) {
        if ($sbarticlesCount > 0) {
            foreach (array_keys($sbarticlesTempArray) as $i) {

                //        $field = explode(':', $fields[$i]);

                $selectorarticleID = Soapbox8Utility::selectSorting(_AM_SOAPBOX8_SBARTICLES_ARTICLEID, 'articleID');
                $GLOBALS['xoopsTpl']->assign('selectorarticleID', $selectorarticleID);
                $sbarticlesArray['articleID'] = $sbarticlesTempArray[$i]->getVar('articleID');

                $selectorcolumnID = Soapbox8Utility::selectSorting(_AM_SOAPBOX8_SBARTICLES_COLUMNID, 'columnID');
                $GLOBALS['xoopsTpl']->assign('selectorcolumnID', $selectorcolumnID);
                $sbarticlesArray['columnID'] = $sbcolumnsHandler->get($sbarticlesTempArray[$i]->getVar('columnID'))->getVar('name');

                $selectorheadline = Soapbox8Utility::selectSorting(_AM_SOAPBOX8_SBARTICLES_HEADLINE, 'headline');
                $GLOBALS['xoopsTpl']->assign('selectorheadline', $selectorheadline);
                $sbarticlesArray['headline'] = $sbarticlesTempArray[$i]->getVar('headline');

                $selectorlead = Soapbox8Utility::selectSorting(_AM_SOAPBOX8_SBARTICLES_LEAD, 'lead');
                $GLOBALS['xoopsTpl']->assign('selectorlead', $selectorlead);
                $sbarticlesArray['lead'] = strip_tags($sbarticlesTempArray[$i]->getVar('lead'));

                $selectorbodytext = Soapbox8Utility::selectSorting(_AM_SOAPBOX8_SBARTICLES_BODYTEXT, 'bodytext');
                $GLOBALS['xoopsTpl']->assign('selectorbodytext', $selectorbodytext);
                $sbarticlesArray['bodytext'] = strip_tags($sbarticlesTempArray[$i]->getVar('bodytext'));

                $selectorteaser = Soapbox8Utility::selectSorting(_AM_SOAPBOX8_SBARTICLES_TEASER, 'teaser');
                $GLOBALS['xoopsTpl']->assign('selectorteaser', $selectorteaser);
                $sbarticlesArray['teaser'] = strip_tags($sbarticlesTempArray[$i]->getVar('teaser'));

                $selectoruid = Soapbox8Utility::selectSorting(_AM_SOAPBOX8_SBARTICLES_UID, 'uid');
                $GLOBALS['xoopsTpl']->assign('selectoruid', $selectoruid);
                $sbarticlesArray['uid'] = $sbarticlesTempArray[$i]->getVar('uid');

                $selectorsubmit = Soapbox8Utility::selectSorting(_AM_SOAPBOX8_SBARTICLES_SUBMIT, 'submit');
                $GLOBALS['xoopsTpl']->assign('selectorsubmit', $selectorsubmit);
                $sbarticlesArray['submit'] = $sbarticlesTempArray[$i]->getVar('submit');

                $selectordatesub = Soapbox8Utility::selectSorting(_AM_SOAPBOX8_SBARTICLES_DATESUB, 'datesub');
                $GLOBALS['xoopsTpl']->assign('selectordatesub', $selectordatesub);
                $sbarticlesArray['datesub'] = $sbarticlesTempArray[$i]->getVar('datesub');

                $selectorcounter = Soapbox8Utility::selectSorting(_AM_SOAPBOX8_SBARTICLES_COUNTER, 'counter');
                $GLOBALS['xoopsTpl']->assign('selectorcounter', $selectorcounter);
                $sbarticlesArray['counter'] = $sbarticlesTempArray[$i]->getVar('counter');

                $selectorweight = Soapbox8Utility::selectSorting(_AM_SOAPBOX8_SBARTICLES_WEIGHT, 'weight');
                $GLOBALS['xoopsTpl']->assign('selectorweight', $selectorweight);
                $sbarticlesArray['weight'] = $sbarticlesTempArray[$i]->getVar('weight');

                $selectorhtml = Soapbox8Utility::selectSorting(_AM_SOAPBOX8_SBARTICLES_HTML, 'html');
                $GLOBALS['xoopsTpl']->assign('selectorhtml', $selectorhtml);
                $sbarticlesArray['html'] = $sbarticlesTempArray[$i]->getVar('html');

                $selectorsmiley = Soapbox8Utility::selectSorting(_AM_SOAPBOX8_SBARTICLES_SMILEY, 'smiley');
                $GLOBALS['xoopsTpl']->assign('selectorsmiley', $selectorsmiley);
                $sbarticlesArray['smiley'] = $sbarticlesTempArray[$i]->getVar('smiley');

                $selectorxcodes = Soapbox8Utility::selectSorting(_AM_SOAPBOX8_SBARTICLES_XCODES, 'xcodes');
                $GLOBALS['xoopsTpl']->assign('selectorxcodes', $selectorxcodes);
                $sbarticlesArray['xcodes'] = $sbarticlesTempArray[$i]->getVar('xcodes');

                $selectorbreaks = Soapbox8Utility::selectSorting(_AM_SOAPBOX8_SBARTICLES_BREAKS, 'breaks');
                $GLOBALS['xoopsTpl']->assign('selectorbreaks', $selectorbreaks);
                $sbarticlesArray['breaks'] = $sbarticlesTempArray[$i]->getVar('breaks');

                $selectorblock = Soapbox8Utility::selectSorting(_AM_SOAPBOX8_SBARTICLES_BLOCK, 'block');
                $GLOBALS['xoopsTpl']->assign('selectorblock', $selectorblock);
                $sbarticlesArray['block'] = $sbarticlesTempArray[$i]->getVar('block');

                $selectorartimage = Soapbox8Utility::selectSorting(_AM_SOAPBOX8_SBARTICLES_ARTIMAGE, 'artimage');
                $GLOBALS['xoopsTpl']->assign('selectorartimage', $selectorartimage);
                $sbarticlesArray['artimage'] = $sbarticlesTempArray[$i]->getVar('artimage');

                $selectorvotes = Soapbox8Utility::selectSorting(_AM_SOAPBOX8_SBARTICLES_VOTES, 'votes');
                $GLOBALS['xoopsTpl']->assign('selectorvotes', $selectorvotes);
                $sbarticlesArray['votes'] = $sbarticlesTempArray[$i]->getVar('votes');

                $selectorrating = Soapbox8Utility::selectSorting(_AM_SOAPBOX8_SBARTICLES_RATING, 'rating');
                $GLOBALS['xoopsTpl']->assign('selectorrating', $selectorrating);
                $sbarticlesArray['rating'] = $sbarticlesTempArray[$i]->getVar('rating');

                $selectorcommentable = Soapbox8Utility::selectSorting(_AM_SOAPBOX8_SBARTICLES_COMMENTABLE, 'commentable');
                $GLOBALS['xoopsTpl']->assign('selectorcommentable', $selectorcommentable);
                $sbarticlesArray['commentable'] = $sbarticlesTempArray[$i]->getVar('commentable');

                $selectoroffline = Soapbox8Utility::selectSorting(_AM_SOAPBOX8_SBARTICLES_OFFLINE, 'offline');
                $GLOBALS['xoopsTpl']->assign('selectoroffline', $selectoroffline);
                $sbarticlesArray['offline'] = $sbarticlesTempArray[$i]->getVar('offline');

                $selectornotifypub = Soapbox8Utility::selectSorting(_AM_SOAPBOX8_SBARTICLES_NOTIFYPUB, 'notifypub');
                $GLOBALS['xoopsTpl']->assign('selectornotifypub', $selectornotifypub);
                $sbarticlesArray['notifypub']   = $sbarticlesTempArray[$i]->getVar('notifypub');
                $sbarticlesArray['edit_delete'] = "<a href='sbarticles.php?op=edit&articleID=" . $i . "'><img src=" . $pathIcon16 . "/edit.png alt='" . _EDIT . "' title='" . _EDIT . "'></a>
               <a href='sbarticles.php?op=delete&articleID=" . $i . "'><img src=" . $pathIcon16 . "/delete.png alt='" . _DELETE . "' title='" . _DELETE . "'></a>
               <a href='sbarticles.php?op=clone&articleID=" . $i . "'><img src=" . $pathIcon16 . "/editcopy.png alt='" . _CLONE . "' title='" . _CLONE . "'></a>";

                $GLOBALS['xoopsTpl']->append_by_ref('sbarticlesArrays', $sbarticlesArray);
                unset($sbarticlesArray);
            }
            unset($sbarticlesTempArray);
            // Display Navigation
            if ($sbarticlesCount > $sbarticlesPaginationLimit) {
                require_once XOOPS_ROOT_PATH . '/class/pagenav.php';
                $pagenav = new XoopsPageNav($sbarticlesCount, $sbarticlesPaginationLimit, $start, 'start', 'op=list' . '&sort=' . $sort . '&order=' . $order . '');
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
            }

            //                     echo "<td class='center width5'>

            //                    <a href='sbarticles.php?op=edit&articleID=".$i."'><img src=".$pathIcon16."/edit.png alt='"._EDIT."' title='"._EDIT."'></a>
            //                    <a href='sbarticles.php?op=delete&articleID=".$i."'><img src=".$pathIcon16."/delete.png alt='"._DELETE."' title='"._DELETE."'></a>
            //                    </td>";

            //                echo "</tr>";

            //            }

            //            echo "</table><br><br>";

            //        } else {

            //            echo "<table width='100%' cellspacing='1' class='outer'>

            //                    <tr>

            //                     <th class='center width5'>"._AM_SOAPBOX8_FORM_ACTION."XXX</th>
            //                    </tr><tr><td class='errorMsg' colspan='23'>There are noXXX sbarticles</td></tr>";
            //            echo "</table><br><br>";

            //-------------------------------------------

            echo $GLOBALS['xoopsTpl']->fetch(XOOPS_ROOT_PATH . '/modules/' . $GLOBALS['xoopsModule']->getVar('dirname') . '/templates/admin/soapbox8_admin_sbarticles.tpl');
        }

        break;

    case 'new':
        $adminObject->addItemButton(_AM_SOAPBOX8_SBARTICLES_LIST, 'sbarticles.php', 'list');
        echo $adminObject->displayButton('left');

        $sbarticlesObject = $sbarticlesHandler->create();
        $form             = $sbarticlesObject->getForm();
        $form->display();
        break;

    case 'save':
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('sbarticles.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if (0 != Request::getInt('articleID', 0)) {
            $sbarticlesObject = $sbarticlesHandler->get(Request::getInt('articleID', 0));
        } else {
            $sbarticlesObject = $sbarticlesHandler->create();
        }
        // Form save fields
        $sbarticlesObject->setVar('columnID', Request::getVar('columnID', ''));
        $sbarticlesObject->setVar('headline', Request::getVar('headline', ''));
        $sbarticlesObject->setVar('lead', Request::getVar('lead', ''));
        $sbarticlesObject->setVar('bodytext', Request::getVar('bodytext', ''));
        $sbarticlesObject->setVar('teaser', Request::getVar('teaser', ''));
        $sbarticlesObject->setVar('uid', Request::getVar('uid', ''));
        $sbarticlesObject->setVar('submit', Request::getVar('submit', ''));
        $sbarticlesObject->setVar('datesub', Request::getVar('datesub', ''));
        $sbarticlesObject->setVar('counter', Request::getVar('counter', ''));
        $sbarticlesObject->setVar('weight', Request::getVar('weight', ''));
        $sbarticlesObject->setVar('html', ((1 == Request::getInt('html', 0)) ? '1' : '0'));
        $sbarticlesObject->setVar('smiley', ((1 == Request::getInt('smiley', 0)) ? '1' : '0'));
        $sbarticlesObject->setVar('xcodes', ((1 == Request::getInt('xcodes', 0)) ? '1' : '0'));
        $sbarticlesObject->setVar('breaks', ((1 == Request::getInt('breaks', 0)) ? '1' : '0'));
        $sbarticlesObject->setVar('block', Request::getVar('block', ''));
        $sbarticlesObject->setVar('artimage', Request::getVar('artimage', ''));
        $sbarticlesObject->setVar('votes', Request::getVar('votes', ''));
        $sbarticlesObject->setVar('rating', Request::getVar('rating', ''));
        $sbarticlesObject->setVar('commentable', ((1 == Request::getInt('commentable', 0)) ? '1' : '0'));
        $sbarticlesObject->setVar('offline', ((1 == Request::getInt('offline', 0)) ? '1' : '0'));
        $sbarticlesObject->setVar('notifypub', ((1 == Request::getInt('notifypub', 0)) ? '1' : '0'));
        if ($sbarticlesHandler->insert($sbarticlesObject)) {
            redirect_header('sbarticles.php?op=list', 2, _AM_SOAPBOX8_FORMOK);
        }

        echo $sbarticlesObject->getHtmlErrors();
        $form = $sbarticlesObject->getForm();
        $form->display();
        break;

    case 'edit':
        $adminObject->addItemButton(_AM_SOAPBOX8_ADD_SBARTICLES, 'sbarticles.php?op=new', 'add');
        $adminObject->addItemButton(_AM_SOAPBOX8_SBARTICLES_LIST, 'sbarticles.php', 'list');
        echo $adminObject->displayButton('left');
        $sbarticlesObject = $sbarticlesHandler->get(Request::getString('articleID', ''));
        $form             = $sbarticlesObject->getForm();
        $form->display();
        break;

    case 'delete':
        $sbarticlesObject = $sbarticlesHandler->get(Request::getString('articleID', ''));
        if (1 == Request::getInt('ok', 0)) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                redirect_header('sbarticles.php', 3, implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($sbarticlesHandler->delete($sbarticlesObject)) {
                redirect_header('sbarticles.php', 3, _AM_SOAPBOX8_FORMDELOK);
            } else {
                echo $sbarticlesObject->getHtmlErrors();
            }
        } else {
            xoops_confirm(array('ok' => 1, 'articleID' => Request::getString('articleID', ''), 'op' => 'delete'), Request::getCmd('REQUEST_URI', '', 'SERVER'), sprintf(_AM_SOAPBOX8_FORMSUREDEL, $sbarticlesObject->getVar('headline')));
        }
        break;

    case 'clone':

        $id_field = Request::getString('articleID', '');

        if (Soapbox8Utility::cloneRecord('soapbox8_sbarticles', 'articleID', $id_field)) {
            redirect_header('sbarticles.php', 3, _AM_SOAPBOX8_CLONED_OK);
        } else {
            redirect_header('sbarticles.php', 3, _AM_SOAPBOX8_CLONED_FAILED);
        }

        break;
}
require_once __DIR__ . '/admin_footer.php';
