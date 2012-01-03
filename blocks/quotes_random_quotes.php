<?php
/**
* Holds the functions for the random quotes block
*
* @copyright	Copyright Madfish (Simon Wilkinson) 2011
* @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
* @since		1.0
* @author		Madfish (Simon Wilkinson) <simon@isengard.biz>
* @package		quotes
* @version		$Id$
*/

/**
 * Prepares the random quotes block for display
 *
 * @param array $options
 * @return string 
 */
function quotes_random_quotes_show($options) {
	
	$block = array();
	$display = (int)$options[0];
	$quotes_quote_handler = icms_getModuleHandler('quote', basename(dirname(dirname(__FILE__))), 'quotes');
	
	if (!$display) {
		
		// display a random quote
		$quotes_count = $quotes_quote_handler->getCount();
		$random = mt_rand(1, $quotes_count);
		$criteria = icms_buildCriteria(array('online_status' => '1'));
		$criteria->setStart($random -1);
		$criteria->setLimit(1);
		$quoteObjArray = $quotes_quote_handler->getObjects($criteria);
		$quoteObj = array_shift($quoteObjArray);
		
	} else {
		
		// display a fixed quote
		$quoteObj = $quotes_quote_handler->get($display);
		if ($quoteObj->getVar('online_status', 'e') != 1) {
			unset($quoteObj);
		}
	}
	
	if ($quoteObj) {
		
		$block['creator'] = $quoteObj->getVar('creator');
		$block['description'] = $quoteObj->getVar('description');
		$block['date'] = $quoteObj->getVar('date');
	}
	
	return $block;
}

/**
 * Edit options for the random quotes block
 *
 * @param array $options
 * @return string 
 */
function quotes_random_quotes_edit($options) {
	
	// display random quote (0) or a fixed quote (enter ID number)
	$form = '<table><tr>';
	$form .= '<tr><td>' . _MB_QUOTES_RANDOM_OR_FIXED_QUOTE . '</td>';
	$form .= '<td>' . '<input type="text" name="options[]" value="' . $options[0] . '" /></td>';
	$form .= '</tr></table>';
	
	return $form;
}