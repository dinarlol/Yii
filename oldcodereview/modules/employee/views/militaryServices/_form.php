<script type="text/javascript">
    function validate(data)
    {
           
        if(data.search("Branch cannot be blank.")!=-1){
            $("#UserMilitaryService_branch_id_em_").replaceWith("<div id=\"UserMilitaryService_branch_id_em_\" class=\"errorMessage\" style=\"\">Branch cannot be blank.</div>");
        }else{
            $("#UserMilitaryService_branch_id_em_").hide();
        }
               
        if(data.search("refresh form")!=-1)
        {
            var currentLoc = window.location; 
               var newLoc = "<?php echo Yii::app()->createUrl("employee/nuggetsCreator/index&hash=militaryService")?>";
               //alert(newLoc);
               window.location = newLoc;
        }
        
    }
    </script>
   
    <div class="fix"></div>
    
<div class="form-container">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-military-service-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
)); ?>
    <fieldset><legend>Military Service</legend>
	<p class="note">Fields with <span class="required">*</span> are required.</p>
	<div id="divforresult"></div>
	<?php echo $form->errorSummary($model); ?>
	<div class="row">
		<?php echo $form->hiddenField($model,'user_id',array('value'=>$user_id)); ?>
		
		<?php echo $form->labelEx($model,'branch_id'); ?>
		<?php echo $form->DropDownList($model,'branch_id',CHtml::listData(MilitaryServiceBranch::model()->findAll(), 'id', 'name'),array('empty'=>'Choose Branch'));?>
		<?php echo $form->error($model,'branch_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'devision'); ?>
		<?php		
                    $this->widget('CAutoComplete',
                array(
                         //name of the html field that will be generated
                 'name'=>'UserMilitaryService[devision]',
                    'model'=>$model, 
                             //replace controller/action with real ids
                 'url'=>array('militaryServices/autoCompleteDevision'), 
                 'max'=>10, //specifies the max number of items to display

                             //specifies the number of chars that must be entered 
                             //before autocomplete initiates a lookup
                 'minChars'=>2, 
                 'delay'=>500, //number of milliseconds before lookup occurs
                 'matchCase'=>false, //match case when performing a lookup?

                             //any additional html attributes that go inside of 
                             //the input field can be defined here
                 'htmlOptions'=>array('size'=>'40'), 
                 'value'=>$model->devision,       
                 //'methodChain'=>".result(function(event,item){\$(\"#user_id\").val(item[1]);})",
             ));
            ?>
		
		<?php echo $form->error($model,'devision'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rank'); ?>
		<?php //echo $form->textField($model,'rank',array('size'=>45,'maxlength'=>45)); ?>
                <?php		
                    $this->widget('CAutoComplete',
                    array(
                             //name of the html field that will be generated
                      'name'=>'UserMilitaryService[rank]',
                      'model'=>$model, 
                                 //replace controller/action with real ids
                     'url'=>array('militaryServices/autoCompleteRank'), 
                     'max'=>10, //specifies the max number of items to display
                        

                                 //specifies the number of chars that must be entered 
                                 //before autocomplete initiates a lookup
                     'minChars'=>2, 
                     'delay'=>500, //number of milliseconds before lookup occurs
                     'matchCase'=>false, //match case when performing a lookup?

                                 //any additional html attributes that go inside of 
                                 //the input field can be defined here
                     'htmlOptions'=>array('size'=>'40'), 
                     'value'=>$model->rank,

                     //'methodChain'=>".result(function(event,item){\$(\"#user_id\").val(item[1]);})",
                 ));
            ?>
            
		<?php echo $form->error($model,'rank'); ?>
	</div>
	
	<div class="buttonrow">
		<?php //echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
		<?php 
                if($model->isNewRecord){
                echo CHtml::ajaxSubmitButton("Create", Yii::app()->createUrl("employee/militaryServices/create"),array(
		'type' =>'POST','update' => '#ajaxResult','dataType' => 'html',
				'success'=>'function(data){
                                    validate(data);
                            }',
			) ,array(
                                    "id"=>"btn_submit_military",
                                    "class"=>"basicBtn",    
                                )
				
		); }else{
                  
                echo CHtml::ajaxSubmitButton("Update", Yii::app()->createUrl("employee/militaryServices/update",array("id"=>$model->id)),array(
		'type' =>'POST','update' => '#ajaxResult','dataType' => 'html',
				'success'=>'function(data){
                                    validate(data);
                            }',
			) ,array(
                                    "id"=>"btn_update_military",
                                    "class"=>"basicBtn",    
                                )
				
		);
                    
                }
                ?>
	</div>
        </fieldset>

<?php $this->endWidget(); ?>

</div><!-- form -->