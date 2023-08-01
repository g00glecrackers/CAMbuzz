<div style="min-height: 400px;width: 100%; background-color: white;text-align: center;">
    <div style="padding: 30px;max-width: 350px;display: inline-block;">

    	 <form method="post" enctype="multipart/form-data">

                  
		<?php

		  $settings_class = new Settings();

		  $settings = $settings_class->get_settings($_SESSION['CAMbuzz_userId']);

		  if(is_array($settings)){

		  	
		  	echo "<input type = 'text' Id='textbox' name='first_name' value='" .htmlspecialchars($settings['first_name'])."' placeholder='First name' />";
		  echo "<input type = 'text' Id='textbox' name='Last_name' value='" .htmlspecialchars($settings['Last_name'])."' placeholder='Last name' />";

		  echo "<select Id='textbox' name='Email' style='height:30px;' > 

		  		<option>" .htmlspecialchars($settings['Gender'])."</option>
		  		<option>Male</option>
		  		<option>Female</option>

		  		</select>";

		  echo "<input type = 'text' Id='textbox' name='Email' value='" .htmlspecialchars($settings['Email'])."' placeholder='Email' />";
		  echo "<input type = 'password' Id='textbox' name='password' value='" .htmlspecialchars($settings['password'])."' placeholder='password' />";
		  echo "<input type = 'password' Id='textbox' name='password2' value='" .htmlspecialchars($settings['password'])."' placeholder='password' />";

		  echo "<br>about me:<br>
		  			<textarea id='textbox' style='height:200px;border-radius:5px;' name='about'>" .htmlspecialchars($settings['about'])."</textarea>
		  ";
		  echo '<input id="post-btn" type="submit" value="Save">';
		  }
		  
		?>

	</form>
    </div>
</div>