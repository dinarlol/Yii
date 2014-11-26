<?php 
$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'users-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	
	<?php echo $form->textFieldRow($model,'full_name',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->passwordFieldRow($model,'password',array('class'=>'span5','maxlength'=>200)); ?>
        
        <?php echo $form->passwordFieldRow($model,'password_repeat',array('class'=>'span5','maxlength'=>200)); ?>

	<?php echo $form->textFieldRow($model,'user_name',array('class'=>'span5','readonly'=>'readonly')); ?>

	<?php echo $form->textFieldRow($model,'cnic',array('class'=>'span5')); ?>

        <?php echo $form->labelEx($model,'dob'); ?>
        
        <?php  
        
        $this->widget('zii.widgets.jui.CJuiDatePicker',array(
    
            'model' => $model,
            'attribute'=>'dob',
          
    // additional javascript options for the date picker plugin
     'options'=>array(
                'showAnim'=>'fold',
                "dateFormat"=>"yy-mm-dd",
                'changeMonth'=> true, 'changeYear'=> true,
          "yearRange" => "1935:1995", 
              ),
    'htmlOptions'=>array(
        'style'=>'height:20px;'
    ),
));
        
        ?>
        
  <?php echo $form->labelEx($model,'position'); ?>
        

	 <?php echo $form->radioButtonList($model, 'position_id', Position::getPositionArray(),array()); ?>
    
        <?php echo $form->labelEx($model,'gender'); ?>
         
        <?php echo $form->radioButtonList($model, 'gender_id', CHtml::listData(Gender::model()->findAll(), 'gender_id', 'gender')); ?>
        
	<?php echo $form->textFieldRow($model,'primary_email',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'secondry_email',array('class'=>'span5','maxlength'=>100)); ?>

        
	<?php echo $form->textFieldRow($model,'mobile',array('class'=>'span5','maxlength'=>100)); ?>
	
        <?php echo $form->labelEx($model,'country'); ?>
        
        <?php echo $form->dropDownList($model,'country_id', CHtml::listData(Country::model()->findAll(), 'country_id', 'country')
                ,array(
                    'empty'=>'---Select Country---',
                'ajax' => array(
                'type'=>'POST', //request type
                'url'=>CController::createUrl('lookup/cities'), //url to call.
                //Style: CController::createUrl('currentController/methodToCall')
                'update'=>'#city_id', //selector to update
                //'data'=>'js:javascript statement' 
                //leave out the data key to pass all form values through
                )),
                
               array('class'=>'span5')); ?>

	         
            
        <span id="city_id">
            
            <?php echo $form->dropDownList($model,'city_id', CHtml::listData(City::model()->findAll(), 'city_id', 'city')
                ,array(
                    'empty'=>'---Select City---',
               
                    
                    ),
                
               array('class'=>'span5')); ?>

        
            
            
        </span> 
	<?php echo $form->textAreaRow($model,'address',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->labelEx($model,'security_quest'); ?>
            
        <?php echo $form->dropDownList($model,'security_quest_id', CHtml::listData(SecurityInfo::model()->findAll(), 'security_quest_id', 'security_quest'), array('empty'=>'---Select Question---'), array('class'=>'span5')); ?>

	<?php echo $form->passwordFieldRow($model,'answer',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->passwordFieldRow($model,'pincode',array('class'=>'span5')); ?>

	<?php echo $form->passwordFieldRow($model,'mother_name',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->labelEx($model,'plan'); ?>
            
        <?php echo $form->radioButtonList($model, 'plan_id', CHtml::listData(Plan::model()->findAll(), 'plan_id', 'plan')); ?>

	<table class="product_table">
            <tr>   
                <td><?php echo $form->labelEx($model,'product'); ?></td>
            
        </tr>
            
            <tr>
                <td><?php echo $form->radioButtonList($model, 'product_id', CHtml::listData(Product::model()->findAll(), 'product_id', 'product'),array(
                'ajax' => array(
                'type'=>'POST',                
              'url'=>CController::createUrl('lookup/products'), 
                'update'=>'#prod_id',
                ),'return'=>true)


); ?></td>
            </tr>

<table id = "prod_id">

</table>
	

	<?php echo $form->labelEx($model,'payment_type'); ?>
            
        <?php echo $form->radioButtonList($model, 'payment_type_id', CHtml::listData(Payment::model()->findAll(), 'payment_type_id', 'payment_type'),array('onclick' => 'verifyPayment(this)'
)); ?>
        
        <div id="chargeother" style="display:none">
        <?php echo $form->textFieldRow($model,'other_username',array('class'=>'span1','maxlength'=>6)); ?>
        
          <span>
            <?php echo CHtml::ajaxButton('Send Payment Verification Code',
        array('lookup/otherCharge'),
        array(
            
            'update'=>'#chargebox',
            'data'=> "js:$('#users-form').serialize()",
            'type'=>'post',

        )
        
);?>    </span>
      
            <span id="chargebox"> </span>
            
            <?php echo $form->passwordFieldRow($model,'other_pin',array('class'=>'span1','maxlength'=>4)); ?>
        
        </div>
            

 <?php echo CHtml::CheckBox('terms_conditions','', array ('checked'=>'checked','value'=>'on','id'=>'terms')); ?>&nbsp;&nbspAccept Terms & Conditions


	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
                        'htmlOptions' => array(
                        'class'=>'signup')
		)); ?>
	</div>


        

<?php $this->endWidget(); ?>

        <script>

            function verifyPayment(source){
if($( 'input[name="Users[payment_type_id]"]:checked' ).val() == 2){
$("#chargeother").show();
}
else{
$("#chargeother").hide();
}
}
        </script>
