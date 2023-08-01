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

						echo "<a style='color: black; font-weight: bold; text-decoration: none;' href='profilepage.php?Id=$ROW[userId]'>";
				   			echo htmlspecialchars($ROW_USER['first_name']) . " " . htmlspecialchars($ROW_USER['Last_name']);
            echo "</a>";       
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

			    	echo "<img src='$post_image' style='width: 500px; height:400px;'/>";
			    }
			     
			     ?>

				<br><br>

				    <?php
				       $likes = "";

				       $likes = ($ROW['likes'] > 0) ? "" .$ROW['likes']. "" : "" ;
				       ?>
					<a style='color: black; font-weight: bold; text-decoration: none;' href="likes.php?type=post&Id=<?php echo $ROW['post_id'] ?>"> Like_<?php echo $likes ?> </a>. 

					<?php

						$comments = "";

						if($ROW['comments'] > 0){

							$comments = "" . $ROW['comments'] . "";
						}
					?>
					<a style='color: black; font-weight: bold; text-decoration: none;padding: 10px;' href="single_post.php?Id=<?php echo $ROW['post_id'] ?>">comment_<?php echo $comments ?></a>. 

					<span style="color: blue;margin: 15px;">
						
						<?php echo $ROW['date']; ?>

					</span>

					<?php

						if($ROW['hass_image'])
						{

							echo "<a style='color: #00BFFF; font-weight: bold; text-decoration: none;padding: 100px' href='image_view.php?Id=$ROW[post_id]' >";
							echo ". View Full Image .";
							echo "</a>";
						}
					?>
					<span style="color: #999; float: right;">
						
						<?php

						$post = new Post();

						if($post->i_own_post($ROW['post_id'],$_SESSION['CAMbuzz_userId'])) {

							}
							echo "
							<a href='edit.php'>
							  
							 </a> . 

							<a href='Delete.php?id=$ROW[post_id]'>
							    <br/>
						    </a>";
						

						
                         ?>
						
					</span>

	
			 </div>
					   	
		</div> 

		<!--<script type="text/javascript">
			
			function ajax_data(e){

				e.preventDefault();

				var link = e.target.href;
				var ajax = new XMLHttpRequest();

				ajax.addEventListner('readystatechange', function(){

					if(ajax.readyState == 4 && ajax.status == 200){

						response(ajax.responseText);
					}

				});

				var data = {};
				data.link = link;
				data = JSON.stringify(data);

				ajax.open("post",'ajax.php',true);
				ajax.send(data);
			}

			function response(result){

				alert(result);
			}

		</script> -->