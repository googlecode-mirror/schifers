<?php

	/*
	* pgSession.php
	*
	* Session.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: August 04, 2007
	*/
	
	$module_name = "session";

	require '../../schifers/constants/cdConstants.php';
	require '../../'.$WEB_SITE.'src/cdDatabase.php';
	require '../../'.$WEB_SITE.'src/cdDate.php';
	require '../../'.$WEB_SITE.'src/cdUser.php';
	require '../../'.$WEB_SITE.'src/cdSession.php';
	require '../../'.$WEB_SITE.'src/cdGuardian.php';

	$screen_module_name = "Sessão";

	if(isset($_POST["p_action"]))
	{
		$action = $_POST["p_action"];
		$sess_id = $_POST["p_sess_id"];
		$sess_active = $_POST["p_sess_active"];
		$sess_date = $_POST["p_sess_date"];
		$sess_ip = $_POST["p_sess_ip"];
		$sess_user_id = $_POST["p_sess_user_id"];
		$message = "";

		if($action == 1)
		{
			$session = new Session();
			$session->SetDatabase($database);
			$session->SetId($sess_id);
			$session->SelectById();
			
			$date = new Date();
			$date->Setdate($session->GetDate());
			$date->ConvertToFullDisplay();

			$sess_id = $session->GetId();
			$sess_date = $date->GetConverted();
			$sess_active = $session->GetActive();
			$sess_ip = $session->GetIp();
			$sess_user_id = $session->GetUser();
			
			if($sess_id == "")
			{
				$message = $screen_module_name." não encontrado.";
				$sess_id = "";
				$sess_active = "";
				$sess_date = $date->GetNowFull();
				$sess_ip = "";
				$sess_user_id = "";
			}
		}
		
		if($action == 2)
		{
			$date = new Date();
			$date->SetConverted($sess_date);
			$date->ConvertToFullDate();

			$session = new Session();
			$session->SetDatabase($database);
			$session->SetActive($sess_active);
			$session->SetName($date->GetDate());
			$session->SetIp($sess_ip);
			$session->SetUser($user);
			
			if($session->Insert())
			{			
				$message = $screen_module_name." incluído com sucesso.";
				$sess_id = "";
				$sess_active = "";
				$sess_date = $date->GetNowFull();
				$sess_ip = "";
				$sess_user_id = "";
			}
			else
			{
				$message = "Problemas na operação.";
			}
		}

		if($action == 3)
		{
			$date = new Date();
			$date->SetConverted($sess_date);
			$date->ConvertToFullDate();

			$session = new Session();
			$session->SetDatabase($database);
			$session->SetId($sess_id);
			$session->SetActive($sess_active);
			$session->SetName($date->GetDate());
			$session->SetIp($sess_ip);
			$session->SetUser($sess_user_id);
			
			if($session->Update())
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
			$session = new Session();
			$session->SetDatabase($database);
			$session->SetId($sess_id);
			
			if($session->Delete())
			{			
				$date = new Date();

				$message = $screen_module_name." excluído com sucesso.";
				$sess_id = "";
				$sess_active = "";
				$sess_date = $date->GetNowFull();
				$sess_ip = "";
				$sess_user_id = "";
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
				document.form_admin.p_sess_id.value = "";
				document.form_admin.p_sess_active.value = "";
				document.form_admin.p_sess_name.value = "";
				document.form_admin.p_sess_ip.value = "";
				document.form_admin.p_sess_user_id.selectedIndex = 0;
				document.form_admin.p_action.value="0";
				document.form_admin.submit();
			}
			
			function Query()
			{
				window.open("pgSessionQuery.php", "querySession", "width=600,height=500,top=150,left=150,toolbar=0,location=0,status=0,menubar=0,scrollbars=1,resizable=1");
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
			<tr>
				<td bgcolor="#EEEEEE" width="100%" valign="top" class="form_title" colspan="2">
				Sessões
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Id:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<input type="text" name="p_sess_id" value="<?php echo $sess_id; ?>">
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Ip:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<input type="text" name="p_sess_ip" value="<?php echo $sess_ip; ?>">
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Usuário:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<select name="p_sess_user_id">
						<option value="">Selecione</option>

<?php

	$user = new User();
	$user->SetDatabase($database);
	$result = $user->Select();
	
	while ($data = $database->FetchArray($result))
	{
		$user_id = $data["user_id"];
		$user_name = $date["user_username"];
		
		if($sess_user_id == $user_id)
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
					Data e Hora:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<input type="text" name="p_sess_date" value="<?php echo $sess_date; ?>">
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Ativa:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<input type="checkbox" name="p_sess_active">
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="100%" valign="center" align="center" colspan="2">

<?php

	if($sess_id != "")
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
