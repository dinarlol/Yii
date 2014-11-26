<div class="widget">
<div class="tab_container">
<div id="tab3" class="vtab_content">
    <div class="nugget_bar_left" style="float:left;">
<?php 
foreach($menu as $menuitem){
        echo '<div class="nugget">';
	echo '<span class="'.$menuitem['span'].'">';
	    echo CHtml::ajaxLink($menuitem['category'], $this->createAbsoluteUrl("/".$this->module->id.'/'.$menuitem['category']),
                array('update'=>'#nugget_bar_right'), array('class'=>'input','id'=>$menuitem['category']));
            echo '</span></div>';
}
?>
</div>
<div id="nugget_bar_right" style="float:left; margin-left:10px;"  ><!-- AJAX content load here --></div>
</div>    
</div>
</div>
<div class="fix"></div>

<div class="widgets"> </div>

