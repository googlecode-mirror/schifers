<?php

	/*
	* cdProfile.php
	*
	* Profiles.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: August 02, 2007
	*/


	class Profile
	{
		var $id;
		var $name;

		var $database;
		
		function Drop()
		{
			$sql = "DROP TABLE IF EXISTS profiles";

			$this->database->Execute($sql);
		}

		function Backup($handle1, $handle2)
		{
			$result = $this->Select();

			while($data = $this->database->FetchArray($result))
			{
				fwrite($handle1, "<?php\n");

				fwrite($handle1, "	\$select = \"insert into profiles (prof_id, prof_name) \".\n");
				fwrite($handle1, "			  \"values (".$data["prof_id"].", \\\"".$data["prof_name"]."\\\")\";\n");
				fwrite($handle1, "	\$result = \$database->Execute(\$select);\n");

				fwrite($handle1, "?>\n");

				fwrite($handle2, "<?php\n");

				fwrite($handle2, "	\$select = \"insert into profiles (prof_id, prof_name) \".\n");
				fwrite($handle2, "			  \"values (".$data["prof_id"].", \\\"".$data["prof_name"]."\\\")\";\n");
				fwrite($handle2, "	\$result = \$database->Execute(\$select);\n");

				fwrite($handle2, "?>\n");
			}
		}

		function Create()
		{
			$sql = "DROP TABLE IF EXISTS profiles";

			$this->database->Execute($sql);

			$sql = "CREATE TABLE profiles ( ".
				   "prof_id integer not null auto_increment, ".
				   "prof_name varchar(50) not null, ".
			       "primary key (prof_id) ".
			       ") type=innodb";

			$this->database->Execute($sql);
		}

		function Insert()
		{
			$select = "insert into profiles (prof_name) ".
					  "values (\"".$this->name."\")";
			$result = $this->database->Execute($select);

			if(mysql_affected_rows() == 1)
			{
				return true;
			}
			return false;
		}
		
		function Update()
		{
			$select = "update profiles set prof_name = ".$this->name." ".
					  "where prof_id = ".$this->id;
			$result = $this->database->Execute($select);

			if(mysql_affected_rows() == 1)
			{
				return true;
			}
			return false;
		}

		function Delete()
		{
			$select = "delete from profiles ".
					  "where prof_id = ".$this->id;
			$result = $this->database->Execute($select);

			if(mysql_affected_rows() == 1)
			{
				return true;
			}
			return false;
		}

		function Select()
		{
			$select = "select prof_id, prof_name ".
					  "from profiles order by prof_name";

			$result = $this->database->Execute($select);
			return $result;
		}

		function SelectById()
		{
			$select = "select prof_name ".
					  "from profiles ".
					  "where prof_id = ".$this->id;

			$result = $this->database->Execute($select);
			$data = mysql_fetch_array($result);
			
			if($result && mysql_num_rows($result) > 0)
			{
				$this->name = $data["prof_name"];
				
				return true;
			}

			return false;
		}

		function SelectByName()
		{
			$select = "select prof_id ".
					  "from profiles ".
					  "where prof_name = \"".$this->name."\"";

			$result = $this->database->Execute($select);
			$data = mysql_fetch_array($result);
			
			if($result && mysql_num_rows($result) > 0)
			{
				$this->id = $data["prof_id"];

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

		function GetDatabase()
		{
			return $this->database;
		}
	};

?>