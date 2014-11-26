<div class="widget">
<?php 

foreach ($models as $model){

?>
<h1>Recomendation by <?php echo $model->user->getFullName(); ?> for  <?php echo $model->job->job_title;?>  Job</h1>

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