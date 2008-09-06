<?php

	/*
	* cdParagraph.php
	*
	* Paragraphs.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: August 02, 2007
	*/


	class Paragraph
	{
		var $id;
		var $text;
		var $date;
		var $order;
		var $page;
		var $user;

		var $database;
		
		function Drop()
		{
			$sql = "DROP TABLE IF EXISTS paragraphs";

			$this->database->Execute($sql);
		}

		function Backup($handle1, $handle2)
		{
			$result = $this->Select();

			while($data = $this->database->FetchArray($result))
			{
				fwrite($handle1, "<?php\n");

				fwrite($handle1, "	\$select = \"insert into paragraphs (para_id, para_text, para_date, para_order, para_page_id, para_user_id) \".\n");
				fwrite($handle1, "			  \"values (".$data["para_id"].", \\\"".str_replace("\n", "\\n", $data["para_text"])."\\\", \\\"".$data["para_date"]."\\\", ".$data["para_order"].", ".$data["para_page_id"].", ".$data["para_user_id"].")\";\n");
				fwrite($handle1, "	\$result = \$database->Execute(\$select);\n");

				fwrite($handle1, "?>\n");

				fwrite($handle2, "<?php\n");

				fwrite($handle2, "	\$select = \"insert into paragraphs (para_id, para_text, para_date, para_order, para_page_id, para_user_id) \".\n");
				fwrite($handle2, "			  \"values (".$data["para_id"].", \\\"".str_replace("\n", "\\n", $data["para_text"])."\\\", \\\"".$data["para_date"]."\\\", ".$data["para_order"].", ".$data["para_page_id"].", ".$data["para_user_id"].")\";\n");
				fwrite($handle2, "	\$result = \$database->Execute(\$select);\n");

				fwrite($handle2, "?>\n");
			}
		}

		function Create()
		{
			$sql = "DROP TABLE IF EXISTS paragraphs";

			$this->database->Execute($sql);

			$sql = "CREATE TABLE paragraphs ( ".
				   "para_id integer not null auto_increment, ".
				   "para_text text not null, ".
				   "para_date datetime not null, ".
				   "para_order integer not null, ".
				   "para_page_id integer not null, ".
				   "para_user_id integer not null, ".
			       "primary key (para_id), ".
				   "constraint `para_page_fk` foreign key `para_page_fk` (`para_page_id`) references `pages` (`page_id`), ".
				   "constraint `para_user_fk` foreign key `para_user_fk` (`para_user_id`) references `users` (`user_id`) ".
			       ") type=innodb";

			$this->database->Execute($sql);
		}

		function Insert()
		{
			$select = "insert into paragraphs (para_text, para_date, para_order, para_page_id, para_user_id) ".
					  "values (\"".$this->text."\", \"".$this->date."\", ".$this->order.", ".$this->page.", ".$this->user.")";

			$result = $this->database->Execute($select);

			if(mysql_affected_rows() == 1)
			{
				return true;
			}
			return false;
		}
		
		function Update()
		{
			$select = "update paragraphs set para_text = \"".$this->text."\", ".
					  "para_date = \"".$this->date."\", para_order = ".$this->order.", para_page_id = ".$this->page.", para_user_id = ".$this->user." ".
					  "where para_id = ".$this->id;
			$result = $this->database->Execute($select);

			if(mysql_affected_rows() == 1)
			{
				return true;
			}
			return false;
		}

		function Delete()
		{
			$select = "delete from paragraphs ".
					  "where para_id = ".$this->id;
			$result = $this->database->Execute($select);

			if(mysql_affected_rows() == 1)
			{
				return true;
			}
			return false;
		}

		function Select()
		{
			$select = "select para_id, para_text, para_date, para_order, para_page_id, para_user_id ".
					  "from paragraphs order by para_page_id, para_id";

			$result = $this->database->Execute($select);
			return $result;
		}

		function SelectByPage()
		{
			$select = "select para_id, para_text, para_date, para_order, para_page_id, para_user_id ".
					  "from paragraphs ".
					  "where para_page_id = ".$this->page." ".
					  "order by para_order";

			$result = $this->database->Execute($select);
			return $result;
		}

		function SelectById()
		{
			$select = "select para_id, para_text, para_date, para_order, para_page_id, para_user_id ".
					  "from paragraphs ".
					  "where para_id = ".$this->id;
			$result = $this->database->Execute($select);
			$data = mysql_fetch_array($result);
			
			if($result && mysql_num_rows($result) > 0)
			{
				$this->id = $data["para_id"];
				$this->text = $data["para_text"];
				$this->date = $data["para_date"];
				$this->order = $data["para_order"];
				$this->page = $data["para_page_id"];
				$this->user = $data["para_user_id"];
				
				return true;
			}

			return false;
		}
		
		function SelectNextOrder()
		{
			$select = "select max(para_order) next_order ".
					  "from paragraphs ".
					  "where para_page_id = ".$this->page;
			$result = $this->database->Execute($select);
			$data = mysql_fetch_array($result);
			
			if($result && mysql_num_rows($result) > 0)
			{
				$order = "";
				$this->order = $data["next_order"];
				$order = $this->order + 1;
				
				return $order;
			}

			return 0;
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

		function SetOrder($order)
		{
			$this->order = $order;
		}

		function SetPage($page)
		{
			$this->page = $page;
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

		function GetOrder()
		{
			return $this->order;
		}

		function GetPage()
		{
			return $this->page;
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