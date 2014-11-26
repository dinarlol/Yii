<?php

class SearchFilters extends AkimboPortlet{
	
public $model;
	
	protected function renderContent()
	{
	
		$this->render('searchFilters/searchFilter',array('model'=>$this->model));
	}
	
	
	
}
?>