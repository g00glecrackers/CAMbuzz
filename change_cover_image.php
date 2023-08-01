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

    if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != "")
    {
    	$filename = "uplouds/" . $_FILES['file']['name'];
    move_uploaded_file($_FILES['file']['tmp_name'],$filename);

    if(file_exists($filename))
    {

    	$userId = $user_data['userId'];
    	$change = "cover";

    	if(isset($_GET['change']))
    	{

    		$change = $_GET['[change]'];
    	}

    	$query = "update users set cover_image = '$filename' where userId = '$userId' limit 1";
    	$DB = new Database();
    	$DB->save($query);

    	header(("Location: profilepage.php"));
    	die;
    }
}else
{
	echo "<div style='text-align:center; font-size:12px; color:white;background-color:grey;'>";
        echo "<br>The following errors occured<br><br>";
        echo "please add a valid image"; 
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
			    background-color: #F5F5DC;
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
               background-color: #405d9b;
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
                  	
                  	<br></div>
                  </div>

			    <!--post area-->
			<div style="min-height: 400px;flex: 6;padding: 20px; padding-right: 0px;">
				<div style="border: solid thin #aaa; padding: 10px;background-color: white;">

					 <form method="post" enctype="multipart/form-data">

					  
					  <input type="file" name="file">
                      <input id="post-btn" type="submit" value="Change">
                       <br>

                    </form>
					</div>

				    <!-- posts-->
				     <div id="post-bar">
                         
					      					
                        
					   
					
				    </div>

			</div>

		</div>
	</div>

</body>
</html>