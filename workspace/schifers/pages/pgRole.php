<?php

	/*
	* pgRole.php
	*
	* Role.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: August 04, 2007
	*/
	
	$module_name = "role";

	require '../../schifers/constants/cdConstants.php';
	require '../../'.$WEB_SITE.'src/cdDatabase.php';
	require '../../'.$WEB_SITE.'src/cdDate.php';
	require '../../'.$WEB_SITE.'src/cdUser.php';
	require '../../'.$WEB_SITE.'src/cdSession.php';
	require '../../'.$WEB_SITE.'src/cdProfile.php';
	require '../../'.$WEB_SITE.'src/cdRole.php';
	require '../../'.$WEB_SITE.'src/cdGuardian.php';

	$screen_module_name = "Papel";

	if(isset($_POST["p_action"]))
	{
		$action = $_POST["p_action"];
		$role_id = $_POST["p_role_id"];
		$role_user_id = $_POST["p_role_user_id"];
		$role_prof_id = $_POST["p_role_prof_id"];
		$message = "";

		if($action == 1)
		{
			$privilege = new Role();
			$privilege->SetDatabase($database);
			$privilege->SetId($role_id);
			$privilege->SelectById();
			
			$role_id = $privilege->GetId();
			$role_name = $privilege->GetName();
			$role_user_id = $privilege->GetUser();
			$role_prof_id = $privilege->GetProfile();
			
			if($role_id == "")
			{
				$message = $screen_module_name." não encontrado.";
				$role_id = "";
				$role_name = "";
				$role_user_id = "";
				$role_prof_id = "";
			}
		}
		
		if($action == 2)
		{
			$privilege = new Role();
			$privilege->SetDatabase($database);
			$privilege->SetUser($role_user_id);
			$privilege->SetProfile($role_prof_id);
			
			if($privilege->Insert())
			{			
				$message = $screen_module_name." incluído com sucesso.";
				$role_id = "";
				$role_user_id = "";
				$role_prof_id = "";
			}
			else
			{
				$message = "Problemas na operação.";
			}
		}

		if($action == 3)
		{
			$privilege = new Role();
			$privilege->SetDatabase($database);
			$privilege->SetId($role_id);
			$privilege->SetUser($role_user_id);
			$privilege->SetProfile($role_prof_id);
			
			if($privilege->Update())
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
			$privilege = new Role();
			$privilege->SetDatabase($database);
			$privilege->SetId($role_id);
			
			if($privilege->Delete())
			{			
				$message = $screen_module_name." excluído com sucesso.";
				$role_id = "";
				$role_user_id = "";
				$role_prof_id = "";
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
				document.form_admin.p_role_id.value = "";
				document.form_admin.p_role_user_id.selectedIndex = 0;
				document.form_admin.p_role_prof_id.selectedIndex = 0;
				document.form_admin.p_action.value="0";
				document.form_admin.submit();
			}
			
			function Query()
			{
				window.open("pgRoleQuery.php", "queryRole", "width=600,height=500,top=150,left=150,toolbar=0,location=0,status=0,menubar=0,scrollbars=1,resizable=1");
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
			<input type="hidden" name="p_role_id" value="<?php echo $role_id; ?>">
			<tr>
				<td bgcolor="#EEEEEE" width="100%" valign="top" class="form_title" colspan="2">
				Papéis
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Usuário:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<select name="p_role_user_id">
						<option value="">Selecione</option>

<?php

	$user = new User();
	$user->SetDatabase($database);
	$result = $user->Select();
	
	while ($data = $database->FetchArray($result))
	{
		$user_id = $data["user_id"];
		$user_username = $data["user_username"];
		
		if($role_user_id == $user_id)
		{
			echo "<option value=\"".$user_id."\" selected>".$user_username."</option>";
		}
		else
		{
			echo "<option value=\"".$user_id."\">".$user_username."</option>";
		}
	}

?>
					
					</select>
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Perfil:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<select name="p_role_prof_id">
						<option value="">Selecione</option>

<?php

	$profile = new Profile();
	$profile->SetDatabase($database);
	$result = $profile->Select();
	
	while ($data = $database->FetchArray($result))
	{
		$prof_id = $data["prof_id"];
		$prof_name = $data["prof_name"];
		
		if($role_prof_id == $prof_id)
		{
			echo "<option value=\"".$prof_id."\" selected>".$prof_name."</option>";
		}
		else
		{
			echo "<option value=\"".$prof_id."\">".$prof_name."</option>";
		}
	}

?>
					
					</select>
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="100%" valign="center" align="center" colspan="2">

<?php

	if($role_id != "")
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
