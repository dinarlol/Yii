<div class="widget">
    <div class="tab_container">
      <div class="tab_content" id="profile">
       <h3> Take a moment to complete your profile</h3>
       <br>
       <p class="p">The more you fill your profile with relevant information, the easier it will be for others professionals to find you.</p>
       
    <div style="height:20px"></div> 
    						
							<div class="profile_progress"><p class="p">Profile Progress</p> </div>



<div id="progress1">
                                <div class="percent"><b><?php echo CHtml::encode($progress);?>%</b></div>
                                <div class="pbar ui-progressbar ui-widget ui-widget-content ui-corner-all" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="ui-progressbar-value ui-widget-header ui-corner-left" style="display: none; width: <?php echo $progress;?>%;"></div></div>

                            </div>
			
						
    </div>
    <input type="button" class="blueBtn mr5 mt20 mb5 fl33" value="Edit your profile" onclick="location.href='index.php?r=employee/nuggetsCreator'">
    <div class="fix"></div>
  </div>

    
    

    <!-- Widgets -->
    <div class="widgets"> </div>
  </div>
  
  
   <?php $this->widget('RecentNewsUpdates',array());
   
   ?>