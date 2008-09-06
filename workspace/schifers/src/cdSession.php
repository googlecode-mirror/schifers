<?php

	/*
	* cdSession.php
	*
	* Sessions.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: August 02, 2007
	*/

	class Session
	{
		var $id;
		var $date_start;
		var $date_last;
		var $active;
		var $ip;
		var $user;

		var $database;
		
		var $logged_in;

		function Authenticate()
		{
			$user = new User();
			
			$user->SetDatabase($this->database);
			
			$this->logged_in = false;

			if(isset($_COOKIE['cookie_userid']) && isset($_COOKIE['cookie_username']) && isset($_COOKIE['cookie_password']))
			{
				$user->SetId($_COOKIE["cookie_userid"]);
				$user->SetUsername($_COOKIE["cookie_username"]);
				$user->SetEncryptedPassword($_COOKIE["cookie_password"]);

				if($user->UserExists())
				{
					if($user->CheckPassword())
					{
						$this->logged_in = true;
					}
				}
			}
		}
		
		function Login($id, $username, $password)
		{
			$active = false;

			$user = new User();
			
			$user->SetDatabase($this->database);
			
			$user->SetUsername($username);
			$user->SetPassword($password);
			if($id == "")
			{
				$user->Encrypt($password);
			}
			else
			{
				$user->SetEncryptedPassword($password);
			}

			$this->logged_in = false;

			if($user->UserExists())
			{
				if($user->CheckPassword())
				{
					$this->logged_in = true;
					$user->SelectByName();
				}
			}

			if($this->logged_in)
			{
				if($user->GetUsername() == "guest")
				{
					$this->logged_in = false;
				}

				if($id != "")
				{
					$this->SetId($id);
					$this->SelectById();
					
					$this->SetUser($user->GetId());

					if($this->Update())
					{
						$this->UnsetCookie();

						$this->SetCookie($user->GetUsername());
					}

					if($this->GetActive())
					{
						$active = true;
					}
				}
				
				if(!$active)
				{
					$this->SetDateStart(date('Y-m-d H:i:s'));
					$this->SetDateLast(date('Y-m-d H:i:s'));
					$this->SetActive(1);
					$this->SetIp($_SERVER['REMOTE_ADDR']);
					$this->SetUser($user->GetId());
					if($this->Insert())
					{
						$this->UnsetCookie();
						$this->SetCookie($user->GetUsername());
						return $this->id;
					}
				}
				else
				{
					$this->SetDateLast(date('Y-m-d H:i:s', time()));

					$this->Update();
					
					return $this->id;
				}
			}
			
			$this->logged_in = false;
			return false;
		}

		function UnsetCookie()
		{
			if(isset($_COOKIE['cookie_userid']) && isset($_COOKIE['cookie_username']) && isset($_COOKIE['cookie_password'])){
				setcookie("cookie_userid", "", 0, "/");
				setcookie("cookie_username", "", 0, "/");
				setcookie("cookie_password", "", 0, "/");
			}
		}
		
		function TerminateSession($id)
		{
			$this->SetId($id);
			
			$this->SelectById();
			$this->SetActive(0);
			$this->SetDateLast(date('Y-m-d H:i:s', time()));
			
			$this->Update();
			
			$this->UnsetCookie();
		}

		function SetCookie($username)
		{
			$user = new User();
			
			$user->SetDatabase($this->database);
			
			$user->SetUsername($username);
			
			$user->SelectByName();

			setcookie("cookie_userid", $this->GetId(), 0, "/");
			setcookie("cookie_username", $user->GetUsername(), 0, "/");
			setcookie("cookie_password", $user->GetEncryptedPassword(), 0, "/");
		}
		
		function IsLoggedIn()
		{
			if($this->logged_in)
				return true;
			else
				return false;
		}
		

		function GenerateRandId()
		{
			return md5($this->GenerateRandStr(16));
		}

		function GenerateRandStr($length)
		{
			$randstr = "";
			for($i=0; $i<$length; $i++)
			{
				$randnum = mt_rand(0,61);
				if($randnum < 10)
				{
					$randstr .= chr($randnum+48);
				}
				else if($randnum < 36)
				{
					$randstr .= chr($randnum+55);
				}
				else
				{
					$randstr .= chr($randnum+61);
				}
			}
			return $randstr;
		}

		function Drop()
		{
			$sql = "DROP TABLE IF EXISTS sessions";

			$this->database->Execute($sql);
		}

		function Backup($handle1, $handle2)
		{
			$result = $this->Select();

			while($data = $this->database->FetchArray($result))
			{
				fwrite($handle1, "<?php\n");

				fwrite($handle1, "	\$select = \"insert into sessions (sess_id, sess_date_start, sess_date_last, sess_active, sess_ip, sess_user_id) \".\n");
				fwrite($handle1, "			  \"values (\\\"".$data["sess_id"]."\\\", \\\"".$data["sess_date_start"]."\\\", \\\"".$data["sess_date_last"]."\\\", ".$data["sess_active"].", \\\"".$data["sess_ip"]."\\\", ".$data["sess_user_id"].")\";\n");
				fwrite($handle1, "	\$result = \$database->Execute(\$select);\n");

				fwrite($handle1, "?>\n");

				fwrite($handle2, "<?php\n");

				fwrite($handle2, "	\$select = \"insert into sessions (sess_id, sess_date_start, sess_date_last, sess_active, sess_ip, sess_user_id) \".\n");
				fwrite($handle2, "			  \"values (\\\"".$data["sess_id"]."\\\", \\\"".$data["sess_date_start"]."\\\", \\\"".$data["sess_date_last"]."\\\", ".$data["sess_active"].", \\\"".$data["sess_ip"]."\\\", ".$data["sess_user_id"].")\";\n");
				fwrite($handle2, "	\$result = \$database->Execute(\$select);\n");

				fwrite($handle2, "?>\n");
			}
		}

		function Create()
		{
			$sql = "DROP TABLE IF EXISTS sessions";

			$this->database->Execute($sql);

			$sql = "CREATE TABLE sessions ( ".
				   "sess_id varchar(32) not null unique, ".
				   "sess_date_start datetime not null, ".
				   "sess_date_last datetime, ".
				   "sess_active integer not null, ".
				   "sess_ip varchar(50) not null, ".
				   "sess_user_id integer, ".
			       "primary key (sess_id), ".
				   "constraint `sess_user_fk` foreign key `sess_user_fk` (`sess_user_id`) references `users` (`user_id`) ".
			       ") type=innodb";

			$this->database->Execute($sql);
		}

		function Insert()
		{
			$this->id = $this->GenerateRandId();
			
			$select = "insert into sessions (sess_id, sess_date_start, sess_date_last, sess_active, sess_ip, sess_user_id) ".
					  "values (\"".$this->id."\", \"".$this->date_start."\", \"".$this->date_last."\", ".$this->active.", \"".$this->ip."\", ".$this->user.")";

			$result = $this->database->Execute($select);

			if(mysql_affected_rows() == 1)
			{
				return true;
			}
			return false;
		}
		
		function Update()
		{
			$select = "update sessions set sess_date_start = \"".$this->date_start."\", sess_date_last = \"".$this->date_last."\", sess_active = ".$this->active.", ".
			          "sess_ip = \"".$this->ip."\", sess_user_id = ".$this->user." ".
					  "where sess_id = \"".$this->id."\"";

			$old = new Session();
			$old->id = $this->id;
			$old->database = $this->database;
			$old->SelectById();
			
			if(	$this->date_start == $old->date_start &&
				$this->date_last == $old->date_last &&
				$this->active == $old->active &&
				$this->ip == $old->ip &&
				$this->user == $old->user)
			{
				return true;
			}

			$result = $this->database->Execute($select);

			if(mysql_affected_rows() == 1)
			{
				return true;
			}
			
			return false;
		}

		function Delete()
		{
			$select = "delete from sessions ".
					  "where sess_id = \"".$this->id."\"";
			$result = $this->database->Execute($select);

			if(mysql_affected_rows() == 1)
			{
				return true;
			}
			return false;
		}

		function Select()
		{
			$select = "select sess_id, sess_active, sess_date_start, sess_date_last, sess_ip, sess_user_id ".
					  "from sessions order by sess_id";

			$result = $this->database->Execute($select);
			return $result;
		}

		function SelectById()
		{
			$select = "select sess_id, sess_active, sess_date_start, sess_date_last, sess_ip, sess_user_id ".
					  "from sessions ".
					  "where sess_id = \"".$this->id."\"";

			$result = $this->database->Execute($select);

			$data = mysql_fetch_array($result);

			if($result && mysql_num_rows($result) > 0)
			{
				$this->id = $data["sess_id"];
				$this->active = $data["sess_active"];
				$this->date_start = $data["sess_date_start"];
				$this->date_last = $data["sess_date_last"];
				$this->ip = $data["sess_ip"];
				$this->user = $data["sess_user_id"];
				
				return true;
			}

			return false;
		}

		function SetId($id)
		{
			$this->id = $id;
		}

		function SetActive($active)
		{
			$this->active = $active;
		}

		function SetUser($user)
		{
			$this->user = $user;
		}

		function SetDateStart($date)
		{
			$this->date_start = $date;
		}

		function SetDateLast($date)
		{
			$this->date_last = $date;
		}

		function SetIp($ip)
		{
			$this->ip = $ip;
		}

		function SetDatabase($database)
		{
			$this->database = $database;
		}
		
		function GetId()
		{
			return $this->id;
		}

		function GetActive()
		{
			return $this->active;
		}

		function GetUser()
		{
			return $this->user;
		}

		function GetDateStart()
		{
			return $this->date_start;
		}

		function GetDateLast()
		{
			return $this->date_last;
		}

		function GetIp()
		{
			return $this->ip;
		}

		function GetDatabase()
		{
			return $this->database;
		}
	};

?>