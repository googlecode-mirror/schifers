<?php

	/*
	* cdArea.php
	*
	* Areas.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: May 26, 2008
	*/


	class Area
	{
		var $id;
		var $name;

		var $database;
		
		function Drop()
		{
			$sql = "DROP TABLE IF EXISTS areas";

			$this->database->Execute($sql);
		}

		function Backup($handle1, $handle2)
		{
			$result = $this->Select();

			while($data = $this->database->FetchArray($result))
			{
				fwrite($handle1, "<?php\n");

				fwrite($handle1, "	\$select = \"insert into areas (area_id, area_name) \".\n");
				fwrite($handle1, "			  \"values (".$data["area_id"].", \\\"".$data["area_name"]."\\\")\";\n");
				fwrite($handle1, "	\$result = \$database->Execute(\$select);\n");

				fwrite($handle1, "?>\n");

				fwrite($handle2, "<?php\n");

				fwrite($handle2, "	\$select = \"insert into areas (area_id, area_name) \".\n");
				fwrite($handle2, "			  \"values (".$data["area_id"].", \\\"".$data["area_name"]."\\\")\";\n");
				fwrite($handle2, "	\$result = \$database->Execute(\$select);\n");

				fwrite($handle2, "?>\n");
			}
		}

		function Create()
		{
			$sql = "DROP TABLE IF EXISTS areas";

			$this->database->Execute($sql);

			$sql = "CREATE TABLE areas ( ".
				   "area_id integer not null auto_increment, ".
				   "area_name varchar(50) not null, ".
			       "primary key (area_id) ".
			       ") type=innodb";

			$this->database->Execute($sql);
		}

		function Insert()
		{
			$select = "insert into areas (area_name) ".
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
			$select = "update areas set area_name = \"".$this->name."\" ".
					  "where area_id = ".$this->id;
			$result = $this->database->Execute($select);

			if(mysql_affected_rows() == 1)
			{
				return true;
			}
			return false;
		}

		function Delete()
		{
			$select = "delete from areas ".
					  "where area_id = ".$this->id;
			$result = $this->database->Execute($select);

			if(mysql_affected_rows() == 1)
			{
				return true;
			}
			return false;
		}

		function Select()
		{
			$select = "select area_id, area_name ".
					  "from areas order by area_name";

			$result = $this->database->Execute($select);
			return $result;
		}
		
		function SelectById()
		{
			$select = "select area_name ".
					  "from areas ".
					  "where area_id = ".$this->id;

			$result = $this->database->Execute($select);
			$data = mysql_fetch_array($result);
			
			if($result && mysql_num_rows($result) > 0)
			{
				$this->name = $data["area_name"];
				
				return true;
			}

			return false;
		}

		function SelectByName()
		{
			$select = "select area_id ".
					  "from areas ".
					  "where area_name = \"".$this->name."\"";

			$result = $this->database->Execute($select);
			$data = mysql_fetch_array($result);
			
			if($result && mysql_num_rows($result) > 0)
			{
				$this->id = $data["area_id"];

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