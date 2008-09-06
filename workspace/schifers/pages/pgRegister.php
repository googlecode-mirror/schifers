<?php

	/*
	* pgRegister.php
	*
	* Register page.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: September 09, 2007
	*/
	
	$module_name = "register";

	require '../../schifers/constants/cdConstants.php';
	require '../../'.$WEB_SITE.'src/cdDatabase.php';
	require '../../'.$WEB_SITE.'src/cdDate.php';
	require '../../'.$WEB_SITE.'src/cdUserInfo.php';
	require '../../'.$WEB_SITE.'src/cdUser.php';
	require '../../'.$WEB_SITE.'src/cdSession.php';
	require '../../'.$WEB_SITE.'src/cdGuardian.php';

	$screen_module_name = "Informações de usuário";
	$message_position = 0;

	if(isset($_POST["p_action"]))
	{
		$action = $_POST["p_action"];
		$usif_id = $_POST["p_usif_id"];
		$usif_first_name = $_POST["p_usif_first_name"];
		$usif_last_name = $_POST["p_usif_last_name"];
		$usif_nick = $_POST["p_usif_nick"];
		$usif_email = $_POST["p_usif_email"];
		$usif_user_id = $_POST["p_usif_user_id"];
		$user_username = $_POST["p_user_username"];
		$user_password1 = $_POST["p_user_password1"];
		$user_password2 = $_POST["p_user_password2"];
		
		$message = "";

		if($action == 1)
		{
			if($user_username == "")
			{
				$message_position = 5;
				$message = "O nome do usuário não pode ser nulo.";
			}
			else if ($user_password1 == "")
			{
				$message_position = 6;
				$message = "A senha do usuário não pode ser nula.";
			}
			else if ($user_password1 != $user_password2)
			{
				$message_position = 7;
				$message = "As senhas não conferem.";
			}
			else if ($usif_email == "")
			{
				$message_position = 4;
				$message = "O e-mail do usuário não pode ser nulo.";
			}
			else if ($usif_first_name == "")
			{
				$message_position = 1;
				$message = "O primeiro nome do usuário não pode ser nulo.";
			}
			else
			{
				if($usif_nick == "")
				{
					$usif_nick = $usif_first_name;
				}
			
				$user = new User();
				$user->SetDatabase($database);
				$user->SetUsername($user_username);
				$user->SetPassword($user_password1);
				$user->SetActive(0);
				
				$user->Insert();
				
				$user->SelectByName();
				
				$user_info = new UserInfo();
				$user_info->SetDatabase($database);
				$user_info->SetFirstName($usif_first_name);
				$user_info->SetLastName($usif_last_name);
				$user_info->SetNick($usif_nick);
				$user_info->SetEmail($usif_email);
				$user_info->SetUser($user->GetId());
				
				if($user_info->Insert())
				{			
					$message_position = 8;
					$message = $screen_module_name." incluídas com sucesso. Aguarde a ativação do usuário pelo administrador.";
					$usif_id = "";
					$usif_first_name = "";
					$usif_last_name = "";
					$usif_nick = "";
					$usif_email = "";
					$usif_user_id = "";
					$user_username = "";
					$user_password1 = "";
					$user_password2 = "";
				}
				else
				{
					$message_position = 8;
					$message = "Problemas na operação.";
				}
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
				document.form_admin.p_usif_id.value = "";
				document.form_admin.p_usif_first_name.value = "";
				document.form_admin.p_usif_last_name.value = "";
				document.form_admin.p_usif_nick.value = "";
				document.form_admin.p_usif_email.value = "";
				document.form_admin.p_user_username.value = "";
				document.form_admin.p_user_password1.value = "";
				document.form_admin.p_user_password2.value = "";
				document.form_admin.p_action.value="0";
				document.form_admin.submit();
			}
			
			function Insert()
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

<?php
	if($user_info_date == "")
	{
		$date = new Date();
		$user_info_date = $date->GetNowFull();
	}
?>

	<table width="100%" cellspacing="1" bgcolor="#000000">
		<form name="form_admin" method="post">
			<input type="hidden" name="p_action">
			<input type="hidden" name="p_usif_id" value="<?php echo $usif_id; ?>">
			
			<tr>
				<td bgcolor="#EEEEEE" width="100%" valign="top" class="form_title" colspan="2">
				Cadastro de Usuário
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					* Primeiro nome:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<input type="text" name="p_usif_first_name" value="<?php echo $usif_first_name; ?>" size="50" maxlength="50">
					<font class="form_error"><?php if($message_position == 1) echo $message; ?></font>
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Último nome:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<input type="text" name="p_usif_last_name" value="<?php echo $usif_last_name; ?>" size="50" maxlength="50">
					<font class="form_error"><?php if($message_position == 2) echo $message; ?></font>
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Apelido:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<input type="text" name="p_usif_nick" value="<?php echo $usif_nick; ?>" size="50" maxlength="50">
					<font class="form_error"><?php if($message_position == 3) echo $message; ?></font>
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					* Email:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<input type="text" name="p_usif_email" value="<?php echo $usif_email; ?>" size="100" maxlength="100">
					<font class="form_error"><?php if($message_position == 4) echo $message; ?></font>
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					* Usuário:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<input type="text" name="p_user_username" value="<?php echo $user_username; ?>" size="50" maxlength="50">
					<font class="form_error"><?php if($message_position == 5) echo $message; ?></font>
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					* Senha:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<input type="password" name="p_user_password1" value="" size="50" maxlength="50">
					<font class="form_error"><?php if($message_position == 6) echo $message; ?></font>
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					* Confirmação de Senha:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<input type="password" name="p_user_password2" value="" size="50" maxlength="50">
					<font class="form_error"><?php if($message_position == 7) echo $message; ?></font>
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="100%" valign="center" align="left" colspan="2">
					Campos com (*) são obrigatórios.
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="100%" valign="center" align="center" colspan="2">

<?php

	if($usif_id == "")
	{

?>				
				
					<a href="javascript:Insert();">Cadastrar-se</a>&nbsp;

<?php

	}

?>				

					<a href="javascript:Clear();">Limpar</a>&nbsp;
					<a href="/index.php">Voltar</a>
				
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="100%" valign="center" align="center" colspan="2">
					<font color="#FF0000">
<?php

	if($message != "" && $message_position == 8)
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
