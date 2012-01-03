<?php
/**
 * Classes responsible for managing Quotes quote objects
 *
 * @copyright	Copyright Madfish (Simon Wilkinson) 2011
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * @since		1.0
 * @author		Madfish (Simon Wilkinson) <simon@isengard.biz>
 * @package		quotes
 * @version		$Id$
 */

defined("ICMS_ROOT_PATH") or die("ICMS root path not defined");

class mod_quotes_QuoteHandler extends icms_ipf_Handler {
	/**
	 * Constructor
	 *
	 * @param icms_db_legacy_Database $db database connection object
	 */
	public function __construct(&$db) {
		parent::__construct($db, "quote", "quote_id", "creator", "description", "quotes");

	}
	
	/**
	 * Toggles a quote on or offline
	 *
	 * @param int $quote_id
	 * @param str $field
	 * @return int $visibility
	 */
	public function changeOnlineStatus($quote_id, $field) {
		
		$visibility = $quoteObj = '';
		
		$quoteObj = $this->get($quote_id);
		if ($quoteObj->getVar($field, 'e')) {
			$quoteObj->setVar($field, 0);
			$visibility = 0;
		} else {
			$quoteObj->setVar($field, 1);
			$visibility = 1;
		}
		$this->insert($quoteObj, TRUE);
		
		return $visibility;
	}
}