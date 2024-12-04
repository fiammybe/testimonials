<?php
/**
* Holds the functions for the random testimonials block
*
* @copyright	Copyright Madfish (Simon Wilkinson) 2011
* @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
* @since		1.1
* @author		Madfish (Simon Wilkinson) <simon@isengard.biz>
* @author		debianus
* @package		testimonials
* @version		$Id$
*/

/**
 * Prepares the rotator testimonials block for display
 *
 * @param array $options
 * @return string 
 */

function testimonials_rotator_testimonials_show($options) {
	
$testimonialsModule = icms_getModuleInfo('testimonials');
	include_once(ICMS_ROOT_PATH . '/modules/' . $testimonialsModule->getVar('dirname') . '/include/common.php');
	$testimonials_testimonial_handler = icms_getModuleHandler('testimonial', basename(dirname(dirname(__FILE__))), 'testimonials');
	$criteria = new icms_db_criteria_Compo();
	$testimonialsList = $testimonials = array();

	// Get a list of testimonials
	
	$criteria->add(new icms_db_criteria_Item('online_status', '1'));
	$criteria->setSort('testimonial_id');
	$criteria->setOrder('ASC');
	$testimonial_list = $testimonials_testimonial_handler->getList($criteria);
	$testimonial_list = array_keys($testimonial_list);

// Pick random testimonials from the list, if the block preference is so set
	if ($options[1] == TRUE) 
	{
		shuffle($testimonial_list);
	}
	
	// Cut the testimonial list down to the number of required entries and set the IDs as criteria
	$testimonial_list = array_slice($testimonial_list, 0, $options[0], TRUE);
	$criteria->add(new icms_db_criteria_Item('testimonial_id', '(' . implode(',', $testimonial_list) . ')', 'IN'));

	$block = array();
	$display = (int)$options[0];
	$testimonials_testimonial_handler = icms_getModuleHandler('testimonial', basename(dirname(dirname(__FILE__))), 'testimonials');
	// Retrieve the testimonials and assign them to the block - need to shuffle a second time
	$testimonials = $testimonials_testimonial_handler->getObjects($criteria, TRUE, FALSE);
	if ($options[1] == TRUE)
	{
		shuffle($testimonials);
	}

	// Assign to template
	$block['random_testimonials'] = $testimonials;
	$block['transition_speed'] = $options[2];
	$block['autoplay_speed'] = $options[3];
	$block['transition'] = $options[4];

	return $block;
}
/**
 * Edit rotator testimonials block options
 *
 * @param array $options
 * @return string 
 */
function testimonials_rotator_testimonials_edit($options) 
{
	$testimonialsModule = icms_getModuleInfo('testimonials');
	include_once(ICMS_ROOT_PATH . '/modules/' . $testimonialsModule->getVar('dirname') . '/include/common.php');
	$testimonials_testimonial_handler = icms_getModuleHandler('testimonial', $testimonialsModule->getVar('dirname'), 'testimonials');
	
	// Select number of random testimonials to display in the block
	$form = '<table><tr>';
	$form .= '<tr><td>' . _MB_TESTIMONIALS_ROTATION_LIMIT . '</td>';
	$form .= '<td>' . '<input type="text" name="options[0]" value="' . $options[0] . '"/></td>';
	
	// Randomise the testimonials? NB: Only works if you do not cache the block
	$form .= '<tr><td>' .  _MB_TESTIMONIALS_RANDOM_OR_ORDERED_TESTIMONIAL . '</td>';
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
	$form .= '<tr><td>' . _MB_TESTIMONIALS_TRANSITIONSPEED . '</td>';
	$form .= '<td>' . '<input type="text" name="options[2]" value="' . $options[2] . '"/></td>';

	// Duration before each transition
	$form .= '<tr><td>' . _MB_TESTIMONIALS_AUTOPLAYSPEED . '</td>';
	$form .= '<td>' . '<input type="text" name="options[3]" value="' . $options[3] . '"/></td>';

	//The style of the transition. Currently there are only two available options: fade and basic. 
	$form .= '<tr><td>' . _MB_TESTIMONIALS_TRANSITION . '</td>';
	$form .= '<td>' . '<input type="text" name="options[4]" value="' . $options[4] . '"/></td>';
	$form .= '</table>';
	
	return $form;
}
