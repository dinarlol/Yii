<?php 

foreach ($models as $model){

?>

<h1>Update UserRecomendations <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

<?php }?>