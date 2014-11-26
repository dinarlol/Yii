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
function update_item($stock_id, $description, $long_description, $category_id, 
	$tax_type_id, $units='',$asset_types='',$dep_rate='',$dep_type='',$dep_method='', $mb_flag='', $sales_account, $inventory_account, 
	$cogs_account, 	$adjustment_account, $assembly_account, $dimension_id, 
	$dimension2_id, $no_sale, $editable)
{
	$sql = "UPDATE ".TB_PREF."stock_master SET long_description=".db_escape($long_description).",
		description=".db_escape($description).",
		category_id=".db_escape($category_id).",
		asset_types=".db_escape($asset_types).",
		dep_rate=".db_escape($dep_rate).",
		dep_type=".db_escape($dep_type).",
		dep_method=".db_escape($dep_method).",
		sales_account=".db_escape($sales_account).",
		inventory_account=".db_escape($inventory_account).",
		cogs_account=".db_escape($cogs_account).",
		adjustment_account=".db_escape($adjustment_account).",
		assembly_account=".db_escape($assembly_account).",
		dimension_id=".db_escape($dimension_id).",
		dimension2_id=".db_escape($dimension2_id).",
		tax_type_id=".db_escape($tax_type_id).",
		no_sale=".db_escape($no_sale).",
		editable=".db_escape($editable);

	if ($units != '')
		$sql .= ", units='$units'";

	if ($mb_flag != '')
		$sql .= ", mb_flag='$mb_flag'";

	$sql .= " WHERE stock_id=".db_escape($stock_id);

	db_query($sql, "The item could not be updated");

	update_item_code(-1, $stock_id, $stock_id, $description, $category_id, 1, 0);
}




function update_grn_item($stock_id,$long_description,$dispose)
{
	$sql = "UPDATE ".TB_PREF."purch_order_details SET long_description=".db_escape($long_description).",
		dispose=".db_escape($dispose);

	
	$sql .= " WHERE item_code=".db_escape($stock_id);

	db_query($sql, "The item could not be updated");

	
}




function add_item($stock_id, $description, $long_description, $category_id, 
	$tax_type_id, $units,$asset_types,$dep_rate,$dep_type,$dep_method,$mb_flag,	$sales_account, $inventory_account, 
	$cogs_account, $adjustment_account,	$assembly_account, $dimension_id, 
	$dimension2_id, $no_sale, $editable)
{
	$sql = "INSERT INTO ".TB_PREF."stock_master (stock_id, description, long_description, category_id,
		tax_type_id, units,asset_types,dep_rate,dep_type,dep_method, mb_flag, sales_account, inventory_account, cogs_account,
		adjustment_account, assembly_account, dimension_id, dimension2_id, no_sale, editable)
		VALUES (".db_escape($stock_id).", ".db_escape($description).", ".db_escape($long_description).",
		".db_escape($category_id).", ".db_escape($tax_type_id).", "
		.db_escape($units).", ".db_escape($asset_types).", ".db_escape($dep_rate).", ".db_escape($dep_type).", ".db_escape($dep_method).", ".db_escape($mb_flag).",
		".db_escape($sales_account).", ".db_escape($inventory_account)
		.", ".db_escape($cogs_account).",".db_escape($adjustment_account)
		.", ".db_escape($assembly_account).", "
		.db_escape($dimension_id).", ".db_escape($dimension2_id).","
		.db_escape($no_sale).","
		.db_escape($editable).")";

	db_query($sql, "The item could not be added");

	$sql = "INSERT INTO ".TB_PREF."loc_stock (loc_code, stock_id)
		SELECT ".TB_PREF."locations.loc_code, ".db_escape($stock_id)
		." FROM ".TB_PREF."locations";

	db_query($sql, "The item locstock could not be added");

	add_item_code($stock_id, $stock_id, $description, $category_id, 1, 0);
}

function delete_item($stock_id)
{
	$sql="DELETE FROM ".TB_PREF."stock_master WHERE stock_id=".db_escape($stock_id);
	db_query($sql, "could not delete stock item");

	/*and cascade deletes in loc_stock */
	$sql ="DELETE FROM ".TB_PREF."loc_stock WHERE stock_id=".db_escape($stock_id);
	db_query($sql, "could not delete stock item loc stock");

	/*and cascade deletes in purch_data */
	$sql ="DELETE FROM ".TB_PREF."purch_data WHERE stock_id=".db_escape($stock_id);
	db_query($sql, "could not delete stock item purch data");

	/*and cascade deletes in prices */
	$sql ="DELETE FROM ".TB_PREF."prices WHERE stock_id=".db_escape($stock_id);
	db_query($sql, "could not delete stock item prices");

	/*and cascade delete the bill of material if any */
	$sql = "DELETE FROM ".TB_PREF."bom WHERE parent=".db_escape($stock_id);
	db_query($sql, "could not delete stock item bom");

//---------------grade
$sql="DELETE FROM ".TB_PREF."grade WHERE id=".db_escape($stock_id);
	db_query($sql, "could not delete stock item");

	delete_item_kit($stock_id);
}

function get_item($stock_id)
{
	$sql = "SELECT ".TB_PREF."stock_master.*,".TB_PREF."item_tax_types.name AS tax_type_name
		FROM ".TB_PREF."stock_master,".TB_PREF."item_tax_types
		WHERE ".TB_PREF."item_tax_types.id=".TB_PREF."stock_master.tax_type_id
		AND stock_id=".db_escape($stock_id);
	$result = db_query($sql,"an item could not be retreived");

	return db_fetch($result);
}





function get_items()
{
	$sql = "SELECT * FROM ".TB_PREF."stock_master";
	return db_query($sql,"items could not be retreived");
}

