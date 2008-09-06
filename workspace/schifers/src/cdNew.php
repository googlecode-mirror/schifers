<?php

	/*
	* cdNew.php
	*
	* News.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: August 02, 2007
	*/


	class News
	{
		var $id;
		var $title;
		var $text;
		var $date;
		var $user;

		var $database;
		
		function Drop()
		{
			$sql = "DROP TABLE IF EXISTS news";

			$this->database->Execute($sql);
		}

		function Backup($handle1, $handle2)
		{
			$result = $this->Select();

			while($data = $this->database->FetchArray($result))
			{
				fwrite($handle1, "<?php\n");

				fwrite($handle1, "	\$select = \"insert into news (news_id, news_title, news_text, news_date, news_user_id) \".\n");
				fwrite($handle1, "			  \"values (".$data["news_id"].", \\\"".$data["news_title"]."\\\", \\\"".str_replace("\n", "\\n", $data["news_text"])."\\\", \\\"".$data["news_date"]."\\\", ".$data["news_user_id"].")\";\n");
				fwrite($handle1, "	\$result = \$database->Execute(\$select);\n");

				fwrite($handle1, "?>\n");

				fwrite($handle2, "<?php\n");

				fwrite($handle2, "	\$select = \"insert into news (news_id, news_title, news_text, news_date, news_user_id) \".\n");
				fwrite($handle2, "			  \"values (".$data["news_id"].", \\\"".$data["news_title"]."\\\", \\\"".str_replace("\n", "\\n", $data["news_text"])."\\\", \\\"".$data["news_date"]."\\\", ".$data["news_user_id"].")\";\n");
				fwrite($handle2, "	\$result = \$database->Execute(\$select);\n");

				fwrite($handle2, "?>\n");
			}
		}

		function Create()
		{
			$sql = "DROP TABLE IF EXISTS news";

			$this->database->Execute($sql);

			$sql = "CREATE TABLE news ( ".
				   "news_id integer not null auto_increment, ".
				   "news_title varchar(50) not null, ".
				   "news_text text not null, ".
				   "news_date datetime not null, ".
				   "news_user_id integer not null, ".
			       "primary key (news_id), ".
				   "constraint `news_user_fk` foreign key `news_user_fk` (`news_user_id`) references `users` (`user_id`) ".
			       ") type=innodb";

			$this->database->Execute($sql);
		}

		function Insert()
		{
			$select = "insert into news (news_title, news_text, news_date, news_user_id) ".
					  "values (\"".$this->title."\", \"".$this->text."\", \"".$this->date."\", ".$this->user.")";
			$result = $this->database->Execute($select);

			if(mysql_affected_rows() == 1)
			{
				return true;
			}
			return false;
		}
		
		function Update()
		{
			$select = "update news set news_title = \"".$this->title."\", news_text = \"".$this->text."\", ".
					  "news_date = \"".$this->date."\", news_user_id = ".$this->user." ".
					  "where news_id = ".$this->id;

			$result = $this->database->Execute($select);

			if(mysql_affected_rows() == 1)
			{
				return true;
			}
			return false;
		}

		function Delete()
		{
			$select = "delete from news ".
					  "where news_id = ".$this->id;
			$result = $this->database->Execute($select);

			if(mysql_affected_rows() == 1)
			{
				return true;
			}
			return false;
		}

		function Select()
		{
			$select = "select news_id, news_title, news_text, news_date, news_user_id ".
					  "from news ".
					  "order by news_date desc";

			$result = $this->database->Execute($select);
			return $result;
		}
		
		function SelectNextPage($id)
		{
			$select = "";
			
			if($id == 0)
			{
				$select = "select news_id, news_title, news_text, news_date, news_user_id ".
						  "from news ".
						  "order by news_date desc";
			}
			else
			{
				$this->SetId($id);
				$this->SelectById();
				
				$select = "select news_id, news_title, news_text, news_date, news_user_id ".
						  "from news ".
						  "where news_date < \"".$this->GetDate()."\" ".
						  "order by news_date desc";
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
			
			$select = "select news_id, news_title, news_text, news_date, news_user_id ".
					  "from news ".
					  "where news_date > \"".$this->GetDate()."\" ".
					  "order by news_date asc";

		  $result = $this->database->Execute($select);

			$counter = 0;
			
			while($data = mysql_fetch_array($result))
			{
				$this->id = $data["news_id"];

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
			$select = "select news_title, news_text, news_date, news_user_id ".
					  "from news ".
					  "where news_id = ".$this->id;

			$result = $this->database->Execute($select);
			$data = mysql_fetch_array($result);
			
			if($result && mysql_num_rows($result) > 0)
			{
				$this->title = $data["news_title"];
				$this->text = $data["news_text"];
				$this->date = $data["news_date"];
				$this->user = $data["news_user_id"];
				
				return true;
			}

			return false;
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