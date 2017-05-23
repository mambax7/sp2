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

require_once dirname(__DIR__) . '/class/utility.php';
/**
 * @param $options
 *
 * @return array
 */
function showSoapbox8Test($options)
{
    require_once dirname(__DIR__) . '/class/test.php';
    $moduleDirName = basename(dirname(__DIR__));
    $myts          = MyTextSanitizer::getInstance();

    $block        = array();
    $type_block   = $options[0];
    $nb_test      = $options[1];
    $lenght_title = $options[2];

    /** @var XoopsObjectHandler $testHandler */
    $testHandler = xoops_getModuleHandler('test', $moduleDirName);
    $criteria    = new CriteriaCompo();
    array_shift($options);
    array_shift($options);
    array_shift($options);
    if ($type_block) {
        $criteria->add(new Criteria('id', 0, '!='));
        $criteria->setSort('id');
        $criteria->setOrder('ASC');
    }

    $criteria->setLimit($nb_test);
    $testArray = $testHandler->getAll($criteria);
    foreach (array_keys($testArray) as $i) {
        $block[$i]['text']     = $testArray[$i]->getVar('text');
        $block[$i]['textarea'] = $testArray[$i]->getVar('textarea');
    }

    return $block;
}

/**
 * @param $options
 *
 * @return string
 */
function editSoapbox8Test($options)
{
    require_once dirname(__DIR__) . '/class/test.php';
    $moduleDirName = basename(dirname(__DIR__));

    $form = _MB_SOAPBOX8_DISPLAY;
    $form .= "<input type='hidden' name='options[0]' value='" . $options[0] . "' />";
    $form .= "<input name='options[1]' size='5' maxlength='255' value='" . $options[1] . "' type='text' />&nbsp;<br>";
    $form .= _MB_SOAPBOX8_TITLELENGTH . " : <input name='options[2]' size='5' maxlength='255' value='" . $options[2] . "' type='text' /><br><br>";

    /** @var XoopsObjectHandler $'. test . 'Handler */
    $testHandler = xoops_getModuleHandler('test', $moduleDirName);
    $criteria    = new CriteriaCompo();
    array_shift($options);
    array_shift($options);
    array_shift($options);
    $criteria->add(new Criteria('id', 0, '!='));
    $criteria->setSort('id');
    $criteria->setOrder('ASC');
    $testArray = $testHandler->getAll($criteria);
    $form      .= _MB_SOAPBOX8_CATTODISPLAY . "<br><select name='options[]' multiple='multiple' size='5'>";
    $form      .= "<option value='0' " . (in_array(0, $options) === false ? '' : "selected='selected'") . '>' . _MB_SOAPBOX8_ALLCAT . '</option>';
    foreach (array_keys($testArray) as $i) {
        $id   = $testArray[$i]->getVar('id');
        $form .= "<option value='" . $id . "' " . (in_array($id, $options) === false ? '' : "selected='selected'") . '>' . $testArray[$i]->getVar('text') . '</option>';
    }
    $form .= '</select>';

    return $form;
}
