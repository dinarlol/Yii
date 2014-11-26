

<?php $this->beginWidget('zii.widgets.jui.CJuiDialog', array('id'=>'childModal',
    'options'=>array(
        'title'=>'User stats',
        'autoOpen'=>false,
        'close'=>'js:function() {$("#childbox").html("Loading please wait.");}',
    ), 



    )); ?>
 

<div id="childbox">

Loading please wait.
</div>

<div class="modal-footer">
    

</div>
 
<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>