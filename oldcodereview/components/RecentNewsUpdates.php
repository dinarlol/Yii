<?php

class RecentNewsUpdates extends AkimboPortlet{
	

	
	protected function renderContent()
	{
		$this->render('recentNewsUpdates');
	}
	
	public function getPersonForRecentNewsUpdates(){
	
		return Person::model()->findByPk(Yii::app()->user->id);
	
	
	
	}
	
}
?>