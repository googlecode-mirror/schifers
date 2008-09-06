<?php

	/*
	* cdUserInfo.php
	*
	* Users Information.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: September 09, 2007
	*/


	class UserInfo
	{
		var $id;
		var $first_name;
		var	$last_name;
		var $nick;
		var $email;
		var $user;

		var $database;
		
		function Drop()
		{
			$sql = "DROP TABLE IF EXISTS users_info";

			$this->database->Execute($sql);
		}

		function Backup($handle1, $handle2)
		{
			$result = $this->Select();

			while($data = $this->database->FetchArray($result))
			{
				fwrite($handle1, "<?php\n");

				fwrite($handle1, "	\$select = \"insert into users_info (usif_id, usif_first_name, usif_last_name, usif_nick, usif_email, usif_user_id) \".\n");
				fwrite($handle1, "			  \"values (".$data["usif_id"].", \\\"".$data["usif_first_name"]."\\\", \\\"".$data["usif_last_name"]."\\\", \\\"".$data["usif_nick"]."\\\", \\\"".$data["usif_email"]."\\\", ".$data["usif_user_id"].")\";\n");
				fwrite($handle1, "	\$result = \$database->Execute(\$select);\n");

				fwrite($handle1, "?>\n");

				fwrite($handle2, "<?php\n");

				fwrite($handle2, "	\$select = \"insert into users_info (usif_id, usif_first_name, usif_last_name, usif_nick, usif_email, usif_user_id) \".\n");
				fwrite($handle2, "			  \"values (".$data["usif_id"].", \\\"".$data["usif_first_name"]."\\\", \\\"".$data["usif_last_name"]."\\\", \\\"".$data["usif_nick"]."\\\", \\\"".$data["usif_email"]."\\\", ".$data["usif_user_id"].")\";\n");
				fwrite($handle2, "	\$result = \$database->Execute(\$select);\n");

				fwrite($handle2, "?>\n");
			}
		}
		
		function Create()
		{
			$sql = "DROP TABLE IF EXISTS users_info";

			$this->database->Execute($sql);

			$sql = "CREATE TABLE users_info ( ".
				   "usif_id integer not null auto_increment, ".
				   "usif_first_name varchar(50) not null, ".
			       "usif_last_name varchar(50) not null, ".
				   "usif_nick varchar(50) not null, ".
				   "usif_email varchar(100) not null, ".
				   "usif_user_id integer not null, ".
			       "primary key (usif_id), ".
   				   "constraint `usif_user_fk` foreign key `usif_user_fk` (`usif_user_id`) references `users` (`user_id`) ".
			       ") type=innodb";

			$this->database->Execute($sql);
		}

		function Insert()
		{
			$select = "insert into users_info (usif_first_name, usif_last_name, usif_nick, usif_email, usif_user_id) values (\"".$this->first_name."\", \"".$this->last_name."\", \"".$this->nick."\", \"".$this->email."\", ".$this->user.")";
			$result = $this->database->Execute($select);
			if(mysql_affected_rows() == 1)
			{
				return true;
			}
			return false;
		}
		
		function Update()
		{
			$select = "update users_info set usif_first_name = \"".$this->first_name."\", usif_last_name = \"".$this->last_name."\", usif_nick = \"".$this->nick."\", usif_email = \"".$this->email."\", usif_user_id = ".$this->user." ".
					  "where usif_id = ".$this->id;
			$result = $this->database->Execute($select);

			if(mysql_affected_rows() == 1)
			{
				return true;
			}
			return false;
		}

		function Delete()
		{
			$select = "delete from users_info ".
					  "where usif_id = ".$this->id;
			$result = $this->database->Execute($select);

			if(mysql_affected_rows() == 1)
			{
				return true;
			}
			return false;
		}

		function Select()
		{
			$select = "select usif_id, usif_first_name, usif_last_name, usif_nick, usif_email, usif_user_id ".
					  "from users_info order by usif_first_name";

			$result = $this->database->Execute($select);
			return $result;
		}
		
		function SelectById()
		{
			$select = "select usif_id, usif_first_name, usif_last_name, usif_nick, usif_email, usif_user_id ".
					  "from users_info ".
					  "where usif_id = ".$this->id;

			$result = $this->database->Execute($select);
			$data = mysql_fetch_array($result);
			
			if($result && mysql_num_rows($result) > 0)
			{
				$this->first_name = $data["usif_first_name"];
				$this->last_name = $data["usif_last_name"];
				$this->nick = $data["usif_nick"];
				$this->email = $data["usif_email"];
				$this->user = $data["usif_user_id"];
				
				return true;
			}

			return false;
		}

		function SelectByUser()
		{
			$select = "select usif_id, usif_first_name, usif_last_name, usif_nick, usif_email, usif_user_id ".
					  "from users_info ".
					  "where usif_user_id = ".$this->user;

			$result = $this->database->Execute($select);
			$data = mysql_fetch_array($result);
			
			if($result && mysql_num_rows($result) > 0)
			{
				$this->id = $data["usif_id"];
				$this->first_name = $data["usif_first_name"];
				$this->last_name = $data["usif_last_name"];
				$this->nick = $data["usif_nick"];
				$this->email = $data["usif_email"];
				$this->user = $data["usif_user_id"];
				
				return true;
			}

			return false;
		}

		function SelectByName()
		{
			$select = "select usif_id, usif_first_name, usif_last_name, usif_nick, usif_email, usif_user_id ".
					  "from users_info ".
					  "where usif_first_name = \"".$this->first_name."\"";

			$result = $this->database->Execute($select);
			$data = mysql_fetch_array($result);
			
			if($result && mysql_num_rows($result) > 0)
			{
				$this->id = $data["usif_id"];
				$this->first_name = $data["usif_first_name"];
				$this->last_name = $data["usif_last_name"];
				$this->nick = $data["usif_nick"];
				$this->email = $data["usif_email"];
				$this->user = $data["usif_user_id"];

				return true;
			}

			return false;
		}

		function SetId($id)
		{
			$this->id = $id;
		}

		function SetFirstName($name)
		{
			$this->first_name = $name;
		}

		function SetLastName($name)
		{
			$this->last_name = $name;
		}
		
		function SetNick($nick)
		{
			$this->nick = $nick;
		}
		
		function SetEmail($email)
		{
			$this->email = $email;
		}

		function SetUser($user)
		{
			$this->user = $user;
		}

		function SetDatabase($database)
		{
			$this->database = $database;
		}

		function GetId()
		{
			return $this->id;
		}
		
		function GetFirstName()
		{
			return $this->first_name;
		}
		
		function GetLastName()
		{
			return $this->last_name;
		}

		function GetNick()
		{
			return $this->nick;
		}

		function GetEmail()
		{
			return $this->email;
		}

		function GetUser()
		{
			return $this->user;
		}

		function GetDatabase()
		{
			return $this->database;
		}
	};

?>