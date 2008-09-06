<?php

	/*
	* cdMenuBuilder.php
	*
	* MenuBuilder.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: August 09, 2007
	*/


	define("ORDER_BY_NAME", 0);
	define("ORDER_BY_ORDER", 1);
	

	class MenuBuilder
	{
		var $name;

		var $menu;
		var $user;
		var $order;

		var $database;

		function Build()
		{
			if($this->name != "")
			{
				$menu = new Menu();

				$menu->SetDatabase($this->database);
				$menu->SetName($this->name);
				
				$order = "c.modu_name";

				if($this->order == ORDER_BY_ORDER)
				{
					$order = "a.mnit_order";
				}
				else
				{
					$order = "c.modu_name";
				}

				if($menu->SelectByName())
				{
					$select = "select c.modu_name, c.modu_url ".
							  "from menu_itens a, menus b , modules c ".
							  "where a.mnit_menu_id = b.menu_id ".
							  "and b.menu_name = \"".$this->name."\" ".
							  "and c.modu_id = a.mnit_modu_id ".
							  "order by ".$order;
					
					$result = $this->database->Execute($select);
					return $result;
				}
			}
			return false;
		}
		
		function GetScreenName()
		{
			$select = "select menu_name ".
					  "from menus ".
					  "where menu_name = \"".$this->name."\"";

			$result = $this->database->Execute($select);
			$data = $this->database->FetchArray($result);
			
			return $data["menu_name"];
		}

		function SetName($name)
		{
			$this->name = $name;
		}

		function SetMenu($menu)
		{
			$this->menu = menu;
		}

		function SetUser($user)
		{
			$this->user = $user;
		}
		
		function SetOrder($order)
		{
			$this->order = $order;
		}
		
		function SetDatabase($database)
		{
			$this->database = $database;
		}
		
		function GetName()
		{
			return $this->name;
		}
		
		function GetMenu()
		{
			return $this->menu;
		}
		
		function GetUser()
		{
			return $this->user;
		}
		
		function GetOrder()
		{
			return $this->order;
		}
		
		function GetDatabase()
		{
			return $this->database;
		}
	};

?>