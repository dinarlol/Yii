

<div class="nugget">
<div class="recommend_descript">		
  	       <h4 class="red">Manage recommendations you've received</h4>
       <p>Ask colleagues, clients, managers, and employees to endorse your work. Get recommended.</p></div>
		<div class="hfix"> </div>
		
		

<?php 

$manager = new AkimboNuggetManager($user);
//print_r($manager->getRecomendationStats());
$manager->createRecomendationStats();



$recomendationstats = $manager->getRecomendationStats();
foreach ( $recomendationstats as $recomendation_type=>$recomendations){
	foreach ($recomendations as $recomendation){
	//print_r($recomendation);
	if($recomendation['count'] >0){
		$hidden = $recomendation['count'] - $recomendation['visible'];
	
		?>
		
		<div class="recomendation">
      	<div><h3><?php echo $recomendation['title'];?> <span class="red">@ <?php echo $recomendation['organization'];?></span></h3> </div> 
         <div class="mang_btn"><a href="<?php echo $this->createAbsoluteUrl('manage',array('category_id'=>$recomendation['category_id']));?>"> Manage</a></div>
		<p>You have <?php echo $recomendation['count'];?> recommendation for this <?php echo $recomendation['position'];?></p> (<span class="green"><?php echo $recomendation['visible'];?> visible, <?php echo $hidden;?> hidden</span>)
		</div>
		
		<?php 		
	}
	
	else{
		
		
		?>
		
		
		<div class="recomendation">
      	<div><h3> <?php echo $recomendation['title'];?> <span class="red">@ <?php echo $recomendation['organization'];?></span></h3> </div> 
		<p>You have no recommendation for this <?php echo $recomendation['position'];?></p> 
		</div>
		
		<?php 
		
		
	}
	
	}
}

?>

</div>

