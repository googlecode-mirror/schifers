<?php

	/*
	* pgUser.php
	*
	* User.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: August 04, 2007
	*/
	
	$module_name = "user";

	require '../../schifers/constants/cdConstants.php';
	require '../../'.$WEB_SITE.'src/cdDatabase.php';
	require '../../'.$WEB_SITE.'src/cdDate.php';
	require '../../'.$WEB_SITE.'src/cdUser.php';
	require '../../'.$WEB_SITE.'src/cdSession.php';
	require '../../'.$WEB_SITE.'src/cdGuardian.php';

	$screen_module_name = "Usuário";

	if(isset($_POST["p_action"]))
	{
		$action = $_POST["p_action"];
		$user_id = $_POST["p_user_id"];
		$user_username = $_POST["p_user_username"];
		$user_password1 = $_POST["p_user_password1"];
		$user_password2 = $_POST["p_user_password2"];
		$user_active = $_POST["p_user_active"];
		$message = "";

		if($action == 1)
		{
			$user = new User();
			$user->SetDatabase($database);
			$user->SetId($user_id);
			$user->SelectById();
			
			$user_id = $user->GetId();
			$user_username = $user->GetUsername();
			$user_active = $user->GetActive();
			
			if($user_id == "")
			{
				$message = $screen_module_name." não encontrado.";
				$user_id = "";
				$user_username = "";
				$user_password1 = "";
				$user_password2 = "";
				$user_active = "";
			}
		}
		
		if($action == 2)
		{
			$user = new User();
			$user->SetDatabase($database);
			$user->SetUsername($user_username);
			$user->SetPassword($user_password1);
			$user->SetActive($user_active);
			$user->Encrypt();
			
			if($user_password1 != $user_password2)
			{
				$message = "Senhas não conferem.";
			}
			else if($user->Insert())
			{			
				$message = $screen_module_name." incluído com sucesso.";
				$user_id = "";
				$user_username = "";
				$user_password1 = "";
				$user_password2 = "";
				$user_active = "";
			}
			else
			{
				$message = "Problemas na operação.";
			}
		}

		if($action == 3)
		{
			$user = new User();
			$user->SetDatabase($database);
			$user->SetId($user_id);
			$user->SetUsername($user_username);
			$user->SetPassword($user_password1);
			$user->SetActive($user_active);
			$user->Encrypt();
			
			if($user_password1 != $user_password2)
			{
				$message = "Senhas não conferem.";
			}
			else if($user->Update())
			{			
				$message = $screen_module_name." alterado com sucesso.";
				$user_password1 = "";
				$user_password2 = "";
			}
			else
			{
				$message = "Problemas na operação.";
			}
		}

		if($action == 4)
		{
			$user = new User();
			$user->SetDatabase($database);
			$user->SetId($user_id);
			
			if($user->Delete())
			{			
				$message = $screen_module_name." excluído com sucesso.";
				$user_id = "";
				$user_username = "";
				$user_password1 = "";
				$user_password2 = "";
				$user_active = "";
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
				document.form_admin.p_user_id.value = "";
				document.form_admin.p_user_username.value = "";
				document.form_admin.p_user_password1.value = "";
				document.form_admin.p_user_password2.value = "";
				document.form_admin.p_user_active.value = "";
				document.form_admin.p_action.value="0";
				document.form_admin.submit();
			}
			
			function Query()
			{
				window.open("pgUserQuery.php", "queryUser", "width=600,height=500,top=150,left=150,toolbar=0,location=0,status=0,menubar=0,scrollbars=1,resizable=1");
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
			<tr>
				<td bgcolor="#EEEEEE" width="100%" valign="top" class="form_title" colspan="2">
				Usuários
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Id:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<input type="hidden" name="p_user_id" value="<?php echo $user_id; ?>">

<?php

	if($user_id != "")
	{
		echo $user_id;
	}
	else
	{
		echo "&nbsp;";
	}

?>				
					
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Nome:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<input type="text" name="p_user_username" value="<?php echo $user_username; ?>">
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Senha:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<input type="password" name="p_user_password1" value="<?php echo $user_password1; ?>">
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Confirmar Senha:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<input type="password" name="p_user_password2" value="<?php echo $user_password2; ?>">
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Ativo:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
<?php

	if($user_active == 1)
	{
?>
					<input type="radio" name="p_user_active" value="1" checked> Sim
					<input type="radio" name="p_user_active" value="0"> Não
<?php

	}
	else
	{
?>
					<input type="radio" name="p_user_active" value="1"> Sim
					<input type="radio" name="p_user_active" value="0" checked> Não
<?php
	}
?>
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="100%" valign="center" align="center" colspan="2">

<?php

	if($user_id != "")
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
