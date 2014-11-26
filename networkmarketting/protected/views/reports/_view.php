 <?php
/* @var $this ReportsController */
/* @var $data Upgrade */
?>

<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
    <?php echo CHtml::encode($data->user_id); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('stage')); ?>:</b>
    <?php echo CHtml::encode($data->stage); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('point')); ?>:</b>
    <?php echo CHtml::encode($data->point); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('created_date')); ?>:</b>
    <?php echo CHtml::encode($data->created_date); ?>
    <br />

   


</div> 