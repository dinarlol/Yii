<div class="ndata bbot">
  <div class="heading1">Travel</div>
  <div class="ncontent"><?php echo $data->destination->name;?></div>
  <div class="mt10"></div>
  <div class="heading1"></div>
  <div class="ncontent">
    <div class="pics">
    <ul>
      <?php 
                    $contentType = AkimboNuggetManager::CONTENT_TYPE_IMAGE_RELATION_NAME;
                    
                    if(!empty($data->$contentType)){
                    	$content = $data->$contentType;
                    	$content =  $content[0];
                    	
                    	?>
      <li class="floatleft rlm"> <a title="" href="#" id="<?php echo uniqid('akba_');?>">
        <?php  echo CHtml::image(Yii::app()->baseUrl.$content->location.$content->name,$content->name,array('width'=>'70','height'=>'70','id'=>uniqid('akbae_')));
                   ?>
        </a>
        <div class="actions">
          <?php 
/*
                             echo CHtml::link(
                             		CHtml::image(Yii::app()->baseUrl.'/'.AkimboNuggetManager::IMAGE_EDIT), array('changeImage','id'=>$content->id),
                             		array('confirm' => 'Are you sure?','id' =>uniqid('akb_')));
  
                             */
                             //echo CHtml::image(Yii::app()->baseUrl.$content->location.$content->name,$content->name,array('width'=>'130','height'=>'140'));
                             
                             
                             ?>
          <?php    echo CHtml::link(
					CHtml::image(Yii::app()->baseUrl.'/'.AkimboNuggetManager::IMAGE_DELETE), array('deleteImage','id'=>$content->id),
					array('confirm' => 'Are you sure?','id' =>uniqid('akb_')));
			//echo CHtml::image(Yii::app()->baseUrl.$content->location.$content->name,$content->name,array('width'=>'130','height'=>'140'));
			
			
			?>
        </div>
      </li>
      <?php }?>
    </ul>
  </div>
  </div>
 
  <div class="fix"></div>

</div>
<div class="fix"></div>
