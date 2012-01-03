<?php
/**
 * Quotes version infomation
 *
 * This file holds the configuration information of this module
 *
 * @copyright	Copyright Madfish (Simon Wilkinson) 2011
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * @since		1.0
 * @author		Madfish (Simon Wilkinson) <simon@isengard.biz>
 * @package		quotes
 * @version		$Id$
 */

defined("ICMS_ROOT_PATH") or die("ICMS root path not defined");

/**  General Information  */
$modversion = array(
	"name"						=> _MI_QUOTES_MD_NAME,
	"version"					=> 1.0,
	"description"				=> _MI_QUOTES_MD_DESC,
	"author"					=> "Madfish (Simon Wilkinson)",
	"credits"					=> "",
	"help"						=> "",
	"license"					=> "GNU General Public License (GPL)",
	"official"					=> 0,
	"dirname"					=> basename(dirname(__FILE__)),
	"modname"					=> "quotes",

/**  Images information  */
	"iconsmall"					=> "images/icon_small.png",
	"iconbig"					=> "images/icon_big.png",
	"image"						=> "images/icon_big.png", /* for backward compatibility */

/**  Development information */
	"status_version"			=> "1.0",
	"status"					=> "Final",
	"date"						=> "9/9/2011",
	"author_word"				=> "Use it wisely.",

/** Contributors */
	"developer_website_url"		=> "https://www.isengard.biz",
	"developer_website_name"	=> "Isengard.biz",
	"developer_email"			=> "simon@isengard.biz",

/** Administrative information */
	"hasAdmin"					=> 1,
	"adminindex"				=> "admin/index.php",
	"adminmenu"					=> "admin/menu.php",

/** Install and update informations */
	"onInstall"					=> "include/onupdate.inc.php",
	"onUpdate"					=> "include/onupdate.inc.php",

/** Search information */
	"hasSearch"					=> 0,

/** Menu information */
	"hasMain"					=> 0,

/** Comments information */
	"hasComments"				=> 0);

/** other possible types: testers, translators, documenters and other */
$modversion['people']['developers'][] = "Madfish (Simon Wilkinson)";

/** Manual */
$modversion['manual']['wiki'][] = "<a href='http://wiki.impresscms.org/index.php?title=Quotes' target='_blank'>English</a>";

/** Database information */
$modversion['object_items'][1] = 'quote';

$modversion["tables"] = icms_getTablesArray($modversion['dirname'], $modversion['object_items']);

/** Templates information */
$modversion['templates'] = array(
	array("file" => "quotes_admin_quote.html", "description" => "Quote admin index."), 
	array("file" => "quotes_requirements.html", "description" => "Display missing requirements."));

/** Blocks information */
$modversion['blocks'][1] = array(
	"file"						=> "quotes_random_quotes.php",
	"name"						=> _MI_QUOTES_RANDOM_QUOTES,
	"description"				=> _MI_QUOTES_RANDOM_QUOTESDSC,
	"show_func"					=> "quotes_random_quotes_show",
	"edit_func"					=> "quotes_random_quotes_edit",
	"options"					=> "0",
	"template"					=> "quotes_random_quotes.html");