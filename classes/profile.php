<?php

class Profile
{

	function get_profiles($Id)
	{
        //$Id = addcslashes($Id);
		$DB = new Database();
		$query = "select * from users where userId = '$Id' limit 1";
		return $DB->read($query);
	}
}