<?php
class AkimboNuggetManager{
	private $person;
	private $user_recomendation_details = array();



	const USER_ROLE = 'USER';
	const  COMPANY_ROLE = 'COMPANY';
	const  ADMIN_ROLE = 'ADMIN';
	
	
	const REGISTERED_GROUP = 'REGISTERED';
	const  SPECIAL_GROUP = 'SPECIAL';
	const  PUBLIC_GROUP = 'PUBLIC';


	const IMAGE_EDIT = 'images/edit.png';
	const IMAGE_DELETE = 'images/delete.png';

	//company categories
	public static  $category_companyAboutMe = 'CompanyAboutMe';
	//user categories
	public static  $category_userDetails = 'userDetails';
	public static  $category_workexperience = 'workExperience';

	public static  $category_academic = 'academics';
	public  static $category_userAwards = 'userAwards';
	public static  $category_userAboutMe = 'AboutMe';
	public static  $category_businessIntrepreneurships = 'businessIntrepreneurships';

	public  static  $category_userMusics = 'userMusic';
	public static  $category_militaryServices = 'militaryServices';
	public static  $category_userVisualArts = 'userVisualArts';
	public  static $category_userVolunteerisms = 'volunteerisms';
	public static  $category_userStories = 'userStories';
	public static  $category_scienceTechnologys = 'userScienceTechnologys';
	public  static  $category_userPerformingArts = 'userPerformingArts';
	public static  $category_userFitness = 'userFitness';
	public static  $category_userDesignTechnology = 'userDesignTechnology';
	public  static  $category_userWritingLiterature = 'userWritingLiterature';
	public static  $category_travel = 'travel';
	public  static  $category_culinaryArts = 'userCulinaryArts';

	// SPANS USED FOR ICONS



	//company categories
	public static  $span_companyAboutMe = 'about';
	//user categories
	public static  $span_userDetails = 'userDetails';
	public static  $span_workexperience = 'work';

	public static  $span_academic = 'academic';
	public  static  $span_userAwards = 'awards';
	public static  $span_userAboutMe = 'about';
	public static  $span_businessIntrepreneurships = 'business';
	public  static  $span_userMusics = 'music';
	public static  $span_userMilitaryServices = 'military';
	public static  $span_userVisualArts = 'visual';
	public  static  $span_userVolunteerisms = 'community';
	public static  $span_userStories = 'story';
	public static  $span_scienceTechnologys = 'science';
	public  static  $span_userPerformingArts = 'arts';
	public static  $span_userFitness = 'fitness';
	public static  $span_userDesignTechnology = 'design';
	public  static  $span_userWritingLiterature = 'writing';
	public static  $span_travel = 'travel';
	public  static  $span_culinaryArts = 'culinary';



	//content type for uploading

	public static $content_type_video = 'video';
	public static $content_type_photo = 'photo';
	public static $content_type_document = 'document';

	//content type for uploading relational name
	const CONTENT_TYPE_IMAGE_RELATION_NAME = 'photo_uploader';
	const CONTENT_TYPE_VIDEO_RELATION_NAME = 'video_uploader';
	const CONTENT_TYPE_DOCUMENT_RELATION_NAME = 'document_uploader';


	// content type array for uploading attachements , the element name for uploading should match the value of content type set in here
	public static $upload_content_type_array = array('video','photo','document');


	public static function getUploadDirectory($contenttype,$user_id,$category){


		// make the directory to store the pic:
		if(!is_dir(Yii::getPathOfAlias('webroot')."/$contenttype/$user_id/". $category)) {

			if(!is_dir(Yii::getPathOfAlias('webroot')."/$contenttype/")) {
				mkdir(Yii::getPathOfAlias('webroot')."/$contenttype/");
				chmod(Yii::getPathOfAlias('webroot')."/$contenttype/",0755);
					
				// the default implementation makes it under 777 permission, which you could possibly change recursively before deployment, but here's less of a headache in case you don't
			}
			if(!is_dir(Yii::getPathOfAlias('webroot')."/$contenttype/$user_id/")) {
				mkdir(Yii::getPathOfAlias('webroot')."/$contenttype/$user_id/");
				chmod(Yii::getPathOfAlias('webroot')."/$contenttype/$user_id/",0755);
				// the default implementation makes it under 777 permission, which you could possibly change recursively before deployment, but here's less of a headache in case you don't
			}
			if(!is_dir(Yii::getPathOfAlias('webroot')."/$contenttype/$user_id/". $category)) {
				mkdir(Yii::getPathOfAlias('webroot')."/$contenttype/$user_id/". $category);
				chmod(Yii::getPathOfAlias('webroot')."/$contenttype/$user_id/". $category,0755);
				// the default implementation makes it under 777 permission, which you could possibly change recursively before deployment, but here's less of a headache in case you don't
			}
		}
		return "/$contenttype/$user_id/". $category;

	}


