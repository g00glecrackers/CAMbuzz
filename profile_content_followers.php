<div style="min-height: 400px;width: 100%; background-color: white;text-align: center;">
    <div style="padding: 30px;">
<?php


	$image_class = new Image();
	$posts_class = new Post();
	$user_class = new User();
    $followers = $posts_class->get_likes($user_data['userId'],"user");

	if(is_array($followers)){

		foreach ($followers as $follower) {
			// code...
		$FRIEND_ROW = $user_class->get_user($follower['userId']);
		include("user.php");
	}
	}else{

		echo "No followers were found!";
	}


?>
    </div>
</div>