<?php

include("classes/links.php");

  $login = new Login();
  $user_data = $login->check_login($_SESSION['CAMbuzz_userId']);

  if(isset($_GET['find'])){

    $find = $_GET['find'];

    $sql = "select * from users where first_name like '%$find%' || Last_name like '%$find%' limit 30";
    $DB = new Database();
    $results = $DB->read($sql);
  }

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
    <div style="width: 1100px;margin: auto;min-height: 300px;">

      <!--below cover area-->
      <div style="display: flex;">

        <!--post area-->
        <div style="min-height: 400px;flex: 2.5;padding: 20px;padding-right: 0px;">
          
          <div style="border: solid thin #aaa; padding: 10px;background-color: white;">
            
            <?php

              $user = new User();
              $image_class = new Image();

              if(is_array($results)){

                foreach ($results as $row) {
                  // code...
                  $FRIEND_ROW = $user->get_user($row['userId']);
                  include("user.php");
                }
              }else{

                  echo "No results were found";
                }
            ?>

            <br style="clear: both;">
          </div>
        </div>
       </div>
      </div>  