	public static function  getSqlCurrentDate(){
		return  date('Y-m-d H:i:s');
	}



	public static function uploadAllAttachments($category_id,$category_pk_id,$destination_id=NULL,$new=true){
		foreach (self::$upload_content_type_array as $upload_content_type){
			self::uploadAttachments($upload_content_type, $category_id, $category_pk_id,$destination_id,$new);

		}

	}

	public static function uploadAttachments($content_type_upload,$category_id,$category_pk_id,$destination_id=NULL,$new=true){
		
		$uploads =  CUploadedFile::getInstancesByName($content_type_upload);
		if (isset($uploads) && count($uploads) > 0) {
			// go through each uploaded upload
			foreach ($uploads as $upload => $pic) {
				$fileLocation = self::getUploadDirectory($content_type_upload, Yii::app()->user->id, $category_id).'/';
				if ($pic->saveAs(Yii::getPathOfAlias('webroot').$fileLocation.$pic->name)) {
					// add it to the main model now
					switch ($content_type_upload){
						case self::$content_type_document:
							$upload_add = new DocumentUploader();
							break;
						case self::$content_type_video:
							$upload_add = new VideoUploader();
							break;
						case self::$content_type_photo:
							$upload_add = new PhotoUploader();
							break;
						default:
							return;
						break;
					}
					$upload_add->size = $pic->size;
					$upload_add->name = $pic->name; //it might be $upload_add->name for you, filename is just what I chose to call it in my model
					$upload_add->destination_id = $destination_id; // this links your picture model to the main model (like your user, or profile model)
					$upload_add->user_id = Yii::app()->user->id;
					$upload_add->location = $fileLocation;
					$upload_add->modified_date = self::getSqlCurrentDate();
					$upload_add->create_date = $upload_add->modified_date;
					$upload_add->category_id = $category_id;
					$upload_add->category_pk_id = $category_pk_id;
					if($new){
						if($upload_add->save()){
						}
						else{ print_r($upload_add);exit;
						}
					} // DONE

					else{
						$upload_add->update();
					}
				}
				else{
					// handle the errors here, if you want
				}
			}

		}

		return true;
	}

	public static function uploadReplaceAttachments($content_type_upload,$category_id,$category_pk_id,$destination_id=NULL){
		$uploads =  CUploadedFile::getInstancesByName($content_type_upload);
		if (isset($uploads) && count($uploads) > 0) {
			// go through each uploaded upload
			foreach ($uploads as $upload => $pic) {
				$fileLocation = self::getUploadDirectory($content_type_upload, Yii::app()->user->id, $category_id).'/';
				if ($pic->saveAs(Yii::getPathOfAlias('webroot').$fileLocation.$pic->name)) {
					$criteria = new CDbCriteria();
					$criteria->compare('user_id',Yii::app()->user->id);
					$criteria->compare('category_id',$category_id);
					$criteria->compare('category_pk_id',$category_pk_id);
					// add it to the main model now
					switch ($content_type_upload){
						case self::$content_type_document:
							$upload_add = DocumentUploader::model()->find($criteria);
							if(empty($upload_add))
								$upload_add = new DocumentUploader();
							break;
						case self::$content_type_video:
							$upload_add =  VideoUploader::model()->find($criteria);
							if(empty($upload_add))
								$upload_add = new VideoUploader();
							break;
						case self::$content_type_photo:
							$upload_add = PhotoUploader::model()->find($criteria);
							if(empty($upload_add))
								$upload_add = new PhotoUploader();
							break;
						default:
							return;
						break;
					}


					if(!empty($upload_add->id)){
						if(Yii::app()->user->id == $upload_add->user_id && (!empty($upload_add))){

							unlink(Yii::getPathOfAlias('webroot').$upload_add->location.$upload_add->name);


							$upload_add->size = $pic->size;
							$upload_add->name = $pic->name; //it might be $upload_add->name for you, filename is just what I chose to call it in my model
							$upload_add->destination_id = $destination_id; // this links your picture model to the main model (like your user, or profile model)
							$upload_add->user_id = Yii::app()->user->id;
							$upload_add->location = $fileLocation;
							$upload_add->modified_date = self::getSqlCurrentDate();
							$upload_add->update();

						}
					}
					else{
							
						$upload_add->size = $pic->size;
						$upload_add->name = $pic->name; //it might be $upload_add->name for you, filename is just what I chose to call it in my model
						$upload_add->destination_id = $destination_id; // this links your picture model to the main model (like your user, or profile model)
						$upload_add->user_id = Yii::app()->user->id;
						$upload_add->location = $fileLocation;
						$upload_add->modified_date = self::getSqlCurrentDate();
						$upload_add->create_date = $upload_add->modified_date;
						$upload_add->category_id = $category_id;
						$upload_add->category_pk_id = $category_pk_id;
						$upload_add->save();
					}
				}
				else{
					// handle the errors here, if you want
				}
			}

		}

		return true;
	}

