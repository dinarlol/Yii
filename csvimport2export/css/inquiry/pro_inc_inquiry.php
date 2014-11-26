<?php
/**********************************************************************
    Copyright (C) FrontAccounting, LLC.
	Released under the terms of the GNU General Public License, GPL, 
	as published by the Free Software Foundation, either version 3 
	of the License, or (at your option) any later version.
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  
    See the License here <http://www.gnu.org/licenses/gpl-3.0.html>.
***********************************************************************/
$page_security = 'SA_PROMOTIONINQUIRY';
$path_to_root="../..";

include($path_to_root . "/includes/db_pager.inc");
include_once($path_to_root . "/includes/session.inc");

include_once($path_to_root . "/includes/date_functions.inc");
include_once($path_to_root . "/includes/ui.inc");
$js = "";
if ($use_popup_windows)
	$js .= get_js_open_window(800, 500);
if ($use_date_picker)
	$js .= get_js_date_picker();

if (isset($_GET['outstanding_only']) && $_GET['outstanding_only'])
{
	$outstanding_only = 1;
	page(_($help_context = "Search "), false, false, "", $js);
}
else
{
	$outstanding_only = 0;
	page(_($help_context = "Employee - Increment & Promotion Inquiry "), false, false, "", $js);
}
//-----------------------------------------------------------------------------------
// Ajax updates
//
if (get_post('SearchOrders'))
{
	$Ajax->activate('dim_table');
} elseif (get_post('ap_id'))
{
	$disable = get_post('ap_id') !== '';

		$Ajax->addDisable(true, 'emp_id', $disable);
	
	if ($disable) {
//		$Ajax->addFocus(true, 'OrderNumber');
		set_focus('emp_id');
	}

	$Ajax->activate('dim_table');
}

//--------------------------------------------------------------------------------------

if (isset($_GET["stock_id"]))
	$_POST['SelectedStockItem'] = $_GET["stock_id"];

//--------------------------------------------------------------------------------------

start_form(false, false, $_SERVER['PHP_SELF'] ."?outstanding_only=$outstanding_only");

start_table(TABLESTYLE_NOBORDER);
start_row();


 /*app_list_cells(_("Select an Applicant "), 'id', null, _("Employee List"));

submit_cells('SearchOrders', _("Search"), '', '', 'default');
*/
end_row();
end_table();

$dim = get_company_pref('use_dimension');

function view_link($row) 
{
	return get_dimensions_trans_view_str(ST_DIMENSION, $_POST['id']);
}

function sum_dimension($row) 
{
	return get_hr_loan1_balance($_POST['id']); 
}



function edit_link($row)
{
	return pager_link(_("Edit"),
			"/payroll/manage/aprove_pro_inc.php?trans_no=" . $row["emp_code"], ICON_GL);
}

$sql = get_proemp($emp_id);
echo '<a href="javascript:window.print()" align="center">Print</a>';
$cols = array(
_("Employee Code "),
	_("Employee Name "),
	_("Effective Date"),  
	_("Increment %"),  
	_("Increment Amount"),  
	_("Salary After Increment"), 
array('insert'=>true, 'fun'=>'edit_link')
);

if ($outstanding_only) {
	$cols[_("Closed")] = 'skip';
}

$table =& new_db_pager('dim_tbl', $sql, $cols);
//$table->set_marker('is_overdue', _("Marked dimensions are overdue."));

$table->width = "80%";

display_db_pager($table);

end_form();
end_page();

?>