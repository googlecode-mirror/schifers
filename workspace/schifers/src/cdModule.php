<?php

	/*
	* cdModule.php
	*
	* Modules.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: August 02, 2007
	*/


	class Module
	{
		var $id;
		var $nick;
		var $name;
		var $url;

		var $database;
		
		function Drop()
		{
			$sql = "DROP TABLE IF EXISTS modules";

			$this->database->Execute($sql);
		}

		function Backup($handle1, $handle2)
		{
			$result = $this->Select();

			while($data = $this->database->FetchArray($result))
			{
				fwrite($handle1, "<?php\n");

				fwrite($handle1, "	\$select = \"insert into modules (modu_id, modu_nick, modu_name, modu_url) \".\n");
				fwrite($handle1, "			  \"values (".$data["modu_id"].", \\\"".$data["modu_nick"]."\\\", \\\"".$data["modu_name"]."\\\", \\\"".$data["modu_url"]."\\\")\";\n");
				fwrite($handle1, "	\$result = \$database->Execute(\$select);\n");

				fwrite($handle1, "?>\n");

				fwrite($handle2, "<?php\n");

				fwrite($handle2, "	\$select = \"insert into modules (modu_id, modu_nick, modu_name, modu_url) \".\n");
				fwrite($handle2, "			  \"values (".$data["modu_id"].", \\\"".$data["modu_nick"]."\\\", \\\"".$data["modu_name"]."\\\", \\\"".$data["modu_url"]."\\\")\";\n");
				fwrite($handle2, "	\$result = \$database->Execute(\$select);\n");

				fwrite($handle2, "?>\n");
			}
		}

		function Create()
		{
			$sql = "DROP TABLE IF EXISTS modules";

			$this->database->Execute($sql);

			$sql = "CREATE TABLE modules ( ".
				   "modu_id integer not null auto_increment, ".
				   "modu_nick varchar(50) not null, ".
				   "modu_name varchar(50) not null, ".
			       "modu_url varchar(100) not null, ".
			       "primary key (modu_id) ".
			       ") type=innodb";

			$this->database->Execute($sql);
		}

		function Insert()
		{
			$select = "insert into modules (modu_nick, modu_name, modu_url) ".
					  "values (\"".$this->nick."\", \"".$this->name."\", \"".$this->url."\")";
			
			$result = $this->database->Execute($select);

			if(mysql_affected_rows() == 1)
			{
				return true;
			}
			return false;
		}
		
		function Update()
		{
			$select = "update modules set modu_nick = \"".$this->nick."\", modu_name = \"".$this->name."\", modu_url = \"".$this->url."\" ".
					  "where modu_id = ".$this->id;

			$result = $this->database->Execute($select);

			if(mysql_affected_rows() == 1)
			{
				return true;
			}
			return false;
		}

		function Delete()
		{
			$select = "delete from modules ".
					  "where modu_id = ".$this->id;
					  
			$result = $this->database->Execute($select);

			if(mysql_affected_rows() == 1)
			{
				return true;
			}
			return false;
		}

		function Select()
		{
			$select = "select modu_id, modu_nick, modu_name, modu_url ".
					  "from modules order by modu_name";

			$result = $this->database->Execute($select);
			return $result;
		}
		
		function SelectById()
		{
			$select = "select modu_nick, modu_name, modu_url ".
					  "from modules ".
					  "where modu_id = ".$this->id;

			$result = $this->database->Execute($select);
			$data = mysql_fetch_array($result);
			
			if($result && mysql_num_rows($result) > 0)
			{
				$this->nick = $data["modu_nick"];
				$this->name = $data["modu_name"];
				$this->url = $data["modu_url"];
				
				return true;
			}

			return false;
		}

		function SelectByNick()
		{
			$select = "select modu_id, modu_nick, modu_name, modu_url ".
					  "from modules ".
					  "where modu_nick = \"".$this->nick."\"";

			$result = $this->database->Execute($select);
			$data = mysql_fetch_array($result);
			
			if($result && mysql_num_rows($result) > 0)
			{
				$this->id = $data["modu_id"];
				$this->nick = $data["modu_nick"];
				$this->name = $data["modu_name"];
				$this->url = $data["modu_url"];

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

		function SetNick($nick)
		{
			$this->nick = $nick;
		}

		function SetUrl($url)
		{
			$this->url = $url;
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

		function GetNick()
		{
			return $this->nick;
		}

		function GetUrl()
		{
			return $this->url;
		}

		function GetDatabase()
		{
			return $this->database;
		}
	};

?>