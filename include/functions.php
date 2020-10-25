<?php
/*
* $Id: functions.php,v 1.1 2006/03/27 01:06:50 mikhail Exp $
* Module: WF-Snippets
* Version: v1.00
* Release Date: 12 July 2005
* Author: Catzwolf
* Licence: GNU
*/
require_once XOOPS_ROOT_PATH . '/modules/wfsnippets/include/groupaccess.php';

function generatecjump()
{
    global $PHP_SELF, $tbprefix, $xoopsDB;

    $result = $xoopsDB->query('SELECT catID, name FROM ' . $xoopsDB->prefix('snipcats') . '');

    if (1 == $xoopsDB->fetchRow($result)) {
        return '&nbsp;';
    }

    $html = '<form method="post">';

    $html .= '<select name="cjump" onchange="jumpMenu(this)">';

    $html .= '<option value="index.php">Category Jump:</option>';

    $html .= '<option value="index.php">--------</option>';

    while ($query_data = $GLOBALS['xoopsDB']->fetchBoth($result)) {
        $html .= '<option value="index.php?op=cat&c=' . $query_data['catID'] . '">' . $query_data['name'] . '</option>';
    }

    $html .= '</select>';

    $html .= '</form>';

    return $html;
}

function sniplinks()
{
    echo "<table width='100%' border='0' cellspacing='1' cellpadding='2' class = outer>";

    echo "<tr><th class = 'bg3' colspan = '3'>" . _AM_SNIPADMINHEAD . '</th></tr>';

    echo '<tr>';

    echo " <td class = 'even'><a href='index.php?op=default'>" . _AM_SNIPNEWSNIPPET . '</a></td>';

    echo " <td class = 'odd'>" . _AM_SNIPNEWSNIPPETTXT . '</td>';

    echo '</tr>';

    echo '<tr>';

    echo " <td width='24%' class = 'even'><a href='category.php?op=default'>" . _AM_SNIPNEWCAT . '</a></td>';

    echo " <td class = 'odd'>" . _AM_SNIPNEWCATTXT . '</td>';

    echo '</tr>';

    echo '<tr>';

    echo "<td class = 'even'><a href='submissions.php?op=cat'>" . _AM_SNIPVALIDATE . '</a></td>';

    echo "<td class = 'odd'>" . _AM_SNIPVALTXT . '</td>';

    echo '</tr>';

    echo '</table>';
}

function snipfooter()
{
    echo "<br><div style='text-align:center'>" . _AM_VISITSUPPORT . '</div>';
}

function countByCategory($c = 0)
{
    global $xoopsUser, $xoopsConfig, $xoopsDB;

    $count = 0;

    $sql = $xoopsDB->query('SELECT * FROM ' . $xoopsDB->prefix('snippets') . " WHERE submit ='1' and catID = '$c'");

    while ($myrow = $xoopsDB->fetchArray($sql)) {
        if ('1' == checkAccess($myrow['groupid'])) {
            $count++;
        }
    }

    return $count;
}

//updates rating data in itemtable for a given item
function updaterating($sel_id)
{
    global $xoopsDB;

    $query = 'select rating FROM ' . $xoopsDB->prefix('snippets_votedata') . ' WHERE lid = ' . $sel_id . '';

    $voteresult = $xoopsDB->query($query);

    $votesDB = $xoopsDB->getRowsNum($voteresult);

    $totalrating = 0;

    while (list($rating) = $xoopsDB->fetchRow($voteresult)) {
        $totalrating += $rating;
    }

    $finalrating = $totalrating / $votesDB;

    $finalrating = number_format($finalrating, 4);

    $sql = sprintf('UPDATE %s SET rating = %u, votes = %u WHERE snippetID = %u', $xoopsDB->prefix('snippets'), $finalrating, $votesDB, $sel_id);

    $xoopsDB->query($sql);
}
