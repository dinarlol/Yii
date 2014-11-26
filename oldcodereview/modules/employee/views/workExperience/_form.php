<div class="form-container">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-work-experience-form',
	'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
	'clientOptions'=>array('validateOnSubmit'=>true, 'validateOnType'=>false),
        
 )); ?>
<script type="text/javascript">
    function validate(data)
    {
      	if(data.search("Organization cannot be blank.")!=-1){
            $("#UserWorkExperience_organization_em_").replaceWith("<div id=\"UserWorkExperience_organization_em_\" class=\"errorMessage\" style=\"\">Organization cannot be blank.</div>");
       }else{
            $("#UserWorkExperience_organization_em_").hide();
       }
       if(data.search("Sector cannot be blank.")!=-1){
            $("#UserWorkExperience_sector_id_em_").replaceWith("<div id=\"UserWorkExperience_sector_id_em_\" class=\"errorMessage\" style=\"\">Sector cannot be blank.</div>");
       }else{
            $("#UserWorkExperience_sector_id_em_").hide();
       }
       
       if(data.search("refresh form")!=-1)
       {
           var currentLoc = window.location; 
           var newLoc = "<?php echo Yii::app()->createUrl("employee/nuggetsCreator/index&hash=workExperience")?>";
           //alert(newLoc);
           window.location = newLoc;
           
       }
       
    }
    </script>
    <fieldset>
        <legend>Work Experience</legend>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
	<?php echo $form->errorSummary($model); ?>
	<div class="row">
		<?php //echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->hiddenField($model,'user_id',array('value'=>$user_id)); ?>
		<?php //echo $form->error($model,'user_id'); ?>
		
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'organization'); ?>
		<?php echo $form->textField($model,'organization',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'organization'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sector_id'); ?>
		<?php echo  $form->DropDownList($model,'sector_id',CHtml::listData(JobSectors::model()->findAll(), 'id', 'name'),array('empty'=>'Select Job Sector'));?>
		<?php echo $form->error($model,'sector_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'website_url'); ?>
		<?php echo $form->textField($model,'website_url',array('size'=>60,'maxlength'=>85)); ?>
		<?php echo $form->error($model,'website_url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'start_date'); ?>
		<?php //echo $form->textField($model,'start_date'); ?>
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
		<?php //echo $form->textField($model,'end_date'); ?>
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
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'job_duty'); ?>
		<?php echo $form->textField($model,'job_duty',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'job_duty'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_working'); ?>
		<?php //echo $form->textField($model,'is_working'); ?>
		<?php echo $form->DropDownList($model,'is_working',array("1"=>"Yes","0"=>"No"));?>
		<?php echo $form->error($model,'is_working'); ?>
	</div>
        
        <!-- 
	<div class="row">
		<?php echo $form->labelEx($model,'create_date'); ?>
		<?php echo $form->textField($model,'create_date'); ?>
		<?php echo $form->error($model,'create_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'modified_date'); ?>
		<?php echo $form->textField($model,'modified_date'); ?>
		<?php echo $form->error($model,'modified_date'); ?>
	</div>
 -->
	<div class="buttonrow">
		<?php //echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array("id"=>"test"));  
                if($model->isNewRecord){
                echo CHtml::ajaxSubmitButton("Save",  Yii::app()->createUrl("employee/workExperience/create"),
                        array('type' =>'POST','update' => '#ajaxResult','dataType' => 'html','success'=>'function(data){
                                    //validate(data);	
                        }',),array(
                            "id"=>"btnSubmit",
                        )); 
                }else{
                    echo CHtml::ajaxSubmitButton("Save",  Yii::app()->createUrl("employee/workExperience/update",array("id"=>$model->id)),
                        array('type' =>'POST','update' => '#ajaxResult','dataType' => 'html','success'=>'function(data){
                                    validate(data);	
                        }'),array( "id"=>"btnSubmit")); 
                }
                ?>
	</div>
 </fieldset>   

<?php $this->endWidget(); ?>

</div><!-- form -->