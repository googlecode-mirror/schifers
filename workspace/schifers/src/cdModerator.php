<?php

	/*
	* cdModerator.php
	*
	* Moderators.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: October 04, 2007
	*/


	class Moderator
	{
		var $id;
		var $topic;
		var $user;

		var $database;
		
		function Drop()
		{
			$sql = "DROP TABLE IF EXISTS moderators";

			$this->database->Execute($sql);
		}

		function Backup($handle1, $handle2)
		{
			$result = $this->Select();

			while($data = $this->database->FetchArray($result))
			{
				fwrite($handle1, "<?php\n");

				fwrite($handle1, "	\$select = \"insert into moderators (modr_id, modr_topc_id, modr_user_id) \".\n");
				fwrite($handle1, "			  \"values (".$data["modr_id"].", ".$data["modr_topc_id"].", ".$data["modr_user_id"].")\";\n");
				fwrite($handle1, "	\$result = \$database->Execute(\$select);\n");

				fwrite($handle1, "?>\n");

				fwrite($handle2, "<?php\n");

				fwrite($handle2, "	\$select = \"insert into moderators (modr_id, modr_topc_id, modr_user_id) \".\n");
				fwrite($handle2, "			  \"values (".$data["modr_id"].", ".$data["modr_topc_id"].", ".$data["modr_user_id"].")\";\n");
				fwrite($handle2, "	\$result = \$database->Execute(\$select);\n");

				fwrite($handle2, "?>\n");
			}
		}

		function Create()
		{
			$sql = "DROP TABLE IF EXISTS moderators";

			$this->database->Execute($sql);

			$sql = "CREATE TABLE moderators ( ".
				   "modr_id integer not null auto_increment, ".
				   "modr_topc_id integer not null, ".
				   "modr_user_id integer not null, ".
			       "primary key (modr_id), ".
				   "constraint `modr_topc_fk` foreign key `modr_topc_fk` (`modr_topc_id`) references `topics` (`topc_id`), ".
				   "constraint `modr_user_fk` foreign key `modr_user_fk` (`modr_user_id`) references `users` (`user_id`) ".
			       ") type=innodb";

			$this->database->Execute($sql);
		}

		function Insert()
		{
			$select = "insert into moderators (modr_topc_id, modr_user_id) ".
					  "values (".$this->topic.", ".$this->user.")";
			$result = $this->database->Execute($select);

			if(mysql_affected_rows() == 1)
			{
				return true;
			}
			return false;
		}
		
		function Update()
		{
			$select = "update moderators set modr_topc_id = ".$this->topic.", modr_user_id = ".$this->user." ".
					  "where modr_id = ".$this->id;
			$result = $this->database->Execute($select);

			if(mysql_affected_rows() == 1)
			{
				return true;
			}
			return false;
		}

		function Delete()
		{
			$select = "delete from moderators ".
					  "where modr_id = ".$this->id;
			$result = $this->database->Execute($select);

			if(mysql_affected_rows() == 1)
			{
				return true;
			}
			return false;
		}

		function Select()
		{
			$select = "select modr_id, modr_topc_id, modr_user_id ".
					  "from moderators order by modr_id";

			$result = $this->database->Execute($select);
			return $result;
		}

		function SelectCombo()
		{
			$select = "select a.modr_id, a.modr_user_id, a.modr_topc_id, b.user_username, c.topc_title ".
					  "from moderators a, users b, topics c ".
					  "where a.modr_user_id = b.user_id ".
					  "and a.modr_topc_id = c.topc_id ".
					  "order by b.user_username, c.topc_title";

			$result = $this->database->Execute($select);
			return $result;
		}

		function SelectByTopic()
		{
			$select = "select a.modr_id, a.modr_topc_id, a.modr_user_id, c.usif_nick ".
					  "from moderators a, users b, users_info c ".
					  "where a.modr_user_id = b.user_id ".
					  "and b.user_id = c.usif_user_id ".
					  "and modr_topc_id = ".$this->topic." ".
					  "order by b.user_username";

			$result = $this->database->Execute($select);
			return $result;
		}

		function SelectById()
		{
			$select = "select modr_topc_id, modr_user_id ".
					  "from moderators ".
					  "where modr_id = ".$this->id;

			$result = $this->database->Execute($select);
			$data = mysql_fetch_array($result);
			
			if($result && mysql_num_rows($result) > 0)
			{
				$this->topic = $data["modr_topc_id"];
				$this->user = $data["modr_user_id"];
				
				return true;
			}

			return false;
		}

		function SetId($id)
		{
			$this->id = $id;
		}

		function SetTopic($topic)
		{
			$this->topic = $topic;
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

		function GetTopic()
		{
			return $this->topic;
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