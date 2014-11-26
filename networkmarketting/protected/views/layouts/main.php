<!DOCTYPE html>
<html lang="en" dir="ltr">

<?php /* @var $this Controller */ ?>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css" />
        
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/styles/layout.css" />
      
	
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body id="top">
<div class="wrapper row1">
  <header id="header" class="clear">
    <hgroup>
      <h1><img src="/r4p/images/logoback.png" width="600" height="120" border="0"></h1>
    </hgroup>
      
<div id="thawteseal" style="text-align:center;" title="Click to Verify - This site chose Thawte SSL for secure e-commerce and confidential communications.">
<div></div>

</div>

     <!-- admin menu --> 
      <nav>
     <?php if(!Yii::app()->user->isGuest):?>
   
      <ul class="clear">
        <li class="active"><a href="<?php echo Yii::app()->createAbsoluteUrl('/site/index');?>">Rise office</a></li>
        <li><a href="#">Banking</a>
         <ul>
           
                <li><a href="<?php echo Yii::app()->createAbsoluteUrl('/commission/admin');?>">Reward Statement</a></li>
                <li><a href="<?php echo Yii::app()->createAbsoluteUrl('/redemption/create');?>">Transfer Reward</a></li>
                
                  <?php if (Yii::app()->user->checkAccess(Controller::$admin,array("userId"=>Yii::app()->user->getId()))): ?>
            <li><a href="<?php echo Yii::app()->createAbsoluteUrl('/bank/admin');?>">Rise Bank</a></li>
 
            <?php endif; ?>
                <li><a href="<?php echo Yii::app()->createAbsoluteUrl('/userbank/admin');?>">Rise Bank Statement</a></li>
                <li><a href="<?php echo Yii::app()->createAbsoluteUrl('/transfer/create');?>">Transfer Rise Bank</a></li>
            
            <li><a href="<?php echo Yii::app()->createAbsoluteUrl('/dailySales');?>">Daily Sales</a></li>
            <li><a href="<?php echo Yii::app()->createAbsoluteUrl('/commission');?>">Daily Reward</a></li>
            <li><a href="<?php echo Yii::app()->createAbsoluteUrl('/sb/admin');?>">SB Statement</a></li>
            
          </ul>
        </li>
<?php if (Yii::app()->user->isAdmin()):?>


        <li><a href="#">Reports</a>
		
		 <ul>
            <li><a href="<?php echo Yii::app()->createAbsoluteUrl('/reports/users');?>">Users</a></li>
            <li><a href="<?php echo Yii::app()->createAbsoluteUrl('/reports/rewards');?>">Rewards</a></li>
            <li><a href="<?php echo Yii::app()->createAbsoluteUrl('/reports/purchases');?>">Purchases</a></li>
            <li><a href="<?php echo Yii::app()->createAbsoluteUrl('/reports/upgrades');?>">Upgrades</a></li>
          </ul>
		</li>


<?php endif ?>

        <li><a href="#">Rise Massenger</a>
		
		 <ul>
            <li><a href="<?php echo Yii::app()->createAbsoluteUrl('/message/compose');?>">Compose</a></li>
            <li><a href="<?php echo Yii::app()->createAbsoluteUrl('/message/inbox');?>">Inbox</a></li>
            <li><a href="<?php echo Yii::app()->createAbsoluteUrl('/message/sent');?>">Sent item</a></li>
          </ul>
		</li>
        <li><a href="#">Rise Tree</a>
		<ul>
            <li><a href="<?php echo Yii::app()->createAbsoluteUrl('/viewRiseTree');?>">View Rise Tree</a></li>
            <li><a href="<?php echo Yii::app()->createAbsoluteUrl('/planTable');?>">Plan Table</a></li>
          </ul>
		
		</li>
        <li><a href="#">Redemption</a>
		<ul>
            <li><a href="<?php echo Yii::app()->createAbsoluteUrl('/redemption/admin');?>">Redemption Product</a></li>
            <li><a href="<?php echo Yii::app()->createAbsoluteUrl('/redemptionHistory');?>">Redemption History</a></li>
          </ul>
		
		</li>
        
        <li><a href="">Product Catalog</a>
	
	<ul>

            <li><a href="/commerce/virtual.html">Virtual</a></li>
 
            <li><a href="/commerce/qpendant.html">Quantum Pendant</a></li>

            <li><a href="/commerce/energy.html">Energy Brecelets</a></li>

            <li><a href="/commerce/jewlery.html">Jewellery</a></li>

           <li><a href="/commerce/garments.html">Garments</a></li>

            <li><a href="/commerce/sbproduct.html">SB Produscts</a></li>


         </ul>

