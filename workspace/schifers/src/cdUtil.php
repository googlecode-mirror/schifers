<?php

	/*
	* cdUtil.php
	*
	* General functions.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: September 22, 2007
	*/


	function ConvertDateTime($date)
	{
		$converted = "";
		
		$converted = substr($date, 6, 4)."-".substr($date, 3, 2)."-".substr($date, 0, 2)." ".substr($date, 11, 8);

		return $converted;
	}

	function ConvertDate($date)
	{
		$converted = "";
		
		$converted = substr($date, 6, 4)."-".substr($date, 3, 2)."-".substr($date, 0, 2);
		
		return $converted;
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

	function CheckDay($str)
	{
		$is_day = true;
		
		if(CharAt($str, 0) < "0" || CharAt($str, 0) > "3")
		{
			$is_day = false;
		}
		if(CharAt($str, 1) < "1" || CharAt($str, 1) > "9")
		{
			$is_day = false;
		}
		if($str < 0 || $str > 31)
		{
			$is_day = false;
		}
		
		return $is_day;
	}
	
	function CheckMonth($str)
	{
		$is_month = true;
		
		if(CharAt($str, 0) < "0" || CharAt($str, 0) > "1")
		{
			$is_month = false;
		}
		if(CharAt($str, 1) < "1" || CharAt($str, 1) > "9")
		{
			$is_month = false;
		}
		if($str < 0 || $str > 12)
		{
			$is_month = false;
		}
		
		return $is_month;
	}

	function VerifyDate($date, $message)
	{

		$is_date_correct = true;
		$message = "";
		
		if(	strlen($date) != 10 || CharAt($date, 2) != "/" || CharAt($date, 5) != "/" || !CheckNumber(CharAt($date, 0)) || !CheckNumber(CharAt($date, 1)) || !CheckNumber(CharAt($date, 3)) || !CheckNumber(CharAt($date, 4)) ||	!CheckNumber(CharAt($date, 6)) || !CheckNumber(CharAt($date, 7)) ||	!CheckNumber(CharAt($date, 8)) || !CheckNumber(CharAt($date, 9)) || !CheckMonth(substr($date, 3, 2)) || !CheckDay(substr($date, 0, 2)) )
		{
			$is_date_correct = false;
		}
		
		if($is_date_correct)
		{
			$message = "Data inválida.";
		}
		
		return $is_date_correct;

	}

?>