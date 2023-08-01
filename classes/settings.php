<?php

Class Settings
{
	public function get_settings($Id)
	{
		$DB = new Database();
		$sql = "select * from users where userId = '$Id' limit 1";
		$row = $DB->read($sql);

		if(is_array($row)){

			return $row[0];
		}
	}

	public function save_settings($data,$Id)
	{
		$DB = new Database();
		$password = $data['password'];

		if(strlen($password) < 30){

			if($data['password'] == $data['password2']){

				//$data['password'] = hash("sha1", $password);
			}else{

				unset($data['password']);
			}
			
		}

		unset($data['password2']);

		$sql = "update users set ";
		foreach ($data as $key => $value) {
			// code...

			$sql .= $key . "='" . $value. "',";
		}

		$sql = trim($sql,",");
		$sql .= " where userId = '$Id' limit 1";

		$DB->save($sql);

	}
}