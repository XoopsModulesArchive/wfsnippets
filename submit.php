<?php
/*
* $Id: submit.php,v 1.1 2006/03/27 01:06:49 mikhail Exp $
* Module: WF-Snippets
* Version: v1.00
* Release Date: 15 July 2005
* Author: hsalazar, after Catzwolf
* Licence: GNU
*/

include '../../mainfile.php';
require XOOPS_ROOT_PATH . '/header.php';

global $xoopsUser, $xoopsUser, $xoopsConfig;

if (!is_object($xoopsUser)) {
    redirect_header('index.php', 1, _NOPERM);

    exit();
}

global $wfsConfig;
foreach ($_POST as $k => $v) {
    ${$k} = $v;
}

foreach ($_GET as $k => $v) {
    ${$k} = $v;
}

$op = 'form';

if (isset($_POST['post'])) {
    $op = 'post';
} elseif (isset($_POST['edit'])) {
    $op = 'edit';
}

switch ($op) {
    case 'post':
        $myts = MyTextSanitizer::getInstance(); // MyTextSanitizer object
        global $xoopsUser, $xoopsConfig;

        if (is_object($xoopsUser)) {
            $uid = $xoopsUser->uid();
        } else {
            $uid = 0;
        }
        if ((int)$_POST['catid']) {
        } else {
            echo (int)$_POST['catid'];
        }

        $cat = $myts->addSlashes($_POST['catID']);
        $title = $myts->addSlashes($_POST['title']);
        $body = $myts->addSlashes($_POST['body']);
        $summary = $myts->addSlashes($_POST['summary']);
        $uid = $xoopsUser->uid();
        $datesub = time();
        $submit = 0;

        $result = $xoopsDB->queryF('INSERT INTO ' . $xoopsDB->prefix('snippets') . " (catID, title, body, summary, uid, datesub, submit) VALUES ('$cat', '$title', '$body', '$summary', '$uid', '$datesub', '$submit')");

        if ($result) {
            $xoopsMailer = getMailer();

            $xoopsMailer->useMail();

            $xoopsMailer->setToEmails($xoopsConfig['adminmail']);

            $xoopsMailer->setFromEmail($xoopsConfig['adminmail']);

            $xoopsMailer->setFromName($xoopsConfig['sitename']);

            $xoopsMailer->setSubject(_MD_NOTIFYSBJCT);

            $body = _MD_NOTIFYMSG;

            $body .= "\n\n" . _MD_TITLE . ': ' . $title;

            $body .= "\n" . _MD_POSTEDBY . ': ' . XoopsUser::getUnameFromId($uid);

            $body .= "\n" . _MD_DATE . ': ' . formatTimestamp(time(), 'm', $xoopsConfig['default_TZ']);

            $body .= "\n\n" . XOOPS_URL . '/modules/snippets/admin/submissions.php?op=allow&t=$snippetID&c=$catID';

            $xoopsMailer->setBody($body);

            $xoopsMailer->send();
        } else {
            redirect_header('submit.php', 2, _MD_ERRORSAVINGDB);
        }

        redirect_header('index.php', 2, _MD_SUBMITUSER);
        exit();
        break;
    case 'form':
    default:
            require XOOPS_ROOT_PATH . '/header.php';
            $result = $xoopsDB->query('SELECT catID, name FROM ' . $xoopsDB->prefix('snipcats') . ' ORDER BY name');
            $options = '';
                while (false !== ($query_data = $GLOBALS['xoopsDB']->fetchBoth($result, MYSQL_ASSOC))) {
                    $options .= '<option value="' . $query_data['catID'] . '">' . $query_data['name'] . '</option>';
                }

            $title = '';
            $body = '';
            $summary = '';
            $catid = 1;
            //$uid = 0;
            $noname = 0;
            $nohtml = 0;
            $nosmiley = 0;
            $notifypub = 1;
            require __DIR__ . '/include/storyform.inc.php';
            require XOOPS_ROOT_PATH . '/footer.php';
            break;
    }
