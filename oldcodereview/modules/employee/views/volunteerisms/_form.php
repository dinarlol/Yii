<script type="text/javascript">
    function validate(data)
    {
      	if(data.search("Organization cannot be blank.")!=-1){
            $("#UserVolunteerism_organization_em_").replaceWith("<div id=\"UserVolunteerism_organization_em_\" class=\"errorMessage\" style=\"\">Organization cannot be blank.</div>");
       }else{
            $("#UserVolunteerism_organization_em_").hide();
       }
       if(data.search("Start Date cannot be blank.")!=-1){
            $("#UserVolunteerism_start_date_em_").replaceWith("<div id=\"UserVolunteerism_start_date_em_\" class=\"errorMessage\" style=\"\">Start Date cannot be blank.</div>");
       }else{
            $("#UserWorkExperience_sector_id_em_").hide();
       }
       if(data.search("End Date cannot be blank.")!=-1){
            $("#UserVolunteerism_end_date_em_").replaceWith("<div id=\"UserVolunteerism_end_date_em_\" class=\"errorMessage\" style=\"\">End Date cannot be blank.</div>");
       }else{
            $("#UserWorkExperience_sector_id_em_").hide();
       }
       
       if(data.search("refresh form")!=-1)
       {
           var currentLoc = window.location; 
           var newLoc = "<?php echo Yii::app()->createUrl("employee/nuggetsCreator/index&hash=volunteerisms")?>";
           //alert(newLoc);
           window.location = newLoc;
           
       }
       
    }
    </script>

<div class="form-container">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-volunteerism-form',
	'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
        'clientOptions'=>array('validateOnSubmit'=>true, 'validateOnType'=>false),
)); ?>
   
    <fieldset><legend>Volunteerism</legend>
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'organization'); ?>
		<?php		
                    $this->widget('CAutoComplete',
                array(
                 'name'=>'UserVolunteerism[organization]','model'=>$model, 'url'=>array('volunteerisms/autoCompleteOrganization'), 
                 'max'=>10, //specifies the max number of items to display
                            //specifies the number of chars that must be entered 
                             //before autocomplete initiates a lookup
                 'minChars'=>2, 'delay'=>500, //number of milliseconds before lookup occurs
                 'matchCase'=>false, //match case when performing a lookup?
                            //any additional html attributes that go inside of 
                             //the input field can be defined here
                 'htmlOptions'=>array('size'=>'40'), 
                 'value'=>(isset($model->organizations->name)) ? $model->organizations->name : "",       
                 
             ));
            ?>
            <?php echo $form->error($model,'organization'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cause'); ?>
		<?php		
                    $this->widget('CAutoComplete',
                array(
                 'name'=>'UserVolunteerism[cause]','model'=>$model, 'url'=>array('volunteerisms/autoCompleteCause'), 
                 'max'=>10, //specifies the max number of items to display
                            //specifies the number of chars that must be entered 
                             //before autocomplete initiates a lookup
                 'minChars'=>2, 'delay'=>500, //number of milliseconds before lookup occurs
                 'matchCase'=>false, //match case when performing a lookup?
                            //any additional html attributes that go inside of 
                             //the input field can be defined here
                 'htmlOptions'=>array('size'=>'40'), 
                 'value'=>$model->cause,       
                 //'methodChain'=>".result(function(event,item){\$(\"#user_id\").val(item[1]);})",
             ));
            ?>
		<?php echo $form->error($model,'cause'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'start_date'); ?>
		<?php $this->widget('application.extensions.jui.EDatePicker',
	     array(
	          'name'=>'start_date',
	          'attribute'=>'start_date', // Model attribute filed which hold user input
	          'model'=>$model,            // Model name
	          'language'=>'en',
	          'mode'=>'imagebutton',
	          'theme'=>'redmond',
	          'value'=>date('Y-m-d'),
	          'htmlOptions'=>array('size'=>15),
	          'fontSize'=>'0.8em'
	         )
	      );?>
		<?php echo $form->error($model,'start_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'end_date'); ?>
		<?php $this->widget('application.extensions.jui.EDatePicker',
	     array(
	          'name'=>'end_date',
	          'attribute'=>'end_date', // Model attribute filed which hold user input
	          'model'=>$model,            // Model name
	          'language'=>'en',
	          'mode'=>'imagebutton',
	          'theme'=>'redmond',
	          'value'=>date('Y-m-d'),
	          'htmlOptions'=>array('size'=>15),
	          'fontSize'=>'0.8em'
	         )
	      );?>
		<?php echo $form->error($model,'end_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'impact'); ?>
		<?php //echo $form->textField($model,'impact',array('size'=>60,'maxlength'=>145)); ?>
                <?php echo $form->textArea($model,'impact',array('size'=>60,'maxlength'=>145)); ?>
		<?php echo $form->error($model,'impact'); ?>
	</div>
       
     
        <div class="row">
		<?php echo $form->labelEx($model,'mycauses'); ?>
		<?php //echo $form->textField($model,'impact',array('size'=>60,'maxlength'=>145)); ?>
                <?php echo $form->textArea($model,'mycauses',array('size'=>60,'maxlength'=>145)); ?>
		<?php echo $form->error($model,'mycauses'); ?>
	</div>
       

	<div class="buttonrow">
		<?php //echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
                <?php 
                if($model->isNewRecord){
                
                echo CHtml::ajaxSubmitButton($model->isNewRecord ? 'Create' : 'Update',  
                        Yii::app()->createUrl("employee/volunteerisms/create"),
                                array('type' =>'POST',  'update' => '#ajaxResult','dataType' => 'html','success'=>'function(data){
                                         validate(data);
                                   }',),array(
                                    "id"=>"btn_submit_aboutme1","class"=>"basicBtn")
                           );
                }else{
                    echo CHtml::ajaxSubmitButton($model->isNewRecord ? 'Create' : 'Update',  
                        Yii::app()->createUrl("employee/volunteerisms/update",array("id"=>$model->id)),
                                array('type' =>'POST',  'update' => '#ajaxResult','dataType' => 'html','success'=>'function(data){
                                         validate(data);
                                   }',),array("id"=>"btn_submit_aboutme1","class"=>"basicBtn")
                    );
                }
                ?>
	</div>
        </fieldset>

<?php $this->endWidget(); ?>

</div><!-- form -->