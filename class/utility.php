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

require_once __DIR__ . '/../include/config.php';

/**
 * Class Soapbox8Utility
 */
class Soapbox8Utility
{
    public static function selectSorting($text, $form_sort)
    {
        global $start, $order, $file_cat, $sort, $xoopsModule;

        if (!isset($moduleDirName)) {
            $moduleDirName = basename(dirname(__DIR__));
        }
        if (false !== ($moduleHelper = Xmf\Module\Helper::getHelper($moduleDirName))) {
        } else {
            $moduleHelper = Xmf\Module\Helper::getHelper('system');
        }

        $pathModIcon16 = XOOPS_URL . '/modules/' . $moduleDirName . '/' . $moduleHelper->getModule()->getInfo('modicons16');

        $select_view = '<form name="form_switch" id="form_switch" action="' . $_SERVER['REQUEST_URI'] . '" method="post"><span style="font-weight: bold;">' . $text . '</span>';
        //$sorts =  $sort ==  'asc' ? 'desc' : 'asc';
        if ($form_sort == $sort) {
            $sel1 = $order === 'asc' ? 'selasc.png' : 'asc.png';
            $sel2 = $order === 'desc' ? 'seldesc.png' : 'desc.png';
        } else {
            $sel1 = 'asc.png';
            $sel2 = 'desc.png';
        }
        $select_view .= '  <a href="' . $_SERVER['PHP_SELF'] . '?start=' . $start . '&sort=' . $form_sort . '&order=asc" /><img src="' . $pathModIcon16 . '/' . $sel1 . '" title="ASC" alt="ASC"></a>';
        $select_view .= '<a href="' . $_SERVER['PHP_SELF'] . '?start=' . $start . '&sort=' . $form_sort . '&order=desc" /><img src="' . $pathModIcon16 . '/' . $sel2 . '" title="DESC" alt="DESC"></a>';
        $select_view .= '</form>';

        return $select_view;
    }



    /***************Blocks***************/
    /**
     * @param array $cats
     * @return string
     */
    public static function block_addCatSelect($cats)
    {
        if (is_array($cats)) {
            $cat_sql = '(' . current($cats);
            array_shift($cats);
            foreach ($cats as $cat) {
                $cat_sql .= ',' . $cat;
            }
            $cat_sql .= ')';
        }

        return $cat_sql;
    }

    /**
     * @param $content
     */
    public static function meta_keywords($content)
    {
        global $xoopsTpl, $xoTheme;
        $myts    = MyTextSanitizer::getInstance();
        $content = $myts->undoHtmlSpecialChars($myts->displayTarea($content));
        if (null !== $xoTheme && is_object($xoTheme)) {
            $xoTheme->addMeta('meta', 'keywords', strip_tags($content));
        } else {    // Compatibility for old Xoops versions
            $xoopsTpl->assign('xoops_meta_keywords', strip_tags($content));
        }
    }

    /**
     * @param $content
     */
    public static function meta_description($content)
    {
        global $xoopsTpl, $xoTheme;
        $myts    = MyTextSanitizer::getInstance();
        $content = $myts->undoHtmlSpecialChars($myts->displayTarea($content));
        if (null !== $xoTheme && is_object($xoTheme)) {
            $xoTheme->addMeta('meta', 'description', strip_tags($content));
        } else {    // Compatibility for old Xoops versions
            $xoopsTpl->assign('xoops_meta_description', strip_tags($content));
        }
    }

