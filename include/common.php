<?php
/**
 * Common file of the module included on all pages of the module
 *
 * @copyright	Copyright Madfish (Simon Wilkinson) 2011
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * @since		1.0
 * @author		Madfish (Simon Wilkinson) <simon@isengard.biz>
 * @package		quotes
 * @version		$Id$
 */

defined("ICMS_ROOT_PATH") or die("ICMS root path not defined");

if (!defined("QUOTES_DIRNAME")) define("QUOTES_DIRNAME", $modversion["dirname"] 
		= basename(dirname(dirname(__FILE__))));
if (!defined("QUOTES_URL")) define("QUOTES_URL", ICMS_URL."/modules/" . QUOTES_DIRNAME."/");
if (!defined("QUOTES_ROOT_PATH")) define("QUOTES_ROOT_PATH", ICMS_ROOT_PATH."/modules/" 
		. QUOTES_DIRNAME . "/");
if (!defined("QUOTES_IMAGES_URL")) define("QUOTES_IMAGES_URL", QUOTES_URL . "images/");
if (!defined("QUOTES_ADMIN_URL")) define("QUOTES_ADMIN_URL", QUOTES_URL . "admin/");

// Include the common language file of the module
icms_loadLanguageFile("quotes", "common");