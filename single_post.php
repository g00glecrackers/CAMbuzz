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

  // POSTING STARTS FROM HERE
  if($_SERVER['REQUEST_METHOD'] == "POST")
  {
    
    

      $post = new Post();
      $Id = $_SESSION['CAMbuzz_userId'];
      $result = $post->create_post($Id,$_POST,$_FILES);

    if($result == "")
    {

      header("Location: single_post.php?Id=$_GET[Id]");
      die;
    }else
    {
       echo "<div style='text-align:center; font-size:12px; color:white;background-color:grey;'>";
        echo "<br>The following errors occured<br><br>";
        echo $result; 
        echo "</div>";
    }
    
  
    }

  $post = new Post();
  $ROW = false;

  $ERROR = "";
  if(isset($_GET['Id'])){

    $ROW = $post->get_one_post($_GET['Id']);

  }else{

    $ERROR = "No information found";
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
        background-color: #00BFFF;
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


                  $ROW_USER = $user->get_user($ROW['userId']);
                 include("post.php");
                }
            ?>
            
            <br style="clear: both;">

            <div style="border: solid thin #aaa; padding: 10px;background-color: white;">
      
                    <form method="post" enctype="multipart/form-data">

            <textarea name="post" placeholder="Post A Comment"></textarea>
            <input type="hidden" name="parent" value="<?php echo $ROW['post_id'] ?>">
            <input type="file" name="file">
                      <input style="background-color: #00BFFF;" id="post-btn" type="submit" value="post">
                       <br>

                    </form>
          </div>

              <?php
                $comments = $post->get_comments($ROW['post_id']);

                if(is_array($comments)){

                  foreach ($comments as $COMMENT) {
                    // code...
                    $ROW_USER = $user->get_user($COMMENT['userId']);
                    include("comment.php");
                  }
                }

              ?>
          </div>
        </div>
      </div>
    </div>
  </body>
  </html>  