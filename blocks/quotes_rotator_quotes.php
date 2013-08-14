<?php
/**
* Holds the functions for the random quotes block
*
* @copyright	Copyright Madfish (Simon Wilkinson) 2011
* @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
* @since		1.1
* @author		Madfish (Simon Wilkinson) <simon@isengard.biz>
* @author		debianus
* @package		quotes
* @version		$Id$
*/

/**
 * Prepares the rotator quotes block for display
 *
 * @param array $options
 * @return string 
 */

function quotes_rotator_quotes_show($options) {
	
$quotesModule = icms_getModuleInfo('quotes');
	include_once(ICMS_ROOT_PATH . '/modules/' . $quotesModule->getVar('dirname') . '/include/common.php');
	$quotes_quote_handler = icms_getModuleHandler('quote', basename(dirname(dirname(__FILE__))), 'quotes');
	$criteria = new icms_db_criteria_Compo();
	$quotesList = $quotes = array();

	// Get a list of quotes
	
	$criteria->add(new icms_db_criteria_Item('online_status', '1'));
	$criteria->setSort('quote_id');
	$criteria->setOrder('ASC');
	$quote_list = $quotes_quote_handler->getList($criteria);
	$quote_list = array_keys($quote_list);

// Pick random quotes from the list, if the block preference is so set
	if ($options[1] == TRUE) 
	{
		shuffle($quote_list);
	}
	
	// Cut the quote list down to the number of required entries and set the IDs as criteria
	$quote_list = array_slice($quote_list, 0, $options[0], TRUE);
	$criteria->add(new icms_db_criteria_Item('quote_id', '(' . implode(',', $quote_list) . ')', 'IN'));

	$block = array();
	$display = (int)$options[0];
	$quotes_quote_handler = icms_getModuleHandler('quote', basename(dirname(dirname(__FILE__))), 'quotes');
	// Retrieve the quotes and assign them to the block - need to shuffle a second time
	$quotes = $quotes_quote_handler->getObjects($criteria, TRUE, FALSE);
	if ($options[1] == TRUE)
	{
		shuffle($quotes);
	}

	// Assign to template
	$block['random_quotes'] = $quotes;
	$block['transition_speed'] = $options[2];
	$block['autoplay_speed'] = $options[3];
	$block['transition'] = $options[4];

	return $block;
}
/**
 * Edit rotator quotes block options
 *
 * @param array $options
 * @return string 
 */
function quotes_rotator_quotes_edit($options) 
{
	$quotesModule = icms_getModuleInfo('quotes');
	include_once(ICMS_ROOT_PATH . '/modules/' . $quotesModule->getVar('dirname') . '/include/common.php');
	$quotes_quote_handler = icms_getModuleHandler('quote', $quotesModule->getVar('dirname'), 'quotes');
	
	// Select number of random quotes to display in the block
	$form = '<table><tr>';
	$form .= '<tr><td>' . _MB_QUOTES_ROTATION_LIMIT . '</td>';
	$form .= '<td>' . '<input type="text" name="options[0]" value="' . $options[0] . '"/></td>';
	
	// Randomise the quotes? NB: Only works if you do not cache the block
	$form .= '<tr><td>' .  _MB_QUOTES_RANDOM_OR_ORDERED_QUOTE . '</td>';
	$form .= '<td><input type="radio" name="options[1]" value="1"';
	if ($options[1] == 1) 
	{
		$form .= ' checked="checked"';
	}
	$form .= '/>' . _YES;
	$form .= '<input type="radio" name="options[1]" value="0"';
	if ($options[1] == 0) 
	{
		$form .= 'checked="checked"';
	}
	$form .= '/>' . _NO . '</td></tr>';	

	// This is the speed that each animation will take, not the entire transition
	$form .= '<tr><td>' . _MB_QUOTES_TRANSITIONSPEED . '</td>';
	$form .= '<td>' . '<input type="text" name="options[2]" value="' . $options[2] . '"/></td>';

	// Duration before each transition
	$form .= '<tr><td>' . _MB_QUOTES_AUTOPLAYSPEED . '</td>';
	$form .= '<td>' . '<input type="text" name="options[3]" value="' . $options[3] . '"/></td>';

	//The style of the transition. Currently there are only two available options: fade and basic. 
	$form .= '<tr><td>' . _MB_QUOTES_TRANSITION . '</td>';
	$form .= '<td>' . '<input type="text" name="options[4]" value="' . $options[4] . '"/></td>';
	$form .= '</table>';
	
	return $form;
}