<?php /* ?>
	<ul>
                    <?php $prod = ProductDetail::model()->findAll();
                        foreach ($prod as $product):?>                 
                        <li><a href="<?php echo Yii::app()->createAbsoluteUrl('/productDetail/'.$product->product_id);?>"><?php echo $product->product->product;?></a></li>
                        <?php endforeach;?>
               </ul>

<?php */ ?>

        </li>
		
		 <li><a href="#">Account Settings </a>
		
		 <ul>
            <li><a href="<?php echo Yii::app()->createAbsoluteUrl('/users/update/'.yii::app()->user->getId());?>">Change Password</a></li>
            <li><a href="<?php echo Yii::app()->createAbsoluteUrl('/users/security');?>">Change Security Questions</a></li>
            
          </ul>
		</li>
		
		
        <li class="last"><a href="<?php echo Yii::app()->createAbsoluteUrl('/site/logout');?>">Log Out</a></li>
      </ul>
   
        
          
          
  <?php endif; ?>         
           <?php if(Yii::app()->user->isGuest):?>
     
     
      <ul class="clear">
        
            <li><a href="<?php echo Yii::app()->createAbsoluteUrl('/site/login');?>">Login</a></li>
            <li><a href="<?php echo Yii::app()->createAbsoluteUrl('/users/create');?>">Register</a></li>
            
          
         </ul>
   
  <?php endif; ?>
          

          
          <!-- Member AREA MENU END -->



  
          
          
           </nav>
     
     <!-- Non Login menu --> 
     
     
     
    
         
     
     
     
     
  </header>
</div>
    <?php /*
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>
	
*/?>
    <!-- content -->
<div class="wrapper row2">
  <div id="container" class="clear">
 
	<?php echo $content; ?>

</div>
</div>

	
        
        
        
        <div class="wrapper row3">
            
            <?php if(Yii::app()->user->isGuest):?>
            
  <div id="footer" class="clear">
    <!-- Section One -->
    <section class="one_quarter">
      <h2 class="title">About Us</h2>
      <figure class="imgholder"><img src="/images/demo/200x90.gif" width="200" height="90" alt=""></figure>
      <p>Rise (Revitalizing, Innovating, Strengthening, Economy)
Our company name showing our objective clearly,
And rise Goal is also to financially strenthening the helpless peoples Young students Womens by using modren methods.
Rise is not only sales its products,

</p>
      <p class="more"><a href="#">Read More &raquo;</a></p>
    </section>
    <!-- Section Two -->
    <section class="one_quarter">
      <h2 class="title">Quick Links</h2>
      <nav>
        <ul>
          <li><a href="<?php echo Yii::app()->createAbsoluteUrl('/site/index');?>">Home</a></li>
          <li><a href="<?php echo Yii::app()->createAbsoluteUrl('/aboutRise');?>">About Rise</a></li>
          <li><a href="<?php echo Yii::app()->createAbsoluteUrl('/opportunities');?>">Opportunities</a></li>
          <li><a href="<?php echo Yii::app()->createAbsoluteUrl('/faqs');?>">FAQs</a></li>
          <li><a href="<?php echo Yii::app()->createAbsoluteUrl('/users/create');?>">Sign Up</a></li>
          <li><a href="<?php echo Yii::app()->createAbsoluteUrl('/site/login');?>">Log In</a></li>
          <li><a href="<?php echo Yii::app()->createAbsoluteUrl('/contactus');?>">Contact Us</a></li>
          
        </ul>
      </nav>
    </section>
    <!-- Section Three -->
    <section class="one_quarter">
      <h2 class="title">Our Plans</h2>
      <article>
        <header>
          <h2>1/1</h2>
		  <h2>2/2</h2>
		  <h2>3/3</h2>
          
        </header>
        <p>If you would like to know about our plans. </p>
        <p class="more"><a href="#">Read More &raquo;</a></p>
      </article>
      <article>
        <header>
          <h2 class="title">Our Team Values</h2>
          <h2> Our Admin</h2>
		  <h2>Our Team</h2>
        </header>
        <p>If you would like to know about our team and our management.</p>
        <p class="more"><a href="#">Read More &raquo;</a></p>
      </article>
    </section>
    <!-- Section Four -->
    <section class="one_quarter lastbox">
      <h2 class="title">Contact Us</h2>
      <form method="post" action="#">
        <fieldset>
          <legend>Contact Form:</legend>
          <label for="cf_name">Name:</label>
          <input type="text" name="cf_name" id="cf_name" value="">
          <label for="cf_email">Email:</label>
          <input type="text" name="cf_email" id="cf_email" value="">
          <label for="cf_subject">Subject:</label>
          <input type="text" name="cf_subject" id="cf_subject" value="">
          <label for="cf_message">Message:</label>
          <textarea name="cf_message" id="cf_message" cols="45" rows="10"></textarea>
       <a class="button1" href="#"><span>Submit</span></a> 
 
         </fieldset>
      </form>
    </section>
    <!-- / Section -->
       </div> 
      
  </div>

