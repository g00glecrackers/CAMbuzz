<?php



class Login
{

     public $error = "";

	
		public function evaluate($data)
	    {
      
      
      $Email = addslashes($data['Email']);
      $password =  addslashes($data['password']);


	  $query = "select * from users where Email = '$Email' limit 1";
      
      
      $DB = new Database();
      $result = $DB->read($query);

      if($result)
      {
          
          $row = $result[0];

          if($password == $row['password'])
          {

             // create a session data
             $_SESSION['CAMbuzz_userId'] = $row['userId'];

          }else
          {
          	$this->error .= "No such Email or password was found<br>";
          }

      }else
      {
      	$this->error .= "No such Email or password was found<br>";
      }

      	return $this->error;
      
	}

    public function hash_text($text)
    {
       
       $text = hash("sha1", $text);
       return $text;
    }

	public function check_login($Id,$redirect = true)
	{
        
        if(is_numeric($Id))
        {

              $query = "select * from users where userId = '$Id' limit 1 ";

              $DB = new Database();
              $result = $DB->read($query);

            if($result)
            {

               $user_data = $result[0];
               return $user_data;
            }else
            {
               if($redirect){

                  header("Location: login.php");
                  die;
               }else{

                  $_SESSION['CAMbuzz_userId'] = 0;
               }

           }


         }else
         {
               if($redirect){

                  header("Location: login.php");
                  die;
               }else{

                  $_SESSION['CAMbuzz_userId'] = 0;
               }
           }
           
      	}
	
}