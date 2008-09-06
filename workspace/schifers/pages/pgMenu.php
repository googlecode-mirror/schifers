<?php

	/*
	* pgMenu.php
	*
	* Menu.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: August 04, 2007
	*/
	
	$module_name = "menu";

	require '../../schifers/constants/cdConstants.php';
	require '../../'.$WEB_SITE.'src/cdDatabase.php';
	require '../../'.$WEB_SITE.'src/cdDate.php';
	require '../../'.$WEB_SITE.'src/cdMenu.php';
	require '../../'.$WEB_SITE.'src/cdUser.php';
	require '../../'.$WEB_SITE.'src/cdSession.php';
	require '../../'.$WEB_SITE.'src/cdGuardian.php';

	$screen_module_name = "Menu";

	if(isset($_POST["p_action"]))
	{
		$action = $_POST["p_action"];
		$menu_id = $_POST["p_menu_id"];
		$menu_name = $_POST["p_menu_name"];
		$message = "";

		if($action == 1)
		{
			$menu = new Menu();
			$menu->SetDatabase($database);
			$menu->SetId($menu_id);
			$menu->SelectById();
			
			$menu_id = $menu->GetId();
			$menu_name = $menu->GetName();
			
			if($menu_id == "")
			{
				$message = $screen_module_name." não encontrado.";
				$menu_id = "";
				$menu_name = "";
			}
		}
		
		if($action == 2)
		{
			$menu = new Menu();
			$menu->SetDatabase($database);
			$menu->SetName($menu_name);
			
			if($menu->Insert())
			{			
				$message = $screen_module_name." incluído com sucesso.";
				$menu_id = "";
				$menu_name = "";
			}
			else
			{
				$message = "Problemas na operação.";
			}
		}

		if($action == 3)
		{
			$menu = new Menu();
			$menu->SetDatabase($database);
			$menu->SetId($menu_id);
			$menu->SetName($menu_name);
			
			if($menu->Update())
			{			
				$message = $screen_module_name." alterado com sucesso.";
			}
			else
			{
				$message = "Problemas na operação.";
			}
		}

		if($action == 4)
		{
			$menu = new Menu();
			$menu->SetDatabase($database);
			$menu->SetId($menu_id);
			
			if($menu->Delete())
			{			
				$message = $screen_module_name." excluído com sucesso.";
				$menu_id = "";
				$menu_name = "";
			}
			else
			{
				$message = "Problemas na operação.";
			}
		}

	}

?>

<html>
	<head>
		<title>Schifer's</title>
		<link rel="stylesheet" type="text/css" href="/schifers/css/schifers.css">
		<script language="Javascript">
			
			function Clear()
			{
				document.form_admin.p_menu_id.value = "";
				document.form_admin.p_menu_name.value = "";
				document.form_admin.p_action.value="0";
				document.form_admin.submit();
			}
			
			function Query()
			{
				window.open("pgMenuQuery.php", "queryMenu", "width=600,height=500,top=150,left=150,toolbar=0,location=0,status=0,menubar=0,scrollbars=1,resizable=1");
			}
			
			function Insert()
			{
				document.form_admin.p_action.value="2";
				document.form_admin.submit();
			}
			
			function Update()
			{
				document.form_admin.p_action.value="3";
				document.form_admin.submit();
			}
			
			function Delete()
			{
				document.form_admin.p_action.value="4";
				document.form_admin.submit();
			}
			
		</script>
	</head>

	<body bgcolor="#FFFFFF">

<?php

	require '../../'.$WEB_SITE.'blocks/blTitle.php';

?>

	<table width="100%" cellspacing="1" bgcolor="#000000">
		<form name="form_admin" method="post">
			<input type="hidden" name="p_action">
			<input type="hidden" name="p_menu_id" value="<?php echo $menu_id; ?>">
			<tr>
				<td bgcolor="#EEEEEE" width="100%" valign="top" class="form_title" colspan="2">
				Menus
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Nome:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<input type="text" name="p_menu_name" value="<?php echo $menu_name; ?>">
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="100%" valign="center" align="center" colspan="2">

<?php

	if($menu_id != "")
	{

?>				
				
					<a href="javascript:Update();">Atualizar</a>&nbsp;
					<a href="javascript:Delete();">Excluir</a>&nbsp;

<?php

	}
	else
	{

?>				
					<a href="javascript:Query();">Consultar</a>&nbsp;
					<a href="javascript:Insert();">Incluir</a>&nbsp;

<?php

	}

?>				

					<a href="javascript:Clear();">Limpar</a>
					<a href="/schifers/pages/pgRestricted.php">Voltar</a>
				
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="100%" valign="center" align="center" colspan="2">
					<font color="#FF0000">
<?php

	if($message != "")
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
		</form>
	</table>

<?php

	require '../../'.$WEB_SITE.'blocks/blBottom.php';

?>
	
	</body>
</html>
