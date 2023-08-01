<?php

class Post
{
    
    private $error = "";

	public function create_post($userId, $data, $files)
	{

		if(!empty($data['post']) || !empty($files['file']['name']) || isset($data['is_profile_image']) || isset($data['is_cover_image']))
		{

            $myimage = "";
            $hass_image = 0;
            $is_profile_image = 0;
            $is_cover_image = 0;
            
            if(isset($data['is_profile_image']) || isset($data['is_cover_image']))
            {
              
              $myimage = $files;
              $hass_image = 1;

              if(isset($data['is_cover_image']))
              {
              $is_cover_image = 1;
               }

              if(isset($data['is_profile_image']))
              {

                $is_profile_image = 1;
              }

            }else
            {
 
              if(!empty($files['file']['name']))
              {
                $folder = "uplouds/" . $userId . "/";
                 
                 //create folder
                if(!file_exists($folder))
                {

                  mkdir($folder,0777,true);
                  file_put_contents($folder . "index.php", "");
                } 

                $image_class = new Image();

                $myimage = $folder . $image_class->generate_filename(15) . ".jpg";
                move_uploaded_file($_FILES['file']['tmp_name'], $myimage);
   
                $hass_image = 1;
              }
            }
            
            $post = "";
            if(isset($data['post']))
            {
              $post = addslashes($data['post']);
            }

            $post_id = $this->create_post_id();
            $parent = 0;
            $DB = new Database();

            if(isset($data['parent']) && is_numeric($data['parent'])){

              $parent = $data['parent'];

              $sql = "update cambuzz_posts set comments = comments + 1 where post_id = '$parent' limit 1";
              $DB->save($sql);
            }
            $query = "insert into cambuzz_posts (userId,post_id,post,image,hass_image,is_profile_image,is_cover_image,parent) values ('$userId','$post_id','$post','$myimage','$hass_image','$is_profile_image','$is_cover_image','$parent')";

            
            $DB->save($query);
            
		}else
		{
            $this->error .= "Please type something to post!<br>";
		}
		return $this->error;
	}

	public function get_post($Id)
	{

    $page_number = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $page_number = ($page_number < 1) ? 1 : $page_number;

    $limit = 10;
    $offset = ($page_number - 1) * $limit;

		$query = "select * from cambuzz_posts where parent = 0 and  userId = '$Id' order by Id desc limit $limit offset $offset";

            $DB = new Database();
            $result = $DB->read($query);

            if($result)
            {
            	return $result;
            }else
            {
            	return false;
            }
	}

  public function get_comments($Id)
  {

    $page_number = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $page_number = ($page_number < 1) ? 1 : $page_number;
                      
    $limit = 10;
    $offset = ($page_number - 1) * $limit;

    $query = "select * from cambuzz_posts where parent = '$Id' order by Id asc limit $limit offset $offset";

            $DB = new Database();
            $result = $DB->read($query);

            if($result)
            {
              return $result;
            }else
            {
              return false;
            }
  }

  public function get_one_post($post_id)
  { 

    if(!is_numeric($post_id))
    {

      return false;
    }

    $query = "select * from cambuzz_posts where post_id = '$post_id' limit 1";

            $DB = new Database();
            $result = $DB->read($query);

            if($result)
            {
              return $result[0];
            }else
            {
              return false;
            }
  }

  public function delete_post($post_id)
  { 

    if(!is_numeric($post_id))
    {

      return false;
    }

    $query = "delete * from cambuzz_posts where post_id = '$post_id' limit 1";

            $DB = new Database();
            $DB->save($query);

            
  }

  public function i_own_post($post_id,$CAMbuzz_userId)
  { 

    if(!is_numeric($post_id))
    {

      return false;
    }

    $query = "select * from cambuzz_posts where post_id = '$post_id' limit 1";

            $DB = new Database();
            $result = $DB->read($query);

            if(is_array($result)){
               

               if($result[0]['userId'] == $CAMbuzz_userId){
                return true;
               }
            }
            return false;
            
  }
    
  public function Like_post($Id, $type, $CAMbuzz_userId){

    
      $DB = new Database();
      

      //save likes
      $sql = "select likes from likes where type = 'post' && contentid = '$Id' limit 1";
      $result = $DB->read($sql);
      if(is_array($result)){

        $likes = json_decode($result[0]['likes'],true);

        $user_ids = array_column($likes, "userId");

        if(!in_array($CAMbuzz_userId, $user_ids)){

            $arr["userId"] = $CAMbuzz_userId;
            $arr["date"] = date("Y-m-d H:i:s");

            $likes[] = $arr;

            $likes_string = json_encode($likes);
            $sql = "update likes set likes = '$likes_string' where type = 'post' && contentid = '$Id' limit 1";
            $DB->save($sql);

            //increament post table
            $sql = "update cambuzz_posts set likes = likes + 1 where post_id = '$Id' limit 1";
            $DB->save($sql);
          }else{

            $key = array_search($CAMbuzz_userId, $user_ids);
            unset($likes[$key]);

            $likes_string = json_encode($likes);
            $sql = "update likes set likes = '$likes_string' where type = 'post' && contentid = '$Id' limit 1";
            $DB->save($sql);

            //increament post table
            $sql = "update cambuzz_posts set likes = likes - 1 where post_id = '$Id' limit 1";
            $DB->save($sql);
          }
        
      }else{

        $arr["userId"] = $CAMbuzz_userId;
        $arr["date"] = date("Y-m-d H:i:s");

        $arr2[] = $arr;
        $likes = json_encode($arr2);
        $sql = "insert into likes (type,contentid,likes) values ('$type','$Id','$likes')";
        $DB->save($sql);

        //increament right table
        $sql = "update cambuzz_posts set likes = likes + 1 where post_id = '$Id' limit 1";
        $DB->save($sql);
      }
    
    
  }

 public function get_likes($Id,$type){

  $DB = new Database();
  $type = addslashes($type);

  if(is_numeric($Id)){

  // get likes details
  $sql = "select likes from likes where type='$type' && contentid = '$Id' limit 1";
  $result = $DB->read($sql);
  if(is_array($result)){

    $likes = json_decode($result[0]['likes'],true);
    return $likes;
  }
 }

 return false;
 }

 private function create_post_id()
  {
        $length = rand(4,19);
        $number = "";
        for($i=0; $i<$length; $i++)
        {
          $new_rand = rand(0,9);

           $number = $number . $new_rand;
        }
        return $number;
  }
}
?>