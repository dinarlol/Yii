<?php $this->beginContent('//layouts/main'); ?>
<div class="wrapper">
<div class="content">
	<?php echo $content;?>
	<div class="fix"></div>
</div>

<div id="content_right"> 
  
  <!-- Right widgets -->
  <div class="right"> 
  
  <?php foreach($this->portlets as $class=>$properties)
        $this->widget($class,$properties); ?>
    </div>
  
  </div>
  </div>
<?php $this->endContent(); ?>