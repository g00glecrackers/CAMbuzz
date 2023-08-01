<?php

class Database
{
  
  private $host = "localhost";
  private $username = "root";
  private $password = "";
  private $db ="cambuzz_db";


  function connect()
  {
      $connection = mysqli_connect($this->host,$this->username,$this->password,$this->db) or die(problem);
      return $connection;

      print_r($connection);
  }
    
  public function read($query)
  {
      $conn = $this->connect();
       $result = mysqli_query($conn,$query);

      if(!$result)
      {
      	return false;
      }
      else
      {

      	$data = false;
      	while($ROW = mysqli_fetch_assoc($result))
        {
          $data[] = $ROW;
        }

        return $data;
      }
  }

  public function save($query)
  {
      $conn = $this->connect();
      $result = mysqli_query($conn,$query);

      if(!$result)
      {
      	return false;
      }else
      {
      	return true;
      }
 } 

}

 