
<div class="ndata bbot">
     <div class="heading1">Field of Music</div>
     <h4><div class="ncontent">
        <?php $detail = $data->userMusicDetails;?>
            <?php if(!empty($detail)){   	     	  	     	
      	     	?>
      	     <?php      
             
                    foreach ($detail as $detail){
                         if(!empty ($detail->field) ){                                     
                            print($detail->field->name.'&nbsp;');
                                             }
                                         }
                                    }
      	     	?>
    </div></h4>
    
        <div class="space"></div>
    
    
    
 <div class="heading1">Artist Inspiration</div>
 <div class="ncontent"><?php echo $data->inspired_by;?></div>
      	    
 <div class="fix"></div>
     <div class="space"></div>

         <?php if(!empty($detail->video_uploader)){?>
           <div class="heading1">My Work</div>
                <div id="example2" class="vid_display">
            <?php 
		foreach ($detail->video_uploader as $video){
            ?>
            <div><a href="<?php echo $video->link;?>"></a></div>
            
                        <?php 
                        }
                    ?> </div>
                    
           <script type="text/javascript">
           $$("div#example2 a").each( function(el) {
                            
    new ProtoTube(el);
});
         </script>           
                    
                    

<div class="fix"></div>
     <div class="space"></div>            
          <?php }?>  
<div clas="buttonrow">
<?php 
echo CHtml::ajaxLink('Edit', $this->createAbsoluteUrl("update",array('id'=>$data->id)),
		array('update'=>'#operationResultDiv'), array('class'=>'input fright button','id'=>uniqid('edit_culinary'),'id'=>uniqid('akbe_')));
?>
<?php echo CHtml::link(
    'Delete', array('delete','id'=>$data->id),
     array('confirm' => 'Are you sure?','id' =>uniqid('akb_'),'class'=>'input fright button'));
?>


		</div>
	

	      <div class="space"></div>