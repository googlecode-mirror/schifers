<?php

	/*
	* cdUser.php
	*
	* Users.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: August 02, 2007
	*/

	class User
	{
		var $id;
		var $username;
		var $password;
		var $password_md5;
		var $active;

		var $database;
		
		function UserExists()
		{
			if($this->username == "")
			{
				return false;
			}
			
			$select = "select user_username, user_password ".
					  "from users ".
					  "where user_username = \"".$this->username."\" ".
					  "and user_active = 1";

			$result = $this->database->Execute($select);

			if($result && mysql_num_rows($result) > 0)
				return true;
			return false;
		}
		
		function Encrypt()
		{
			$this->password_md5 = md5($this->password);
		}

		function CheckPassword()
		{
			$select = "select user_id, user_username, user_password ".
					  "from users ".
					  "where user_username = \"".$this->username."\" and user_password = \"".$this->password_md5."\" ".
					  "and user_active = 1";

			$result = $this->database->Execute($select);

			if($result && mysql_num_rows($result) > 0)
			{
				$data = $this->database->FetchArray($result);
				
				$this->id = $data["user_id"];
				
				return true;
			}
			return false;
		}
		
		function Drop()
		{
			$sql = "DROP TABLE IF EXISTS users";

			$this->database->Execute($sql);
		}

		function Backup($handle1, $handle2)
		{
			$result = $this->Select();
			
			while($data = $this->database->FetchArray($result))
			{
				fwrite($handle1, "<?php\n");

				fwrite($handle1, "	\$select = \"insert into users (user_id, user_username, user_password, user_active) \".\n");
				fwrite($handle1, "			  \"values (".$data["user_id"].", \\\"".$data["user_username"]."\\\", \\\"".$data["user_password"]."\\\", ".$data["user_active"].")\";\n");
				fwrite($handle1, "	\$result = \$database->Execute(\$select);\n");

				fwrite($handle1, "?>\n");

				fwrite($handle2, "<?php\n");

				fwrite($handle2, "	\$select = \"insert into users (user_id, user_username, user_password, user_active) \".\n");
				fwrite($handle2, "			  \"values (".$data["user_id"].", \\\"".$data["user_username"]."\\\", \\\"".$data["user_password"]."\\\", ".$data["user_active"].")\";\n");
				fwrite($handle2, "	\$result = \$database->Execute(\$select);\n");

				fwrite($handle2, "?>\n");
			}
		}

		function Create()
		{
			$sql = "DROP TABLE IF EXISTS users";

			$this->database->Execute($sql);

			$sql = "CREATE TABLE users ( ".
				   "user_id integer not null auto_increment, ".
				   "user_username varchar(50) not null, ".
			       "user_password varchar(50) not null, ".
				   "user_active integer not null, ".
			       "primary key (user_id) ".
			       ") type=innodb";

			$this->database->Execute($sql);
		}

		function Insert()
		{
			$this->Encrypt();
			
			$select = "insert into users (user_username, user_password, user_active) values (\"".$this->username."\", \"".$this->password_md5."\", ".$this->active.")";
			$result = $this->database->Execute($select);

			if(mysql_affected_rows() == 1)
			{
				return true;
			}
			return false;
		}
		
		function Update()
		{
			$select = "update users set user_username = \"".$this->username."\", user_password = \"".$this->password_md5."\", user_active = ".$this->active." where user_id = ".$this->id;
			$result = $this->database->Execute($select);

			if(mysql_affected_rows() == 1)
			{
				return true;
			}
			return false;
		}

		function Delete()
		{
			$select = "delete from users ".
					  "where user_id = ".$this->id;
			$result = $this->database->Execute($select);

			if(mysql_affected_rows() == 1)
			{
				return true;
			}
			return false;
		}

		function Select()
		{
			$select = "select user_id, user_username, user_password, user_active ".
					  "from users order by user_username";

			$result = $this->database->Execute($select);
			return $result;
		}
		
		function SelectInactive()
		{
			$select = "select user_id, user_username, user_password, user_active ".
					  "from users ".
					  "where user_active = 0 ".
					  "order by user_username";

			$result = $this->database->Execute($select);
			return $result;
		}
		
		function SelectById()
		{
			$select = "select user_username, user_password, user_active ".
					  "from users ".
					  "where user_id = ".$this->id;

			$result = $this->database->Execute($select);
			$data = mysql_fetch_array($result);
			
			if($result && mysql_num_rows($result) > 0)
			{
				$this->username = $data["user_username"];
				$this->password = $data["user_password"];
				$this->password_md5 = $data["user_password"];
				$this->active = $data["user_active"];
				
				return true;
			}

			return false;
		}

		function SelectByName()
		{
			$select = "select user_id, user_username, user_password, user_active ".
					  "from users ".
					  "where user_username = \"".$this->username."\"";

			$result = $this->database->Execute($select);
			$data = mysql_fetch_array($result);
			
			if($result && mysql_num_rows($result) > 0)
			{
				$this->id = $data["user_id"];
				$this->username = $data["user_username"];
				$this->password = $data["user_password"];
				$this->password_md5 = $data["user_password"];
				$this->active = $data["user_active"];

				return true;
			}

			return false;
		}

		function SelectProfile()
		{
			$select = "select c.prof_id ".
					  "from users a, roles b, profiles c ".
					  "where a.user_id = ".$this->id." ".
					  "and a.user_id = b.role_user_id ".
					  "and c.prof_id = b.role_prof_id ".
					  "and c.prof_id = 1";

			$result = $this->database->Execute($select);
			$data = mysql_fetch_array($result);
			
			if($result && mysql_num_rows($result) > 0)
			{
				return $data["prof_id"];
			}

			return false;
		}

		function SetId($id)
		{
			$this->id = $id;
		}

		function SetUsername($username)
		{
			$this->username = stripslashes($username);
		}

		function SetPassword($password)
		{
			$this->password = stripslashes($password);
		}
		
		function SetEncryptedPassword($password)
		{
			$this->password_md5 = $password;
		}
		
		function SetActive($active)
		{
			$this->active = $active;
		}
		
		function SetDatabase($database)
		{
			$this->database = $database;
		}

		function GetId()
		{
			return $this->id;
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

		function GetActive()
		{
			return $this->active;
		}

		function GetDatabase()
		{
			return $this->database;
		}
	};

?>