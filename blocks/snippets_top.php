<?php
/*
* $Id: snippets_top.php,v 1.1 2006/03/27 01:06:49 mikhail Exp $
* Module: WF-Snippets
* Version: v1.03
* Release Date: 12 Sept 2005
* Author: hsalazar, after Catzwolf
* Licence: GNU
*/

//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <http://xoopscube.org>                             //
// ------------------------------------------------------------------------- //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  You may not change or alter any portion of this comment or credits       //
//  of supporting developers from this source code or any supporting         //
//  source code which is considered copyrighted (c) material of the          //
//  original comment or credit authors.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
//  ------------------------------------------------------------------------ //
require_once XOOPS_ROOT_PATH . '/include/groupaccess.php';

function b_snippets_top_show($options)
{
    global $xoopsDB;

    $myts = MyTextSanitizer::getInstance();

    $block = [];

    $sql = 'SELECT * FROM ' . $xoopsDB->prefix('snippets') . ' WHERE submit = 1 ORDER BY ' . $options[0] . ' DESC';

    $result = $xoopsDB->query($sql, $options[1], 0);

    while ($myrow = $xoopsDB->fetchArray($result)) {
        if (checkAccess($myrow['groupid'])) {
            $wfs = [];

            $title = htmlspecialchars($myrow['title'], ENT_QUOTES | ENT_HTML5);

            if (!XOOPS_USE_MULTIBYTES) {
                if (mb_strlen($myrow['title']) >= $options[2]) {
                    $title = htmlspecialchars(mb_substr($myrow['title'], 0, ($options[2] - 1)), ENT_QUOTES | ENT_HTML5) . '...';
                }
            }

            $wfs['title'] = $title;

            $wfs['id'] = $myrow['snippetID'];

            if ('datesub' == $options[0]) {
                $wfs['top'] = formatTimestamp($myrow['datesub'], 's');
            } elseif ('counter' == $options[0]) {
                $wfs['top'] = $myrow['counter'];
            }

            $block['top'][] = $wfs;
        }
    }

    return $block;
}

function b_snippets_top_edit($options)
{
    $form = '' . _MB_WFS_ORDER . "&nbsp;<select name='options[]'>";

    $form .= "<option value='datesub'";

    if ('datesub' == $options[0]) {
        $form .= " selected='selected'";
    }

    $form .= '>' . _MB_WFS_DATE . "</option>\n";

    $form .= "<option value='counter'";

    if ('counter' == $options[0]) {
        $form .= " selected='selected'";
    }

    $form .= '>' . _MB_WFS_HITS . "</option>\n";

    $form .= "</select>\n";

    $form .= '&nbsp;' . _MB_WFS_DISP . "&nbsp;<input type='text' name='options[]' value='" . $options[1] . "'>&nbsp;" . _MB_WFS_ARTCLS . '';

    $form .= '&nbsp;<br>' . _MB_WFS_CHARS . "&nbsp;<input type='text' name='options[]' value='" . $options[2] . "'>&nbsp;" . _MB_WFS_LENGTH . '';

    return $form;
}
