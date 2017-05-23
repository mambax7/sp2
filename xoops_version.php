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
$moduleDirName = basename(__DIR__);

$modversion = array(
    'version'             => 1.0,
    'module_status'       => 'Beta 1',
    'release_date'        => '2017/05/23',
    'name'                => _MI_SOAPBOX8_NAME,
    'description'         => _MI_SOAPBOX8_DESC,
    'release'             => '2016-12-05',
    'author'              => 'XOOPS Development Team',
    'author_mail'         => 'name@site.com',
    'author_website_url'  => 'http://xoops.org',
    'author_website_name' => 'XOOPS Project',
    'credits'             => 'XOOPS Development Team',
    //    'license' => 'GPL 2.0 or later',
    'help'                => 'page=help',
    'license'             => 'GPL 2.0 or later',
    'license_url'         => 'www.gnu.org/licenses/gpl-2.0.html',

    'release_info' => 'release_info',
    'release_file' => XOOPS_URL . "/modules/{$moduleDirName}/docs/release_info file",

    'manual'              => 'Installation.txt',
    'manual_file'         => XOOPS_URL . "/modules/{$moduleDirName}/docs/link to manual file",
    'min_php'             => '5.5',
    'min_xoops'           => '2.5.8',
    'min_admin'           => '1.2',
    'min_db'              => array('mysql' => '5.1', 'mysqli' => '5.1'),
    'image'               => 'assets/images/soapbox8_logo.png',
    'dirname'             => $moduleDirName,
    'modicons16'          => 'assets/images/icons/16',
    'modicons32'          => 'assets/images/icons/32',
    //About
    'demo_site_url'       => 'http://www.xoops.org',
    'demo_site_name'      => 'XOOPS Demo Site',
    'support_url'         => 'http://xoops.org/modules/newbb',
    'support_name'        => 'Support Forum',
    'module_website_url'  => 'www.xoops.org',
    'module_website_name' => 'XOOPS Project',
    // Admin system menu
    'system_menu'         => 1,
    // Admin things
    'hasAdmin'            => 1,
    'adminindex'          => 'admin/index.php',
    'adminmenu'           => 'admin/menu.php',
    // Menu
    'hasMain'             => 1,
    // Scripts to run upon installation or update
    'onInstall'           => 'include/oninstall.php',
    'onUpdate'            => 'include/onupdate.php',
    'onUninstall'         => 'include/onuninstall.php',
    // ------------------- Mysql -----------------------------
    'sqlfile'             => array('mysql' => 'sql/mysql.sql'),
    // ------------------- Tables ----------------------------
    'tables'              => array(
        $moduleDirName . '_' . 'sbcolumns',
        $moduleDirName . '_' . 'sbarticles',
        $moduleDirName . '_' . 'sbvotedata',
        $moduleDirName . '_' . 'test',
    ),
);
// ------------------- Search -----------------------------//
$modversion['hasSearch']      = 1;
$modversion['search']['file'] = 'include/search.inc.php';
$modversion['search']['func'] = 'soapbox8_search';
//  ------------------- Comments -----------------------------//
$modversion['hasComments']          = 1;
$modversion['comments']['itemName'] = 'com_id';
$modversion['comments']['pageName'] = 'comments.php';
// Comment callback functions
$modversion['comments']['callbackFile']        = 'include/comment_functions.php';
$modversion['comments']['callback']['approve'] = 'soapbox8_com_approve';
$modversion['comments']['callback']['update']  = 'soapbox8_com_update';
//  ------------------- Templates -----------------------------//
$modversion['templates'][] = array('file' => 'soapbox8_header.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'soapbox8_index.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'soapbox8_sbcolumns.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'soapbox8_sbarticles.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'soapbox8_sbvotedata.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'soapbox8_test.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'soapbox8_footer.tpl', 'description' => '');

