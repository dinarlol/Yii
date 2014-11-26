<div class="widget">
<div class="tab_container">
<div id="tab3" class="vtab_content">
    <div class="nugget_bar_left" style="float:left;">
<?php 
foreach($menu as $menuitem){
        echo '<div class="nugget">';
            echo '<span class="'.$menuitem['span'].'">';
	    echo CHtml::ajaxLink($menuitem['title'], CController::createUrl($menuitem['link'],array("user_id"=>$id)),
                array('update'=>'#nugget_bar_right'), array('class'=>'input','id'=>$menuitem['nuggetName']));
            echo '</span>
             </div>';
}
?>
</div>
<div id="nugget_bar_right" style="float:left; margin-left:10px;"  ><!-- AJAX content load here --></div>
</div>    
</div>
</div>
<div class="fix"></div>

<div class="widgets"> </div>
<script type="text/javascript">
    $("document").ready(function(){
         var hash = "<?php echo $hash;?>";
         if(hash != ""){
            $.post('<?php echo Yii::app()->createUrl("employee/$hash/index&user_id=$id")?>', function(data) {
              $('#nugget_bar_right').html(data);
            });
        }                        
    });
</script>
