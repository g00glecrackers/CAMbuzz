<div style="display: flex;">

				<!--friends area-->
			<div style="min-height: 400px;flex: 1;">
                  <div id="friends-bar">
                  	Friends
                
<?php


    if($friends)
    {
        foreach ($friends as $FRIEND_ROW) {
         // code...
                                    
            include("user.php");
            }
    }
                             
                             	
                             
                             
?>
                  	<br></div>
                  </div>

			    <!--post area-->
			<div style="min-height: 400px;flex: 2.5;padding: 20px; padding-right: 0px;">
				<div style="border: solid thin #aaa; padding: 10px;background-color: white;">
      
                    <form method="post" enctype="multipart/form-data">

					  <textarea name="post" placeholder="whats on your mind"></textarea>
					  <input type="file" name="file">
                      <input id="post-btn" type="submit" value="post">
                       <br>

                    </form>
					</div>

				    <!-- posts-->
				    <div id="post-bar">
                         
                         
                         <?php


                             if($cambuzz_posts)
                             {
                             	foreach ($cambuzz_posts as $ROW) {
                             		// code...
                                    
                                    $user = new User();
                             		$ROW_USER = $user->get_user($ROW['userId']);

                             		include("post.php");
                             	}
                             }
                             
                             	
                             
                             
                ?>
					   
					
				    </div>

			</div>

		</div>