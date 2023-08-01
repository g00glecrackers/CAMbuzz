<?php
  
  include("classes/links.php");

  $login = new Login();
  $user_data = $login->check_login($_SESSION['CAMbuzz_userId']);
   
   $Post = new Post();

   $ERROR = "";
   if(isset($_GET['Id']))
  {
    
    
    
    $ROW = $Post->get_one_post($_GET['Id']);

      if(!$ROW)
      {
      	$ERROR = "No such post found";
      }else{
      	
      	if($ROW['uuserId'] != $_SESSION['$CAMbuzz_userId']){
      		$ERROR = "No Access ";
      	}
      }

  }else
   {

   	//$ERROR = "No such post found";
   } 
   
   // if somthing posted
   if($_SERVER['REQUEST_METHOD'] == "POST")
   {
    
    $Post->delete_post($_POST['post_id']);
   	header("Location: profilepage.php");
   	die;
   }

?>

<html>
	<head>
		<title>delete | CAMbuzz</title>
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
			

			    <!--post area-->
			<div style="min-height: 400px;flex: 2.5;padding: 20px; padding-right: 0px;">
				<div style="border: solid thin #aaa; padding: 10px;background-color: white;">
          
					          <h2>Delete post</h2>
                    <form method="POST">

                        <br>
                       
                         <?php 

										              if($ERROR !== "")
										              {

										              	echo $ERROR;
										              
										         }else{
                                 
                                 $ROW[0] = "";
			                           echo "Are you sure you want to delete this post??";

			                           $user = new User();
			                           $ROW_USER = $user->get_user($ROW['userId']); 
			                           
			                           include("post_delete.php");
                          
                          
                       
                       echo "<input name='post_id' type='hidden' value='$ROW[0][post_id]'>";
                       echo "<input id='post-btn' type='submit' value='Delete'>";
                     }

                     ?>
                       <br>
                    </form>
					</div>

				    <!-- posts-->
				    

			</div>

		</div>
	</div>

</body>
</html>