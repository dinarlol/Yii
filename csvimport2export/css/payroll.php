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
class payroll_app extends application
{
	function payroll_app()
	{
		$this->application("payroll", _($this->help_context = "HR and &Payroll"));

			$this->add_module(_("Transactions"));
			$this->add_lapp_function(0, _("&Add Existing Employee Setup"),
				"payroll/manage/existingemployee.php?", 'SA_EXEMP', MENU_ENTRY);
			$this->add_lapp_function(0, _("&Advertisment Setup"),
				"payroll/manage/advert.php?", 'SA_ADVER', MENU_ENTRY);
		
		   $this->add_lapp_function(0, _("&Applicant - Information"),
				"payroll/manage/empinfotest.php?", 'SA_EMPINFO', MENU_ENTRY);	

           $this->add_lapp_function(0, _("&Add Document"),
				"admin/uploadcv.php?", 'SA_ATTACHDOCUMENT', MENU_ENTRY);
				
				 $this->add_lapp_function(0, _("&Upload CV"),
				"admin/emp-uploadcv.php?", 'SA_ATTACHDOCUMENT', MENU_ENTRY);				
						
			$this->add_lapp_function(0, _("&Leave Application Form"),
			"payroll/manage/leave_app.php?", 'SA_LEAVEAPP', MENU_ENTRY);
			$this->add_lapp_function(0, _("&Loan Application Form"),
			"payroll/manage/req_loan.php?", 'SA_RLOAN', MENU_ENTRY);
			$this->add_lapp_function(0, _("&Training Application Form"),
			"payroll/manage/req_training.php?", 'SA_RLOAN', MENU_ENTRY);
			$this->add_lapp_function(0, _("&Advance Salary Application Form"),
			"payroll/manage/adv_salary.php?", 'SA_ASALARY', MENU_ENTRY);
			
		 $this->add_rapp_function(0, _("&Salary Process Month"),
			"payroll/manage/process_pay.php?", 'SA_PROCESS', MENU_ENTRY);

         $this->add_rapp_function(0, _("&Rollback Process Month"),
			"payroll/manage/process_roll.php?", 'SA_ROLLPROCESS', MENU_ENTRY);
			
		 $this->add_rapp_function(0, _("&JV Salary Process Month"),
			"payroll/manage/jvprocess_pay.php?", 'SA_JVPROCESS', MENU_ENTRY);
			
		 $this->add_rapp_function(0, _("&JV Settlement"),
			"payroll/manage/jvsettlement.php?", 'SA_JVSETTLEMENT', MENU_ENTRY);			
			
$this->add_rapp_function(0, _("&Employee Evaluation Form"),
			"payroll/manage/eva_form.php?", 'SA_EVALUATION', MENU_ENTRY);
			$this->add_rapp_function(0, _("&Employee Increment And Promotion Form"),
			"payroll/manage/emp_pro.php?", 'SA_EVALUATION', MENU_ENTRY);
	$this->add_module(_("Asset Management"));
	$this->add_lapp_function(1, _("Employees &Assets Record"),
			"payroll/inquiry/asset_record.php?", 'AS_RECORD', MENU_INQUIRY);
/*$this->add_lapp_function(1, _("Employese &Assets List"),
			"payroll/inquiry/equip_inquiry.php?", 'SA_EQUIP_LIST', MENU_INQUIRY);
*/$this->add_lapp_function(1, _("Add &Employee Asset"),
			"payroll/manage/emp_equip.php?", 'SA_EQUIP_ENTRY', MENU_ENTRY);
$this->add_lapp_function(1, _("Asset &Units of Measure"),
			"inventory/manage/asset_units.php?", 'AS_UOM', MENU_MAINTENANCE);
			$this->add_lapp_function(1, _("Asset Item &Categories"),
			"inventory/manage/asset_category.php?", 'AS_FACATEGORY', MENU_MAINTENANCE);
					$this->add_lapp_function(1, _("Asset &Items Entry"),
			"inventory/manage/asset_items.php?", 'AS_FAITEM', MENU_ENTRY);
	
			
			$this->add_module(_("Inquiries and Reports"));
				$this->add_lapp_function(2, _("View &Applicant"),
			"payroll/manage/search_applicant.php?", 'SA_SEARCHAPP', MENU_INQUIRY);
			
			
			
			$this->add_lapp_function(2, _("Applicant &Inquiry"),
			"payroll/inquiry/applicant_inquiry.php?", 'SA_APPINQUIRY', MENU_INQUIRY);
			
			$this->add_lapp_function(2, _("Final &Applicant"),
			"payroll/inquiry/final_applicant_inquiry.php?", 'SA_FINALAPPINQUIRY', MENU_INQUIRY);
			
			 $this->add_lapp_function(2, _("&New Employee Inquiry"),
			"payroll/inquiry/newemp.php?", 'SA_NEWEMP', MENU_ENTRY);
			
   		   
		    $this->add_lapp_function(2, _("&Employee Leave Inquiry"),
			"payroll/inquiry/leave_report.php?", 'SA_LEAVEINQUIRY', MENU_ENTRY);
			$this->add_lapp_function(2, _("&Leave Aprove Inquiry"),
			"payroll/inquiry/hr_leave_inquiry.php?", 'SA_SALESPRICE', MENU_MAINTENANCE);
			$this->add_lapp_function(2, _("&Employee Loan Inquiry"),
			"payroll/inquiry/loan_report.php?", 'SA_LOANINQUIRY', MENU_ENTRY);
			$this->add_lapp_function(2, _("&Loan Aprove Inquiry"),
			"payroll/inquiry/hr_loan_inquiry.php?", 'SA_SALESPRICE', MENU_MAINTENANCE);
			$this->add_lapp_function(2, _("&Employee Training Inquiry"),
			"payroll/inquiry/training_report.php?", 'SA_LOANINQUIRY', MENU_ENTRY);
			$this->add_lapp_function(2, _("&Training Aprove Inquiry"),
			"payroll/inquiry/hr_training_inquiry.php?", 'SA_SALESPRICE', MENU_MAINTENANCE);
			$this->add_lapp_function(2, _("&Approved Training List"),
			"payroll/inquiry/hr_approvetraining_inquiry.php?", 'SA_SALESPRICE', MENU_MAINTENANCE);
			
			// $this->add_lapp_function(2, _("&Employee Remaining Leave Inquiry"),
			//"payroll/inquiry/emp_leave_report.php?", 'SA_REMINQUIRY', MENU_ENTRY);
			 $this->add_lapp_function(2, _("&Employee Increment And Promotion Inquiry"),
			"payroll/inquiry/pro_inc_inquiry.php?", 'SA_PROMOTIONINQUIRY', MENU_ENTRY);


	
	
			
			
		$this->add_lapp_function(2, _("&Advance Salary Aprove Inquiry"),
			"payroll/inquiry/adv_salary_aprovement.php?", 'SA_SALESPRICE', MENU_MAINTENANCE);
		
$this->add_lapp_function(2, _("&Expiring Document Inquiry"),
			"payroll/inquiry/docexiry_report.php?", 'SA_LEAVEINQUIRY', MENU_MAINTENANCE);
			$this->add_rapp_function(2, _("Payroll &Reports"),
				"reporting/reports_main.php?Class=4", 'SA_PAYROLL', MENU_REPORT);
			
			$this->add_module(_("Maintenance"));
        	$this->add_lapp_function(3, _("&Location"),
			"payroll/manage/location.php?", 'SA_LOCA', MENU_ENTRY);				
				
             $this->add_lapp_function(3, _("&Department"),
			"payroll/manage/department.php?", 'SA_DEPT', MENU_ENTRY);	
			
			$this->add_lapp_function(3, _("Bank &Accounts"),
			"gl/manage/bank_accounts.php?", 'SA_BANKACCOUNT', MENU_MAINTENANCE);

             $this->add_lapp_function(3, _("&Desgination"),
			"payroll/manage/desgination.php?", 'SA_DESG', MENU_ENTRY);	
			
  		     $this->add_lapp_function(3, _("&Grade"),
			"payroll/manage/grade.php?", 'SA_GRADE', MENU_ENTRY);
/*			
           $this->add_lapp_function(3, _("&Grade Leave Setup"),
			"payroll/manage/leave.php?", 'SA_LEAVE', MENU_ENTRY);
			  $this->add_lapp_function(2, _("&Nationality"),
			"payroll/manage/nation.php?", 'SA_ITEM', MENU_ENTRY);
*/
			  $this->add_lapp_function(3, _("&Gazetted Holidays"),
			"payroll/manage/holiday.php?", 'SA_HOLIDAY', MENU_ENTRY);
			
            $this->add_lapp_function(3, _("&Qualification"),
			"payroll/manage/qualification.php?", 'SA_QUA', MENU_ENTRY);
			$this->add_lapp_function(3, _("&Training"),
			"payroll/manage/training.php?", 'SA_QUA', MENU_ENTRY);
			$this->add_lapp_function(3, _("&Nationality"),
			"payroll/manage/nation.php?", 'SA_ITEM', MENU_ENTRY);
			
			 $this->add_lapp_function(3, _("&Breakup Formula "),
			"payroll/manage/salary_setup.php?", 'SA_BKUP', MENU_ENTRY);
			
           // $this->add_lapp_function(2, _("&Job Setup"),
			//"payroll/manage/jobsetup.php?", 'SA_ITEM', MENU_ENTRY);	
			
        //	$this->add_rapp_function(2, _("&Advertisment Setup"),
		//	"payroll/manage/advert.php?", 'SA_ITEM', MENU_ENTRY);	
		//	$this->add_rapp_function(2, _("&Advertisment Inquiry Report"),
		//	"payroll/inquiry/advert_report.php?", 'SA_ITEM', MENU_ENTRY);
			
			$this->add_rapp_function(3, _("&Employee - Information"),
			"payroll/manage/emp.php?", 'SA_EMPLOY', MENU_ENTRY);	
						
$this->add_rapp_function(3, _("&Employee - Final Settlement"),
			"payroll/manage/final_settle.php?", 'SA_EMPLOY', MENU_ENTRY);	
			//	  $this->add_rapp_function(2, _("&Leave Setup"),
			//"payroll/manage/leaveform.php?", 'SA_ITEM', MENU_ENTRY);
			


	
	
	



					
			$this->add_extensions();
			
			
		

		}
	}

?>