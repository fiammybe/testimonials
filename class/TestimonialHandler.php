<?php
/**
 * Classes responsible for managing Testimonial testimonial objects
 *
 * @copyright	Copyright Madfish (Simon Wilkinson) 2011
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * @since		1.0
 * @author		Madfish (Simon Wilkinson) <simon@isengard.biz>
 * @package		testimonials
 * @version		$Id$
 */

defined("ICMS_ROOT_PATH") or die("ICMS root path not defined");

class mod_testimonials_TestimonialHandler extends icms_ipf_Handler {
	/**
	 * Constructor
	 *
	 * @param icms_db_legacy_Database $db database connection object
	 */
	public function __construct(&$db) {
		parent::__construct($db, "testimonial", "testimonial_id", "creator", "description", "testimonials");

	}

	/**
	 * Toggles a testimonial on or offline
	 *
	 * @param int $testimonial_id
	 * @param str $field
	 * @return int $visibility
	 */
	public function changeOnlineStatus($testimonial_id, $field) {

		$visibility = $testimonialObj = '';

		$testimonialObj = $this->get($testimonial_id);
		if ($testimonialObj->getVar($field, 'e')) {
			$testimonialObj->setVar($field, 0);
			$visibility = 0;
		} else {
			$testimonialObj->setVar($field, 1);
			$visibility = 1;
		}
		$this->insert($testimonialObj, TRUE);

		return $visibility;
	}
}
