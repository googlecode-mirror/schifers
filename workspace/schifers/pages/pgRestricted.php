<?php

	/*
	* pgRestricted.php
	*
	* This is the restricted area of the web site.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: August 01, 2007
	*/

	$module_name = "inside";

	require '../../schifers/constants/cdConstants.php';
	require '../../'.$WEB_SITE.'src/cdDatabase.php';
	require '../../'.$WEB_SITE.'src/cdDate.php';
	require '../../'.$WEB_SITE.'src/cdUser.php';
	require '../../'.$WEB_SITE.'src/cdSession.php';
	require '../../'.$WEB_SITE.'src/cdGuardian.php';
	require '../../'.$WEB_SITE.'src/cdMenu.php';
	require '../../'.$WEB_SITE.'src/cdMenuBuilder.php';
	require '../../'.$WEB_SITE.'src/cdNew.php';
	require '../../'.$WEB_SITE.'src/cdShout.php';
	
?>

<html>
	<head>
		<title>Schifer's</title>
		<link rel="stylesheet" type="text/css" href="/schifers/css/schifers.css">
	</head>
	<body bgcolor="#FFFFFF">

<?php

	require '../../'.$WEB_SITE.'blocks/blTitle.php';

?>

	<table width="100%" cellspacing="0">
		<tr>
			<td bgcolor="#FFFFFF" width="20%" valign="top" align="center">
			
<?php
	require '../../'.$WEB_SITE.'blocks/blRestrictedLeftFrame.php';
?>

			</td>
			<td bgcolor="#FFFFFF" width="60%" valign="top" align="center">
			
<?php
	require '../../'.$WEB_SITE.'blocks/blRestrictedMainFrame.php';
?>

			</td>
			<td bgcolor="#FFFFFF" width="20%" valign="top" align="center">
			
<?php
	require '../../'.$WEB_SITE.'blocks/blRestrictedRightFrame.php';
?>

			</td>
		</tr>
	</table>

<?php
	require '../../'.$WEB_SITE.'blocks/blBottom.php';
?>

	</body>
</html>
