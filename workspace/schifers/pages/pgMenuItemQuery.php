<?php

	/*
	* pgMenuItemQuery.php
	*
	* MenuItemQuery.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: August 04, 2007
	*/
	
	$module_name = "menu_item";

	require '../../schifers/constants/cdConstants.php';
	require '../../'.$WEB_SITE.'src/cdDatabase.php';
	require '../../'.$WEB_SITE.'src/cdDate.php';
	require '../../'.$WEB_SITE.'src/cdMenu.php';
	require '../../'.$WEB_SITE.'src/cdModule.php';
	require '../../'.$WEB_SITE.'src/cdMenuItem.php';
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
				window.opener.form_admin.p_mnit_id.value = document.form_query.p_mnit_id.options[document.form_query.p_mnit_id.options.selectedIndex].value;
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
				Itens de Menu
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Id:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<select name="p_mnit_id">
						<option value="">Selecione</option>

<?php

	$menu_items = new MenuItem();
	$menu_items->SetDatabase($database);
	$result = $menu_items->SelectOrderBy();
	
	while ($data = $database->FetchArray($result))
	{
		$mnit_id = $data["mnit_id"];
		
		$menu = new Menu();
		$menu->SetId($data["mnit_menu_id"]);
		$menu->SetDatabase($database);
		$menu->SelectById();
		
		$module = new Module();
		$module->SetId($data["mnit_modu_id"]);
		$module->SetDatabase($database);
		$module->SelectById();
		
		echo "<option value=\"".$mnit_id."\">".$menu->GetName()." - ".$module->GetName()."</option>";
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
