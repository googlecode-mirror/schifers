<?php

	/*
	* doCloseSession.php
	*
	* The close session action.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: September 18, 2007
	*/

	require '../constants/cdConstants.php';
	require '../src/cdDatabase.php';
	require '../src/cdUser.php';
	require '../src/cdSession.php';

	if(isset($_POST["p_close_session"]))
	{
		$action = $_POST["p_close_session"];
		$id = $_COOKIE["cookie_userid"];
	
		if($action == 1)
		{
			$user = new User();
			
			$user->SetDatabase($database);
			$user->SetUsername("guest");
			$user->SetPassword("guest");
			$user->Encrypt();

			$session = new Session();
			
			$session->SetDatabase($database);

			$session->TerminateSession($id);

			echo "<script language='Javascript'>window.location = \"../pages/pgExit.php\";</script>";
		}
	}
	
?>