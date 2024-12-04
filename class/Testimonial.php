<?php
/**
 * Class representing Testimonials testimonial objects
 *
 * @copyright	Copyright Madfish (Simon Wilkinson) 2011
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * @since		1.0
 * @author		Madfish (Simon Wilkinson) <simon@isengard.biz>
 * @package		testimonials
 * @version		$Id$
 */

defined("ICMS_ROOT_PATH") or die("ICMS root path not defined");

class mod_testimonials_Testimonial extends icms_ipf_Object {
	/**
	 * Constructor
	 *
	 * @param mod_testimonials_Testimonial $handler Object handler
	 */
	public function __construct(&$handler) {
		parent::__construct($handler);

		$this->quickInitVar("testimonial_id", XOBJ_DTYPE_INT, TRUE);
		$this->quickInitVar("creator", XOBJ_DTYPE_TXTBOX, FALSE);
		$this->quickInitVar("description", XOBJ_DTYPE_TXTAREA, TRUE);
		$this->quickInitVar("date", XOBJ_DTYPE_TXTBOX, FALSE);
		$this->quickInitVar("online_status", XOBJ_DTYPE_INT, TRUE, FALSE, FALSE, 1);
		$this->initCommonVar("dohtml");
		$this->initCommonVar("dobr");
		$this->initCommonVar("dosmiley");
		
		$this->setControl('online_status', 'yesno');
	}
	
	/**
	 * Overriding the icms_ipf_Object::getVar method to assign a custom method on some
	 * specific fields to handle the value before returning it
	 *
	 * @param str $key key of the field
	 * @param str $format format that is requested
	 * @return mixed value of the field that is requested
	 */
	public function getVar($key, $format = "s") {
		if ($format == "s" && in_array($key, array('online_status'))) {
			return call_user_func(array ($this,	$key));
		}
		return parent::getVar($key, $format);
	}
	
	/**
	 * Converts the online status of an object to a human readable icon with link toggle
	 *
	 * @return string 
	 */
	public function online_status() {
		
		$status = $button = '';
		
		$status = $this->getVar('online_status', 'e');
		$button = '<a href="' . ICMS_URL . '/modules/' . basename(dirname(dirname(__FILE__)))
				. '/admin/testimonial.php?testimonial_id=' . $this->getVar('testimonial_id')
				. '&amp;op=changeStatus">';
		if (!$status) {
			$button .= '<img src="' . ICMS_IMAGES_SET_URL . '/actions/button_cancel.png" alt="' 
				. _CO_TESTIMONIALS_TESTIMONIAL_OFFLINE . '" title="' . _CO_TESTIMONIALS_TESTIMONIAL_OFFLINE . '" /></a>';
			
		} else {
			
			$button .= '<img src="' . ICMS_IMAGES_SET_URL . '/actions/button_ok.png" alt="' 
				. _CO_TESTIMONIALS_TESTIMONIAL_ONLINE . '" title="' . _CO_TESTIMONIALS_TESTIMONIAL_ONLINE . '" /></a>';
		}
		return $button;
	}
}
