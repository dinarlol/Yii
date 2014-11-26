
<h1>Users Reports</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
     'afterAjaxUpdate' => 'reinstallDatePicker', 
    'id'=>'upgrade-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'username',
        'full_name',
          array('header'=>'Introducer',
                     'value'=>'$data->introducer->full_name'),
         array('header'=>'Joining Plan',
                     'value'=>'$data->plan->plan'),
      
          array(
            'name' => 'created_date',
            'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model'=>$model, 
                'attribute'=>'created_date', 
               'language' => 'en',
'i18nScriptFile' => 'jquery.ui.datepicker-en.js',
                // 'i18nScriptFile' => 'jquery.ui.datepicker-ja.js', (#2)
                'htmlOptions' => array(
                    'id' => 'datepicker_for_created_date',
                    'size' => '10',
                ),
                'defaultOptions' => array(  // (#3)
                    'showOn' => 'focus', 
                    'dateFormat' => 'yy-mm-dd',
                    'showOtherMonths' => true,
                    'selectOtherMonths' => true,
                    'changeMonth' => true,
                    'changeYear' => true,
                    'showButtonPanel' => true,
                )
            ), 
            true),
              ),
         'stage',
       
    ),
)); 

Yii::app()->clientScript->registerScript('re-install-date-picker', "
function reinstallDatePicker(id, data) {
    $('#datepicker_for_created_date').datepicker();
}
");