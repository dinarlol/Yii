<?php

class RecomendMe extends AkimboPortlet{
	
	public $person;
	public $profile;
	public $model;
	public $nuggets;
	public $user_id;
	
	public function setRecomendationWidget()
	{
		$this->model = new UserRecomendations();
		$this->model->recomender_id = Yii::app()->user->id;
		$this->person = Person::model()->findByPk($this->user_id);
		$this->profile = new EmployeeProfile($this->person);
		$this->nuggets =$this->profile->getFilledProfileNuggetsForRecomendation();
		
		
		
		
	}
	
	public function init(){
		$this->setRecomendationWidget();
	}
	
	protected function renderContent()
	{
		$this->render('recomendMe');
	}
	
	
	
}
?>