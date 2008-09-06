<?php

	/*
	* cdArticle.php
	*
	* Articles.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: August 02, 2007
	*/


	class Article
	{
		var $id;
		var $title;
		var $date;
		var $user;
		var $subject;

		var $database;
		
		function Drop()
		{
			$sql = "DROP TABLE IF EXISTS articles";

			$this->database->Execute($sql);
		}

		function Backup($handle1, $handle2)
		{
			$result = $this->Select();
			
			while($data = $this->database->FetchArray($result))
			{
				fwrite($handle1, "<?php\n");

				fwrite($handle1, "	\$select = \"insert into articles (arti_id, arti_title, arti_date, arti_user_id, arti_subj_id) \".\n");
				fwrite($handle1, "			  \"values (".$data["arti_id"].", \\\"".$data["arti_title"]."\\\", \\\"".$data["arti_date"]."\\\", ".$data["arti_user_id"].", ".$data["arti_subj_id"].")\";\n");
				fwrite($handle1, "	\$result = \$database->Execute(\$select);\n");

				fwrite($handle1, "?>\n");

				fwrite($handle2, "<?php\n");

				fwrite($handle2, "	\$select = \"insert into articles (arti_id, arti_title, arti_date, arti_user_id, arti_subj_id) \".\n");
				fwrite($handle2, "			  \"values (".$data["arti_id"].", \\\"".$data["arti_title"]."\\\", \\\"".$data["arti_date"]."\\\", ".$data["arti_user_id"].", ".$data["arti_subj_id"].")\";\n");
				fwrite($handle2, "	\$result = \$database->Execute(\$select);\n");

				fwrite($handle2, "?>\n");
			}
		}

		function Create()
		{
			$sql = "DROP TABLE IF EXISTS articles";

			$this->database->Execute($sql);

			$sql = "CREATE TABLE articles ( ".
				   "arti_id integer not null auto_increment, ".
				   "arti_title varchar(50) not null, ".
				   "arti_date datetime not null, ".
				   "arti_user_id integer not null, ".
				   "arti_subj_id integer not null, ".
			       "primary key (arti_id), ".
				   "constraint `arti_user_fk` foreign key `arti_user_fk` (`arti_user_id`) references `users` (`user_id`), ".
				   "constraint `arti_subj_fk` foreign key `arti_subj_fk` (`arti_subj_id`) references `subjects` (`subj_id`) ".
			       ") type=innodb";

			$this->database->Execute($sql);
		}

		function Insert()
		{
			$select = "insert into articles (arti_title, arti_date, arti_user_id, arti_subj_id) ".
					  "values (\"".$this->title."\", \"".$this->date."\", ".$this->user.", ".$this->subject.")";
			$result = $this->database->Execute($select);

			if(mysql_affected_rows() == 1)
			{
				return true;
			}
			return false;
		}
		
		function Update()
		{
			$select = "update articles set arti_title = \"".$this->title."\" ".
					  "arti_date = \"".$this->date."\", arti_user_id = ".$this->user.", arti_subj_id = ".$this->subject." ".
					  "where arti_id = ".$this->id;
			$result = $this->database->Execute($select);

			if(mysql_affected_rows() == 1)
			{
				return true;
			}
			return false;
		}

		function Delete()
		{
			$select = "delete from articles ".
					  "where arti_id = ".$this->id;
			$result = $this->database->Execute($select);

			if(mysql_affected_rows() == 1)
			{
				return true;
			}
			return false;
		}

		function Select()
		{
			$select = "select arti_id, arti_title, arti_date, arti_user_id, arti_subj_id ".
					  "from articles order by arti_title";

			$result = $this->database->Execute($select);
			return $result;
		}
		
		function SelectById()
		{
			$select = "select arti_title, arti_date, arti_user_id, arti_subj_id ".
					  "from articles ".
					  "where arti_id = ".$this->id;

			$result = $this->database->Execute($select);
			$data = mysql_fetch_array($result);
			
			if($result && mysql_num_rows($result) > 0)
			{
				$this->title = $data["arti_title"];
				$this->date = $data["arti_date"];
				$this->user = $data["arti_user_id"];
				$this->subject = $data["arti_subj_id"];
				
				return true;
			}

			return false;
		}

		function SelectLastArticle()
		{
			$select = "select arti_id, arti_title, arti_date, arti_user_id, arti_subj_id ".
					  "from articles ".
					  "order by arti_date desc";

			$result = $this->database->Execute($select);
			$data = mysql_fetch_array($result);
			
			if($result && mysql_num_rows($result) > 0)
			{
				$this->id = $data["arti_id"];
				$this->title = $data["arti_title"];
				$this->date = $data["arti_date"];
				$this->user = $data["arti_user_id"];
				$this->subject = $data["arti_subj_id"];
				
				return true;
			}

			return false;
		}

		function SelectLastArticleByArea($id)
		{
			$select = "select a.arti_id, a.arti_title, a.arti_date, a.arti_user_id, a.arti_subj_id ".
					  "from articles a, subjects b ".
					  "where a.arti_subj_id = b.subj_id ".
					  "and b.subj_area_id = ".$id." ".
					  "order by a.arti_date desc";
					  
			$result = $this->database->Execute($select);
			$data = mysql_fetch_array($result);
			
			if($result && mysql_num_rows($result) > 0)
			{
				$this->id = $data["arti_id"];
				$this->title = $data["arti_title"];
				$this->date = $data["arti_date"];
				$this->user = $data["arti_user_id"];
				$this->subject = $data["arti_subj_id"];
				
				return true;
			}

			return false;
		}

		function SelectLastArticleByUserAndMenuName($user_id, $menu_name)
		{
			$grupo0 = "";
			$grupo1 = "";

			$select = "select f.modu_nick ".
					  "from menus d, menu_itens e, modules f ".
					  "where d.menu_name = \"".$menu_name."\" ".
					  "and d.menu_id = e.mnit_menu_id ".
					  "and e.mnit_modu_id = f.modu_id ";
			
			$result0 = $this->database->Execute($select);
			while($data0 = mysql_fetch_array($result0))
			{
				$grupo0 = $grupo0."\"".$data0["modu_nick"]."\", ";
			}
			
			$grupo0 = substr($grupo0, 0, strlen($grupo0) - 2);

			$select = "select j.modu_nick ".
					  "from users g, roles h, brun14.privileges i, modules j ".
					  "where g.user_id = ".$user_id." ".
					  "and g.user_id = h.role_user_id ".
					  "and h.role_prof_id = i.priv_prof_id ".
					  "and i.priv_modu_id = j.modu_id ";

			$result1 = $this->database->Execute($select);
			while($data1 = mysql_fetch_array($result1))
			{
				$grupo1 = $grupo1."\"".$data1["modu_nick"]."\", ";
			}

			$grupo1 = substr($grupo1, 0, strlen($grupo1) - 2);

			// it gets the last document from the projects the user has access
			$select = "select a.arti_id, a.arti_title, a.arti_date, a.arti_user_id, a.arti_subj_id ".
					  "from  articles a, subjects b, areas c ".
					  "where a.arti_subj_id = b.subj_id ".
					  "and b.subj_area_id = c.area_id ".
					  "and c.area_name in ( ".$grupo0.
					  ") ".
					  "and c.area_name in ( ".$grupo1.
					  " ) ".
					  "    order by a.arti_date desc ";

			$result = $this->database->Execute($select);
			$data = mysql_fetch_array($result);
			
			if($result && mysql_num_rows($result) > 0)
			{
				$this->id = $data["arti_id"];
				$this->title = $data["arti_title"];
				$this->date = $data["arti_date"];
				$this->user = $data["arti_user_id"];
				$this->subject = $data["arti_subj_id"];
				
				return true;
			}

			return false;
		}

		function SelectBySubject()
		{
			$select = "select arti_id, arti_title, arti_date, arti_user_id, arti_subj_id ".
					  "from articles ".
					  "where arti_subj_id = ".$this->subject." ".
					  "order by arti_title";

			$result = $this->database->Execute($select);
			
			return $result;
		}

		function SetId($id)
		{
			$this->id = $id;
		}

		function SetTitle($title)
		{
			$this->title = $title;
		}

		function SetDate($date)
		{
			$this->date = $date;
		}

		function SetUser($user)
		{
			$this->user = $user;
		}

		function SetSubject($subject)
		{
			$this->subject = $subject;
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

		function GetDate()
		{
			return $this->date;
		}

		function GetUser()
		{
			return $this->user;
		}

		function GetSubject()
		{
			return $this->subject;
		}

		function GetDatabase()
		{
			return $this->database;
		}
	};

?>