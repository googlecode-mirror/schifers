<?php

	/*
	* pgRoleQuery.php
	*
	* RoleQuery.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: August 04, 2007
	*/
	
	$module_name = "role";

	require '../../schifers/constants/cdConstants.php';
	require '../../'.$WEB_SITE.'src/cdDatabase.php';
	require '../../'.$WEB_SITE.'src/cdDate.php';
	require '../../'.$WEB_SITE.'src/cdRole.php';
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
				window.opener.form_admin.p_role_id.value = document.form_query.p_role_id.options[document.form_query.p_role_id.options.selectedIndex].value;
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
				Papéis
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Id:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<select name="p_role_id">
						<option value="">Selecione</option>

<?php

	$role = new Role();
	$role->SetDatabase($database);
	$result = $role->SelectFull();
	
	while ($data = $database->FetchArray($result))
	{
		$role_id = $data["role_id"];
		$user_username = $data["user_username"];
		$prof_name = $data["prof_name"];
		
		echo "<option value=\"".$role_id."\">".$user_username." - ".$prof_name." - ".$role_id."</option>";
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
