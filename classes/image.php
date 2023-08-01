<?php

 class Image
{ 
  
  public function generate_filename($length)
  {
    
    $array = array(0,1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
    $text = "";
    
    for($x=0;$x<$length;$x++)
    {

      $random = rand(0,61);
      $text .= $array[$random];

    }

    return $text;
  }

    public function crop_image()
  {}
    
   
	/*public function cropped_image($original_file_name,$cropped_file_name,$max_width,$max_height)
	{
      
      if(file_exists($original_file_name))
      {
        

        $original_image = imagecreatefromjpeg($original_file_name);

        $original_width = imagesx($original_image);
        $original_height = imagesy($original_image);

        if($original_height > $original_width)
        {
            
        	//make width equal to max width
        	$ratio = $max_width / $original_width;

        	$new_width = $max_width;
        	$new_height = $original_height * $ratio;
        }else
        {
          $ratio = $max_height / $original_height;

        	$new_height = $max_height;
        	$new_width = $original_width * $ratio;
        }
      }

       $new_image = imagecreatetruecolor($new_width, $new_height);
      imagecopyresampled($new_image, $original_image, 0, 0, 0, 0, $new_width, $new_height, $original_width, $original_height);

      imagejpeg($new_image,$cropped_file_name,90);
	}*/

  // create thunbnail for cover imags
  public function get_thumb_cover($filename)
  {

    $thumbnail = $filename . "_cover_thunb.jpg";

    if(file_exists($thumbnail))
    {

      return $thumbnail;
    }

    $this->crop_image($filename,$thumbnail,1366,488);

    if(file_exists($thumbnail))
    {

      return $thumbnail;
    }else
    {

      return $filename;
    }
  }

  // create thunbnail for profile imags
  public function get_thumb_profile($filename)
  {

    $thumbnail = $filename . "_profile_thunb.jpg";

    if(file_exists($thumbnail))
    {

      return $thumbnail;
    }

    $this->crop_image($filename,$thumbnail,600,600);

    if(file_exists($thumbnail))
    {

      return $thumbnail;
    }else
    {

      return $filename;
    }
  }

  // create thunbnail for post imags
  public function get_thumb_post($filename)
  {

    $thumbnail = $filename . "_post_thunb.jpg";

    if(file_exists($thumbnail))
    {

      return $thumbnail;
    }

    $this->crop_image($filename,$thumbnail,600,600);

    if(file_exists($thumbnail))
    {

      return $thumbnail;
    }else
    {

      return $filename;
    }
  }
} 


?>