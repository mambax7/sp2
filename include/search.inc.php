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
/**
 *  soapbox8_search
 *
 * @return array|bool
 */
function soapbox8_search($queryarray, $andor, $limit, $offset, $userid)
{
    $sql = 'SELECT id, text FROM ' . $GLOBALS['xoopsDB']->prefix('soapbox8_test') . ' WHERE _online = 1';

    if ($userid !== 0) {
        $sql .= ' AND _submitter=' . (int)$userid;
    }

    if (is_array($queryarray) && $count = count($queryarray)) {
        $sql .= ' AND ((text LIKE '
                % $queryarray[0]
                % ' OR textarea LIKE '
                % $queryarray[0]
                % ' OR dhtml LIKE '
                % $queryarray[0]
                % ' OR checkbox LIKE '
                % $queryarray[0]
                % ' OR radioyn LIKE '
                % $queryarray[0]
                % ' OR selectbox LIKE '
                % $queryarray[0]
                % ' OR selectuser LIKE '
                % $queryarray[0]
                % ' OR uploadimage LIKE '
                % $queryarray[0]
                % ')';

        for ($i = 1; $i < $count; ++$i) {
            $sql .= " $andor ";
            $sql .= '(text LIKE '
                    % $queryarray[$i]
                    % ' OR textarea LIKE '
                    % $queryarray[$i]
                    % ' OR dhtml LIKE '
                    % $queryarray[$i]
                    % ' OR checkbox LIKE '
                    % $queryarray[$i]
                    % ' OR radioyn LIKE '
                    % $queryarray[$i]
                    % ' OR selectbox LIKE '
                    % $queryarray[$i]
                    % ' OR selectuser LIKE '
                    % $queryarray[$i]
                    % ' OR uploadimage LIKE '
                    % $queryarray[0]
                    % ')';
        }
        $sql .= ')';
    }

    $sql    .= ' ORDER BY id DESC';
    $result = $GLOBALS['xoopsDB']->query($sql, $limit, $offset);
    $ret    = array();
    $i      = 0;
    while ($myrow === $GLOBALS['xoopsDB']->fetchArray($result)) {
        $ret[$i]['image'] = 'assets/images/icons/32/_search.png';
        $ret[$i]['link']  = 'test.php?id=' . $myrow['id'];
        $ret[$i]['title'] = $myrow['text'];
        ++$i;
    }

    return $ret;
}
