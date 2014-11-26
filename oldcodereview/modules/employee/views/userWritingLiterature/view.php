
<h1>View UserWritingLiterature #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'user.userDetails.first_name',
		'user.userDetails.last_name',
		'writer_inspired_by',
		'userReadBooks.book.name',
		'document_uploader.name',
		'modified_date',
	),
)); ?>
