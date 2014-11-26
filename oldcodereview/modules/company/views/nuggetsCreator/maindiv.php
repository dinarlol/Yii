
<div id="edit_nav">
<div>
 <h5>General</h5>
<div>
<ul>
<?php 
foreach($menu as $menuitem){
        echo '<li>';
	echo '<span class="'.$menuitem['span'].'">';
	    echo CHtml::ajaxLink($menuitem['title'], $this->createAbsoluteUrl("/".$this->module->id.'/'.$menuitem['category']),
                array('update'=>'#nugget_bar_right'), array('class'=>'input','id'=>$menuitem['category']));
            echo '</span></li>';
}
?>

</ul>
</div>    
</div>
</div>


<div id="nugget_bar_right" class="content_edit_right"><!-- AJAX content load here --></div>





<script type="text/javascript">
    $("document").ready(function(){
         var hash = "<?php echo $hash;?>";
         if(hash != ""){
            $.post('<?php echo Yii::app()->createUrl("$hash/index")?>', function(data) {
              $('#nugget_bar_right').html(data);
            });
        }                        
    });
</script>







