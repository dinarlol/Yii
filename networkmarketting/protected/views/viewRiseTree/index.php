    <?php echo $this->renderPartial('_search', array('model'=>$model)); ?>
<?php echo $this->renderPartial('childinfo', array('model'=>$model)); ?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>
<td align="left">&nbsp;</td>
<td width="480"></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
 
<tr>
<td align="left" width="60"><strong>Level</strong><br><br><span class="dropcap2">
       <?php echo $level; ?>
        </span></td></td>
<td width="130"></td>
<td width="290">
<figure class="border_img2">
<?php echo $model->username; ?></a><br>
<?php echo $model->created_date;?><br>
 <?php echo CHtml::ajaxLink('View More',
        array('lookup/childData'),
        array(
            
            'update'=>'#childbox',
            'data' => 'id='.$model->user_id,
        ),
        array('onclick'=>'$("#childModal").dialog("open");',
            'id'=>uniqid('child_'))
);?>

</figure></td>
<td width="285"></td>
</tr>
<tr>
<td width="60" height="35"></td>
<td colspan="3"><p align="center"><img src="/images/level1.png" width="60%" height="25"></p></td>
</tr>

</tbody>
</table>


<table border="0" cellpadding="0" cellspacing="0" width="100%">

 
<tr>
<td align="left" width="24"><br>
<span class="dropcap2">
<?php
/* @var $this ViewRiseTreeController */

/*$this->breadcrumbs=array(
	'View Rise Tree',
);*/

// stage 1 code 
       
     
        echo $level+1;?>
      </span></td>
<td width="22"></td>
<td width="70"></td>
     <?php   
       if(!empty($model->leftchild->username)): ?>
<td width="91">
<figure class="border_img2">
    <a href="<?php echo $this->createAbsoluteUrl("".$model->leftchild->user_id); ?>">
<?echo $model->leftchild->username ?></a><br>
<?php echo $model->leftchild->created_date; ?><br>
 <?php echo CHtml::ajaxLink('View More',
        array('lookup/childData'),
        array(
            
            'update'=>'#childbox',
            'data' => 'id='.$model->leftchild->user_id,
        ),
        array('onclick'=>'$("#childModal").dialog("open");',
            'id'=>uniqid('child_'))
);?> </figure>
</td>

<?php else:?>

<td width="96">
<figure class="border_img2">

    
    <a href="<?php 
    echo $this->createAbsoluteUrl("/users/create",array("position"=>"left","parent"=>  empty($model->user_id)?'':$model->user_id)); ?>">
add user</a><br>
<br>

</td>


<?php endif;?>

<td width="5"></td>
<td width="46"></td>
<td width="117"></td>
 
 
<?php if(!empty($model->rightchild->username)): ?>
<td width="17">
<figure class="border_img2">
  <a href="<?php echo $this->createAbsoluteUrl("".$model->rightchild->user_id); ?>">
<?echo $model->rightchild->username ?></a><br>
<?php echo $model->rightchild->created_date; ?><br>
 <?php echo CHtml::ajaxLink('View More',
        array('lookup/childData'),
        array(
            
            'update'=>'#childbox',
            'data' => 'id='.$model->rightchild->user_id,
        ),
        array('onclick'=>'$("#childModal").dialog("open");',
            'id'=>uniqid('child_'))
);?> </figure>
</td>

<?php else:?>

<td width="67">
<figure class="border_img2">
<a href="<?php echo $this->createAbsoluteUrl("/users/create",array("position"=>"right","parent"=>  empty($model->user_id)?'':$model->user_id)); ?>">
add user</a><br>
<br>
 </figure>
</td>


<?php endif;?>
<td width="71"></td>
</tr>

 
<tr>
<td width="24"></td>
<td width="22"></td>
<td colspan="2"><p align="right"><img src="/images/level2.png" width="150" height="25"></p></td>
<td width="96"></td>
<td colspan="3"><p align="right"><img src="/images/level2.png" width="150" height="25"></p></td>
</tr>
<?php // stage 1 end ?> 

