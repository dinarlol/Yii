<div id="content_right"> 
  
  <!-- Right widgets -->
  <div class="widget">
   
   <!--Title-->
  
    <div class="head">
      <h5 class="iList">Filter Search Results</h5>
          
     </div>

    
   <div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'search-filter-form',
	'enableAjaxValidation'=>false,
        'enableClientValidation'=>false,
		'htmlOptions' =>array('class'=>'mainForm'),
        'clientOptions'=>array('validateOnSubmit'=>true, 'validateOnType'=>false, 'validateOnChange'=>false),

)); ?>


  <div class="rowElem noborder">
   
          <label> <?php echo $model->getAttributeLabel(
          		'keyword');?></label>
<div class="formRight">
<?php if(empty($model->keyword))
	$model->keyword = '';

?>

<div class="row">

		<?php echo $form->textField($model,'keyword'); ?>
		<?php echo $form->error($model,'keyword'); ?>
	</div>
	
	                        </div>
                        <div class="fix"></div>
        </div>
   
   <div class="rowElem">
   
          <label> <?php echo $model->getAttributeLabel(
          		'first_name');?></label>
<div class="formRight">
<?php if(empty($model->userDetails))
	$model->userDetails = new userDetails();

?>

<div class="row">


<?php 	$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
				'model'=>$model->userDetails,
				'attribute'=>'first_name',
				'sourceUrl' => Yii::app()->createAbsoluteUrl('/akimboAutocomplete/userfirstname'),
				'options'=>array(
						'minLength'=>'2',
				),
		
				'htmlOptions'=>array(
						'class'=>'input'
				),
		));?>

<?php echo $form->error($model->userDetails,'first_name'); ?>
	</div>
	
	                        </div>
                        <div class="fix"></div>
        </div>
        
      
         <div class="rowElem">
   
          <label> <?php echo $model->getAttributeLabel(
          		'last_name');?></label>
<div class="formRight">
<?php if(empty($model->userDetails))
	$model->userDetails = new userDetails();

?>

<div class="row">
<?php 	$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
				'model'=>$model->userDetails,
				'attribute'=>'last_name',
				'sourceUrl' => Yii::app()->createAbsoluteUrl('/akimboAutocomplete/userlastname'),
				'model' =>$model->userDetails,
				'options'=>array(
						'minLength'=>'2',
				),
		
				'htmlOptions'=>array(
						'class'=>'input'
				),
		));?>
				<?php echo $form->error($model->userDetails,'last_name'); ?>
	</div>
	
	                        </div>
                        <div class="fix"></div>
        </div>  
        
        
        
        
        
        
        
        <div class="rowElem">
                        <label> <?php echo $model->getAttributeLabel(
          		'country');?></label>
                        <div class="formRight">
                           <div class="row">
		<?php echo $form->DropDownList($model->userDetails,'country',CHtml::listData(userDetails::model()->findAll(array('select'=>'t.country',
    'group'=>'t.country',
    'distinct'=>true,
		)), 'country', 'country'),array('empty'=>'Select Country')); ?>
		<?php echo $form->error($model->userDetails,'country'); ?>
	</div>
                        </div>
                        <div class="fix"></div>
                    </div>
                    
                        <?php if(empty($model->userWorkExperiences))
	$model->userWorkExperiences = new userWorkExperience();
?>                
                     <div class="rowElem">
                     
                      	 <label> <?php echo $model->userWorkExperiences->getAttributeLabel(
          		'title');?></label>
                        <div class="formRight">
    
                           <div class="row">
			
		<?php 	$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
				'model'=>$model->userWorkExperiences,
				'attribute'=>'title',
				'sourceUrl' => Yii::app()->createAbsoluteUrl('/akimboAutocomplete/userWorkExperienceTitle'),
				'model' =>$model->userWorkExperiences,
				'options'=>array(
						'minLength'=>'2',
				),
		
				'htmlOptions'=>array(
						'class'=>'input'
				),
		));?>
		
		
		
		<?php echo $form->error($model->userWorkExperiences,'title'); ?>
	</div>
                        </div>
                        <div class="fix"></div>
                    </div>
                                         <?php if(empty($model->companys))
	$model->companys = new Company();
?>
                     <div class="rowElem">
                        <label> <?php echo $model->companys->getAttributeLabel(
          		'name');?></label>
                        <div class="formRight">
                            <div class="row">
		
		
		<?php 
	
		
		$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
				'model'=>$model->companys,
				'attribute'=>'name',
				'sourceUrl' => Yii::app()->createAbsoluteUrl('/akimboAutocomplete/companyname'),
				'model' =>$model->companys,
				'options'=>array(
						'minLength'=>'2',
				),
		
				'htmlOptions'=>array(
						'class'=>'input'
				),
		));
		
		
		?>
		
		<?php echo $form->error($model->companys,'name'); ?>
	</div>
                        </div>
                        <div class="fix"></div>
                    </div>
                    
                    
                                  <?php if(empty($model->userAcademics))
	$model->userAcademics = new userAcademic();
?>
                     <div class="rowElem">
                        <?php echo $form->labelEx($model->userAcademics,'school'); ?>
                        <div class="formRight">
                            <div class="row">
				
		
			<?php 
	
		
		$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
				'model'=>$model->userAcademics,
				'attribute'=>'school',
				'sourceUrl' => Yii::app()->createAbsoluteUrl('/akimboAutocomplete/useracademicschool'),
				'model' =>$model->userAcademics,
				'options'=>array(
						'minLength'=>'2',
				),
		
				'htmlOptions'=>array(
						'class'=>'input'
				),
		));
		
		
		?>
		<?php echo $form->error($model->userAcademics,'school'); ?>
	</div>
                        </div>
                        <div class="fix"></div>
                    </div>
                    
                    
                    
                <input type="submit" class="greyishBtn submitForm" value="Apply Filter">
                <div class="fix"></div>
                
                <?php $this->endWidget(); ?>
                </div>
                
    </div>      
      
<!-- Right Column End -->     
</div>