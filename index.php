<?php
  
  include("classes/links.php");

  
  $login = new Login();
  $user_data = $login->check_login($_SESSION['CAMbuzz_userId']);
  
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
  if($_SERVER['REQUEST_METHOD'] == "POST")
  {
    
    
  	$post = new Post();
  	$Id = $_SESSION['CAMbuzz_userId'];
  	$result = $post->create_post($Id,$_POST,$_FILES);

  	if($result == "")
  	{

  		header("Location: index.php");
  		die;
  	}else
  	{
  		 echo "<div style='text-align:center; font-size:12px; color:white;background-color:grey;'>";
        echo "<br>The following errors occured<br><br>";
        echo $result; 
        echo "</div>";
  	}
  	
  }
?>

<html>
	<head>
		<title>Timeline | CAMbuzz</title>
		<style type="text/css">
			#head-bar{
				height:50px;
			    background-color: whitesmoke;
			    color:#d9dfeb;
            }
            #logout-hover:hover
			{
				background-color: lightgrey;
			}

			
			#search-box{
				width: 400px;
				height: 20px;
				border-radius: 5px;
				border: none;
				margin: 4px;
				font-size: 14px;
				background-image: url(search.png);
				background-repeat: no-repeat;
				background-position: right;


			}
			#pro-pic{
				width: 150px;
				height: 150px;
				border-radius: 70%;
				border: solid 2px white;
			}
			#menu-btn{
				width: 100px;
				margin: 2px;
				display: inline-block;
			}
			#frnd-img{
               width: 75px;
               float: left;
               margin: 8px;
               

			}
			#friends-bar{
				
				min-height: 400px;
				margin-top: 20px;
				color: #aaa;
				padding: 8px;
				text-align: center;
				font-size: 20px;
				color: #405d9b;
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
               color: white;
               padding: 4px;
               font-size: 14px;
               border-radius: 2px;
               width: 60px;
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
			}
			
		</style>
	</head>
	<body style="font-family: tahoma;background-color: #d0d8e4;">
		<br>

		<!--header-bar-->
		<?php
		    include("header.php");
		?>
		<!--cover area-->
		<div style="width: 800px;margin: auto;background-color: ;min-height: 400px;">
			

            <!--below cover area-->
			<div style="display: flex;">

				<!--friends area-->
			<div style="min-height: 400px;flex: 1;">
                  <div id="friends-bar">
                  	
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

                  	<a href="profilepage.php" style="text-decoration: none;"><?php echo $user_data['first_name'] . "<br> " . $user_data['Last_name'] ?></a>

                  	<br></div>
                  </div>

			    <!--post area-->
			<div style="min-height: 400px;flex: 2.5;padding: 20px; padding-right: 0px;">
				<div style="border: solid thin #aaa; padding: 10px;background-color: white;">

					 <form method="post" enctype="multipart/form-data">

					  <textarea name="post" placeholder="whats on your mind"></textarea>
					  <input type="file" name="file">
                      <input id="post-btn" type="submit" value="post">
                       <br>

                    </form>
					</div>

				    <!-- posts-->
				     <div id="post-bar">
                         
					      					
                         <?php

                         	$page_number = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                         	$page_number = ($page_number < 1) ? 1 : $page_number;

                         	
                         	$limit = 10;
                         	$offset = ($page_number - 1) * $limit;

                         	$DB = new Database();
                         	$user_class = new User();
                         	$image_class = new Image();

                         	$followers = $user_class->get_following($_SESSION['CAMbuzz_userId'],"user");

                         	$follower_ids = false;
                         	if(is_array($followers)){

                         		$follower_ids = array_column($followers, "userId");
                         		$follower_ids = implode("','", $follower_ids);


                         	}

                         	if($follower_ids){

                         		$MyuserId = ($_SESSION['CAMbuzz_userId']);
                         		$sql = "select * from cambuzz_posts where parent = 0 and (userId = '$MyuserId' || userId in('" . $follower_ids . "')) order by Id desc limit $limit offset $offset";

                         		$cambuzz_posts = $DB->read($sql);
                         	}
                         	
                             if(isset($cambuzz_posts) && $cambuzz_posts)
                             {
                             	foreach ($cambuzz_posts as $ROW) {
                             		// code...
                                    
                                    $user = new User();
                             		$ROW_USER = $user->get_user($ROW['userId']);

                             		include("post.php");
                             	}
                             }
                             
                             	
                             
                             
                         ?>
					   
					
				    </div>

			</div>

		</div>
	</div>

</body>
</html>