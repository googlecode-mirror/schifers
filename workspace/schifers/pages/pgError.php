<?php

	/*
	* pgError.php
	*
	* Error page.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: July 30, 2007
	*/

	$module_name = "error";
	require '../../schifers/constants/cdConstants.php';
	require '../../'.$WEB_SITE.'src/cdDatabase.php';
	require '../../'.$WEB_SITE.'src/cdDate.php';
	require '../../'.$WEB_SITE.'src/cdUser.php';
	require '../../'.$WEB_SITE.'src/cdSession.php';
	require '../../'.$WEB_SITE.'src/cdGuardian.php';
	
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

	<table width="100%" cellspacing="0" bgcolor="#EEEEEE">
		<tr>
			<td bgcolor="#EEEEEE" width="100%" valign="top" align="center">
<?php
	echo "Usuário sem acesso ao módulo!";
?>

				&nbsp;<a href="/index.php">Voltar</a>
			</td>
		</tr>
	</table>

<?php

	require '../../'.$WEB_SITE.'blocks/blBottom.php';

?>
	
	</body>
</html>
