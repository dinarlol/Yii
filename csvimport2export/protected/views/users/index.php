<h3 class="top-heading">Our records indicate the following. Please review carefully, and make any correction needed.</h3>

<?php
/* @var $this UsersController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Personal info',
);

$this->menu=array(
	array('label'=>'Edit', 'url'=>array('update')),
);
?>

<div class="row">
    
<div class="span3"><h1>Personal info</h1>



<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
    'summaryText'=>'', 
)); ?>
    
    </div>
<div class="span9">
<div class="xls-grid">
    <h1>Your Portfolio</h1>
    <table width='70%' class='table table-striped table-bordered table-condensed'>
        
        <?php if(!empty($activeInstruments)): ?>
        <?php
        echo "<tr>";
         echo "<td>Edit</td>";
        foreach( $activeInstruments[0] as $k=>$headers ) {
            if($k !== 'street' && $k !== 'city' && $k !== 'zip' && $k !== 'id'  && $k !== 'userid'){
            echo "<td>$k</td>";
            }
        }
       echo "</tr>";
       foreach( $activeInstruments as $row ) {
          
        echo "<tr>";
        echo "<td>". CHtml::ajaxLink('Edit',
        $this->createUrl('sendmail'),
       
        array(
             'type'=>'POST',
            'success'=>'function(r){$("#juiDialog").html(r).dialog("open"); return false;}',
            'data'=>array(
                'line' => $row->file
            ),
        )
                
) ."</td>";
    foreach( $row as $k=>$column ){
     if($k !== 'street' && $k !== 'city' && $k !== 'zip' && $k !== 'id' && $k !== 'userid'){
       echo "<td>$column</td>";
     }
    }
    echo "</tr>";
       }
        ?>
        <?php else: ?>
        <tr><td>No records</td></tr>
        <?php        endif; ?>
    </table>
  
</div>
</div>
<?php 
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
                'id'=>'juiDialog',
                'options'=>array(
                    'title'=>'Email Form',
                    'autoOpen'=>FALSE,
                    'modal'=>true,
                    'width'=>'auto',
                    'height'=>'auto',
                ),
                ));
$this->endWidget();
?>
</div>
