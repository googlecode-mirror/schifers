<?php

	/*
	* cdRole.php
	*
	* Roles.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: August 02, 2007
	*/


	class Role
	{
		var $id;
		var $profile;
		var $user;

		var $database;
		
		function Drop()
		{
			$sql = "DROP TABLE IF EXISTS roles";

			$this->database->Execute($sql);
		}

		function Backup($handle1, $handle2)
		{
			$result = $this->Select();

			while($data = $this->database->FetchArray($result))
			{
				fwrite($handle1, "<?php\n");

				fwrite($handle1, "	\$select = \"insert into roles (role_id, role_prof_id, role_user_id) \".\n");
				fwrite($handle1, "			  \"values (".$data["role_id"].", ".$data["role_prof_id"].", ".$data["role_user_id"].")\";\n");
				fwrite($handle1, "	\$result = \$database->Execute(\$select);\n");

				fwrite($handle1, "?>\n");

				fwrite($handle2, "<?php\n");

				fwrite($handle2, "	\$select = \"insert into roles (role_id, role_prof_id, role_user_id) \".\n");
				fwrite($handle2, "			  \"values (".$data["role_id"].", ".$data["role_prof_id"].", ".$data["role_user_id"].")\";\n");
				fwrite($handle2, "	\$result = \$database->Execute(\$select);\n");

				fwrite($handle2, "?>\n");
			}
		}

		function Create()
		{
			$sql = "DROP TABLE IF EXISTS roles";

			$this->database->Execute($sql);

			$sql = "CREATE TABLE roles ( ".
				   "role_id integer not null auto_increment, ".
				   "role_prof_id integer not null, ".
				   "role_user_id integer not null, ".
			       "primary key (role_id), ".
				   "constraint `role_prof_fk` foreign key `role_prof_fk` (`role_prof_id`) references `profiles` (`prof_id`), ".
				   "constraint `role_user_fk` foreign key `role_user_fk` (`role_user_id`) references `users` (`user_id`) ".
			       ") type=innodb";

			$this->database->Execute($sql);
		}

		function Insert()
		{
			$select = "insert into roles (role_prof_id, role_user_id) ".
					  "values (".$this->profile.", ".$this->user.")";
			$result = $this->database->Execute($select);

			if(mysql_affected_rows() == 1)
			{
				return true;
			}
			return false;
		}
		
		function Update()
		{
			$select = "update roles set role_prof_id = ".$this->profile.", role_user_id = ".$this->user." ".
					  "where role_id = ".$this->id;
			$result = $this->database->Execute($select);

			if(mysql_affected_rows() == 1)
			{
				return true;
			}
			return false;
		}

		function Delete()
		{
			$select = "delete from roles ".
					  "where role_id = ".$this->id;
			$result = $this->database->Execute($select);

			if(mysql_affected_rows() == 1)
			{
				return true;
			}
			return false;
		}

		function Select()
		{
			$select = "select role_id, role_prof_id, role_user_id ".
					  "from roles order by role_id";

			$result = $this->database->Execute($select);
			return $result;
		}

		function SelectFull()
		{
			$select = "select a.role_id, a.role_prof_id, c.prof_name, a.role_user_id, b.user_username ".
					  "from roles a, users b, profiles c ".
					  "where a.role_user_id = b.user_id ".
					  "and a.role_prof_id = c.prof_id ".
					  "order by b.user_username, c.prof_name";

			$result = $this->database->Execute($select);
			return $result;
		}

		function SelectById()
		{
			$select = "select role_prof_id, role_user_id ".
					  "from roles ".
					  "where role_id = ".$this->id;

			$result = $this->database->Execute($select);
			$data = mysql_fetch_array($result);
			
			if($result && mysql_num_rows($result) > 0)
			{
				$this->profile = $data["role_prof_id"];
				$this->user = $data["role_user_id"];
				
				return true;
			}

			return false;
		}

		function SetId($id)
		{
			$this->id = $id;
		}

		function SetProfile($profile)
		{
			$this->profile = $profile;
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

		function GetProfile()
		{
			return $this->profile;
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