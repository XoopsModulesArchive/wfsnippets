<?php
/*
* $Id: admin.php,v 1.1 2006/03/27 01:06:53 mikhail Exp $
* Module: WF-Snippets
* Version: v1.00
* Release Date: 15 July 2005
* Author: hsalazar, after Catzwolf
* French traduction : Solo, July 2005
* Licence: GNU
*/

//Main Admin Section

define('_AM_SnippetINTRO', 'Welcome to the WF-Snippets Control Panel');

/*
* Uni Lang defines
*/
define('_AM_CREATE', 'Créer');
define('_AM_YES', 'Oui');
define('_AM_NO', 'Non');
define('_AM_DELETE', 'Supprimer');
define('_AM_MODIFY', 'Modifier');
define('_AM_UPDATED', 'Base de donnée mise à jour');
define('_AM_NOTUPDATED', 'Une erreur s\'est produite lors de la mise à jour de la base !');
define('_AM_CATCREATED', 'Nouvelle catégorie créée et sauvegardée !');
define('_AM_CATMODIFY', 'Catégorie mise à jour et sauvegardée !');
/*
* Lang defines for functions.php
*/
define('_AM_SNIPADMINHEAD', 'Gestionnaire de Snippets');
define('_AM_SNIPADMINCATH', 'Gestionnaire de catégorie');
define('_AM_SNIPNEWCAT', 'Index des catégories');
define('_AM_SNIPNEWCATTXT', 'Créer, Modifier ou Supprimer une catégorie. Ou retourner à l\'index principal.');
define('_AM_SNIPNEWSnippet', 'Snippets Index');
define('_AM_SNIPNEWSnippetTXT', 'Créer, Modifier ou Supprimer un Snippet. Ou retourner à l\'index principal.');
define('_AM_SNIPVALIDATE', 'Valider nouvelle sousmission');
define('_AM_SNIPVALTXT', 'Permet de supprimer ou de valider les propositions de Snippets.');
/*
* Lang defines for Category.php
*/
define('_AM_SNIPRECOUNT', 'Recompter Snippets');
define('_AM_SNIPRECOUNTTXT', 'Permet de recompter le nombre de Snippets dans chaque catégorie.');
define('_AM_CREATIN', 'Créé dans');
define('_AM_CATNAME', 'Nom de la catégorie');
define('_AM_CATDESCRIPT', 'Description de la catégorie');
define('_AM_NOCATTOEDIT', 'Il n\'y a pas de catégorie à éditer.');
define('_AM_MODIFYCAT', 'Modifier Catégorie');
define('_AM_DELCAT', 'Supprimer Catégorie');
define('_AM_ADDCAT', 'Ajouter Catégorie');
define('_AM_MODIFYTHISCAT', 'Modifier cette Catégorie ?');
define('_AM_DELETETHISCAT', 'Supprimer cette Catégorie ?');
define('_AM_CATISDELETED', 'La Catégorie %s a été supprimiée');

/*
* Lang defines for topics.php
*/
define('_AM_TOPICSADMIN', 'Snippets Admin');
define('_AM_NOTCTREATEDACAT', 'Vous ne pouvez pas ajouter de Snippet avant d\'avoir créé une catégorie !');
define('_AM_ADDSnippet', 'Crée une nouvelle Snippet');
define('_AM_GROUPPROMPT', 'Autoriser l\'accès à :'); //updated 14/07/03
define('_AM_TOPICW', 'Poid :'); //updated 14/07/03
define('_AM_CREATEIN', 'Créé dans');
define('_AM_SNIPTITLE', 'Titre');
define('_AM_SNIPBODY', 'Corps');
define('_AM_SUMMARY', 'Sommaire');
define('_AM_MODIFYSNIP', 'Modifier Snippet');
define('_AM_MODIFYEXSITSNIP', 'Modifier Snippet');
define('_AM_MODIFYTHISSNIP', 'Modifier ce Snippet');
define('_AM_DELSNIP', 'Supprimer Snippet');
define('_AM_DELTHISSNIP', 'Supprimer ce Snippet');
define('_AM_NOSnippetTOEDIT', 'Pas de Snippet à modifier.');
define('_AM_DELETETHISSnippet', 'Supprimer ce Snippet ?');
define('_AM_SnippetISDELETED', 'Snippet %s supprimé');
define('_AM_SNIPCREATED', 'Snippet créé et sauvegardé');
define('_AM_SNIPNOTCREATED', 'ERREUR: Snippet ni créé, ni sauvegardé');
define('_AM_SNIPMODIFY', 'Snippet créé et sauvegardé');
define('_AM_SNIPNOTMODIFY', 'ERREUR: Snippet ni créé, ni sauvegardé');

define('_AM_SUBALLOW', 'Permettre');
define('_AM_SUBDELETE', 'Supprimer');
define('_AM_SUBRETURN', 'Retourner à l\'Admin');
define('_AM_SUBRETURNTO', 'Retourner au nouvelle soumission');
define('_AM_AUTHOR', 'Auteur');
define('_AM_PUBLISHED', 'Publié');
define('_AM_SUBPREVIEW', 'Pré-visualiser');
define('_AM_SUBADMINPREV', 'Ceci est la pré-visualisation.');
define('_AM_DBUPDATED', 'Base de donnée mise à jour.');
define('_AM_NOFAQFOESUB', 'Il n\'y a pas de nouvelle soumission'); //Updated 14/07/03
define('_AM_NEWSUBMISSION', 'Nouvelle soumission'); //Updated 14/07/03

/*
*  Copyright and Support.  Please do not remove this line as this is part of the only copyright agreement for using WF-Snippets
*/
define('_AM_VISITSUPPORT', 'Visit the WF-Section website for information, updates and help on its usage.<br> WF-Snippets v1 Hsalazar/Catzwolf &copy; 2005 <a href="http://wfsections.xoops2.com/" target="_blank">WF-Snippets</a>');
