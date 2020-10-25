<?php
/*
* $Id: admin.php v 1.0 15 July 2005 Catwolf Exp $
* Module: WF-Snippets
* Version: v1.00
* Release Date: 15 July 2005
* Author: hsalazar, after Catzwolf
* Licence: GNU
*/
//Main Admin Section
define('_AM_SNIPPETINTRO', 'Willkommen zur WF-Snippets Administrationsseite');
/*
* Uni Lang defines
*/
define('_AM_CREATE', 'Erstellen');
define('_AM_YES', 'Ja');
define('_AM_NO', 'Nein');
define('_AM_DELETE', 'L&ouml;schen');
define('_AM_MODIFY', '&Auml;ndern');
define('_AM_UPDATED', 'Die Datenbank wurde erfolgreich aktualisiert');
define('_AM_NOTUPDATED', 'Es ist ein Fehler beim Aktualisieren der Datenbank aufgetreten!');
define('_AM_CATCREATED', 'Die neue Kategoreie wurde erstellt und gespeichert!');
define('_AM_CATMODIFY', 'Die Kategorie wurde ge&auml;ndert und gespeichert!');
/*
* Lang defines for functions.php
*/
define('_AM_SNIPADMINHEAD', 'Snippets Management');
define('_AM_SNIPADMINCATH', 'Snippets Kategoriemanagement');
define('_AM_SNIPNEWCAT', 'Snippets Kategorie&uuml;bersicht');
define('_AM_SNIPNEWCATTXT', 'Erstellen, &Auml;ndern oder L&ouml;schen einer Snippet Kategorie. Oder zur&uuml;ck zur Snippet Kategorie&uuml;bersicht.');
define('_AM_SNIPNEWSNIPPET', 'Snippets &Uuml;bersicht');
define('_AM_SNIPNEWSNIPPETTXT', 'Erstellen, &Auml;ndern oder L&ouml;schen eines Snippets. Oder zur&uuml;ck zur Snippet Haupt&uuml;bersicht.');
define('_AM_SNIPVALIDATE', 'Neue Einsendungen freigeben');
define('_AM_SNIPVALTXT', 'Erlaubt dir das L&ouml;schen oder Freigeben von neu eingeschickten Snippets.');
/*
* Lang defines for Category.php
*/
define('_AM_SNIPRECOUNT', 'Snippets neu z&auml;hlen');
define('_AM_SNIPRECOUNTTXT', 'Erlaubt dir die Anzahl der Snippets in jeder Kategorie neu zu z&auml;hlen.');
define('_AM_CREATIN', 'Erstellen in');
define('_AM_CATNAME', 'Kategoriename');
define('_AM_CATDESCRIPT', 'Kategoriebeschreibung');
define('_AM_NOCATTOEDIT', 'Es liegt keine Kategorie zum Bearbeiten vor.');
define('_AM_MODIFYCAT', 'Kategorie &auml;ndern');
define('_AM_DELCAT', 'Kategorie l&ouml;schen');
define('_AM_ADDCAT', 'Kategorie hinzuf&uuml;gen');
define('_AM_MODIFYTHISCAT', 'Diese Kategorie &auml;ndern?');
define('_AM_DELETETHISCAT', 'Diese Kategorie l&ouml;schen?');
define('_AM_CATISDELETED', 'Kategorie %s wurde gel&ouml;scht');
/*
* Lang defines for topics.php
*/
define('_AM_TOPICSADMIN', 'Snippets Administration');
define('_AM_NOTCTREATEDACAT', 'Snippets k&ouml;nnen erst hinzugef&uuml;gt werden, wenn bereits Kategorien vorliegen!');
define('_AM_ADDSNIPPET', 'Neues Snippet erstellen');
define('_AM_GROUPPROMPT', 'Zugriff f&uuml;r:'); //updated 14/07/03
define('_AM_TOPICW', 'Gewichtung:'); //updated 14/07/03
define('_AM_CREATEIN', 'Erstellen in');
define('_AM_SNIPTITLE', 'Titel');
define('_AM_SNIPBODY', 'Inhalt');
define('_AM_SUMMARY', 'Zusammenfassung');
define('_AM_MODIFYSNIP', 'Snippet &auml;ndern');
define('_AM_MODIFYEXSITSNIP', 'Snippet &auml;ndern');
define('_AM_MODIFYTHISSNIP', 'Dieses Snippet &auml;ndern');
define('_AM_DELSNIP', 'Snippet l&ouml;schen');
define('_AM_DELTHISSNIP', 'Dieses Snippet l&ouml;schen');
define('_AM_NOSNIPPETTOEDIT', 'Es liegt kein Snippet zum &Auml;ndern in der Datenbank vor');
define('_AM_DELETETHISSNIPPET', 'Dieses Snippet l&ouml;schen?');
define('_AM_SNIPPETISDELETED', 'Snippet %s wurde gel&ouml;scht');
define('_AM_SNIPCREATED', 'Snippet wurde erstellt und gespeichert');
define('_AM_SNIPNOTCREATED', 'FEHLER: Snippet wurde NICHT erstellt und gespeichert');
define('_AM_SNIPMODIFY', 'Snippet wurde ge&auml;ndert und gespeichert');
define('_AM_SNIPNOTMODIFY', 'FEHLER: Snippet wurde NICHT ge&auml;ndert und gespeichert');
define('_AM_SUBALLOW', 'Erlauben');
define('_AM_SUBDELETE', 'L&ouml;schen');
define('_AM_SUBRETURN', 'Zur&uuml;ck zur Administration');
define('_AM_SUBRETURNTO', 'Zur&uuml;ck zu Neue Einsendungen');
define('_AM_AUTHOR', 'Autor');
define('_AM_PUBLISHED', 'Ver&ouml;ffentlicht');
define('_AM_SUBPREVIEW', 'Die Snippets Administratoransichtw');
define('_AM_SUBADMINPREV', 'Dies ist die Administratorvorschau dieses Snippets.');
define('_AM_DBUPDATED', 'Snippet-Datenbank wurde erfolgreich aktualisiert');
define('_AM_NOFAQFOESUB', 'Es liegen keine neuen Snippets zur Freigabe vor'); //Updated 14/07/03
define('_AM_NEWSUBMISSION', 'Neue Einsendungen'); //Updated 14/07/03
/*
* Copyright and Support. Please do not remove this line as this is part of the only copyright agreement for using WF-Snippets
*/
define('_AM_VISITSUPPORT', 'F&uuml;r weitere Informationen besuchen Sie bitte die WF-Section Website.<br> WF-Snippets v1 Hsalazar/Catzwolf &copy; 2005 <a href="http://wfsections.xoops2.com/" target="_blank">WF-Snippets</a>');
