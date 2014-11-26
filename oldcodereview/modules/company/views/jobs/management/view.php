
<?php 

/*
 * 
 * /*
    echo CHtml::beginForm();
    $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'job-management-grid',
        'dataProvider'=>$dataProvider,
        'cssFile'=>false,
        'itemsCssClass'=>'dataGrid',
        'filterCssClass'=>'center',
        'filterPosition'=>Yii::app()->params['gridFilterPosition'],
        'columns'=>array(
            array('header'=>'','name'=>'code', 'type'=>'raw', 'value'=>'CHtml::tag(\'div\',array(\'class\'=>\'open-details\',\'id\'=>\'shDe_\'.$data->stud_code),\' \',true)', 'filter'=>false),
            array('header'=>'Student', 'name'=>'stud_code', 'type'=>'raw', 'value'=>'CHtml::tag(\'span\', array(), Users::formatFullName($data->student),true)'),
            array('header'=>'Level', 'type'=>'raw', 'value'=>'CHtml::tag(\'span\', array(), $data->term->level->level,true)'),
            array('header'=>'Program Group', 'type'=>'raw', 'value'=>'CHtml::tag(\'span\', array(), $data->term->prog_group->program_group,true)'),
            array('header'=>'Invalid','type'=>'raw', 'value'=>'CHtml::tag(\'span\', array(), $data->absInvalid,true)'),
            array('header'=>'Valid','type'=>'raw', 'value'=>'CHtml::tag(\'span\', array(), $data->absValid,true)'),
            array('header'=>'Total','type'=>'raw', 'value'=>'CHtml::tag(\'span\', array(), $data->absTotal,true)'),
        )
    ));
    echo CHtml::endForm();
*/


?>


<?php echo CHtml::beginForm(); ?>



<?php  
		$this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'job-management-grid',
        'dataProvider'=>$model->search(),
        'filter'=>$model,
        'pager'=>array(
        'header'=>'',
        'firstPageLabel'=>'<<',
        'prevPageLabel'=>'<',
        'nextPageLabel'=>'>',
        'lastPageLabel'=>'>>',
    ),
        'columns'=>array(
                 

        		// html define for full name
        		array(
        				'type' => 'raw',
        				'name'=>'applicant.userDetails.first_name',
        				'value'=>'empty($data->applicant->userDetails->first_name)?"":"<span class=\"name\"><h3>".$data->applicant->userDetails->first_name." "',
        		
        		
        		),
        		array(
        				'type' => 'raw',
        				'name'=>'applicant.userDetails.last_name',
        				'value'=>'empty($data->applicant->userDetails->last_name)?"":$data->applicant->userDetails->last_name."</h3></span>"',
        		
        		),
        		
        		array(
        				'type' => 'raw',
        				'name'=>'visitdate',
        				'value'=>'empty($data->visitdate)?"":$data->visitdate."</h3></span>"',
        		
        		),
        		
        		/*
        		array(
        				'class' => 'FlagColumn',
        				'name' => 'application_status',
        		),
        */ 	
        array(
            'name'=>'status',
        		'type' =>'raw',
           // 'value'=>'$data->application_status',
            'value' =>'CHtml::activeDropDownList($data, "application_status", array("ACCEPT"=>"Short List","REJECT"=>"REJECT","DELETE"=>"Delete"),
                      array("empty"=>"Action","onchange"=>"acceptApplicant(this)","submit"=>Yii::app()->createUrl("company/jobs/applicationStatus",
                      array("statsId"=>$data->id,"id"=>$data->job->id))))',
        		
        		'filter'=> array("ACCEPTED"=>"Short List","REJECTED"=>"REJECTED"),
                'htmlOptions'=>array('width'=>'90px'),
        ),
        		/*
        		array( 'class'=>'CLinkColumn',
                        'header'=>'Send Mail',
                        'labelExpression'=>'$data->applicant->userDetails->first_name',
                        'urlExpression'=>'Yii::app()->createUrl("participant/list",array("lastname"=>$data->applicant->userDetails->last_name))',
                        'linkHtmlOptions'=>array('title'=>'Contact'))
        		,
        		
       */
        		
        		
        		array('type' =>'raw',
        				'name' => 'send_message',
        				'value'=>'CHtml::ajaxLink("Send Message", Yii::app()->createAbsoluteUrl("company/jobs/sendMessage",array("id"=>$data->user_id,"jobId"=>$data->job->id)),array("update"=>"#send-job-message-div"))'
        				
        				)
        		
               /* array(
                        'class'=>'CButtonColumn',
                ),
                */
        ),
));
		?>
		
		<?php echo CHtml::endForm(); ?>