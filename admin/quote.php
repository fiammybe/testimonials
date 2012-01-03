<?php
/**
 * Admin page to manage quotes
 *
 * List, add, edit and delete quote objects
 *
 * @copyright	Copyright Madfish (Simon Wilkinson) 2011
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * @since		1.0
 * @author		Madfish (Simon Wilkinson) <simon@isengard.biz>
 * @package		quotes
 * @version		$Id$
 */

/**
 * Edit a Quote
 *
 * @param int $quote_id Quoteid to be edited
*/
function editquote($quote_id = 0) {
	global $quotes_quote_handler, $icmsModule, $icmsAdminTpl;

	$quoteObj = $quotes_quote_handler->get($quote_id);

	if (!$quoteObj->isNew()){
		$icmsModule->displayAdminMenu(0, _AM_QUOTES_QUOTES . " > " . _CO_ICMS_EDITING);
		$sform = $quoteObj->getForm(_AM_QUOTES_QUOTE_EDIT, "addquote");
		$sform->assign($icmsAdminTpl);
	} else {
		$icmsModule->displayAdminMenu(0, _AM_QUOTES_QUOTES . " > " . _CO_ICMS_CREATINGNEW);
		$sform = $quoteObj->getForm(_AM_QUOTES_QUOTE_CREATE, "addquote");
		$sform->assign($icmsAdminTpl);

	}
	$icmsAdminTpl->display("db:quotes_admin_quote.html");
}

include_once "admin_header.php";

$quotes_quote_handler = icms_getModuleHandler("quote", QUOTES_DIRNAME, "quotes");

/** Create a whitelist of valid values, be sure to use appropriate types for each value
 * Be sure to include a value for no parameter, if you have a default condition
 */
$clean_op = "";
$valid_op = array ("mod", "changedField", "addquote", "del", "view", "changeStatus", "");

if (isset($_GET["op"])) $clean_op = htmlentities($_GET["op"]);
if (isset($_POST["op"])) $clean_op = htmlentities($_POST["op"]);

$clean_quote_id = isset($_GET["quote_id"]) ? (int)$_GET["quote_id"] : 0 ;

if (in_array($clean_op, $valid_op, TRUE)) {
	switch ($clean_op) {
		case "mod":
		case "changedField":
			icms_cp_header();
			editquote($clean_quote_id);
			break;

		case "addquote":
			$controller = new icms_ipf_Controller($quotes_quote_handler);
			$controller->storeFromDefaultForm(_AM_QUOTES_QUOTE_CREATED, _AM_QUOTES_QUOTE_MODIFIED);
			break;

		case "del":
			$controller = new icms_ipf_Controller($quotes_quote_handler);
			$controller->handleObjectDeletion();
			break;

		case "view":
			$quoteObj = $quotes_quote_handler->get($clean_quote_id);
			icms_cp_header();
			$quoteObj->displaySingleObject();
			break;
		
		case "changeStatus":
			$status = $ret = '';
			$status = $quotes_quote_handler->changeOnlineStatus($clean_quote_id, 'online_status');
			$ret = '/modules/' . QUOTES_DIRNAME . '/admin/quote.php';
			if (!$status) {
				redirect_header(ICMS_URL . $ret, 2, _AM_QUOTES_QUOTE_OFFLINE);
			} else {
				redirect_header(ICMS_URL . $ret, 2, _AM_QUOTES_QUOTE_ONLINE);
			}
			break;

		default:
			icms_cp_header();
			
			$icmsModule->displayAdminMenu(0, _AM_QUOTES_QUOTES);
			$objectTable = new icms_ipf_view_Table($quotes_quote_handler);
			$objectTable->addColumn(new icms_ipf_view_Column("online_status", "center", TRUE));
			$objectTable->addColumn(new icms_ipf_view_Column("creator"));
			$objectTable->addColumn(new icms_ipf_view_Column("description"));
			$objectTable->addColumn(new icms_ipf_view_Column("date"));
			$objectTable->addIntroButton("addquote", "quote.php?op=mod", _AM_QUOTES_QUOTE_CREATE);
			$icmsAdminTpl->assign("quotes_quote_table", $objectTable->fetch());
			$icmsAdminTpl->display("db:quotes_admin_quote.html");
			break;
	}
	icms_cp_footer();
}
/**
 * If you want to have a specific action taken because the user input was invalid,
 * place it at this point. Otherwise, a blank page will be displayed
 */