<td height="21"></tbody>
</table>




<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
 
<tr>
<td width="34" align="left"> <span class="dropcap2">

<?php // stage 2 starts  ?>
        <?php echo $level+2; ?>
        </span></td>
<td width="23"></td>
<td width="60"></td>
<td width="124">
<?php if(!empty($model->leftchild->user_id)):?>
<?php if(!empty($model->leftchild->leftchild->user_id)):?>    
    <figure class="border_img22">
<figure class="border_img2">
    <a href="<?php echo $this->createAbsoluteUrl("".$model->leftchild->leftchild->user_id); ?>">
<?echo $model->leftchild->leftchild->username ?></a><br>
<?php echo $model->leftchild->leftchild->created_date; ?><br>
  <?php echo CHtml::ajaxLink('View More',
        array('lookup/childData'),
        array(
            
            'update'=>'#childbox',
            'data' => 'id='.$model->leftchild->leftchild->user_id,
        ),
        array('onclick'=>'$("#childModal").dialog("open");',
            'id'=>uniqid('child_'))
);?> </figure> </figure>
<?php else: ?>
    <figure class="border_img2">
<a href="<?php echo $this->createAbsoluteUrl("/users/create",array("position"=>"left","parent"=>  empty($model->leftchild->user_id)?'':$model->leftchild->user_id)); ?>">
add user</a><br>
<br>
 </figure>
    
    <?php endif;?>
    
    <?php else: ?>
    <figure class="border_img2">
  <img src="/images/nosignup.jpg"> </figure>

<?php endif; ?>
</td>
<td width="88"></td>
<td width="1"></td>
<td width="49"></td>
 
<td width="131">
 
<figure class="border_img22">
<?php if(!empty($model->leftchild->user_id)):?>
<?php if(!empty($model->leftchild->rightchild->user_id)):?>    
    <figure class="border_img22">
<figure class="border_img2">
    <a href="<?php echo $this->createAbsoluteUrl("".$model->leftchild->rightchild->user_id); ?>">
<?echo $model->leftchild->rightchild->username ?></a><br>
<?php echo $model->leftchild->rightchild->created_date; ?><br>
  <?php echo CHtml::ajaxLink('View More',
        array('lookup/childData'),
        array(
            
            'update'=>'#childbox',
            'data' => 'id='.$model->leftchild->rightchild->user_id,
        ),
        array('onclick'=>'$("#childModal").dialog("open");',
            'id'=>uniqid('child_'))
);?>  </figure> </figure>
<?php else: ?>
    <figure class="border_img2">
<a href="<?php echo $this->createAbsoluteUrl("/users/create",array("position"=>"right","parent"=>  empty($model->leftchild->user_id)?'':$model->leftchild->user_id)); ?>">
add user</a><br>
<br>
 </figure>
    
    <?php endif;?>
    
    <?php else: ?>
    <figure class="border_img2">
  <img src="/images/nosignup.jpg"> </figure>

<?php endif; ?>
</td>

<td width="296" align="left"><br>
  <br></td>

<?php //begin stage 2 right left     

//
?>
<td width="152">
    
    <?php if(!empty($model->rightchild)):?>
<?php if(!empty($model->rightchild->leftchild)):?>    
    <figure class="border_img22">
<figure class="border_img2">
    <a href="<?php echo $this->createAbsoluteUrl("".$model->rightchild->leftchild->user_id); ?>">
<?echo $model->rightchild->leftchild->username ?></a><br>
<?php echo $model->rightchild->leftchild->created_date; ?><br>
 <?php echo CHtml::ajaxLink('View More',
        array('lookup/childData'),
        array(
            
            'update'=>'#childbox',
            'data' => 'id='.$model->rightchild->leftchild->user_id,
        ),
        array('onclick'=>'$("#childModal").dialog("open");',
            'id'=>uniqid('child_'))
);?>  </figure> </figure>
<?php else: ?>
    <figure class="border_img2">
