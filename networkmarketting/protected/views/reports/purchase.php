
<h1>Product purchase Reports</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
     'afterAjaxUpdate' => 'reinstallDatePicker', 
    'id'=>'upgrade-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'user.username',
        'user.full_name',
        array('header'=>'Introducer',
                     'value'=>'$data->user->introducer->full_name'),
        
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
        'product.product_detail',
        'points',
        
    ),
)); 

Yii::app()->clientScript->registerScript('re-install-date-picker', "
function reinstallDatePicker(id, data) {
    $('#datepicker_for_created_date').datepicker();
}
");