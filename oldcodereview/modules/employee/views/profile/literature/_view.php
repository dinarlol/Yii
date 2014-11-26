<?php if(!empty($data->userReadBooks)){
    ?>

<div class="ndata bbot">
  <?php
		foreach ($data->userReadBooks as $readbook){
			
			?>
  <div class="heading1">Writting</div>
  <div class="ncontent"><?php echo $readbook->book->name;?></div>
  <div class="mt10"></div>
  
    <div class="heading1"></div>
  <div class="ncontent"> 
  <div class="pics">
    <ul>
      <?php 
                    if(!empty($readbook->book)){
                    	?>
      <li class="floatleft rlm"> <a title="" href="#" id="<?php echo uniqid('akba_');?>">
        <?php  echo CHtml::image($readbook->book->thumbnail,$readbook->book->name,array('width'=>'70','height'=>'70','id'=>uniqid('akbae_')));
                   ?>
        </a>
        <div class="actions">
          <?php    echo CHtml::link(
			CHtml::image(Yii::app()->baseUrl.'/'.AkimboNuggetManager::IMAGE_DELETE), array('deleteImage','id'=>$readbook->id),
					array('confirm' => 'Are you sure?','id' =>uniqid('akb_')));
			
			
			?>
        </div>
      </li>
      <?php }?>
    </ul>
  </div>
  
</div>
    <div class="fix"></div>
    <div class="space"></div>
  
  <div class="heading1">Inspiration</div>
  <div class="ncontent"> <?php echo $data->writer_inspired_by;?> </div>

  
  <div class="fix"></div>
  <div>
    
  </div>
  <div class="fix"></div>

  <div class="fix"></div>
</div>
  <?php }}?>