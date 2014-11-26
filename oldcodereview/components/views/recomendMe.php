    <?php 
    if($this->person->id !== Yii::app()->user->id){
    ?>
    <!-- Recommnedations widget -->
    <div class="widget">
      <div class="head">
        <h5 class="iHelp">Recomendations</h5>
        
        <div class="num"></div>
        </div>
      
      <!-- start user recomendation loop -->
   
      
      <div class="supTicket nobg">
        <div class="issueSummary"> <a class="floatleft" href="#"><img class="reset_thumb" src="images/icons/dark/star.png"></a>
          <div class="ticketInfo">
            <ul>
              <li>
              
        

		<?php echo CHtml::htmlButton('Recomend User',array('class'=>'greenBtn','type' => 'submit','onclick'=>'$("#user-recomendations-dialog").dialog("open"); return false;')); ?>

			
              </li>
            </ul>
            <div class="fix"></div>
          </div>
          <div class="fix"></div>
        </div>
      
       <div id="stylized" class="myform">

<?php $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
	'id'=>'user-recomendations-dialog',
		'cssFile'=>'',
		'options'=>array(
				'title'=>'Recomend User',
				'autoOpen'=>false,
				'modal'=>true,
				'width'=>300,
		),
)); ?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-recomendations-form',
	'enableAjaxValidation'=>true,
		'clientOptions'=>array('validateOnSubmit'=>true, 'validateOnType'=>false),
)); ?>
	

	
	
	
	
	<div>
  
  
  <input type="hidden" name="user_id" value="<?php echo $this->person->id;?>">
  <?php echo $form->labelEx($this->model,'category_id'); ?>
 
  
  <?php 
  echo CHtml::dropDownList('nugget_id', 'Select', $this->nuggets,
  		array(
  				'ajax' => array(
  						'type'=>'POST', //request type
  						'url'=>$this->createUrl('nuggetsfield'), //url to call.
  						//Style: $this->createUrl('currentController/methodToCall')
  						'update'=>'#subcat_id', //selector to update
  						'data'=>'js:$("#user-recomendations-form").serialize()'
  //leave out the data key to pass all form values through
  				),
  				'prompt'=>'Select'
  				));
  
  //empty since it will be filled by the other dropdown
  
  ?>
   <?php echo $form->error($this->model,'category_id',array('class'=>'errorMessage small')); ?>
  
  </div>
  <div>
  <?php 
  
echo $form->labelEx($this->model,'category_pk_id'); 
  echo CHtml::dropDownList('subcat_id','', array());
  echo $form->error($this->model,'category_pk_id',array('class'=>'errorMessage small'));
  
  
  ?>
  
  </div>
	<div class="row">
		<?php echo $form->labelEx($this->model,'comments'); ?>
		<?php echo $form->textField($this->model,'comments',array('size'=>30)); ?>
		<?php echo $form->error($this->model,'comments',array('class'=>'errorMessage xsmall')); ?>
	</div>
	<div class="row buttons">
	<?php echo CHtml::htmlButton('Recomend',array('class'=>'basicBtn','type' => 'submit')); ?>
		
	</div>
<?php $this->endWidget(); ?>

<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>
	
      </div>
      
      <!-- end myform div -->
      
      </div>

      
      
      
 <!-- end loop for recomendation details -->
    </div>
    <?php }?>