<div class="widget">
<?php 

foreach ($models as $model){

?>
<h1>Recomendation by <?php echo $model->recomender->userDetails->first_name; ?> for  <?php echo $model->category->description;?>  Category</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'create_date',
		'modified_date',
		'comments',
		
	),
)); ?>


<?php }?>

</div>