<!-- Copyright -->
<div class="wrapper row4">
  <footer id="copyright" class="clear">
    <p class="fl_left">Copyright &copy; 2013 - All Rights Reserved - <a href="#">Rise 4 People</a></p>
    </footer>
    
     
    
</div>

<?php endif; ?>

<?php if(!Yii::app()->user->isGuest):?>


<!-- Footer -->
<!-- Footer -->
<div class="wrapper row3">
  <div id="footer" class="clear">
    <!-- Section One -->
    <section class="one_quarter">
      <h2 class="title">About Rise</h2>
      <nav>
        <ul>
          <li><a href="<?php echo Yii::app()->createAbsoluteUrl('/site/index');?>">Home</a></li>
          <li><a href="<?php echo Yii::app()->createAbsoluteUrl('/aboutRise');?>">About Rise</a></li>
          <li><a href="<?php echo Yii::app()->createAbsoluteUrl('/opportunities');?>">Opportunities</a></li>
          <li><a href="<?php echo Yii::app()->createAbsoluteUrl('/faqs');?>">FAQs</a></li>
          <li><a href="<?php echo Yii::app()->createAbsoluteUrl('/users/create');?>">Sign Up</a></li>
          <li><a href="#">Site Map</a></li>
          <li><a href="<?php echo Yii::app()->createAbsoluteUrl('/contactus');?>">Contact Us</a></li>
          
        </ul>
      </nav>
    </section>
    <!-- Section Two -->
    <section class="one_quarter">
      <h2 class="title">Banking</h2>
      <nav>
        <ul>
          <li><a href="<?php echo Yii::app()->createAbsoluteUrl('/userbank/admin');?>">My Reward</a></li>
            <li><a href="<?php echo Yii::app()->createAbsoluteUrl('/commission/admin');?>">Reward Statement</a></li>
            <li><a href="<?php echo Yii::app()->createAbsoluteUrl('/transfer/create');?>">Transfer Reward</a></li>
			 <li><a href="rise.html">Rise Bank</a></li>
			  <li><a href="<?php echo Yii::app()->createAbsoluteUrl('/userbank/admin');?>">Rise Bank Statement</a></li>
			  <li><a href="<?php echo Yii::app()->createAbsoluteUrl('/transfer/create');?>">Transfer Rise Bank</a></li>
			   <li><a href="sbstatement.html">SB Statement</a></li>
          
        </ul>
      </nav>
    </section>
    <!-- Section Three -->
    
    <section class="one_quarter">
      <h2 class="title">Quick Links</h2>
      <nav>
        <ul>
          <li><a href="<?php echo Yii::app()->createAbsoluteUrl('/viewRiseTree');?>">View Rise Tree</a></li>
            <li><a href="plantable.html">Plan Table</a></li>
          <li><a href="<?php echo Yii::app()->createAbsoluteUrl('/message/inbox');?>">Inbox</a></li>
            <li><a href="<?php echo Yii::app()->createAbsoluteUrl('/message/sent');?>">Sent item</a></li>
			<li><a href="<?php echo Yii::app()->createAbsoluteUrl('/redemption/admin');?>">Redemption Product</a></li>
          
        </ul>
      </nav>
    </section>
    <!-- Section Four -->
    <section class="one_quarter">
      <h2 class="title">Product Catalog</h2>
      <nav>
        <ul>
          <?php $prod = ProductDetail::model()->findAll();
                        foreach ($prod as $product):?>                 
                        <li><a href="<?php echo Yii::app()->createAbsoluteUrl('/productDetail/'.$product->product_id);?>"><?php echo $product->product->product;?></a></li>
                        <?php endforeach;?>
        </ul>
      </nav>
    </section>
    <!-- / Section -->
  </div>
</div>
<!-- Copyright -->
<div class="wrapper row4">
  <footer id="copyright" class="clear">
    <p class="fl_left">Copyright &copy; 2013 - All Rights Reserved - <a href="#">Rise 4 People</a></p>
    
  </footer>
</div>

<?php endif; ?>


</body>
</html>
