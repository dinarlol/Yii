<?php
class CompanyProfile{


	private $isNewlyRegisteredComapny = true;
	private $isLookingTohire = false;
	private $profile_nuggets_details = array();
	/**
	 * @var Company model Object for companies
	 */
	private $employer;
	



	public function __construct($employer){
		$this->employer = $employer;
		if(!empty($this->employer->companys->companyLookingToHire)){
			// needs to show it few times then hide it $this->isNewlyRegisteredComapny = false;
			if($this->employer->companys->companyLookingToHire->looking_to_hire == 'Yes')
			$this->isLookingTohire = true;
			else $this->employer->companys->companyLookingToHire->looking_to_hire = false;
		}
		else{
		//	print_r($this->employer->company->companyLookingToHire);exit;
		}
		
		if(!empty($this->employer->companys->companyDetails)){
			
			
				//$organization = ' at  <span class="red">'.$detail->description.'</span>';
				$this->profile_nuggets_details[AkimboNuggetManager::$category_companyAboutMe][]= array('title'=>$this->employer->companys->companyDetails->company_info,'date'=>$this->employer->companys->companyDetails->country,'organization'=>$this->employer->companys->name,'section'=>$this->employer->companys->name,'description'=>$this->employer->companys->companyDetails->description);
			
			
			
		}
		

	}

	public function isNewlyRegisteredComapny(){

		return $this->isNewlyRegisteredComapny;
	}

	public function isLookingTohire(){

		return $this->isLookingTohire;
	}
	
	public function  getProfileNuggetsDetail(){
		return $this->profile_nuggets_details;
		
	}
	



}

?>