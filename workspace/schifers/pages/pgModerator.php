<?php

	/*
	* pgModerator.php
	*
	* Moderator.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: August 04, 2007
	*/
	
	$module_name = "moderator";

	require '../../schifers/constants/cdConstants.php';
	require '../../'.$WEB_SITE.'src/cdDatabase.php';
	require '../../'.$WEB_SITE.'src/cdDate.php';
	require '../../'.$WEB_SITE.'src/cdTopic.php';
	require '../../'.$WEB_SITE.'src/cdUser.php';
	require '../../'.$WEB_SITE.'src/cdModerator.php';
	require '../../'.$WEB_SITE.'src/cdSession.php';
	require '../../'.$WEB_SITE.'src/cdGuardian.php';
	
	$screen_module_name = "Moderador";

	if(isset($_POST["p_action"]))
	{
		$action = $_POST["p_action"];
		$modr_id = $_POST["p_modr_id"];
		$modr_topc_id = $_POST["p_modr_topc_id"];
		$modr_user_id = $_POST["p_modr_user_id"];
		$message = "";

		if($action == 1)
		{
			$moderator = new Moderator();
			$moderator->SetDatabase($database);
			$moderator->SetId($modr_id);
			$moderator->SelectById();
			
			$modr_id = $moderator->GetId();
			$modr_topc_id = $moderator->GetTopic();
			$modr_user_id = $moderator->GetUser();
			
			if($modr_id == "")
			{
				$message = $screen_module_name." não encontrado.";
				$modr_id = "";
				$modr_topc_id = "";
				$modr_user_id = "";
			}
		}
		
		if($action == 2)
		{
			$moderator = new Moderator();
			$moderator->SetDatabase($database);
			$moderator->SetTopic($modr_topc_id);
			$moderator->SetUser($modr_user_id);
			
			if($moderator->Insert())
			{			
				$message = $screen_module_name." incluído com sucesso.";
				$modr_id = "";
				$modr_topc_id = "";
				$modr_user_id = "";
			}
			else
			{
				$message = "Problemas na operação.";
			}
		}

		if($action == 3)
		{
			$moderator = new Moderator();
			$moderator->SetDatabase($database);
			$moderator->SetId($modr_id);
			$moderator->SetTopic($modr_topc_id);
			$moderator->SetUser($modr_user_id);
			
			if($moderator->Update())
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
			$moderator = new Moderator();
			$moderator->SetDatabase($database);
			$moderator->SetId($modr_id);
			
			if($moderator->Delete())
			{			
				$message = $screen_module_name." excluído com sucesso.";
				$modr_id = "";
				$modr_topc_id = "";
				$modr_user_id = "";
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
				document.form_admin.p_modr_id.value = "";
				document.form_admin.p_modr_topc_id.selectedIndex = 0;
				document.form_admin.p_modr_user_id.selectedIndex = 0;
				document.form_admin.p_action.value="0";
				document.form_admin.submit();
			}
			
			function Query()
			{
				window.open("pgModeratorQuery.php", "queryModerator", "width=600,height=500,top=150,left=150,toolbar=0,location=0,status=0,menubar=0,scrollbars=1,resizable=1");
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
			<input type="hidden" name="p_modr_id" value="<?php echo $modr_id; ?>">
			<tr>
				<td bgcolor="#EEEEEE" width="100%" valign="top" class="form_title" colspan="2">
				Moderadores
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Tópico:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<select name="p_modr_topc_id">
						<option value="">Selecione</option>

<?php

	$topic = new Topic();
	$topic->SetDatabase($database);
	$result = $topic->Select();
	
	while ($data = $database->FetchArray($result))
	{
		$topc_id = $data["topc_id"];
		$topc_title = $data["topc_title"];
		
		if($modr_topc_id == $topc_id)
		{
			echo "<option value=\"".$topc_id."\" selected>".$topc_title."</option>";
		}
		else
		{
			echo "<option value=\"".$topc_id."\">".$topc_title."</option>";
		}
	}

?>
					
					</select>
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Usuário:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<select name="p_modr_user_id">
						<option value="">Selecione</option>

<?php

	$user = new User();
	$user->SetDatabase($database);
	$result = $user->Select();
	
	while ($data = $database->FetchArray($result))
	{
		$user_id = $data["user_id"];
		$user_username = $data["user_username"];
		
		if($modr_user_id == $user_id)
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
				<td bgcolor="#FFFFFF" width="100%" valign="center" align="center" colspan="2">

<?php

	if($modr_id != "")
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
