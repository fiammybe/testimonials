<?php
/**
 * Testimonials version infomation
 *
 * This file holds the configuration information of this module
 *
 * @copyright	Copyright Madfish (Simon Wilkinson) 2011
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * @since		1.0
 * @author		Madfish (Simon Wilkinson) <simon@isengard.biz>
 * @package		testimonials
 * @version		$Id$
 */

defined("ICMS_ROOT_PATH") or die("ICMS root path not defined");

/**  General Information  */
$modversion = array(
	"name"						=> "Testimonials",
	"version"					=> "1.1",
	"description"				=> _MI_TESTIMONIALS_MD_DESC,
	"author"					=> "fiammybe (David Janssens)",
	"credits"					=> "Thanks to Debianus for the testimonial rotator block and Madfish for the initial testimonial module",
	"help"						=> "",
	"license"					=> "GNU General Public License (GPL)",
	"official"					=> 0,
	"dirname"					=> basename(dirname(__FILE__)),
	"modname"					=> "testimonials",

/**  Images information  */
	"iconsmall"					=> "images/icon_small.png",
	"iconbig"					=> "images/icon_big.png",
	"image"						=> "images/icon_big.png", /* for backward compatibility */

/**  Development information */
	"status_version"			=> "1.1",
	"status"					=> "Beta",
	"date"						=> "30 Nov 2024",
	"author_word"				=> "Use it wisely.",

/** Contributors */
	"developer_website_url"		=> "https://www.github.com/fiammybe/testimonials",
	"developer_website_name"	=> "Github",
	"developer_email"			=> "david.j@impresscms.org",

/** Administrative information */
	"hasAdmin"					=> 1,
	"adminindex"				=> "admin/index.php",
	"adminmenu"					=> "admin/menu.php",

/** Install and update informations */
	"onInstall"					=> "include/oninstall.inc.php",
	"onUpdate"					=> "include/onupdate.inc.php",

/** Search information */
	"hasSearch"					=> 0,

/** Menu information */
	"hasMain"					=> 0,

/** Comments information */
	"hasComments"				=> 0);

/** other possible types: testers, translators, documenters and other */
$modversion['people']['developers'][] = "fiammybe (David Janssens)";

/** Manual */
$modversion['manual']['wiki'][] = "<a href='https://github.com/fiammybe/testimonials/blob/master/docs/changelog.txt'>Documentation</a>";

/** Database information */
$modversion['object_items'][1] = 'testimonial';

$modversion["tables"] = icms_getTablesArray($modversion['dirname'], $modversion['object_items']);

/** Templates information */
$modversion['templates'] = array(
	array("file" => "testimonials_admin_testimonial.html", "description" => "Testimonial admin index."),
	array("file" => "testimonials_requirements.html", "description" => "Display missing requirements."));

/** Blocks information */
$modversion['blocks'][1] = array(
	"file"						=> "testimonials_random_testimonials.php",
	"name"						=> _MI_TESTIMONIALS_RANDOM_TESTIMONIALS,
	"description"				=> _MI_TESTIMONIALS_RANDOM_TESTIMONIALSDSC,
	"show_func"					=> "testimonials_random_testimonials_show",
	"edit_func"					=> "testimonials_random_testimonials_edit",
	"options"					=> "0",
	"template"					=> "testimonials_random_testimonials.html");

$modversion['blocks'][] = array(
	'file' => 'testimonials_rotator_testimonials.php',
	'name' => _MI_TESTIMONIALS_ROTATION_TESTIMONIALS,
	'description' => _MI_TESTIMONIALS_ROTATION_TESTIMONIALSDSC,
	'show_func' => 'testimonials_rotator_testimonials_show',
	'edit_func' => 'testimonials_rotator_testimonials_edit',
	'options' => '5|0|300|6000|fade',
	'template' => 'testimonials_rotator_testimonials.html');
