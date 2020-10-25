<?php
/*
* $Id: category.php,v 1.1 2006/03/27 01:06:48 mikhail Exp $
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

function editcat($catid = '')
{
    $weight = 1;

    $groupid = '1 2 3';

    $name = '';

    $description = '';

    global $xoopsUser, $xoopsUser, $xoopsConfig, $xoopsDB, $modify;

    require_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';

    if ($modify) {
        $result = $xoopsDB->query('SELECT name, description, weight, groupid FROM ' . $xoopsDB->prefix('snipcats') . " WHERE catID = '$catid'");

        [$name, $description, $weight, $groupid] = $xoopsDB->fetchRow($result);

        if (0 == $GLOBALS['xoopsDB']->getRowsNum($result)) {
            redirect_header('category.php', 1, _AM_NOCATTOEDIT);

            exit();
        }

        $sform = new XoopsThemeForm(_AM_MODIFYCAT, 'op', xoops_getenv('PHP_SELF'));
    } else {
        $sform = new XoopsThemeForm(_AM_ADDCAT, 'op', xoops_getenv('PHP_SELF'));
    }

    if ($modify) {
        $sform->addElement(new XoopsFormSelectGroup(_AM_GROUPPROMPT, 'groupid', true, getGroupIda($groupid), 5, true));
    } else {
        $sform->addElement(new XoopsFormSelectGroup(_AM_GROUPPROMPT, 'groupid', true, true, 5, true));
    }

    $sform->addElement(new XoopsFormText(_AM_TOPICW, 'weight', 4, 4, $weight));

    $sform->addElement(new XoopsFormText(_AM_CATNAME, 'name', 50, 80, $name), true);

    $sform->addElement(new XoopsFormDhtmlTextArea(_AM_CATDESCRIPT, 'description', $description, 15, 60));

    $sform->addElement(new XoopsFormHidden('catid', $catid));

    $sform->addElement(new XoopsFormHidden('modify', $modify));

    $button_tray = new XoopsFormElementTray('', '');

    $hidden = new XoopsFormHidden('op', 'addcat');

    $button_tray->addElement($hidden);

    if ('0' == $modify) {
        $button_tray->addElement(new XoopsFormButton('', 'update', _AM_CREATE, 'submit'));
    } else {
        $button_tray->addElement(new XoopsFormButton('', 'update', _AM_MODIFY, 'submit'));
    }

    $sform->addElement($button_tray);

    $sform->display();

    unset($hidden);
}

switch ($op) {
case 'mod':
        xoops_cp_header();
        $modify = 1;
        sniplinks();
        editcat($_POST['catid']);
        break;
case 'addcat':

        global $xoopsUser, $xoopsUser, $xoopsConfig, $xoopsDB, $modify, $myts;

            if (isset($_POST['catid'])) {
                $catid = $_POST['catid'];
            }

            if (($_POST['weight']) && is_numeric($_POST['weight'])) {
                $weight = $myts->addSlashes($_POST['weight']);
            } else {
                $weight = 1;
            }

            $groupid = saveaccess($_POST['groupid']);
            $name = $myts->addSlashes($_POST['name']);
            $description = $myts->addSlashes($_POST['description']);
            $description = str_replace("\r\n", '', $description);
            $name = str_replace('"', '&quot;', $name);

            // Run the query and update the data
            if ('0' == $_POST['modify']) {
                if ($xoopsDB->query('INSERT INTO ' . $xoopsDB->prefix('snipcats') . " (catID, name, description, weight, groupid, total) VALUES ('', '$name', '$description', '$weight', '$groupid', '0')")) {
                    redirect_header('category.php', 1, _AM_CATCREATED);
                } else {
                    redirect_header('category.php', 1, _AM_NOTUPDATED);
                }
            } else {
                if ($xoopsDB->queryF('UPDATE ' . $xoopsDB->prefix('snipcats') . " SET name = '$name', description = '$description', weight = '$weight', groupid = '$groupid' WHERE catID = '$catid'")) {
                    redirect_header('category.php', 1, _AM_CATMODIFY);
                } else {
                    redirect_header('category.php', 1, _AM_NOTUPDATED);
                }
            }
    exit();
    break;
case 'del':
        global $xoopsUser, $xoopsUser, $xoopsConfig, $xoopsDB;

        if ($confirm) {
            $xoopsDB->query('DELETE FROM ' . $xoopsDB->prefix('snipcats') . " WHERE catID = '$catid'");

            $xoopsDB->query('DELETE FROM ' . $xoopsDB->prefix('snippets') . " WHERE catID = '$catid'");

            redirect_header('category.php', 1, sprintf(_AM_CATISDELETED, $title));

            exit();
        }  
            $catid = $_POST['catid'];
            $result = $xoopsDB->query('SELECT name FROM ' . $xoopsDB->prefix('snipcats') . " WHERE catid = '$catid'");
            [$name] = $xoopsDB->fetchRow($result);

            xoops_cp_header();
            echo "<table width='100%' border='0' cellpadding = '2' cellspacing='1' class = 'confirmMsg'><tr><td class='confirmMsg'>";
            echo "<div class='confirmMsg'>";
            echo '<h4>';
            echo '' . _AM_DELETETHISCAT . "</font></h4>$name<br><br>";
            echo '<table><tr><td>';
            echo myTextForm('category.php?op=del&catid=' . $_POST['catid'] . "&confirm=1&title=$name", _AM_YES);
            echo '</td><td>';
            echo myTextForm('category.php?op=default', _AM_NO);
            echo '</td></tr></table>';
            echo '</div><br><br>';
            echo '</td></tr></table>';
            xoops_cp_footer();

    exit();
    break;
case 'default':
      default:

    xoops_cp_header();

    $modify = '0';
    $name = '';
    $description = '';

    global $xoopsUser, $xoopsUser, $xoopsConfig, $xoopsDB;
    echo '<div><h3>' . _AM_SNIPADMINCATH . '</h3></div>';

    sniplinks();

    $result = $xoopsDB->query('SELECT * FROM ' . $xoopsDB->prefix('snipcats') . '');
    $check = $xoopsDB->getRowsNum($result);

    if ($check > 0) {
        $mytree = new XoopsTree($xoopsDB->prefix('snipcats'), 'catid', '0');

        $sform = new XoopsThemeForm(_AM_MODIFYCAT, 'storyform', xoops_getenv('PHP_SELF'));

        //Modify Category

        ob_start();

        $sform->addElement(new XoopsFormHidden('catid', ''));

        $mytree->makeMySelBox('name', 'catid');

        $sform->addElement(new XoopsFormLabel(_AM_MODIFYTHISCAT, ob_get_contents()));

        ob_end_clean();

        $button_tray = new XoopsFormElementTray('', '');

        $hidden = new XoopsFormHidden('modify', 1);

        $hidden = new XoopsFormHidden('op', 'mod');

        $button_tray->addElement($hidden);

        $button_tray->addElement(new XoopsFormButton('', 'mod', _AM_MODIFY, 'submit'));

        $sform->addElement($button_tray);

        $sform->display();

        //Delete Category

        $mytree2 = new XoopsTree($xoopsDB->prefix('snipcats'), 'catid', '0');

        $dform = new XoopsThemeForm(_AM_DELCAT, 'storyform', xoops_getenv('PHP_SELF'));

        ob_start();

        $dform->addElement(new XoopsFormHidden('catid', ''));

        $mytree2->makeMySelBox('name', 'catid');

        $dform->addElement(new XoopsFormLabel(_AM_DELETETHISCAT, ob_get_contents()));

        ob_end_clean();

        $button_tray = new XoopsFormElementTray('', '');

        $hidden = new XoopsFormHidden('modify', 1);

        $hidden = new XoopsFormHidden('op', 'del');

        $button_tray->addElement($hidden);

        $button_tray->addElement(new XoopsFormButton('', 'mod', _AM_DELETE, 'submit'));

        $dform->addElement($button_tray);

        $dform->display();
    }
    editcat();
    break;
}
snipfooter();
xoops_cp_footer();
