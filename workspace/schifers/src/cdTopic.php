<?php

	/*
	* cdTopic.php
	*
	* Topics.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: September 29, 2007
	*/


	class Topic
	{
		var $id;
		var $title;
		var $text;
		var $date;
		var $hits;
		var $level;
		var $topic;
		var $user;

		var $database;
		
		function Drop()
		{
			$sql = "DROP TABLE IF EXISTS topics";

			$this->database->Execute($sql);
		}

		function Backup($handle1, $handle2)
		{
			$result = $this->Select();

			while($data = $this->database->FetchArray($result))
			{
				fwrite($handle1, "<?php\n");

				fwrite($handle1, "	\$select = \"insert into topics (topc_id, topc_title, topc_text, topc_date, topc_level, topc_hits, topc_topc_id, topc_user_id) \".\n");
				fwrite($handle1, "			  \"values (".$data["topc_id"].", \\\"".$data["topc_title"]."\\\", \\\"".$data["topc_text"]."\\\", \\\"".$data["topc_date"]."\\\", ".$data["topc_level"].", ".$data["topc_hits"].", ".$data["topc_topc_id"].", ".$data["topc_user_id"].")\";\n");
				fwrite($handle1, "	\$result = \$database->Execute(\$select);\n");

				fwrite($handle1, "?>\n");

				fwrite($handle2, "<?php\n");

				fwrite($handle2, "	\$select = \"insert into topics (topc_id, topc_title, topc_text, topc_date, topc_level, topc_hits, topc_topc_id, topc_user_id) \".\n");
				fwrite($handle2, "			  \"values (".$data["topc_id"].", \\\"".$data["topc_title"]."\\\", \\\"".$data["topc_text"]."\\\", \\\"".$data["topc_date"]."\\\", ".$data["topc_level"].", ".$data["topc_hits"].", ".$data["topc_topc_id"].", ".$data["topc_user_id"].")\";\n");
				fwrite($handle2, "	\$result = \$database->Execute(\$select);\n");

				fwrite($handle2, "?>\n");
			}
		}

		function Create()
		{
			$sql = "DROP TABLE IF EXISTS topics";

			$this->database->Execute($sql);

			$sql = "CREATE TABLE topics ( ".
				   "topc_id integer not null auto_increment, ".
				   "topc_title varchar(255) not null, ".
				   "topc_text text, ".
				   "topc_date datetime not null, ".
				   "topc_level integer, ".
				   "topc_hits integer not null default 0, ".
				   "topc_topc_id integer, ".
				   "topc_user_id integer not null, ".
			       "primary key (topc_id), ".
				   "constraint `topc_topc_fk` foreign key `topc_topc_fk` (`topc_topc_id`) references `topics` (`topc_id`), ".
				   "constraint `topc_user_fk` foreign key `topc_user_fk` (`topc_user_id`) references `users` (`user_id`) ".
			       ") type=innodb";

			$this->database->Execute($sql);
		}

		function Insert()
		{
			$select = "insert into topics (topc_title, topc_text, topc_date, topc_level, topc_topc_id, topc_user_id) ".
					  "values (\"".$this->title."\", ";

			if($this->text == "")
			{
				$select = $select."null";
			}
			else
			{
				$select = $select."\"".$this->text."\"";
			}
			
			$select = $select.", \"".$this->date."\", ".$this->level.", ";
			
			if($this->topic == "")
			{
				$select = $select."null";
			}
			else
			{
				$select = $select.$this->topic;
			}
			
			$select = $select.", ".$this->user.")";

			$result = $this->database->Execute($select);

			if(mysql_affected_rows() == 1)
			{
				return true;
			}
			return false;
		}
		
		function Update()
		{
			$select = "update topics set topc_title = \"".$this->title."\", topc_text = \"".$this->text."\", ".
					  "topc_date = \"".$this->date."\", topc_level = ".$this->level.", topc_topc_id = ".$this->topic.", topc_user_id = ".$this->user." ".
					  "where topc_id = ".$this->id;
			$result = $this->database->Execute($select);

			if(mysql_affected_rows() == 1)
			{
				return true;
			}
			return false;
		}

		function Delete()
		{
			$select = "delete from topics ".
					  "where topc_id = ".$this->id;
			$result = $this->database->Execute($select);

			if(mysql_affected_rows() == 1)
			{
				return true;
			}
			return false;
		}

		function Hit()
		{
			$select = "select topc_hits from topics where topc_id = ".$this->id;
			$result = $this->database->Execute($select);
			$data = $this->database->FetchArray($result);
			$this->hits = $data["topc_hits"] + 1;
			
			$select = "update topics set topc_hits = ".$this->hits." where topc_id = ".$this->id;
			$result = $this->database->Execute($select);

			if(mysql_affected_rows() == 1)
			{
				return true;
			}
			return false;
		}

		function Select()
		{
			$select = "select topc_id, topc_title, topc_text, topc_level, topc_date, topc_topc_id, topc_user_id ".
					  "from topics order by topc_title";

			$result = $this->database->Execute($select);
			return $result;
		}

		function SelectByLevel()
		{
			$select = "select topc_id, topc_title, topc_text, topc_level, topc_date, topc_topc_id, topc_user_id ".
					  "from topics ".
					  "where topc_level = ".$this->level." ".
					  "order by topc_topc_id, topc_id";

			$result = $this->database->Execute($select);
			return $result;
		}

		function SelectByTopic()
		{
			$select = "select topc_id, topc_title, topc_text, topc_level, topc_date, topc_hits, topc_topc_id, topc_user_id ".
					  "from topics ".
					  "where topc_topc_id = ".$this->topic." ".
					  "order by topc_topc_id, topc_id";

			$result = $this->database->Execute($select);
			return $result;
		}

		function SelectById()
		{
			$select = "select topc_id, topc_title, topc_text, topc_level, topc_date, topc_hits, topc_topc_id, topc_user_id ".
					  "from topics ".
					  "where topc_id = ".$this->id;
			$result = $this->database->Execute($select);
			$data = mysql_fetch_array($result);
			
			if($result && mysql_num_rows($result) > 0)
			{
				$this->id = $data["topc_id"];
				$this->title = $data["topc_title"];
				$this->text = $data["topc_text"];
				$this->date = $data["topc_date"];
				$this->level = $data["topc_level"];
				$this->hits = $data["topc_hits"];
				$this->topic = $data["topc_topc_id"];
				$this->user = $data["topc_user_id"];
				
				return true;
			}

			return false;
		}

		function CountByTopic()
		{
			$select = "select count(*) quantity ".
					  "from topics ".
					  "where topc_topc_id = ".$this->topic;

			$result = $this->database->Execute($select);
			$data = $this->database->FetchArray($result);
			return $data["quantity"];
		}
		
		function SetId($id)
		{
			$this->id = $id;
		}

		function SetTitle($title)
		{
			$this->title = $title;
		}

		function SetText($text)
		{
			$this->text = $text;
		}

		function SetDate($date)
		{
			$this->date = $date;
		}

		function SetLevel($level)
		{
			$this->level = $level;
		}

		function SetHits($hits)
		{
			$this->hits = $hits;
		}

		function SetTopic($topc)
		{
			$this->topic = $topc;
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

		function GetTitle()
		{
			return $this->title;
		}

		function GetText()
		{
			return $this->text;
		}

		function GetDate()
		{
			return $this->date;
		}

		function GetLevel()
		{
			return $this->level;
		}

		function GetHits()
		{
			return $this->hits;
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