<?php

session_start();

if(isset($_SESSION['CAMbuzz_userId']))
{ 
	$_SESSION['CAMbuzz_userId'] = NULL;
	unset($_SESSION['CAMbuzz_userId']);

}
unset($_SESSION['CAMbuzz_userId']);

//header("Location: login.php");
die;