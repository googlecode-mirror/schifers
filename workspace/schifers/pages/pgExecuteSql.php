<?php

	/*
	* pgGenerateSql.php
	*
	* Generate Sql.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: September 26, 2007
	*/

	$module_name = "execute_sql";

	require '../../schifers/constants/cdConstants.php';
	require '../../'.$WEB_SITE.'src/cdDatabase.php';
	require '../../'.$WEB_SITE.'src/cdDate.php';
	require '../../'.$WEB_SITE.'src/cdUser.php';
	require '../../'.$WEB_SITE.'src/cdSession.php';
	require '../../'.$WEB_SITE.'src/cdGuardian.php';

	$message_position = "";

	if(isset($_POST["p_action"]))
	{
		$action = $_POST["p_action"];

		if($action == 1)
		{
			require '../actions/doArticles.php';
		
			$message_position = 1;
			$message = "Arquivo executado com sucesso!";
		}
		
	}

?>

<html>
	<head>
		<title>Schifer's</title>
		<link rel="stylesheet" type="text/css" href="/schifers/css/schifers.css">
		<script language="Javascript">
			
			function Generate()
			{
				document.form_admin.p_action.value="1";
				document.form_admin.submit();
			}
			
		</script>
	</head>
	<body bgcolor="#FFFFFF">

<?php

	require '../../'.$WEB_SITE.'blocks/blTitle.php';

?>

	<form name="form_admin" method="post">
		<input type="hidden" name="p_action">
		<table width="100%" cellspacing="1" bgcolor="#000000">
			<tr>
				<td bgcolor="#EEEEEE" width="100%" valign="top" class="form_title" colspan="2">
				Executor de SQL - Restaura o Site
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="100%" valign="center" align="center" colspan="2">
					<a href="javascript:Generate();">Gerar</a>&nbsp;
					<a href="/schifers/pages/pgRestricted.php">Voltar</a>
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="100%" valign="center" align="center" colspan="2">
					<font color="#FF0000">
<?php

	if($message != "" && $message_position == 1)
	{
		echo $message;
	}
	else
	{
		echo "&nbsp;";
	}

?>				
					</font>
				</td>
			</tr>
		</table>
	</form>

<?php

	require '../../'.$WEB_SITE.'blocks/blBottom.php';

?>
	
	</body>
</html>
