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

//Index
define('_AM_SOAPBOX8_STATISTICS', 'Soapbox8 statistics');
define('_AM_SOAPBOX8_THEREARE_SBCOLUMNS', "There are <span class='bold'>%s</span> Sbcolumns in the database");
define('_AM_SOAPBOX8_THEREARE_SBARTICLES', "There are <span class='bold'>%s</span> Sbarticles in the database");
define('_AM_SOAPBOX8_THEREARE_SBVOTEDATA', "There are <span class='bold'>%s</span> Sbvotedata in the database");
define('_AM_SOAPBOX8_THEREARE_TEST', "There are <span class='bold'>%s</span> Test in the database");
//Buttons
define('_AM_SOAPBOX8_ADD_SBCOLUMNS', 'Add new sbcolumns');
define('_AM_SOAPBOX8_SBCOLUMNS_LIST', 'List of sbcolumns');
define('_AM_SOAPBOX8_ADD_SBARTICLES', 'Add new sbarticles');
define('_AM_SOAPBOX8_SBARTICLES_LIST', 'List of sbarticles');
define('_AM_SOAPBOX8_ADD_SBVOTEDATA', 'Add new sbvotedata');
define('_AM_SOAPBOX8_SBVOTEDATA_LIST', 'List of sbvotedata');
define('_AM_SOAPBOX8_ADD_TEST', 'Add new test');
define('_AM_SOAPBOX8_TEST_LIST', 'List of test');
//General
define('_AM_SOAPBOX8_FORMOK', 'Registered successfull');
define('_AM_SOAPBOX8_FORMDELOK', 'Deleted successfull');
define('_AM_SOAPBOX8_FORMSUREDEL', "Are you sure to Delete: <span class='bold red'>%s</span></b>");
define('_AM_SOAPBOX8_FORMSURERENEW', "Are you sure to Renew: <span class='bold red'>%s</span></b>");
define('_AM_SOAPBOX8_FORMUPLOAD', 'Upload');
define('_AM_SOAPBOX8_FORMIMAGE_PATH', 'File presents in %s');
define('_AM_SOAPBOX8_FORM_ACTION', 'Action');
define('_AM_SOAPBOX8_SELECT', 'Select action for selected item(s)');
define('_AM_SOAPBOX8_SELECTED_DELETE', 'Delete selected item(s)');
define('_AM_SOAPBOX8_SELECTED_ACTIVATE', 'Activate selected item(s)');
define('_AM_SOAPBOX8_SELECTED_DEACTIVATE', 'De-activate selected item(s)');
define('_AM_SOAPBOX8_SELECTED_ERROR', 'You selected nothing to delete');
define('_AM_SOAPBOX8_CLONED_OK', 'Record cloned successfully');
define('_AM_SOAPBOX8_CLONED_FAILED', 'Cloning of the record has failed');

