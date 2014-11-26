
<?php $this->widget('zii.widgets.CDetailView', array('data'=>$model,'attributes'=>array(
                    'id','user_id','organization','sector_id','website_url','start_date','end_date','title','is_working','create_date',
                    'modified_date',
	),
)); ?>
