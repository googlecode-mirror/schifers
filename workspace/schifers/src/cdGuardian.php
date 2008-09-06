<?php

	/*
	* cdGuardian.php
	*
	* Acess guardian.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: August 13, 2007
	*/

	/* Dependencies
	*
	* require src/cdProfile.php
	* require src/cdUser.php
	* require src/cdSession.php
	*
	*/

	class Guardian
	{
		var $userid;
		var $prof_id;
		var $username;
		var $password;
		var $password_md5;
		var $module_name;
		var $logged_in;
		var $database;
		
		function CheckPermission()
		{
			$user = new User();
			
			$user->SetDatabase($this->database);
			
			$user->SetUsername($this->username);

			if($this->password != "")
			{
				$user->SetPassword($this->password);
				$user->Encrypt();
			}

			if($this->password_md5 != "")
			{
				$user->SetEncryptedPassword($this->password_md5);
			}
			
			if($user->CheckPassword())
			{
				$this->prof_id = $user->SelectProfile();
			
				$user->SelectByName();
			
				$select = "select modu_id from modules a, brun14.privileges b, users c, roles d ".
						  "where a.modu_id = b.priv_modu_id ".
						  "and c.user_id = ".$user->GetId()." ".
						  "and d.role_user_id = c.user_id ".
						  "and d.role_prof_id = b.priv_prof_id ".
						  "and b.priv_modu_id = a.modu_id ".
						  "and a.modu_nick = \"".$this->module_name."\" ".
						  "and c.user_active = 1";
				
				$result = $this->database->Execute($select);

				if($result && mysql_num_rows($result) > 0)
				{
					return true;
				}
			}
			
			return false;
		}
		
		function TerminateExpiredSessions()
		{
			$select = "select sess_id, sess_active, sess_date_start, sess_date_last, sess_ip, sess_user_id ".
					  "from sessions ".
					  "where sess_active = 1";

			$result = $this->database->Execute($select);
			
			while($data = $this->database->FetchArray($result))
			{
				$time = $data["sess_date_last"];
				
				$day = substr($time, 0, 2);
				$month = substr($time, 3, 2);
				$year = substr($time, 6, 4);
				$hour = substr($time, 11, 2);
				$minute = substr($time, 14, 2);
				$second = substr($time, 17, 2);

				$time1 = mktime($hour, $minute, $second, $month, $day, $year);
				$time2 = time();
				
				$diff = ($time2 - $time1)/60;

				if($diff > 5)
				{
					$session = new Session();
					
					$session->SetDatabase($this->database);
					$session->SetId($data["sess_id"]);
					
					$session->SelectById();
					$session->SetActive(0);
					$session->SetDateLast(date('Y-m-d H:i:s', $time2));
					
					$session->Update();
				}
			}
		}

		function IsUserAdmin()
		{
			$select = "select count(*) numero ".
					  "from roles ".
					  "where role_user_id = ".$this->GetUserId()." ".
					  "and role_prof_id = 1";

			$result = $this->database->Execute($select);
			
			$data = mysql_fetch_array($result);
			
			if($data["numero"] == 0)
			{
				return false;
			}
			
			return true;
		}
		
		function GetUserId()
		{
			$user = new User();
			
			$user->SetDatabase($this->database);
			
			$user->SetUsername($this->username);
			$user->SetPassword($this->password);
			$user->Encrypt();
			
			if($user->SelectByName())
			{
				return $user->GetId();
			}
			else
			{
				return 0;
			}
		}
		
		function SetId($id)
		{
			$this->userid = $id;
		}
		
		function GetProfileId()
		{
			return $this->prof_id;
		}

		function SetProfileId($id)
		{
			$this->prof_id = $id;
		}

		function SetUsername($username)
		{
			$this->username = $username;
		}
		
		function SetPassword($password)
		{
			$this->password = $password;
		}

		function SetEncryptedPassword($password)
		{
			$this->password_md5 = $password;
		}

		function SetModuleName($module_name)
		{
			$this->module_name = $module_name;
		}

		function SetLoggedIn($logged)
		{
			$this->logged_in = $logged;
		}

		function SetDatabase($database)
		{
			$this->database = $database;
		}

		function GetId()
		{
			return $this->userid;
		}

		function GetUsername()
		{
			return $this->username;
		}

		function GetPassword()
		{
			return $this->password;
		}

		function GetEncryptedPassword()
		{
			return $this->password_md5;
		}

		function GetModuleName()
		{
			return $this->module_name;
		}

		function GetLoggedIn()
		{
			return $this->logged_in;
		}

		function GetDatabase()
		{
			return $this->database;
		}
	};

	$id = $_COOKIE["cookie_userid"];
	$username = $_COOKIE["cookie_username"];
	$password = $_COOKIE["cookie_password"];
	
	$guardian = new Guardian();
	$guardian->SetDatabase($database);
	$guardian->TerminateExpiredSessions();
	
	if(isset($_POST["p_username"]) && isset($_POST["p_password"]))
	{
		$guardian->SetUsername($_POST["p_username"]);
		$guardian->SetPassword($_POST["p_password"]);
	}
	else if(isset($_COOKIE["cookie_username"]) && isset($_COOKIE["cookie_password"]) && isset($_COOKIE["cookie_userid"]))
	{
		$guardian->SetId($_COOKIE["cookie_userid"]);
		$guardian->SetUsername($_COOKIE["cookie_username"]);
		$guardian->SetEncryptedPassword($_COOKIE["cookie_password"]);
	}
	else
	{
		$guardian->SetUsername("guest");
		$guardian->SetPassword("guest");
	}
	
	$guardian->SetModuleName($module_name);
	
	if($module_name != "error")
	{
		if(!$guardian->CheckPermission())
		{
			echo "<script language='Javascript'>window.location = \"/".$WEB_SITE."pages/pgError.php\";</script>";
		}
		else
		{

			$session = new Session();
				
			$session->SetDatabase($database);
			
			if($guardian->GetId() != "")
			{
				$session_id = $session->Login($guardian->GetId(), $guardian->GetUsername(), $guardian->GetEncryptedPassword());
			}
			else
			{
				$session_id = $session->Login($guardian->GetId(), $guardian->GetUsername(), $guardian->GetPassword());
			}
			
			$guardian->SetId($session_id);
			$guardian->SetLoggedIn($session->logged_in);

		}
	}

/*	
	echo $_SERVER['QUERY_STRING']."<br>";
	echo $_SERVER['SCRIPT_NAME']."<br>";
	echo $_SERVER['HTTP_HOST']."<br>";
	echo $_SERVER['REQUEST_URI']."<br>";
*/

?>