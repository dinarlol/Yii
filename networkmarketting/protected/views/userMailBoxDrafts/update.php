<?php
/* @var $this UserMailBoxDraftsController */
/* @var $model UserMailBoxDrafts */

$this->breadcrumbs=array(
	'User Mail Box Drafts'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UserMailBoxDrafts', 'url'=>array('index')),
	array('label'=>'Create UserMailBoxDrafts', 'url'=>array('create')),
	array('label'=>'View UserMailBoxDrafts', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage UserMailBoxDrafts', 'url'=>array('admin')),
);
?>

<h1>Update UserMailBoxDrafts <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>