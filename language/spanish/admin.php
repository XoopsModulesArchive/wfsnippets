<?php
/*
* $Id: admin.php,v 1.1 2006/03/27 01:06:52 mikhail Exp $
* Module: Snippets
* Version: v1.03
* Release Date: 12 Sept 2005
* Author: hsalazar, after Catzwolf
* Licence: GNU
*/

//Main Admin Section

define('_AM_FAQMANINTRO', 'Bienvenido a la mesa de control de Snippets');

/*
* Uni Lang defines
*/
define('_AM_CREATE', 'Crear');
define('_AM_YES', 'Sí');
define('_AM_NO', 'No');
define('_AM_DELETE', 'Borrar');
define('_AM_MODIFY', 'Modificar');
define('_AM_UPDATED', '¡La base de datos se actualizó correctamente!');
define('_AM_NOTUPDATED', '¡Hubo un error al actualizar la base de datos!');
define('_AM_CATCREATED', '¡La nueva categoría fue creada y salvada!');
define('_AM_CATMODIFY', '¡La categoría fue modificada y salvada!');
/*
* Lang defines for functions.php
*/
define('_AM_SNIPADMINHEAD', 'Manejo de snippets');
define('_AM_SNIPADMINCATH', 'Manejo de categorías de snippets');
define('_AM_SNIPNEWCAT', 'Índice de categorías de los snippets');
define('_AM_SNIPNEWCATTXT', 'Crear, editar o borrar una categoría de snippets. O volver al Índice de categorías de snippets.');
define('_AM_SNIPNEWSNIPPET', 'Índice de snippets');
define('_AM_SNIPNEWSNIPPETTXT', 'Crear, editar o borrar un snippet. O volver al Índice de snippets.');
define('_AM_SNIPVALIDATE', 'Autorizar nuevos envíos');
define('_AM_SNIPVALTXT', 'Te permite borrar o autorizar los nuevos snippets enviados.');
/*
* Lang defines for Category.php
*/
define('_AM_SNIPRECOUNT', 'Contar otra vez los snippets');
define('_AM_SNIPRECOUNTTXT', 'Te permite recontar el número de snippets en cada categoría.');
define('_AM_CREATIN', 'Crear en');
define('_AM_CATNAME', 'Nombre de categoría');
define('_AM_CATDESCRIPT', 'Descripción de categoría');
define('_AM_NOCATTOEDIT', 'No hay categoría qué editar.');
define('_AM_MODIFYCAT', 'Modificar categoría');
define('_AM_DELCAT', 'Borrar categoría');
define('_AM_ADDCAT', 'Agregar categoría');
define('_AM_MODIFYTHISCAT', '¿Modificar esta categoría?');
define('_AM_DELETETHISCAT', '¿Borrar esta categoría?');
define('_AM_CATISDELETED', 'La categoría %s ha sido borrada');

/*
* Lang defines for topics.php
*/
define('_AM_TOPICSADMIN', 'Manejo de snippets');
define('_AM_NOTCTREATEDACAT', '¡No puedes agregar un snippet si no creas antes una categoría de snippets!');
define('_AM_ADDSNIPPET', 'Crear nuevo snippet');
define('_AM_CREATEIN', 'Crear en');
define('_AM_SNIPTITLE', 'Título');
define('_AM_SNIPBODY', 'Cuerpo');
define('_AM_SUMMARY', 'Sumario');
define('_AM_MODIFYSNIP', 'Editar snippet');
define('_AM_MODIFYEXSITSNIP', 'Editar snippet');
define('_AM_MODIFYTHISSNIP', 'Editar este snippet');
define('_AM_DELSNIP', 'Borrar snippet');
define('_AM_DELTHISSNIP', 'Borrar este snippet');
define('_AM_NOSNIPPETTOEDIT', 'No hay snippets qué editar en la base de datos');
define('_AM_DELETETHISSNIPPET', '¿Borrar este snippet?');
define('_AM_SNIPPETISDELETED', 'El snippet %s ha sido borrado');
define('_AM_SNIPCREATED', 'El snippet fue creado y salvado');
define('_AM_SNIPNOTCREATED', 'ERROR: El snippet NO se creó ni salvó');
define('_AM_SNIPMODIFY', 'El snippet fue modificado y salvado');
define('_AM_SNIPNOTMODIFY', 'ERROR: El snippet NO se editó ni salvó');

define('_AM_SUBALLOW', 'Permitir');
define('_AM_SUBDELETE', 'Borrar');
define('_AM_SUBRETURN', 'Volver a mesa de control');
define('_AM_SUBRETURNTO', 'Volver a nuevos envíos');
define('_AM_AUTHOR', 'Autor');
define('_AM_PUBLISHED', 'Publicación');
define('_AM_SUBPREVIEW', 'La vista de control de Snippets');
define('_AM_SUBADMINPREV', 'Esta es la vista previa de control de este snippet.');
define('_AM_DBUPDATED', 'La base de datos que contiene los snippets ha sido actualizada');
/*
*  Copyright and Support.  Please do not remove this line as this is part of the only copyright agreement for using WF-FAQ
*/
define('_AM_VISITSUPPORT', 'Visita el sitio web de WF-Section para información, actualización y ayuda sobre su uso.<br> WF-FAQ v1 Catzwolf &copy; 2005 <a href="http://wfsections.xoops2.com/" target="_blank">WF-FAQ</a>');
