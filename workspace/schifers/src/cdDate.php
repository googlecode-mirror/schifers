<?php

	/*
	* cdDate.php
	*
	* Date functions.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: September 22, 2007
	*/

	class Date
	{
		var $date; // db format
		var $converted; // display format
		var $message;

		function NeedConversion()
		{
			if(substr($this->converted, 2, 1) == "/")
			{
				return true;
			}
			return false;
		}
		
		function NeedConversionToDisplay()
		{
			if(substr($this->date, 4, 1) == "-")
			{
				return true;
			}
			return false;
		}
		
		function ConvertToFullDisplay()
		{
			if($this->NeedConversionToDisplay())
			{
				$this->converted = substr($this->date, 8, 2)."/".substr($this->date, 5, 2)."/".substr($this->date, 0, 4)." ".substr($this->date, 11, 8);
			}
		}

		function ConvertToDisplay()
		{
			if($this->NeedConversionToDisplay())
			{
				$this->converted = substr($this->date, 8, 2)."/".substr($this->date, 5, 2)."/".substr($this->date, 0, 4);
			}
		}

		function ConvertToFullDate()
		{
			if($this->NeedConversion())
			{
				$this->date = substr($this->converted, 6, 4)."-".substr($this->converted, 3, 2)."-".substr($this->converted, 0, 2)." ".substr($this->converted, 11, 8);
			}
		}

		function ConvertToDate()
		{
			if($this->NeedConversion())
			{
				$this->date = substr($this->converted, 6, 4)."-".substr($this->converted, 3, 2)."-".substr($this->converted, 0, 2);
			}
		}

		function CheckNumber($char)
		{
			if($char > "0" && $char < "9")
			{
				return true;
			}
			return false;
		}
		
		function CharAt($str, $position)
		{
			return substr($str, $position, 1);
		}

		function CheckDay()
		{
			$str = substr($this->date, 0, 2);
			
			$is_day = true;
			
			if($this->CharAt($str, 0) < "0" || $this->CharAt($str, 0) > "3")
			{
				$is_day = false;
			}
			if($this->CharAt($str, 1) < "1" || $this->CharAt($str, 1) > "9")
			{
				$is_day = false;
			}
			if($str < 0 || $str > 31)
			{
				$is_day = false;
			}
			
			return $is_day;
		}
		
		function CheckMonth()
		{
			$str = substr($this->date, 3, 2);

			$is_month = true;
			
			if($this->CharAt($str, 0) < "0" || $this->CharAt($str, 0) > "1")
			{
				$is_month = false;
			}
			if($this->CharAt($str, 1) < "1" || $this->CharAt($str, 1) > "9")
			{
				$is_month = false;
			}
			if($str < 0 || $str > 12)
			{
				$is_month = false;
			}
			
			return $is_month;
		}

		function VerifyDate()
		{
			$is_date_correct = true;
			$this->message = "";
			
			if(	strlen($this->date) != 10 || $this->CharAt($this->date, 2) != "/" || $this->CharAt($this->date, 5) != "/" || !$this->CheckNumber($this->CharAt($this->date, 0)) || !$this->CheckNumber($this->CharAt($this->date, 1)) || !$this->CheckNumber($this->CharAt($this->date, 3)) || !$this->CheckNumber($this->CharAt($this->date, 4)) ||	!$this->CheckNumber($this->CharAt($this->date, 6)) || !$this->CheckNumber($this->CharAt($this->date, 7)) ||	!$this->CheckNumber($this->CharAt($this->date, 8)) || !$this->CheckNumber($this->CharAt($this->date, 9)) || !$this->CheckMonth(substr($date, 3, 2)) || !$this->CheckDay(substr($date, 0, 2)) )
			{
				$is_date_correct = false;
			}
			
			if($is_date_correct)
			{
				$this->message = "Data inválida.";
			}
			
			return $is_date_correct;
		}
		
		function GetNowFull()
		{
			$this->date = date('d/m/Y H:i:s', time());
			return $this->date;
		}

		function GetNow()
		{
			$this->date = date('d/m/Y', time());
			return $this->date;
		}

		function SetDate($date)
		{
			$this->date = $date;
		}
		
		function SetConverted($date)
		{
			$this->converted = $date;
		}
		
		function SetMessage($msg)
		{
			$this->message = $msg;
		}
		
		function GetDate()
		{
			return $this->date;
		}

		function GetConverted()
		{
			return $this->converted;
		}

		function GetMessage()
		{
			return $this->message;
		}
	};
	
?>