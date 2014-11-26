<div class="h2_heading">
            <span class="<?php echo $selected;?>"></span><h2 class="h2"><?php echo $title;?></h2>
          </div>
<div class="nugget_info">          
<?php foreach($details as $detail){?>
<span class="list_arrow"></span>
<div class="info_heading">
<h4>
<?php echo $detail['title'];?>
</h4>
</div>

<div class="right_mini_info">
<?php echo $detail['date'];?>
</div>


<div class="description">

<?php echo $detail['description'];?>
</div>

<div  class="right_small_info">
<?php echo $detail['section'];?>
</div>
<div class="seprator"></div>
<?php }?>
</div>