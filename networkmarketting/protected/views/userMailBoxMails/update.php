<?php
/* @var $this UserMailBoxMailsController */
/* @var $model UserMailBoxMails */

$this->breadcrumbs=array(
	'User Mail Box Mails'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UserMailBoxMails', 'url'=>array('index')),
	array('label'=>'Create UserMailBoxMails', 'url'=>array('create')),
	array('label'=>'View UserMailBoxMails', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage UserMailBoxMails', 'url'=>array('admin')),
);
?>

<h1>Update UserMailBoxMails <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>