<a href="<?php echo $this->createAbsoluteUrl("/users/create",array("position"=>"left","parent"=>  empty($model->rightchild->user_id)?'':$model->rightchild->user_id)); ?>">
add user</a><br>
<br>
 </figure>
    
    <?php endif;?>
    
    <?php else: ?>
    <figure class="border_img2">
  <img src="/images/nosignup.jpg"> </figure>

<?php endif; ?>
    
</td>

<td width="5" align="left"><br>
    
  <br></td>

<td width="36"></td>
<td width="56"></td>

<td width="190">
    
    <?php if(!empty($model->rightchild)):?>
<?php if(!empty($model->rightchild->rightchild)):?>    
    <figure class="border_img2">
<figure class="border_img2">
    <a href="<?php echo $this->createAbsoluteUrl("".$model->rightchild->rightchild->user_id); ?>">
<?echo $model->rightchild->rightchild->username ?></a><br>
<?php echo $model->rightchild->rightchild->created_date; ?><br>
   <?php echo CHtml::ajaxLink('View More',
        array('lookup/childData'),
        array(
            
            'update'=>'#childbox',
            'data' => 'id='.$model->rightchild->rightchild->user_id,
        ),
        array('onclick'=>'$("#childModal").dialog("open");',
            'id'=>uniqid('child_'))
);?>  </figure> </figure>
<?php else: ?>
    <figure class="border_img2">
<a href="<?php echo $this->createAbsoluteUrl("/users/create",array("position"=>"right","parent"=>  empty($model->rightchild->user_id)?'':$model->rightchild->user_id)); ?>">
add user</a><br>
<br>
 </figure>
    
    <?php endif;?>
    
    <?php else: ?>
    <figure class="border_img2">
  <img src="/images/nosignup.jpg"> </figure>

<?php endif; ?>
    
</td>

</tr>


<tr>
<td width="34" height="25"></td>
<td width="23"></td>
<td colspan="14"><table width="90%" height="25" border="0" cellpadding="0" cellspacing="0">
  <tr>
      <td width="10" height="25">&nbsp;</td>
      <td width="175"><img src="/images/level2.png" width="100" height="25" /></td>
      <td width="114">&nbsp;</td>
      <td width="148"><img src="/images/level2.png" width="100" height="25" /></td>
      <td width="23">&nbsp;</td>
      <td width="137">&nbsp;</td>
      <td width="274"><img src="/images/level2.png" width="100" height="25" /></td>
      <td width="188"><img src="/images/level2.png" width="100" height="25" /></td>
      </tr>
  </table> </td>
</tr>

<?php // end stage 2 left and begin stage 3 
//

?>

<?php
// $model->leftchild->leftchild->leftchild
// $model->leftchild->leftchild->rightchild
// $model->leftchild->rightchild->leftchild
// $model->leftchild->rightchild->rightchild


// $model->rightchild->leftchild->leftchild
// $model->rightchild->leftchild->rightchild
// $model->rightchild->rightchild->leftchild
// $model->rightchild->rightchild->rightchild
?>

</table>


<table width="100%" cellspacing="0" cellpadding="0" border="0">
<tbody>
        <tr>
            <td width="29" align="left"><br>
        <br><span class="dropcap2">
      <?php  echo $level+3; ?>
        </span></td>
            <td width="19"></td>
          <td width="105">
      <?php
// $model->leftchild->leftchild->leftchild

?>
       <?php if(!empty($model->leftchild->leftchild)):?>
<?php if(!empty($model->leftchild->leftchild->leftchild)):?>    
    <figure class="border_img22">
<figure class="border_img2">
    <a href="<?php echo $this->createAbsoluteUrl("".$model->leftchild->leftchild->leftchild->user_id); ?>">