    /**
     * @param $tableName
     * @param $columnName
     *
     * @return array
     */
    public static function enumerate($tableName, $columnName)
    {
        $table = $GLOBALS['xoopsDB']->prefix($tableName);

        $result = $GLOBALS['xoopsDB']->query("SELECT COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS
        WHERE TABLE_NAME = '" . $table . "' AND COLUMN_NAME = '" . $columnName . "'")
                  || die ($GLOBALS['xoopsDB']->error());

        $sql    = 'SELECT COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = "' . $table . '" AND COLUMN_NAME = "' . $columnName . '"';
        $result = $GLOBALS['xoopsDB']->query($sql);
        if (!$result) {
            die ($GLOBALS['xoopsDB']->error());
        }

        $row      = $GLOBALS['xoopsDB']->fetchBoth($result);
        $enumList = explode(',', str_replace("'", '', substr($row['COLUMN_TYPE'], 5, strlen($row['COLUMN_TYPE']) - 6)));

        return $enumList;
    }

    /**
     * @param array|string $tableName
     * @param int          $id_field
     * @param int          $id
     *
     * @return mixed
     */
    public static function cloneRecord($tableName, $id_field, $id)
    {
        $table = $GLOBALS['xoopsDB']->prefix($tableName);
        // copy content of the record you wish to clone 
        $tempTable = $GLOBALS['xoopsDB']->fetchArray($GLOBALS['xoopsDB']->query("SELECT * FROM $table WHERE $id_field='$id' "), MYSQLI_ASSOC) or die('Could not select record');
        // set the auto-incremented id's value to blank.
        unset($tempTable[$id_field]);
        // insert cloned copy of the original  record 
        $result = $GLOBALS['xoopsDB']->queryF("INSERT INTO $table (" . implode(', ', array_keys($tempTable)) . ") VALUES ('" . implode("', '", array_values($tempTable)) . "')") || die ($GLOBALS['xoopsDB']->error());

        // Return the new id
        $new_id = $GLOBALS['xoopsDB']->getInsertId();

        return $new_id;
    }


    //========== NEW METHODS ==============================

    /**
     * Function responsible for checking if a directory exists, we can also write in and create an index.html file
     *
     * @param string $folder The full path of the directory to check
     *
     * @return void
     */
    public static function createFolder($folder)
    {
        try {
            if (!file_exists($folder)) {
                if (!mkdir($folder) && !is_dir($folder)) {
                    throw new \RuntimeException(sprintf('Unable to create the %s directory', $folder));
                } else {
                    file_put_contents($folder . '/index.html', '<script>history.go(-1);</script>');
                }
            }
        }
        catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), '', '<br>';
        }
    }

    /**
     * @param $file
     * @param $folder
     * @return bool
     */
    public static function copyFile($file, $folder)
    {
        return copy($file, $folder);
        //        try {
        //            if (!is_dir($folder)) {
        //                throw new \RuntimeException(sprintf('Unable to copy file as: %s ', $folder));
        //            } else {
        //                return copy($file, $folder);
        //            }
        //        } catch (Exception $e) {
        //            echo 'Caught exception: ', $e->getMessage(), "\n", "<br>";
        //        }
        //        return false;
    }

    /**
     * @param $src
     * @param $dst
     */
    public static function recurseCopy($src, $dst)
    {
        $dir = opendir($src);
        //    @mkdir($dst);
        while (false !== ($file = readdir($dir))) {
            if (($file !== '.') && ($file !== '..')) {
                if (is_dir($src . '/' . $file)) {
                    self::recurseCopy($src . '/' . $file, $dst . '/' . $file);
                } else {
                    copy($src . '/' . $file, $dst . '/' . $file);
                }
            }
        }
        closedir($dir);
    }

    /**
     *
     * Verifies XOOPS version meets minimum requirements for this module
     * @static
     * @param XoopsModule $module
     *
     * @return bool true if meets requirements, false if not
     */
    public static function checkVerXoops(XoopsModule $module)
    {
        xoops_loadLanguage('admin', $module->dirname());
        //check for minimum XOOPS version
        $currentVer  = substr(XOOPS_VERSION, 6); // get the numeric part of string
        $currArray   = explode('.', $currentVer);
        $requiredVer = '' . $module->getInfo('min_xoops'); //making sure it's a string
        $reqArray    = explode('.', $requiredVer);
        $success     = true;
        foreach ($reqArray as $k => $v) {
            if (isset($currArray[$k])) {
                if ($currArray[$k] > $v) {
                    break;
                } elseif ($currArray[$k] == $v) {
                    continue;
                } else {
                    $success = false;
                    break;
                }
            } else {
                if ((int)$v > 0) { // handles things like x.x.x.0_RC2
                    $success = false;
                    break;
                }
            }
        }

        if (!$success) {
            $module->setErrors(sprintf(_AM_SOAPBOX8_ERROR_BAD_XOOPS, $requiredVer, $currentVer));
        }

        return $success;
    }

    /**
     *
     * Verifies PHP version meets minimum requirements for this module
     * @static
     * @param XoopsModule $module
     *
     * @return bool true if meets requirements, false if not
     */
    public static function checkVerPhp(XoopsModule $module)
    {
        xoops_loadLanguage('admin', $module->dirname());
        // check for minimum PHP version
        $success = true;
        $verNum  = PHP_VERSION;
        $reqVer  = $module->getInfo('min_php');
        if (false !== $reqVer && '' !== $reqVer) {
            if (version_compare($verNum, $reqVer, '<')) {
                $module->setErrors(sprintf(_AM_SOAPBOX8_ERROR_BAD_PHP, $reqVer, $verNum));
                $success = false;
            }
        }

        return $success;
    }

    /**
     * Check Xoops Version against a provided version
     *
     * @param int    $x
     * @param int    $y
     * @param int    $z
     * @param string $signal
     * @return bool
     */
    public static function checkXoopsVersion($x, $y, $z, $signal = '==')
    {
        $xv = explode('-', str_replace('XOOPS ', '', XOOPS_VERSION));
        list($a, $b, $c) = explode('.', $xv[0]);
        $xv = $a * 10000 + $b * 100 + $c;
        $mv = $x * 10000 + $y * 100 + $z;
        if ($signal === '>') {
            return $xv > $mv;
        }
        if ($signal === '>=') {
            return $xv >= $mv;
        }
        if ($signal === '<') {
            return $xv < $mv;
        }
        if ($signal === '<=') {
            return $xv <= $mv;
        }
        if ($signal === '==') {
            return $xv == $mv;
        }

        return false;
    }
}
