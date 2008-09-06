<?php

	/*
	* pgShout.php
	*
	* Shout.
	*
	* Written by: Bruno Schifer Bernardi
	* Last Updated: August 04, 2007
	*/
	
	$module_name = "shout";

	require '../../schifers/constants/cdConstants.php';
	require '../../'.$WEB_SITE.'src/cdDatabase.php';
	require '../../'.$WEB_SITE.'src/cdDate.php';
	require '../../'.$WEB_SITE.'src/cdShout.php';
	require '../../'.$WEB_SITE.'src/cdUser.php';
	require '../../'.$WEB_SITE.'src/cdSession.php';
	require '../../'.$WEB_SITE.'src/cdGuardian.php';

	$screen_module_name = "Grito da Galera";

	if(isset($_POST["p_action"]))
	{
		$action = $_POST["p_action"];
		$shou_id = $_POST["p_shou_id"];
		$shou_date = $_POST["p_shou_date"];
		$shou_text = $_POST["p_shou_text"];
		$shou_user_id = $_POST["p_shou_user_id"];
		$message = "";

		if($action == 1)
		{
			$shout = new Shout();
			$shout->SetDatabase($database);
			$shout->SetId($shou_id);
			$shout->SelectById();
			
			$date = new Date();
			$date->SetDate($shout->GetDate());
			$date->ConvertToFullDisplay();

			$shou_id = $shout->GetId();
			$shou_date = $date->GetConverted();
			$shou_text = $shout->GetText();
			$shou_user_id = $shout->GetUser();
			
			if($shou_id == "")
			{
				$message = $screen_module_name." não encontrado.";
				$shou_id = "";
				$shou_date = $date->GetNowFull();
				$shou_text = "";
				$shou_user_id = "";
			}
		}
		
		if($action == 2)
		{
			$date = new Date();
			$date->SetConverted($shou_date);
			$date->ConvertToFullDate();

			$shout = new Shout();
			$shout->SetDatabase($database);
			$shout->SetDate($date->GetDate());
			$shout->SetText($shou_text);
			$shout->SetUser($shou_user_id);
			
			if($shout->Insert())
			{			
				$message = $screen_module_name." incluído com sucesso.";
				$shou_id = "";
				$shou_date = $date->GetNowFull();
				$shou_text = "";
				$shou_user_id = "";
			}
			else
			{
				$message = "Problemas na operação.";
			}
		}

		if($action == 3)
		{
			$date = new Date();
			$date->SetConverted($shou_date);
			$date->ConvertToFullDate();

			$shout = new Shout();
			$shout->SetDatabase($database);
			$shout->SetId($shou_id);
			$shout->SetDate($date->GetDate());
			$shout->SetText($shou_text);
			$shout->SetUser($shou_user_id);
			
			$shou_id = $shout->GetId();
			$shou_date = $shout->GetConverted();
			$shou_text = $shout->GetText();
			$shou_user_id = $shout->GetUser();

			if($shout->Update())
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
			$shout = new Shout();
			$shout->SetDatabase($database);
			$shout->SetId($shou_id);
			
			if($shout->Delete())
			{			
				$date = new Date();

				$message = $screen_module_name." excluído com sucesso.";
				$shou_id = "";
				$shou_date = $date->GetNowFull();
				$shou_text = "";
				$shou_user_id = "";
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
				document.form_admin.p_shou_id.value = "";
				document.form_admin.p_shou_text.value = "";
				document.form_admin.p_shou_user_id.selectedIndex = 0;
				document.form_admin.p_action.value="0";
				document.form_admin.submit();
			}
			
			function Query()
			{
				window.open("pgShoutQuery.php", "queryShout", "width=600,height=500,top=150,left=150,toolbar=0,location=0,status=0,menubar=0,scrollbars=1,resizable=1");
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

<?php

	$date = new Date();
	if($shou_date == "")
	{
		$shou_date = $date->GetNowFull();
	}
	
?>

	<table width="100%" cellspacing="1" bgcolor="#000000">
		<form name="form_admin" method="post">
			<input type="hidden" name="p_action">
			<input type="hidden" name="p_shou_id" value="<?php echo $shou_id; ?>">
			<input type="hidden" name="p_shou_date" value="<?php echo $shou_date; ?>">
			<tr>
				<td bgcolor="#EEEEEE" width="100%" valign="top" class="form_title" colspan="2">
				Grito da Galera
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Data:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<?php echo $shou_date; ?>
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Text:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<textarea name="p_shou_text" rows="5" cols="70"><?php echo $shou_text; ?></textarea>
				</td>
			</tr>
			<tr>
				<td bgcolor="#FFFFFF" width="30%" valign="center" align="right">
					Usuário:&nbsp;
				</td>
				<td bgcolor="#FFFFFF" width="70%" valign="center" align="left">
					<select name="p_shou_user_id">
						<option value="">Selecione</option>

<?php

	$user = new User();
	$user->SetDatabase($database);
	$result = $user->Select();
	
	while ($data = $database->FetchArray($result))
	{
		$user_id = $data["user_id"];
		$user_username = $data["user_username"];
		
		if($shou_user_id == $user_id)
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

	if($shou_id != "")
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
