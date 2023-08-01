<div style="min-height: 400px;width: 100%; background-color: white;text-align: center;">
    <div style="padding: 30px;">
<?php

	$DB = new Database();
	$sql = "select image,post_id from cambuzz_posts where hass_image = 1 && userId = $user_data[userId] order by Id desc limit 30";
	$images = $DB->read($sql);

	$image_class = new Image();

	if(is_array($images)){

		foreach ($images as $image_row) {
			// code...
			echo "<a href='single_post.php?Id=$image_row[post_id]'>";
		echo "<img src='" . $image_class->get_thumb_post($image_row['image']) . "' style='width:150px;margin:10px'/>";
			echo "</a>";
	}
	}else{

		echo "No images were found!";
	}


?>
    </div>
</div>