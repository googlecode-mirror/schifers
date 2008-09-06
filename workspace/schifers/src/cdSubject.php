<?php

	/*
	* cdSubject.php
	*
	* Subjects.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: May 26, 2008
	*/


	class Subject
	{
		var $id;
		var $name;
		var $area;

		var $database;
		
		function Drop()
		{
			$sql = "DROP TABLE IF EXISTS subjects";

			$this->database->Execute($sql);
		}

		function Backup($handle1, $handle2)
		{
			$result = $this->Select();

			while($data = $this->database->FetchArray($result))
			{
				fwrite($handle1, "<?php\n");

				fwrite($handle1, "	\$select = \"insert into subjects (subj_id, subj_name, subj_area_id) \".\n");
				fwrite($handle1, "			  \"values (".$data["subj_id"].", \\\"".$data["subj_name"]."\\\", ".$data["subj_area_id"].")\";\n");
				fwrite($handle1, "	\$result = \$database->Execute(\$select);\n");

				fwrite($handle1, "?>\n");

				fwrite($handle2, "<?php\n");

				fwrite($handle2, "	\$select = \"insert into subjects (subj_id, subj_name, subj_area_id) \".\n");
				fwrite($handle2, "			  \"values (".$data["subj_id"].", \\\"".$data["subj_name"]."\\\", ".$data["subj_area_id"].")\";\n");
				fwrite($handle2, "	\$result = \$database->Execute(\$select);\n");

				fwrite($handle2, "?>\n");
			}
		}

		function Create()
		{
			$sql = "DROP TABLE IF EXISTS subjects";

			$this->database->Execute($sql);

			$sql = "CREATE TABLE subjects ( ".
				   "subj_id integer not null auto_increment, ".
				   "subj_name varchar(50) not null, ".
				   "subj_area_id integer not null, ".
			       "primary key (subj_id), ".
				   "constraint subj_area_fk foreign key (subj_area_id) references areas(area_id) ".
			       ") type=innodb";

			$this->database->Execute($sql);
		}

		function Insert()
		{
			$select = "insert into subjects (subj_name, subj_area_id) ".
					  "values (\"".$this->name."\", ".$this->area.")";
			$result = $this->database->Execute($select);

			if(mysql_affected_rows() == 1)
			{
				return true;
			}
			return false;
		}
		
		function Update()
		{
			$select = "update subjects set subj_name = \"".$this->name."\", subj_area_id = ".$this->area." ".
					  "where subj_id = ".$this->id;
			$result = $this->database->Execute($select);

			if(mysql_affected_rows() == 1)
			{
				return true;
			}
			return false;
		}

		function Delete()
		{
			$select = "delete from subjects ".
					  "where subj_id = ".$this->id;
			$result = $this->database->Execute($select);

			if(mysql_affected_rows() == 1)
			{
				return true;
			}
			return false;
		}

		function Select()
		{
			$select = "select subj_id, subj_name, subj_area_id ".
					  "from subjects order by subj_name";

			$result = $this->database->Execute($select);
			return $result;
		}
		
		function SelectByArea()
		{
			$select = "select subj_id, subj_name, subj_area_id ".
					  "from subjects ".
					  "where subj_area_id = ".$this->area." ".
					  "order by subj_name";

			$result = $this->database->Execute($select);
			return $result;
		}
		
		function SelectById()
		{
			$select = "select subj_name ".
					  "from subjects ".
					  "where subj_id = ".$this->id;

			$result = $this->database->Execute($select);
			$data = mysql_fetch_array($result);
			
			if($result && mysql_num_rows($result) > 0)
			{
				$this->name = $data["subj_name"];
				
				return true;
			}

			return false;
		}

		function SelectByName()
		{
			$select = "select subj_id ".
					  "from subjects ".
					  "where subj_name = \"".$this->name."\"";

			$result = $this->database->Execute($select);
			$data = mysql_fetch_array($result);
			
			if($result && mysql_num_rows($result) > 0)
			{
				$this->id = $data["subj_id"];

				return true;
			}

			return false;
		}
		
		function SetId($id)
		{
			$this->id = $id;
		}

		function SetName($name)
		{
			$this->name = $name;
		}

		function SetArea($area)
		{
			$this->area = $area;
		}

		function SetDatabase($database)
		{
			$this->database = $database;
		}

		function GetId()
		{
			return $this->id;
		}

		function GetName()
		{
			return $this->name;
		}

		function GetArea()
		{
			return $this->area;
		}

		function GetDatabase()
		{
			return $this->database;
		}
	};

?>