<?echo $model->leftchild->leftchild->leftchild->username ?></a><br>
<?php echo $model->leftchild->leftchild->leftchild->created_date; ?><br>

 <?php echo CHtml::ajaxLink('View More',
        array('lookup/childData'),
        array(
            
            'update'=>'#childbox',
            'data' => 'id='.$model->leftchild->leftchild->leftchild->user_id,
        ),
        array('onclick'=>'$("#childModal").dialog("open");',
            'id'=>uniqid('child_'))
);?>  </figure> </figure>
<?php else: ?>
    <figure class="border_img2">
<a href="<?php echo $this->createAbsoluteUrl("/users/create",array("position"=>"left","parent"=>  empty($model->leftchild->leftchild->user_id)?'':$model->leftchild->leftchild->user_id)); ?>">
add user</a><br>
<br>
 </figure>
    
    <?php endif;?>
    
    <?php else: ?>
    <figure class="border_img2">
  <img src="/images/nosignup.jpg"> </figure>

<?php endif; ?>
          </td>
           <td width="32"> </td>
           
           
           <td width="27"></td>
           <td width="105">
               <?php
// $model->leftchild->leftchild->rightchild
?>
               
               <?php if(!empty($model->leftchild->leftchild)):?>
<?php if(!empty($model->leftchild->leftchild->rightchild)):?>    
    <figure class="border_img22">
<figure class="border_img2">
    <a href="<?php echo $this->createAbsoluteUrl("".$model->leftchild->leftchild->rightchild->user_id); ?>">
<?echo $model->leftchild->leftchild->rightchild->username ?></a><br>
<?php echo $model->leftchild->leftchild->rightchild->created_date; ?><br>
   <?php echo CHtml::ajaxLink('View More',
        array('lookup/childData'),
        array(
            
            'update'=>'#childbox',
            'data' => 'id='.$model->leftchild->leftchild->rightchild->user_id,
        ),
        array('onclick'=>'$("#childModal").dialog("open");',
            'id'=>uniqid('child_'))
);?>  </figure> </figure>
<?php else: ?>
    <figure class="border_img2">
<a href="<?php echo $this->createAbsoluteUrl("/users/create",array("position"=>"right","parent"=>  empty($model->leftchild->leftchild->user_id)?'':$model->leftchild->leftchild->user_id)); ?>">
add user</a><br>
<br>
 </figure>
    
    <?php endif;?>
    
    <?php else: ?>
    <figure class="border_img2">
  <img src="/images/nosignup.jpg"> </figure>

<?php endif; ?>
               
           </td>
           <td width="53"></td>
           <td width="100">
               <?php

// $model->leftchild->rightchild->leftchild
?>
             <?php if(!empty($model->leftchild->rightchild)):?>
<?php if(!empty($model->leftchild->rightchild->leftchild)):?>    
    <figure class="border_img22">
<figure class="border_img2">
    <a href="<?php echo $this->createAbsoluteUrl("".$model->leftchild->rightchild->leftchild->user_id); ?>">
<?echo $model->leftchild->rightchild->leftchild->username ?></a><br>
<?php echo $model->leftchild->rightchild->leftchild->created_date; ?><br>
   <?php echo CHtml::ajaxLink('View More',
        array('lookup/childData'),
        array(
            
            'update'=>'#childbox',
            'data' => 'id='.$model->leftchild->rightchild->leftchild->user_id,
        ),
        array('onclick'=>'$("#childModal").dialog("open");',
            'id'=>uniqid('child_'))
);?> </figure> </figure>
<?php else: ?>
    <figure class="border_img2">
<a href="<?php echo $this->createAbsoluteUrl("/users/create",array("position"=>"left","parent"=>  empty($model->leftchild->rightchild->user_id)?'':$model->leftchild->rightchild->user_id)); ?>">
add user</a><br>
<br>
 </figure>
    
    <?php endif;?>
    
    <?php else: ?>
    <figure class="border_img2">
  <img src="/images/nosignup.jpg"> </figure>

