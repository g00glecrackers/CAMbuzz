<!--header-bar-->

<?php

 $corner_image = "images/user_male.jpg";
 if(isset($USER)){
 	
 	if(file_exists($USER['profile_image']))
   {

	   $image_class = new Image();
	 	$corner_image = $image_class->get_thumb_profile($USER['profile_image']);
 
  }else{

  	if($USER['Gender'] == "Female")
  	{
  		$corner_image = "images/user_female.jpg";
  	}
  }
    
 }
?>
		<div id="head-bar">
			<form method="get" action="search.php">
					<div style="width: 800px;margin: auto;font-size: 30px;">

						<a href="profilepage.php" style="color: #00BFFF; font-weight: bold; text-decoration: none;"> CAMbuzz </a> 

						
						&nbsp &nbsp <input type="text" id="search-box" name="find" placeholder="Search" style="color:#00BFFF;">
						
						<?php if(isset($USER) ): ?>
								<a href="profilepage.php">
								<img src="<?php echo $corner_image ?>" style="width: 40px;float: right;border-radius: 40px;">
							    </a>
								<a href="login.php">
								<span id="logout-hover" style="font-size: 11px;float: right; margin: 10px;color: black; font-weight: bold;">Logout</span>
								</a>

					  <?php else: ?>
					      <a href="login.php">
								<span id="logout-hover" style="font-size: 13px;float: right; margin: 10px;color: black; font-weight: bold;">Login</span>
					  <?php endif; ?>


					</div>
			</form>
		</div>