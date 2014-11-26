
<p>
<h1>Potential Employer </h1>
</p>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'potential_employer.companys.name',
		'create_date',
		
	),
)); ?>
