<?php

	/*
	* pgPrivilege.php
	*
	* Privilege.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: August 04, 2007
	*/
	
	$module_name = "privilege";

	require '../../schifers/constants/cdConstants.php';
	require '../../'.$WEB_SITE.'src/cdDatabase.php';
	require '../../'.$WEB_SITE.'src/cdDate.php';
	require '../../'.$WEB_SITE.'src/cdModule.php';
	require '../../'.$WEB_SITE.'src/cdProfile.php';
	require '../../'.$WEB_SITE.'src/cdPrivilege.php';
	require '../../'.$WEB_SITE.'src/cdUser.php';
	require '../../'.$WEB_SITE.'src/cdSession.php';
	require '../../'.$WEB_SITE.'src/cdGuardian.php';

	$screen_module_name = "Privilégio";

	if(isset($_POST["p_action"]))
	{
		$action = $_POST["p_action"];
		$priv_id = $_POST["p_priv_id"];
		$priv_modu_id = $_POST["p_priv_modu_id"];
		$priv_prof_id = $_POST["p_priv_prof_id"];
		$message = "";

		if($action == 1)
		{
			$privilege = new Privilege();
			$privilege->SetDatabase($database);
			$privilege->SetId($priv_id);
			$privilege->SelectById();
			
			$priv_id = $privilege->GetId();
			$priv_modu_id = $privilege->GetModule();
			$priv_prof_id = $privilege->GetProfile();
			
			if($priv_id == "")
			{
				$message = $screen_module_name." não encontrado.";
				$priv_id = "";
				$priv_modu_id = "";
				$priv_prof_id = "";
			}
		}
		
		if($action == 2)
		{
			$privilege = new Privilege();
			$privilege->SetDatabase($database);
			$privilege->SetModule($priv_modu_id);
			$privilege->SetProfile($priv_prof_id);
			
			if($privilege->Insert())
			{			
				$message = $screen_module_name." incluído com sucesso.";
				$priv_id = "";
				$priv_modu_id = "";
				$priv_prof_id = "";
			}
			else
			{
				$message = "Problemas na operação.";
			}
		}

		if($action == 3)
		{
			$privilege = new Privilege();
			$privilege->SetDatabase($database);
			$privilege->SetId($priv_id);
			$privilege->SetModule($priv_modu_id);
			$privilege->SetProfile($priv_prof_id);
			
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
			$privilege = new Privilege();
			$privilege->SetDatabase($database);
			$privilege->SetId($priv_id);
			
			if($privilege->Delete())
			{			
				$message = $screen_module_name." excluído com sucesso.";
				$priv_id = "";
				$priv_modu_id = "";
				$priv_prof_id = "";
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
				document.form_admin.p_priv_id.value = "";
				document.form_admin.p_priv_modu_id.selectedIndex = 0;
				document.form_admin.p_priv_prof_id.selectedIndex = 0;
				document.form_admin.p_action.value="0";
				document.form_admin.submit();
			}
			
			function Query()
			{
				window.open("pgPrivilegeQuery.php", "queryPrivilege", "width=600,height=500,top=150,left=150,toolbar=0,location=0,status=0,menubar=0,scrollbars=1,resizable=1");
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
			<input type="hidden" name="p_priv_id" value="<?php echo $priv_id; ?>">
			<tr>
				<td bgcolor="#EEEEEE" width="100%" valign="top" class="form_title" colspan="2">
				Privilégios
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Módulo:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<select name="p_priv_modu_id">
						<option value="">Selecione</option>

<?php

	$module = new Module();
	$module->SetDatabase($database);
	$result = $module->Select();
	
	while ($data = $database->FetchArray($result))
	{
		$modu_id = $data["modu_id"];
		$modu_name = $data["modu_name"];
		
		if($priv_modu_id == $modu_id)
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
					Perfil:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<select name="p_priv_prof_id">
						<option value="">Selecione</option>

<?php

	$profile = new Profile();
	$profile->SetDatabase($database);
	$result = $profile->Select();
	
	while ($data = $database->FetchArray($result))
	{
		$prof_id = $data["prof_id"];
		$prof_name = $data["prof_name"];
		
		if($priv_prof_id == $prof_id)
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

	if($priv_id != "")
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
