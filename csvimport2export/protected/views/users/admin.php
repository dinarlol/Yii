<h1>Admin Panel</h1>

<div id="loader" class="loadinghide hidden">
<h2> Please wait</h2>
 <div class="loading bar">
     <div></div>
     <div></div>
     <div></div>
     <div></div>
     <div></div>
     <div></div>
     <div></div>
     <div></div>
</div>

</div>

<div id="status">
    
   
    
</div>

<?php 
echo CHtml::ajaxLink('Import Table 1',
        $this->createUrl('importUser'),
       
        array(
            
 'type'=>'POST',
            'success'=>'function(r){$("#loader").addClass("hidden"); $("#status").html(r); return true;}',
            'data'=>array(
                'confirm' => 'yes',
                
            ),
        ),
        array('class' => 'btn btn-primary',
           "onclick"=>'$("#loader").removeClass("hidden")',
            )
                
);

?>


<?php 
echo CHtml::ajaxLink('Export Table 2 User data edit',
        $this->createUrl('exportUser'),
       
        array(
            
 'type'=>'POST',
            'success'=>'function(r){$("#loader").addClass("hidden"); $("#status").html(r); return true;}',
            'data'=>array(
                'confirm' => 'yes'
            ),
        ),
        array('class' => 'btn btn-success',
            "onclick"=>'$("#loader").removeClass("hidden")',
            )
                
);

?>



<?php 
echo CHtml::ajaxLink('Empty Table 2',
        $this->createUrl('clearTable2'),
       
        array(
            
            'type'=>'POST',
            'success'=>'function(r){$("#loader").addClass("hidden"); $("#status").html(r); return true;}',
            'data'=>array(
                'confirm' => 'yes'
            ),
        ),
        array('class' => 'btn btn-danger',
            "onclick"=>'if (!confirm("Are you sure?\r\nTable 2 will be permanently deleted and are not recoverable. \n Kindly check Table2.csv in output folder first")){return false} else{$("#loader").removeClass("hidden")}',

            )
                
);

?>

<?php 
echo CHtml::ajaxLink('Import Table 4',
        $this->createUrl('importInstrument'),
       
        array(
            
 'type'=>'POST',
            'success'=>'function(r){$("#loader").addClass("hidden"); $("#status").html(r); return true;}',
            'data'=>array(
                'confirm' => 'yes'
            ),
        ),
        array('class' => 'btn btn-warning',
            "onclick"=>'if (!confirm("Are you sure?\r\nTable4 will be Imported and values can be duplicate. \n Please empty Table 4 to avoid duplications")){return false} else{$("#loader").removeClass("hidden");}',

            )
                
);

?>


<?php 
echo CHtml::ajaxLink('Empty Table 4',
        $this->createUrl('clearTable4'),
       
        array(
            
      'type'=>'POST',
           'success'=>'function(r){$("#loader").addClass("hidden"); $("#status").html(r); return true;}',
            'data'=>array(
                'confirm' => 'yes'
            ),
        ),
        array('class' => 'btn btn-danger',
            "onclick"=>'if (!confirm("Are you sure?\r\nTable4 will be permanently deleted and can be recoverable. \n By importing table 4 by putting Table4.csv in instruments folder")){return false} else{$("#loader").removeClass("hidden");}',

            )
                
);

?>