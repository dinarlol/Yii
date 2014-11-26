<div class="search_widget">

<h1>Jobs</h1>


<?php /* $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
    
));*/ ?>




<?php $this->widget('AkimboSearchView', array(
		'summaryText' => '',
	'id'=>'search-grid',
	'dataProvider'=>$dataProvider,
	'cssFile'=>'css/pager.css',
	'pager'=>array('htmlOptions' =>array('class'=>'pages'),),	
	'columns'=>array(
		
			/*array(
					'name'=>'companys.name',
					'value'=>'empty($data->companys)?"":$data->companys->name',
			
			),
			*/
			
			

			// start jOB tITLE
			array(
					'type' => 'raw',
					'name'=>'job_title',
					'value'=>'empty($data->job_title)?"":"<span class=\"name\"><h3><a id=\"user_contact".$data->id."\" href=\"index.php?r=company/managePost/view&id=".$data->id."\">".$data->job_title."</a></h3></span>"',
			),
			
			// finished Job Title

			
			
			// start category

			
			array(
					'type' => 'raw',
					'name'=>'jobCategory.name',
					'value'=>'empty($data->jobCategory->name)?"":"<span class=\"location\">".$data->jobCategory->name."</span>"',
			
			
			),
			
			//finished category
			
			
			// start jOB desc
			array(
					'type' => 'raw',
					'name'=>'job_description',
					'value'=>'empty($data->job_description)?"":"<span class=\"profession\">".$data->job_description."</span>"',
			),
			
			// finished Job desc

			
			// start number of post
			array(
					'type' => 'raw',
					'name'=>'number_of_post',
					'value'=>'empty($data->number_of_post)?"":"<span class=\"education\"><h3>Applications ".$data->number_of_post."</h3></span>"',
			),
			
			// finished number of post


			
			// start number of post
			array(
					'type' => 'raw',
					'name'=>'job_publishing_date',
					'value'=>'empty($data->job_publishing_date)?"":"<span class=\"name\"><h3>Date Posted ".$data->job_publishing_date."</h3></span>"',
			),
			
			
			array(
					'type' => 'raw',
					'name'=>'status',
					'value'=>'empty($data->status)?"":"<span class=\"location\"><h4>status ".$data->status."</h4></span>"',
			),
			
			// finished number of post
			
			
			
			
			
			
			
			
				// html define for full name
		
						
			//start Industry
/*			
			array(
					'type' => 'raw',
					'name'=>'companys.industry.name',
					'value'=>'empty($data->companys->industry->name)?"":"<span class=\"profession\">".$data->companys->industry->name."</span>"',
			
			),
			// finished industry
			
			
			// start education 
			array(	'type' => 'raw',
					'name'=>'userAcademics.school',
					'value'=>'empty($data->userAcademics[0]->school)?"":"<span class=\"education\">".$data->userAcademics[0]->school."</span>"',
			
			),
			
			// finished education

			
			// start company size
			array(	'type' => 'raw',
					'name'=>'companys.range.range',
					'value'=>'empty($data->companys->range->range)?"":"<span class=\"education\"> employees: ".$data->companys->range->range."</span>"',
			
			),
			
			// finished company size
			
			
			// last to add note or message

			
	*/		
			array(
					'type' => 'raw',
					'name'=>'mini_btn',
					'value'=>'$data->employer_id == Yii::app()->user->getId()?"<span class=\"mini_btn\">
    <ul>
    <li><a id=\"user_contact".$data->id."\" href=\"index.php?r=company/managePost/update&id=".$data->id."\">Edit</a></li>
    <li><a id=\"user_profile".$data->id."\" href=\"index.php?r=company/managePost/update&id=".$data->id."\">Delete</a></li>
    </ul></span>":"<span class=\"mini_btn\">
    <ul>
    <li><a id=\"user_contact".$data->id."\"  onclick=\"$(\'#job-recomendations-dialog\').dialog(\'open\');$(\'#job_id\').val(\'".$data->id."\');\"   href=\"#\" >Recommend</a></li>
    <li><a id=\"user_profile".$data->id."\" href=\"index.php?r=company/managePost/update&id=".$data->id."\">Delete</a></li>
    </ul></span>"',
			
			),

		
	),
)); ?>

</div>

<?php 

echo $this->renderPartial('recommender', array('model'=>$recommender,'groups'=>$groups));

?>
