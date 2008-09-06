<?php

	/*
	* blShout.php
	*
	* The shout block for the web site.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: July 31, 2007
	*/
	
	/* Dependencies
	*
	* require src/cdShout.php
	*
	*/

	$first_shout_id = 0;
	$last_shout_id = 0;
	
	if(isset($_POST["p_first_shout_id"]))
	{
		$first_shout_id = $_POST["p_first_shout_id"];
	}
	if(isset($_POST["p_last_shout_id"]))
	{
		$last_shout_id = $_POST["p_last_shout_id"];
	}

	$shout = new Shout();
	$shout->SetDatabase($database);
	
?>

		<script language="Javascript">
			
			function ChangePageBackShout(first_shout_id)
			{
				document.form_shout.p_first_shout_id.value = first_shout_id;
				document.form_shout.submit();
			}
			
			function ChangePageForwardShout(last_shout_id)
			{
				document.form_shout.p_last_shout_id.value = last_shout_id;
				document.form_shout.submit();
			}
			
		</script>

		<table width="100%" cellspacing="1" bgcolor="#000080">
			<tr>
				<td bgcolor="#DDDDDD" align="center" width="100%" colspan="2">
					Grito da Galera!
				</td>
			</tr>
		</table>
		<table width="100%" cellspacing="1" bgcolor="#FFFFFF" height="10">
			<tr>
				<td bgcolor="#FFFFFF" align="left" width="20%">
				</td>
			</tr>
		</table>
		<table width="100%" cellspacing="1" bgcolor="#000080">
			<form name="form_shout" method="post">
				<input type="hidden" name="p_first_shout_id" value="">
				<input type="hidden" name="p_last_shout_id" value="">

<?php

	$shouts_per_page = 5;
	
	if($first_shout_id != 0)
	{
		$result = $shout->SelectNextPage($first_shout_id);
	}
	else if($last_shout_id != 0)
	{
		$result = $shout->SelectNextPage($last_shout_id);
	}
	else
	{
		$result = $shout->Select();
	}
	
	$counter = 0;
	
	while($data = $database->FetchArray($result))
	{
		if($counter == 0)
		{
			$first_shout_id = $data["shou_id"];
		}

		if($counter >= $shouts_per_page)
		{
			break;
		}

		$last_shout_id = $data["shou_id"];
		
		$date = new Date();
		$date->SetDate($data["shou_date"]);
		$date->ConvertToFullDisplay();

?>
	
				<tr>
					<td bgcolor="#DDDDDD" align="left" width="60%">
						<?php echo $date->GetConverted();?>
					</td>
					<td bgcolor="#DDDDDD" align="left" width="40%">
						<?php echo $data["user_username"]; ?>
					</td>
				</tr>
				<tr>
					<td bgcolor="#FFFFFF" align="left" width="100%" colspan="2">
						<?php echo $data["shou_text"]; ?>
					</td>
				</tr>

<?php

		$counter++;
	}

?>	
	
				<tr>
			
<?php			
			
	$result1 = $shout->SelectPreviousPage(&$first_shout_id, $shouts_per_page);
	$result2 = $shout->SelectNextPage(&$last_shout_id);
	
	$count1 = mysql_num_rows($result1);
	$count2 = mysql_num_rows($result2);
	
	if($count1 > 0)
	{
	
?>

					<td bgcolor="#FFFFFF" align="center" colspan="2">
						<a href="javascript:ChangePageBackShout(<?php echo $first_shout_id; ?>);">Anterior</a>
						&nbsp;

<?php	
	
	}
	else
	{

?>

					<td bgcolor="#FFFFFF" align="center" colspan="2">

<?php	

	}

	if($count1 == 0 && $count2 == 0)
	{

?>

						&nbsp;

<?php

	}
	
	if($count2 > 0)
	{
	
?>

						<a href="javascript:ChangePageForwardShout(<?php echo $last_shout_id; ?>);">Próxima</a>
					</td>

<?php	

	}
	else
	{

?>

					</td>

<?php	

	}
	
?>

				</tr>
			</form>
		</table>
