<?

	/*
	* blLeftFrame.php
	*
	* The left frame block for the main page of the web site.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: July 30, 2007
	*/

?>

		<table width="100%" cellspacing="0" bgcolor="#000080">
			<tr>
				<td bgcolor="#FFFFFF" align="center">

<?php

	require 'blMenu.php';

?>

<?php

	$user = new User();
	$user->SetDatabase($database);
	$user->SetUsername($guardian->GetUsername());
	$user->SelectByName();
	
	if($guardian->IsUserAdmin())
	{

		require 'blSpace.php';
	
?>

<?php

		require 'blMenuAdministration.php';
	
	}
	
?>
				
				</td>
			</tr>
		</table>
