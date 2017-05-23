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
function showSoapbox8Sbarticles($options)
{
    require_once dirname(__DIR__) . '/class/sbarticles.php';
    $moduleDirName = basename(dirname(__DIR__));
    $myts          = MyTextSanitizer::getInstance();

    $block         = array();
    $type_block    = $options[0];
    $nb_sbarticles = $options[1];
    $lenght_title  = $options[2];

    /** @var XoopsObjectHandler $sbarticlesHandler */
    $sbarticlesHandler = xoops_getModuleHandler('sbarticles', $moduleDirName);
    $criteria          = new CriteriaCompo();
    array_shift($options);
    array_shift($options);
    array_shift($options);
    if ($type_block) {
        $criteria->add(new Criteria('articleID', 0, '!='));
        $criteria->setSort('articleID');
        $criteria->setOrder('ASC');
    }

    $criteria->setLimit($nb_sbarticles);
    $sbarticlesArray = $sbarticlesHandler->getAll($criteria);
    foreach (array_keys($sbarticlesArray) as $i) {
    }

    return $block;
}

/**
 * @param $options
 *
 * @return string
 */
function editSoapbox8Sbarticles($options)
{
    require_once dirname(__DIR__) . '/class/sbarticles.php';
    $moduleDirName = basename(dirname(__DIR__));

    $form = _MB_SOAPBOX8_DISPLAY;
    $form .= "<input type='hidden' name='options[0]' value='" . $options[0] . "' />";
    $form .= "<input name='options[1]' size='5' maxlength='255' value='" . $options[1] . "' type='text' />&nbsp;<br>";
    $form .= _MB_SOAPBOX8_TITLELENGTH . " : <input name='options[2]' size='5' maxlength='255' value='" . $options[2] . "' type='text' /><br><br>";

    /** @var XoopsObjectHandler $'. sbarticles . 'Handler */
    $sbarticlesHandler = xoops_getModuleHandler('sbarticles', $moduleDirName);
    $criteria          = new CriteriaCompo();
    array_shift($options);
    array_shift($options);
    array_shift($options);
    $criteria->add(new Criteria('articleID', 0, '!='));
    $criteria->setSort('articleID');
    $criteria->setOrder('ASC');
    $sbarticlesArray = $sbarticlesHandler->getAll($criteria);
    $form            .= _MB_SOAPBOX8_CATTODISPLAY . "<br><select name='options[]' multiple='multiple' size='5'>";
    $form            .= "<option value='0' " . (in_array(0, $options) === false ? '' : "selected='selected'") . '>' . _MB_SOAPBOX8_ALLCAT . '</option>';
    foreach (array_keys($sbarticlesArray) as $i) {
        $articleID = $sbarticlesArray[$i]->getVar('articleID');
        $form      .= "<option value='" . $articleID . "' " . (in_array($articleID, $options) === false ? '' : "selected='selected'") . '>' . $sbarticlesArray[$i]->getVar('headline') . '</option>';
    }
    $form .= '</select>';

    return $form;
}
