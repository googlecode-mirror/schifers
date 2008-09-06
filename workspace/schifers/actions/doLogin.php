<?php

	/*
	* doLogin.php
	*
	* The login action.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: August 01, 2007
	*/

	require '../../schifers/constants/cdConstants.php';
	require '../../'.$WEB_SITE.'src/cdDatabase.php';
	require '../../'.$WEB_SITE.'src/cdUser.php';
	require '../../'.$WEB_SITE.'src/cdSession.php';

	$username = $_POST["p_username"];
	$password = $_POST["p_password"];
	$id = $_POST["p_session_id"];

	$user = new User();
	
	$user->SetDatabase($database);
	$user->SetUsername($username);
	$user->SetPassword($password);
	$user->Encrypt();

	$session = new Session();
	
	$session->SetDatabase($database);
	$session->SetUser($user);

	$session->Login($id, $username, $user->GetEncryptedPassword());
	
	if($session->IsLoggedIn())
	{
		echo "<script language='Javascript'> window.location = \"/".$WEB_SITE."pages/pgRestricted.php\" </script>";
	}
	else
	{
		echo "<script language='Javascript'> window.location = \"/index.php?error_message=Login Inválido!\" </script>";
	}

?>