

<div class="search_widget">

<?php 

$time_utility = new Time();

$this->widget('AkimboSearchView', array(
	'id'=>'person-grid',
	'dataProvider'=>$dataProvider,
	'filter'=>$dataProvider,
		'cssFile'=>'css/pager.css',
	'pager'=>array('htmlOptions' =>array('class'=>'pages'),),	
	'columns'=>array(
			/*array(
					'name'=>'companys.name',
					'value'=>'empty($data->companys)?"":$data->companys->name',
			
			),
			
			
			*/

			// start user avatar
			
/*			
			array(
					'type' => 'raw',
					'name'=>'user.userDetails.avatar',
					'value'=>'empty($data->recomender->userDetails->avatar)?$data->recomender->role->name==$data->userRole?"<a id=\"user_avatar".$data->recomender->id."\" href=\"index.php?r=employee/profile&id=".$data->recomender->id."\"><img width=\"55\" height=\"54\" class=\"avatar\" src=\"images/avatar.png\"></a>":"":"<a href=\"index.php?r=employee/profile&id=".$data->recomender->id."\"><img width=\"55\" height=\"54\" class=\"avatar\" src=\"images/".$data->recomender->userDetails->avatar."\"></a>"',
			
			),
			
	
			*/

// finished user avatar

			
			// html define for full name
			array(
					'type' => 'raw',
					'name'=>'recomender.userDetails.first_name',
					'value'=>'empty($data->recomender->userDetails->first_name)?"":"<span class=\"name\"><h3>".$data->recomender->userDetails->first_name." "',
			
			
			
			),
			array(
					'type' => 'raw',
					'name'=>'recomender.userDetails.last_name',
					'value'=>'empty($data->recomender->userDetails->last_name)?"":$data->recomender->userDetails->last_name."</h3></span>"',
			
			),
			// end first name
			
			// start location details for recomender
			
			
			array(
					'type' => 'raw',
					'name'=>'recomender->userDetails.country',
					'value'=>'empty($data->recomender->userDetails->country)?"":"<span class=\"location\">".$data->recomender->userDetails->country." "',
			
			),
			
			array(
					'type' => 'raw',
					'name'=>'recomender->userDetails.state',
					'value'=>'empty($data->recomender->userDetails->state)?"":", ".$data->recomender->userDetails->state." "',
			
			),
			
			array(
					'type' => 'raw',
					'name'=>'recomender->userDetails.city',
					'value'=>'empty($data->recomender->userDetails->city)?"":", ".$data->recomender->userDetails->city."</span> "',
			
			),


			// finished location details

			
			// start comments

			
			
			array(
					'type' => 'raw',
					'name'=>'comments',
					'value'=>'empty($data->comments)?"":"<span class=\"profession\">".$data->comments."</span>"',
			
			),
			
			
			
			array(
					'type' => 'raw',
					'name'=>'create_date',
					//'value'=>'empty($data->create_date)?"":"<span class=\"green\">".$time_utility->timeAgoInWords($data->create_date)."</span>"',
					'value'=>'empty($data->create_date)?"":"<span class=\"green\">".date("M j, Y h:m a", strtotime($data->create_date))."</span>"',
					//'value'=>'date("M j, Y", $data->create_time)',
			
			),
			
			

			



				//finished comments


			// start category
			array(	'type' => 'raw',
					'name'=>'category.name',
					'value'=>'empty($data->category->description)?"":"<span class=\"education\">".$data->category->description."</span>"',
			
			),
			
			
			
			
			
			/*
			array(	'type' => 'raw',
					'name'=>'category.name',
					'value'=>'empty($data->{$data->category->name}->id)?"":"<span class=\"education\">".$data->{$data->category->name}->id."</span>"',
			
			),
			*/
			// finished category
			
			
			
			
			
		/*
		'lng',
		'lat',
		'create_date',
		'modified_date',
		*/
		
	),
))
?>





</div>