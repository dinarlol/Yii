<?php
/* @var $this UserMailBoxDraftsController */
/* @var $model UserMailBoxDrafts */

$this->breadcrumbs=array(
	'User Mail Box Drafts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UserMailBoxDrafts', 'url'=>array('index')),
	array('label'=>'Manage UserMailBoxDrafts', 'url'=>array('admin')),
);
?>

<h1>Create UserMailBoxDrafts</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>