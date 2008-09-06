<?php

	/*
	* pgMenuItem.php
	*
	* MenuItem.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: August 09, 2007
	*/
	
	$module_name = "menu_item";

	require '../../schifers/constants/cdConstants.php';
	require '../../'.$WEB_SITE.'src/cdDatabase.php';
	require '../../'.$WEB_SITE.'src/cdDate.php';
	require '../../'.$WEB_SITE.'src/cdModule.php';
	require '../../'.$WEB_SITE.'src/cdMenu.php';
	require '../../'.$WEB_SITE.'src/cdMenuItem.php';
	require '../../'.$WEB_SITE.'src/cdUser.php';
	require '../../'.$WEB_SITE.'src/cdSession.php';
	require '../../'.$WEB_SITE.'src/cdGuardian.php';

	$screen_module_name = "Item de Menu";

	if(isset($_POST["p_action"]))
	{
		$action = $_POST["p_action"];
		$mnit_id = $_POST["p_mnit_id"];
		$mnit_modu_id = $_POST["p_mnit_modu_id"];
		$mnit_menu_id = $_POST["p_mnit_menu_id"];
		$mnit_order = $_POST["p_mnit_order"];
		$message = "";

		if($action == 1)
		{
			$menu_item = new MenuItem();
			$menu_item->SetDatabase($database);
			$menu_item->SetId($mnit_id);
			$menu_item->SelectById();
			
			$mnit_id = $menu_item->GetId();
			$mnit_modu_id = $menu_item->GetModule();
			$mnit_menu_id = $menu_item->GetMenu();
			$mnit_order = $menu_item->GetOrder();
			
			if($mnit_id == "")
			{
				$message = $screen_module_name." não encontrado.";
				$mnit_id = "";
				$mnit_modu_id = "";
				$mnit_menu_id = "";
				$mnit_order = "";
			}
		}
		
		if($action == 2)
		{
			$menu_item = new MenuItem();

			$menu_item->SetDatabase($database);
			$menu_item->SetModule($mnit_modu_id);
			$menu_item->SetMenu($mnit_menu_id);
			$menu_item->SetOrder($mnit_order);
			
			if($menu_item->Insert())
			{			
				$message = $screen_module_name." incluído com sucesso.";
				$mnit_id = "";
				$mnit_modu_id = "";
				$mnit_menu_id = "";
				$mnit_order = "";
			}
			else
			{
				$message = "Problemas na operação.";
			}
		}

		if($action == 3)
		{
			$menu_item = new MenuItem();
			$menu_item->SetDatabase($database);
			$menu_item->SetId($mnit_id);
			$menu_item->SetModule($mnit_modu_id);
			$menu_item->SetMenu($mnit_menu_id);
			$menu_item->SetOrder($mnit_order);
			
			if($menu_item->Update())
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
			$menu_item = new MenuItem();
			$menu_item->SetDatabase($database);
			$menu_item->SetId($mnit_id);
			
			if($menu_item->Delete())
			{			
				$message = $screen_module_name." excluído com sucesso.";
				$mnit_id = "";
				$mnit_modu_id = "";
				$mnit_menu_id = "";
				$mnit_order = "";
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
				document.form_admin.p_mnit_id.value = "";
				document.form_admin.p_mnit_modu_id.selectedIndex = 0;
				document.form_admin.p_mnit_menu_id.selectedIndex = 0;
				document.form_admin.p_mnit_order.value = "";
				document.form_admin.p_action.value="0";
				document.form_admin.submit();
			}
			
			function Query()
			{
				window.open("pgMenuItemQuery.php", "queryMenuItem", "width=600,height=500,top=150,left=150,toolbar=0,location=0,status=0,menubar=0,scrollbars=1,resizable=1");
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
			<input type="hidden" name="p_mnit_id" value="<?php echo $mnit_id; ?>">
			<tr>
				<td bgcolor="#EEEEEE" width="100%" valign="top" class="form_title" colspan="2">
				Itens de Menu
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Módulo:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<select name="p_mnit_modu_id">
						<option value="">Selecione</option>

<?php

	$module = new Module();
	$module->SetDatabase($database);
	$result = $module->Select();
	
	while ($data = $database->FetchArray($result))
	{
		$modu_id = $data["modu_id"];
		$modu_name = $data["modu_name"];
		
		if($mnit_modu_id == $modu_id)
		{
			echo "<option value=\"".$modu_id."\" selected>".$modu_name."</option>";
		}
		else
		{
			echo "<option value=\"".$modu_id."\">".$modu_name."</option>";
		}
	}

?>
					
					</select>
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Menu:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<select name="p_mnit_menu_id">
						<option value="">Selecione</option>

<?php

	$menu = new Menu();
	$menu->SetDatabase($database);
	$result = $menu->Select();
	
	while ($data = $database->FetchArray($result))
	{
		$menu_id = $data["menu_id"];
		$menu_name = $data["menu_name"];
		
		if($mnit_menu_id == $menu_id)
		{
			echo "<option value=\"".$menu_id."\" selected>".$menu_name."</option>";
		}
		else
		{
			echo "<option value=\"".$menu_id."\">".$menu_name."</option>";
		}
	}

?>
					
					</select>
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Ordem:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<input type="text" name="p_mnit_order" value="<?php echo $mnit_order ?>">
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="100%" valign="center" align="center" colspan="2">

<?php

	if($mnit_id != "")
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
