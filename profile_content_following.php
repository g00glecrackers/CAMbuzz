<div style="min-height: 400px;width: 100%; background-color: white;text-align: center;">
    <div style="padding: 30px;">
<?php


	$image_class = new Image();
	$posts_class = new Post();
	$user_class = new User();
    $following = $user_class->get_following($user_data['userId'],"user");

	if(is_array($following)){

		foreach ($following as $follower) {
			// code...
		$FRIEND_ROW = $user_class->get_user($follower['userId']);
		include("user.php");
	}
	}else{

		echo "0 Followers";
	}


?>
    </div>
</div>