<div class="ndata bbot">
  <div class="pics">
    <ul>
      <?php 
                    $contentType = AkimboNuggetManager::CONTENT_TYPE_IMAGE_RELATION_NAME;
                    
                    if(!empty($data->$contentType)){
                    	$content = $data->$contentType;
                    	$content =  $content[0];
                    	
                    	?>
      <li> <a title="" href="#" id="<?php echo uniqid('akba_');?>">
        <?php  echo CHtml::image(Yii::app()->baseUrl.$content->location.$content->name,$content->name,array('width'=>'70','height'=>'70','id'=>uniqid('akbae_')));
                   ?>
        </a>
        <div class="actions">
          <?php    echo CHtml::link(
					CHtml::image(Yii::app()->baseUrl.'/'.AkimboNuggetManager::IMAGE_DELETE), array('deleteImage','id'=>$content->id),
					array('confirm' => 'Are you sure?','id' =>uniqid('akb_')));
			
			
			?>
        </div>
      </li>
      <?php }?>
    </ul>
  </div>
  <div class="heading1">Cuisine</div>
  <h4><?php echo $data->name;?></h4>
  <div class="mt10"></div>
  <div class="heading1">Inspiration:</div>
  <div class="ncontent"> <?php echo $data->inspiredby;?> </div>
  <div class="fix"></div>

  <div class="fix"></div>
</div>