	public static function deleteUploadedAttachments($content_type_upload,$attachment_id){




		switch ($content_type_upload){
			case self::$content_type_document:
				$upload_delete = DocumentUploader::model()->findByPk($attachment_id);
				break;
			case self::$content_type_video:
				$upload_delete = VideoUploader::model()->findByPk($attachment_id);
				break;
			case self::$content_type_photo:
				$upload_delete = PhotoUploader::model()->findByPk($attachment_id);
				break;
			default:
				break;

		}
		if(!empty($upload_delete)){
			if(Yii::app()->user->id == $upload_delete->user_id){


				if($upload_delete->delete()){
					try {
					unlink(Yii::getPathOfAlias('webroot').$upload_delete->location.$upload_delete->name);
				}
				catch (Exception $ex){
					
					
				}
				}
				else{

					//print_r($upload_delete);
					//exit;
				}
			}

			else
				throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
			;

		}



		return true;


	}

	public static function deleteNuggetWithUploadedAttachments($model){

		foreach (self::$upload_content_type_array as $contentName){
			$contentType = $contentName.'_uploader';
			if(!empty($model->$contentType)){
				foreach ($model->$contentType as $content){
					if($content->delete())
						unlink(Yii::getPathOfAlias('webroot').$content->location.$content->name);

				}
			}
			else{
					
				//print_r($model);
			}

		}

		if($model->delete())
			return true;
		else return false;


	}



	public static function deleteNuggetWithSingleUploadedAttachments($model){

		foreach (self::$upload_content_type_array as $contentName){
			$contentType = $contentName.'_uploader';
			if(!empty($model->$contentType)){
				if($model->$contentType->delete())
					unlink(Yii::getPathOfAlias('webroot').$model->$contentType->location.$model->$contentType->name);


			}
			else{

				//print_r($model);
			}

		}

		if($model->delete())
			return true;
		else return false;


	}




	// getting all the nuggets associated with company

	public static function getAllCompanyNuggets(){


		$nuggets = array();


		$categories = Category::model()->findAll('type=?',array('Company'));


		foreach ($categories as $category){

			// setting nuggets title
			$nuggets[$category->name]['title'] = $category->description;
			//setting nuggets category
			$nuggets[self::$category_companyAboutMe]['category'] = $category->name;
			// setting icons span for nuggets
			$nuggets[self::$category_companyAboutMe]['span'] = $category->profile_span;
		}


		return $nuggets;


	}

