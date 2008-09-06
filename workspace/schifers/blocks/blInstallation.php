<?php

	/*
	* blInstallation.php
	*
	* Installation block.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: August 04, 2007
	*/

?>

	<center>
	
		<link rel="stylesheet" type="text/css" href="/css.css">

		<table width="100%" cellspacing="1" bgcolor="#000000">
			<tr>
<?php
	for($i = 0; $i < 50; $i++)
	{
?>
				<td id="td_progress<?php echo $i; ?>" bgcolor="#FFFFFF" width="10" valign="top" align="center">
					&nbsp;
				</td>
<?php
	}
?>
			</tr>
		</table>

<?php

	require $WEB_SITE.'blocks/blSpace.php';

?>

		<table width="100%" cellspacing="1" bgcolor="#000000">
			<tr>
				<td id="td_message" bgcolor="#FFFFFF" width="100%" valign="top" align="center">
					&nbsp;
				</td>
			</tr>
		</table>

	</center>