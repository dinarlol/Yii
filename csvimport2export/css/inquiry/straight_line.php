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
$page_security = 'SA_DIMTRANSVIEW';
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
	page(_($help_context = "Search Outstanding Dimensions"), false, false, "", $js);
}
else
{
	$outstanding_only = 0;
	page(_($help_context = "Loan Inquiry "), false, false, "", $js);
}
//-----------------------------------------------------------------------------------
// Ajax updates
//
if (get_post('SearchOrders'))
{
	$Ajax->activate('dim_table');
} elseif (get_post('emp_id'))
{
	$disable = get_post('emp_id') !== '';

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


 emp_list_cells(_("Select Employee "), 'id', null, _("Employee List"));

submit_cells('SearchOrders', _("Search"), '', '', 'default');

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
			"/payroll/loan_view.php?trans_no=" . $row["id"], ICON_GL);
}

$th = array(_("Item Code"),("Description"), _("Actual Price"), _("Currency"), "Delevery Date","No of years","Year1","Year2","Year3","Year4","Year5",
"Year6");

//$th = array(_("Item Code"),("Description"), _("Actual Price"), "Delevery Date","Numbesrs Of Year");
//inactive_control_column($th);
table_header($th);

$k = 0;         //row colour counter
while ($myrow = db_fetch($result)) 
{
	$Tyear=(date('Y-m-d'))-$myrow["delivery_date"];
	if($Tyear>0){
	$value=$myrow["value"];
// $curyear=$myrow["delivery_date"]-date();
	alt_table_row_color($k);
	
		 label_cell($myrow["stock_id"]);
    label_cell($myrow["description"]);
	
   label_cell($myrow["unit_price"]);
     label_cell($myrow["curr_code"]);
   label_cell($myrow["delivery_date"]);
   label_cell($Tyear=(date('Y-m-d'))-$myrow["delivery_date"]);
 

$sum = 0;
for($i = 1; $i <=$Tyear; $i++) {
   $sum += $i;
   $sum;
}

for($b =$Tyear; $b>0; $b--){


$k=$b/$sum;


label_cell($d=round($myrow["unit_price"]*$k,0));
$a=6-$Tyear;

}
for( $a1=1;$a1<=$a;$a1++){
label_cell("");
//$a1++;
}

	}
	 end_row();
}


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
