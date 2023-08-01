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

  $post = new Post();
  $ROW = false;

  $ERROR = "";
  if(isset($_GET['Id'])){

    $ROW = $post->get_one_post($_GET['Id']);

  }else{

    $ERROR = "No Image was found";
  }


?>
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
<html>
  <title>single post | CAMbuzz</title>
   <head>
   <style type="text/css">
      #head-bar{
        height:50px;
      background-color: #98fb98;
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
        background-color:#98fb98;
        border-radius: 4px;
        margin: 15px;

      }
      #menu-btn:hover
      {
        background-color: whitesmoke;
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
               background-color:  #98fb98;
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
      
    </style>
   </head> 
   
    <body style="font-family: tahoma;background-color: #d0d8e4;">
    

    <?php
    include("header.php");
    ?>
    
    <!--cover area-->

    <div style="width: 1100px;margin: auto;background-color: ;min-height: 300px;">
      
      <!--below cover area-->
      <div style="display: flex;">
        
        <!--post area-->
        <div style="min-height: 400px;flex: 2.5;padding: 20px;padding-right: 0;">
          
          <div style="border: solid thin #aaa; pad: 10px;background-color: white;">

            <?php

                $user = new User();
                $image_class = new Image();

                if(is_array($ROW)){

                  echo "<img src='$ROW[image]' style='width:100%' />";
                }
            ?>
            
            <br style="clear: both;">
          </div>
        </div>
      </div>
    </div>
  </body>
  </html>  