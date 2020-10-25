<?php
/*
* $Id: admin.php,v 1.1 2006/03/27 01:06:51 mikhail Exp $
* Module: WF-Snippets
* Version: v1.00
* Release Date: 15 July 2005
* Author: hsalazar, after Catzwolf
* Licence: GNU
*/

//Main Admin Section

define('_AM_SNIPPETINTRO', 'Welcome to the WF-Snippets Control Panel');

/*
* Uni Lang defines
*/
define('_AM_CREATE', 'Create');
define('_AM_YES', 'Yes');
define('_AM_NO', 'No');
define('_AM_DELETE', 'Delete');
define('_AM_MODIFY', 'Modify');
define('_AM_UPDATED', 'Database has been updated');
define('_AM_NOTUPDATED', 'There was an error updating the database!');
define('_AM_CATCREATED', 'New Category was created and saved!');
define('_AM_CATMODIFY', 'Category was modified and saved!');
/*
* Lang defines for functions.php
*/
define('_AM_SNIPADMINHEAD', 'Snippets Management');
define('_AM_SNIPADMINCATH', 'Snippets Category Management');
define('_AM_SNIPNEWCAT', 'Snippets Category Index');
define('_AM_SNIPNEWCATTXT', 'Create, Modify or Delete a Snippet Category. Or Return to main Snippet Category Index.');
define('_AM_SNIPNEWSNIPPET', 'Snippets Index');
define('_AM_SNIPNEWSNIPPETTXT', 'Create, Modify or Delete a Snippet. Or Return to main Snippet Index.');
define('_AM_SNIPVALIDATE', 'Validate new submissions');
define('_AM_SNIPVALTXT', 'Allows you to delete or validate new snippets submitted.');
/*
* Lang defines for Category.php
*/
define('_AM_SNIPRECOUNT', 'Recount Snippets');
define('_AM_SNIPRECOUNTTXT', 'Allows you to recount the number of snippets in each category.');
define('_AM_CREATIN', 'Create in');
define('_AM_CATNAME', 'Category Name');
define('_AM_CATDESCRIPT', 'Category Description');
define('_AM_NOCATTOEDIT', 'There is no category to edit.');
define('_AM_MODIFYCAT', 'Modify Category');
define('_AM_DELCAT', 'Delete Category');
define('_AM_ADDCAT', 'ADD Category');
define('_AM_MODIFYTHISCAT', 'Modify this Category?');
define('_AM_DELETETHISCAT', 'Delete this Category?');
define('_AM_CATISDELETED', 'Category %s has been deleted');

/*
* Lang defines for topics.php
*/
define('_AM_TOPICSADMIN', 'Snippets Admin');
define('_AM_NOTCTREATEDACAT', 'You cannot add a snippet until you create a snippet Category!');
define('_AM_ADDSNIPPET', 'Create new snippet');
define('_AM_GROUPPROMPT', 'Allow Access To:'); //updated 14/07/03
define('_AM_TOPICW', 'Weight:'); //updated 14/07/03
define('_AM_CREATEIN', 'Create in');
define('_AM_SNIPTITLE', 'Title');
define('_AM_SNIPBODY', 'Body');
define('_AM_SUMMARY', 'Summary');
define('_AM_MODIFYSNIP', 'Modify Snippet');
define('_AM_MODIFYEXSITSNIP', 'Modify Snippet');
define('_AM_MODIFYTHISSNIP', 'Modify this Snippet');
define('_AM_DELSNIP', 'Delete Snippet');
define('_AM_DELTHISSNIP', 'Delete this Snippet');
define('_AM_NOSNIPPETTOEDIT', 'No snippet in database to modify');
define('_AM_DELETETHISSNIPPET', 'Delete this Snippet?');
define('_AM_SNIPPETISDELETED', 'Snippet %s has been deleted');
define('_AM_SNIPCREATED', 'Snippet was created and saved');
define('_AM_SNIPNOTCREATED', 'ERROR: Snippet was NOT created and saved');
define('_AM_SNIPMODIFY', 'Snippet was modified and saved');
define('_AM_SNIPNOTMODIFY', 'ERROR: Snippet was NOT modified and saved');

define('_AM_SUBALLOW', 'Allow');
define('_AM_SUBDELETE', 'Delete');
define('_AM_SUBRETURN', 'Return to Admin');
define('_AM_SUBRETURNTO', 'Return To New Submissions');
define('_AM_AUTHOR', 'Author');
define('_AM_PUBLISHED', 'Published');
define('_AM_SUBPREVIEW', 'The Snippets Admin view');
define('_AM_SUBADMINPREV', 'This is the admin preview of this snippet.');
define('_AM_DBUPDATED', 'Snippet database has been updated');
define('_AM_NOFAQFOESUB', 'There are no new Snippets for validation'); //Updated 14/07/03
define('_AM_NEWSUBMISSION', 'New Submissions'); //Updated 14/07/03

/*
*  Copyright and Support.  Please do not remove this line as this is part of the only copyright agreement for using WF-Snippets
*/
define('_AM_VISITSUPPORT', 'Visit the WF-Section website for information, updates and help on its usage.<br> WF-Snippets v1 Hsalazar/Catzwolf &copy; 2005 <a href="http://wfsections.xoops2.com/" target="_blank">WF-Snippets</a>');
