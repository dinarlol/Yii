<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'post-job-_form-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary(array($model,$postJobModel,$postJobRequirement)); ?>
                
        <div class="row">
		<?php echo $form->labelEx($model,'job_title'); ?>
		<?php echo $form->textField($model,'job_title'); ?>
		<?php echo $form->error($model,'job_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'job_category_id'); ?>
		<?php echo  $form->DropDownList($model,'job_category_id',CHtml::listData(CareerLevel::model()->findAll(), 'id', 'name'),
                            array('empty'=>'Job Category'));?>
		<?php echo $form->error($model,'job_category_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'job_publishing_date'); ?>
		<?php $this->widget('application.extensions.jui.EDatePicker',array(
	          'name'=>'job_publishing_date','attribute'=>'job_publishing_date', 'model'=>$model,  
	          'language'=>'en','mode'=>'imagebutton','theme'=>'redmond','value'=>date('Y-m-d'),
	          'htmlOptions'=>array('size'=>15),'fontSize'=>'0.8em'
	         ));?>
		<?php echo $form->error($model,'job_publishing_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'job_expiredate'); ?>
		<?php $this->widget('application.extensions.jui.EDatePicker',array(
	          'name'=>'job_expiredate','attribute'=>'job_expiredate', 'model'=>$model,  
	          'language'=>'en','mode'=>'imagebutton','theme'=>'redmond','value'=>date('Y-m-d'),
	          'htmlOptions'=>array('size'=>15),'fontSize'=>'0.8em'
	         ));?>
		<?php echo $form->error($model,'job_expiredate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'job_type_id'); ?>
		<?php echo  $form->DropDownList($model,'job_type_id',CHtml::listData(JobType::model()->findAll(), 'id', 'name'),
                            array('empty'=>'Job Type'));?>
		<?php echo $form->error($model,'job_type_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'job_description'); ?>
		<?php echo $form->textArea($model,'job_description'); ?>
		<?php echo $form->error($model,'job_description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'number_of_post'); ?>
		<?php echo $form->textField($model,'number_of_post'); ?>
		<?php echo $form->error($model,'number_of_post'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo  $form->DropDownList($model,'status',array("ENABLE"=>"ENABLE","DISABLE"=>"DISABLE"),
                            array('empty'=>'Job Status'));?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($postJobModel,'country'); ?>
		<?php echo $form->textField($postJobModel,'country'); ?>
		<?php echo $form->error($postJobModel,'country'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($postJobModel,'city'); ?>
		<?php echo $form->textField($postJobModel,'city'); ?>
		<?php echo $form->error($postJobModel,'city'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($postJobRequirement,'gender'); ?>
		<?php echo  $form->DropDownList($postJobRequirement,'gender',array("MALE"=>"MALE","FEMALE"=>"FEMALE"),
                            array('empty'=>'Choose Gender'));?>
		<?php echo $form->error($postJobRequirement,'gender'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($postJobRequirement,'degree_level_id'); ?>
		<?php echo  $form->DropDownList($postJobRequirement,'degree_level_id',CHtml::listData(DegreeLevel::model()->findAll(), 'id', 'name'),
                            array('empty'=>'Degree Level'));?>
		<?php echo $form->error($postJobRequirement,'degree_level_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($postJobRequirement,'career_level_id'); ?>
		<?php echo  $form->DropDownList($postJobRequirement,'career_level_id',CHtml::listData(CareerLevel::model()->findAll(), 'id', 'name'),
                            array('empty'=>'Career Level'));?>
		<?php echo $form->error($postJobRequirement,'career_level_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($postJobRequirement,'experience'); ?>
		<?php echo $form->textField($postJobRequirement,'experience'); ?>
		<?php echo $form->error($postJobRequirement,'experience'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($postJobRequirement,'experience_in'); ?>
		<?php echo  $form->DropDownList($postJobRequirement,'experience_in',array("MONTH"=>"MONTH","YEAR"=>"YEAR","DAY"=>"DAY"),
                            array('empty'=>'Experience In'));?>
		<?php echo $form->error($postJobRequirement,'experience_in'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'job_keywords'); ?>
		<?php echo $form->textField($model,'job_keywords'); ?>
		<?php echo $form->error($model,'job_keywords'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($postJobRequirementOpt,'degree_title'); ?>
		<?php echo $form->textField($postJobRequirementOpt,'degree_title'); ?>
		<?php echo $form->error($postJobRequirementOpt,'degree_title'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($postJobRequirementOpt,'work_permit'); ?>
		<?php echo $form->radioButtonList($postJobRequirementOpt,'work_permit',array('0'=>"Yes",'1'=>"No")); ?>
		<?php echo $form->error($postJobRequirementOpt,'work_permit'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($postJobRequirementOpt,'travel_required'); ?>
		<?php echo $form->radioButtonList($postJobRequirementOpt,'travel_required',array('0'=>"Yes",'1'=>"No")); ?>
		<?php echo $form->error($postJobRequirementOpt,'travel_required'); ?>
	</div>
        <div class="row">
		<?php echo $form->labelEx($postJobRequirementOpt,'job_shift'); ?>
		<?php echo  $form->DropDownList($postJobRequirementOpt,'job_shift',array("MORNING"=>"MORNING",
                                "EVENING"=>"EVENING","NIGHT"=>"NIGHT","ROTATE"=>"ROTATE"),
                                 array('empty'=>'Job Shift'));?>
		<?php echo $form->error($postJobRequirementOpt,'job_shift'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($postJobRequirementOpt,'age_min'); ?>
		<?php echo $form->textField($postJobRequirementOpt,'age_min'); ?>
		<?php echo $form->error($postJobRequirementOpt,'age_min'); ?>
            
	</div>
        <div class="row">
		<?php echo $form->labelEx($postJobRequirementOpt,'age_max'); ?>
		<?php echo $form->textField($postJobRequirementOpt,'age_max'); ?>
		<?php echo $form->error($postJobRequirementOpt,'age_max'); ?>
            
	</div>
       
        <div class="row">
		<?php echo $form->labelEx($postJobRequirementOpt,'salary_range_id'); ?>
		<?php echo  $form->DropDownList($postJobRequirementOpt,'salary_range_id',CHtml::listData(SalaryRanges::model()->findAll(), 'id', 'discription'),
                            array('empty'=>'Salary Range'));?>
		<?php echo $form->error($postJobRequirementOpt,'salary_range_id'); ?>
            
	</div>
        
         <div class="row">
		<?php echo $form->labelEx($postJobRequirementOpt,'skills'); ?>
		<?php echo $form->textArea($postJobRequirementOpt,'skills'); ?>
		<?php echo $form->error($postJobRequirementOpt,'skills'); ?>
            
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($postJobRequirementOpt,'restrict_text'); ?>
		<?php echo $form->textArea($postJobRequirementOpt,'restrict_text'); ?>
		<?php echo $form->error($postJobRequirementOpt,'restrict_text'); ?>
            
	</div>
        
	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->