// Sbcolumns
define('_AM_SOAPBOX8_SBCOLUMNS_ADD', 'Add a sbcolumns');
define('_AM_SOAPBOX8_SBCOLUMNS_EDIT', 'Edit sbcolumns');
define('_AM_SOAPBOX8_SBCOLUMNS_DELETE', 'Delete sbcolumns');
define('_AM_SOAPBOX8_SBCOLUMNS_COLUMNID', 'columnID');
define('_AM_SOAPBOX8_SBCOLUMNS_AUTHOR', 'author');
define('_AM_SOAPBOX8_SBCOLUMNS_NAME', 'name');
define('_AM_SOAPBOX8_SBCOLUMNS_DESCRIPTION', 'description');
define('_AM_SOAPBOX8_SBCOLUMNS_TOTAL', 'total');
define('_AM_SOAPBOX8_SBCOLUMNS_WEIGHT', 'weight');
define('_AM_SOAPBOX8_SBCOLUMNS_COLIMAGE', 'colimage');
define('_AM_SOAPBOX8_SBCOLUMNS_CREATED', 'created');
// Sbarticles
define('_AM_SOAPBOX8_SBARTICLES_ADD', 'Add a sbarticles');
define('_AM_SOAPBOX8_SBARTICLES_EDIT', 'Edit sbarticles');
define('_AM_SOAPBOX8_SBARTICLES_DELETE', 'Delete sbarticles');
define('_AM_SOAPBOX8_SBARTICLES_ARTICLEID', 'articleID');
define('_AM_SOAPBOX8_SBARTICLES_COLUMNID', 'columnID');
define('_AM_SOAPBOX8_SBARTICLES_HEADLINE', 'headline');
define('_AM_SOAPBOX8_SBARTICLES_LEAD', 'lead');
define('_AM_SOAPBOX8_SBARTICLES_BODYTEXT', 'bodytext');
define('_AM_SOAPBOX8_SBARTICLES_TEASER', 'teaser');
define('_AM_SOAPBOX8_SBARTICLES_UID', 'uid');
define('_AM_SOAPBOX8_SBARTICLES_SUBMIT', 'submit');
define('_AM_SOAPBOX8_SBARTICLES_DATESUB', 'datesub');
define('_AM_SOAPBOX8_SBARTICLES_COUNTER', 'counter');
define('_AM_SOAPBOX8_SBARTICLES_WEIGHT', 'weight');
define('_AM_SOAPBOX8_SBARTICLES_HTML', 'html');
define('_AM_SOAPBOX8_SBARTICLES_SMILEY', 'smiley');
define('_AM_SOAPBOX8_SBARTICLES_XCODES', 'xcodes');
define('_AM_SOAPBOX8_SBARTICLES_BREAKS', 'breaks');
define('_AM_SOAPBOX8_SBARTICLES_BLOCK', 'block');
define('_AM_SOAPBOX8_SBARTICLES_ARTIMAGE', 'artimage');
define('_AM_SOAPBOX8_SBARTICLES_VOTES', 'votes');
define('_AM_SOAPBOX8_SBARTICLES_RATING', 'rating');
define('_AM_SOAPBOX8_SBARTICLES_COMMENTABLE', 'commentable');
define('_AM_SOAPBOX8_SBARTICLES_OFFLINE', 'offline');
define('_AM_SOAPBOX8_SBARTICLES_NOTIFYPUB', 'notifypub');
// Sbvotedata
define('_AM_SOAPBOX8_SBVOTEDATA_ADD', 'Add a sbvotedata');
define('_AM_SOAPBOX8_SBVOTEDATA_EDIT', 'Edit sbvotedata');
define('_AM_SOAPBOX8_SBVOTEDATA_DELETE', 'Delete sbvotedata');
define('_AM_SOAPBOX8_SBVOTEDATA_RATINGID', 'ratingid');
define('_AM_SOAPBOX8_SBVOTEDATA_LID', 'lid');
define('_AM_SOAPBOX8_SBVOTEDATA_RATINGUSER', 'ratinguser');
define('_AM_SOAPBOX8_SBVOTEDATA_RATING', 'rating');
define('_AM_SOAPBOX8_SBVOTEDATA_RATINGHOSTNAME', 'ratinghostname');
define('_AM_SOAPBOX8_SBVOTEDATA_RATINGTIMESTAMP', 'ratingtimestamp');
// Test
define('_AM_SOAPBOX8_TEST_ADD', 'Add a test');
define('_AM_SOAPBOX8_TEST_EDIT', 'Edit test');
define('_AM_SOAPBOX8_TEST_DELETE', 'Delete test');
define('_AM_SOAPBOX8_TEST_ID', 'id');
define('_AM_SOAPBOX8_TEST_TEXT', 'text');
define('_AM_SOAPBOX8_TEST_TEXTAREA', 'textarea');
define('_AM_SOAPBOX8_TEST_DHTML', 'dhtml');
define('_AM_SOAPBOX8_TEST_CHECKBOX', 'checkbox');
define('_AM_SOAPBOX8_TEST_RADIOYN', 'radioyn');
define('_AM_SOAPBOX8_TEST_SELECTBOX', 'selectbox');
define('_AM_SOAPBOX8_TEST_SELECTUSER', 'selectuser');
define('_AM_SOAPBOX8_TEST_COLORPICKER', 'colorpicker');
define('_AM_SOAPBOX8_TEST_UPLOADIMAGE', 'uploadimage');
define('_AM_SOAPBOX8_TEST_UPLOADFILE', 'uploadfile');
define('_AM_SOAPBOX8_TEST_TEXTDATASELECT', 'textdataselect');
define('_AM_SOAPBOX8_TEST_DATETIMESELECT', 'datetimeselect');
define('_AM_SOAPBOX8_TEST_ARTICLESLINK', 'articleslink');
//Blocks.php
//Permissions
define('_AM_SOAPBOX8_PERMISSIONS_GLOBAL', 'Global permissions');
define('_AM_SOAPBOX8_PERMISSIONS_GLOBAL_DESC', 'Only users in the group that you select may global this');
define('_AM_SOAPBOX8_PERMISSIONS_GLOBAL_4', 'Rate from user');
define('_AM_SOAPBOX8_PERMISSIONS_GLOBAL_8', 'Submit from user side');
define('_AM_SOAPBOX8_PERMISSIONS_GLOBAL_16', 'Auto approve');
define('_AM_SOAPBOX8_PERMISSIONS_APPROVE', 'Permissions to approve');
define('_AM_SOAPBOX8_PERMISSIONS_APPROVE_DESC', 'Only users in the group that you select may approve this');
define('_AM_SOAPBOX8_PERMISSIONS_VIEW', 'Permissions to view');
define('_AM_SOAPBOX8_PERMISSIONS_VIEW_DESC', 'Only users in the group that you select may view this');
define('_AM_SOAPBOX8_PERMISSIONS_SUBMIT', 'Permissions to submit');
define('_AM_SOAPBOX8_PERMISSIONS_SUBMIT_DESC', 'Only users in the group that you select may submit this');
define('_AM_SOAPBOX8_GPERMUPDATED', 'Permissions have been changed successfully');
define('_AM_SOAPBOX8_PERMISSIONS_NOPERMSSET', 'Permission cannot be set: No test created yet! Please create a test first.');

