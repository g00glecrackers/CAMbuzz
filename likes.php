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

  if(isset($_SERVER['HTTP_REFERER'])){

    $return_to = $_SERVER['HTTP_REFERER'];
  }else{

    $return_to = "profilepage.php";
  }

    if(isset($_GET['type']) && isset($_GET['Id'])){

      if(is_numeric($_GET['Id'])){

        $allowed[] = 'post';
        $allowed[] = 'users';
        $allowed[] = 'comment';

        if(in_array($_GET['type'], $allowed)){

          $post = new Post();
          $post->like_post($_GET['Id'],$_GET['type'],$_SESSION['CAMbuzz_userId']);
        }
      }
    }

    header("Location: ". $return_to);
    die;
?>