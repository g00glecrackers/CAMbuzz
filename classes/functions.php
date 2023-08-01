<?php

function pagination_link($type){

	
 }

 function i_own_content($row){

    $Myid = $_SESSION['CAMbuzz_userId'];

    //profiles
    if(isset($row['Gender']) && $Myid == $row['userId']){

        return true;
    }

    // comments and posts
    if(isset($row['post_id'])){

      if($Myid == $row['userId'])  {

        return true;
      }else{
        $post = new Post();
        $one_post = $Post->get_one_post($_GET['parent']);

        if($Myid == $one_post['userId'])  {

        return true;
      }
        
    }

    return false;    
  }
 } 
 ?>