<?php endif; ?>  
               
           </td>
           
         
           <td width="42"></td>
           <td width="105">
            <?php
// 4 $model->leftchild->rightchild->rightchild
?>   
               <?php if(!empty($model->leftchild->rightchild)):?>
<?php if(!empty($model->leftchild->rightchild->rightchild)):?>    
    <figure class="border_img22">
<figure class="border_img2">
    <a href="<?php echo $this->createAbsoluteUrl("".$model->leftchild->rightchild->rightchild->user_id); ?>">
<?echo $model->leftchild->rightchild->rightchild->username ?></a><br>
<?php echo $model->leftchild->rightchild->rightchild->created_date; ?><br>
   <?php echo CHtml::ajaxLink('View More',
        array('lookup/childData'),
        array(
            
            'update'=>'#childbox',
            'data' => 'id='.$model->leftchild->rightchild->rightchild->user_id,
        ),
        array('onclick'=>'$("#childModal").dialog("open");',
            'id'=>uniqid('child_'))
);?> </figure> </figure>
<?php else: ?>
    <figure class="border_img2">
<a href="<?php echo $this->createAbsoluteUrl("/users/create",array("position"=>"right","parent"=>  empty($model->leftchild->rightchild->user_id)?'':$model->leftchild->rightchild->user_id)); ?>">
add user</a><br>
<br>
 </figure>
    
    <?php endif;?>
    
    <?php else: ?>
    <figure class="border_img2">
  <img src="/images/nosignup.jpg"> </figure>

<?php endif; ?>
           </td>
            <td width="65"></td>
           <?php // 5 $model->rightchild->leftchild->leftchild  ?>
           
           
              <td width="92">
           <?php if(!empty($model->rightchild->leftchild)):?>
<?php if(!empty($model->rightchild->leftchild->leftchild)):?>    
    <figure class="border_img22">
<figure class="border_img2">
    <a href="<?php echo $this->createAbsoluteUrl("".$model->rightchild->leftchild->leftchild->user_id); ?>">
<?echo $model->rightchild->leftchild->leftchild->username ?></a><br>
<?php echo $model->rightchild->leftchild->leftchild->created_date; ?><br>
   <?php echo CHtml::ajaxLink('View More',
        array('lookup/childData'),
        array(
            
            'update'=>'#childbox',
            'data' => 'id='.$model->rightchild->leftchild->leftchild->user_id,
        ),
        array('onclick'=>'$("#childModal").dialog("open");',
            'id'=>uniqid('child_'))
);?> </figure> </figure>
<?php else: ?>
    <figure class="border_img2">
<a href="<?php echo $this->createAbsoluteUrl("/users/create",array("position"=>"left","parent"=>  empty($model->rightchild->leftchild->user_id)?'':$model->rightchild->leftchild->user_id)); ?>">
add user</a><br>
<br>
 </figure>
    
    <?php endif;?>
    
    <?php else: ?>
    <figure class="border_img2">
  <img src="/images/nosignup.jpg"> </figure>

<?php endif; ?>       
                  
                  
              </td>
           
       <td width="40"></td>    
           <td width="88">
               
               <?php if(!empty($model->rightchild->leftchild)):?>
<?php if(!empty($model->rightchild->leftchild->rightchild)):?>    
    <figure class="border_img22">
<figure class="border_img2">
    <a href="<?php echo $this->createAbsoluteUrl("".$model->rightchild->leftchild->rightchild->user_id); ?>">
