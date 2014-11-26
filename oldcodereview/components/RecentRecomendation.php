<?php

class RecentRecomendation extends AkimboPortlet{


	const RECENT_RECOMMENDATION = 'RECENT_RECOMMENDATION';
	const JOB_RECOMMENDATION = 'JOB_RECOMMENDATION';


	public $count;
	public $type =self::RECENT_RECOMMENDATION;
	public function getRecomendations()
	{
		if(Yii::app()->user->isUser){
			$recomendations = new UserRecomendations();
			$recomendations->user_id = Yii::app()->user->id;
			$this->count =$recomendations->count($recomendations->getCriteria());
			return  $recomendations->search()->getData();
		}

		else if(Yii::app()->user->isCompany){
				
			if($this->type == self::JOB_RECOMMENDATION){
				$recomendations = new JobRecommendations();
				$recomendations->user_id = Yii::app()->user->id;
				$this->count =$recomendations->count($recomendations->getCriteria());
				return  $recomendations->search()->getData();
			}

		}

	}

	protected function renderContent()
	{
		if(Yii::app()->user->isUser){
		$this->render('recentRecomendation');
		}
		
		else if(Yii::app()->user->isCompany){
			$this->render('recommendations/jobs');
			
		}
	}



}
?>