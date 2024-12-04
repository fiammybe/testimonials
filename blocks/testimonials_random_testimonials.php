<?php
/**
* Holds the functions for the random testimonials block
*
* @copyright	Copyright Madfish (Simon Wilkinson) 2011
* @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
* @since		1.0
* @author		Madfish (Simon Wilkinson) <simon@isengard.biz>
* @package		testimonials
* @version		$Id$
*/

/**
 * Prepares the random testimonials block for display
 *
 * @param array $options
 * @return string 
 */
function testimonials_random_testimonials_show($options) {
	
	$block = array();
	$display = (int)$options[0];
	$testimonials_testimonial_handler = icms_getModuleHandler('testimonial', basename(dirname(dirname(__FILE__))), 'testimonials');
	
	if (!$display) {
		
		// display a random testimonial
		$testimonials_count = $testimonials_testimonial_handler->getCount();
		$random = mt_rand(1, $testimonials_count);
		$criteria = icms_buildCriteria(array('online_status' => '1'));
		$criteria->setStart($random -1);
		$criteria->setLimit(1);
		$testimonialObjArray = $testimonials_testimonial_handler->getObjects($criteria);
		$testimonialObj = array_shift($testimonialObjArray);
		
	} else {
		
		// display a fixed testimonial
		$testimonialObj = $testimonials_testimonial_handler->get($display);
		if ($testimonialObj->getVar('online_status', 'e') != 1) {
			unset($testimonialObj);
		}
	}
	
	if ($testimonialObj) {
		
		$block['creator'] = $testimonialObj->getVar('creator');
		$block['description'] = $testimonialObj->getVar('description');
		$block['date'] = $testimonialObj->getVar('date');
	}
	
	return $block;
}

/**
 * Edit options for the random testimonials block
 *
 * @param array $options
 * @return string 
 */
function testimonials_random_testimonials_edit($options) {
	
	// display random testimonial (0) or a fixed testimonial (enter ID number)
	$form = '<table><tr>';
	$form .= '<tr><td>' . _MB_TESTIMONIALS_RANDOM_OR_FIXED_TESTIMONIAL . '</td>';
	$form .= '<td>' . '<input type="text" name="options[]" value="' . $options[0] . '" /></td>';
	$form .= '</tr></table>';
	
	return $form;
}
