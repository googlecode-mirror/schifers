<?php

	/*
	* cdMenu.php
	*
	* Menus.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: August 02, 2007
	*/


	class Menu
	{
		var $id;
		var $name;

		var $database;
		
		function Drop()
		{
			$sql = "DROP TABLE IF EXISTS menus";

			$this->database->Execute($sql);
		}

		function Backup($handle1, $handle2)
		{
			$result = $this->Select();
			
			while($data = $this->database->FetchArray($result))
			{
				fwrite($handle1, "<?php\n");

				fwrite($handle1, "	\$select = \"insert into menus (menu_id, menu_name) \".\n");
				fwrite($handle1, "			  \"values (".$data["menu_id"].", \\\"".$data["menu_name"]."\\\")\";\n");
				fwrite($handle1, "	\$result = \$database->Execute(\$select);\n");

				fwrite($handle1, "?>\n");

				fwrite($handle2, "<?php\n");

				fwrite($handle2, "	\$select = \"insert into menus (menu_id, menu_name) \".\n");
				fwrite($handle2, "			  \"values (".$data["menu_id"].", \\\"".$data["menu_name"]."\\\")\";\n");
				fwrite($handle2, "	\$result = \$database->Execute(\$select);\n");

				fwrite($handle2, "?>\n");
			}
		}

		function Create()
		{
			$sql = "DROP TABLE IF EXISTS menus";

			$this->database->Execute($sql);

			$sql = "CREATE TABLE menus ( ".
				   "menu_id integer not null auto_increment, ".
				   "menu_name varchar(50) not null, ".
			       "primary key (menu_id) ".
			       ") type=innodb";

			$this->database->Execute($sql);
		}

		function Insert()
		{
			$select = "insert into menus (menu_name) ".
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
			$select = "update menus set menu_name = \"".$this->name."\" ".
					  "where menu_id = ".$this->id;
			$result = $this->database->Execute($select);

			if(mysql_affected_rows() == 1)
			{
				return true;
			}
			return false;
		}

		function Delete()
		{
			$select = "delete from menus ".
					  "where menu_id = ".$this->id;
			$result = $this->database->Execute($select);

			if(mysql_affected_rows() == 1)
			{
				return true;
			}
			return false;
		}

		function Select()
		{
			$select = "select menu_id, menu_name ".
					  "from menus order by menu_name";

			$result = $this->database->Execute($select);
			return $result;
		}
		
		function SelectById()
		{
			$select = "select menu_name ".
					  "from menus ".
					  "where menu_id = ".$this->id;

			$result = $this->database->Execute($select);
			$data = mysql_fetch_array($result);
			
			if($result && mysql_num_rows($result) > 0)
			{
				$this->name = $data["menu_name"];
				
				return true;
			}

			return false;
		}

		function SelectByName()
		{
			$select = "select menu_id ".
					  "from menus ".
					  "where menu_name = \"".$this->name."\"";

			$result = $this->database->Execute($select);
			$data = mysql_fetch_array($result);
			
			if($result && mysql_num_rows($result) > 0)
			{
				$this->id = $data["menu_id"];

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