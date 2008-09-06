<?php

	/*
	* pgActivateUsers.php
	*
	* The page where admins can accept new members.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: August 11, 2007
	*/
	
	$module_name = "activate_users";

	require '../../schifers/constants/cdConstants.php';
	require '../../'.$WEB_SITE.'src/cdDatabase.php';
	require '../../'.$WEB_SITE.'src/cdDate.php';
	require '../../'.$WEB_SITE.'src/cdUser.php';
	require '../../'.$WEB_SITE.'src/cdSession.php';
	require '../../'.$WEB_SITE.'src/cdUserInfo.php';
	require '../../'.$WEB_SITE.'src/cdGuardian.php';

	$screen_module_name = "Usuário(s)";

	if(isset($_POST["p_action"]))
	{
		$action = $_POST["p_action"];
		$message = "";

		if($action == 1)
		{
			$user_id = $_POST["p_user_id"];
			
			$length = count($user_id);

			if($length > 0)
			{
				for($i = 0; $i < $length; $i++)
				{
					$user = new User();
					$user->SetDatabase($database);
					$user->SetId($user_id[$i]);
					$user->SelectById();
					$user->SetActive(1);
					$user->Update();
				}
				
				$message = $screen_module_name." ativado(s) com sucesso.";
			}
			else
			{
				$message = "Não há usuários para serem ativados.";
			}
		}
	}

?>

<html>
	<head>
		<title>Schifer's</title>
		<link rel="stylesheet" type="text/css" href="/schifers/css/schifers.css">
		<script language="Javascript">
			
			function Update()
			{
				document.form_admin.p_action.value="1";
				document.form_admin.submit();
			}
			
			function SelectAll()
			{
				if(document.form_admin.p_select_all.checked)
				{
					for(i = 0; i < document.form_admin.elements.length; i++)
					{
						if(document.form_admin.elements[i].name == "p_user_id[]")
						{
							document.form_admin.elements[i].checked = true;
						}
					}
				}
				else
				{
					for(i = 0; i < document.form_admin.elements.length; i++)
					{
						if(document.form_admin.elements[i].name == "p_user_id[]")
						{
							document.form_admin.elements[i].checked = false;
						}
					}
				}
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
				<td bgcolor="#EEEEEE" width="100%" valign="top" class="form_title" colspan="6">
				Novos Membros
				</td>
			</tr>
			<tr>
				<td bgcolor="#DDDDDD" width="5%" valign="center" align="center">
					Ativo
				</td>
				<td bgcolor="#DDDDDD" width="20%" valign="center" align="center">
					Usuário
				</td>
				<td bgcolor="#DDDDDD" width="20%" valign="center" align="center">
					Nome
				</td>
				<td bgcolor="#DDDDDD" width="20%" valign="center" align="center">
					Sobrenome
				</td>
				<td bgcolor="#DDDDDD" width="15%" valign="center" align="center">
					Apelido
				</td>
				<td bgcolor="#DDDDDD" width="30%" valign="center" align="center">
					E-mail
				</td>
			</tr>

<?php

	$user = new User();
	
	$user->SetDatabase($database);

	$result = $user->SelectInactive();
	
	if(mysql_num_rows($result) == 0)
	{

?>

			<tr>
				<td bgcolor="#FFFFFF" width="100%" valign="center" align="center" colspan="6">
					Não existem usuários inativos.
				</td>
			</tr>

<?php

	}

	while($data = mysql_fetch_array($result))
	{
	
		$user_info = new UserInfo();

		$user_info->SetDatabase($database);
		$user_info->SetUser($data["user_id"]);
		$user_info->SelectByUser();

?>

			<tr>
				<td bgcolor="#FFFFFF" width="5%" valign="center" align="center">
					<input type="checkbox" name="p_user_id[]" value="<?php echo $data["user_id"]; ?>">
				</td>
				<td bgcolor="#FFFFFF" width="20%" valign="center" align="center">
					<?php echo $data["user_username"]; ?>
				</td>
				<td bgcolor="#FFFFFF" width="20%" valign="center" align="center">
					<?php echo $user_info->GetFirstName(); ?>
				</td>
				<td bgcolor="#FFFFFF" width="20%" valign="center" align="center">
					<?php echo $user_info->GetLastName(); ?>
				</td>
				<td bgcolor="#FFFFFF" width="15%" valign="center" align="center">
					<?php echo $user_info->GetNick(); ?>
				</td>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="center">
					<?php echo $user_info->GetEmail(); ?>
				</td>
			</tr>

<?php

	}

	if(mysql_num_rows($result) > 0)
	{

?>

			<tr>
				<td bgcolor="#FFFFFF" width="5%" valign="center" align="center" colspan="1">
					<input type="checkbox" name="p_select_all" onclick="SelectAll();">
				</td>
				<td bgcolor="#FFFFFF" width="95%" valign="center" align="left" colspan="5">
					Selecionar tudo.
				</td>
			</tr>

<?php

	}

?>

			<tr>
				<td bgcolor="#FFFFFF" width="100%" valign="center" align="center" colspan="6">
					<a href="javascript:Update();">Atualizar</a>&nbsp;
					<a href="/schifers/pages/pgRestricted.php">Voltar</a>
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="100%" valign="center" align="center" colspan="6">
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
