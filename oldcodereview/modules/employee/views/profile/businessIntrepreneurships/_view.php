<div class="ndata bbot">
  <div class="heading1">Relevant Business Projects</div>
  <div class="ncontent"><?php echo $data->relevant_business_projects;?></div>
  <div class="mt10"></div>
  <div class="fix"></div>
   <div class="heading1">Company or Business leader/entrepreneur inspires you?</div>
  <div class="ncontent"> <?php echo $data->inspiredby;?> </div>
    <div class="fix"></div>
   <div class="heading1">Ventures</div>
  <div class="ncontent"> <?php echo $data->ventures;?> </div>
    <div class="fix"></div>
   <div class="heading1">link to website for companies an individual has founded</div>
  <div class="ncontent"> <?php echo $data->link;?> </div>
  <div class="fix"></div>
  <div class="lableline mt20"><strong>Businesses or entrepreneurial ventures have you been involved with</strong></div>
  <div class="pics">
    <ul>
      <?php 
                    $contentType = AkimboNuggetManager::CONTENT_TYPE_DOCUMENT_RELATION_NAME;
                    if(!empty($data->$contentType)){
                    	$content = $data->$contentType;
                    	$content =  $content[0];
                    	
                    	?>
      <li class="floatleft"> <a title="" href="#" id="<?php echo uniqid('akba_');?>">
        <?php  echo CHtml::image(Yii::app()->baseUrl.$content->location.$content->name,$content->name,array('width'=>'70','height'=>'70','id'=>uniqid('akbae_')));
                   ?>
        </a>
        <div class="actions">
          <?php    echo CHtml::link(
					CHtml::image(Yii::app()->baseUrl.'/'.AkimboNuggetManager::IMAGE_DELETE), array('deleteDoc','id'=>$content->id),
					array('confirm' => 'Are you sure?','id' =>uniqid('akb_')));
			
			
			?>
        </div>
      </li>
      <?php }?>
    </ul>
  </div>
  <div class="fix"></div>
</div>