<?echo $model->rightchild->leftchild->rightchild->username ?></a><br>
<?php echo $model->rightchild->leftchild->rightchild->created_date; ?><br>
  <?php echo CHtml::ajaxLink('View More',
        array('lookup/childData'),
        array(
            
            'update'=>'#childbox',
            'data' => 'id='.$model->rightchild->leftchild->rightchild->user_id,
        ),
        array('onclick'=>'$("#childModal").dialog("open");',
            'id'=>uniqid('child_'))
);?>  </figure> </figure>
<?php else: ?>
    <figure class="border_img2">
<a href="<?php echo $this->createAbsoluteUrl("/users/create",array("position"=>"right","parent"=>  empty($model->rightchild->leftchild->user_id)?'':$model->rightchild->leftchild->user_id)); ?>">
add user</a><br>
<br>
 </figure>
    
    <?php endif;?>
    
    <?php else: ?>
    <figure class="border_img2">
  <img src="/images/nosignup.jpg"> </figure>

<?php endif; ?>
               
           </td>
           
        <td width="105"></td>
        
        <td width="85">
            <?php
// 7 $model->rightchild->rightchild->leftchild
?>
            <?php if(!empty($model->rightchild->rightchild)):?>
<?php if(!empty($model->rightchild->rightchild->leftchild)):?>    
    <figure class="border_img22">
<figure class="border_img2">
    <a href="<?php echo $this->createAbsoluteUrl("".$model->rightchild->rightchild->leftchild->user_id); ?>">
<?echo $model->rightchild->rightchild->leftchild->username ?></a><br>
<?php echo $model->rightchild->rightchild->leftchild->created_date; ?><br>
   <?php echo CHtml::ajaxLink('View More',
        array('lookup/childData'),
        array(
            
            'update'=>'#childbox',
            'data' => 'id='.$model->rightchild->rightchild->leftchild->user_id,
        ),
        array('onclick'=>'$("#childModal").dialog("open");',
            'id'=>uniqid('child_'))
);?>  </figure> </figure>
<?php else: ?>
    <figure class="border_img2">
        <a href="<?php echo $this->createAbsoluteUrl("/users/create",array("position"=>"left","parent"=>  empty($model->rightchild->rightchild->user_id)?'':$model->rightchild->rightchild->user_id)); ?>">
add user</a><br>
<br>
 </figure>
    
    <?php endif;?>
    
    <?php else: ?>
    <figure class="border_img2">
  <img src="/images/nosignup.jpg"> </figure>

<?php endif; ?>
            
        </td>
           <td width="61"></td>
           <td width="89">
               
               <?php
// 8 $model->rightchild->rightchild->rightchild
?>
               
               <?php if(!empty($model->rightchild->rightchild)):?>
<?php if(!empty($model->rightchild->rightchild->rightchild)):?>    
    <figure class="border_img22">
<figure class="border_img2">
    <a href="<?php echo $this->createAbsoluteUrl("".$model->rightchild->rightchild->rightchild->user_id); ?>">
<?echo $model->rightchild->rightchild->rightchild->username ?></a><br>
<?php echo $model->rightchild->rightchild->rightchild->created_date; ?><br>
   <?php echo CHtml::ajaxLink('View More',
        array('lookup/childData'),
        array(
            
            'update'=>'#childbox',
            'data' => 'id='.$model->rightchild->rightchild->rightchild->user_id,
        ),
        array('onclick'=>'$("#childModal").dialog("open");',
            'id'=>uniqid('child_'))
);?> </figure> </figure>
<?php else: ?>
    <figure class="border_img2">
<a href="<?php echo $this->createAbsoluteUrl("/users/create",array("position"=>"right","parent"=>  empty($model->rightchild->rightchild->user_id)?'':$model->rightchild->rightchild->user_id)); ?>">
add user</a><br>
<br>
 </figure>
    
    <?php endif;?>
    
    <?php else: ?>
    <figure class="border_img2">
  <img src="/images/nosignup.jpg"> </figure>

<?php endif; ?>
               
           </td>
           <td width="3"></td>
        </tr>
  </tbody>
</table>
