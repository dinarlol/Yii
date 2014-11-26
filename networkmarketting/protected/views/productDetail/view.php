<?php
$this->breadcrumbs=array(
	'Product Details'=>array('index'),
	$model->product_detail_id,
);

$this->menu=array(
	array('label'=>'List ProductDetail','url'=>array('index')),
	array('label'=>'Create ProductDetail','url'=>array('create')),
	array('label'=>'Update ProductDetail','url'=>array('update','id'=>$model->product_detail_id)),
	array('label'=>'Delete ProductDetail','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->product_detail_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ProductDetail','url'=>array('admin')),
);
?>

<h1>View ProductDetail #<?php echo $model->product_detail_id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'product_detail_id',
		'product_detail',
		'price',
		'product_id',
	),
)); ?>