	public static function getAllNuggets(){



		$nuggets = array();

		// setting nuggets title
		$nuggets['userDetails']['title'] ='User Details';
		$nuggets['workexperience']['title'] ='Work Experience';
		$nuggets['Academics']['title'] ='Academics';
		$nuggets['userAwards']['title'] ='Awards/Recognitions';
		$nuggets['userAboutMe']['title'] ='About Me';
		$nuggets['businessIntrepreneurships']['title'] ='Business/Intrepreneurships';
		$nuggets['userMusics']['title'] ='Music';
		$nuggets['userMilitaryServices']['title'] ='Military Service';
		$nuggets['userVisualArts']['title'] ='Visual Arts';
		$nuggets['userVolunteerisms']['title'] ='Volunteerisms/Comunity';
		$nuggets['userStories']['title'] ='My Story';
		$nuggets['scienceTechnologys']['title'] ='Science & Technology';
		$nuggets['userPerformingArts']['title']  ='Performing Arts';
		$nuggets['userFitness']['title'] ='Athletics/Fitness';
		$nuggets['userDesignTechnology']['title'] ='Design & Technology';
		$nuggets['userWritingLiterature']['title'] ='Writing/Literature';
		$nuggets['travel']['title'] ='Travel';
		$nuggets[self::$category_culinaryArts]['title'] ='Culinary Arts';

		//setting nuggets category
		$nuggets['userDetails']['category'] = self::$category_userDetails;
		$nuggets['workexperience']['category'] = self::$category_workexperience;
		$nuggets['Academics']['category'] = self::$category_academic;
		$nuggets['userAwards']['category'] = self::$category_userAwards;
		$nuggets['userAboutMe']['category'] = self::$category_userAboutMe;
		$nuggets['businessIntrepreneurships']['category'] = self::$category_businessIntrepreneurships;
		$nuggets['userMusics']['category'] = self::$category_userMusics;
		$nuggets['userMilitaryServices']['category'] = self::$category_militaryServices;
		$nuggets['userVisualArts']['category'] = self::$category_userVisualArts;
		$nuggets['userVolunteerisms']['category'] = self::$category_userVolunteerisms;
		$nuggets['userStories']['category'] = self::$category_userStories;
		$nuggets['scienceTechnologys']['category'] = self::$category_scienceTechnologys;
		$nuggets['userPerformingArts']['category']  = self::$category_userPerformingArts;
		$nuggets['userFitness']['category'] = self::$category_userFitness;
		$nuggets['userDesignTechnology']['category'] = self::$category_userDesignTechnology;
		$nuggets['userWritingLiterature']['category'] = self::$category_userWritingLiterature;
		$nuggets['travel']['category'] = self::$category_travel;
		$nuggets[self::$category_culinaryArts]['category'] = self::$category_culinaryArts;


		// setting icons span for nuggets
		$nuggets['userDetails']['span'] = self::$span_userDetails;
		$nuggets['workexperience']['span'] = self::$span_workexperience;
		$nuggets['Academics']['span'] = self::$span_academic;
		$nuggets['userAwards']['span'] = self::$span_userAwards;
		$nuggets['userAboutMe']['span'] = self::$span_userAboutMe;
		$nuggets['businessIntrepreneurships']['span'] = self::$span_businessIntrepreneurships;
		$nuggets['userMusics']['span'] = self::$span_userMusics;
		$nuggets['userMilitaryServices']['span'] = self::$span_userMilitaryServices;
		$nuggets['userVisualArts']['span'] = self::$span_userVisualArts;
		$nuggets['userVolunteerisms']['span'] = self::$span_userVolunteerisms;
		$nuggets['userStories']['span'] = self::$span_userStories;
		$nuggets['scienceTechnologys']['span'] = self::$span_scienceTechnologys;
		$nuggets['userPerformingArts']['span']  = self::$span_userPerformingArts;
		$nuggets['userFitness']['span'] = self::$span_userFitness;
		$nuggets['userDesignTechnology']['span'] = self::$span_userDesignTechnology;
		$nuggets['userWritingLiterature']['span'] = self::$span_userWritingLiterature;
		$nuggets['travel']['span'] = self::$span_travel;
		$nuggets[self::$category_culinaryArts]['span'] = self::$span_culinaryArts;



		return $nuggets;
	}


	public function __construct($person){
		$this->person = $person;
	}

	public static function getNuggetsBox($nugget,$userid){

		$data = array();
		switch ($nugget){
			case 'academics':
				$data = Academics::model()->findAll('user_id=?',array($userid));
				$data=CHtml::listData($data,'id','school');
				break;
			case self::$c:
				$data =UserWorkExperience::model()->findAll('user_id=?',array($userid));
				$data=CHtml::listData($data,'id','organization');
				break;
			case 'useraboutme':
				$data =UserAboutMe::model()->findAll('user_id=?',array($userid));
				$data=CHtml::listData($data,'id','objective');
				break;
			case 'usermilitaryservices':
				$data =UserMilitaryService::model()->findAll('user_id=?',array($userid));
				$data=CHtml::listData($data,'id','devision');
				break;
			case 'userawards':
				$data =UserAwards::model()->findAll('user_id=?',array($userid));
				$data=CHtml::listData($data,'id','award');
				break;
			case 'businessintrepreneurships':
				$data =BusinessIntrepreneurship::model()->findAll('user_id=?',array($userid));
				$data=CHtml::listData($data,'id','relevant_business_projects');
				break;
			case 'usermusics':
				$data =UserMusic::model()->with('field')->findAll('user_id=?',array($userid));
				$data=CHtml::listData($data,'field.id','field.name');
				break;
			case 'uservisualarts':
				$data =UserVisualArts::model()->with('visualArt')->findAll('user_id=?',array($userid));
				$data=CHtml::listData($data,'visualArt.id','visualArt.name');
				break;
			case 'uservolunteerisms':
				$data =UserVolunteerism::model()->findAll('user_id=?',array($userid));
				$data=CHtml::listData($data,'id','cause');
				break;
			case 'userstories':
				$data =UserStory::model()->findAll('user_id=?',array($userid));
				$data=CHtml::listData($data,'id','story');
				break;
			case 'sciencetechnologys':
				$data =ScienceTechnology::model()->findAll('user_id=?',array($userid));
				$data=CHtml::listData($data,'id','field_of_study');
				break;
			case 'userperformingarts':
				$data =UserPerformingArts::model()->with('performArt')->findAll('user_id=?',array($userid));
				//print_r($data->field);exit;
				$data=CHtml::listData($data,'performArt.id','performArt.name');
				break;
			case 'userfitness':
				$data =UserFitness::model()->with('details','details.collegeTeams')->findAll('user_id=?',array($userid));
				//print_r($data);exit;
				$data=self::listData($data,'details.id','details.collegeTeams.name');
				//$data=CHtml::listData($data,'id','details.collegeTeams.name');
				break;
			case 'userdesigntechnology':
				$data =UserDesign::model()->with('designTechnology')->findAll('user_id=?',array($userid));
				$data=CHtml::listData($data,'designTechnology.id','designTechnology.name');
				//$data=CHTML::listData($data,'designTechnology.id','designTechnology.name');
				break;
			case 'userwritingliterature':
				$data =UserWritingLiterature::model()->with('userReadBooks','userReadBooks.book')->findAll('user_id=?',array($userid));
				//foreach ()
				$data=self::listData($data,'userReadBooks.id','userReadBooks.book.name');
				break;
			case 'travel':
				$data =UserTravel::model()->with('destinations')->findAll('user_id=?',array($userid));
				//print_r($data->field);exit;
				$data=CHtml::listData($data,'destinations.id','destinations.name');
				break;
			case 'culinaryarts':
				$data =culinaryArts::model()->findAll('user_id=?',array($userid));
				//print_r($data->field);exit;
				$data=CHtml::listData($data,'id','name');
				break;

			default:


		}

		return $data;


	}

