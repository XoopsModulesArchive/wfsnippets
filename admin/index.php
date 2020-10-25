<?php
/*
* $Id: index.php,v 1.1 2006/03/27 01:06:48 mikhail Exp $
* Module: Snippets
* Version: v1.00
* Release Date: 15 July 2005
* Author: hsalazar, after Catzwolf
* Licence: GNU
*/

include 'admin_header.php';
require_once XOOPS_ROOT_PATH . '/modules/wfsnippets/include/groupaccess.php';

$myts = MyTextSanitizer::getInstance();

$op = '';

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

/**
 * Check to see if any categories have been created
 * if true continue script
 * if false warns user that no categories have been created.
 */
$result = $xoopsDB->query('SELECT catID, name FROM ' . $xoopsDB->prefix('snipcats') . ' ORDER BY name');
if ('0' == $GLOBALS['xoopsDB']->getRowsNum($result)) {
    redirect_header('category.php', '1', _AM_NOTCTREATEDACAT);

    exit();
}

/*
* Function to edit and modify Topics
*/

function edittopic($snippetID = '')
{
    /*
    * Clear all variable before we start
    */

    $title = '';

    $body = '';

    $summary = '';

    $groupid = '';

    $weight = 1;

    $catid = 0;

    $oldid = 0;

    global $xoopsUser, $xoopsUser, $xoopsConfig, $xoopsDB, $modify;

    require_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';

    /*
    * checks to see if we are modifying a FAQ
    */

    if ($modify) {
        /*
        * Get FAQ info from database
        */

        $result = $xoopsDB->query('SELECT snippetID, catID, title, body, summary, weight, groupid FROM ' . $xoopsDB->prefix('snippets') . " WHERE snippetID = '$snippetID'");

        [$snippetID, $catID, $title, $body, $summary, $weight, $groupid] = $xoopsDB->fetchRow($result);

        $oldid = $catID;

        /*
        * If no FAQ are found, tell user and exit
        */

        if (0 == $xoopsDB->getRowsNum($result)) {
            redirect_header('index.php', 1, _AM_NOSNIPPETTOEDIT);

            exit();
        }

        $sform = new XoopsThemeForm(_AM_MODIFYEXSITSNIP, 'op', xoops_getenv('PHP_SELF'));
    } else {
        $sform = new XoopsThemeForm(_AM_ADDSNIPPET, 'op', xoops_getenv('PHP_SELF'));
    }

    if ($modify) {
        $sform->addElement(new XoopsFormSelectGroup(_AM_GROUPPROMPT, 'groupid', true, getGroupIda($groupid), 5, true));
    } else {
        $sform->addElement(new XoopsFormSelectGroup(_AM_GROUPPROMPT, 'groupid', true, true, 5, true));
    }

    /*
    * Get information for pulldown menu using XoopsTree.
    * First var is the database table
    * Second var is the unique field ID for the categories
    * Last one is not set as we do not have sub menus in WF-FAQ
    */

    $mytree = new XoopsTree($xoopsDB->prefix('snipcats'), 'catid', '0');

    /*
    * Get the mytree pulldown object for use with XoopsForm class
    */

    ob_start();

    $sform->addElement(new XoopsFormHidden('catid', $catid));

    $mytree->makeMySelBox('name', $catid);

    $sform->addElement(new XoopsFormLabel(_AM_CREATEIN, ob_get_contents()));

    ob_end_clean();

    /*
    * Set the user textboxs using XoopsForm Class for user input
    */

    $sform->addElement(new XoopsFormText(_AM_TOPICW, 'weight', 4, 4, $weight));

    $sform->addElement(new XoopsFormText(_AM_SNIPTITLE, 'title', 50, 80, $title), true);

    $sform->addElement(new XoopsFormDhtmlTextArea(_AM_SNIPBODY, 'body', $body, 15, 60), true);

    $sform->addElement(new XoopsFormTextArea(_AM_SUMMARY, 'summary', $summary, 7, 60));

    /*
    * XoopsFormHidden, pass on 'unseen' var's'
    */

    $sform->addElement(new XoopsFormHidden('snippetID', $snippetID));

    $sform->addElement(new XoopsFormHidden('modify', $modify));

    $sform->addElement(new XoopsFormHidden('oldid', $oldid));

    /*
    * XoopsForm Class Buttons
    */

    $button_tray = new XoopsFormElementTray('', '');

    $hidden = new XoopsFormHidden('op', 'save');

    $button_tray->addElement($hidden);

    /*
    * Switch to show different buttons for either when creating or modifying a FAQ.
    */

    if (!$modify) {
        $button_tray->addElement(new XoopsFormButton('', 'create', _AM_CREATE, 'submit'));
    } else {
        $button_tray->addElement(new XoopsFormButton('', 'update', _AM_MODIFY, 'submit'));
    }

    $sform->addElement($button_tray);

    $sform->display();

    unset($hidden);

    /*
    *End of XoopsForm
    */
}
/*
* end function
*/

