<form method="post">
<div class="controls-row">
    <div class="span-3 right">To:</div>
    <div><?php echo(CHtml::textField('to',$data['to'],array('class'=>'input-xxlarge','readonly'=>true)));  ?></div>
     <div class="span-3 right">Subject:</div>
    <div><?php echo(CHtml::textField('line','Regarding file #'.$data['line'],array('class'=>'input-xxlarge', 'readonly'=>true)));  ?></div>
    <div class="span-3 right">From:</div>
    <div><?php echo(CHtml::textField('from',$data['from'],array('class'=>'input-xxlarge', 'readonly'=>true)));  ?></div>
    <div class="span-3">Message:</div>
    <br />
    <?php
	echo(CHtml::textArea('message','',array('class'=>'input-block-level'))); 
	
	?>
    <button class="btn btn-warning" onclick='$("#juiDialog").dialog("close");return false;'> Cancel </button>
    <input type="submit" class="btn btn-success" value="Submit">

</div>
</form>