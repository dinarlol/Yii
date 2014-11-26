<?php
$this->breadcrumbs=array(
	'Register',
);


?>

<h1>Register Company</h1>



<div>
<?php echo $this->renderPartial('_form', array('loginmodel'=>$loginmodel,'userdetailmodel'=>$userdetailmodel,'companydetailmodel' =>$companydetailmodel,'reqparams'=>$reqparams)); ?>
</div>