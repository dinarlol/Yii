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
$page_security = 'AS_RECORD';
$path_to_root="../..";

include($path_to_root . "/includes/db_pager.inc");
include_once($path_to_root . "/includes/session.inc");
include_once($path_to_root . "/includes/date_functions.inc");
include_once($path_to_root . "/includes/ui.inc");
include_once($path_to_root . "/purchasing/includes/purchasing_ui.inc");
include_once($path_to_root . "/reporting/includes/reporting.inc");
if (isset($_GET['vw']))
	$view_id = $_GET['vw'];
else
	$view_id = find_submit('view');
if ($view_id != -1)
{
	$row = get_cv($view_id);
	if ($row['filename'] != "")
	{
		if(in_ajax()) {
		$Ajax->popup($_SERVER['PHP_SELF'].'?vw='.$view_id);
		} else {
			$type = ($row['filetype']) ? $row['filetype'] : 'application/octet-stream';	
    		header("Content-type: ".$type);
    		header('Content-Length: '.$row['filesize']);
	    	//if ($type == 'application/octet-stream')
    		//header('Content-Disposition: attachment; filename='.$row['filename']);
    		//else
	 		header("Content-Disposition: inline");
	    	echo file_get_contents(company_path(). "/attachments/".$row['unique_name']);
    		exit();
		}
	}	
}
if (isset($_GET['dl']))
	$download_id = $_GET['dl'];
else
	$download_id = find_submit('download');

if ($download_id != -1)
{
	$row = get_cv($download_id);
	if ($row['filename'] != "")
	{
		if(in_ajax()) {
			$Ajax->redirect($_SERVER['PHP_SELF'].'?dl='.$download_id);
		} else {
			$type = ($row['filetype']) ? $row['filetype'] : 'application/octet-stream';	
    		header("Content-type: ".$type);
	    	header('Content-Length: '.$row['filesize']);
    		header('Content-Disposition: attachment; filename='.$row['filename']);
    		echo file_get_contents(company_path()."/attachments/".$row['unique_name']);
	    	exit();
		}
	}	
}

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
	page(_($help_context = "Epmloyees Assets Inquiry"), false, false, "", $js);
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

if (isset($_GET['trans_no']))
{
	$selected_id = $_GET['trans_no'];
	$_SESSION['selected_id']=$selected_id;
} 


start_form(false, false, $_SERVER['PHP_SELF'] ."?outstanding_only=$outstanding_only");

start_table(TABLESTYLE_NOBORDER);
start_row();


asset_emp_list_cells(_("Select Employee "), 'emp_id', null, _("Employee List"));

submit_cells('SearchOrders', _("Search"), '', '', 'default');

end_row();
end_table();

$dim = get_company_pref('use_dimension');

function view_link($row) 
{
	return get_dimensions_trans_view_str(ST_DIMENSION, $_POST['emp_id']);
}

function sum_dimension($row) 
{

	return get_emp_asset_balance($_POST['emp_id']); 
}




function edit_link($row)
{
	return pager_link(_("Edit"),
			"/payroll/manage/update_equip.php?trans_no=" . $row["id"], ICON_EDIT);
}

function delete_link($row)
{
	return pager_link(_("Delete"),
			"/payroll/inquiry/asset_record.php?trans_no=" . $row["id"], ICON_DELETE);
		



			
}

if($_GET['trans_no']!=""){
	
	
	$sql="DELETE FROM ".TB_PREF."emp_equip WHERE id=".db_escape($_GET['trans_no']);
	db_query($sql, "could not delete stock item");
	display_notification(_('Record has been deleted'));
	//header("location:".$path_to_root . "/payroll/inquiry/asset_record.php");
	   
}

function trans_view($trans)
{
	return get_trans_view_str(ST_PURCHORDER, $trans["grn_no"]);
}
function emp_detail($row){
return pager_link(_("View"),
		"/payroll/manage/emp_asset_detail.php?trans_no=" . $row["emp_code"], ICON_VIEW);
}

$sql = get_asset_app_inquiry($emp_id);
echo '<a href="javascript:window.print()" align="center">Print</a>';
$cols = array(
_("Trans No "),
_("Trans Date "),
_("Employee Code"),
_("Employee Name"), 
_("Designation"), 
_("Department"), 
_("GRN No")=>array('fun'=>'trans_view'),
_("Item"), 
_("Price"), 
_("Quantity"),  
array('view'=>true,'fun'=>'emp_detail'),
array('insert'=>true, 'fun'=>'edit_link'),
array('delete'=>true, 'fun'=>'delete_link'),


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