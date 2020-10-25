<?php
/*
* $Id: index.php,v 1.1 2006/03/27 01:06:49 mikhail Exp $
* Module: WF-Snippets
* Version: v1.00
* Release Date: 12 July 2005
* Author: hsalazar, after Catzwolf
* Licence: GNU
*/

include '../../mainfile.php';
require XOOPS_ROOT_PATH . '/header.php';
require XOOPS_ROOT_PATH . '/modules/wfsnippets/include/functions.php';
require_once XOOPS_ROOT_PATH . '/modules/wfsnippets/include/groupaccess.php';

$myts = MyTextSanitizer::getInstance();

global $xoopsUser, $xoopsDB, $xoopsConfig;

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

$PHP_SELF = $_SERVER['PHP_SELF'];

switch ($op) {
    case 'cat':
        $GLOBALS['xoopsOption']['template_main'] = 'snippets_category.html';
        $sql = $xoopsDB->query('SELECT * FROM ' . $xoopsDB->prefix('snipcats') . " WHERE catID = $c ");
        $cat_info = $xoopsDB->fetchArray($sql);
        $result = $xoopsDB->query('SELECT * FROM ' . $xoopsDB->prefix('snippets') . " WHERE catID = '$c' and submit ='1' ORDER BY snippetID");
        $totalcat = $xoopsDB->getRowsNum($sql);
        $totaltopics = $xoopsDB->getRowsNum($result);

        $category = [];
        $topics = [];

        if (0 == $totalcat) {
            redirect_header('javascript:history.go(-1)', 1, _MD_MAINNOSELECTCAT);

            exit();
        }
        if (0 == $totaltopics) {
            redirect_header('javascript:history.go(-1)', 1, _MD_MAINNOTOPICS);

            exit();
        }
        $category['catid'] = $cat_info['catID'];
        $category['name'] = $cat_info['name'];
        $category['catlink'] = "[ <a href='javascript:history.go(-1)'>" . _MD_RETURN . "</a><b> | </b><a href='./index.php'>" . _MD_RETURN2INDEX . '</a> ]';
        $category['description'] = $cat_info['description'];
        //$category['cjump'] = generatecjump();

        while (false !== ($cat_data = $xoopsDB->fetchArray($result))) {
            if (checkAccess($cat_data['groupid'])) {
                $topics['summary'] = $cat_data['summary'];

                $topics['title'] = $cat_data['title'];

                $topics['datesub'] = formatTimestamp($cat_data['datesub'], 'D, d-M-Y');

                $topics['snippetID'] = $cat_data['snippetID'];

                if ($cat_data['uid']) {
                    $thisUser = new XoopsUser($cat_data['uid']);

                    $thisUser->getVar('uname');

                    $thisUser->getVar('uid');

                    $topics['poster'] = "<a href='" . XOOPS_URL . '/userinfo.php?uid=' . $thisUser->uid() . "'>" . $thisUser->uname() . '</a>'; //$thisUser->getVar("uname");
                } else {
                    $topics['poster'] = 'Guest';
                }

                $topics['counter'] = $cat_data['counter'];

                $xoopsTpl->append('topics', ['id' => $cat_data['snippetID'], 'title' => $topics['title'], 'summary' => $topics['summary'], 'poster' => $topics['poster'], 'datesub' => $topics['datesub'], 'counter' => $topics['counter'] ]);
            }
        }
        $xoopsTpl->assign(['lang_categorytag' => _MD_CATEGORY, 'lang_topicsindex' => _MD_MAINPTOPICSINDEX, 'lang_title' => _MD_MAINPTITLE, 'lang_summary' => _MD_MAINPSUMMARY, 'lang_author' => _MD_MAINPAUTHOR, 'lang_submitted' => _MD_MAINPSUBMITTED, 'lang_hits' => _MD_MAINPHITS]);
        $xoopsTpl->assign('category', $category);
        $data = '';
        break;
    case 'view':
        $GLOBALS['xoopsOption']['template_main'] = 'snippets_body.html';

        global $xoopsUser, $xoopsDB, $myts;
        /*
        * Myts must be declared before its use, normally right at the start of the page (see above) and set it global
        *
        * I have set the next few lines for html, smiley and xcodes for the Body use 1 or 0 to switch between on and off
        */
        $html = 1;
        $smiley = 1;
        $xcodes = 1;

        $snippetsa = [];
        $xoopsDB->queryF('UPDATE ' . $xoopsDB->prefix('snippets') . " SET counter=counter+1 WHERE snippetID = '$t' ");
        $result = $xoopsDB->queryF('SELECT * FROM ' . $xoopsDB->prefix('snippets') . " WHERE snippetID = '$t' and submit = '1' order by datesub");
           [$snippetID, $catID, $title, $body, $summary, $uid, $submit, $datesub, $counter, $weight, $groupid, $rating, $votes] = $xoopsDB->fetchRow($result);

        $result2 = $xoopsDB->query('SELECT name FROM ' . $xoopsDB->prefix('snipcats') . " WHERE catID = '$catID'");
        [$cat] = $xoopsDB->fetchRow($result2);
        /*
        * This line filters $body throu $myts and this is why Xoops shows html, smilies and xcode
        */
        $body = $myts->displayTarea($body, $html, $smiley, $xcodes);
        $snippetsa['body'] = $body;
        $snippetsa['datesub'] = formatTimestamp($datesub, 'D, d-M-Y, H:i');
        $snippetsa['counter'] = $counter;
        $title = htmlspecialchars($title, $smiley);
        $snippetsa['title'] = $title;
        if ($xoopsUser && $xoopsUser->isAdmin($xoopsModule->mid())) {
            $snippetsa['adminlink'] = " [ <a href='" . XOOPS_URL . '/modules/wfsnippets/admin/index.php?op=edit&amp;snippetID=' . $t . "'>" . _EDIT . "</a> | <a href='" . XOOPS_URL . '/modules/wfsnippets/admin/index.php?op=del&amp;t=' . $t . "&amp;subm=1'>" . _DELETE . '</a> ] ';
        }
        $snippetsa['ratesnippet'] = "<a href='ratefile.php?lid=" . $t . "'>" . _MD_RATETHISSNIP . '</a>';
        $snippetsa['ratesnippet'] = "<a href='ratefile.php?lid=" . $t . "'>" . _MD_RATETHISSNIP . '</a>';
        $snippetsa['rating'] = '<b>' . sprintf(_MD_RATINGA, number_format($rating, 2)) . '</b>';
        $snippetsa['votes'] = '<b>(' . sprintf(_MD_NUMVOTES, $votes) . ')</b>';
        //$faqsa['printer'] = "index.php?op=print&t=".$t;
        //$faqsa['cjump'] = generatecjump();
        $snippetsa['catlink'] = "[ <a href='javascript:history.go(-1)'>" . _MD_BACK2CAT . "</a><b> | </b><a href='./index.php'>" . _MD_RETURN2INDEX . '</a> ]';

        if (0 == $uid) {
            $snippetsa['poster'] = 'Guest';
        } else {
            $thisUser = new XoopsUser($uid);

            $thisUser->getVar('uname');

            $thisUser->getVar('uid');

            $snippetsa['poster'] = "<a href='" . XOOPS_URL . '/userinfo.php?uid=' . $thisUser->uid() . "'>" . $thisUser->uname() . '</a>';
        }

        $xoopsTpl->assign('snippetpage', $snippetsa);
        $xoopsTpl->assign(['lang_snip' => _MD_SNIP, 'lang_publish' => _MD_PUBLISH, 'lang_posted' => _MD_POSTED, 'lang_read' => _MD_READ, 'lang_times' => _MD_TIMES, 'lang_articleheading' => '<h4>' . $title . '</h4>']);

        require XOOPS_ROOT_PATH . '/include/comment_view.php';
    break;
    case 'default':
      default:

        global $xoopsUser, $xoopsConfig, $xoopsDB;

        $index = [];

        $GLOBALS['xoopsOption']['template_main'] = 'snippets_index.html';
        $result = $xoopsDB->query('SELECT * FROM ' . $xoopsDB->prefix('snipcats') . ' ORDER BY name');
        $total = $xoopsDB->getRowsNum($result);
        if (0 == $total) {
            redirect_header('javascript:history.go(-1)', 1, _MD_MAINNOCATADDED);

            exit();
        }
        while (false !== ($query_data = $xoopsDB->fetchArray($result))) {
            if (checkAccess($query_data['groupid'])) {
                $query_data['name'] = $query_data['name'];

                $total = countByCategory($query_data['catID']);

                $xoopsTpl->append('indexpage', ['id' => $query_data['catID'], 'description' => $query_data['description'], 'category' => $query_data['name'], 'total' => $total]);
            }
        }
        $xoopsTpl->assign(['lang_category' => _MD_MAININDEXCAT, 'lang_description' => _MD_MAININDEXDESC, 'lang_total' => _MD_MAININDEXTOTAL, 'lang_indextext' => _MD_MAININDEX, 'lang_articleheading' => '<h4>' . sprintf(_MD_WELCOMETOSEC, _MD_CAPTION, $xoopsConfig['sitename']) . '</h4>']);
}

require XOOPS_ROOT_PATH . '/footer.php';
