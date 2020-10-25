<?php
/*
* $Id: submissions.php,v 1.1 2006/03/27 01:06:48 mikhail Exp $
* Module: Snippets
* Version: v1.00
* Release Date: 15 July 2005
* Author: hsalazar, after Catzwolf
* Licence: GNU
*/

require __DIR__ . '/admin_header.php';

$op = '';

global $xoopsUser, $xoopsUser, $xoopsConfig;

$myts = MyTextSanitizer::getInstance();

foreach ($_POST as $k => $v) {
    ${$k} = $v;
}

foreach ($_GET as $k => $v) {
    ${$k} = $v;
}

if (isset($_GET['op'])) {
    $op = $_GET['op'];
}
if (isset($_POST['op'])) {
    $op = $_POST['op'];
}

switch ($op) {
case 'view':

        global $xoopsUser, $xoopsDB;
        //if (empty($c)) $c = 1;
        // Display the answer
        $result = $xoopsDB->query('SELECT * FROM ' . $xoopsDB->prefix('snippets') . " WHERE snippetID = $t");
        [$snippetID, $catID, $title, $body, $summary, $uid, $submit, $datesub] = $GLOBALS['xoopsDB']->fetchRow($result);

        $result2 = $xoopsDB->query('SELECT name FROM ' . $xoopsDB->prefix('snipcats') . " WHERE catID = '$c'");
        [$cat] = $xoopsDB->getRowsNum($result2);

        $body = str_replace("\r\n", '<br>', $body);
        $body = str_replace("\n", '<br>', $body);

           if ($uid) {
               $user = new xoopsUser($uid);

               $poster = $user->getVar('uname');

               $submitter = "<a href='" . XOOPS_URL . '/userinfo.php?uid=' . $uid . "'>$poster</a>";
           } else {
               $submitter = 'Guest';
           }

        $datesub = formatTimestamp($datesub, 'D, d-M-Y, H:i');

        xoops_cp_header();
        echo "<table border='0' width='100%' cellspacing='1' cellpadding='2'>";
        echo "<tr valign='middle' class='b4'>";
        echo "<td align='left' colspan='3' class='bg3'><b>" . _AM_SUBPREVIEW . '</b></td></tr>';
        echo '<tr>';
        echo "<td width='100%'><br><br>" . _AM_SUBADMINPREV . '</td>';
        echo '</tr>';
        echo '</table>';
        echo "<table border='0' width='100%' cellspacing='1' cellpadding='2'>";
        echo '<tr>';
        echo "<td class='bg3' colspan='2'><b>&nbsp;" . _MD_SNIPPET . ": $title</td>";
        echo '</tr>';
        echo "<tr><td class='head'>" . _AM_AUTHOR . ": $submitter";
        echo '<br>' . _AM_PUBLISHED . ": $datesub</td></tr>";
        echo "<td><br>$body<br><br></td>";
        echo '</tr>';
        echo "<tr><td class='even'  align = 'center'><b>&nbsp<a href='submissions.php?op=allow&t=$t&c=$c'>" . _AM_SUBALLOW . "</a> <a href='index.php?op=del&subm=1&t=$snippetID''>" . _AM_SUBDELETE . '</a></b></td></tr>';
        echo "<tr><td class='head' colspan='2' align = 'center'><a href='submissions.php?op=cat'>" . _AM_SUBRETURNTO . '</a></td></tr>';
        echo '</table>';
        exit();
    break;
case 'allow':
        $xoopsDB->queryF('UPDATE ' . $xoopsDB->prefix('snippets') . " SET submit = '1'  WHERE snippetID = $t");
        $xoopsDB->queryF('UPDATE ' . $xoopsDB->prefix('snipcats') . " SET total = total + 1 WHERE catID = $c");
        redirect_header('submissions.php', 1, _AM_DBUPDATED);
        exit();
    break;
case 'cat':
default:

        global $xoopsUser, $xoopDB, $xoopsConfig;

        $results = $xoopsDB->query('SELECT * FROM ' . $xoopsDB->prefix('snippets') . ' WHERE submit = 0 ORDER BY datesub');
        $totalfiles = $xoopsDB->getRowsNum($results);

        if (0 == (int)$totalfiles) {
            redirect_header('category.php?op=default', 1, 'There are no FAQ for validation.');

            exit();
        }  
            xoops_cp_header();
            // Display the questions

            sniplinks();
            echo '<br>';
            echo "<table border='0' width='100%'  cellspacing='1' cellpadding='4' class = 'outer'>";
            echo "<tr valign='middle' >";
            echo "<td align='left' class='bg3' colspan =5><b>" . _AM_SNIPVAL . '</b></td>';
            echo '</tr></table>';
            echo '<br>';
            echo "<div width='100%' colspan =5 ><b>New Submissions</b></div>";
            echo '<br>';
            echo "<table border='0' width='100%' cellspacing='1' cellpadding='2' class = 'outer'>";
            echo "<td width='5%' align='center' valign='middle' class='bg3'><b>ID</b></td>";
            echo "<td width='25%' align='left' valign='middle' class='bg3'><b>Title</b></td>";
            echo "<td width='25%' align='center' valign='middle' class='bg3'><b>Author</b></td>";
            echo "<td width='25%' align='center' valign='middle' class='bg3'><b>Submitted</b></td>";
            echo "<td width='25%' align='center' colspan='2' class='bg3'><b>Action</b></td>";
            echo '</tr>';

            while (list($snippetID, $catID, $title, $body, $summary, $uid, $submit, $datesub) = $xoopsDB->fetchRow($results)) {
                if ($uid) {
                    $user = new xoopsUser($uid);

                    $poster = $user->getVar('uname');

                    $submitter = "<a href='" . XOOPS_URL . '/userinfo.php?uid=' . $uid . "'>$poster</a>"; //$thisUser->getVar("uname");
                } else {
                    $submitter = 'Guest';
                }

                $datesub = formatTimestamp($datesub, 'D, d-M-Y, H:i');

                echo '<tr>';

                echo "<td class='head' align = 'center'>$snippetID</td>";

                echo "<td class='even'><a href='submissions.php?op=view&t=$snippetID&c=$catID'>$title</a></td>";

                echo "<td class='even'><p align='center'>$submitter</td>";

                echo "<td class='even'><p align='center'>$datesub</td>";

                echo "<td align='center' class='even' > <a href='submissions.php?op=allow&t=$snippetID&c=$catID'>" . _AM_SUBALLOW . '</a></td>';

                echo "<td align='center' class='even' > <a href='index.php?op=del&subm=1&t=$snippetID'>" . _AM_SUBDELETE . '</a>';

                echo '</td></tr>';
            }
            echo '<tr>';
            echo "<td colspan='6' align = 'center' class='head' ><a href='index.php'>" . _AM_SUBRETURN . '</a></td>';
            echo '</tr></table>';
            echo '</td>';
            echo '</tr></table>';

    break;
}
snipfooter();
xoops_cp_footer();
