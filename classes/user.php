<?php

class User
{

	public function get_data($Id)
	{
        
        $query = "select * from users where userId = '$Id' limit 1";

		$DB = new Database();
		$result = $DB->read($query);

		if($result)
		{
            
            $row = $result[0];
            return $ROW;
		}else
		{
			return false;
		}
	}

	public function get_user($Id)
	{
        
        $query = "select * from users where userId = '$Id' limit 1";
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

	public function get_friends($Id)
	{
        
        $query = "select * from users where userId != '$Id'";
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

	public function follow_user($Id, $type, $CAMbuzz_userId){

    
      $DB = new Database();
      

      //save following
      $sql = "select following from likes where type = '$type' && contentid = '$CAMbuzz_userId' limit 1";
      $result = $DB->read($sql);
      if(is_array($result)){

        $likes = json_decode($result[0]['following'],true);

        $user_ids = array_column($likes, "userId");

        if(!in_array($CAMbuzz_userId, $user_ids)){

            $arr["userId"] = $Id;
            $arr["date"] = date("Y-m-d H:i:s");

            $likes[] = $arr;

            $likes_string = json_encode($likes);
            $sql = "update likes set following = '$likes_string' where type = '$type' && contentid = '$CAMbuzz_userId' limit 1";
            $DB->save($sql);

            
          }else{

            $key = array_search($Id, $user_ids);
            unset($likes[$key]);

            $likes_string = json_encode($likes);
            $sql = "update likes set following = '$likes_string' where type = '$type' && contentid = '$CAMbuzz_userId' limit 1";
            $DB->save($sql);

          }
        
      }else{

        $arr["userId"] = $Id;
        $arr["date"] = date("Y-m-d H:i:s");

        $arr2[] = $arr;
        $following = json_encode($arr2);
        $sql = "insert into likes (type,contentid,following) values ('$type','$CAMbuzz_userId','$following')";
        $DB->save($sql);

        
      }
    
    
  }

 public function get_following($Id,$type){

		  $DB = new Database();
		  $type = addslashes($type);

		  if(is_numeric($Id)){

		  // get following details
		  $sql = "select following from likes where type='$type' && contentid = '$Id' limit 1";
		  $result = $DB->read($sql);
		  if(is_array($result)){

		    $following = json_decode($result[0]['following'],true);
		    return $following;
          }
       }

     return false;
   }
}