	public static function listData($models,$valueField,$textField,$groupField='')
	{
		$listData=array();
		if($groupField==='')
		{
			foreach($models as $model)
			{
				$value=self::value($model,$valueField);
				$text=self::value($model,$textField);
				$listData[$value]=$text;

			}
		}
		else
		{
			foreach($models as $model)
			{
				$group=self::value($model,$groupField);
				$value=self::value($model,$valueField);
				$text=self::value($model,$textField);
				$listData[$group][$value]=$text;
			}
		}
		return $listData;
	}

	/**
	 * Evaluates the value of the specified attribute for the given model.
	 * The attribute name can be given in a dot syntax. For example, if the attribute
	 * is "author.firstName", this method will return the value of "$model->author->firstName".
	 * A default value (passed as the last parameter) will be returned if the attribute does
	 * not exist or is broken in the middle (e.g. $model->author is null).
	 * The model can be either an object or an array. If the latter, the attribute is treated
	 * as a key of the array. For the example of "author.firstName", if would mean the array value
	 * "$model['author']['firstName']".
	 * @param mixed $model the model. This can be either an object or an array.
	 * @param string $attribute the attribute name (use dot to concatenate multiple attributes)
	 * @param mixed $defaultValue the default value to return when the attribute does not exist
	 * @return mixed the attribute value
	 * @since 1.0.5
	 */
	public static function value($model,$attribute,$defaultValue=null)
	{
		foreach(explode('.',$attribute) as $name)
		{

			if(is_object($model)){
				$model=$model->$name;
				echo "START -- name is $name  Model --";
				if(is_array($model) ){
					foreach ($model as $modelarray){
						if(isset($modelarray[$name])){
							$model = $modelarray[$name];
							echo " UPPER model found $name ".$model->name;
							break;
						}

						else if(is_object($modelarray)){
							$model=$modelarray;
							echo " Got the model -- name is $name  Model --";
							break;
						}
						else{
							//print_r();
							echo "  ---   not UPPER found --";
						}
					}

					//$model=$model[$name];

				}

			}
			else if(is_array($model) && isset($model[$name])){

				$model=$model[$name];
				echo "START -- name is $name  Array --";
			}
			else if(is_array($model) ){
				foreach ($model as $modelarray){
					if(isset($modelarray[$name])){
						$model = $modelarray[$name];
						echo "model found $name ".$model->name;
						break;
					}
					else{
						echo "  ---   not found --";
					}
				}

				//$model=$model[$name];
				echo "START -- name is $name  Array --";
			}
			else{
				return $defaultValue;
			}
		}
		//print_r($model);
		return $model;
	}



	public static function getRecomendationCount($userid,$categoryid,$category_pk_id){
		return UserRecomendations::model()->count(array('condition'=>'t.user_id='.$userid.' AND t.category_id='.$categoryid.'  AND t.category_pk_id='.$category_pk_id));
	}

	public static function getShownRecomendationCount($userid,$categoryid,$category_pk_id){
		return UserRecomendations::model()->count(array('condition'=>'t.user_id='.$userid.' AND t.show=1	 AND t.category_id='.$categoryid.' AND t.category_pk_id='.$category_pk_id));
	}

	public function getRecomendationStats(){
		return $this->user_recomendation_details;
	}


