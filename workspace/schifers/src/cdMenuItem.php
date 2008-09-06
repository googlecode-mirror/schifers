<?php

	/*
	* cdMenuItem.php
	*
	* MenuItems.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: August 09, 2007
	*/


	class MenuItem
	{
		var $id;
		var $module;
		var $menu;
		var $order;

		var $database;
		
		function Drop()
		{
			$sql = "DROP TABLE IF EXISTS menu_itens";

			$this->database->Execute($sql);
		}

		function Backup($handle1, $handle2)
		{
			$result = $this->Select();

			while($data = $this->database->FetchArray($result))
			{
				fwrite($handle1, "<?php\n");

				fwrite($handle1, "	\$select = \"insert into menu_itens (mnit_id, mnit_order, mnit_modu_id, mnit_menu_id) \".\n");
				fwrite($handle1, "			  \"values (".$data["mnit_id"].", ".$data["mnit_order"].", ".$data["mnit_modu_id"].", ".$data["mnit_menu_id"].")\";\n");
				fwrite($handle1, "	\$result = \$database->Execute(\$select);\n");

				fwrite($handle1, "?>\n");

				fwrite($handle2, "<?php\n");

				fwrite($handle2, "	\$select = \"insert into menu_itens (mnit_id, mnit_order, mnit_modu_id, mnit_menu_id) \".\n");
				fwrite($handle2, "			  \"values (".$data["mnit_id"].", ".$data["mnit_order"].", ".$data["mnit_modu_id"].", ".$data["mnit_menu_id"].")\";\n");
				fwrite($handle2, "	\$result = \$database->Execute(\$select);\n");

				fwrite($handle2, "?>\n");
			}
		}

		function Create()
		{
			$sql = "DROP TABLE IF EXISTS menu_itens";

			$this->database->Execute($sql);

			$sql = "CREATE TABLE menu_itens ( ".
				   "mnit_id integer not null auto_increment, ".
				   "mnit_order integer not null, ".
				   "mnit_modu_id integer not null, ".
				   "mnit_menu_id integer not null, ".
			       "primary key (mnit_id), ".
				   "constraint `mnit_modu_fk` foreign key `mnit_modu_fk` (`mnit_modu_id`) references `modules` (`modu_id`), ".
				   "constraint `mnit_menu_fk` foreign key `mnit_menu_fk` (`mnit_menu_id`) references `menus` (`menu_id`) ".
			       ") type=innodb";

			$this->database->Execute($sql);
		}

		function Insert()
		{
			$select = "insert into menu_itens (mnit_order, mnit_modu_id, mnit_menu_id) ".
					  "values (".$this->order.", ".$this->module.", ".$this->menu.")";
			$result = $this->database->Execute($select);

			if(mysql_affected_rows() == 1)
			{
				return true;
			}
			return false;
		}
		
		function Update()
		{
			$select = "update menu_itens set mnit_order = ".$this->order.", mnit_modu_id = ".$this->module.", mnit_menu_id = ".$this->menu." ".
					  "where mnit_id = ".$this->id;
			$result = $this->database->Execute($select);

			if(mysql_affected_rows() == 1)
			{
				return true;
			}
			return false;
		}

		function Delete()
		{
			$select = "delete from menu_itens ".
					  "where mnit_id = ".$this->id;
			$result = $this->database->Execute($select);

			if(mysql_affected_rows() == 1)
			{
				return true;
			}
			return false;
		}

		function Select()
		{
			$select = "select mnit_id, mnit_order, mnit_modu_id, mnit_menu_id ".
					  "from menu_itens order by mnit_order";

			$result = $this->database->Execute($select);
			return $result;
		}
		
		function SelectOrderBy()
		{
			$select = "select mnit_id, mnit_order, mnit_modu_id, mnit_menu_id ".
					  "from menu_itens a, menus b, modules c ".
					  "where a.mnit_modu_id = c.modu_id ".
					  "and a.mnit_menu_id = b.menu_id ".
					  "order by b.menu_name, c.modu_name";

			$result = $this->database->Execute($select);
			return $result;
		}

		function SelectById()
		{
			$select = "select mnit_order, mnit_modu_id, mnit_menu_id ".
					  "from menu_itens ".
					  "where mnit_id = ".$this->id;

			$result = $this->database->Execute($select);
			$data = mysql_fetch_array($result);
			
			if($result && mysql_num_rows($result) > 0)
			{
				$this->order = $data["mnit_order"];
				$this->module = $data["mnit_modu_id"];
				$this->menu = $data["mnit_menu_id"];
				
				return true;
			}

			return false;
		}

		function SetId($id)
		{
			$this->id = $id;
		}

		function SetOrder($order)
		{
			$this->order = $order;
		}

		function SetModule($module)
		{
			$this->module = $module;
		}

		function SetMenu($menu)
		{
			$this->menu = $menu;
		}

		function SetDatabase($database)
		{
			$this->database = $database;
		}

		function GetId()
		{
			return $this->id;
		}

		function GetOrder()
		{
			return $this->order;
		}

		function GetModule()
		{
			return $this->module;
		}

		function GetMenu()
		{
			return $this->menu;
		}

		function GetDatabase()
		{
			return $this->database;
		}
	};

?>