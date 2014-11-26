 <?php
/* @var $this ReportsController */
/* @var $model Upgrade */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <div class="row">
        <?php echo $form->label($model,'id'); ?>
        <?php echo $form->textField($model,'id'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'user_id'); ?>
        <?php echo $form->textField($model,'user_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'stage'); ?>
        <?php echo $form->textField($model,'stage'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'point'); ?>
        <?php echo $form->textField($model,'point'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'created_date'); ?>
        <?php echo $form->textField($model,'created_date'); ?>
    </div>


    <div class="row buttons">
        <?php echo CHtml::submitButton('Search'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
close