	public function createRecomendationStatsByCategoryId($catid){

		$category = Category::model()->findByPk($catid);



		switch(strtolower($category->name)){

			case strtolower(self::$category_workexperience):
				$this->setUserWorkExperiences();
				break;
			case strtolower(self::$category_academic):
				$this->setUserAcademics();
				break;
			case strtolower(self::$category_userAwards):
				$this->setUserAwards();
				break;
			case strtolower(self::$category_businessIntrepreneurships):
				$this->setBusinessIntrepreneurships();
				break;
			case strtolower(self::$category_userMusics):
				$this->setUserMusics();
				break;
			case strtolower(self::$category_militaryServices):
				$this->setUserMilitaryServices();
				break;
			case strtolower(self::$category_userVisualArts):
				$this->setUserVisualArts();
				break;
			case strtolower(self::$category_userVolunteerisms):
				$this->setUserVolunteerisms();
				break;
			case strtolower(self::$category_userStories):
				$this->setUserStories();
				break;
			case strtolower(self::$category_scienceTechnologys):
				$this->setScienceTechnologys();
				break;
			case strtolower(self::$category_userPerformingArts):
				$this->setUserPerformingArts();
				break;
			case strtolower(self::$category_userFitness):
				$this->setUserFitness();
				break;

			case strtolower(self::$category_userDesignTechnology):
				$this->setUserDesignTechnology();
				break;
			case strtolower(self::$category_userWritingLiterature):
				$this->setUserWritingLiterature();
				break;
			case strtolower(self::$category_travel):
				$this->setUserTravel();
				break;
			case strtolower(self::$category_culinaryArts):
				$this->setCulinaryArts();
				break;
			default:
				break;
		}


	}


	public function setUserWorkExperiences(){
		if(!empty($this->person->userWorkExperiences)){
			$category = Category::model()->find('LOWER(name)=?',array(strtolower(self::$category_workexperience)));
			foreach ($this->person->userWorkExperiences as $detail){
				$count = self::getRecomendationCount($detail->user_id, $category->id, $detail->id);
				$this->user_recomendation_details[self::$category_workexperience][]= array('position'=>'position','category_id'=>$category->id,'id'=> $detail->id,'title'=>$detail->title,'organization'=>$detail->organization,'count'=>self::getRecomendationCount($detail->user_id, $category->id, $detail->id),'visible'=>self::getShownRecomendationCount($detail->user_id, $category->id, $detail->id));
			}


		}
	}


	public function setUserAcademics(){

		if(!empty($this->person->userAcademics)){
			$category = Category::model()->find('LOWER(name)=?',array(strtolower(self::$category_academic)));
			foreach ($this->person->userAcademics as $detail){
				$this->user_recomendation_details[self::$category_academic][]= array('position'=>'education','category_id'=>$category->id,'id'=> $detail->id,'title'=>'Student','organization'=>$detail->school,'count'=>self::getRecomendationCount($detail->user_id, $category->id, $detail->id),'visible'=>self::getShownRecomendationCount($detail->user_id, $category->id, $detail->id));

			}


		}

	}

	public  function setUserAwards(){
		if(!empty($this->person->userAwards)){
			$category = Category::model()->find('LOWER(name)=?',array(strtolower(self::$category_userAwards)));
			foreach ($this->person->userAwards as $detail){
				$this->user_recomendation_details[self::$category_userAwards][]= array('position'=>'award','category_id'=>$category->id,'id'=> $detail->id,'title'=>'Award won','organization'=>$detail->award,'count'=>self::getRecomendationCount($detail->user_id, $category->id, $detail->id),'visible'=>self::getShownRecomendationCount($detail->user_id, $category->id, $detail->id));

			}
		}

	}


	public function setBusinessIntrepreneurships(){

		if(!empty($this->person->businessIntrepreneurships)){
			$category = Category::model()->find('LOWER(name)=?',array(strtolower(self::$category_businessIntrepreneurships)));
			foreach ($this->person->businessIntrepreneurships as $detail){
				$this->user_recomendation_details[self::$category_businessIntrepreneurships][]= array('position'=>'business intrepreneurships','category_id'=>$category->id,'id'=> $detail->id,'title'=>'Business/Intrepreneurships','organization'=>$detail->ventures,'count'=>self::getRecomendationCount($detail->user_id, $category->id, $detail->id),'visible'=>self::getShownRecomendationCount($detail->user_id, $category->id, $detail->id));
			}
		}
	}


	public function setUserMusics(){
		if(!empty($this->person->userMusics) ){
			$category = Category::model()->find('LOWER(name)=?',array(strtolower(self::$category_userMusics)));
			foreach ($this->person->userMusics as $details){
				foreach ($details->userMusicDetails as $detail){
					$this->user_recomendation_details[self::$category_userMusics][]= array('position'=>'Music','category_id'=>$category->id,'id'=> $details->id,'title'=>'Music','organization'=>$detail->field->name,'count'=>self::getRecomendationCount($details->user_id, $category->id, $details->id),'visible'=>self::getShownRecomendationCount($details->user_id, $category->id, $details->id));
				}
			}
		}

	}


