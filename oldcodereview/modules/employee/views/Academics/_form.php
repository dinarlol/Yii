<div class="fix"> </div>
<div class="form-container">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-academic-form',
	'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
        'clientOptions'=>array('validateOnSubmit'=>true, 'validateOnType'=>false),

)); ?>
<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
<script type="text/javascript">
$("document").ready(function(){
    $("#UserAcademic_major_subject_id").change(function(){
		var major_value = $("#UserAcademic_major_subject_id option:selected").text(); 
		if(major_value=="Other")
		{
			$("#div_major_other").show(100);
			
		}else{
			$("#div_major_other").hide(100);
			}
		return false;
	});
	$("#UserAcademic_minor_subject_id").change(function(){
		var major_value = $("#UserAcademic_minor_subject_id option:selected").text(); 
		if(major_value=="Other")
		{
			$("#div_minor_other").show(100);
		}else{
			$("#div_minor_other").hide(100);
			}
	});
      
	 
});
function validate(data)
{
	if(data.search("School cannot be blank.")!=-1){
        $("#UserAcademic_school_em_").replaceWith("<div id=\"UserAcademic_school_em_\" class=\"errorMessage\" style=\"\">School name cannot be blank.</div>");
           }else{
                $("#UserAcademic_school_em_").hide();
           }	
                if(data.search("Graduation Date cannot be blank.")!=-1){
                $("#UserAcademic_graduation_date_em_").replaceWith("<div id=\"UserAcademic_graduation_date_em_\" class=\"errorMessage\" style=\"\">Graduation date cannot be blank.</div>");
           }else{
                 $("#UserAcademic_graduation_date_em_").hide();
           }

           if(data.search("Major Subject cannot be blank.")!=-1){
                $("#UserAcademic_major_subject_id_em_").replaceWith("<div id=\"UserAcademic_major_subject_id_em_\" class=\"errorMessage\" style=\"\">Major Subject cannot be blank.</div>");
           }else{
                $("#UserAcademic_major_subject_id_em_").hide();
           }
           if(data.search("Minor Subject cannot be blank.")!=-1){
                $("#UserAcademic_minor_subject_id_em_").replaceWith("<div id=\"UserAcademic_minor_subject_id_em_\" class=\"errorMessage\" style=\"\">Minor Subject cannot be blank.</div>");
           }else{
                $("#UserAcademic_minor_subject_id_em_").hide();
           }
	
	 if(data.search("refresh form")!=-1)
         {
               var currentLoc = window.location; 
               var newLoc = "<?php echo Yii::app()->createUrl("employee/nuggetsCreator/index&hash=academic")?>";
               //alert(newLoc);
               window.location = newLoc;

         }	
    
}
</script>
<fieldset><legend>Academic</legend>
	<p class="note">Fields with <span class="required">*</span> are required.</p>
	<div id="ajaxResult"></div>
	<?php echo $form->errorSummary($model); ?>
	<div class="row">
		<?php echo $form->hiddenField($model,'user_id',array('value'=>$user_id)); ?>
	
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'school'); ?>
		<?php echo $form->textField($model,'school',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'school'); ?>
	</div>
	
	
	<div class="row">
	<?php echo $form->labelEx($model,'graduation_date'); ?>
		<?php $this->widget('application.extensions.jui.EDatePicker',
	     array(
	          'name'=>'graduation_date',
	          'attribute'=>'graduation_date', // Model attribute filed which hold user input
	          'model'=>$model,            // Model name
	          'language'=>'en',
	          'mode'=>'imagebutton',
	          'theme'=>'redmond',
	          'value'=>date('Y-m-d'),
	          'htmlOptions'=>array('size'=>15),
	          'fontSize'=>'0.8em'
	         )
	      );?>
	   	<?php echo $form->error($model,'major_subject_id'); ?>
	</div>
		
	<div class="row">
		<?php echo $form->labelEx($model,'major_subject_id'); ?>
		<?php echo  $form->DropDownList($model,'major_subject_id',CHtml::listData(Subject::model()->findAll(), 'id', 'name'),
                            array('empty'=>'Choose Subject'));?>
		<?php echo $form->error($model,'major_subject_id'); ?>
	</div>
		<!--  Optional  -->
		<div class="row" style="display: none;" id="div_major_other" >
		<?php echo $form->labelEx($model,'major_other'); ?>
		<?php echo $form->textField($model,'major_other'); ?>
		<?php echo $form->error($model,'major_other'); ?>
		</div>
	

		<div class="row">
                <?php echo $form->labelEx($model,'minor_subject_id'); ?>
                <?php echo $form->DropDownList($model,'minor_subject_id',CHtml::listData(Subject::model()->findAll(), 'id', 'name'),array('empty'=>'Choose Subject'));?>
                <?php echo $form->error($model,'minor_subject_id'); ?>
		</div>
		
		
		<!--  Optional  -->
	<div class="row" style="display: none;" id="div_minor_other" >
		<?php echo $form->labelEx($model,'minor_other'); ?>
		<?php echo $form->textField($model,'minor_other'); ?>
		<?php echo $form->error($model,'minor_other'); ?>
	</div>
	
	

	<div class="row">
		<?php echo $form->labelEx($model,'concentration'); ?>
            
		<?php echo $form->textField($model,'concentration',array('size'=>45,'maxlength'=>45,
                    'value'=>CHtml::encode(
                        (isset(UserEducationTitle::model()->findByPk($model->concentration)->name)) ? UserEducationTitle::model()->findByPk($model->concentration)->name : ""
                  ))); ?>
            
		<?php echo $form->error($model,'concentration'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gpa'); ?>
		<?php echo $form->textField($model,'gpa'); ?>
		<?php echo $form->error($model,'gpa'); ?>
	</div>
	
	<div class="buttonrow">
		<?php
		if($model->isNewRecord){
                echo CHtml::ajaxSubmitButton("Create",  Yii::app()->createUrl("employee/academics/create"),
                        array('type' =>'POST','update' => '#ajaxResult','dataType' => 'html','success'=>'function(data){
                                    validate(data);	
                        }',),array(
                            "id"=>"btn_create_academic",
                        )); 
                }else{
                    echo CHtml::ajaxSubmitButton("Save",  Yii::app()->createUrl("employee/academics/update",array("id"=>$model->id)),
                        array('type' =>'POST','update' => '#ajaxResult','dataType' => 'html','success'=>'function(data){
                                    validate(data);	
                        }'),array( "id"=>"btn_update_academic")); 
                }
		?>
	</div>
    </fieldset>

<?php $this->endWidget(); ?>

</div><!-- form -->