switch ($op) {
case 'edit':
        xoops_cp_header();
        $modify = 1;
        sniplinks();
        edittopic($snippetID);
        break;
case 'mod':
        xoops_cp_header();
        $modify = 1;
        sniplinks();
        edittopic($_POST['snippetID']);
        break;
case 'del':
    global $xoopsUser, $xoopsUser, $xoopsConfig, $xoopsDB;

        if ($confirm) {
            $xoopsDB->query('DELETE FROM ' . $xoopsDB->prefix('snippets') . " WHERE snippetID = $snippetID");

            redirect_header('index.php', 1, sprintf(_AM_SNIPPETISDELETED, $title));

            exit();
        }  
            if (!$subm) {
                $snippetID = $_POST['snippetID'];
            } else {
                $snippetID = $t;
            }
            $result = $xoopsDB->query('SELECT catID, title FROM ' . $xoopsDB->prefix('snippets') . " WHERE snippetID = $snippetID");
            [$catID, $title] = $xoopsDB->fetchRow($result);

            xoops_cp_header();
            echo "<table width='100%' border='0' cellpadding = '2' cellspacing='1' class = 'confirmMsg'><tr><td class='confirmMsg'>";
            echo "<div class='confirmMsg'>";
            echo '<h4>';
            echo '' . _AM_DELETETHISSNIPPET . "</font></h4>$title<br><br>";
            echo '<table><tr><td>';
            echo myTextForm('index.php?op=del&snippetID=' . $snippetID . "&confirm=1&title=$title", _AM_YES);
            echo '</td><td>';
            echo myTextForm('category.php?op=default', _AM_NO);
            echo '</td></tr></table>';
            echo '</div><br><br>';
            echo '</td></tr></table>';
            xoops_cp_footer();

    exit();
    break;
case 'save':
    global $xoopsUser, $xoopsDB;

    //$cat = $myts->addSlashes($_POST['catid']);

    if (isset($_POST['catid'])) {
        $cat = $_POST['catid'];
    }

    if (($_POST['weight']) && is_numeric($_POST['weight'])) {
        $weight = $myts->addSlashes($_POST['weight']);
    } else {
        $weight = 1;
    }

    $groupid = saveaccess($_POST['groupid']);
    $title = $myts->addSlashes($_POST['title']);
    $body = $myts->addSlashes($_POST['body']);
    $summary = $myts->addSlashes($_POST['summary']);
    $snippetID = $myts->addSlashes($_POST['snippetID']);
    $oldid = $myts->addSlashes($_POST['oldid']);
    $title = str_replace('"', '&quot;', $title);

    // Define variables
    $error = 0;
    $word = null;
    $uid = $xoopsUser->uid();
    $submit = 1;
    $date = time();
    if (!$_POST['modify']) {
        if ($xoopsDB->query('INSERT INTO ' . $xoopsDB->prefix('snippets') . " (catID, title, body, summary, uid, datesub, submit, weight, groupid) VALUES ('$cat', '$title', '$body', '$summary', '$uid', '$date', '$submit', '$weight', '$groupid')")) {
            redirect_header('index.php', '1', _AM_SNIPCREATED);
        } else {
            redirect_header('index.php', '1', _AM_SNIPNOTCREATED);
        }
    } else {
        if ($xoopsDB->query('UPDATE ' . $xoopsDB->prefix('snippets') . " SET title = '$title', body = '$body', summary = '$summary',  weight = '$weight', groupid = '$groupid', catID = '$cat' WHERE snippetID = $snippetID")) {
            if ($cat != $oldid) {
                $xoopsDB->query('UPDATE ' . $xoopsDB->prefix('snipcats') . " SET total = total - 1 WHERE catID = '$oldid'");

                $xoopsDB->query('UPDATE ' . $xoopsDB->prefix('snipcats') . " SET total = total + 1 WHERE catID = '$cat'");
            }

            redirect_header('index.php', '1', _AM_SNIPMODIFY);
        } else {
            redirect_header('index.php', '1', _AM_SNIPNOTMODIFY);
        }
    }
    exit();
    break;
case 'default':
     default:

xoops_cp_header();

global $xoopsUser, $xoopsUser, $xoopsConfig, $xoopsDB;
    echo '<div><h3>' . _AM_TOPICSADMIN . '</h3></div>';

    sniplinks();

    $result = $xoopsDB->query('SELECT * FROM ' . $xoopsDB->prefix('snippets') . '');
    $check = $xoopsDB->getRowsNum($result);
    if ($check >= 1) {
        $mytree = new XoopsTree($xoopsDB->prefix('snippets'), 'snippetID', '0');

        $sform = new XoopsThemeForm(_AM_MODIFYSNIP, 'storyform', xoops_getenv('PHP_SELF'));

        //Modify Category

        ob_start();

        $sform->addElement(new XoopsFormHidden('snippetID', ''));

        $mytree->makeMySelBox('title', 'snippetID');

        $sform->addElement(new XoopsFormLabel(_AM_MODIFYTHISSNIP, ob_get_contents()));

        ob_end_clean();

        $button_tray = new XoopsFormElementTray('', '');

        $hidden = new XoopsFormHidden('modify', 1);

        $hidden = new XoopsFormHidden('op', 'mod');

        $button_tray->addElement($hidden);

        $button_tray->addElement(new XoopsFormButton('', 'mod', _AM_MODIFY, 'submit'));

        $sform->addElement($button_tray);

        $sform->display();

        //Delete Category

        $mytree2 = new XoopsTree($xoopsDB->prefix('snippets'), 'snippetID', '0');

        $dform = new XoopsThemeForm(_AM_DELSNIP, 'storyform', xoops_getenv('PHP_SELF'));

        ob_start();

        $dform->addElement(new XoopsFormHidden('snippetID', ''));

        $mytree2->makeMySelBox('title', 'snippetID');

        $dform->addElement(new XoopsFormLabel(_AM_DELTHISSNIP, ob_get_contents()));

        ob_end_clean();

        $button_tray = new XoopsFormElementTray('', '');

        $hidden = new XoopsFormHidden('modify', 1);

        $hidden = new XoopsFormHidden('op', 'del');

        $button_tray->addElement($hidden);

        $button_tray->addElement(new XoopsFormButton('', 'mod', _AM_DELETE, 'submit'));

        $dform->addElement($button_tray);

        $dform->display();
    }
    edittopic();
    break;
}
snipfooter();
xoops_cp_footer();
