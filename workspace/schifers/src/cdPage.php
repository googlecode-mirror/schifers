<?php

	/*
	* cdPage.php
	*
	* Pages.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: September 28, 2007
	*/


	class Page
	{
		var $id;
		var $number;
		var $date;
		var $article;
		var $user;

		var $database;
		
		function Drop()
		{
			$sql = "DROP TABLE IF EXISTS pages";

			$this->database->Execute($sql);
		}

		function Backup($handle1, $handle2)
		{
			$result = $this->Select();

			while($data = $this->database->FetchArray($result))
			{
				fwrite($handle1, "<?php\n");

				fwrite($handle1, "	\$select = \"insert into pages (page_id, page_number, page_date, page_arti_id, page_user_id) \".\n");
				fwrite($handle1, "			  \"values (".$data["page_id"].", ".$data["page_number"].", \\\"".$data["page_date"]."\\\", ".$data["page_arti_id"].", ".$data["page_user_id"].")\";\n");
				fwrite($handle1, "	\$result = \$database->Execute(\$select);\n");

				fwrite($handle1, "?>\n");

				fwrite($handle2, "<?php\n");

				fwrite($handle2, "	\$select = \"insert into pages (page_id, page_number, page_date, page_arti_id, page_user_id) \".\n");
				fwrite($handle2, "			  \"values (".$data["page_id"].", ".$data["page_number"].", \\\"".$data["page_date"]."\\\", ".$data["page_arti_id"].", ".$data["page_user_id"].")\";\n");
				fwrite($handle2, "	\$result = \$database->Execute(\$select);\n");

				fwrite($handle2, "?>\n");
			}
		}

		function Create()
		{
			$sql = "DROP TABLE IF EXISTS pages";

			$this->database->Execute($sql);

			$sql = "CREATE TABLE pages ( ".
				   "page_id integer not null auto_increment, ".
				   "page_number integer not null, ".
				   "page_date datetime not null, ".
				   "page_arti_id integer not null, ".
				   "page_user_id integer not null, ".
			       "primary key (page_id), ".
				   "constraint `page_arti_fk` foreign key `page_arti_fk` (`page_arti_id`) references `articles` (`arti_id`), ".
				   "constraint `page_user_fk` foreign key `page_user_fk` (`page_user_id`) references `users` (`user_id`) ".
			       ") type=innodb";

			$this->database->Execute($sql);
		}

		function Insert()
		{
			$select = "insert into pages (page_number, page_date, page_arti_id, page_user_id) ".
					  "values (".$this->number.", \"".$this->date."\", ".$this->article.", ".$this->user.")";
			$result = $this->database->Execute($select);

			if(mysql_affected_rows() == 1)
			{
				return true;
			}
			return false;
		}
		
		function Update()
		{
			$select = "update pages set page_number = ".$this->number.", ".
					  "page_date = \"".$this->date."\", page_arti_id = ".$this->article.", page_user_id = ".$this->user." ".
					  "where page_id = ".$this->id;
			$result = $this->database->Execute($select);

			if(mysql_affected_rows() == 1)
			{
				return true;
			}
			return false;
		}

		function Delete()
		{
			$select = "delete from pages ".
					  "where page_id = ".$this->id;
			$result = $this->database->Execute($select);

			if(mysql_affected_rows() == 1)
			{
				return true;
			}
			return false;
		}

		function Select()
		{
			$select = "select page_id, page_number, page_date, page_arti_id, page_user_id ".
					  "from pages order by page_arti_id, page_id";

			$result = $this->database->Execute($select);
			return $result;
		}

		function SelectByArticle()
		{
			$select = "select page_id, page_number, page_date, page_arti_id, page_user_id ".
					  "from pages ".
					  "where page_arti_id = ".$this->article." ".
					  "order by page_number";

			$result = $this->database->Execute($select);
			return $result;
		}

		function SelectFirstPageByArticle()
		{
			$select = "select page_id, page_number, page_date, page_arti_id, page_user_id ".
					  "from pages ".
					  "where page_arti_id = ".$this->article." ".
					  "order by page_number";

			$result = $this->database->Execute($select);

			$data = mysql_fetch_array($result);
			
			if($result && mysql_num_rows($result) > 0)
			{
				$this->id = $data["page_id"];
				$this->number = $data["page_number"];
				$this->date = $data["page_date"];
				$this->article = $data["page_arti_id"];
				$this->user = $data["page_user_id"];
				
				return true;
			}

			return false;
		}

		function SelectById()
		{
			$select = "select page_id, page_number, page_date, page_arti_id, page_user_id ".
					  "from pages ".
					  "where page_id = ".$this->id;
			$result = $this->database->Execute($select);
			$data = mysql_fetch_array($result);
			
			if($result && mysql_num_rows($result) > 0)
			{
				$this->id = $data["page_id"];
				$this->number = $data["page_number"];
				$this->date = $data["page_date"];
				$this->article = $data["page_arti_id"];
				$this->user = $data["page_user_id"];
				
				return true;
			}

			return false;
		}
		
		function SelectOrderedByArticleTitleAndPageNumber()
		{
			$select = "select a.page_id, a.page_number, a.page_date, a.page_arti_id, a.page_user_id, b.arti_id, b.arti_title ".
					  "from pages a, articles b ".
					  "where a.page_arti_id = b.arti_id ".
					  "order by b.arti_title, a.page_number";
			$result = $this->database->Execute($select);
			
			return $result;
		}
		
		function SelectNextNumber()
		{
			$select = "select max(page_number) next_number ".
					  "from pages ".
					  "where page_arti_id = ".$this->article;
			$result = $this->database->Execute($select);
			$data = mysql_fetch_array($result);
			
			if($result && mysql_num_rows($result) > 0)
			{
				$number = "";
				$this->number = $data["next_number"];
				$number = $this->number + 1;
				
				return $number;
			}

			return 0;
		}

		function SelectPrevious()
		{
			$ret_value = 0;
			
			if($this->number != 1)
			{
				$select = "select page_id, page_number ".
						  "from pages ".
						  "where page_number < ".$this->number." ".
						  "and page_arti_id = ".$this->article." ".
						  "order by page_number desc";
				$result = $this->database->Execute($select);
				$data = mysql_fetch_array($result);
				
				if($result && mysql_num_rows($result) > 0)
				{
					$ret_value = $data["page_id"];
				}
			}
			else
			{
				$ret_value = 0;
			}

			return $ret_value;
		}

		function SelectNext()
		{
			$ret_value = 0;
			
			$select = "select count(*) length ".
					  "from pages ".
					  "where page_arti_id = ".$this->article;
					  
			$result = $this->database->Execute($select);
			$data = $this->database->FetchArray($result);
			
			if($this->number < $data["length"])
			{
				$select = "select page_id, page_number ".
						  "from pages ".
						  "where page_number > ".$this->number." ".
						  "and page_arti_id = ".$this->article." ".
						  "order by page_number asc";
				$result = $this->database->Execute($select);
				$data = mysql_fetch_array($result);
				
				if($result && mysql_num_rows($result) > 0)
				{
					$ret_value = $data["page_id"];
				}
			}
			else
			{
				$ret_value = 0;
			}

			return $ret_value;
		}

		function SetId($id)
		{
			$this->id = $id;
		}

		function SetNumber($number)
		{
			$this->number = $number;
		}

		function SetDate($date)
		{
			$this->date = $date;
		}

		function SetArticle($article)
		{
			$this->article = $article;
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

		function GetNumber()
		{
			return $this->number;
		}

		function GetDate()
		{
			return $this->date;
		}

		function GetArticle()
		{
			return $this->article;
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