<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-details-form',
	'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
        'clientOptions'=>array('validateOnSubmit'=>true, 'validateOnType'=>false,'validateOnChange'=>false),
        'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>
<script type="text/javascript">
    function validate(data)
    {
        if(data.search("First Name cannot be blank.")!=-1){
         $("#UserDetails_first_name_em_").replaceWith("<div id=\"UserDetails_first_name_em_\" class=\"errorMessage\" style=\"\">First Name cannot be blank.</div>");
        }else{
            $("#UserDetails_first_name_em_").hide();
        }
        
        if(data.search("Last Name cannot be blank.")!=-1){
         $("#UserDetails_last_name_em_").replaceWith("<div id=\"UserDetails_last_name_em_\" class=\"errorMessage\" style=\"\">Last Name cannot be blank.</div>");
        }else{
            $("#UserDetails_last_name_em_").hide();
        }
        
        if(data.search("Country cannot be blank.")!=-1){
         $("#UserDetails_country_em_").replaceWith("<div id=\"UserDetails_country_em_\" class=\"errorMessage\" style=\"\">Country cannot be blank.</div>");
        }else{
            $("#UserDetails_country_em_").hide();
        }
        
        if(data.search("Dob cannot be blank.")!=-1){
         $("#UserDetails_dob_em_").replaceWith("<div id=\"UserDetails_dob_em_\" class=\"errorMessage\" style=\"\">Dob cannot be blank.</div>");
        }else{
            $("#UserDetails_dob_em_").hide();
        }
        
        if(data.search("Street cannot be blank.")!=-1){
         $("#UserDetails_street_em_").replaceWith("<div id=\"UserDetails_street_em_\" class=\"errorMessage\" style=\"\">Street cannot be blank.</div>");
        }else{
            $("#UserDetails_street_em_").hide();
        }
       
    }
</script>    

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'first_name'); ?>
		<?php echo $form->textField($model,'first_name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'first_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'last_name'); ?>
		<?php echo $form->textField($model,'last_name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'last_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dob'); ?>
		<?php echo $form->textField($model,'dob'); ?>
		<?php echo $form->error($model,'dob'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'country'); ?>
		<?php echo $form->textField($model,'country',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'country'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'city'); ?>
		<?php echo $form->textField($model,'city',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'city'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'state'); ?>
		<?php echo $form->textField($model,'state',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'state'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'street'); ?>
		<?php echo $form->textField($model,'street',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'street'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'zip'); ?>
		<?php echo $form->textField($model,'zip',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'zip'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>
        
        <div>
            <?php 
		if(!empty($model->photo_uploader)){
			echo CHtml::image(Yii::app()->baseUrl.$model->photo_uploader->location.$model->photo_uploader->name,$model->photo_uploader->name,array('class'=>'avatar','width'=>'130','height'=>'140'));
	
			echo CHtml::encode($model->photo_uploader->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($model->photo_uploader->name); ?>
	<br />
	
	<?php } ?>
	
	
		<?php echo $form->labelEx($model,'logo'); ?>
		
		<?php $this->widget('CMultiFileUpload', array(
				'id'=>'logo_upload',
				'name'=>AkimboNuggetManager::$content_type_photo,
				'accept' => 'jpg',
				'denied' => 'Picture should be in .jpg format',
		)); ?>
		
        </div>

	

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
                <?php echo CHtml::ajaxSubmitButton("Save2",  Yii::app()->createUrl("employee/userDetails/update",array("id"=>$model->id)),
                        array(
			'type' =>'POST',
    			'update' => '#ajaxResult',
                        'dataType' => 'html',
			'success'=>'function(data){
                                    validate(data);	
			}',
                         
			),
                        array(
                            "id"=>"btnSubmit",
                        )
				
		); ?>
            
            
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->