	public function setUserMilitaryServices(){
		if(!empty($this->person->userMilitaryServices)){
			$category = Category::model()->find('LOWER(name)=?',array(strtolower(self::$category_militaryServices)));
			foreach ($this->person->userMilitaryServices as $detail){
				$this->user_recomendation_details[self::$category_militaryServices][]= array('position'=>'Service','category_id'=>$category->id,'id'=> $detail->id,'title'=>'Military Services','organization'=>$detail->branch->name,'count'=>self::getRecomendationCount($detail->user_id, $category->id, $detail->id),'visible'=>self::getShownRecomendationCount($detail->user_id, $category->id, $detail->id));

			}
		}

	}
	public function setUserVisualArts(){
		if(!empty($this->person->userVisualArts) ){
			$category = Category::model()->find('LOWER(name)=?',array(strtolower(self::$category_userVisualArts)));
			foreach ($this->person->userVisualArts as $detail){
				$this->user_recomendation_details[self::$category_userVisualArts][]= array('position'=>'visual art','category_id'=>$category->id,'id'=> $detail->id,'title'=>'Visual Arts','organization'=>$detail->visualArt->name,'count'=>self::getRecomendationCount($detail->user_id, $category->id, $detail->id),'visible'=>self::getShownRecomendationCount($detail->user_id, $category->id, $detail->id));

			}
		}

	}

	public function setUserVolunteerisms(){
		if(!empty($this->person->userVolunteerisms)){
			$category = Category::model()->find('LOWER(name)=?',array(strtolower(self::$category_userVolunteerisms)));
			$vdetails = $this->person->userVolunteerisms->userVolunteerismDetails;
			foreach ($vdetails as $detail){
				$this->user_recomendation_details[self::$category_userVolunteerisms][]= array('position'=>'volunteerism','category_id'=>$category->id,'id'=> $detail->id,'title'=>'Volunteer','organization'=>$detail->nonprofitOrganizationCauses->nonprofitOrganization->name,'count'=>self::getRecomendationCount($this->person->id, $category->id, $detail->id),'visible'=>self::getShownRecomendationCount($this->person->id, $category->id, $detail->id));


			}
		}


	}


	public function setUserStories(){

		if(!empty($this->person->userStories)){
			$category = Category::model()->find('LOWER(name)=?',array(strtolower(self::$category_userStories)));
			foreach ($this->person->userStories as $detail){
				$this->user_recomendation_details[self::$category_userStories][]= array('position'=>'story','category_id'=>$category->id,'id'=> $detail->id,'title'=>'Story','organization'=>$detail->story,'count'=>self::getRecomendationCount($this->person->id, $category->id, $detail->id),'visible'=>self::getShownRecomendationCount($this->person->id, $category->id, $detail->id));

			}


		}
	}

	public function setScienceTechnologys(){
		if(!empty($this->person->scienceTechnologys)){
			$category = Category::model()->find('LOWER(name)=?',array(strtolower(self::$category_scienceTechnologys)));
			foreach ($this->person->scienceTechnologys as $detail){
				$this->user_recomendation_details[self::$category_scienceTechnologys][]= array('position'=>'science','category_id'=>$category->id,'id'=> $detail->id,'title'=>'Science Technology','organization'=>$detail->field_of_study,'count'=>self::getRecomendationCount($this->person->id, $category->id, $detail->id),'visible'=>self::getShownRecomendationCount($this->person->id, $category->id, $detail->id));

			}

		}

	}


	public function setUserPerformingArts(){

		if(!empty($this->person->userPerformingArts)){
			$category = Category::model()->find('LOWER(name)=?',array(strtolower(self::$category_userPerformingArts)));
			foreach ($this->person->userPerformingArts as $detail){
				$this->user_recomendation_details[self::$category_userPerformingArts][]= array('position'=>'performing','category_id'=>$category->id,'id'=> $detail->id,'title'=>'Perform Art','organization'=>$detail->performArt->name,'count'=>self::getRecomendationCount($this->person->id, $category->id, $detail->id),'visible'=>self::getShownRecomendationCount($this->person->id, $category->id, $detail->id));


			}
		}
	}


