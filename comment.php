<div id="post">
	<div>

		<?php
         
         $image = "images/user_male.jpg";
         if($ROW_USER['Gender'] == "Female")
         {

         	$image = "images/user_female.jpg";
         }

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

						echo "<a style='color: black; font-weight: bold; text-decoration: none;' href='profilepage.php?Id=$COMMENT[userId]'>";
				   			echo htmlspecialchars($ROW_USER['first_name']) . " " . htmlspecialchars($ROW_USER['Last_name']);
            echo "</a>";       
                   if($COMMENT['is_profile_image'])
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

			    <?php echo htmlspecialchars($COMMENT['post']) ?>

			    <br><br>
			    <?php

			    if(file_exists($COMMENT['image']))
			    {

			    	$post_image = $image_class->get_thumb_post($COMMENT['image']);

			    	echo "<img src='$post_image' style='width: 500px; height:400px;'/>";
			    }
			     
			     ?>

				<br><br>

				    <?php
				       $likes = "";

				       $likes = ($COMMENT['likes'] > 0) ? "(" .$COMMENT['likes']. ")" : "" ;
				       ?>
					<a style='color: black; font-weight: bold; text-decoration: none;' href="likes.php?type=post&Id=<?php echo $COMMENT['post_id'] ?>"> Like_<?php echo $likes ?> </a>. 

					<a href="single_post.php?Id=<?php echo $COMMENT['post_id'] ?>"></a>. 

					<span style="color: #999;">
						
						<?php echo $COMMENT['date']; ?>

					</span>

					<?php

						if($COMMENT['hass_image'])
						{

							echo "<a style='color: black; font-weight: bold; text-decoration: none;' href='image_view.php?Id=$COMMENT[post_id]' >";
							echo ". View Full Image .";
							echo "</a>";
						}
					?>
					<span style="color: #999; float: right;">
						
						<?php

						$post = new Post();

						if($post->i_own_post($COMMENT['post_id'],$_SESSION['CAMbuzz_userId'])) {

							}
							echo "
							<a href='edit.php'>
							  
							 </a> . 

							<a href='Delete.php?id=$COMMENT[post_id]'>
							    <br/>
						    </a>";
						

						
                         ?>
						
					</span>

	
			 </div>
					   	
		</div> 