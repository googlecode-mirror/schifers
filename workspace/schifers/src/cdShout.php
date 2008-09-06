<?php

	/*
	* cdShout.php
	*
	* Shout.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: August 02, 2007
	*/

	class Shout
	{
		var $id;
		var $text;
		var $date;
		var $user;

		var $database;
		
		function Drop()
		{
			$sql = "DROP TABLE IF EXISTS shouts";

			$this->database->Execute($sql);
		}

		function Backup($handle1, $handle2)
		{
			$result = $this->Select();

			while($data = $this->database->FetchArray($result))
			{
				fwrite($handle1, "<?php\n");

				fwrite($handle1, "	\$select = \"insert into shouts (shou_id, shou_text, shou_date, shou_user_id) \".\n");
				fwrite($handle1, "			  \"values (".$data["shou_id"].", \\\"".str_replace("\n", "\\n", $data["shou_text"])."\\\", \\\"".$data["shou_date"]."\\\", ".$data["shou_user_id"].")\";\n");
				fwrite($handle1, "	\$result = \$database->Execute(\$select);\n");

				fwrite($handle1, "?>\n");

				fwrite($handle2, "<?php\n");

				fwrite($handle2, "	\$select = \"insert into shouts (shou_id, shou_text, shou_date, shou_user_id) \".\n");
				fwrite($handle2, "			  \"values (".$data["shou_id"].", \\\"".str_replace("\n", "\\n", $data["shou_text"])."\\\", \\\"".$data["shou_date"]."\\\", ".$data["shou_user_id"].")\";\n");
				fwrite($handle2, "	\$result = \$database->Execute(\$select);\n");

				fwrite($handle2, "?>\n");
			}
		}

		function Create()
		{
			$sql = "DROP TABLE IF EXISTS shouts";

			$this->database->Execute($sql);

			$sql = "CREATE TABLE shouts ( ".
				   "shou_id integer not null auto_increment, ".
				   "shou_text text not null, ".
				   "shou_date datetime not null, ".
				   "shou_user_id integer not null, ".
			       "primary key (shou_id), ".
				   "constraint `shou_user_fk` foreign key `shou_user_fk` (`shou_user_id`) references `users` (`user_id`) ".
			       ") type=innodb";

			$this->database->Execute($sql);
		}

		function Insert()
		{
			$select = "insert into shouts (shou_text, shou_date, shou_user_id) ".
					  "values (\"".$this->text."\", \"".$this->date."\", ".$this->user.")";

			$result = $this->database->Execute($select);

			if(mysql_affected_rows() == 1)
			{
				return true;
			}
			return false;
		}
		
		function Update()
		{
			$select = "update shouts set shou_text = \"".$this->text."\", ".
					  "shou_date = \"".$this->date."\", shou_user_id = ".$this->user." ".
					  "where shou_id = ".$this->id;
			$result = $this->database->Execute($select);

			if(mysql_affected_rows() == 1)
			{
				return true;
			}
			return false;
		}

		function Delete()
		{
			$select = "delete from shouts ".
					  "where shou_id = ".$this->id;
			$result = $this->database->Execute($select);

			if(mysql_affected_rows() == 1)
			{
				return true;
			}
			return false;
		}

		function Select()
		{
			$select = "select a.shou_id, a.shou_text, shou_date, a.shou_user_id, b.user_username ".
					  "from shouts a, users b ".
					  "where a.shou_user_id = b.user_id ".
					  "order by a.shou_date desc";

			$result = $this->database->Execute($select);
			return $result;
		}

		function SelectNextPage($id)
		{
			$select = "";
			
			if($id == 0)
			{
				$select = "select a.shou_id, a.shou_text, a.shou_date, a.shou_user_id, b.user_username ".
						  "from shouts a, users b ".
						  "where a.shou_user_id = b.user_id ".
						  "order by a.shou_date desc";
			}
			else
			{
				$this->SetId($id);
				$this->SelectById();
				
				$select = "select a.shou_id, a.shou_text, a.shou_date, a.shou_user_id, b.user_username ".
						  "from shouts a, users b ".
						  "where a.shou_date < \"".$this->GetDate()."\" ".
						  "and a.shou_user_id = b.user_id ".
						  "order by a.shou_date desc";
			}
					 
			$result = $this->database->Execute($select);
			
			if($result && mysql_num_rows($result) > 0)
			{
				return $result;
			}
			else
			{
				return 0;
			}
		}

		function SelectPreviousPage($id, $pages)
		{
			$this->id = $id;
			$this->SelectById();
			
			$select = "select a.shou_id, a.shou_text, a.shou_date, a.shou_user_id, b.user_username ".
					  "from shouts a, users b ".
					  "where a.shou_date > \"".$this->GetDate()."\" ".
					  "and a.shou_user_id = b.user_id ".
					  "order by a.shou_date asc";

			$result = $this->database->Execute($select);

			$counter = 0;
			
			while($data = mysql_fetch_array($result))
			{
				$this->id = $data["shou_id"];

				if($counter >= $pages)
				{
					break;
				}
			
				$counter++;
			}

			if($counter == 0)
			{
				return 0;
			}
			
			if(mysql_num_rows($result) == $counter)
			{
				$id = 0;
			}
			else
			{
				$id = $this->id;
			}
			
			return $this->SelectNextPage($id);
		}

		function SelectById()
		{
			$select = "select shou_text, shou_date, shou_user_id ".
					  "from shouts ".
					  "where shou_id = ".$this->id;

			$result = $this->database->Execute($select);
			$data = mysql_fetch_array($result);
			
			if($result && mysql_num_rows($result) > 0)
			{
				$this->text = $data["shou_text"];
				$this->date = $data["shou_date"];
				$this->user = $data["shou_user_id"];
				
				return true;
			}

			return false;
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

		function GetDatabase()
		{
			return $this->database;
		}
	};

?>