	public function setUserFitness(){

		if(!empty($this->person->userFitness)){

			$category = Category::model()->find('LOWER(name)=?',array(strtolower(self::$category_userFitness)));
			foreach ($this->person->userFitness->details as $detail){

				if(!empty($detail->collegeTeams)){

					$this->user_recomendation_details[self::$category_userFitness][]= array('position'=>'college team','category_id'=>$category->id,'id'=> $detail->id,'title'=>'Fitness','organization'=>$detail->collegeTeams->name,'count'=>self::getRecomendationCount($this->person->id, $category->id, $detail->id),'visible'=>self::getShownRecomendationCount($this->person->id, $category->id, $detail->id));


				}
				if(!empty($detail->schoolTeams)){

					$this->user_recomendation_details[self::$category_userFitness][]= array('position'=>'school team','category_id'=>$category->id,'id'=> $detail->id,'title'=>'Fitness','organization'=>$detail->schoolTeams->name,'count'=>self::getRecomendationCount($this->person->id, $category->id, $detail->id),'visible'=>self::getShownRecomendationCount($this->person->id, $category->id, $detail->id));

				}

				if(!empty($detail->otherTeams)){

					$this->user_recomendation_details[self::$category_userFitness][]= array('position'=>'other team','category_id'=>$category->id,'id'=> $detail->id,'title'=>'Fitness','organization'=>$detail->otherTeams->name,'count'=>self::getRecomendationCount($this->person->id, $category->id, $detail->id),'visible'=>self::getShownRecomendationCount($this->person->id, $category->id, $detail->id));

				}




			}
		}
	}

	public function setUserDesignTechnology(){
		if(!empty($this->person->userDesignTechnology)){

			$category = Category::model()->find('LOWER(name)=?',array(strtolower(self::$category_userDesignTechnology)));
			foreach ($this->person->userDesignTechnology as $detail){
				$this->user_recomendation_details[self::$category_userDesignTechnology][]= array('position'=>'technology','category_id'=>$category->id,'id'=> $detail->id,'title'=>'Design Technology','organization'=>$detail->designTechnology->name,'count'=>self::getRecomendationCount($this->person->id, $category->id, $detail->id),'visible'=>self::getShownRecomendationCount($this->person->id, $category->id, $detail->id));
			}

		}

	}

	public function setUserWritingLiterature(){
		if(!empty($this->person->userWritingLiterature)){

			$category = Category::model()->find('LOWER(name)=?',array(strtolower(self::$category_userWritingLiterature)));
			foreach ($this->person->userWritingLiterature as $detail){

				if(!empty($detail->userReadBooks)){
					foreach ($detail->userReadBooks as $readBooks)
						$this->user_recomendation_details[self::$category_userWritingLiterature][]= array('position'=>'reading','category_id'=>$category->id,'id'=> $detail->id,'title'=>'Read Book','organization'=>$readBooks->book->name,'count'=>self::getRecomendationCount($this->person->id, $category->id, $detail->id),'visible'=>self::getShownRecomendationCount($this->person->id, $category->id, $detail->id));

				}
			}



		}

	}

	public function setUserTravel(){

		if(!empty($this->person->travel)){
			$category = Category::model()->find('LOWER(name)=?',array(strtolower(self::$category_travel)));
			foreach ($this->person->travel as $detail){
					
				$this->user_recomendation_details[self::$category_travel][]= array('position'=>'tour','category_id'=>$category->id,'id'=> $detail->id,'title'=>'Travel','organization'=>$detail->destination->name,'count'=>self::getRecomendationCount($this->person->id, $category->id, $detail->id),'visible'=>self::getShownRecomendationCount($this->person->id, $category->id, $detail->id));

			}


		}
	}

	public function setCulinaryArts(){

		if(!empty($this->person->culinaryArts)){

			$category = Category::model()->find('LOWER(name)=?',array(strtolower(self::$category_culinaryArts)));
			foreach ($this->person->culinaryArts as $detail){
				$this->user_recomendation_details[self::$category_culinaryArts][]= array('position'=>'culinary','category_id'=>$category->id,'id'=> $detail->id,'title'=>'Culinary Arts','organization'=>$detail->name,'count'=>self::getRecomendationCount($this->person->id, $category->id, $detail->id),'visible'=>self::getShownRecomendationCount($this->person->id, $category->id, $detail->id));

			}

		}
	}


	public function createRecomendationStats(){

		$this->setUserWorkExperiences();
		$this->setUserAcademics();
		$this->setUserAwards();
		$this->setBusinessIntrepreneurships();
		$this->setUserMusics();
		$this->setUserMilitaryServices();
		$this->setUserVisualArts();
		$this->setUserVolunteerisms();
		$this->setUserStories();
		$this->setScienceTechnologys();
		$this->setUserPerformingArts();
		$this->setUserFitness();
		$this->setUserDesignTechnology();
		$this->setUserWritingLiterature();
		$this->setUserTravel();
		$this->setCulinaryArts();




	}


}
?>