//Errors
define('_AM_SOAPBOX8_UPGRADEFAILED0', "Update failed - couldn't rename field '%s'");
define('_AM_SOAPBOX8_UPGRADEFAILED1', "Update failed - couldn't add new fields");
define('_AM_SOAPBOX8_UPGRADEFAILED2', "Update failed - couldn't rename table '%s'");
define('_AM_SOAPBOX8_ERROR_COLUMN', 'Could not create column in database : %s');
define('_AM_SOAPBOX8_ERROR_BAD_XOOPS', 'This module requires XOOPS %s+ (%s installed)');
define('_AM_SOAPBOX8_ERROR_BAD_PHP', 'This module requires PHP version %s+ (%s installed)');
define('_AM_SOAPBOX8_ERROR_TAG_REMOVAL', 'Could not remove tags from Tag Module');
//directories
define('_AM_SOAPBOX8_AVAILABLE', "<span style='color : green;'>Available. </span>");
define('_AM_SOAPBOX8_NOTAVAILABLE', "<span style='color : red;'>is not available. </span>");
define('_AM_SOAPBOX8_NOTWRITABLE', "<span style='color : red;'>" . ' should have permission ( %1$d ), but it has ( %2$d )' . '</span>');
define('_AM_SOAPBOX8_CREATETHEDIR', 'Create it');
define('_AM_SOAPBOX8_SETMPERM', 'Set the permission');
define('_AM_SOAPBOX8_DIRCREATED', 'The directory has been created');
define('_AM_SOAPBOX8_DIRNOTCREATED', 'The directory can not be created');
define('_AM_SOAPBOX8_PERMSET', 'The permission has been set');
define('_AM_SOAPBOX8_PERMNOTSET', 'The permission can not be set');
define('_AM_SOAPBOX8_VIDEO_EXPIREWARNING', 'The publishing date is after expiration date!!!');
//Sample Data
define('_AM_SOAPBOX8_ADD_SAMPLEDATA', 'Add Sample Data (will delete ALL current data)');
define('_AM_SOAPBOX8_SAMPLEDATA_SUCCESS', 'Sample Date uploaded successfully');

//Error NoFrameworks
define('_AM_ERROR_NOFRAMEWORKS', 'Error: You don&#39;t use the Frameworks \'admin module\'. Please install this Frameworks');
define('_AM_SOAPBOX8_MAINTAINEDBY', 'is maintained by the');
