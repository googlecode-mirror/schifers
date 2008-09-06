<?php

	/*
	* cdDatabase.php
	*
	* Databases.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: August 02, 2007
	*/

	class Database
	{
		var $username;
		var $password;
		var $name;
		var $server;
		var $connection;

		function Connect()
		{
			$this->connection = mysql_connect($this->server, $this->username, $this->password);
		}
		
		function SelectDB()
		{
			mysql_select_db($this->name, $this->connection);
		}
		
		function IsConnected()
		{
			if ($this->connection)
			{
				return true;
			}
			return false;
		}
		
		function GetNumMembers()
		{
			$select = "select count(*) num_users ".
					  "from users ".
					  "where user_username != \""."guest"."\"";

			$result = $this->Execute($select);

			$data = mysql_fetch_array($result);
			
			$num_users = $data["num_users"];
			
			if($result && mysql_num_rows($result) > 0)
				return $num_users;
			return 0;
		}

		function GetNumActiveGuests()
		{
			$select = "select count(*) num_users ".
					  "from users a, sessions b ".
					  "where a.user_id = b.sess_user_id ".
					  "and a.user_username = \""."guest"."\" ".
					  "and b.sess_active = 1";

			$result = $this->Execute($select);

			$data = mysql_fetch_array($result);
			
			$num_users = $data["num_users"];
			
			if($result && mysql_num_rows($result) > 0)
				return $num_users;
			return 0;
		}

		function GetNumActiveMembers()
		{
			$select = "select count(*) num_users ".
					  "from users a, sessions b ".
					  "where a.user_id = b.sess_user_id ".
					  "and a.user_username != \""."guest"."\" ".
					  "and b.sess_active = 1";

			$result = $this->Execute($select);

			$data = mysql_fetch_array($result);
			
			$num_users = $data["num_users"];
			
			if($result && mysql_num_rows($result) > 0)
				return $num_users;
			return 0;
		}

		function Execute($query)
		{
			return mysql_query($query, $this->connection);
		}
		
		function FetchArray($result)
		{
			return mysql_fetch_array($result);
		}
		
		function DropTables()
		{
			$moderator = new Moderator();
			
			$moderator->SetDatabase($this);
			
			$moderator->Drop();

			$message = new Message();
			
			$message->SetDatabase($this);
			
			$message->Drop();

			$topic = new Topic();
			
			$topic->SetDatabase($this);
			
			$topic->Drop();

			$user_info = new UserInfo();
			
			$user_info->SetDatabase($this);
			
			$user_info->Drop();

			$session = new Session();
			
			$session->SetDatabase($this);
			
			$session->Drop();
		
			$new = new News();
			
			$new->SetDatabase($this);
			
			$new->Drop();
		
			$shout = new Shout();
			
			$shout->SetDatabase($this);
			
			$shout->Drop();
		
			$paragraph = new Paragraph();
			
			$paragraph->SetDatabase($this);
			
			$paragraph->Drop();
		
			$privilege = new Privilege();
			
			$privilege->SetDatabase($this);
			
			$privilege->Drop();
		
			$role = new Role();
			
			$role->SetDatabase($this);
			
			$role->Drop();
		
			$menu_item = new MenuItem();
			
			$menu_item->SetDatabase($this);
			
			$menu_item->Drop();
		
			$module = new Module();
			
			$module->SetDatabase($this);
			
			$module->Drop();
		
			$page = new Page();
			
			$page->SetDatabase($this);
			
			$page->Drop();

			$article = new Article();
			
			$article->SetDatabase($this);
			
			$article->Drop();
		
			$subject = new Subject();
			
			$subject->SetDatabase($this);
			
			$subject->Drop();

			$menu = new Menu();
			
			$menu->SetDatabase($this);
			
			$menu->Drop();
		
			$profile = new Profile();
			
			$profile->SetDatabase($this);
			
			$profile->Drop();

			$user = new User();
			
			$user->SetDatabase($this);
			
			$user->Drop();
		}

		function SetUsername($username)
		{
			$this->username = $username;
		}
		
		function SetPassword($password)
		{
			$this->password = $password;
		}
		
		function SetName($name)
		{
			$this->name = $name;
		}
		
		function SetServer($server)
		{
			$this->server = $server;
		}
		
		function GetUsername()
		{
			return $this->username;
		}
		
		function GetPassword()
		{
			return $this->password;
		}
		
		function GetName()
		{
			return $this->name;
		}
		
		function GetServer()
		{
			return $this->server;
		}
		
		function GetConnection()
		{
			return $this->connection;
		}
	
	};

	$database = new Database();
	
	$database->SetServer($DB_SERVER);
	$database->SetUsername($DB_USER);
	$database->SetPassword($DB_PASS);
	$database->SetName($DB_NAME);

	$database->Connect();
	
	if($module_name != "error")
	{
		if($database->IsConnected())
		{
			$database->SelectDB();
		}
		else
		{
			echo "<script language='Javascript'>window.location = \"/".$WEB_SITE."pages/pgErrorDatabase.php\";</script>";
		}
	}
	
?>