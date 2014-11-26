
     <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'search-filter-form',
	'enableAjaxValidation'=>true,
        'enableClientValidation'=>false,
		'htmlOptions' =>array('class'=>'mainForm'),
        'clientOptions'=>array('validateOnSubmit'=>true, 'validateOnType'=>false),

)); ?>
     

   <div class="rowElem noborder">
   
          <label>User Type: </label>
          
          
             <div class="formRight">
       
        <?php
                echo CHtml::activeRadioButtonList($model,'role_id',
                        CHtml::listData(Roles::model()->findAll('name!=?',array(AkimboNuggetManager::ADMIN_ROLE)), 'id', 'name'),
                        array(
                                'separator'=>'', 
                                'template'=>'<label>{label}</label><span class="jqTransformCheckboxWrapper">{input}</span>',
                                //'labelOptions'=>array('style'=>'inline'),
                        		'id'  => uniqid('keyword_'),
                        		'return' =>false,
                        		'ajax'=>array(
                        		
                        				'url'=>$this->createUrl("search/ajaxSearch/searchfilter", array('filter'=>'employee')),
                        				'type'=>'POST',
                        				'data' => 'js:$("#search-advance-form").serialize()+"&din="+$("#search-filter-form").serialize()',
                        				'update' => '#search-grid',
                        				'id' => uniqid('roles_'),
                        		
                        		),
                        		 'return'=>true,
                        ));
               
        ?>
        <?php echo $form->error($model,'role_id'); ?>

           <?php $this->endWidget(); ?>
          

                        </div>
                        <div class="fix"></div>
        </div>
        <div class="rowElem">
                        <label>Location :</label> 
                        <div class="formRight">
                            <span class="jqTransformRadioWrapper"><a rel="question1" class="jqTransformRadio jqTransformChecked" href="#"></a><input type="radio" checked="checked" name="question1" class="jqTransformHidden"></span><label style="cursor: pointer;"> Country</label>
                            <span class="jqTransformRadioWrapper"><a rel="question1" class="jqTransformRadio" href="#"></a><input type="radio" name="question1" class="jqTransformHidden"></span><label style="cursor: pointer;"> State</label>

                        </div>
                        <div class="fix"></div>
                    </div>
                    
                    
                     <div class="rowElem">
                        <label>Status :</label> 
                        <div class="formRight">
                            <span class="jqTransformRadioWrapper"><a rel="question1" class="jqTransformRadio jqTransformChecked" href="#"></a><input type="radio" checked="checked" name="question1" class="jqTransformHidden"></span><label style="cursor: pointer;"> Working</label>
                            <span class="jqTransformRadioWrapper"><a rel="question1" class="jqTransformRadio" href="#"></a><input type="radio" name="question1" class="jqTransformHidden"></span><label style="cursor: pointer;"> Not Working</label>

                        </div>
                        <div class="fix"></div>
                    </div>
                    
                     <div class="rowElem">
                        <label>Fitness :</label> 
                        <div class="formRight">
                            <span class="jqTransformRadioWrapper"><a rel="question1" class="jqTransformRadio jqTransformChecked" href="#"></a><input type="radio" checked="checked" name="question1" class="jqTransformHidden"></span><label style="cursor: pointer;"> Sports Person</label>
                            <span class="jqTransformRadioWrapper"><a rel="question1" class="jqTransformRadio" href="#"></a><input type="radio" name="question1" class="jqTransformHidden"></span><label style="cursor: pointer;"> Athlete</label>

                        </div>
                        <div class="fix"></div>
                    </div>
                    
                    
                <div>    
                <input type="submit" class="greyishBtn submitForm" value="Apply Filter">
                </div>
                <div class="fix"></div>
              
     
     
 
  
  
 

