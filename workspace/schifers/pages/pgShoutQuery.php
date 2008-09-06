<?php

	/*
	* pgShoutQuery.php
	*
	* ShoutQuery.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: August 04, 2007
	*/
	
	$module_name = "shout";

	require '../../schifers/constants/cdConstants.php';
	require '../../'.$WEB_SITE.'src/cdDatabase.php';
	require '../../'.$WEB_SITE.'src/cdDate.php';
	require '../../'.$WEB_SITE.'src/cdShout.php';
	require '../../'.$WEB_SITE.'src/cdUser.php';
	require '../../'.$WEB_SITE.'src/cdSession.php';
	require '../../'.$WEB_SITE.'src/cdGuardian.php';
	
?>

<html>
	<head>
		<title>Schifer's</title>
		<link rel="stylesheet" type="text/css" href="/schifers/css/schifers.css">
		<script language="Javascript">
			
			function Select()
			{
				window.opener.form_admin.p_shou_id.value = document.form_query.p_shou_id.options[document.form_query.p_shou_id.options.selectedIndex].value;
				window.opener.form_admin.p_action.value="1";
				window.opener.form_admin.submit();
				Close();
			}
			
			function Close()
			{
				window.close();
			}
			
		</script>
	</head>
	
	<body bgcolor="#FFFFFF">

	<table width="100%" cellspacing="1" bgcolor="#000000">
		<form name="form_query" method="post">
			<tr>
				<td bgcolor="#EEEEEE" width="100%" valign="top" class="form_title" colspan="2">
				Notícias
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Título:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<select name="p_shou_id">
						<option value="">Selecione</option>

<?php

	$shout = new Shout();
	$shout->SetDatabase($database);
	$result = $shout->Select();
	
	while ($data = $database->FetchArray($result))
	{
		$shou_id = $data["shou_id"];
		
		echo "<option value=\"".$shou_id."\">".$shou_id."</option>";
	}
	
?>

					</select>
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="100%" valign="center" align="center" colspan="2">
					<a href="javascript:Select();">Selecionar</a>&nbsp;
					<a href="javascript:Close();">Fechar</a>
				</td>
			</tr>
		</form>
	</table>

	</body>
</html>
