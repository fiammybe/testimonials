<?php
/**
 * Common file of the module included on all pages of the module
 *
 * @copyright	Copyright Madfish (Simon Wilkinson) 2011
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * @since		1.0
 * @author		Madfish (Simon Wilkinson) <simon@isengard.biz>
 * @package		testimonials
 * @version		$Id$
 */

defined("ICMS_ROOT_PATH") or die("ICMS root path not defined");

if (!defined("TESTIMONIALS_DIRNAME")) define("TESTIMONIALS_DIRNAME", $modversion["dirname"] 
		= basename(dirname(dirname(__FILE__))));
if (!defined("TESTIMONIALS_URL")) define("TESTIMONIALS_URL", ICMS_URL."/modules/" . TESTIMONIALS_DIRNAME."/");
if (!defined("TESTIMONIALS_ROOT_PATH")) define("TESTIMONIALS_ROOT_PATH", ICMS_ROOT_PATH."/modules/" 
		. TESTIMONIALS_DIRNAME . "/");
if (!defined("TESTIMONIALS_IMAGES_URL")) define("TESTIMONIALS_IMAGES_URL", TESTIMONIALS_URL . "images/");
if (!defined("TESTIMONIALS_ADMIN_URL")) define("TESTIMONIALS_ADMIN_URL", TESTIMONIALS_URL . "admin/");

// Include the common language file of the module
icms_loadLanguageFile("testimonials", "common");
