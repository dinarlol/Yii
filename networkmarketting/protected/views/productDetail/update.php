<?php
$this->breadcrumbs=array(
	'Product Details'=>array('index'),
	$model->product_detail_id=>array('view','id'=>$model->product_detail_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ProductDetail','url'=>array('index')),
	array('label'=>'Create ProductDetail','url'=>array('create')),
	array('label'=>'View ProductDetail','url'=>array('view','id'=>$model->product_detail_id)),
	array('label'=>'Manage ProductDetail','url'=>array('admin')),
);
?>

<h1>Update ProductDetail <?php echo $model->product_detail_id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>