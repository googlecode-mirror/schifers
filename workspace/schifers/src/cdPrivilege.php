<?php

	/*
	* cdPrivilege.php
	*
	* Privileges.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: August 02, 2007
	*/


	class Privilege
	{
		var $id;
		var $profile;
		var $module;

		var $database;
		
		function Drop()
		{
			$sql = "DROP TABLE IF EXISTS brun14.privileges";

			$this->database->Execute($sql);
		}

		function Backup($handle1, $handle2)
		{
			$result = $this->Select();

			while($data = $this->database->FetchArray($result))
			{
				fwrite($handle1, "<?php\n");

				fwrite($handle1, "	\$select = \"insert into brun14.privileges (priv_id, priv_prof_id, priv_modu_id) \".\n");
				fwrite($handle1, "			  \"values (".$data["priv_id"].", ".$data["priv_prof_id"].", ".$data["priv_modu_id"].")\";\n");
				fwrite($handle1, "	\$result = \$database->Execute(\$select);\n");

				fwrite($handle1, "?>\n");

				fwrite($handle2, "<?php\n");

				fwrite($handle2, "	\$select = \"insert into brun14.privileges (priv_id, priv_prof_id, priv_modu_id) \".\n");
				fwrite($handle2, "			  \"values (".$data["priv_id"].", ".$data["priv_prof_id"].", ".$data["priv_modu_id"].")\";\n");
				fwrite($handle2, "	\$result = \$database->Execute(\$select);\n");

				fwrite($handle2, "?>\n");
			}
		}

		function Create()
		{
			$sql = "DROP TABLE IF EXISTS brun14.privileges";

			$this->database->Execute($sql);

			$sql = "CREATE TABLE privileges ( ".
				   "priv_id integer not null auto_increment, ".
				   "priv_prof_id integer not null, ".
				   "priv_modu_id integer not null, ".
			       "primary key (priv_id), ".
				   "constraint `priv_prof_fk` foreign key `priv_prof_fk` (`priv_prof_id`) references `profiles` (`prof_id`), ".
				   "constraint `priv_modu_fk` foreign key `priv_modu_fk` (`priv_modu_id`) references `modules` (`modu_id`) ".
			       ") type=innodb";

			$this->database->Execute($sql);
		}

		function Insert()
		{
			$select = "insert into brun14.privileges (priv_prof_id, priv_modu_id) ".
					  "values (".$this->profile.", ".$this->module.")";
			$result = $this->database->Execute($select);

			if(mysql_affected_rows() == 1)
			{
				return true;
			}
			return false;
		}
		
		function Update()
		{
			$select = "update brun14.privileges set priv_prof_id = ".$this->profile.", priv_modu_id = ".$this->module." ".
					  "where priv_id = ".$this->id;
			$result = $this->database->Execute($select);

			if(mysql_affected_rows() == 1)
			{
				return true;
			}
			return false;
		}

		function Delete()
		{
			$select = "delete from brun14.privileges ".
					  "where priv_id = ".$this->id;
			$result = $this->database->Execute($select);

			if(mysql_affected_rows() == 1)
			{
				return true;
			}
			return false;
		}

		function Select()
		{
			$select = "select priv_id, priv_modu_id, priv_prof_id ".
					  "from brun14.privileges order by priv_id";

			$result = $this->database->Execute($select);
			return $result;
		}

		function SelectCombo()
		{
			$select = "select a.priv_id, a.priv_modu_id, a.priv_prof_id, b.prof_name, c.modu_name ".
					  "from brun14.privileges a, profiles b, modules c ".
					  "where a.priv_prof_id = b.prof_id ".
					  "and a.priv_modu_id = c.modu_id ".
					  "order by b.prof_name, c.modu_name";

			$result = $this->database->Execute($select);
			return $result;
		}

		function SelectById()
		{
			$select = "select priv_prof_id, priv_modu_id ".
					  "from brun14.privileges ".
					  "where priv_id = ".$this->id;

			$result = $this->database->Execute($select);
			$data = mysql_fetch_array($result);
			
			if($result && mysql_num_rows($result) > 0)
			{
				$this->profile = $data["priv_prof_id"];
				$this->module = $data["priv_modu_id"];
				
				return true;
			}

			return false;
		}

		function SetId($id)
		{
			$this->id = $id;
		}

		function SetProfile($profile)
		{
			$this->profile = $profile;
		}

		function SetModule($module)
		{
			$this->module = $module;
		}

		function SetDatabase($database)
		{
			$this->database = $database;
		}

		function GetId()
		{
			return $this->id;
		}

		function GetProfile()
		{
			return $this->profile;
		}

		function GetModule()
		{
			return $this->module;
		}

		function GetDatabase()
		{
			return $this->database;
		}
	};

?>