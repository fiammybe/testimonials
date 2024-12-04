<?php
/**
 * Admin page to manage testimonials
 *
 * List, add, edit and delete testimonial objects
 *
 * @copyright	Copyright Madfish (Simon Wilkinson) 2011
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * @since		1.0
 * @author		Madfish (Simon Wilkinson) <simon@isengard.biz>
 * @package		testimonials
 * @version		$Id$
 */

/**
 * Edit a Testimonial
 *
 * @param int $testimonial_id Testimonialid to be edited
*/
function edittestimonial($testimonial_id = 0) {
	global $testimonials_testimonial_handler, $icmsModule, $icmsAdminTpl;

	$testimonialObj = $testimonials_testimonial_handler->get($testimonial_id);

	if (!$testimonialObj->isNew()){
		$icmsModule->displayAdminMenu(0, _AM_TESTIMONIALS_TESTIMONIALS . " > " . _CO_ICMS_EDITING);
		$sform = $testimonialObj->getForm(_AM_TESTIMONIALS_TESTIMONIAL_EDIT, "addtestimonial");
		$sform->assign($icmsAdminTpl);
	} else {
		$icmsModule->displayAdminMenu(0, _AM_TESTIMONIALS_TESTIMONIALS . " > " . _CO_ICMS_CREATINGNEW);
		$sform = $testimonialObj->getForm(_AM_TESTIMONIALS_TESTIMONIAL_CREATE, "addtestimonial");
		$sform->assign($icmsAdminTpl);

	}
	$icmsAdminTpl->display("db:testimonials_admin_testimonial.html");
}

include_once "admin_header.php";

$testimonials_testimonial_handler = icms_getModuleHandler("testimonial", TESTIMONIALS_DIRNAME, "testimonials");

/** Create a whitelist of valid values, be sure to use appropriate types for each value
 * Be sure to include a value for no parameter, if you have a default condition
 */
$clean_op = "";
$valid_op = array ("mod", "changedField", "addtestimonial", "del", "view", "changeStatus", "");

if (isset($_GET["op"])) $clean_op = htmlentities($_GET["op"]);
if (isset($_POST["op"])) $clean_op = htmlentities($_POST["op"]);

$clean_testimonial_id = isset($_GET["testimonial_id"]) ? (int)$_GET["testimonial_id"] : 0 ;

if (in_array($clean_op, $valid_op, TRUE)) {
	switch ($clean_op) {
		case "mod":
		case "changedField":
			icms_cp_header();
			edittestimonial($clean_testimonial_id);
			break;

		case "addtestimonial":
			$controller = new icms_ipf_Controller($testimonials_testimonial_handler);
			$controller->storeFromDefaultForm(_AM_TESTIMONIALS_TESTIMONIAL_CREATED, _AM_TESTIMONIALS_TESTIMONIAL_MODIFIED);
			break;

		case "del":
			$controller = new icms_ipf_Controller($testimonials_testimonial_handler);
			$controller->handleObjectDeletion();
			break;

		case "view":
			$testimonialObj = $testimonials_testimonial_handler->get($clean_testimonial_id);
			icms_cp_header();
			$testimonialObj->displaySingleObject();
			break;
		
		case "changeStatus":
			$status = $ret = '';
			$status = $testimonials_testimonial_handler->changeOnlineStatus($clean_testimonial_id, 'online_status');
			$ret = '/modules/' . TESTIMONIALS_DIRNAME . '/admin/testimonial.php';
			if (!$status) {
				redirect_header(ICMS_URL . $ret, 2, _AM_TESTIMONIALS_TESTIMONIAL_OFFLINE);
			} else {
				redirect_header(ICMS_URL . $ret, 2, _AM_TESTIMONIALS_TESTIMONIAL_ONLINE);
			}
			break;

		default:
			icms_cp_header();
			
			$icmsModule->displayAdminMenu(0, _AM_TESTIMONIALS_TESTIMONIALS);
			$objectTable = new icms_ipf_view_Table($testimonials_testimonial_handler);
			$objectTable->addColumn(new icms_ipf_view_Column("online_status", "center", TRUE));
			$objectTable->addColumn(new icms_ipf_view_Column("creator"));
			$objectTable->addColumn(new icms_ipf_view_Column("description"));
			$objectTable->addColumn(new icms_ipf_view_Column("date"));
			$objectTable->addIntroButton("addtestimonial", "testimonial.php?op=mod", _AM_TESTIMONIALS_TESTIMONIAL_CREATE);
			$icmsAdminTpl->assign("testimonials_testimonial_table", $objectTable->fetch());
			$icmsAdminTpl->display("db:testimonials_admin_testimonial.html");
			break;
	}
	icms_cp_footer();
}
/**
 * If you want to have a specific action taken because the user input was invalid,
 * place it at this point. Otherwise, a blank page will be displayed
 */
