<?php

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

	require 'blLogin.php';
	
?>

<?php

	require 'blSpace.php';
	
?>

<?php

	require 'blMenu.php';
	
?>

<?php

	if($guardian->GetLoggedIn() == true)
	{

		require 'blSpace.php';
		require 'blRestricted.php';
	
	}
	
?>

				</td>
			</tr>
		</table>