$modversion['templates'][] = array('file' => 'admin/soapbox8_admin_about.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'admin/soapbox8_admin_help.tpl', 'description' => '');
$modversion['templates'][] = array('file' => 'admin/soapbox8_admin_test.tpl', 'description' => '');

// ------------------- Help files ------------------- //
$modversion['helpsection'] = array(
    array('name' => _MI_SOAPBOX8_OVERVIEW, 'link' => 'page=help'),
    array('name' => _MI_SOAPBOX8_DISCLAIMER, 'link' => 'page=disclaimer'),
    array('name' => _MI_SOAPBOX8_LICENSE, 'link' => 'page=license'),
    array('name' => _MI_SOAPBOX8_SUPPORT, 'link' => 'page=support'),

    //    array('name' => _MI_SOAPBOX8_HELP1, 'link' => 'page=help1'),
    //    array('name' => _MI_SOAPBOX8_HELP2, 'link' => 'page=help2'),
    //    array('name' => _MI_SOAPBOX8_HELP3, 'link' => 'page=help3'),
    //    array('name' => _MI_SOAPBOX8_HELP4, 'link' => 'page=help4'),
    //    array('name' => _MI_SOAPBOX8_HOWTO, 'link' => 'page=__howto'),
    //    array('name' => _MI_SOAPBOX8_REQUIREMENTS, 'link' => 'page=__requirements'),
    //    array('name' => _MI_SOAPBOX8_CREDITS, 'link' => 'page=__credits'),

);

// ------------------- Blocks -----------------------------//
$modversion['blocks'][] = array(
    'file'        => 'sbcolumns.php',
    'name'        => _MI_SOAPBOX8_SBCOLUMNS_BLOCK,
    'description' => '',
    'show_func'   => 'showSoapbox8Sbcolumns',
    'edit_func'   => 'editSoapbox8Sbcolumns',
    'options'     => '|5|25|0',
    'template'    => 'soapbox8_sbcolumns_block.tpl'
);

$modversion['blocks'][] = array(
    'file'        => 'sbarticles.php',
    'name'        => _MI_SOAPBOX8_SBARTICLES_BLOCK,
    'description' => '',
    'show_func'   => 'showSoapbox8Sbarticles',
    'edit_func'   => 'editSoapbox8Sbarticles',
    'options'     => '|5|25|0',
    'template'    => 'soapbox8_sbarticles_block.tpl'
);

$modversion['blocks'][] = array(
    'file'        => 'sbvotedata.php',
    'name'        => _MI_SOAPBOX8_SBVOTEDATA_BLOCK,
    'description' => '',
    'show_func'   => 'showSoapbox8Sbvotedata',
    'edit_func'   => 'editSoapbox8Sbvotedata',
    'options'     => '|5|25|0',
    'template'    => 'soapbox8_sbvotedata_block.tpl'
);

$modversion['blocks'][] = array(
    'file'        => 'test.php',
    'name'        => _MI_SOAPBOX8_TEST_BLOCK,
    'description' => '',
    'show_func'   => 'showSoapbox8Test',
    'edit_func'   => 'editSoapbox8Test',
    'options'     => '|5|25|0',
    'template'    => 'soapbox8_test_block.tpl'
);

// ------------------- Config Options -----------------------------//
xoops_load('xoopseditorhandler');
$editorHandler          = XoopsEditorHandler::getInstance();
$modversion['config'][] = array(
    'name'        => 'soapbox8EditorAdmin',
    'title'       => '_MI_SOAPBOX8_EDITOR_ADMIN',
    'description' => '_MI_SOAPBOX8_EDITOR_DESC_ADMIN',
    'formtype'    => 'select',
    'valuetype'   => 'text',
    'options'     => array_flip($editorHandler->getList()),
    'default'     => 'tinymce'
);

$modversion['config'][] = array(
    'name'        => 'soapbox8EditorUser',
    'title'       => '_MI_SOAPBOX8_EDITOR_USER',
    'description' => '_MI_SOAPBOX8_EDITOR_DESC_USER',
    'formtype'    => 'select',
    'valuetype'   => 'text',
    'options'     => array_flip($editorHandler->getList()),
    'default'     => 'dhtmltextarea'
);

// -------------- Get groups --------------
/** @var XoopsMemberHandler $memberHandler */
$memberHandler = xoops_getHandler('member');
$xoopsGroups   = $memberHandler->getGroupList();
foreach ($xoopsGroups as $key => $group) {
    $groups[$group] = $key;
}
$modversion['config'][] = array(
    'name'        => 'groups',
    'title'       => '_MI_SOAPBOX8_GROUPS',
    'description' => '_MI_SOAPBOX8_GROUPS_DESC',
    'formtype'    => 'select_multi',
    'valuetype'   => 'array',
    'options'     => $groups,
    'default'     => $groups
);

// -------------- Get Admin groups --------------
$criteria = new CriteriaCompo ();
$criteria->add(new Criteria ('group_type', 'Admin'));
/** @var XoopsMemberHandler $memberHandler */
$memberHandler    = xoops_getHandler('member');
$adminXoopsGroups = $memberHandler->getGroupList($criteria);
foreach ($adminXoopsGroups as $key => $adminGroup) {
    $admin_groups[$adminGroup] = $key;
}
$modversion['config'][] = array(
    'name'        => 'admin_groups',
    'title'       => '_MI_SOAPBOX8_ADMINGROUPS',
    'description' => '_MI_SOAPBOX8_ADMINGROUPS_DESC',
    'formtype'    => 'select_multi',
    'valuetype'   => 'array',
    'options'     => $admin_groups,
    'default'     => $admin_groups
);

$modversion['config'][] = array(
    'name'        => 'keywords',
    'title'       => '_MI_SOAPBOX8_KEYWORDS',
    'description' => '_MI_SOAPBOX8_KEYWORDS_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'text',
    'default'     => 'soapbox8,sbcolumns, sbarticles, sbvotedata, test'
);

// --------------Uploads : maxsize of image --------------
$modversion['config'][] = array(
    'name'        => 'maxsize',
    'title'       => '_MI_SOAPBOX8_MAXSIZE',
    'description' => '_MI_SOAPBOX8_MAXSIZE_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 5000000
);

// --------------Uploads : mimetypes of image --------------
$modversion['config'][] = array(
    'name'        => 'mimetypes',
    'title'       => '_MI_SOAPBOX8_MIMETYPES',
    'description' => '_MI_SOAPBOX8_MIMETYPES_DESC',
    'formtype'    => 'select_multi',
    'valuetype'   => 'array',
    'default'     => array('image/gif', 'image/jpeg', 'image/png'),
    'options'     => array(
        'bmp'   => 'image/bmp',
        'gif'   => 'image/gif',
        'pjpeg' => 'image/pjpeg',
        'jpeg'  => 'image/jpeg',
        'jpg'   => 'image/jpg',
        'jpe'   => 'image/jpe',
        'png'   => 'image/png'
    )
);

$modversion['config'][] = array(
    'name'        => 'adminpager',
    'title'       => '_MI_SOAPBOX8_ADMINPAGER',
    'description' => '_MI_SOAPBOX8_ADMINPAGER_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 10
);

$modversion['config'][] = array(
    'name'        => 'userpager',
    'title'       => '_MI_SOAPBOX8_USERPAGER',
    'description' => '_MI_SOAPBOX8_USERPAGER_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 10
);

$modversion['config'][] = array(
    'name'        => 'advertise',
    'title'       => '_MI_SOAPBOX8_ADVERTISE',
    'description' => '_MI_SOAPBOX8_ADVERTISE_DESC',
    'formtype'    => 'textarea',
    'valuetype'   => 'text',
    'default'     => ''
);

$modversion['config'][] = array(
    'name'        => 'bookmarks',
    'title'       => '_MI_SOAPBOX8_BOOKMARKS',
    'description' => '_MI_SOAPBOX8_BOOKMARKS_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0
);

$modversion['config'][] = array(
    'name'        => 'fbcomments',
    'title'       => '_MI_SOAPBOX8_FBCOMMENTS',
    'description' => '_MI_SOAPBOX8_FBCOMMENTS_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0
);

// -------------- Notifications soapbox8 --------------
$modversion['hasNotification']             = 1;
$modversion['notification']['lookup_file'] = 'include/notification.inc.php';
$modversion['notification']['lookup_func'] = 'soapbox8_notify_iteminfo';

$modversion['notification']['category'][] = array(
    'name'           => 'global',
    'title'          => _MI_SOAPBOX8_GLOBAL_NOTIFY,
    'description'    => _MI_SOAPBOX8_GLOBAL_NOTIFY_DESC,
    'subscribe_from' => array('index.php', 'viewcat.php', 'singlefile.php')
);

$modversion['notification']['category'][] = array(
    'name'           => 'category',
    'title'          => _MI_SOAPBOX8_CATEGORY_NOTIFY,
    'description'    => _MI_SOAPBOX8_CATEGORY_NOTIFY_DESC,
    'subscribe_from' => array('viewcat.php', 'singlefile.php'),
    'item_name'      => 'cid',
    'allow_bookmark' => 1
);

$modversion['notification']['category'][] = array(
    'name'           => 'file',
    'title'          => _MI_SOAPBOX8_FILE_NOTIFY,
    'description'    => _MI_SOAPBOX8_FILE_NOTIFY_DESC,
    'subscribe_from' => 'singlefile.php',
    'item_name'      => 'lid',
    'allow_bookmark' => 1
);

$modversion['notification']['event'][] = array(
    'name'          => 'new_category',
    'category'      => 'global',
    'title'         => _MI_SOAPBOX8_GLOBAL_NEWCATEGORY_NOTIFY,
    'caption'       => _MI_SOAPBOX8_GLOBAL_NEWCATEGORY_NOTIFY_CAPTION,
    'description'   => _MI_SOAPBOX8_GLOBAL_NEWCATEGORY_NOTIFY_DESC,
    'mail_template' => 'global_newcategory_notify',
    'mail_subject'  => _MI_SOAPBOX8_GLOBAL_NEWCATEGORY_NOTIFY_SUBJECT
);

$modversion['notification']['event'][] = array(
    'name'          => 'file_modify',
    'category'      => 'global',
    'admin_only'    => 1,
    'title'         => _MI_SOAPBOX8_GLOBAL_FILEMODIFY_NOTIFY,
    'caption'       => _MI_SOAPBOX8_GLOBAL_FILEMODIFY_NOTIFY_CAPTION,
    'description'   => _MI_SOAPBOX8_GLOBAL_FILEMODIFY_NOTIFY_DESC,
    'mail_template' => 'global_filemodify_notify',
    'mail_subject'  => _MI_SOAPBOX8_GLOBAL_FILEMODIFY_NOTIFY_SUBJECT
);

$modversion['notification']['event'][] = array(
    'name'          => 'file_broken',
    'category'      => 'global',
    'admin_only'    => 1,
    'title'         => _MI_SOAPBOX8_GLOBAL_FILEBROKEN_NOTIFY,
    'caption'       => _MI_SOAPBOX8_GLOBAL_FILEBROKEN_NOTIFY_CAPTION,
    'description'   => _MI_SOAPBOX8_GLOBAL_FILEBROKEN_NOTIFY_DESC,
    'mail_template' => 'global_filebroken_notify',
    'mail_subject'  => _MI_SOAPBOX8_GLOBAL_FILEBROKEN_NOTIFY_SUBJECT
);

$modversion['notification']['event'][] = array(
    'name'          => 'file_submit',
    'category'      => 'global',
    'admin_only'    => 1,
    'title'         => _MI_SOAPBOX8_GLOBAL_FILESUBMIT_NOTIFY,
    'caption'       => _MI_SOAPBOX8_GLOBAL_FILESUBMIT_NOTIFY_CAPTION,
    'description'   => _MI_SOAPBOX8_GLOBAL_FILESUBMIT_NOTIFY_DESC,
    'mail_template' => 'global_filesubmit_notify',
    'mail_subject'  => _MI_SOAPBOX8_GLOBAL_FILESUBMIT_NOTIFY_SUBJECT
);

$modversion['notification']['event'][] = array(
    'name'          => 'new_file',
    'category'      => 'global',
    'title'         => _MI_SOAPBOX8_GLOBAL_NEWFILE_NOTIFY,
    'caption'       => _MI_SOAPBOX8_GLOBAL_NEWFILE_NOTIFY_CAPTION,
    'description'   => _MI_SOAPBOX8_GLOBAL_NEWFILE_NOTIFY_DESC,
    'mail_template' => 'global_newfile_notify',
    'mail_subject'  => _MI_SOAPBOX8_GLOBAL_NEWFILE_NOTIFY_SUBJECT
);

$modversion['notification']['event'][] = array(
    'name'          => 'file_submit',
    'category'      => 'category',
    'admin_only'    => 1,
    'title'         => _MI_SOAPBOX8_CATEGORY_FILESUBMIT_NOTIFY,
    'caption'       => _MI_SOAPBOX8_CATEGORY_FILESUBMIT_NOTIFY_CAPTION,
    'description'   => _MI_SOAPBOX8_CATEGORY_FILESUBMIT_NOTIFY_DESC,
    'mail_template' => 'category_filesubmit_notify',
    'mail_subject'  => _MI_SOAPBOX8_CATEGORY_FILESUBMIT_NOTIFY_SUBJECT
);

$modversion['notification']['event'][] = array(
    'name'          => 'new_file',
    'category'      => 'category',
    'title'         => _MI_SOAPBOX8_CATEGORY_NEWFILE_NOTIFY,
    'caption'       => _MI_SOAPBOX8_CATEGORY_NEWFILE_NOTIFY_CAPTION,
    'description'   => _MI_SOAPBOX8_CATEGORY_NEWFILE_NOTIFY_DESC,
    'mail_template' => 'category_newfile_notify',
    'mail_subject'  => _MI_SOAPBOX8_CATEGORY_NEWFILE_NOTIFY_SUBJECT
);

$modversion['notification']['event'][] = array(
    'name'          => 'approve',
    'category'      => 'file',
    'admin_only'    => 1,
    'title'         => _MI_SOAPBOX8_FILE_APPROVE_NOTIFY,
    'caption'       => _MI_SOAPBOX8_FILE_APPROVE_NOTIFY_CAPTION,
    'description'   => _MI_SOAPBOX8_FILE_APPROVE_NOTIFY_DESC,
    'mail_template' => 'file_approve_notify',
    'mail_subject'  => _MI_SOAPBOX8_FILE_APPROVE_NOTIFY_SUBJECT
);
