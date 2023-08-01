
<div id="post">
	<div>

		<?php
         $error_reporting();
         
         $image = "images/user_male.jpg";
         if($ROW_USER[$ROW]['Gender'] == "Female")
         {

         	$image = "images/user_female.jpg";
         }

         $image_class = new Image();

         if(file_exists($ROW_USER['profile_image']))
         {

         	$image = $image_class->get_thumb_profile($ROW_USER['profile_image']);
         }

		?>
		<img src="<?php echo $image ?>" style="width: 75px;margin-right: 4px; border-radius: 50;">
	</div>
		<div style="width: 100%;">
			<div style="font-weight: bold;color: #405d9b;">

				<?php 

				   echo htmlspecialchars($ROW_USER['first_name']) . " " . htmlspecialchars($ROW_USER['Last_name']);
                   
                   if($ROW['is_profile_image'])
                   {
                     $pronoun = "his";
                     if($ROW_USER['Gender'] == "Female")
                     {

                     	$pronoun = "her";
                     }
                   	 echo "<span style='font-weight:normal; color:grey;'> <br> <br> updated $pronoun profile image</span>";
                   }
                    
                    ?>
			</div>

			    <?php echo htmlspecialchars($ROW['post']) ?>

			    <br><br>
			    <?php

			    if(file_exists($ROW['image']))
			    {

			    	$post_image = $image_class->get_thumb_post($ROW['image']);

			    	echo "<img src='$post_image' style='width: 400px; height:400px;'/>";
			    }
			     
			     ?>

				
			 </div>
					   	
		</div> 