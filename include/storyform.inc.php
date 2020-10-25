<?php
/*
* $Id: storyform.inc.php,v 1.1 2006/03/27 01:06:50 mikhail Exp $
* Module: WF-Snippets
* Version: v1.00
* Release Date: 12 July 2005
* Author: hsalazar, after Catzwolf
* Licence: GNU
*/

require XOOPS_ROOT_PATH . '/class/xoopstree.php';
require XOOPS_ROOT_PATH . '/class/xoopslists.php';
require XOOPS_ROOT_PATH . '/class/xoopsformloader.php';

        $mytree = new XoopsTree($xoopsDB->prefix('snipcats'), 'catID', '0');
        $sform = new XoopsThemeForm(_MI_SNIPSUB_SMNAME1, 'storyform', xoops_getenv('PHP_SELF'));

        ob_start();
        $sform->addElement(new XoopsFormHidden('catID', $catID));
        $mytree->makeMySelBox('name', 'catID');
        $sform->addElement(new XoopsFormLabel(_MD_CREATIN, ob_get_contents()));
        ob_end_clean();

        $sform->addElement(new XoopsFormText(_MD_SNIPTITLE, 'title', 50, 80, $title), true);
        $sform->addElement(new XoopsFormDhtmlTextArea(_MD_SNIPBODY, 'body', $body, 15, 60), true);
        $sform->addElement(new XoopsFormDhtmlTextArea(_MD_SNIPSUM, 'summary', $summary, 7, 60));
        $option_tray = new XoopsFormElementTray(_OPTIONS, '<br>');

if ($xoopsUser) {
    if (1 == $wfsConfig['anonpost']) {
        $noname_checkbox = new XoopsFormCheckBox('', 'noname', $noname);

        $noname_checkbox->addOption(1, _POSTANON);

        $option_tray->addElement($noname_checkbox);
    }

    $notify_checkbox = new XoopsFormCheckBox('', 'notifypub', $notifypub);

    $notify_checkbox->addOption(1, 'Notify on Publish');

    $option_tray->addElement($notify_checkbox);

    if ($xoopsUser->isAdmin($xoopsModule->getVar('mid'))) {
        $nohtml_checkbox = new XoopsFormCheckBox('', 'nohtml', $nohtml);

        $nohtml_checkbox->addOption(1, _DISABLEHTML);

        $option_tray->addElement($nohtml_checkbox);
    }
}

$smiley_checkbox = new XoopsFormCheckBox('', 'nosmiley', $nosmiley);
$smiley_checkbox->addOption(1, _DISABLESMILEY);
$option_tray->addElement($smiley_checkbox);
$sform->addElement($option_tray);
$button_tray = new XoopsFormElementTray('', '');
$button_tray->addElement(new XoopsFormButton('', 'post', _MD_SUBMIT, 'submit'));
$sform->addElement($button_tray);
$sform->display();
