<?php
	session_start();
	unset($_SESSION['CURRENTUSER']);
	if(session_destroy())
	{
		header('Location:login.php');
	}
	
?>