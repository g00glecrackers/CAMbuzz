<?php
  
  include("classes/links.php");

  $login = new Login();
  $_SESSION['CAMbuzz_userId'] = isset($_SESSION['CAMbuzz_userId']) ? $_SESSION['CAMbuzz_userId'] : 0;
  $user_data = $login->check_login($_SESSION['CAMbuzz_userId'],false);
  
  $USER = $user_data;
  
  if(isset($_GET['Id']) && is_numeric($_GET['Id']))
  {

  	$profiles = new Profile();
  $profile_data = $profiles->get_profiles($_GET['Id']);
  
  if(is_array($profile_data))
	  {

	  	 $user_data = $profile_data[0];
	  }
  }
  

  // POSTING STARTS FROM HERE
  if($_SERVER['REQUEST_METHOD'] == "POST")
  {
    
    if(isset($_POST['first_name'])){

    	$settings_class = new Settings();
    	$settings_class->save_settings($_POST,$_SESSION['CAMbuzz_userId']);
    }else{

    	$post = new Post();
  	$Id = $_SESSION['CAMbuzz_userId'];
  	$result = $post->create_post($Id,$_POST,$_FILES);

  	if($result == "")
  	{

  		header("Location: profilepage.php");
  		die;
  	}else
  	{
  		 echo "<div style='text-align:center; font-size:12px; color:white;background-color:grey;'>";
        echo "<br>The following errors occured<br><br>";
        echo $result; 
        echo "</div>";
  	}
  	
  }
    }
  	

  //collect posts

    $post = new Post();
  	$Id = $user_data['userId'];

  	$cambuzz_posts = $post->get_post($Id);

  	//collect friends
    
    $user = new User();
  	$Id = $_SESSION['CAMbuzz_userId'];

  	$friends = $user->get_friends($Id);

  	$image_class = new Image();

?>
<html>
	<head>
		<title>profile | CAMbuzz</title>
		<style type="text/css">
			#head-bar{
				height:50px;
			background-color: whitesmoke;
			color:#d9dfeb;
			border-radius: 10px;

			}
			#logout-hover:hover
			{
				background-color: lightgrey;
			}

			#textbox{
				width: 100%;
				height: 20px;
				border-radius: 5px;
				border: none;
				margin: 4px;
				font-size: 14px;
				border: solid thin gray;
				margin: 10px;
				
                

			}
			#pro-pic{
				width: 130px;
				margin-top: -150px;
				border-radius: 200%;
				border: solid 2px white;
			}
			#menu-btn{
				width: 100px;
				margin: 2px;
				display: inline-block;
				color: black; 
				border: none; 
				background-color:#00BFFF;
				border-radius: 4px;
				margin: 15px;

			}
			#menu-btn:hover
			{
				background-color: whitesmoke;
				color: #00BFFF;
			}
			#frnd-img{
               width: 75px;
               float: left;
               margin: 8px;
               

			}
			#friends-bar{
				background-color: white;
				min-height: 400px;
				margin-top: 20px;
				color: #aaa;
				padding: 8px;
			}
			#friends{
				clear: both;
				font-size: 12px;
				font-weight: bold;
				color: #405d9b;
			}
			textarea{
               width: 100%;
               border: none;
               font-family: tahoma;
               font-size: 14px;
               height: 60px;
               
			}
			#post-btn{
               float: right;
               background-color: #00BFFF;
               border: none;
               color: black;
               padding: 4px;
               font-size: 14px;
               border-radius: 2px;
               width: 60px;
               min-width: 50px;
               cursor: pointer;
			}
			#post-btn:logout-hover{
				background-color: whitesmoke;
			}
			#post-bar{
				margin-top: 20px;
				background-color: white ;
				padding: 10px;
			}
			#post{
				padding: 1px;
				font-size: 13px;
				display:flex;
				margin-bottom: 20px;
				background-color:;
			}
			#underline:hover{
				background-color: lightgreen;
			}
			
		</style>
	</head>
	<body style="font-family: tahoma;background-color: #d0d8e4;">
		

		<?php
		include("header.php");
		?>
		<!--cover area-->
		
		<div style="width: 1100px;margin: auto;background-color: ;min-height: 300px;">
			<div style="background-color: white;text-align: center;color: #405d9b;">
                 
                 <?php
                       
                       $image = "images/cover2.jpg";
                       if(file_exists($user_data['cover_image']))
                       {

                       	$image = $image_class->get_thumb_cover($user_data['cover_image']);
                       }
                    ?>
				<img src="<?php echo $image ?>" style="width: 100%;height: 400px;">

				

				<span style="font-size: 12px;">
                    
                    <?php
                       
                       $image = "images/user_male.jpg";
                       if($user_data['Gender'] == "Female")
                       {

                       	 $image = "images/user_female.jpg";
                       }
                       if(file_exists($user_data['profile_image']))
                       {

                       	$image = $image_class->get_thumb_profile($user_data['profile_image']);
                       }
                    ?>
					<img src="<?php echo $image ?>" id="pro-pic"><br>

					<?php if(i_own_content($user_data)): ?>

						<a style="text-decoration: none; color: blueviolet;" href="change_image.php?change=profile"> Change image </a> |
						<a style="text-decoration: none; color: blueviolet;" href="change_cover_image.php?change=cover"> Change cover </a> <br>

				    <?php endif; ?>
				</span>
				<br>
				<div style="font-size: 20px; color: black;font-weight: bold;">
					<a href="profilepage.php?Id=<?php echo $user_data['userId'] ?>" style="font-size: 20px; color: black;font-weight: bold;text-decoration: none;">
					<?php echo $user_data['first_name'] . " " . $user_data['Last_name'] ?>
					</a>
				<br>

				<?php

				   

				   	$Mylikes = $user_data['likes'];
				   
				?>

				<a href="likes.php?type=user&Id=<?php echo $user_data['userId'] ?>">
				    
				</a>
			</div>
			<br>

				<a href="index.php"> <div id=menu-btn>Home</div> </a>
				<a href="profilepage.php?section=about&Id=<?php echo $user_data['userId'] ?>"><div id="menu-btn" >About</div></a>
				<!--<a href="profilepage.php?section=followers&Id=<?php echo $user_data['userId'] ?>"><div id="menu-btn" >Followers</div></a>-->
				<!--<a href="profilepage.php?section=following&Id=<?php echo $user_data['userId'] ?>"><div id="menu-btn" >Following</div></a>-->
				<a href="profilepage.php?section=Photos&Id=<?php echo $user_data['userId'] ?>"><div id="menu-btn" >Photos</div></a>
				
				<?php 
					if($user_data['userId'] == $_SESSION['CAMbuzz_userId']){

						echo '<a href="profilepage.php?section=settings&Id=' .$user_data['userId']. '"><div id="menu-btn" >Settings</div> </a>';
					}
					
					?>
			</div>

            <!--below cover area-->
			
			<?php
			$section = "default";
			if(isset($_GET['section'])){

				$section = $_GET['section'];
			}

			if($section == "default"){

				include("profile_content_default.php");

			}
			elseif($section == "following"){

				include("profile_content_following.php");

			}
			elseif($section == "followers"){

				include("profile_content_followers.php");

			}
			elseif($section == "about"){

				include("profile_content_about.php");
			}
			elseif($section == "settings"){

				include("profile_content_settings.php");
			}
			elseif($section == "Photos"){

				include("profile_content_photos.php");
			}
			
			?>
	</div>

</body>
</html>