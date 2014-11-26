<?php
$baseUrl = Yii::app()->baseUrl; 
$cs = Yii::app()->getClientScript(); 
$cs->registerScriptFile("https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js");
$cs->registerScriptFile($baseUrl."/js/token/jquery.tokeninput.js");
$cs->registerCssFile($baseUrl."/css/token/token-input.css");
$cs->registerCssFile($baseUrl."/css/token/token-input-facebook.css");
?>    
<script type="text/javascript">
function addNewInterest()
{
   var divHtml = document.getElementById("divInterest").innerHTML; 
   $("#extraInterest").append(divHtml);
}
function validate(data)
{
     if(data.search("Objective cannot be blank.")!=-1){
        $("#UserAboutMe_objective_em_").replaceWith("<div id=\"UserAboutMe_objective_em_\" class=\"errorMessage\" style=\"\">Objective cannot be blank.</div>");
     }else{
                $("#UserAboutMe_objective_em_").hide();
     }
     if(data.search("Industry cannot be blank.")!=-1)
     {
         $("#UserAboutMe_interest_em_").replaceWith("<div id=\"UserAboutMe_interest_em_\" class=\"errorMessage\" style=\"\">Interest cannot be blank.</div>");
     }else{
         $("#UserAboutMe_interest_em_").hide();
     }
     
     if(data.search("refresh form")!=-1)
     {
           var currentLoc = window.location; 
           var newLoc = "<?php echo Yii::app()->createUrl("employee/nuggetsCreator/index&hash=aboutMe")?>";
           //alert(newLoc);
           window.location = newLoc;

     }	  
    
}

function removeIndustry(divId,industry_id)
{
    var Url = "<?php echo Yii::app()->createUrl("employee/aboutMe/removeIndustry",array("industry_id"=>""));?>";
    Url += industry_id; 
       
    $.post(Url, function(data) {
        $('#'+divId).hide(1000); 
    });
}
function removeInterest(divId,interest_id)
{
    var Url = "<?php echo Yii::app()->createUrl("employee/aboutMe/removeInterest",array("interest_id"=>""));?>";
    Url += interest_id; 
       
    $.post(Url, function(data) {
        $('#'+divId).hide(1000); 
        
    });
}
$("#btn_submit_aboutme1").click(function(){
    //alert($("#demo-input-facebook-theme").val());
});

</script>
<div class="fix"></div>
<div class="form-container">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-about-me-form',
	'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
        'clientOptions'=>array('validateOnSubmit'=>true, 'validateOnType'=>false),
)); 
?>
    <fieldset><legend>About Me</legend>
    <p class="note">Fields with <span class="required">*</span> are required.</p>
	<?php echo $form->errorSummary($model); ?>
	
	<div class="row">
		<?php echo $form->hiddenField($model,'user_id',array('value'=>$user_id));?>
	</div>
	<div class="row" id="divObjective">
		<?php  echo $form->labelEx($model,'objective'); ?>
		<?php  echo $form->textArea($model,'objective',array("cols"=>50,"rows"=>10)); ?>
                <?php  echo $form->error($model,'objective'); ?>
	</div>
               
        <div class="row" id="divInterest">
                <?php echo $form->labelEx($model,'interest'); ?>
		<?php echo $form->textField($model,'interest[]',array('size'=>60,'maxlength'=>145)); ?>
                <?php echo $form->error($model,'interest'); ?>
        </div>
    
            <div class="row" id="extraInterest"></div>
            <div class="included" >
         <?php         
         if(isset($interestVal)){
         foreach($interestVal as $interest)
         {
             $divIntId = "divInt".$interest->id; 
             ?>
            <div id="<?php echo $divIntId ?>" ><?php echo $interest->name; ?> 
                    <a href="javascript: void(0)" onclick="removeInterest('<?php echo $divIntId; ?>', 
                    <?php echo $interest->id; ?>)"><img height="10" width="10" src="images/del.png" /></a></div>
        <?php            
         } }       
         ?>
            
        </div>
            <div class="fix"></div>
            <div class="buttonrow">
            <input type="button" class="basicBtn" value="New" onclick="addNewInterest()" /></div>
            <div class="fix"></div>
            <div class="row">
		<?php echo $form->labelEx($model,'industry'); ?>
                <?php echo $form->textField($model,'industry',array('size'=>60,'maxlength'=>145,'id'=>"demo-input-facebook-theme"));?>
                <script type="text/javascript">
                                                        
                    $("#demo-input-facebook-theme").tokenInput("<?php echo Yii::app()->createUrl("employee/aboutMe/autoCompleteIndustry")?>", {
                        theme: "facebook"
                    });
                
                </script>
               <?php echo $form->error($model,'industry');?>
            </div>
            <div  class="included">
            <?php 
            if(isset($userLookingForVal)){
                 for($i=0; $i<count($userLookingForVal); $i++)
                 { 
                     $divId = "ind".$userLookingForVal[$i]["industry_id"];
                     ?>
                     <div  id="<?php echo $divId ?>"><?php echo $userLookingForVal[$i]["name"]; ?> 
                        <a href="javascript: void(0)" onclick="removeIndustry('<?php echo $divId; ?>', 
                        <?php echo $userLookingForVal[$i]["industry_id"] ?>)"><img height="10" width="10" src="images/del.png" /> </a></div>
                 
            <?php } } ?>
             </div><br />
	     
	<div class="row buttons">
	<?php echo CHtml::ajaxSubmitButton($model->isNewRecord ? 'Create' : 'Update',  Yii::app()->createUrl("employee/aboutMe/create"),
                        array(
                            'type' =>'POST',  'update' => '#ajaxResult','dataType' => 'html','success'=>'function(data){
                                 validate(data);	
                            }',
                         ),array(
                            "id"=>"btn_submit_aboutme1",
                        )
				
		); 
         ?></div>
            </fieldset>
       
<?php $this->endWidget(); ?>

</div><!-- form -->