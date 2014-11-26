<?php


class RecentSiteMatrics extends AkimboPortlet{



	protected function renderContent()
	{
		$this->render('recentSiteMatrics');
	}
	
	public function getPersonForSiteMatrics(){
		
		return Person::model()->findByPk(Yii::app()->user->id);
		
		
		
	}



}
?>