<?php

	/*
	* cdMessage.php
	*
	* Messages.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: September 29, 2007
	*/


	class Message
	{
		var $id;
		var $text;
		var $date;
		var $hits;
		var $topic;
		var $user;

		var $database;
		
		function Drop()
		{
			$sql = "DROP TABLE IF EXISTS messages";

			$this->database->Execute($sql);
		}

		function Backup($handle1, $handle2)
		{
			$result = $this->Select();

			while($data = $this->database->FetchArray($result))
			{
				fwrite($handle1, "<?php\n");

				fwrite($handle1, "	\$select = \"insert into messages (mess_id, mess_text, mess_date, mess_hits, mess_topc_id, mess_user_id) \".\n");
				fwrite($handle1, "			  \"values (".$data["mess_id"].", \\\"".str_replace("\n", "\\n", $data["mess_text"])."\\\", \\\"".$data["mess_date"]."\\\", ".$data["mess_hits"].", ".$data["mess_topc_id"].", ".$data["mess_user_id"].")\";\n");
				fwrite($handle1, "	\$result = \$database->Execute(\$select);\n");

				fwrite($handle1, "?>\n");

				fwrite($handle2, "<?php\n");

				fwrite($handle2, "	\$select = \"insert into messages (mess_id, mess_text, mess_date, mess_hits, mess_topc_id, mess_user_id) \".\n");
				fwrite($handle2, "			  \"values (".$data["mess_id"].", \\\"".str_replace("\n", "\\n", $data["mess_text"])."\\\", \\\"".$data["mess_date"]."\\\", ".$data["mess_hits"].", ".$data["mess_topc_id"].", ".$data["mess_user_id"].")\";\n");
				fwrite($handle2, "	\$result = \$database->Execute(\$select);\n");

				fwrite($handle2, "?>\n");
			}
		}

		function Create()
		{
			$sql = "DROP TABLE IF EXISTS messages";

			$this->database->Execute($sql);

			$sql = "CREATE TABLE messages ( ".
				   "mess_id integer not null auto_increment, ".
				   "mess_text text not null, ".
				   "mess_date datetime not null, ".
				   "mess_hits integer not null default 0, ".
				   "mess_topc_id integer not null, ".
				   "mess_user_id integer not null, ".
			       "primary key (mess_id), ".
				   "constraint `mess_topc_fk` foreign key `mess_topc_fk` (`mess_topc_id`) references `topics` (`topc_id`), ".
				   "constraint `mess_user_fk` foreign key `mess_user_fk` (`mess_user_id`) references `users` (`user_id`) ".
			       ") type=innodb";

			$this->database->Execute($sql);
		}

		function Insert()
		{
			$select = "insert into messages (mess_text, mess_date, mess_topc_id, mess_user_id) ".
					  "values (\"".$this->text."\", \"".$this->date."\", ".$this->topic.", ".$this->user.")";
			$result = $this->database->Execute($select);

			if(mysql_affected_rows() == 1)
			{
				return true;
			}
			return false;
		}
		
		function Update()
		{
			$select = "update messages set mess_text = \"".$this->text."\", ".
					  "mess_date = \"".$this->date."\", mess_topc_id = ".$this->topic.", mess_user_id = ".$this->user." ".
					  "where mess_id = ".$this->id;
			$result = $this->database->Execute($select);

			if(mysql_affected_rows() == 1)
			{
				return true;
			}
			return false;
		}

		function Delete()
		{
			$select = "delete from messages ".
					  "where mess_id = ".$this->id;
			$result = $this->database->Execute($select);

			if(mysql_affected_rows() == 1)
			{
				return true;
			}
			return false;
		}

		function Hit()
		{
			$select = "select mess_hits from messages where mess_id = ".$this->id;
			$result = $this->database->Execute($select);
			$data = $this->database->FetchArray($result);
			$this->hits = $data["mess_hits"] + 1;
			
			$select = "update messages set mess_hits = ".$this->hits." where mess_id = ".$this->id;
			$result = $this->database->Execute($select);

			if(mysql_affected_rows() == 1)
			{
				return true;
			}
			return false;
		}

		function Select()
		{
			$select = "select mess_id, mess_text, mess_date, mess_topc_id ,mess_user_id ".
					  "from messages order by mess_arti_id, mess_id";

			$result = $this->database->Execute($select);
			return $result;
		}

		function SelectById()
		{
			$select = "select mess_id, mess_text, mess_date, mess_topc_id ,mess_user_id ".
					  "from messages ".
					  "where mess_id = ".$this->id;
			$result = $this->database->Execute($select);
			$data = mysql_fetch_array($result);
			
			if($result && mysql_num_rows($result) > 0)
			{
				$this->id = $data["mess_id"];
				$this->text = $data["mess_text"];
				$this->date = $data["mess_date"];
				$this->topic = $data["mess_topc_id"];
				$this->user = $data["mess_user_id"];
				
				return true;
			}

			return false;
		}
		
		function SelectLastMessageByTopic()
		{
			$select = "select mess_id, mess_text, mess_date, mess_topc_id ,mess_user_id ".
					  "from messages ".
					  "where mess_topc_id = ".$this->topic." ".
					  "order by mess_date desc";
			$result = $this->database->Execute($select);
			$data = mysql_fetch_array($result);
			
			if($result && mysql_num_rows($result) > 0)
			{
				$this->id = $data["mess_id"];
				$this->text = $data["mess_text"];
				$this->date = $data["mess_date"];
				$this->topic = $data["mess_topc_id"];
				$this->user = $data["mess_user_id"];
				
				return true;
			}

			return false;
		}
		
		function CountByTopic()
		{
			$select = "select count(*) quantity ".
					  "from messages ".
					  "where mess_topc_id = ".$this->topic;

			$result = $this->database->Execute($select);
			$data = $this->database->FetchArray($result);
			return $data["quantity"];
		}
		
		function SetId($id)
		{
			$this->id = $id;
		}

		function SetText($text)
		{
			$this->text = $text;
		}

		function SetDate($date)
		{
			$this->date = $date;
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

		function GetText()
		{
			return $this->text;
		}

		function GetDate()
		{
			return $this->date;
		}

		function GetUser()
		{
			return $this->user;
		}

		function GetTopic()
		{
			return $this->topic;
		}

		function GetDatabase()
		{
			return $this->database;
		}
	};

?>