<?php

class Signup
{
    
    public $error = "";

	public function evaluate($data)
	{
       foreach ($data as $key => $value) 
       {
       	

       	 if(empty($value))
       	 {
       		  $this->error = $this->error . $key . " is empty!<br>";
       	 }

         if($key == "Email")
         {

            if(!preg_match("/([\w\-]+\.[\w\-]+)/",$value)){

              $this->error = $this->error . $key . " Invalid Email address!<br>";
            }
            
         }

         if($key == "first_name")
         {

            if(is_numeric($value) ){

              $this->error = $this->error . " first name can't be a number<br>";
            }

            if(strstr($value, " ")){

              $this->error = $this->error . " first name can't have spaces<br>";
            }
         }

         if($key == "Last_name")
         {

            if(is_numeric($value)){

              $this->error = $this->error . " last name can't be a number<br>";
            }
            if(strstr($value, " ")){

              $this->error = $this->error . " last name can't have spaces<br>";
            }
            
         }
       }

        if($this->error == "")
        {

         //no error
       	 $this->create_user($data);
        }
        else
        {
       	 return $this->error;
        }
	}

	public function create_user($data)
	{
      
      $first_name = ucfirst($data['first_name']);
      $Last_name = ucfirst($data['Last_name']);
      $Gender = $data['Gender'];
      $Email = $data['Email'];
      $password = $data['password'];
      
      //create these
      $url_address = strtolower ($first_name) . "." . strtolower($Last_name);
      $userId = $this->create_userId();

	  $query = "insert into users (userId,first_name,Last_name,Gender,Email,password,url_address) 
	                       values ('$userId','$first_name','$Last_name','$Gender','$Email','$password','$url_address')";
      
      
      $DB = new Database();
      $DB->save($query);
	}


	private function create_userId()
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