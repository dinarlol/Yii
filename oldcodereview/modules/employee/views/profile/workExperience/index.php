
<div class="nugget_edit">

<div class="nugget_heading"><span class="work"></span><h2>Work Experiences</h2>
</div>

<?php if(Yii::app()->user->hasFlash('success')):?>
    <div class="info">
        <?php echo '<p style="color:green; padding:10; font-size:14px; font-weight:bold;">'. 
                Yii::app()->user->getFlash('success').'</p>' ?>
    </div>
<?php endif; ?>

<?php $this->widget('zii.widgets.CListView', array('dataProvider'=>$dataProvider, 'itemView'=>$key.'/_view', ));

?>
</div>


