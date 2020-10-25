<?php
/*
* $Id: search.inc.php,v 1.1 2006/03/27 01:06:50 mikhail Exp $
* Module: WF-Snippets
* Version: v1.00
* Release Date: 12 July 2005
* Author: hsalazar, after Catzwolf
* Licence: GNU
*/

function snip_search($queryarray, $andor, $limit, $offset, $userid)
{
    global $xoopsDB;

    $ret = [];

    if (0 != $userid) {
        return $ret;
    }

    $sql = 'SELECT snippetID, title, body, uid, datesub FROM ' . $xoopsDB->prefix('snippets') . ' WHERE submit=1 ';

    // because count() returns 1 even if a supplied variable

    // is not an array, we must check if $querryarray is really an array

    $count = count($queryarray);

    if ($count > 0 && is_array($queryarray)) {
        $sql .= "AND ((title LIKE '%$queryarray[0]%' OR body LIKE '%$queryarray[0]%')";

        for ($i = 1; $i < $count; $i++) {
            $sql .= " $andor ";

            $sql .= "(title LIKE '%$queryarray[$i]%' OR body LIKE '%$queryarray[$i]%')";
        }

        $sql .= ') ';
    }

    $sql .= 'ORDER BY snippetID DESC';

    $result = $xoopsDB->query($sql, $limit, $offset);

    $i = 0;

    while ($myrow = $xoopsDB->fetchArray($result)) {
        $ret[$i]['image'] = 'images/question2.gif';

        $ret[$i]['link'] = 'index.php?op=view&t=' . $myrow['snippetID'];

        $ret[$i]['title'] = $myrow['title'];

        $ret[$i]['time'] = $myrow['datesub'];

        $ret[$i]['uid'] = $myrow['uid'];

        $i++;
    }

    return $ret;
}
