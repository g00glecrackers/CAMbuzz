<?php

include("classes/links.php");

  $login = new Login();
  $user_data = $login->check_login($_SESSION['CAMbuzz_userId']);


if(isset($_SERVER['HTTP_REFERER'])){

  $return_to = $_SERVER['HTTP_REFERER'];
}else{
      $return_to = "profilepage.php";
}
  
  if(isset($_GET['type']) && isset($_GET['Id'])){

  	  if(is_numeric($_GET['Id'])){
        
        $allowed[''] = 'post';
        $allowed[''] = 'user';
        $allowed[''] = 'comment';

  	  	if(in_array($_GET['type'], $allowed)){

  	  		$post = new Post();
            $post->Like_post($_GET['Id'],$_GET['type'],$_SESSION['CAMbuzz_userId']);
  	  	}

  	  }

}

header("Location: ".$return_to);
die;