function item_in_foreign_codes($stock_id)
{
	$sqls=  array(
	"SELECT COUNT(*) FROM "
		.TB_PREF."stock_moves WHERE stock_id=".db_escape($stock_id) =>
	 _('Cannot delete this item because there are stock movements that refer to this item.'),
	"SELECT COUNT(*) FROM "
		.TB_PREF."bom WHERE component=".db_escape($stock_id)=>
	 _('Cannot delete this item record because there are bills of material that require this part as a component.'),
	"SELECT COUNT(*) FROM "
		.TB_PREF."sales_order_details WHERE stk_code=".db_escape($stock_id) =>
	 _('Cannot delete this item because there are existing purchase order items for it.'),
	"SELECT COUNT(*) FROM "
		.TB_PREF."purch_order_details WHERE item_code=".db_escape($stock_id)=>
	 _('Cannot delete this item because there are existing purchase order items for it.')
	);

	$msg = '';

	foreach($sqls as $sql=>$err) {
		$result = db_query($sql, "could not query stock usage");
		$myrow = db_fetch_row($result);
		if ($myrow[0] > 0) 
		{
			$msg = $err; break;
		}
	}
	if ($msg == '') {	

		$kits = get_where_used($stock_id);
		$num_kits = db_num_rows($kits);
		if ($num_kits) {
			$msg = _("This item cannot be deleted because some code aliases 
				or foreign codes was entered for it, or there are kits defined 
				using this item as component")
				.':<br>';

			while($num_kits--) {
				$kit = db_fetch($kits);
				$msg .= "'".$kit[0]."'";
				if ($num_kits) $msg .= ',';
			}

		}
	}
	return $msg;
}


//----------------------- Tehmina
function update_advert_code($stock_id,$acode,$description,$position,$new1,$new2,$new3,$website,$website1,$date_,$date1_,$gender,$minedu,$exp,$desig,$jobtype,$age1,$salary1,$travel,$joblocation,$long_specification)
{
	$sql = "UPDATE ".TB_PREF."advertisment SET
	 	
	 	description = ".db_escape($description).",
	 		noposition = ".db_escape($position).",
	 	news1 = ".db_escape($new1).",
	 	news2 = ".db_escape($new2).",
	 	news3 = ".db_escape($new3).",
		
		website = ".db_escape($website).",
	 	website1 = ".db_escape($website1).",
	 	doadvert = ".db_escape($date_).",
		doclosing = ".db_escape($date1_).",
	 	gender = ".db_escape($gender).",
	 	minedu = ".db_escape($minedu).",
			exp = ".db_escape($exp).",
			desig = ".db_escape($desig).",
	 	jobtype = ".db_escape($jobtype).",
		age1 = ".db_escape($age1).",
	 	salary1 = ".db_escape($salary1).",
	 	reqtravel = ".db_escape($travel).",
			location = ".db_escape($joblocation).",
			specification = ".db_escape($long_specification)."
		WHERE acode = ".db_escape($stock_id);

	db_query($sql,"an item code could not be updated");
}

function add_item_advert($NewStockID,$description,$position,$new1,$new2,$new3,$website,$website1,$date_,$date1_,$gender,$minedu,$exp,$desig,$jobtype,$age1,$salary1,$travel,$joblocation,$long_specification)
{
	
	 $sql = "INSERT INTO ".TB_PREF."advertisment (acode,description,noposition,news1,news2,news3,website,website1,doadvert,doclosing,gender,minedu,exp,desig,jobtype,age1,salary1,reqtravel,location,specification)
		VALUES (".db_escape($NewStockID).",".db_escape($description).",".db_escape($position).",".db_escape($new1).",".db_escape($new2).",".db_escape($new3).",".db_escape($website).",".db_escape($website1).",".db_escape($date_).",".db_escape($date1_).",".db_escape($gender).",".db_escape($minedu).",".db_escape($exp).",".db_escape($desig).",".db_escape($jobtype).",".db_escape($age1).",".db_escape($salary1).",".db_escape($travel).",".db_escape($joblocation).",".db_escape($long_specification).")";
        db_query($sql,"a grade could not be added");
}
//------------------Leave 

function update_leave_emp($stock_id,$category_id,$pl,$sl,$cl)
{
	
	$sql = "UPDATE ".TB_PREF."empleave SET
	 	
	 	grade = ".db_escape($category_id).",
	 		pl = ".db_escape($pl).",
	 	sl = ".db_escape($sl).",
	 	cl = ".db_escape($cl)."
	 	
		WHERE empid = ".db_escape($stock_id);

	db_query($sql,"an item code could not be updated");
}

function add_leave_emp($NewStockID,$category_id,$pl,$sl,$cl)
{ 
	
	 $sql = "INSERT INTO ".TB_PREF."empleave (empid,grade,pl,sl,cl)
		VALUES (".db_escape($NewStockID).",".db_escape($category_id).",".db_escape($pl).",".db_escape($sl).",".db_escape($cl).")";
        db_query($sql,"a grade could not be added");
}
function daysDifference($from_date, $to_date)
{

   //explode the date by "-" and storing to array
   $date_parts1=explode("-", $from_date);
   $date_parts2=explode("-", $to_date);
   //gregoriantojd() Converts a Gregorian date to Julian Day Count
   $start_date=gregoriantojd($date_parts1[1], $date_parts1[2], $date_parts1[0]);
   $end_date=gregoriantojd($date_parts2[1], $date_parts2[2], $date_parts2[0]);
   return $end_date - $start_date;
}
//---------------------LEAVE FORM ENTRY-------------------
function add_leave_form($stock_id,$NewStockID,$from_date,$to_date,$leave_type,$reason)
{
	$leave = (strtotime($to_date) - strtotime($from_date)) / (60 * 60 * 24);
		if ($leave >=1) {
		$sql2 = "SELECT *  FROM empleave e,emp em,grade g WHERE e.empid='$NewStockID' AND em.emp_code='$NewStockID' AND e.grade=g.id AND e.pl<=g.pl AND e.sl<=g.sl AND e.cl<=g.cl  AND $leave+e.pl<=g.pl AND $leave+e.sl<=g.sl AND $leave+e.cl<=g.cl AND em.confirm=1 ";
			
	
	$result5= db_query($sql2, "Could not retrieve bank trans");
//----------------------------------------------     
$leave = (strtotime($to_date) - strtotime($from_date)) / (60 * 60 * 24);
		$sql3 = "SELECT *  FROM emp em WHERE em.emp_code='$NewStockID' ";
			
	$result6= db_query($sql3, "Could not retrieve bank trans");
	if(mysql_num_rows($result6)== true || $leave_type=='WITHOUT PAY'){
			
	 $sql = "INSERT INTO ".TB_PREF."leave_table (emp_id,emp_code,from_date,to_date,leave_type,no_o_l,reason)
		VALUES (".db_escape($stock_id).",".db_escape($NewStockID).",".db_escape($from_date).",".db_escape($to_date).",".db_escape($leave_type).",".db_escape($leave).",".db_escape($reason).")";

        db_query($sql,"Leave could not be added");
		}
elseif(mysql_num_rows($result5)== false){
			$input_error = 1;
			display_error(_("No more Leaves available. $sql3"));
			set_focus($result5);
		}
		   else{

	
	 $sql = "INSERT INTO ".TB_PREF."leave_table (emp_id,emp_code,from_date,to_date,leave_type,no_o_l,reason)
		VALUES (".db_escape($stock_id).",".db_escape($NewStockID).",".db_escape($from_date).",".db_escape($to_date).",".db_escape($leave_type).",".db_escape($leave).",".db_escape($reason).")";

        db_query($sql,"Leave could not be added");
		
}}else{
	$input_error = 1;
			display_error(_("Leave not less then 0 days."));
			set_focus($result5);
	}
}

//----------------------------------Grade form

function update_grade_emp($stock_id,$pl,$sl,$cl)
{ $total=$pl+$sl+$cl;
	$sql = "UPDATE ".TB_PREF."grade SET
	 	
	 	
	 		pl = ".db_escape($pl).",
	 	sl = ".db_escape($sl).",
	 	cl = ".db_escape($cl).",
		total = ".db_escape($total)."
	 	
		WHERE id = ".db_escape($stock_id);

	db_query($sql,"an item code could not be updated");
}

function add_grade_emp($NewStockID,$pl,$sl,$cl)
{ $total=$pl+$sl+$cl;
	
	 $sql = "INSERT INTO ".TB_PREF."grade (grade,pl,sl,cl,total)
		VALUES (".db_escape($NewStockID).",".db_escape($pl).",".db_escape($sl).",".db_escape($cl).",".db_escape($total).")";
        db_query($sql,"a grade could not be added");
}

//---------------------
function get_search_expiredoc($emp_id)
{	
	$date = date2sql(Today());

	$dateFormated = split('-', $date);
$date = $dateFormated[1].'/'.$dateFormated[2].'/'.$dateFormated[0];
 
 $date222= date('Y-m-d',strtotime("+30 days")); 
$dateFormated2 = split('-', $date222);
$date333 = $dateFormated2[1].'/'.$dateFormated2[2].'/'.$dateFormated2[0];

$date = $dateFormated[1].'/'.$dateFormated[2].'/'.$dateFormated[0];
	$sql = "SELECT b.ap_id,b.name,a.doc_num,a.doc_type,a.trans_no,a.description
	FROM ".TB_PREF."uploadcv a, ".TB_PREF."emp b where a.doc_type!='CV' AND a.ap_id = b.ap_id ";
	
		if(($_POST['id']!='') &&($_POST['id']!='Expiry 30 days')){
			$sql .= " and doc_type=".db_escape($_POST['id'])."";
		} 
		
		if ($_POST['id']=='Expiry 30 days')
		{
		$sql .= " and trans_no >= '$date' AND
					trans_no  <= '$date333' ";
		}
		return $sql;

}	

//---------------------Leave  Report
function get_search_leave($emp_id)
{	
	$sql = "SELECT 
	dim.emp_id,
	e.name,
		dim.from_date,
		dim.to_date,
		dim.leave_type,
		dim.no_o_l,
		dim.reason
		FROM ".TB_PREF."leave_table as dim,".TB_PREF."emp as e WHERE dim.emp_id=e.emp_code AND dim.status!=0 ";
		
		
		
		if ($_POST['emp_id']!='')
		{
			$sql .= " AND dim.emp_id=".db_escape($_POST['emp_id']);
		}

		return $sql;
}	

function get_leave_balance($emp_id) 
{
	$id = db_escape($id);
	 $sql = "SELECT * FROM ".TB_PREF."leave_table as dim,".TB_PREF."emp as e WHERE dim.emp_id=e.id  AND dim.emp_id ='005010'";
	$res = db_query($sql, "Sum of transactions could not be calculated");
	$row = db_fetch_row($res);

	return $row[0];
}
//----------------------Advertise Report

function get_search_advert($advid)
{	
	$sql = "SELECT dim.advid,
	dim.acode,
	dim.description,
		dim.noposition,
		dim.doadvert,
		dim.doclosing,
		s.salary,
		dim.specification
		FROM ".TB_PREF."advertisment as dim,".TB_PREF."tblsalary as s WHERE dim.salary1=s.id";
		
		
		
		
		if (isset($_POST['advid']))
		{
			$sql .= " AND acode=".db_escape($_POST['advid']);
		}

		return $sql;
}	

function get_advert_balance($advid) 
{
	$id = db_escape($id);
	echo $sql = "SELECT * FROM ".TB_PREF."advertisment WHERE advid =$advid";
	$res = db_query($sql, "Sum of transactions could not be calculated");
	$row = db_fetch_row($res);

	return $row[0];
}
function get_advert($id, $allow_null=false)
{
    $sql = "SELECT * FROM ".TB_PREF."advertisment a,".TB_PREF."tblsalary as s,".TB_PREF."location as l,".TB_PREF."gender as g,".TB_PREF."qualif as q,".TB_PREF."tbltravel as t,".TB_PREF."jobtype as j,".TB_PREF."tblage as ag	WHERE s.id=a.salary1 AND ag.id=a.age1 AND t.id=a.reqtravel AND l.id=a.location AND j.id=a.jobtype AND q.id=a.minedu AND a.advid=".db_escape($id);

	$result = db_query($sql, "The Advertise could not be retrieved");

	if (!$allow_null && db_num_rows($result) == 0)
		display_db_error("Could not find Advertise $id", $sql);

	return db_fetch($result);
}
//--------------------Leave inquiry


function get_search_emp_leave($emp_id)
{	
	$sql = "SELECT 
	dim.empid,
	s.name,
		g.grade,
		dim.pl,
		g.pl-dim.pl as pl1,
		dim.sl,
		g.sl-dim.sl as sl1,
		dim.cl,
		g.cl-dim.cl as cl1,
		g.total,
		g.total-(dim.pl+dim.sl+dim.cl) 
		
		FROM ".TB_PREF."empleave as dim,".TB_PREF."emp as s,".TB_PREF."grade as g WHERE dim.empid=s.emp_code AND dim.grade=g.id";
		
		
		
		
		if (isset($_POST['emp_id']))
		{
			$sql .= " AND empid=".db_escape($_POST['emp_id']);
		}

		return $sql;
}	




function get_emp_leave_balance($emp_id) 
{
	$id = db_escape($id);
	echo $sql = "SELECT * FROM ".TB_PREF."empleave as dim,".TB_PREF."emp as s,".TB_PREF."grade as g WHERE dim.empid=s.id AND dim.grade=g.id AND dim.empid =$emp_id";
	$res = db_query($sql, "Sum of transactions could not be calculated");
	$row = db_fetch_row($res);

	return $row[0];
}
//-----------------------Hr Leave Inquiry

function get_aprove_hr_leave($id)
{	
	$sql = "SELECT 
	dim.id,
	dim.emp_code,
	s.name,
	g.grade,
	dim.from_date,
	dim.to_date,
		dim.leave_type,
		dim.no_o_l,
		dim.reason
		
		
	
		
		FROM ".TB_PREF."leave_table as dim,".TB_PREF."emp as s,".TB_PREF."grade as g WHERE dim.emp_id=s.emp_code AND s.grade=g.id AND dim.status='0' and dim.no_o_l !='0'";
		
		
		
		
		
		return $sql;
}	

function get_hr_leave_balance($id) 
{
	$id = db_escape($id);
	$sql = "SELECT * FROM ".TB_PREF."leave_table as dim,".TB_PREF."emp as s,".TB_PREF."grade as g WHERE dim.emp_id=s.emp_code AND dim.grade=g.id AND dim.status='0' AND dim.emp_id =$id";
	$res = db_query($sql, "Sum of transactions could not be calculated");
	$row = db_fetch_row($res);

	return $row[0];
}

function get_hr_leave_aprove($id, $allow_null=false)
{
    $sql = "SELECT * FROM ".TB_PREF."leave_table l,".TB_PREF."emp e WHERE e.emp_code=l.emp_id AND l.id=".db_escape($id);

	$result = db_query($sql, "The EMPLOY could not be retrieved");

	if (!$allow_null && db_num_rows($result) == 0)
		display_db_error("Could not find EMPLOY $id", $sql);

	return db_fetch($result);
	
	
}

function update_hr_leave_aprove($selected_id,$emp_id,$from_date,$to_date,$leave_type,$status){
	
	
	$leave = (strtotime($to_date) - strtotime($from_date)) / (60 * 60 * 24);
	
	/*
	
	$sql = "SELECT *  FROM empleave WHERE empid='$emp_id' ";
	
	$result= db_query($sql, "Could not retrieve bank trans");
	
	if(mysql_num_rows($result)== false){
	$pl=0;$sl=0;$cl=0;
	
	if(strtolower($leave_type) == 'pl'){
	$pl = $leave;
	}
	else if(strtolower($leave_type) == 'sl'){
	$sl = $leave;
	}
	else if(strtolower($leave_type) == 'cl'){
	$cl = $leave;
	}

	$sql = "SELECT 
		grade 
		FROM ".TB_PREF."emp"." WHERE  emp_code='$emp_id'";
	$resultg = db_query($sql,"Leave  Setup could not be retrieved");
	$myrowg = mysql_fetch_array($resultg);

	$grade = $myrowg['grade'];
	
	$sql = "INSERT INTO ".TB_PREF."empleave(empid,grade,pl,cl,sl) VALUES ('$emp_id','$grade',$pl,$sl,$cl)";
	
	db_query($sql, "Could not Add leave ");
	
		$sql = "UPDATE ".TB_PREF."leave_table SET
	 		 		status =".db_escape($status)."
					
	 	 	WHERE id = ".db_escape($selected_id);
	db_query($sql,"an item code could not be updated");
		
	
	return;
	
	}
	*/
	
	$sql2 = "SELECT *  FROM empleave e,grade g WHERE e.empid='$emp_id' AND e.grade=g.id AND e.pl<=g.pl AND e.sl<=g.sl AND e.cl<=g.cl  AND $leave+e.pl<=g.pl AND $leave+e.sl<=g.sl AND $leave+e.cl<=g.cl";
			
	$result5= db_query($sql2, "Could not retrieve bank trans");
//echo $sql2;
	
		if(mysql_num_rows($result5)== false){
			$input_error = 1;
			display_error(_("No more Leaves available."));
			set_focus($result5);
		}
		   else{

	$sql = "UPDATE ".TB_PREF."leave_table SET
	 		 		status =".db_escape($status)."
					
	 	 	WHERE id = ".db_escape($selected_id);
	db_query($sql,"an item code could not be updated");
		
		 $sql2 = "SELECT *  FROM grade,emp where emp.id='$emp_id' AND emp.grade=grade.id";
$resultg = db_query($sql2, "Could not retrieve bank trans");
			$row = db_fetch_row($resultg);

			  //$leave = (strtotime($_POST['to_date']) - strtotime($_POST['from_date'])) / (60 * 60 * 24);
		
		if($leave_type=='PL'){
			  $sql2 = "SELECT  pl FROM empleave WHERE empid='$emp_id' AND grade='$gid'";
	$resulte = db_query($sql2, "Could not retrieve bank trans");
			$row1 = db_fetch_row($resulte);
				
				 $sql = "UPDATE ".TB_PREF."empleave SET
	 		 		pl = pl + ".db_escape($leave)."
					
	 	 	WHERE empid = ".db_escape($emp_id);
	db_query($sql,"an item code could not be updated");
		}
		elseif($leave_type=='SL'){
			 $sql2 = "SELECT sl FROM empleave WHERE empid='$emp_id' AND grade='$gid'";
	$resulte = db_query($sql2, "Could not retrieve bank trans");
			$row1 = db_fetch_row($resulte);
				//$sl=$row1[3]+ $leave;
			$sql = "UPDATE ".TB_PREF."empleave SET
	 		 		sl = sl +".db_escape($leave)."
	 	 	WHERE empid = ".db_escape($emp_id);
	db_query($sql,"an item code could not be updated");
		}
	elseif($leave_type=='CL'){
		 $sql2 = "SELECT max(cl) as cl FROM empleave WHERE empid='$emp_id' AND grade='$gid'";
	$resulte = db_query($sql2, "Could not retrieve bank trans");
			$row1 = db_fetch_row($resulte);
				// $cl=$row1[4] + $leave;
				 $sql = "UPDATE ".TB_PREF."empleave SET
	 		 		cl = cl +".db_escape($leave)."
	 	 	WHERE empid = ".db_escape($emp_id);
	db_query($sql,"an item code could not be updated");
		}
	
}
	
	
	
}
function add_item_transfer($order_no, $item_code, $location, 
	$quantity_received,$long_description,$date_)
{
	
			
	
		
	
$sql1 = "UPDATE ".TB_PREF."purch_orders SET into_stock_location = ".db_escape($location)." WHERE order_no='$order_no'";
		db_query($sql1,"Transfer could not be updated");

	
	
	$sql = "INSERT INTO ".TB_PREF."transfer_item (order_no, item_code,
			location,quantity_received,long_description,date_)
		VALUES ("
		.db_escape($order_no).","
		.db_escape($item_code).","
		.db_escape($location).","
		.db_escape($quantity_received).","
		.db_escape($long_description).","
		.db_escape($date_).
		")";

	db_query($sql,"an item category could not be added");
	
	
}

function add_item_disposed($order_no,$item_code, $into_stock_location, 
	$quantity,$unit_price,$salvage_value,$date_,$long_description)
	
{
	$sql = "SELECT quantity_received FROM purch_order_details WHERE order_no=".db_escape($order_no);
	
	$result = db_query($sql, "Could not retrieve bank trans");
			$row = db_fetch_row($result);
			
			$type_no1=$row[0];
			
	$type_no= $type_no1 - $quantity;	
		
	$sql = "UPDATE ".TB_PREF."stock_master SET asset_types=0 WHERE stock_id = " .db_escape($item_code);
	db_query($sql,"The  term could not be updated");
	
$sql1 = "UPDATE ".TB_PREF."purch_order_details SET quantity_received = ".db_escape($type_no)." WHERE order_no='$order_no'";
		db_query($sql1,"Transfer could not be updated");
	
	$sql = "INSERT INTO ".TB_PREF."dispose_item (order_no,item_code,
			location,quantity_received,unit_price,salvage_value,date_,long_description)
		VALUES ("
		.db_escape($order_no).",".db_escape($item_code).","
		.db_escape($into_stock_location).","
		.db_escape($quantity).","
		.db_escape($unit_price).","
		.db_escape($salvage_value).","
		
		.db_escape($date_).","
		.db_escape($long_description).
		")";

	db_query($sql,"an item category could not be added");
	
	
	
	
			
	      
	
	$sql = "UPDATE ".TB_PREF." purch_order_details SET dispose=1 WHERE order_no = " .db_escape($order_no);
	db_query($sql,"The  term could not be updated");
}



function add_item_dispose($order_no, $item_code, $into_stock_location, 
	$quantity_received,$description)
{
	$sql = "INSERT INTO ".TB_PREF."dispose_item (order_no, item_code,
			location,quantity_received,description)
		VALUES ("
		.db_escape($order_no).","
		.db_escape($item_code).","
		.db_escape($into_stock_location).","
		.db_escape($quantity_received).","
		.db_escape($description).
		")";

	db_query($sql,"an item category could not be added");
}

function update_item_transfer($selected_id, $order_no, $item_code, 
	$location, $quantity_received, $long_description,$date_)

{ 




/*$sql = "SELECT quantity_received FROM purch_order_details WHERE order_no=".db_escape($order_no);
	echo $sql; 
	$result = db_query($sql, "Could not retrieve bank trans");
			$row = db_fetch_row($result);
			
			$type_no1=$row[0];
			
	$type_no= $type_no1 - 1;	*/
		
	
$sql1 = "UPDATE ".TB_PREF."purch_orders SET into_stock_location	 = ".db_escape($location)." WHERE order_no='$order_no'";
		db_query($sql1,"Transfer could not be updated");
	$sql = "UPDATE ".TB_PREF."transfer_item SET "
		."location = ".db_escape($location).","
		."long_description = ".db_escape($long_description).","
		."date_ = ".db_escape($date_)." WHERE id = '$selected_id'";
	db_query($sql,"Transfer could not be updated");

	




	
}

function update_item_disposs($selected_id, $item_code, 
	$location, $quantity_received, $long_description)

{
	$sql = "UPDATE ".TB_PREF."dispose_item SET "
		
		."item_code = ".db_escape($item_code).","
		."location = ".db_escape($location).","
		."quantity_received = ".db_escape($quantity_received).","
		."long_description = ".db_escape($long_description)."WHERE id = '$selected_id'";

	db_query($sql,"Transfer could not be updated");
}
//-------------------
function delete_item_transfer($id)
{
	$sql="DELETE FROM ".TB_PREF."transfer_item WHERE id=".db_escape($id);

	db_query($sql,"Transfered Item could not be deleted");
}

function delete_item_disposs($id)
{
	$sql="DELETE FROM ".TB_PREF."dispose_item WHERE id=".db_escape($id);

	db_query($sql,"Item could not be deleted");
}

function delete_sale_delete($id)
{
	$sql="DELETE FROM ".TB_PREF."assetsale WHERE id=".db_escape($id);

	db_query($sql,"Item could not be deleted");
}

function delete_fixedasset_item($id)
{
	$sql="DELETE FROM ".TB_PREF."stock_master WHERE stock_id=".db_escape($id);

	db_query($sql,"Item could not be deleted");
	$sql="DELETE FROM ".TB_PREF."item_codes WHERE item_code=".db_escape($id);

	db_query($sql,"Item could not be deleted");
}



//-------------------------------
function get_order_code($order_no)
{
	$sql="SELECT * FROM ".TB_PREF." purch_order_details p,".TB_PREF." stock_master s WHERE p.item_code=s.stock_id AND order_no=".db_escape($order_no);

	$result = db_query($sql,"item code could not be retrieved");

	return db_fetch($result);
}
function get_dispose_item_code($stock_id)
{
	$sql="SELECT * FROM ".TB_PREF." stock_master s,".TB_PREF." purch_order_details p WHERE s stock_id=".db_escape($stock_id)."AND s.stock_id=p.item_code";

	$result = db_query($sql,"item code could not be retrieved");

	return db_fetch($result);
}




function get_order_props($order_no)
{
	$sql = "SELECT *
		FROM ".TB_PREF."purch_order_details,".TB_PREF."purch_orders,".TB_PREF."locations
		WHERE purch_order_details.order_no=".db_escape($order_no)." AND purch_orders.order_no=".db_escape($order_no)." AND purch_orders.into_stock_location=locations.loc_code";
	$res = db_query($sql, "kit name query failed");
	return db_fetch($res);
}


function get_ab_props($item_code)
{
	$sql = "SELECT *
		FROM ".TB_PREF."purch_order_details,".TB_PREF."purch_orders,".TB_PREF."locations
		WHERE purch_order_details.item_code=".db_escape($item_code)." AND purch_orders.order_no=purch_order_details.order_no AND purch_orders.into_stock_location=locations.loc_code";
	$res = db_query($sql, "kit name query failed");
	return db_fetch($res);
}


function get_transfer2_props($stock_id)
{
	$sql = "SELECT *
		FROM ".TB_PREF."purch_order_details,".TB_PREF."stock_master
		WHERE stock_master.stock_id=".db_escape($stock_id)." AND purch_order_details.item_code=stock_master.stock_id AND stock_master.asset_types=0";
	$res = db_query($sql, "kit name query failed");
	return db_fetch($res);
}

function get_item_transfer($show_inactive)
{
	$sql = "SELECT * FROM ".TB_PREF."transfer_item,".TB_PREF."locations,".TB_PREF."purch_order_details WHERE transfer_item.location=locations.loc_code AND transfer_item.item_code=purch_order_details.item_code";
	

	return db_query($sql, "could not get Transfered Order Record");
}

function get_item_disposed($show_inactive)
{
	$sql = "SELECT *  FROM ".TB_PREF."dispose_item,".TB_PREF."locations,".TB_PREF."stock_master,".TB_PREF."purch_orders,".TB_PREF."suppliers WHERE dispose_item.location=locations.location_name AND dispose_item.item_code=stock_master.stock_id AND  purch_orders.order_no=dispose_item.order_no AND purch_orders.supplier_id=suppliers.supplier_id";
	

	return db_query($sql, "could not get Transfered Order Record");
}


function get_sales_report($show_inactive)
{
	$sql = "SELECT *  FROM ".TB_PREF."assetsale,".TB_PREF."stock_master,".TB_PREF."purch_orders,".TB_PREF."suppliers WHERE assetsale.item_code=stock_master.stock_id AND purch_orders.order_no=assetsale.orderno AND purch_orders.supplier_id=suppliers.supplier_id ";
		return db_query($sql, "could not get Transfered Order Record");
}

function get_stock_report($show_inactive)
{
	$sql = "SELECT stock_master.stock_id as id,stock_category.description as category,stock_master.description,stock_master.units,stock_master.dep_rate,stock_master.dep_method,stock_master.long_description,item_units.name,item_units.abbr FROM ".TB_PREF."stock_master,".TB_PREF."stock_category,".TB_PREF."item_units WHERE stock_master.category_id=stock_category.category_id and stock_master.units= item_units.abbr And stock_master.asset_types=1";
	
	return db_query($sql, "could not get Transfered Order Record");
}


function get_order_transfer($id)
{
	$sql="SELECT * FROM ".TB_PREF."transfer_item,".TB_PREF."locations WHERE transfer_item.location=locations.loc_code AND id=".db_escape($id);
	
	
	
$result = db_query($sql,"could not get Transfered Order Record");
return db_fetch($result);

}

function get_item_disposs($id)
{
	$sql="SELECT * FROM ".TB_PREF."dispose_item,".TB_PREF."locations,".TB_PREF."stock_master WHERE dispose_item.location=locations.location_name AND dispose_item.item_code=stock_master.stock_id AND id=".db_escape($id);
	
	
	
$result = db_query($sql,"could not get Transfered Order Record");
return db_fetch($result);

}

function get_grade_category($id)
{
	$sql="SELECT * FROM ".TB_PREF."grade WHERE id=".db_escape($id);

	$result = db_query($sql,"an item category could not be retrieved");

	return db_fetch($result);
}

function get_dep_type($id)
{
	$sql="SELECT * FROM ".TB_PREF."dep_types WHERE  id=".db_escape($id);

	$result = db_query($sql,"an item category could not be retrieved");

	return db_fetch($result);
}
//-------------------------

function get_order_edit_info($order_no)
{
	$sql = "SELECT purch_order_details.item_code,stock_master.category_id,stock_master.dep_rate,stock_master.dep_method,purch_order_details.description,purch_order_details.order_no,purch_order_details.unit_price,purch_order_details.delivery_date,purch_order_details.quantity_received,purch_orders.into_stock_location,locations.location_name	
		FROM ".TB_PREF."stock_master,".TB_PREF."stock_category,".TB_PREF."purch_order_details,".TB_PREF."purch_orders,".TB_PREF."locations
		WHERE purch_order_details.order_no=".db_escape($order_no)." AND purch_orders.order_no=".db_escape($order_no)." AND purch_orders.into_stock_location=locations.loc_code AND purch_order_details.order_no=purch_orders.order_no AND stock_master.category_id=stock_category.category_id ";
	$res1 = db_query($sql, "The standard cost cannot be retrieved");

	return db_fetch($res1);
}



function get_ab_edit_info($item_code)
{
	$sql = "SELECT purch_order_details.item_code,purch_order_details.quantity_received,purch_orders.into_stock_location,locations.location_name	
		FROM ".TB_PREF."stock_master,".TB_PREF."purch_order_details,".TB_PREF."purch_orders,".TB_PREF."locations
		WHERE purch_order_details.item_code=".db_escape($item_code)." AND purch_orders.into_stock_location=locations.loc_code AND purch_order_details.order_no=purch_orders.order_no";
	$res1 = db_query($sql, "The standard cost cannot be retrieved");

	return db_fetch($res1);
}


function get_price_edit_info($stock_id)
{
	$sql = "SELECT purch_order_details.item_code,purch_order_details.unit_price,purch_order_details.quantity_ordered,purch_order_details.delivery_date,purch_orders.into_stock_location	
		FROM ".TB_PREF."stock_master,".TB_PREF."purch_order_details,".TB_PREF."purch_orders,".TB_PREF."locations
		WHERE stock_id=".db_escape($stock_id)." AND purch_order_details.order_no=purch_orders.order_no"
		." AND ".TB_PREF."stock_master.stock_id=".TB_PREF."purch_order_details.item_code";
	$result = db_query($sql, "The standard cost cannot be retrieved");

	return db_fetch($result);
}
//------------------------Training Form
function  add_training_form($stock_id,$app_date,$id,$l_type,$reason)
{     

$sql = "UPDATE ".TB_PREF."training_req SET
	 		 	
					app_date =".db_escape($app_date).",
					type_o_t =".db_escape($l_type).",
					reason =".db_escape($reason)."
					
					
					
	 	 	WHERE emp_id = ".db_escape($stock_id);
		  db_query($sql,"a Training could not be added");
		
	
	 $sql = "INSERT INTO ".TB_PREF."training_req(emp_id,app_date,type_o_t,reason)
		VALUES (".db_escape($stock_id).",".db_escape($app_date).",".db_escape($l_type).",".db_escape($reason).")";

        db_query($sql,"a Training could not be added");
		
		/*	$sql = "INSERT INTO ".TB_PREF."loan_table(id,emp_id,amount_apply)
		VALUES (".db_escape($id).",".db_escape($stock_id).",".db_escape($l_amount).")";
 db_query($sql,"a grade could not be added");*/
  

}
//------------------------Loan Form
function add_loan_form($stock_id,$app_date,$id,$l_type,$l_amount,$reason)
{     
global $sql_trail, $db_last_inserted_id;
$sqltrail = $sql_trail;

$sql_trail = true;

			$sql = "INSERT INTO ".TB_PREF."loan_table(emp_id,amount_apply)
		VALUES (".db_escape($stock_id).",".db_escape($l_amount).")";
 db_query($sql,"a grade could not be added");


$sql = "INSERT INTO ".TB_PREF."loan_req(id,emp_id,app_date,type_o_l,l_amount,reason)
		VALUES (".db_escape($db_last_inserted_id).",".db_escape($stock_id).",".db_escape($app_date).",".db_escape($l_type).",".db_escape($l_amount).",".db_escape($reason).")";

        db_query($sql,"a grade could not be added");
	
$sql_trail = $sqltrail;
  

}

function update_loan_form($stock_id,$app_date,$id,$l_type,$l_amount,$reason)
{     

$sql = "UPDATE ".TB_PREF."loan_req SET
	 		 	
					app_date =".db_escape($app_date).",
					l_amount =".db_escape($l_amount).",
					type_o_l =".db_escape($l_type).",
					reason =".db_escape($reason)."
					
					
					
	 	 	WHERE emp_id = ".db_escape($stock_id);
		  db_query($sql,"a grade could not be added");
		$sql = "INSERT INTO ".TB_PREF."loan_table(emp_id,amount_apply)
		VALUES (".db_escape($stock_id).",".db_escape($l_amount).")";
 db_query($sql,"a grade could not be added");
  

}

function add_emp_equip($id,$emp_code,$emp_name,$app_date,$designation,$deptname,$order_no,$description,$item_code,$delivery_date,$unit_price,$quantity)  		

{     


		
			 $sql = "INSERT INTO emp_equip(id,trans_date,emp_code,emp_name,dept,desig,grn_no,item,item_code,delivery_date,unit_price,quantity)
		VALUES (".db_escape($id).",".db_escape($app_date).",".db_escape($emp_code).",".db_escape($emp_name).",".db_escape($deptname).",".db_escape($designation).",".db_escape($order_no).",".db_escape($description).",".db_escape($item_code).",".db_escape($delivery_date).",".db_escape($unit_price).",".db_escape($quantity).")";
 db_query($sql,"a record could not be added");

}
function update_emp_equip($selected_id1,$app_date,$order_no,$description,$item_code,$delivery_date,$unit_price,$quantity)  		

{     


 $sql = "UPDATE ".TB_PREF."emp_equip SET
	 		 		trans_date =".db_escape($app_date).",
					grn_no =".db_escape($order_no).",
					item =".db_escape($description).",
					item_code =".db_escape($item_code).",
					delivery_date =".db_escape($delivery_date).",
						unit_price =".db_escape($unit_price).",
						quantity =".db_escape($quantity)."
					
					
					
	 	 	WHERE id = ".db_escape($selected_id1);
		  db_query($sql,"a grade could not be added");
	
;

}

//------------------------------Training report
function get_aprove_hr_training($id)
{	
	$sql = "SELECT 
	dim.id,
	dim.emp_id,
	e.name,
	s.t_type,
	g.grade,
	dim.app_date,
	dim.reason
		
		FROM ".TB_PREF."training_req as dim,".TB_PREF."training_type as s,".TB_PREF."grade as g,".TB_PREF."emp as e WHERE dim.type_o_t=s.id AND dim.emp_id=e.emp_code AND  e.grade=g.id and dim.status !=1";
		
		
		
		
		
		/*if (isset($_POST['id']))
		{
			$sql .= " AND emp_id=".db_escape($_POST['id']);
		}*/

		return $sql;
}

function get_aprove_hr_training2($id)
{	
	$sql = "SELECT 
	dim.id,
	dim.emp_id,
	e.name,
	s.t_type,
	dim.app_date,
	dim.approv_date,
	dim.reason
		
		FROM ".TB_PREF."training_req as dim,".TB_PREF."training_type as s,".TB_PREF."grade as g,".TB_PREF."emp as e WHERE dim.type_o_t=s.id AND dim.emp_id=e.emp_code AND  e.grade=g.id and dim.status =1";
		
		
		
		echo $_POST['id'];
		
		/*if (($_POST['id']!=""))  && (($_POST['l_type']!="")))
		{
			$sql .= " and dim.type_o_t=".$_POST['l_type']." AND emp_id=".db_escape($_POST['id']);
		}
		elseif (isset($_POST['id'])){
			$sql .= " and emp_id=".db_escape($_POST['id']);
		} elseif (isset($_POST['l_type'])){
		
			$sql .= " and dim.type_o_t=".$_POST['l_type'];
		}*/
		if ($_POST['id']!=''){
			$sql .= " and emp_id=".db_escape($_POST['id']);
		}
		return $sql;
}

//------------------------------Loan aprovment process


function get_aprove_hr_loan($id= null)
{	
	$sql = "SELECT 
	lt.id,
	dim.emp_id,
	e.name,
	s.l_type,
	g.grade,
	dim.app_date,
		dim.reason
		
		
	
		
		FROM ".TB_PREF."loan_req as dim,".TB_PREF."loan_table as lt,".TB_PREF."loan_type as s,".TB_PREF."grade as g,".TB_PREF."emp as e WHERE dim.status=0 AND dim.type_o_l=s.id AND dim.emp_id=e.emp_code AND dim.emp_id=lt.emp_id AND dim.id=lt.id AND e.grade=g.id ";
		
		
		
		
		/*if (isset($id))
		{
			$sql .= " AND emp_id=".db_escape($_POST['id']);
		}*/

		return $sql;
}
function get_hr_training_aprove($id, $allow_null=false)
{
    $sql = "SELECT l.id,l.emp_id,l.app_date,emp.name,e.t_type,l.reason,l.status  
			FROM  ".TB_PREF."training_req l,".TB_PREF."training_type e,".TB_PREF."emp emp 
			WHERE e.id=l.type_o_t AND emp.emp_code=l.emp_id AND l.id=".db_escape($id);

	$result = db_query($sql, "The EMPLOY could not be retrieved");

	if (!$allow_null && db_num_rows($result) == 0)
		display_db_error("Could not find EMPLOY $id", $sql);

	return db_fetch($result);
	
	
}
	
function update_hr_training_aprove($selected_id,$NewStockID,$approv_date,$status){
	$monthly_ins	=$a_l_amount/$n_o_m;
$sql = "UPDATE ".TB_PREF."training_req SET
	 		 		status =".db_escape($status).",
					approv_date =".db_escape($approv_date)."
			
	 	 	WHERE emp_id = ".db_escape($NewStockID);
	db_query($sql," Training code could not be updated");
	
	
	
 /*$sql = "UPDATE ".TB_PREF."loan_table SET
	 		 		amount_apply =".db_escape($l_amount).",
					amount_aprov =".db_escape($a_l_amount).",
					monthly_ins	 =".db_escape($monthly_ins	).",
					recov_amount=0,
					status=".db_escape($status)."
					 	 	WHERE id = ".db_escape($selected_id);
	db_query($sql,"an item code could not be updated");*/

}

//-------------------loan search report

function get_aprove_hr_training1($id)
{	
	/*$sql = "SELECT 
	dim.id,
	dim.emp_id,
	e.name,
	s.l_type,
	g.grade,
	dim.app_date,
		dim.reason
			
		FROM ".TB_PREF."loan_req as dim,".TB_PREF."loan_type as s,".TB_PREF."grade as g,".TB_PREF."emp as e WHERE dim.type_o_l=s.id AND dim.emp_id=e.emp_code AND e.grade=g.id AND dim.status='1'";*/
		$sql = "SELECT l.id,l.emp_id,emp.name,e.t_type,l.app_date,l.reason 
			FROM  ".TB_PREF."training_req l,".TB_PREF."training_type e,".TB_PREF."emp emp
			WHERE e.id=l.type_o_t AND emp.emp_code=l.emp_id  ";
		//and l.status=1
		
		
		
		if ($_POST['id']!='')
		{
			$sql .= " AND emp_id=".db_escape($_POST['id']);
		}

		return $sql;
}	

function get_hr_loan_balance($id) 
{
	$id = db_escape($id);
	echo $sql = "SELECT * FROM ".TB_PREF."loan_req as dim,".TB_PREF."loan_type as s,".TB_PREF."grade as g,".TB_PREF."emp as e WHERE dim.type_o_l=s.id AND dim.emp_id=e.emp_code AND e.grade=g.id AND dim.status='0' AND dim.emp_id =$id";
	$res = db_query($sql, "Sum of transactions could not be calculated");
	$row = db_fetch_row($res);

	return $row[0];
}





function get_hr_loan_aprove($id, $allow_null=false)
{
    $sql = "SELECT lt.id,l.emp_id,l.app_date,emp.name,e.l_type,l.rec_amount,lt.amount_apply,l.a_l_amount,l.reason FROM ".TB_PREF."loan_table lt,".TB_PREF."loan_req l,".TB_PREF."loan_type e,".TB_PREF."emp emp WHERE e.id=l.type_o_l AND lt.emp_id=l.emp_id AND emp.emp_code=l.emp_id AND   lt.id=".db_escape($id);

	$result = db_query($sql, "The EMPLOY could not be retrieved");

	if (!$allow_null && db_num_rows($result) == 0)
		display_db_error("Could not find EMPLOY $id", $sql);

	return db_fetch($result);
	
	
}






function update_hr_loan_aprove($selected_id,$NewStockID,$l_amount,$a_l_amount,$n_o_m,$approv_date,$status){
	$monthly_ins	=$a_l_amount/$n_o_m;
$sql = "UPDATE ".TB_PREF."loan_req SET
	 		 		status =".db_escape($status).",
					approv_date =".db_escape($approv_date).",
					a_l_amount =".db_escape($a_l_amount).",
					n_o_m =".db_escape($n_o_m).",
					monthly_ins	 =".db_escape($monthly_ins	)."
					
					
	 	 	WHERE emp_id = ".db_escape($NewStockID);
	db_query($sql,"an item code could not be updated");
	
	
	
 $sql = "UPDATE ".TB_PREF."loan_table SET
	 		 		amount_apply =".db_escape($l_amount).",
					amount_aprov =".db_escape($a_l_amount).",
					monthly_ins	 =".db_escape($monthly_ins	).",
					recov_amount=0,
					status=".db_escape($status)."
					 	 	WHERE id = ".db_escape($selected_id);
	db_query($sql,"an item code could not be updated");

}
//-------------------loan search report

function get_aprove_hr_loan1($id)
{	
	//dim.id as dim_id,
	//dim.emp_id,
	$sql = "SELECT 
	loan_table.id as id,
	e.emp_code,
	e.name,
	s.l_type,
	g.grade,
	dim.app_date,
	dim.reason
		
		FROM loan_table, loan_req as dim, loan_type as s, grade as g, emp as e WHERE dim.type_o_l=s.id AND loan_table.emp_id=e.emp_code and dim.emp_id=e.emp_code AND e.grade=g.id AND dim.status='1'";
		
		if ($_POST['id'] != '')
		{
			$sql .= " AND dim.emp_id=".db_escape($_POST['id']);
		}
	$sql .= " group by loan_table.id  ";
	#echo $sql;
		return $sql;
}	

function get_hr_loan1_balance($id) 
{
	$id = db_escape($id);
	echo $sql = "SELECT * FROM ".TB_PREF."loan_req as dim,".TB_PREF."loan_type as s,".TB_PREF."grade as g,".TB_PREF."emp as e WHERE dim.type_o_l=s.id AND dim.emp_id=e.emp_code AND e.grade=g.id AND dim.status='1' AND dim.emp_id=$id";
	$res = db_query($sql, "Sum of transactions could not be calculated");
	$row = db_fetch_row($res);

	return $row[0];
}

//--------------------------------------Straight Line


function get_straight_line($id)
{	
	$sql = "SELECT 
	s.dep_rate,su.curr_code,s.dep_type,s.stock_id,p.item_code,p.act_price,p.unit_price,p.quantity_ordered,p.delivery_date,p.description
		FROM ".TB_PREF."stock_master as s, ".TB_PREF."purch_order_details as p, ".TB_PREF."purch_orders as o, ".TB_PREF." suppliers as su
		WHERE s.stock_id = p.item_code AND s.asset_types = 1 AND p.order_no=o.order_no AND o.supplier_id=su.supplier_id AND p.dispose=0 AND p.quantity_received > 0";
		
		
		
		
		/*if (isset($_POST['id']))
		{
			$sql .= " AND emp_id=".db_escape($_POST['id']);
		}
*/
		return $sql;
}










function get_straight_line_balance($id) 
{
	$id = db_escape($id);
	echo $sql = "SELECT 
		FROM ".TB_PREF."stock_master as s, ".TB_PREF."purch_order_details as p, ".TB_PREF."purch_orders as o, ".TB_PREF." suppliers as su
		WHERE s.stock_id = p.item_code AND s.asset_types = 1 AND p.order_no=o.order_no AND o.supplier_id=su.supplier_id AND p.dispose=0 AND p.quantity_received > 0 And s.stock_id =$id";
	$res = db_query($sql, "Sum of transactions could not be calculated");
	$row = db_fetch_row($res);

	return $row[0];
}
//--------------------------Advance Salary Form
function adv_salary_form($stock_id,$app_date,$id,$reason)
{     
 $sql1="Select * from adv_salary where emp_id='$stock_id'";
$resulta = db_query($sql1,"Advertisment Setup could not be retrieved");
	$myrow = mysql_fetch_array($resulta);
	
 $date1 = substr($app_date,0,2);
 $date2 = substr($myrow['date_'],0,2);


  if ($date1== $date2) 
	{
	
		display_error( _('Application can not be submitted in the same month '));
		
	}
	
 else{

		
	$year =date('Y');
	 $sql = "INSERT INTO ".TB_PREF."adv_salary(id,emp_id,date_,Year,reason)
		VALUES (".db_escape($id).",".db_escape($stock_id).",".db_escape($app_date).",".db_escape($year).",".db_escape($reason).")";

        db_query($sql,"a grade could not be added");
		
 }

}
//-------------------------------Advence Salary Inquiry

function get_aprove_adv_salary($emp_id)
{	
	/*$sql = "SELECT  
	SELECT a.id,e.name,g.grade,s.salary,d.deptname FROM emp e,tblsalary s,grade g,department d,adv_salary a  WHERE a.emp_id=e.id AND g.id=e.grade AND d.id= e.department AND s.id=e.grosssalary";
		*/
		
		
		$sql = "SELECT 
	a.id,e.name,m.month_name,a.reason 
				
		FROM ".TB_PREF."emp e,".TB_PREF."adv_salary a,".TB_PREF."salary_month m WHERE m.mon_id=a.date_ AND a.emp_id=e.emp_code AND a.status='0' AND a.recover=0";
		
		
		
		
		/*if (isset($_POST['id']))
		{
			$sql .= " AND emp_id=".db_escape($_POST['id']);
		}*/

		return $sql;
}	

function get_adv_salary_balance($id) 
{
	$id = db_escape($id);
	echo $sql = "SELECT * FROM emp e,adv_salary a  WHERE a.emp_id=e.emp_code  AND a.emp_id =$id";
	$res = db_query($sql, "Sum of transactions could not be calculated");
	$row = db_fetch_row($res);

	return $row[0];
}





function get_adv_salary_aprove($id, $allow_null=false)
{
    //$sql = "SELECT * FROM ".TB_PREF."adv_aslary a,".TB_PREF."emp e WHERE  e.id=a.emp_id AND  a.id=".db_escape($id);
$sql="SELECT e.id,e.name,g.grade,e.grosssalary,d.deptname,e.doj,m.month_name,a.reason FROM ".TB_PREF."emp e,".TB_PREF."grade g,".TB_PREF."department d,".TB_PREF."adv_salary a,".TB_PREF."salary_month m  WHERE m.mon_id=a.date_ AND g.id=e.grade AND d.id= e.department AND e.emp_code=a.emp_id AND a.id='$id'";

	$result = db_query($sql, "The EMPLOY could not be retrieved");

	if (!$allow_null && db_num_rows($result) == 0)
		display_db_error("Could not find EMPLOY $id", $sql);

	return db_fetch($result);
	
	
}






function update_adv_salary_aprove($selected_id,$aprov_date,$status){

$sql = "UPDATE ".TB_PREF."adv_salary SET
	 		 		status =".db_escape($status).",
					aprov_date =".db_escape($aprov_date)."
					
					
					
	 	 	WHERE id = ".db_escape($selected_id);
	db_query($sql,"an item code could not be updated");
	
	
	
	 /*$sql = "UPDATE ".TB_PREF."loan_table SET
	 		 		amount_apply =".db_escape($l_amount).",
					amount_aprov =".db_escape($a_l_amount).",
					monthly_ins	 =".db_escape($monthly_ins	).",
							recov_amount=0
					 	 	WHERE emp_id = ".db_escape($stock_id);
	db_query($sql,"an item code could not be updated");*/

}


function update_salary_setup($id,$b_salary,$hr,$ca,$a_relief,$med,$other,$eobi,$i_tax)

{	


$sql = "UPDATE ".TB_PREF."salary_setup SET
	 		 		b_salary =".db_escape($b_salary).",
					hr =".db_escape($hr).",
					ca =".db_escape($ca).",
					adho_relief =".db_escape($a_relief).",
					med =".db_escape($med).",
					other =".db_escape($other).",
					eobi =".db_escape($eobi).",
					i_tax =".db_escape($i_tax)."
					
					
					
					
	 	 	WHERE id = 1";
db_query($sql,"an item code could not be updated");

}	

//-------------------Employee registration

function add_emp($NewStockID,$title,$name,$advert,$fname,$date_,$gender ,$nic,$location,$department,$desgination,$grade,$datej_,$bankname,$accountno,$cont,$eobi,$social,$ntn,$grosssalary,$ap_id,$inactive,$eobino)
{
 $sql2="SELECT * FROM emp e,loan_req l,empleave el where e.emp_code='$NewStockID' AND l.emp_id='$NewStockID' AND el.empid='$NewStockID'";

	$resultb = db_query($sql2,"Advertisment Setup could not be retrieved");

		
  	if (mysql_num_rows($resultb)==1) 
	{
		
		display_error( _('The Employee Code Already Exixt'));
		
	}
		else{
		
	
	
	
	 $sql1="SELECT * FROM salary_setup";

	$resulta = db_query($sql1,"Advertisment Setup could not be retrieved");

		$myrow = mysql_fetch_array($resulta);
		$b_salary1=$grosssalary/$myrow['b_salary']; 
		$b_salary=$b_salary1/100;
		$hr=$b_salary*$myrow['hr'];  
		$ca=$b_salary*$myrow['ca'];  
		$adho_relief=$b_salary*$myrow['adho_relief'];  
		$med=$b_salary*$myrow['med'];  
		$other=$b_salary*$myrow['other'];  
		$eobi=$myrow['eobi'];   
		$netpay=$grosssalary-($i_tax+$eobi);
		   $a=$grosssalary*12;
			  if($a<=300000){
				  
				$i_tax=0;  
				  
				  }
				elseif($a>=300001 and $a<=350000){
				  
				$i_tax=$grosssalary*0.75/100;
				  
				  } 
            	elseif($a>=350001 and $a<=400000){
				  
				$i_tax=$grosssalary*1.50/100;
				  
				  }  				   
            	elseif($a>=400001 and $a<=450000){
				  
				$i_tax=$grosssalary*2.50/100;
				  
				  }  
               elseif($a>=450001 and $a<=550000){
				  
				$i_tax=$grosssalary*3.50/100;
				  
				  }  					  				   
				  else{
				$i_tax=$grosssalary*4.50/100;	  
					  
					  
					  }
	$netpay=$grosssalary-($i_tax+$eobi);
 $sql = "INSERT INTO emp(acode,emp_code,title,name,fname,dob,gender,nic,location,department,desgination,grade,doj,bankname,accountno,cont,social,ntn,grosssalary,b_salary,hr,ca,adho_relief,med,other,eobi,i_tax,inactive,ap_id,netpay,eobino) 
			VALUES(".db_escape($advert).",".db_escape($NewStockID).",".db_escape($title).",".db_escape($name).",".db_escape($fname).",".db_escape($date_).",".db_escape($gender).",".db_escape($nic).",".db_escape($location).",".db_escape($department).",".db_escape($desgination).",".db_escape($grade).",".db_escape($datej_).",".db_escape($bankname).",".db_escape($accountno).",".db_escape($cont).",".db_escape($social).",".db_escape($ntn).",".db_escape($grosssalary).",".db_escape($b_salary).",".db_escape($hr).",".db_escape($ca).",".db_escape($adho_relief).",".db_escape($med).",".db_escape($other).",".db_escape($eobi).",".db_escape($i_tax).",".db_escape($inactive).",".db_escape($ap_id).",".db_escape($netpay).",".db_escape($eobino).")";
        	db_query($sql,"an emp code could not be added");
		$sql = "INSERT INTO pay_slip(emp_code,name,department,desgination,grade,doj,bankname,accountno,grosssalary,b_salary,hr,ca,adho_relief,med,other,eobi,i_tax,netpay) 
			VALUES(".db_escape($NewStockID).",".db_escape($name).",".db_escape($department).",".db_escape($desgination).",".db_escape($grade).",".db_escape($datej_).",".db_escape($bankname).",".db_escape($accountno)
			.",".db_escape($grosssalary).",".db_escape($b_salary).",".db_escape($hr).",".db_escape($ca).",".db_escape($adho_relief).",".db_escape($med).",".db_escape($other).",".db_escape($eobi).",".db_escape($i_tax).",".db_escape($netpay).")";
        	db_query($sql,"an emp code could not be added");
			$sql = "INSERT INTO empleave(empid,grade) 
			VALUES(".db_escape($NewStockID).",".db_escape($grade).")";
        	db_query($sql,"an emp code could not be added");
			$sql = "INSERT INTO loan_req(emp_id) 
			VALUES(".db_escape($NewStockID).")";
        	db_query($sql,"an emp code could not be added");
			 $sql = "UPDATE applicant SET
	status = 1
	where ap_id=".$ap_id;
	db_query($sql,"an emp code could not be added");
}

}
//-------------------Employee registration

function add_emp2($NewStockID,$title,$name,$empcode,$fname,$date_,$gender ,$nic,$location,$department,$desgination,$grade,$datej_,$bankname,$accountno,$cont,$eobi,$social,$ntn,$grosssalary,$ap_id,$inactive,$eobino)
{
 $sql2="SELECT * FROM emp e,loan_req l,empleave el where e.emp_code='$empcode' AND l.emp_id='$NewStockID' AND el.empid='$NewStockID'";

	$resultb = db_query($sql2,"Advertisment Setup could not be retrieved");

		
  	if (mysql_num_rows($resultb)==1) 
	{
		
		display_error( _('The Employee Code Already Exixt'));
		
	}
		else{
		
	
	
	
	 $sql1="SELECT * FROM salary_setup";

	$resulta = db_query($sql1,"Advertisment Setup could not be retrieved");

		$myrow = mysql_fetch_array($resulta);
		$b_salary1=$grosssalary/$myrow['b_salary']; 
		$b_salary=$b_salary1/100;
		$hr=$b_salary*$myrow['hr'];  
		$ca=$b_salary*$myrow['ca'];  
		$adho_relief=$b_salary*$myrow['adho_relief'];  
		$med=$b_salary*$myrow['med'];  
		$other=$b_salary*$myrow['other'];  
		$eobi=$myrow['eobi'];   
		$netpay=$grosssalary-($i_tax+$eobi);
		   $a=$grosssalary*12;
			  if($a<=300000){
				  
				$i_tax=0;  
				  
				  }
				elseif($a>=300001 and $a<=350000){
				  
				$i_tax=$grosssalary*0.75/100;
				  
				  } 
            	elseif($a>=350001 and $a<=400000){
				  
				$i_tax=$grosssalary*1.50/100;
				  
				  }  				   
            	elseif($a>=400001 and $a<=450000){
				  
				$i_tax=$grosssalary*2.50/100;
				  
				  }  
               elseif($a>=450001 and $a<=550000){
				  
				$i_tax=$grosssalary*3.50/100;
				  
				  }  					  				   
				  else{
				$i_tax=$grosssalary*4.50/100;	  
					  
					  
					  }
	$netpay=$grosssalary-($i_tax+$eobi);
 $sql = "INSERT INTO emp(acode,emp_code,title,name,fname,dob,gender,nic,location,department,desgination,grade,doj,bankname,accountno,cont,social,ntn,grosssalary,b_salary,hr,ca,adho_relief,med,other,eobi,i_tax,inactive,ap_id,netpay,eobino,confirm) 
			VALUES(".db_escape($advert).",".db_escape($empcode).",".db_escape($title).",".db_escape($name).",".db_escape($fname).",".db_escape($date_).",".db_escape($gender).",".db_escape($nic).",".db_escape($location).",".db_escape($department).",".db_escape($desgination).",".db_escape($grade).",".db_escape($datej_).",".db_escape($bankname).",".db_escape($accountno).",".db_escape($cont).",".db_escape($social).",".db_escape($ntn).",".db_escape($grosssalary).",".db_escape($b_salary).",".db_escape($hr).",".db_escape($ca).",".db_escape($adho_relief).",".db_escape($med).",".db_escape($other).",".db_escape($eobi).",".db_escape($i_tax).",".db_escape($inactive).",".db_escape($ap_id).",".db_escape($netpay).",".db_escape($eobino).",'1')";
        	db_query($sql,"an emp code could not be added");
		$sql = "INSERT INTO pay_slip(emp_code,name,department,desgination,grade,doj,bankname,accountno,grosssalary,b_salary,hr,ca,adho_relief,med,other,eobi,i_tax,netpay) 
			VALUES(".db_escape($empcode).",".db_escape($name).",".db_escape($department).",".db_escape($desgination).",".db_escape($grade).",".db_escape($datej_).",".db_escape($bankname).",".db_escape($accountno)
			.",".db_escape($grosssalary).",".db_escape($b_salary).",".db_escape($hr).",".db_escape($ca).",".db_escape($adho_relief).",".db_escape($med).",".db_escape($other).",".db_escape($eobi).",".db_escape($i_tax).",".db_escape($netpay).")";
        	db_query($sql,"an emp code could not be added");
			$sql = "INSERT INTO empleave(empid,grade) 
			VALUES(".db_escape($empcode).",".db_escape($grade).")";
        	db_query($sql,"an emp code could not be added");
			$sql = "INSERT INTO loan_req(emp_id) 
			VALUES(".db_escape($empcode).")";
        	db_query($sql,"an emp code could not be added");
			 $sql = "UPDATE applicant SET
	status = 1
	where ap_id=".$ap_id;
	db_query($sql,"an emp code could not be added");
}

}

function update_emp($nationality,$stock_id, $name, $fname,$advert,$date_,$gender ,$nic,$location,$department,$desgination,$grade,$datej_,$dater_,$bankname,$accountno,$cont,$social,$ntn,$grosssalary,$inactive,$confirm,$eobino,$dates_)
{


 $sql1="SELECT * FROM salary_setup";

	$resulta = db_query($sql1,"Advertisment Setup could not be retrieved");

		$myrow = mysql_fetch_array($resulta);
		
		$b_salary1=$grosssalary/$myrow['b_salary']; 
		$b_salary=$b_salary1/100;
		$hr=$b_salary*$myrow['hr'];  
		$ca=$b_salary*$myrow['ca'];  
		$adho_relief=$b_salary*$myrow['adho_relief'];  
		$med=$b_salary*$myrow['med'];  
		$other=$b_salary*$myrow['other'];    
		$eobi=$myrow['eobi']; 
		   
              $a=$grosssalary*12;
			  			  if($a<=300000){
				  
				$i_tax=0;  
				  
				  }
				elseif($a>=300001 and $a<=350000){
				  
				$i_tax=$grosssalary*0.75/100;
				  
				  } 
            	elseif($a>=350001 and $a<=400000){
				  
				$i_tax=$grosssalary*1.50/100;
				  
				  }  				   
            	elseif($a>=400001 and $a<=450000){
				  
				$i_tax=$grosssalary*2.50/100;
				  
				  }  
               elseif($a>=450001 and $a<=550000){
				  
				$i_tax=$grosssalary*3.50/100;
				  
				  }  					  				   
				  else{
				$i_tax=$grosssalary*4.50/100;	  
					  
					  
					  }

	$netpay=$grosssalary-($i_tax+$eobi);
   $sql = "UPDATE emp SET
	acode = ".db_escape($advert).",
	
            name = ".db_escape($name).",
    	 	fname = ".db_escape($fname).",
			dob = ".db_escape($date_).",
            gender = ".db_escape($gender).",
            
			nic = ".db_escape($nic).",
			n_id = ".db_escape($nationality).",
			location = ".db_escape($location).",
			department = ".db_escape($department).",
			desgination = ".db_escape($desgination).",
			grade = ".db_escape($grade).",
			doj = ".db_escape($datej_).",
			dor = ".db_escape($dater_).",
                        start_date = ".db_escape($dates_).",
			bankname = ".db_escape($bankname).",
			accountno = ".db_escape($accountno).",
			cont = ".db_escape($cont).",
			
			social = ".db_escape($social).",
			ntn = ".db_escape($ntn).",
			grosssalary = ".db_escape($grosssalary).",
			b_salary = ".db_escape($b_salary).",
			hr = ".db_escape($hr).",
			ca = ".db_escape($ca).",
		    adho_relief = ".db_escape($adho_relief).",
			med = ".db_escape($med).",
			other = ".db_escape($other).",
			eobi = ".db_escape($eobi).",
			i_tax = ".db_escape($i_tax).",
			inactive = ".db_escape($inactive).",
			confirm = ".db_escape($confirm).",
			eobino = ".db_escape($eobino).",
			netpay = ".db_escape($netpay)."
		WHERE emp_code = ".db_escape($stock_id);
		db_query($sql,"an employee code could not be updated");
		
		$sql = "UPDATE pay_slip SET
	
            name = ".db_escape($name).",
    	 	
			
			department = ".db_escape($department).",
			desgination = ".db_escape($desgination).",
			grade = ".db_escape($grade).",
			doj = ".db_escape($datej_).",
		
			bankname = ".db_escape($bankname).",
			accountno = ".db_escape($accountno).",
			
			grosssalary = ".db_escape($grosssalary).",
			b_salary = ".db_escape($b_salary).",
			hr = ".db_escape($hr).",
			ca = ".db_escape($ca).",
		    adho_relief = ".db_escape($adho_relief).",
			med = ".db_escape($med).",
			other = ".db_escape($other).",
			eobi = ".db_escape($eobi).",
			i_tax = ".db_escape($i_tax).",
			netpay = ".db_escape($netpay)."
			
			   	WHERE emp_code = ".db_escape($stock_id);
			
			
			
	 	//$sql .= "emp_code = ".db_escape($stock_id);
	db_query($sql,"an employee code could not be updated");
}
//---------------------------- Applicant
function get_appli($id, $allow_null=false)
{
    $sql = "SELECT * FROM ".TB_PREF."applicant	WHERE ap_id=".db_escape($id);

	$result = db_query($sql, "The Employee could not be retrieved");

	if (!$allow_null && db_num_rows($result) == 0)
		display_db_error("Could not find Employee $id", $sql);

	return db_fetch($result);
}

//--------------------------------------
//--------------------------------------

function add_rollprocess($month)
{

 $sql4="SELECT * FROM process_".$month." where jv='1'";

	$result4 = db_query($sql4,"Process Month could not be retrieved");
	if(mysql_fetch_array($result4)>0){
		display_error("Process month not rollback because it is created JV");
	}
	else{
	 $curyear =date('Y');
     $sql2="SELECT * FROM process_".$month;
     $resultb = db_query($sql2,"Employee Setup could not be retrieved");
	while ($myrow = mysql_fetch_array($resultb)) {

	  $NewStockID=$myrow['emp_code'];
	  $grosssalary=$myrow['grosssalary'];
	  $month_ins=$myrow['month_ins'];
	  $netpay=$myrow['netpay'];

		  $sql = "UPDATE loan_req SET
         	rec_amount =rec_amount-".db_escape($monthly_ins1)."
        	where emp_id=".db_escape($NewStockID);
       	db_query($sql,"a Loan code could not be added");


       $sql = "UPDATE adv_salary SET
            	recover =0
             	where date_=".db_escape($month)." and emp_id=".db_escape($NewStockID);
            	db_query($sql,"an Advance Salary could not be added");	
	

	 
	}
	
	
   	    $sql="delete FROM process_".$month;
    	db_query($sql,"A Process Month could not be added");	
	
	}
}


//--------------------------------------

function add_process($month,$days,$bonus)
{

 $sql4="SELECT * FROM process_".$month;

	$result4 = db_query($sql4,"Process Month could not be retrieved");
	if(mysql_fetch_array($result4)>0){
		display_error("Process month already exist");
	}
	else{
	 $curyear =date('Y');
     $sql2="SELECT * from emp WHERE inactive = 0";
     $resultb = db_query($sql2,"Employee Setup could not be retrieved");
	while ($myrow = mysql_fetch_array($resultb)) {
		$status=0;
	$leave=0;	
    $ID=$myrow['id'];
	$NewStockID=$myrow['emp_code'];
	$grosssalary=$myrow['grosssalary'];
	$b_salary=$myrow['b_salary'];
	$hr=$myrow['hr'];
	$ca=$myrow['ca'];
	$adho_relief=$myrow['adho_relief'];
	$med=$myrow['med'];
	$other=$myrow['other'];
	$eobi=$myrow['eobi'];
	$netpay=$myrow['netpay'];
	$month_ins=$myrow['monthly_ins'];
	$i_tax=$myrow['i_tax'];
	$status=0;
	
	
	$sqllve="SELECT * FROM leave_table where  SUBSTR(FROM_DATE, 1, 2 ) = '$month' AND emp_code='$NewStockID' and leave_type ='WITHOUT PAY' and status='1'";
	$resultlve = db_query($sqllve,"Leave Not Found could not be retrieved");
	$myrowlve = mysql_fetch_array($resultlve);
	$leave=$myrowlve['no_o_l'];
	
	$sql9="SELECT * FROM loan_req where  emp_id ='$NewStockID' and status='1'";
	$result9 = db_query($sql9,"Leave Not Found could not be retrieved");
	$myrow9 = mysql_fetch_array($result9);
	$a_l_amount=$myrow9['a_l_amount'];
	$rec_amount =$myrow9['rec_amount'];
	$monthly_ins =$myrow9['monthly_ins'];

    $sqladv="SELECT * FROM adv_salary where date_='$month' and emp_id='$NewStockID' and status=1 ";
	$resultadv = db_query($sqladv,"Advertisment Setup could not be retrieved");
	$myrowadv = mysql_fetch_array($resultadv);
	$status=$myrowadv['status'];
    if ($myrowadv['status']==1)
	{
	  $netpay=-($netpay);
	}
	
	if ($bonus==3)
	{
	  $bonamt=$grosssalary;
	  
	}
	elseif ($bonus==2)
	{
	  $bonamt=$b_salary;
	  
	}
    else
	{
	  $bonamt=0;
	  
	}
	if($a_l_amount>$rec_amount){
		$monthly_ins1=$monthly_ins;
		  $sql = "UPDATE loan_req SET
	rec_amount =rec_amount+".db_escape($monthly_ins1)."
	where emp_id=".db_escape($NewStockID);
	db_query($sql,"a Loan code could not be added");
	
	}
	else{
		$monthly_ins1=0;
	}
	
	$sqlsalary="SELECT * FROM salary_setup";

	$resultsalary = db_query($sqlsalary,"Advance Salary could not be retrieved");
	$myrowsalary = mysql_fetch_array($resultsalary);
	$eobi=$myrowsalary['eobi'];
	$basic=$myrowsalary['b_salary'];
	$hr =$myrowsalary['hr'];
	$ca =$myrowsalary['ca'];
	$adho_relief =$myrowsalary['adho_relief'];
	$med  =$myrowsalary['med'];
	$other  =$myrowsalary['other'];
	
	

	
	$b_salary=round(((($grosssalary/$basic)/100)/$days)*($days-$leave),0);
	$hr=round(((($b_salary)*$hr)/$days)*($days-$leave),0);
	$ca=round(((($b_salary)*$ca)/$days)*($days-$leave),0);
	$adho_relief=round(((($b_salary)*$adho_relief)/$days)*($days-$leave),0);
	$med=round(((($b_salary)*$med)/$days)*($days-$leave),0);
	$other=round(((($b_salary)*$other)/$days)*($days-$leave),0);
	$eobi=$myrow['eobi'];
	
	
	$netpay=round(($b_salary+$hr+$ca+$adho_relief+$med+$other)-($eobi+$i_tax+$monthly_ins1),0);
	$i_tax=$myrow['i_tax'];
	

	$sql = "INSERT INTO process_".$month."(emp_id,emp_code,grosssalary,b_salary,hr,ca,adho_relief,med,other,eobi,i_tax,month,days,month_ins,netpay,bonus) 
			VALUES(".db_escape($ID).",".db_escape($NewStockID).",".db_escape($grosssalary).",".db_escape($b_salary).",".db_escape($hr).",".db_escape($ca).",".db_escape($adho_relief).",".db_escape($med).",".db_escape($other).",".db_escape($eobi).",".db_escape($i_tax).",".db_escape($month).",".db_escape($days-$leave).",".db_escape($monthly_ins1).",".db_escape(($netpay)).",".db_escape(($bonamt)).")";
        	db_query($sql,"an emp code could not be added");

	
	 $sql = "UPDATE bonus SET
		status =1,
	year=".db_escape($curyear)."
	where id=".db_escape($bonus);
	db_query($sql,"a Bonus could not be added");	



  
	
    $sql = "UPDATE adv_salary SET
	recover =1
	where emp_id=".db_escape($ID);
	db_query($sql,"an Advance Salary could not be added");	

	 
	}
	}
}



//--------------------Final Settlement
function add_final_settle_form($stock_id,$from_date,$to_date,$accountno,$check_no,$grosssalary,$rem_lev,$reason,$a_l_amount,$rec_amount)
{     $mon_id=substr($from_date,0,2);
 $sql2="SELECT * FROM salary_month 
WHERE
 mon_id='$mon_id'";
$results = db_query($sql2,"Advertisment Setup could not be retrieved");

		$myrow1 = mysql_fetch_array($results);
		 $days=$myrow1['days'];
  $loan_amount=$a_l_amount-$rec_amount;

 $pay_per_day=$grosssalary / $days;
 $rem_lev;
 $rem_pay=$grosssalary/30*$rem_lev;
 $no_o_days_w=substr($to_date,3,2)-substr($from_date,3,2);
	$salary_days=$no_o_days_w*$pay_per_day;
	$netpay=($rem_pay+$salary_days)-$loan_amount;
	 $sql = "INSERT INTO ".TB_PREF."resign_emp(emp_id,from_date,to_date,accountno,check_no,no_o_days_w,salary_days,leave_days,leave_amount,loan_balance,netpay,reason)
		VALUES (".db_escape($stock_id).",".db_escape($from_date).",".db_escape($to_date).",".db_escape($accountno).",".db_escape($check_no).",".db_escape($no_o_days_w).",".db_escape($salary_days).",".db_escape($rem_lev).",".db_escape($rem_pay).",".db_escape($loan_amount).",".db_escape($netpay).",".db_escape($reason).")";

        db_query($sql," Final Settlement could not be added");
		
		
  
	 $sql = "UPDATE loan_req SET
	   rec_amount = ".db_escape($a_l_amount)."
    	 		where emp_id=".db_escape($stock_id);
  db_query($sql," Final Settlement could not be added");
  
   $sql = "UPDATE emp SET
    resign_emp = 1
    			where emp_code=".db_escape($stock_id);
  db_query($sql," Final Settlement could not be added");
}
//--------------New Employee Inquiry
function get_newemp($id)
{	
	
	
	$sql = "SELECT ap_id,ap_name,date_of_join,salary from applicant where approved='1' and status!='1'";
	return $sql;
}	
//-----------------Evaluation Insertion

function 	eva_form($stock_id,$id,$doj,$curdate,$q_o_w,$job_know,$qtity_o_w,$result_orient,$depend,$initiative,$teamwork,$adaptability,$org_goal,$final_result,$remarks)
{     
 
		
	
	 $sql = "INSERT INTO ".TB_PREF."tblevalu(id,emp_code,join_date,curr_date,q_o_w,job_know,qtity_o_w,result_orient,depend,initiative,teamwork,adaptability,org_goal,final_result,remarks)
		VALUES (".db_escape($id).",".db_escape($stock_id).",".db_escape($doj).",".db_escape($curdate).",".db_escape($q_o_w).",".db_escape($job_know).",".db_escape($qtity_o_w).",".db_escape($result_orient).",".db_escape($depend).",".db_escape($initiative).",".db_escape($teamwork).",".db_escape($adaptability).",".db_escape($org_goal).",".db_escape($final_result).",".db_escape($remarks).")";

        db_query($sql,"Evaluation could not be added");
		
 

}
//----------------------------

function update_inc_pro($stock_id,$id,$evaid,$inc_per,$per_inc,$grosssalary,$nic,$eff_date,$join_date,$remarks,$desgination,$grade,$locations,$departments){
 $per=$grosssalary/$per_inc;
 
 $per1=$grosssalary/$inc_per;
 $per_amount=$per+$per1;
 $inc_amount=$per+$per1+$grosssalary;
 
$sql = "INSERT INTO tblpro_inc(id,eva_no,emp_code,inc_per,inc_per_amount,grosssalary,inc_amount,join_date,effec_date,remarks,designation,grade1,location,department) 
			VALUES(".db_escape($id).",".db_escape($evaid).",".db_escape($stock_id).",".db_escape($inc_per).",".db_escape($per_amount).",".db_escape($grosssalary).",".db_escape($inc_amount).",".db_escape($join_date).",".db_escape($eff_date).",".db_escape($remarks).",".db_escape($desgination).",".db_escape($grade).",".db_escape($locations).",".db_escape($departments).")";
        	db_query($sql,"Record could not be added");
		
}
//-------------------Promotion And Increment

function get_proemp($emp_id)
{	
	 $sql="SELECT e.emp_code,e.name,p.effec_date,p.inc_per,p.inc_per_amount,p.inc_amount FROM emp AS e LEFT JOIN tblpro_inc AS  p ON p.emp_code=e.emp_code where e.inactive=0 AND p.status=0";
 return $sql;
}
//-----------------------------------------Aprove Promotion And Increment
function update_aprov_inc_pro($emp_code1,$id,$evaid,$inc_amount,$grosssalary1,$desgination,$grade,$location,$department){

 $sql1="SELECT * FROM salary_setup";

	$resulta = db_query($sql1,"Advertisment Setup could not be retrieved");

		$myrow = mysql_fetch_array($resulta);
		
		$b_salary1=$inc_amount/$myrow['b_salary']; 
		$b_salary=$b_salary1/100;
		$hr=$b_salary*$myrow['hr'];  
		$ca=$b_salary*$myrow['ca'];  
		$adho_relief=$b_salary*$myrow['adho_relief'];  
		$med=$b_salary*$myrow['med'];  
		$other=$b_salary*$myrow['other'];    
		$eobi=$myrow['eobi']; 
		   
              $a=$inc_amount*12;
			  if($a<=300000){
				  
				$i_tax=0;  
				  
				  }
				  else{
				$i_tax=$inc_amount*$myrow['i_tax']/100;	  
					  
					  
					  }

	$netpay=$inc_amount-($i_tax+$eobi);
  $sql = "UPDATE tblpro_inc SET
   designation = ".db_escape($desgination).",
			grade = ".db_escape($grade).",
			location = ".db_escape($location).",
			department = ".db_escape($department).",
			status = 1
			WHERE emp_code = ".db_escape($emp_code1);
		db_query($sql,"an employee code could not be updated");
	
 $sql = "UPDATE emp SET

			location = ".db_escape($location).",
			department = ".db_escape($department).",
			desgination = ".db_escape($desgination).",
			grade = ".db_escape($grade).",
			grosssalary = ".db_escape($inc_amount).",
			old_grosssalary = ".db_escape($grosssalary1).",
			b_salary = ".db_escape($b_salary).",
			hr = ".db_escape($hr).",
			ca = ".db_escape($ca).",
		    adho_relief = ".db_escape($adho_relief).",
			med = ".db_escape($med).",
			other = ".db_escape($other).",
			eobi = ".db_escape($eobi).",
			i_tax = ".db_escape($i_tax).",
			
			netpay = ".db_escape($netpay)."
		WHERE emp_code = ".db_escape($emp_code1);
		db_query($sql,"an employee code could not be updated");
		
	$sql = "UPDATE pay_slip SET
	
        
			
			department = ".db_escape($department).",
			desgination = ".db_escape($desgination).",
			grade = ".db_escape($grade).",
		
			grosssalary = ".db_escape($inc_amount).",
			b_salary = ".db_escape($b_salary).",
			hr = ".db_escape($hr).",
			ca = ".db_escape($ca).",
		    adho_relief = ".db_escape($adho_relief).",
			med = ".db_escape($med).",
			other = ".db_escape($other).",
			eobi = ".db_escape($eobi).",
			i_tax = ".db_escape($i_tax).",
			netpay = ".db_escape($netpay)."
			
			   	WHERE emp_code = ".db_escape($emp_code1);
			
			
			
	 	//$sql .= "emp_code = ".db_escape($stock_id);
	db_query($sql,"an employee code could not be updated");
}

function add_jvprocess($month)
{
	$sql = "SELECT max(type_no) as type  FROM gl_trans WHERE type='0' ";
	$result = db_query($sql, "Could not retrieve bank trans");
			$row = db_fetch_row($result);
			$type_no1=$row[0];
			
	$type_no=$type_no1 + 1;
	
	
 $sql4="SELECT * FROM process_".$month." where jv='1'";

	$result4 = db_query($sql4,"JV Process Month already");
	if(mysql_fetch_array($result4)>0){
		display_error("Process month already exist");
	}
	else{
	$sql5="SELECT sum(grosssalary) as salary,sum(eobi) as meobi,sum(i_tax) as itax,sum(other) as other,sum(month_ins) as loan,sum(netpay) as netpay FROM `process_".$month;
	$resultb = db_query($sql5,"Process Month could not be retrieved");
	
	while ($myrow = mysql_fetch_array($resultb)) {
        $msalary=$myrow['salary'];
        $meobi=$myrow['meobi'];
        $itax=$myrow['itax'];
        $loan=$myrow['loan'];
		$netpay=$myrow['netpay'];
		}


	    
		if ($month=='08') 
		{
  	     $date_='2012-08-31';
		 $cmonth='August';
		}
		elseif ($month=='12') 
		{
  	     $date_='2012-12-31';
		 $cmonth='December';
		}
		elseif ($month=='11') 
		{
  	     $date_='2012-11-30';
		 $cmonth='November';
		}
		elseif ($month=='10') 
		{
  	     $date_='2012-10-31';
		 $cmonth='October';
		}
		elseif ($month=='09') 
		{
  	     $date_='2012-09-30';
		 $cmonth='September';
		}
		elseif ($month=='07') 
		{
  	     $date_='2012-07-31';
		 $cmonth='July';
		}
		elseif ($month=='06') 
		{
  	     $date_='2012-06-30';
		 $cmonth='June';

		}
		elseif ($month=='05') 
		{
  	     $date_='2012-05-31';
		 $cmonth='May';

		}
		elseif ($month=='04') 
		{
  	     $date_='2012-04-30';
		 $cmonth='April';

		}
		elseif ($month=='03') 
		{
  	     $date_='2012-03-31';
		 $cmonth='March';

		}
		elseif ($month=='02') 
		{
  	     $date_='2012-02-29';
 		 $cmonth='Febuary';
		}
		else
		{
  	     $date_='2012-01-31';
		 		 $cmonth='January';

		}

		$long_description="Staff Salary for the Month of".$cmonth;
		
	$sql = "INSERT INTO ".TB_PREF."gl_trans (type, type_no, tran_date, account, memo_, amount,person_type_id) VALUES
				('0',".db_escape($type_no).",".db_escape($date_).", ".db_escape('5410').",".db_escape($long_description).",".db_escape($msalary).",'0')";
				db_query($sql,"a Salary Code could not be added");

	$sql = "INSERT INTO ".TB_PREF."gl_trans (type, type_no, tran_date, account, memo_, amount,person_type_id) VALUES
				('0',".db_escape($type_no).",".db_escape($date_).", ".db_escape('5590').",".db_escape($long_description).",".db_escape(-($meobi)).",'0')";
				db_query($sql,"a Salary Code could not be added");	

$sql = "INSERT INTO ".TB_PREF."gl_trans (type, type_no, tran_date, account, memo_, amount,person_type_id) VALUES
				('0',".db_escape($type_no).",".db_escape($date_).", ".db_escape('5580').",".db_escape($long_description).",".db_escape(-($itax)).",'0')";
				db_query($sql,"a Salary Code could not be added");

$sql = "INSERT INTO ".TB_PREF."gl_trans (type, type_no, tran_date, account, memo_, amount,person_type_id) VALUES
				('0',".db_escape($type_no).",".db_escape($date_).", ".db_escape('5600').",".db_escape($long_description).",".db_escape(-($loan)).",'0')";
				db_query($sql,"a Salary Code could not be added");



$sql = "INSERT INTO ".TB_PREF."gl_trans (type, type_no, tran_date, account, memo_, amount,person_type_id) VALUES
				('0',".db_escape($type_no).",".db_escape($date_).", ".db_escape('5591').",".db_escape($long_description).",".db_escape(-($netpay)).",'0')";
				db_query($sql,"a Salary Code could not be added");
				
			
			
	$sql = "INSERT INTO ".TB_PREF."audit_trail"
		. " (type, trans_no, user, description, fiscal_year, gl_date, gl_seq)
			VALUES('0', ".db_escape($type_no).","
			. $_SESSION["wa_current_user"]->user. ","
			. get_company_pref('f_year') .","
			. "'". '$date_' ."',"
			. db_escape('5410'). ", 0)";

	db_query($sql, "Cannot add audit info");
						
			$sql = "update process_".$month." set jv='1'" ;
			db_query($sql,"a Salary Code could not be added");					
											
 
	}
}
/////

/////
function add_jvsett($empid)
{
	$sql = "SELECT max(type_no) as type  FROM gl_trans WHERE type='0' ";
	$result = db_query($sql, "Could not retrieve bank trans");
			$row = db_fetch_row($result);
			$type_no1=$row[0];
			
	$type_no=$type_no1 + 1;
	
	
 $sql4="SELECT * FROM resign_emp where post='1' and emp_id=".$empid;

	$result4 = db_query($sql4,"JV Settlement already");
	if(mysql_fetch_array($result4)>0){
		display_error("JV Settlement already exist".$empid);
	}
	else{
    
	$sql5="select * from resign_emp a,emp b where a.emp_id=b.emp_code and a.emp_id='".$empid."'";
	
	$resultb = db_query($sql5,"Resign Employee could not be retrieved");

	while ($myrow = mysql_fetch_array($resultb)) {
		 $name=$myrow['name'];
        $salary=$myrow['salary_days'];
        $salary1=$myrow['leave_amount'];
        $loan=$myrow['loan_balance'];
        $oded=$myrow['other_deduc'];
		}


        $date_=  date("Y-m-d");;

	    $msalary = $salary + $salary1 + $loan + $oded;

		$long_description="JV Settlement for the Employee ".$name;
		
	$sql = "INSERT INTO ".TB_PREF."gl_trans (type, type_no, tran_date, account, memo_, amount,person_type_id) VALUES
				('0',".db_escape($type_no).",".db_escape($date_).", ".db_escape('5410').",".db_escape($long_description).",".db_escape($msalary).",'0')";
				db_query($sql,"a Salary Code could not be added");

	$sql = "INSERT INTO ".TB_PREF."gl_trans (type, type_no, tran_date, account, memo_, amount,person_type_id) VALUES
				('0',".db_escape($type_no).",".db_escape($date_).", ".db_escape('5601').",".db_escape($long_description).",".db_escape(-($salary+$salary1)).",'0')";
				db_query($sql,"a Salary Code could not be added");	

$sql = "INSERT INTO ".TB_PREF."gl_trans (type, type_no, tran_date, account, memo_, amount,person_type_id) VALUES
				('0',".db_escape($type_no).",".db_escape($date_).", ".db_escape('5600').",".db_escape($long_description).",".db_escape(-($loan)).",'0')";
				db_query($sql,"a Salary Code could not be added");

$sql = "INSERT INTO ".TB_PREF."gl_trans (type, type_no, tran_date, account, memo_, amount,person_type_id) VALUES
				('0',".db_escape($type_no).",".db_escape($date_).", ".db_escape('5580').",".db_escape($long_description).",".db_escape(-($oded)).",'0')";
				db_query($sql,"a Salary Code could not be added");

			
	$sql = "INSERT INTO ".TB_PREF."audit_trail"
		. " (type, trans_no, user, description, fiscal_year, gl_date, gl_seq)
			VALUES('0', ".db_escape($type_no).","
			. $_SESSION["wa_current_user"]->user. ","
			. get_company_pref('f_year') .","
			. "'". '$date_' ."',"
			. db_escape('5410'). ", 0)";

	db_query($sql, "Cannot add audit info");
						
			$sql = "update resign_emp set post='1' where emp_id='".$empid."'"; ;
			db_query($sql,"a Salary Code could not be added");					
											
 
	}
}

?>