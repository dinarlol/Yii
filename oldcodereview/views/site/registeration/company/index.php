<?php
if(Yii::app()->user->isGuest){
$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>
<script src="js/jquery-1.4.4.js" type="text/javascript"></script>
<script type="text/javascript" src="js/custom2.js"></script>


 <div class="widget">
           
                    <ul class="tabs">
                        <li id="tab1li"><a href="#tab1">Individual</a></li>
                        <li id="tab2li" class="activeTab"><a href="#tab2">Company</a></li>
                    </ul>
                    
                    <div class="tab_container">
                       
<?php echo $this->renderPartial('registeration/user/_form', array('model'=>$model,'userloginform'=>$userloginform,'companyloginform'=>$companyloginform,'reqparams'=>$reqparams)); ?>

</div>
<div class="fix"></div>
</div>
<?php }?>

<script  type="text/javascript">
$(document).ready(function() {
	$('#tab2li').click();
	 });


</script>
