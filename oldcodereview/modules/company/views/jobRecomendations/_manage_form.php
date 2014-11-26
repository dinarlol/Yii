<div class="nugget">


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-recomendations-form',
	'enableAjaxValidation'=>false,
)); ?>
<?php 



foreach ( $stats as $recomendation_type=>$recomendations){
	foreach ($recomendations as $recomendation){
		//print_r($recomendation);
		if($recomendation['count'] >0){
			$hidden = $recomendation['count'] - $recomendation['visible'];

			?>

<div class="recommend_descript">
 <h4 class="red">Recommendations for <?php echo $recomendation['title'];?><span class="red"> @ <?php echo $recomendation['organization'];?></span></h4>
<p>You have <?php echo $recomendation['count'];?> recommendation for this <?php echo $recomendation['position'];?> (<span class="green"><?php echo $recomendation['visible'];?> visible, <?php echo $hidden;?> hidden</span>)
To show or hide recommendations, select them and click Save Changes.</p></div>
<div class="hfix"> </div>			

<?php
}



}
}

//print_r($models);exit;
?>

<div class="form">

<?php 
foreach ($models as $model){
	
	
	$name = '';
	if($model->recomender->role->name == $model->userRole){
	
		if(!empty($model->recomender->userDetails->first_name)){
			$name = $model->recomender->userDetails->first_name." ";
		}
	
		if(!empty($model->recomender->userDetails->last_name)){
			$name .= $model->recomender->userDetails->last_name." ";
		}
	
	}
	
	else if($model->recomender->role->name == $model->companyRole){
		$name = $model->recomender->companys->name;
	
	}
	else{
		//print_r($model->recomender);
	
	}

?>
		

	<div class="recomendation">
<div><h3><?php echo $name;?> <span class="red">@ <?php echo $model->comments;?></span></h3> </div>
<div class="mang_btn"><?php echo CHtml::checkBox($model->id,$model->show) ;?>show<?php echo CHtml::hiddenField("UserRecomendations[id][]",$model->id);?></div>
</div>
		
		<?php 
		
		
		
		
		

	//	print_r($stats[$model->category->name]);
	
	
	
	?>
		
		
	


	
<?php }?>
<div class="recomendation">
		<?php echo CHtml::submitButton('Save Changes',array('class'=>'basicBtn')); ?>
	</div>

<?php $this->endWidget(); ?>

</div>

</div><!-- form -->
	
	